<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../services/EmailService.php';

class DeanController
{
    private $db;
    private $userModel;
    private $emailService;
    private $authService;

    public function __construct()
    {
        error_log("DeanController instantiated");
        $this->db = (new Database())->connect();
        if ($this->db === null) {
            error_log("Failed to connect to the database in DeanController");
            die("Database connection failed. Please try again later.");
        }
        $this->userModel = new UserModel();
        $this->authService = new AuthService($this->db);
        $this->restrictToDean();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->emailService = new EmailService();
    }

    private function getCurrentSemester()
    {
        try {
            error_log("getCurrentSemester: Querying for current semester");
            // First, try to find the semester marked as current
            $stmt = $this->db->prepare("
                SELECT semester_id, semester_name, academic_year 
                FROM semesters 
                WHERE is_current = 1
            ");
            $stmt->execute();
            $semester = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($semester) {
                error_log("getCurrentSemester: Found current semester - semester_id: {$semester['semester_id']}, semester_name: {$semester['semester_name']}, academic_year: {$semester['academic_year']}");
                return $semester;
            }

            error_log("getCurrentSemester: No semester with is_current = 1, checking date range");
            // Fall back to date range
            $stmt = $this->db->prepare("
                SELECT semester_id, semester_name, academic_year 
                FROM semesters 
                WHERE CURRENT_DATE BETWEEN start_date AND end_date
            ");
            $stmt->execute();
            $semester = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($semester) {
                error_log("getCurrentSemester: Found semester by date range - semester_id: {$semester['semester_id']}, semester_name: {$semester['semester_name']}, academic_year: {$semester['academic_year']}");
            } else {
                error_log("getCurrentSemester: No semester found for current date");
            }

            return $semester ?: null;
        } catch (PDOException $e) {
            error_log("getCurrentSemester: Error - " . $e->getMessage());
            return null;
        }
    }

    private function restrictToDean()
    {
        error_log("restrictToDean: Checking session - user_id: " . ($_SESSION['user_id'] ?? 'none') . ", role_id: " . ($_SESSION['role_id'] ?? 'none'));
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 4) {
            error_log("restrictToDean: Redirecting to login due to unauthorized access");
            header('Location: /login?error=Unauthorized access');
            exit;
        }
    }

    private function logAuthActivity($userId, $action, $ipAddress, $userAgent, $identifier = null)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO auth_logs 
                (user_id, action, ip_address, user_agent, identifier, created_at) 
                VALUES (:user_id, :action, :ip_address, :user_agent, :identifier, NOW())
            ");
            $params = [
                ':user_id' => $userId,
                ':action' => $action,
                ':ip_address' => $ipAddress,
                ':user_agent' => $userAgent,
                ':identifier' => $identifier ?: session_id()
            ];
            error_log("logAuthActivity: Logging - Action: $action, User: $userId, IP: $ipAddress");
            $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("logAuthActivity: Failed to log auth activity - " . $e->getMessage());
        }
    }

    private function getDepartmentLogins($collegeId)
    {
        try {
            $query = "
            SELECT 
                u.user_id,
                u.first_name,
                u.last_name,
                COALESCE(d.department_name, 'No Department') AS department_name,
                la.action,
                la.ip_address,
                la.user_agent,
                la.created_at
            FROM auth_logs la
            JOIN users u ON la.user_id = u.user_id
            JOIN faculty f ON u.user_id = f.user_id
            JOIN faculty_departments fd ON f.faculty_id = fd.faculty_id
            JOIN departments d ON fd.department_id = d.department_id
            WHERE d.college_id = :college_id AND la.action = 'Login'
            ORDER BY la.created_at DESC
            LIMIT 10";
            $stmt = $this->db->prepare($query);
            error_log("getDepartmentLogins: Executing query with college_id=$collegeId");
            $stmt->execute([':college_id' => $collegeId]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("getDepartmentLogins: Fetched " . count($results) . " login records. First result: " . json_encode($results[0] ?? 'None'));
            return $results;
        } catch (PDOException $e) {
            error_log("getDepartmentLogins: Failed to fetch logins - " . $e->getMessage());
            return [];
        }
    }

    public function dashboard()
    {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);

        // Log dashboard access
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $this->logAuthActivity($userId, 'Access Dashboard', $ipAddress, $userAgent);

        // Get college details for the dean
        $query = "
        SELECT d.college_id, c.college_name 
        FROM deans d
        JOIN colleges c ON d.college_id = c.college_id
        WHERE d.user_id = :user_id AND d.is_current = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        $college = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$college) {
            error_log("No college found for dean user_id: $userId");
            return ['error' => 'No college assigned to this dean'];
        }

        // Fetch current semester
        $semesterQuery = "SELECT semester_name, academic_year FROM semesters WHERE is_current = 1 LIMIT 1";
        $semesterStmt = $this->db->prepare($semesterQuery);
        $semesterStmt->execute();
        $currentSemester = $semesterStmt->fetch(PDO::FETCH_ASSOC);
        $currentSemesterDisplay = $currentSemester ?
            "{$currentSemester['semester_name']} Semester, A.Y {$currentSemester['academic_year']}" : 'Not Set';

        // Fetch dean's schedule
        $schedules = [];
        $query = "SELECT faculty_id FROM faculty WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        $faculty = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($faculty) {
            $scheduleQuery = "
            SELECT s.*, c.course_code, c.course_name, r.room_name, se.semester_name, se.academic_year,
            CONCAT(COALESCE(u.title, ''), ' ', u.first_name, ' ', u.last_name) AS faculty_name, 
            GROUP_CONCAT(DISTINCT s.day_of_week ORDER BY 
                    CASE s.day_of_week 
                        WHEN 'Monday' THEN 1
                        WHEN 'Tuesday' THEN 2
                        WHEN 'Wednesday' THEN 3
                        WHEN 'Thursday' THEN 4
                        WHEN 'Friday' THEN 5
                        WHEN 'Saturday' THEN 6
                        WHEN 'Sunday' THEN 7
                    END
                    SEPARATOR ', '
                ) as day_of_week
            FROM schedules s
            JOIN courses c ON s.course_id = c.course_id
             JOIN faculty f ON s.faculty_id = f.faculty_id
             JOIN users u ON f.user_id = u.user_id
            LEFT JOIN sections sec ON s.section_id = sec.section_id
            LEFT JOIN classrooms r ON s.room_id = r.room_id
            JOIN semesters se ON s.semester_id = se.semester_id
            WHERE s.faculty_id = :faculty_id AND se.is_current = 1
            ORDER BY s.day_of_week, s.start_time";
            $scheduleStmt = $this->db->prepare($scheduleQuery);
            $scheduleStmt->execute([':faculty_id' => $faculty['faculty_id']]);
            $schedules = $scheduleStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($schedules as &$schedule) {
                $schedule['formatted_days'] = $this->formatScheduleDays($schedule['day_of_week']);
            }
        }

        // Fetch dashboard statistics
        $stats = [
            'total_faculty' => $this->getCollegeStats($college['college_id'], 'faculty'),
            'total_classrooms' => $this->getCollegeStats($college['college_id'], 'classrooms'),
            'total_departments' => $this->getCollegeStats($college['college_id'], 'departments'),
            'pending_approvals' => $this->getPendingApprovals($college['college_id'])
        ];

        $activities = $this->getDepartmentActivities($college['college_id']);
        $departmentLogins = $this->getDepartmentLogins($college['college_id']);

        // NEW: Fetch department overview with faculty count
        $departmentOverview = $this->getDepartmentOverview($college['college_id']);

        // NEW: Fetch faculty distribution by department
        $facultyDistribution = $this->getFacultyDistribution($college['college_id']);

        // NEW: Fetch classroom utilization
        $classroomUtilization = $this->getClassroomUtilization($college['college_id']);

        // NEW: Fetch recent schedule changes
        $recentScheduleChanges = $this->getRecentScheduleChanges($college['college_id']);

        // Pass all data to the view
        $currentSemester = $currentSemesterDisplay;
        require_once __DIR__ . '/../views/dean/dashboard.php';
    }

    /**
     * Get department overview with faculty and course counts
     */
    private function getDepartmentOverview($collegeId)
    {
        $query = "
        SELECT 
            d.department_id,
            d.department_name,
          
            COUNT(DISTINCT fd.faculty_id) as faculty_count,
            COUNT(DISTINCT c.course_id) as course_count,
            COUNT(DISTINCT s.schedule_id) as active_schedules
        FROM departments d
        LEFT JOIN faculty_departments fd ON d.department_id = fd.department_id
        LEFT JOIN courses c ON d.department_id = c.department_id
        LEFT JOIN schedules s ON c.course_id = s.course_id AND s.semester_id = (
            SELECT semester_id FROM semesters WHERE is_current = 1 LIMIT 1
        )
        WHERE d.college_id = :college_id
        GROUP BY d.department_id, d.department_name
        ORDER BY d.department_name";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':college_id' => $collegeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get faculty distribution by employment type for this college
     */
    private function getFacultyDistribution($collegeId)
    {
        $query = "
        SELECT 
            f.employment_type,
            COUNT(DISTINCT f.faculty_id) as count
        FROM faculty f
        JOIN faculty_departments fd ON f.faculty_id = fd.faculty_id
        JOIN departments d ON fd.department_id = d.department_id
        WHERE d.college_id = :college_id
        GROUP BY f.employment_type
        ORDER BY count DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':college_id' => $collegeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get classroom utilization statistics
     */
    private function getClassroomUtilization($collegeId)
    {
        $query = "
        SELECT 
            r.room_id,
            r.room_name,
            r.capacity,
            COUNT(DISTINCT s.schedule_id) as total_schedules,
            COUNT(DISTINCT s.day_of_week) as days_used
        FROM classrooms r
        JOIN departments d ON r.department_id = d.department_id
        LEFT JOIN schedules s ON r.room_id = s.room_id AND s.semester_id = (
            SELECT semester_id FROM semesters WHERE is_current = 1 LIMIT 1
        )
        WHERE d.college_id = :college_id
        GROUP BY r.room_id, r.room_name, r.capacity
        ORDER BY total_schedules DESC
        LIMIT 10";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':college_id' => $collegeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get recent schedule changes
     */
    private function getRecentScheduleChanges($collegeId)
    {
        $query = "
        SELECT 
            s.schedule_id,
            c.course_code,
            c.course_name,
            CONCAT(u.first_name, ' ', u.last_name) as faculty_name,
            r.room_name,
            s.day_of_week,
            s.start_time,
            s.end_time,
            s.updated_at
        FROM schedules s
        JOIN courses c ON s.course_id = c.course_id
        JOIN faculty f ON s.faculty_id = f.faculty_id
        JOIN users u ON f.user_id = u.user_id
        JOIN departments d ON c.department_id = d.department_id
        LEFT JOIN classrooms r ON s.room_id = r.room_id
        WHERE d.college_id = :college_id 
        AND s.semester_id = (SELECT semester_id FROM semesters WHERE is_current = 1 LIMIT 1)
        ORDER BY s.updated_at DESC
        LIMIT 5";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':college_id' => $collegeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Format schedule days to show MWF, TTH format instead of listing individually
     */
    private function formatScheduleDays($dayString)
    {
        if (empty($dayString)) {
            return 'TBD';
        }

        $days = explode(', ', $dayString);
        $dayAbbrev = [];

        foreach ($days as $day) {
            switch (trim($day)) {
                case 'Monday':
                    $dayAbbrev[] = 'M';
                    break;
                case 'Tuesday':
                    $dayAbbrev[] = 'T';
                    break;
                case 'Wednesday':
                    $dayAbbrev[] = 'W';
                    break;
                case 'Thursday':
                    $dayAbbrev[] = 'Th';
                    break;
                case 'Friday':
                    $dayAbbrev[] = 'F';
                    break;
                case 'Saturday':
                    $dayAbbrev[] = 'S';
                    break;
                case 'Sunday':
                    $dayAbbrev[] = 'Su';
                    break;
            }
        }

        // Common patterns
        $dayStr = implode('', $dayAbbrev);

        // Replace common patterns for better readability
        $patterns = [
            'MWF' => 'MWF',
            'TTh' => 'TTH',
            'MW' => 'MW',
            'ThF' => 'THF',
            'MThF' => 'MTHF',
            'TWThF' => 'TWTHF',
            'MTWThF' => 'MTWTHF',
            'SSu' => 'SSu',
        ];

        foreach ($patterns as $pattern => $replacement) {
            if ($dayStr == $pattern) {
                return $replacement;
            }
        }

        return $dayStr ?: 'TBD';
    }

    public function activities()
    {
        try {
            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                error_log("activities: No user_id in session");
                throw new Exception('User session not found');
            }

            $collegeId = $this->getDeanCollegeId($userId);
            if (!$collegeId) {
                error_log("activities: No college found for dean user_id: $userId");
                throw new Exception('No college assigned to this dean');
            }

            // Get filter parameters
            $departmentId = $_GET['department_id'] ?? null;
            $date = $_GET['date'] ?? null;
            $activities = $this->getDepartmentActivities($collegeId, $departmentId, $date);

            if ($activities === false) {
                throw new Exception('Failed to fetch activities');
            }

            // Prepare data array for the view
            $data = [
                'activities' => $activities ?? [],
                'title' => 'Dean Activities Dashboard',
                'college_id' => $collegeId,
                'department_id' => $departmentId,
                'date' => $date
            ];

            // Load activities view
            require_once __DIR__ . '/../views/dean/activities.php';
        } catch (PDOException $e) {
            error_log("activities: Database error - " . $e->getMessage());

            // Prepare data array with empty activities and error
            $data = [
                'activities' => [],
                'title' => 'Dean Activities Dashboard',
                'error' => "Database error occurred. Please try again."
            ];

            require_once __DIR__ . '/../views/dean/activities.php';
        } catch (Exception $e) {
            error_log("activities: Error - " . $e->getMessage());

            // Prepare data array with empty activities and error
            $data = [
                'activities' => [],
                'title' => 'Dean Activities Dashboard',
                'error' => $e->getMessage()
            ];

            require_once __DIR__ . '/../views/dean/activities.php';
        }
    }

    private function getDepartmentActivities($collegeId, $departmentId = null, $date = null)
    {
        try {
            $query = "
        SELECT al.*, d.department_name, u.title, u.first_name, u.last_name, c.college_name
        FROM activity_logs al
        JOIN users u ON al.user_id = u.user_id
        JOIN departments d ON al.department_id = d.department_id
        JOIN colleges c ON d.college_id = c.college_id
        WHERE d.college_id = :college_id";

            $params = [':college_id' => $collegeId];

            if ($departmentId) {
                $query .= " AND al.department_id = :department_id";
                $params[':department_id'] = $departmentId;
            }
            if ($date) {
                $query .= " AND DATE(al.created_at) = :date";
                $params[':date'] = $date;
            }

            $query .= " ORDER BY al.created_at DESC
               LIMIT 50"; // Increased limit for better dashboard experience

            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Ensure we always return an array
            return is_array($result) ? $result : [];
        } catch (PDOException $e) {
            error_log("getDepartmentActivities: Error - " . $e->getMessage());
            return [];
        }
    }

    // Add this for "View All" if not already present
    public function getAllDepartmentActivities($collegeId, $departmentId = null, $date = null)
    {
        try {
            $query = "
            SELECT al.*, d.department_name, u.title, u.first_name, u.last_name
            FROM activity_logs al
            JOIN users u ON al.user_id = u.user_id
            JOIN departments d ON al.department_id = d.department_id
            WHERE d.college_id = :college_id";

            $params = [':college_id' => $collegeId];

            if ($departmentId) {
                $query .= " AND al.department_id = :department_id";
                $params[':department_id'] = $departmentId;
            }
            if ($date) {
                $query .= " AND DATE(al.created_at) = :date";
                $params[':date'] = $date;
            }

            $query .= " ORDER BY al.created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("getAllDepartmentActivities: Error - " . $e->getMessage());
            return [];
        }
    }

    private function getCollegeStats($collegeId, $type)
    {
        try {
            $query = "";
            switch ($type) {
                case 'faculty':
                    $query = "
                        SELECT COUNT(*) 
                        FROM faculty_departments fd 
                        JOIN departments d ON fd.department_id = d.department_id 
                        WHERE d.college_id = :college_id";
                    break;
                case 'classrooms':
                    $query = "
                        SELECT COUNT(*) 
                        FROM classrooms c 
                        JOIN departments d ON c.department_id = d.department_id 
                        WHERE d.college_id = :college_id";
                    break;
                case 'departments':
                    $query = "
                        SELECT COUNT(*) 
                        FROM departments d 
                        WHERE d.college_id = :college_id";
                    break;
            }
            $stmt = $this->db->prepare($query);
            $stmt->execute([':college_id' => $collegeId]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Error fetching $type stats: " . $e->getMessage());
            return 0;
        }
    }

    private function getPendingApprovals($collegeId)
    {
        try {
            $query = "
                SELECT COUNT(*) 
                FROM curriculum_approvals ca 
                JOIN curricula c ON ca.curriculum_id = c.curriculum_id 
                JOIN departments d ON c.department_id = d.department_id 
                WHERE d.college_id = :college_id AND ca.status = 'Pending' AND ca.approval_level = 2";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':college_id' => $collegeId]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Error fetching pending approvals: " . $e->getMessage());
            return 0;
        }
    }

      public function mySchedule()
    {
        try {
            $userId = $_SESSION['user_id'];
            error_log("mySchedule: Starting mySchedule method for user_id: $userId");

            // Fetch faculty ID and complete faculty info with join to users table
            $facultyStmt = $this->db->prepare("
            SELECT f.*, 
                   CONCAT(COALESCE(u.title, ''), ' ', u.first_name, ' ', 
                          COALESCE(u.middle_name, ''), ' ', u.last_name, ' ', 
                          COALESCE(u.suffix, '')) AS faculty_name,
                   u.first_name, u.middle_name, u.last_name, u.title, u.suffix
            FROM faculty f 
            JOIN users u ON f.user_id = u.user_id 
            WHERE u.user_id = ?
        ");
            $facultyStmt->execute([$userId]);
            $faculty = $facultyStmt->fetch(PDO::FETCH_ASSOC);

            if (!$faculty) {
                $error = "No faculty profile found for this user.";
                require_once __DIR__ . '/../views/dean/schedule.php';
                return;
            }

            $facultyId = $faculty['faculty_id'];
            $facultyName = trim($faculty['faculty_name']);
            $facultyPosition = $faculty['academic_rank'] ?? 'Not Specified';
            $employmentType = $faculty['employment_type'] ?? 'Regular';

            // Get department and college details from deans table
            $deptStmt = $this->db->prepare("
            SELECT d.department_name, c.college_name 
            FROM deans dn 
            JOIN departments d ON dn.college_id = d.college_id 
            JOIN colleges c ON d.college_id = c.college_id 
            WHERE dn.user_id = ? AND dn.is_current = 1
        ");
            $deptStmt->execute([$userId]);
            $department = $deptStmt->fetch(PDO::FETCH_ASSOC);
            $departmentName = $department['department_name'] ?? 'Not Assigned';
            $collegeName = $department['college_name'] ?? 'Not Assigned';

            $semesterStmt = $this->db->query("SELECT semester_id, semester_name, academic_year FROM semesters WHERE is_current = 1");
            $semester = $semesterStmt->fetch(PDO::FETCH_ASSOC);

            if (!$semester) {
                error_log("mySchedule: No current semester found");
                $error = "No current semester defined. Please contact the administrator to set the current semester.";
                require_once __DIR__ . '/../views/dean/chedule.php';
                return;
            }

            $semesterId = $semester['semester_id'];
            $semesterName = $semester['semester_name'] . ' Semester, A.Y ' . $semester['academic_year'];
            error_log("mySchedule: Current semester ID: $semesterId, Name: $semesterName");

            // Get schedules with grouped days and better data structure
            $schedulesStmt = $this->db->prepare("
            SELECT s.schedule_id, c.course_code, c.course_name, c.units,
                   r.room_name, s.day_of_week, s.start_time, s.end_time, s.schedule_type, 
                   COALESCE(sec.section_name, 'N/A') AS section_name, sec.current_students,
                   TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) / 60 AS duration_hours,
                   sec.year_level,
                   CASE 
                       WHEN s.schedule_type = 'Laboratory' THEN TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) / 60
                       ELSE 0 
                   END AS lab_hours,
                   CASE 
                       WHEN s.schedule_type = 'Lecture' THEN TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) / 60
                       ELSE 0 
                   END AS lecture_hours,
                   COUNT(sec.current_students) as student_count
            FROM schedules s
            LEFT JOIN courses c ON s.course_id = c.course_id
            LEFT JOIN sections sec ON s.section_id = sec.section_id
            LEFT JOIN classrooms r ON s.room_id = r.room_id
            WHERE s.faculty_id = ? AND s.semester_id = ?
            GROUP BY s.schedule_id, c.course_code, c.course_name, r.room_name, 
                     s.start_time, s.end_time, s.schedule_type, sec.section_name
            ORDER BY c.course_code, s.start_time
        ");
            $schedulesStmt->execute([$facultyId, $semesterId]);
            $rawSchedules = $schedulesStmt->fetchAll(PDO::FETCH_ASSOC);

            // Group schedules by course, time, and room to combine days
            $groupedSchedules = [];
            $scheduleKey = [];

            foreach ($rawSchedules as $schedule) {
                $key = $schedule['course_code'] . '|' . $schedule['start_time'] . '|' . $schedule['end_time'] . '|' . $schedule['schedule_type'] . '|' . $schedule['section_name'];

                if (!isset($groupedSchedules[$key])) {
                    $groupedSchedules[$key] = $schedule;
                    $groupedSchedules[$key]['days'] = [];
                }

                $groupedSchedules[$key]['days'][] = $schedule['day_of_week'];
            }

            // Format days and create final schedule array
            $schedules = [];
            foreach ($groupedSchedules as $schedule) {
                $schedule['day_of_week'] = $this->formatScheduleDays(implode(', ', $schedule['days']));
                unset($schedule['days']);
                $schedules[] = $schedule;
            }

            error_log("mySchedule: Fetched " . count($schedules) . " grouped schedules for faculty_id $facultyId in semester $semesterId");

            $showAllSchedules = false;
            if (empty($schedules)) {
                error_log("mySchedule: No schedules found for current semester, trying to fetch all schedules");
                // Repeat the same process for all semesters
                $schedulesStmt = $this->db->prepare("
                SELECT s.schedule_id, c.course_code, c.course_name, c.units,
                       r.room_name, s.day_of_week, s.start_time, s.end_time, s.schedule_type, 
                       COALESCE(sec.section_name, 'N/A') AS section_name, sec.current_students,
                       TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) / 60 AS duration_hours,
                       sec.year_level,
                       CASE 
                           WHEN s.schedule_type = 'Laboratory' THEN TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) / 60
                           ELSE 0 
                       END AS lab_hours,
                       CASE 
                           WHEN s.schedule_type = 'Lecture' THEN TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) / 60
                           ELSE 0 
                       END AS lecture_hours,
                       COUNT(sec.current_students) as student_count
                FROM schedules s
                LEFT JOIN courses c ON s.course_id = c.course_id
                LEFT JOIN sections sec ON s.section_id = sec.section_id
                LEFT JOIN classrooms r ON s.room_id = r.room_id
                WHERE s.faculty_id = ?
                GROUP BY s.schedule_id, c.course_code, c.course_name, r.room_name, 
                         s.start_time, s.end_time, s.schedule_type, sec.section_name
                ORDER BY c.course_code, s.start_time
            ");
                $schedulesStmt->execute([$facultyId]);
                $rawSchedules = $schedulesStmt->fetchAll(PDO::FETCH_ASSOC);

                // Same grouping logic
                $groupedSchedules = [];
                foreach ($rawSchedules as $schedule) {
                    $key = $schedule['course_code'] . '|' . $schedule['start_time'] . '|' . $schedule['end_time'] . '|' . $schedule['schedule_type'] . '|' . $schedule['section_name'];

                    if (!isset($groupedSchedules[$key])) {
                        $groupedSchedules[$key] = $schedule;
                        $groupedSchedules[$key]['days'] = [];
                    }

                    $groupedSchedules[$key]['days'][] = $schedule['day_of_week'];
                }

                $schedules = [];
                foreach ($groupedSchedules as $schedule) {
                    $schedule['day_of_week'] = $this->formatScheduleDays(implode(', ', $schedule['days']));
                    unset($schedule['days']);
                    $schedules[] = $schedule;
                }

                $showAllSchedules = true;
                error_log("mySchedule: Fetched " . count($schedules) . " total grouped schedules for faculty_id $facultyId");
            }

            // Calculate totals
            $totalHours = 0;
            $totalLectureHours = 0;
            $totalLabHours = 0;
            $preparations = [];

            foreach ($schedules as $schedule) {
                $totalHours += $schedule['duration_hours'];
                $totalLectureHours += $schedule['lecture_hours'];
                $totalLabHours += $schedule['lab_hours'];
                $preparations[$schedule['course_code']] = true;
            }

            $totalLabHoursX075 = $totalLabHours * 0.75;
            $noOfPreparations = count($preparations);
            $actualTeachingLoad = $totalLectureHours + $totalLabHoursX075;
            $equivalTeachingLoad = $faculty['equiv_teaching_load'] ?? 0;
            $totalWorkingLoad = $actualTeachingLoad + $equivalTeachingLoad;
            $excessHours = max(0, $totalWorkingLoad - 24);

            error_log("mySchedule: Calculations - Total hours: $totalHours, Lecture: $totalLectureHours, Lab: $totalLabHours, Preparations: $noOfPreparations");

            // Pass all data to view
            $facultyData = [
                'faculty_id' => $facultyId,
                'faculty_name' => $facultyName,
                'academic_rank' => $facultyPosition,
                'employment_type' => $employmentType,
                'bachelor_degree' => $faculty['bachelor_degree'] ?? 'Not specified',
                'master_degree' => $faculty['master_degree'] ?? 'Not specified',
                'doctorate_degree' => $faculty['doctorate_degree'] ?? 'Not specified',
                'post_doctorate_degree' => $faculty['post_doctorate_degree'] ?? 'Not applicable',
                'designation' => $faculty['designation'] ?? 'Not specified',
                'classification' => $faculty['classification'] ?? 'Not specified',
                'advisory_class' => $faculty['advisory_class'] ?? 'Not assigned',
                'total_lecture_hours' => $totalLectureHours,
                'total_laboratory_hours' => $totalLabHours,
                'total_laboratory_hours_x075' => $totalLabHoursX075,
                'no_of_preparation' => $noOfPreparations,
                'actual_teaching_load' => $actualTeachingLoad,
                'equiv_teaching_load' => $equivalTeachingLoad,
                'total_working_load' => $totalWorkingLoad,
                'excess_hours' => $excessHours
            ];

            require_once __DIR__ . '/../views/dean/schedule.php';
        } catch (Exception $e) {
            error_log("mySchedule: Full error: " . $e->getMessage());
            http_response_code(500);
            echo "Error loading schedule: " . htmlspecialchars($e->getMessage());
            exit;
        }
    }


    public function manageSchedule()
    {
        $userId = $_SESSION['user_id'];
        $collegeId = $this->getDeanCollegeId($userId);

        // Handle approval/rejection actions
        if (isset($_POST['action']) && in_array($_POST['action'], ['approve', 'reject'])) {
            $scheduleIdsStr = $_POST['schedule_ids'] ?? $_POST['schedule_id'] ?? '';
            $status = $_POST['action'] === 'approve' ? 'Approved' : 'Rejected';
            $isPublic = $_POST['action'] === 'approve' ? 1 : 0;

            // Get current semester ID for validation
            $currentSemesterStmt = $this->db->prepare("SELECT semester_id FROM semesters WHERE is_current = 1 LIMIT 1");
            $currentSemesterStmt->execute();
            $currentSemesterId = $currentSemesterStmt->fetchColumn();

            if ($currentSemesterId && !empty($scheduleIdsStr)) {
                $scheduleIds = array_map('intval', explode(',', $scheduleIdsStr));
                $placeholders = implode(',', array_fill(0, count($scheduleIds), '?'));

                $stmt = $this->db->prepare("
                UPDATE schedules 
                SET status = ?, approved_by = ?, approval_date = NOW(), is_public = ?, updated_at = NOW()
                WHERE schedule_id IN ($placeholders) AND semester_id = ?
                ");
                $params = array_merge([$status, $userId, $isPublic], $scheduleIds, [$currentSemesterId]);
                $result = $stmt->execute($params);

                if ($result) {
                    $_SESSION['success'] = "Schedule(s) {$status} successfully.";
                } else {
                    $_SESSION['error'] = "Failed to update schedule(s).";
                }
            } else {
                $_SESSION['error'] = "No current semester found or invalid schedule IDs.";
            }

            // Redirect to prevent form resubmission (adjust URL to match your routing)
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Get current semester details
        $currentSemesterStmt = $this->db->prepare("SELECT semester_id, semester_name, academic_year FROM semesters WHERE is_current = 1 LIMIT 1");
        $currentSemesterStmt->execute();
        $currentSemesterId = $currentSemesterStmt->fetch(PDO::FETCH_ASSOC);

        if (!$currentSemesterId) {
            error_log("No current semester found for manageSchedule");
            $departments = [];
            $schedules = [];
            require_once __DIR__ . '/../views/dean/manage_schedules.php';
            return;
        }

        // Fetch departments with college name
        $stmt = $this->db->prepare("
        SELECT d.department_id, d.department_name
        FROM departments d
        JOIN colleges c ON d.college_id = c.college_id
        WHERE d.college_id = :college_id
        ");
        $stmt->execute([':college_id' => $collegeId]);
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get college details for the dean
        $query = "
        SELECT d.college_id, c.college_name 
        FROM deans d
        JOIN colleges c ON d.college_id = c.college_id
        WHERE d.user_id = :user_id AND d.is_current = 1";
            $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        $college = $stmt->fetch(PDO::FETCH_ASSOC);

        // Single query for all schedules across departments in the college, current semester only
        // Group by course/section/room/time/type to consolidate multi-day schedules
        $stmt = $this->db->prepare("
        SELECT 
            GROUP_CONCAT(DISTINCT s.schedule_id) as schedule_ids,
            s.department_id, d.department_name, s.start_time, s.end_time,
            c.course_code, cl.room_name, sec.section_name, s.schedule_type, s.status,
            CONCAT(COALESCE(u.title, ''), ' ', u.first_name, ' ', u.middle_name, ' ', u.last_name) AS faculty_name, 
            GROUP_CONCAT(DISTINCT s.day_of_week ORDER BY 
                CASE s.day_of_week 
                    WHEN 'Monday' THEN 1
                    WHEN 'Tuesday' THEN 2
                    WHEN 'Wednesday' THEN 3
                    WHEN 'Thursday' THEN 4
                    WHEN 'Friday' THEN 5
                    WHEN 'Saturday' THEN 6
                    WHEN 'Sunday' THEN 7
                END
                SEPARATOR ', '
            ) as day_of_week
        FROM schedules s
        JOIN faculty f ON s.faculty_id = f.faculty_id
        JOIN users u ON f.user_id = u.user_id
        JOIN courses c ON s.course_id = c.course_id
        LEFT JOIN classrooms cl ON s.room_id = cl.room_id
        JOIN sections sec ON s.section_id = sec.section_id
        JOIN departments d ON s.department_id = d.department_id
        WHERE d.college_id = :college_id AND s.semester_id = :semester_id
        GROUP BY s.department_id, d.department_name, c.course_code, sec.section_name, s.schedule_type,
                u.title, u.first_name, u.middle_name, u.last_name, cl.room_name, s.start_time, s.end_time
        ORDER BY d.department_name, c.course_code, s.start_time
        ");
        $stmt->execute([':college_id' => $collegeId, ':semester_id' => $currentSemesterId['semester_id']]);
        $allSchedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Group schedules by department_id
        $schedules = [];
        foreach ($allSchedules as $schedule) {
            $deptId = $schedule['department_id'];
            if (!isset($schedules[$deptId])) {
                $schedules[$deptId] = [];
            }

            // Format the days for compact display (e.g., "MWF")
            $schedule['formatted_days'] = $this->formatScheduleDays($schedule['day_of_week']);
            $schedules[$deptId][] = $schedule;
        }

        error_log("manageSchedule: Fetched " . count($allSchedules) . " grouped schedules for college $collegeId, grouped into " . count($schedules) . " departments");

        require_once __DIR__ . '/../views/dean/manage_schedules.php';
    }

    public function classroom()
    {
        $userId = $_SESSION['user_id'];
        $collegeId = $this->getDeanCollegeId($userId);

        // Add this line before requiring the view
        $controller = $this;

        if (isset($_POST['toggle_availability'])) {
            $roomId = $_POST['room_id'];
            $currentAvailability = $_POST['current_availability'];
            $nextAvailability = [
                'available' => 'unavailable',
                'unavailable' => 'under_maintenance',
                'under_maintenance' => 'available'
            ][$currentAvailability];
            $query = "UPDATE classrooms SET availability = :availability, updated_at = NOW() WHERE room_id = :room_id";
            $stmt = $this->db->prepare($query);
            try {
                $stmt->execute([':availability' => $nextAvailability, ':room_id' => $roomId]);
                header("Location: /dean/classroom?success=Availability updated successfully");
            } catch (PDOException $e) {
                error_log("Error updating availability: " . $e->getMessage());
                header("Location: /dean/classroom?error=Failed to update availability");
            }
            exit;
        }

        if (isset($_POST['update_classroom'])) {
            $roomId = $_POST['room_id'];
            $roomName = $_POST['room_name'];
            $building = $_POST['building'];
            $departmentId = $_POST['department_id'];
            $capacity = $_POST['capacity'];
            $roomType = $_POST['room_type'];
            $shared = isset($_POST['shared']) ? 1 : 0;
            $availability = $_POST['availability'];
            $query = "UPDATE classrooms SET room_name = :room_name, building = :building, department_id = :department_id, capacity = :capacity, room_type = :room_type, shared = :shared, availability = :availability, updated_at = NOW() WHERE room_id = :room_id";
            $stmt = $this->db->prepare($query);
            try {
                $stmt->execute([
                    ':room_name' => $roomName,
                    ':building' => $building,
                    ':department_id' => $departmentId,
                    ':capacity' => $capacity,
                    ':room_type' => $roomType,
                    ':shared' => $shared,
                    ':availability' => $availability,
                    ':room_id' => $roomId
                ]);
                header("Location: /dean/classroom?success=Classroom updated successfully");
            } catch (PDOException $e) {
                error_log("Error updating classroom: " . $e->getMessage());
                header("Location: /dean/classroom?error=Failed to update classroom");
            }
            exit;
        }

        if (!$collegeId) {
            error_log("No college found for dean user_id: $userId");
            return ['error' => 'No college assigned to this dean'];
        }

        // Handle add classroom
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_classroom'])) {
            $this->addClassroom($_POST, $collegeId);
        }

        // Handle room reservation approval
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
            $this->handleRoomReservation($_POST);
        }

        // Fetch classrooms
        $query = "
        SELECT c.*, d.department_name
        FROM classrooms c
        JOIN departments d ON c.department_id = d.department_id
        WHERE d.college_id = :college_id
        ORDER BY c.building, c.room_name";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':college_id' => $collegeId]);
        $classrooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Load classroom management view
        require_once __DIR__ . '/../views/dean/classroom.php';
    }

    private function addClassroom($data, $collegeId)
    {
        try {
            // Verify department belongs to Dean's college
            $query = "SELECT department_id FROM departments WHERE department_id = :department_id AND college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':department_id' => $data['department_id'],
                ':college_id' => $collegeId
            ]);
            if (!$stmt->fetch()) {
                error_log("Invalid department_id for college_id: $collegeId");
                header('Location: /dean/classroom?error=Invalid department selected');
                exit;
            }

            if (isset($_POST['add_classroom'])) {
                $roomName = $_POST['room_name'];
                $building = $_POST['building'];
                $departmentId = $_POST['department_id'];
                $capacity = $_POST['capacity'];
                $roomType = $_POST['room_type'];
                $shared = isset($_POST['shared']) ? 1 : 0;
                $availability = $_POST['availability'];
                $query = "INSERT INTO classrooms (room_name, building, department_id, capacity, room_type, shared, availability, created_at, updated_at) VALUES (:room_name, :building, :department_id, :capacity, :room_type, :shared, :availability, NOW(), NOW())";
                $stmt = $this->db->prepare($query);
                try {
                    $stmt->execute([
                        ':room_name' => $roomName,
                        ':building' => $building,
                        ':department_id' => $departmentId,
                        ':capacity' => $capacity,
                        ':room_type' => $roomType,
                        ':shared' => $shared,
                        ':availability' => $availability
                    ]);
                    header("Location: /dean/classroom?success=Classroom added successfully");
                } catch (PDOException $e) {
                    error_log("Error adding classroom: " . $e->getMessage());
                    header("Location: /dean/classroom?error=Failed to add classroom");
                }
                exit;
            }
        } catch (PDOException $e) {
            error_log("Error adding classroom: " . $e->getMessage());
            header('Location: /dean/classroom?error=Failed to add classroom');
        }
    }

    private function handleRoomReservation($data)
    {
        try {
            $query = "
                UPDATE room_reservations 
                SET approval_status = :status, approved_by = :approved_by
                WHERE reservation_id = :reservation_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':status' => $data['status'],
                ':approved_by' => $_SESSION['user_id'],
                ':reservation_id' => $data['reservation_id']
            ]);
            header('Location: /dean/classroom?success=Reservation updated');
        } catch (PDOException $e) {
            error_log("Error updating room reservation: " . $e->getMessage());
            header('Location: /dean/classroom?error=Failed to update reservation');
        }
    }

    public function faculty()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            error_log("faculty: No user_id in session");
            http_response_code(401);
            return ['error' => 'No user session'];
        }

        $collegeId = $this->getDeanCollegeId($userId);
        if (!$collegeId) {
            error_log("faculty: No college found for dean user_id: $userId");
            http_response_code(403);
            return ['error' => 'No college assigned to this dean'];
        }

        try {
            $programChairs = [];
            $faculty = [];
            $pendingUsers = [];
            $departments = [];
            $currentSemester = ['semester_name' => 'N/A', 'academic_year' => 'N/A'];
            $error = null;

            // FIXED: Use NULL instead of invalid directory path for default profile picture
            $queryChairs = "
            SELECT u.user_id, u.employee_id, u.email, u.title, u.first_name, u.middle_name, u.last_name, u.suffix, 
                u.profile_picture, u.is_active, 
                pc.program_id, p.program_name, f.academic_rank, f.employment_type, d.department_name, d.department_id, c.college_name
            FROM users u
            JOIN faculty f ON u.user_id = f.user_id
            JOIN program_chairs pc ON u.user_id = pc.user_id
            JOIN programs p ON pc.program_id = p.program_id
            JOIN departments d ON p.department_id = d.department_id
            JOIN colleges c ON d.college_id = c.college_id
            WHERE d.college_id = :college_id AND pc.is_current = 1 AND u.role_id = 5
            ORDER BY u.last_name, u.first_name";
            $stmtdeans = $this->db->prepare($queryChairs);
            $stmtdeans->execute([':college_id' => $collegeId]);
            $programChairs = $stmtdeans->fetchAll(PDO::FETCH_ASSOC);

            // Fetch Faculty - FIXED: Remove COALESCE with invalid path
            $queryFaculty = "
            SELECT u.user_id, u.employee_id, u.email, u.title, u.first_name, u.middle_name, u.last_name, u.suffix, 
                u.profile_picture, u.is_active, 
                f.academic_rank, f.employment_type, COALESCE(d.department_name, 'No Department') AS department_name, 
                COALESCE(d.department_id, 0) AS department_id, c.college_name,
                co.course_name AS specialization, s.expertise_level
            FROM users u
            JOIN colleges c ON u.college_id = c.college_id
            JOIN faculty f ON u.user_id = f.user_id
            LEFT JOIN faculty_departments fd ON f.faculty_id = fd.faculty_id AND fd.is_primary = 1
            LEFT JOIN departments d ON fd.department_id = d.department_id
            LEFT JOIN specializations s ON f.faculty_id = s.faculty_id AND s.is_primary_specialization = 1
            LEFT JOIN courses co ON s.course_id = co.course_id
            WHERE u.college_id = :college_id AND u.role_id = 6
            ORDER BY u.last_name, u.first_name";
            $stmtFaculty = $this->db->prepare($queryFaculty);
            if (!$stmtFaculty) {
                throw new PDOException("Failed to prepare queryFaculty: " . implode(', ', $this->db->errorInfo()));
            }
            $stmtFaculty->execute([':college_id' => $collegeId]);
            $faculty = $stmtFaculty->fetchAll(PDO::FETCH_ASSOC);
            error_log("faculty: Fetched " . count($faculty) . " faculty members");

            // FIXED: Remove COALESCE with invalid path for pending users
            $queryPending = "
            SELECT u.user_id, u.employee_id, u.email, u.title, u.first_name, u.middle_name, u.last_name, u.suffix, 
                u.profile_picture, u.is_active, 
                u.role_id, r.role_name, f.academic_rank, f.employment_type, d.department_name, d.department_id, c.college_name
            FROM users u
            JOIN faculty f ON u.user_id = f.user_id
            JOIN roles r ON u.role_id = r.role_id
            JOIN departments d ON u.department_id = d.department_id
            JOIN colleges c ON d.college_id = c.college_id
            WHERE u.college_id = :college_id AND u.is_active = 0 AND u.role_id IN (5, 6)
            ORDER BY u.created_at";
            $stmtPending = $this->db->prepare($queryPending);
            $stmtPending->execute([':college_id' => $collegeId]);
            $pendingUsers = $stmtPending->fetchAll(PDO::FETCH_ASSOC);

            $queryDepartments = "
            SELECT department_id, department_name
            FROM departments
            WHERE college_id = :college_id
            ORDER BY department_name";
        $stmtDepartments = $this->db->prepare($queryDepartments);
        $stmtDepartments->execute([':college_id' => $collegeId]);
        $departments = $stmtDepartments->fetchAll(PDO::FETCH_ASSOC);

            $querySemester = "
        SELECT semester_name, academic_year
        FROM semesters
        WHERE is_current = 1
        LIMIT 1";
            $stmtSemester = $this->db->prepare($querySemester);
            $stmtSemester->execute();
            $currentSemester = $stmtSemester->fetch(PDO::FETCH_ASSOC) ?: ['semester_name' => 'N/A', 'academic_year' => 'N/A'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                header('Content-Type: application/json');
                if (isset($_POST['action'], $_POST['user_id']) && in_array($_POST['action'], ['activate', 'deactivate', 'promote', 'demote'])) {
                    $result = $this->handleUserAction($_POST);
                    echo json_encode($result);
                    exit;
                } else {
                    error_log("faculty: Invalid POST data");
                    echo json_encode(['success' => false, 'error' => 'Invalid request data']);
                    exit;
                }
            }

            require_once __DIR__ . '/../views/dean/faculty.php';
        } catch (PDOException $e) {
            error_log("faculty: PDO Error - " . $e->getMessage());
            http_response_code(500);
            $error = "Database error: " . $e->getMessage();
            $programChairs = $faculty = $pendingUsers = $departments = [];
            $currentSemester = ['semester_name' => 'N/A', 'academic_year' => 'N/A'];
            require_once __DIR__ . '/../views/dean/faculty.php';
        }
    }

    private function handleUserAction($postData)
    {
        $action = $postData['action'] ?? null;
        $userId = filter_var($postData['user_id'] ?? null, FILTER_VALIDATE_INT);
        $departmentId = filter_var($postData['department_id'] ?? null, FILTER_VALIDATE_INT);
    
        if (!$action || !$userId) {
            error_log("handleUserAction: Missing action or user_id");
            return ['success' => false, 'error' => 'Invalid request data'];
        }
    
        try {
            switch ($action) {
                case 'activate':
                    $result = $this->userModel->updateUser($userId, ['is_active' => 1]);
                    if ($result) {
                        return ['success' => true, 'message' => 'User activated successfully'];
                    }
                    return ['success' => false, 'error' => 'Failed to activate user'];
                case 'deactivate':
                    $result = $this->userModel->deleteUser($userId);
                    if ($result) {
                        return ['success' => true, 'message' => 'User deactivated successfully'];
                    }
                    return ['success' => false, 'error' => 'Failed to deactivate user'];
                case 'promote':
                    if (!$departmentId) {
                        throw new Exception('Department ID is required for promotion');
                    }
                    $result = $this->userModel->promoteToProgramChair($userId, $departmentId);
                    return $result;
                case 'demote':
                    $result = $this->userModel->demoteProgramChair($userId);
                    return $result;
                default:
                    error_log("handleUserAction: Invalid action - $action");
                    return ['success' => false, 'error' => 'Invalid action'];
            }
        } catch (Exception $e) {
            error_log("handleUserAction: Error - " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // Assumed logActivity method (add to class if not present)
    private function logActivity($userId, $departmentId, $actionType, $actionDescription, $entityType, $entityId, $metadataId = null)
    {
        try {
            $stmt = $this->db->prepare("
            INSERT INTO activity_logs 
            (user_id, department_id, action_type, action_description, entity_type, entity_id, metadata_id, created_at) 
            VALUES (:user_id, :department_id, :action_type, :action_description, :entity_type, :entity_id, :metadata_id, NOW())
        ");
            $params = [
                ':user_id' => $userId,
                ':department_id' => $departmentId,
                ':action_type' => $actionType,
                ':action_description' => $actionDescription,
                ':entity_type' => $entityType,
                ':entity_id' => $entityId,
                ':metadata_id' => $metadataId
            ];
            error_log("Logging activity: Query = INSERT INTO activity_log ..., Params = " . json_encode($params));
            $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("logActivity: Failed to log activity - " . $e->getMessage());
        }
    }

    // Assumed helper method to get department_id for a user
    private function getUserDepartmentId($userId)
    {
        $query = "SELECT department_id FROM users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['department_id'] : null;
    }

    public function getDeanCollegeId($userId)
    {
        $query = "SELECT college_id FROM deans WHERE user_id = :user_id AND is_current = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['college_id'] ?? null;
    }

    public function search()
    {
        $userId = $_SESSION['user_id'];
        $collegeId = $this->getDeanCollegeId($userId);

        // Add this line before requiring the view
        $controller = $this;

        $results = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_term'])) {
            $searchTerm = '%' . $_POST['search_term'] . '%';
            $query = "
                SELECT u.*, f.academic_rank, d.department_name
                FROM users u
                JOIN faculty f ON u.user_id = f.user_id
                JOIN departments d ON f.department_id = d.department_id
                WHERE d.college_id = :college_id 
                AND (u.first_name LIKE :search_term OR u.last_name LIKE :search_term OR u.email LIKE :search_term)
                AND u.is_active = 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':college_id' => $collegeId,
                ':search_term' => $searchTerm
            ]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Load search view
        require_once __DIR__ . '/../views/dean/search.php';
    }

    public function courses()
    {
        $userId = $_SESSION['user_id'];
        $collegeId = $this->getDeanCollegeId($userId);

        // Initialize variables
        $courses = [];
        $departments = [];
        
        $totalCourses = 0;

        // Pagination parameters
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;

        if ($collegeId) {
            // Get filter parameters
            $departmentFilter = isset($_GET['department']) ? (int)$_GET['department'] : null;
            $programFilter = isset($_GET['program']) ? (int)$_GET['program'] : null;
            $yearLevelFilter = isset($_GET['year_level']) ? $_GET['year_level'] : null;
            $statusFilter = isset($_GET['status']) ? $_GET['status'] : '1';

            // Base query for counting
            $countQuery = "SELECT COUNT(*) as total 
                  FROM courses c
                  JOIN departments d ON c.department_id = d.department_id
                  WHERE d.college_id = :college_id";

            // Base query for data
            $query = "SELECT 
                c.course_id,
                c.course_code,
                c.course_name,
                c.units,
                c.lecture_hours,
                c.lab_hours,
                c.semester,
                c.is_active,
                d.department_name,
                p.program_name,
                p.program_code,
                cl.college_name
            FROM courses c
            JOIN departments d ON c.department_id = d.department_id
            LEFT JOIN programs p ON c.program_id = p.program_id
            JOIN colleges cl ON d.college_id = cl.college_id
            WHERE d.college_id = :college_id";

            // Add filters to both queries
            $params = [':college_id' => $collegeId];
            $countParams = [':college_id' => $collegeId];

            if ($departmentFilter) {
                $query .= " AND c.department_id = :department_id";
                $countQuery .= " AND c.department_id = :department_id";
                $params[':department_id'] = $departmentFilter;
                $countParams[':department_id'] = $departmentFilter;
            }

            if ($programFilter) {
                $query .= " AND c.program_id = :program_id";
                $countQuery .= " AND c.program_id = :program_id";
                $params[':program_id'] = $programFilter;
                $countParams[':program_id'] = $programFilter;
            }

            if ($statusFilter !== '') {
                $query .= " AND c.is_active = :is_active";
                $countQuery .= " AND c.is_active = :is_active";
                $params[':is_active'] = (int)$statusFilter;
                $countParams[':is_active'] = (int)$statusFilter;
            }

            // Get total count
            $countStmt = $this->db->prepare($countQuery);
            $countStmt->execute($countParams);
            $totalCourses = $countStmt->fetchColumn();

            // Add pagination to main query
            $query .= " ORDER BY d.department_name, c.course_code 
               LIMIT :offset, :per_page";

            // Calculate offset
            $offset = ($currentPage - 1) * $perPage;
            $params[':offset'] = $offset;
            $params[':per_page'] = $perPage;

            // Get paginated courses
            $stmt = $this->db->prepare($query);

            // Bind parameters with proper types
            foreach ($params as $key => $value) {
                $paramType = PDO::PARAM_STR;
                if (in_array($key, [':college_id', ':department_id', ':program_id', ':is_active', ':offset', ':per_page'])) {
                    $paramType = PDO::PARAM_INT;
                }
                $stmt->bindValue($key, $value, $paramType);
            }

            $stmt->execute();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get all departments in the college
            $deptQuery = "SELECT department_id, department_name 
                 FROM departments 
                 WHERE college_id = :college_id 
                 ORDER BY department_name";
            $deptStmt = $this->db->prepare($deptQuery);
            $deptStmt->execute([':college_id' => $collegeId]);
            $departments = $deptStmt->fetchAll(PDO::FETCH_ASSOC);

            // Get all programs in the college
            $programQuery = "SELECT p.program_id, p.program_name, p.program_code, d.department_name
                    FROM programs p
                    JOIN departments d ON p.department_id = d.department_id
                    WHERE d.college_id = :college_id
                    ORDER BY p.program_name";
            $programStmt = $this->db->prepare($programQuery);
            $programStmt->execute([':college_id' => $collegeId]);
            $programs = $programStmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Calculate total pages
        $totalPages = ceil($totalCourses / $perPage);

        // Load courses view with all data
        require_once __DIR__ . '/../views/dean/courses.php';
    }

    public function curriculum()
    {
        $userId = $_SESSION['user_id'];
        $collegeId = $this->getDeanCollegeId($userId);

        // Add this line before requiring the view
        $controller = $this;

        // Handle add curriculum
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_curriculum'])) {
            $this->addCurriculum($_POST, $collegeId);
        }

        // Handle curriculum approval
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approval_id'])) {
            $this->handleCurriculumApproval($_POST);
        }

        $curricula = [];
        if ($collegeId) {
            $query = "
                SELECT c.*, d.department_name
                FROM curricula c
                JOIN departments d ON c.department_id = d.department_id
                WHERE d.college_id = :college_id
                ORDER BY c.effective_year DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':college_id' => $collegeId]);
            $curricula = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Load curriculum view
        require_once __DIR__ . '/../views/dean/curriculum.php';
    }

    private function addCurriculum($data, $collegeId)
    {
        try {
            // Verify department belongs to Dean's college
            $query = "SELECT department_id FROM departments WHERE department_id = :department_id AND college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':department_id' => $data['department_id'],
                ':college_id' => $collegeId
            ]);
            if (!$stmt->fetch()) {
                error_log("Invalid department_id for college_id: $collegeId");
                header('Location: /dean/curriculum?error=Invalid department selected');
                exit;
            }

            $query = "
                INSERT INTO curricula (curriculum_name, department_id, effective_year, status, created_at, updated_at)
                VALUES (:curriculum_name, :department_id, :effective_year, 'Pending', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':curriculum_name' => $data['curriculum_name'],
                ':department_id' => $data['department_id'],
                ':effective_year' => $data['effective_year']
            ]);

            // Add to curriculum_approvals
            $curriculumId = $this->db->lastInsertId();
            $query = "
                INSERT INTO curriculum_approvals (curriculum_id, approval_level, status, created_at, updated_at)
                VALUES (:curriculum_id, 2, 'Pending', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':curriculum_id' => $curriculumId]);

            header('Location: /dean/curriculum?success=Curriculum added successfully');
        } catch (PDOException $e) {
            error_log("Error adding curriculum: " . $e->getMessage());
            header('Location: /dean/curriculum?error=Failed to add curriculum');
        }
    }

    private function handleCurriculumApproval($data)
    {
        try {
            $query = "
                UPDATE curriculum_approvals 
                SET status = :status, comments = :comments, updated_at = CURRENT_TIMESTAMP
                WHERE approval_id = :approval_id AND approval_level = 2";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':status' => $data['status'],
                ':comments' => $data['comments'] ?? null,
                ':approval_id' => $data['approval_id']
            ]);

            // Update curriculum status if approved
            if ($data['status'] === 'Approved') {
                $query = "
                    UPDATE curricula 
                    SET status = 'Active' 
                    WHERE curriculum_id = (
                        SELECT curriculum_id 
                        FROM curriculum_approvals 
                        WHERE approval_id = :approval_id
                    )";
                $stmt = $this->db->prepare($query);
                $stmt->execute([':approval_id' => $data['approval_id']]);
            }

            header('Location: /dean/curriculum?success=Curriculum approval processed');
        } catch (PDOException $e) {
            error_log("Error processing curriculum approval: " . $e->getMessage());
            header('Location: /dean/curriculum?error=Failed to process curriculum approval');
        }
    }

    public function searchCourses()
    {
        try {
            if (!$this->authService->isLoggedIn()) {
                http_response_code(401);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            $query = trim($_GET['query'] ?? '');
            if (strlen($query) < 2) {
                http_response_code(400);
                echo json_encode(['error' => 'Query must be at least 2 characters']);
                exit;
            }

            // Use positional parameters (?) instead
            $stmt = $this->db->prepare("
            SELECT c.course_id, c.course_code, c.course_name, d.department_name, co.college_name
            FROM courses c
            JOIN departments d ON c.department_id = d.department_id
            JOIN colleges co ON d.college_id = co.college_id
            WHERE UPPER(c.course_code) LIKE UPPER(?) OR UPPER(c.course_name) LIKE UPPER(?)
            LIMIT 10
        ");

            $searchTerm = "%" . strtoupper($query) . "%";
            error_log("searchCourses: Preparing query with positional parameters");
            error_log("searchCourses: Search term = $searchTerm");

            // Execute with array of parameters
            $stmt->execute([$searchTerm, $searchTerm]);
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            error_log("searchCourses: Query executed successfully, found " . count($courses) . " results");
            header('Content-Type: application/json');
            echo json_encode($courses);
        } catch (PDOException $e) {
            http_response_code(500);
            error_log("searchCourses: PDO Error - SQLSTATE[" . $e->getCode() . "]: " . $e->getMessage());
            error_log("searchCourses: Query: " . (isset($stmt) ? $stmt->queryString : 'Query not prepared'));
            error_log("searchCourses: Search term: " . (isset($searchTerm) ? $searchTerm : 'Not set'));
            echo json_encode(['error' => 'An error occurred while fetching courses: ' . $e->getMessage()]);
        } catch (Exception $e) {
            http_response_code(500);
            error_log("searchCourses: General Error - " . $e->getMessage());
            echo json_encode(['error' => 'An error occurred while fetching courses']);
        }
        exit;
    }

    public function profile()
    {
        try {
            if (!$this->authService->isLoggedIn()) {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Please log in to view your profile'];
                header('Location: /login');
                exit;
            }

            $userId = $_SESSION['user_id'];
            $csrfToken = $this->authService->generateCsrfToken();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!$this->authService->verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Invalid CSRF token'];
                    header('Location: /dean/profile');
                    exit;
                }

                $data = [
                    'email' => trim($_POST['email'] ?? ''),
                    'phone' => trim($_POST['phone'] ?? ''),
                    'username' => trim($_POST['username'] ?? ''),
                    'first_name' => trim($_POST['first_name'] ?? ''),
                    'middle_name' => trim($_POST['middle_name'] ?? ''),
                    'last_name' => trim($_POST['last_name'] ?? ''),
                    'suffix' => trim($_POST['suffix'] ?? ''),
                    'title' => trim($_POST['title'] ?? ''),
                    'classification' => trim($_POST['classification'] ?? ''),
                    'academic_rank' => trim($_POST['academic_rank'] ?? ''),
                    'employment_type' => trim($_POST['employment_type'] ?? ''),
                    'bachelor_degree' => trim($_POST['bachelor_degree'] ?? ''),
                    'master_degree' => trim($_POST['master_degree'] ?? ''),
                    'doctorate_degree' => trim($_POST['doctorate_degree'] ?? ''),
                    'post_doctorate_degree' => trim($_POST['post_doctorate_degree'] ?? ''),
                    'advisory_class' => trim($_POST['advisory_class'] ?? ''),
                    'designation' => trim($_POST['designation'] ?? ''),
                    'course_id' => trim($_POST['course_id'] ?? ''),
                    'specialization_index' => trim($_POST['specialization_index'] ?? ''),
                    'action' => trim($_POST['action'] ?? ''),
                ];

                $errors = [];

                try {
                    $this->db->beginTransaction();

                    $profilePictureResult = $this->handleProfilePictureUpload($userId);
                    $profilePicturePath = null;

                    if ($profilePictureResult !== null) {
                        if (strpos($profilePictureResult, 'Error:') === 0) {
                            $errors[] = $profilePictureResult;
                        } else {
                            $profilePicturePath = $profilePictureResult;
                        }
                    }

                    // Handle user profile updates only if fields are provided or profile picture uploaded
                    if (
                        !empty($data['email']) || !empty($data['first_name']) || !empty($data['last_name']) ||
                        !empty($data['phone']) || !empty($data['username']) || !empty($data['suffix']) ||
                        !empty($data['title']) || $profilePicturePath
                    ) {
                        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                            $errors[] = 'Valid email is required.';
                        }
                        if (!empty($data['phone']) && !preg_match('/^\d{10,12}$/', $data['phone'])) {
                            $errors[] = 'Phone number must be 10-12 digits.';
                        }

                        if (empty($errors)) {
                            $setClause = [];
                            $params = [':user_id' => $userId];
                            $validFields = ['email', 'phone', 'username', 'first_name', 'middle_name', 'last_name', 'suffix', 'title'];

                            foreach ($validFields as $field) {
                                if (isset($data[$field]) && $data[$field] !== '') {
                                    $setClause[] = "`$field` = :$field";
                                    $params[":$field"] = $data[$field];
                                }
                            }

                            if ($profilePicturePath) {
                                $setClause[] = "`profile_picture` = :profile_picture";
                                $params[":profile_picture"] = $profilePicturePath;
                            }

                            if (!empty($setClause)) {
                                $userStmt = $this->db->prepare("UPDATE users SET " . implode(', ', $setClause) . ", updated_at = NOW() WHERE user_id = :user_id");

                                if (!$userStmt->execute($params)) {
                                    $errorInfo = $userStmt->errorInfo();
                                    error_log("profile: User update failed - " . print_r($errorInfo, true));
                                    throw new Exception("Failed to update user profile");
                                }
                                error_log("profile: User profile updated successfully");
                            }
                        }
                    }

                    // Get faculty ID
                    $facultyStmt = $this->db->prepare("SELECT faculty_id FROM faculty WHERE user_id = :user_id");
                    $facultyStmt->execute([':user_id' => $userId]);
                    $facultyId = $facultyStmt->fetchColumn();
                    error_log("profile: Retrieved faculty_id for user_id $userId: $facultyId");

                    if (!$facultyId) {
                        error_log("profile: No faculty record found for user_id $userId");
                        throw new Exception("Faculty record not found for this user");
                    }

                    // Handle faculty updates
                    if ($facultyId && empty($errors)) {
                        $facultyParams = [':faculty_id' => $facultyId];
                        $facultySetClause = [];
                        $facultyFields = [
                            'academic_rank',
                            'employment_type',
                            'classification',
                            'designation',
                            'advisory_class',
                            'bachelor_degree',
                            'master_degree',
                            'doctorate_degree',
                            'post_doctorate_degree'
                        ];
                        foreach ($facultyFields as $field) {
                            if (isset($data[$field]) && $data[$field] !== '') {
                                $facultySetClause[] = "$field = :$field";
                                $facultyParams[":$field"] = $data[$field];
                            }
                        }

                        if (!empty($facultySetClause)) {
                            $updateFacultyStmt = $this->db->prepare("UPDATE faculty SET " . implode(', ', $facultySetClause) . ", updated_at = NOW() WHERE faculty_id = :faculty_id");
                            error_log("profile: Faculty query - " . $updateFacultyStmt->queryString . ", Params: " . print_r($facultyParams, true));
                            if (!$updateFacultyStmt->execute($facultyParams)) {
                                $errorInfo = $updateFacultyStmt->errorInfo();
                                error_log("profile: Faculty update failed - " . print_r($errorInfo, true));
                                throw new Exception("Failed to update faculty information");
                            }
                        }

                        // Handle specialization actions
                        if (!empty($data['action'])) {
                            switch ($data['action']) {
                                case 'add_specialization':
                                    if (!empty($data['course_id'])) {
                                        // Check if specialization already exists
                                        $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM specializations WHERE faculty_id = :faculty_id AND course_id = :course_id");
                                        $checkStmt->execute([':faculty_id' => $facultyId, ':course_id' => $data['course_id']]);
                                        $exists = $checkStmt->fetchColumn();

                                        if ($exists > 0) {
                                            $errors[] = 'You already have this specialization.';
                                            break;
                                        }

                                        $insertSpecializationStmt = $this->db->prepare("
                                        INSERT INTO specializations (faculty_id, course_id, created_at)
                                        VALUES (:faculty_id, :course_id, NOW())
                                    ");
                                        $specializationParams = [
                                            ':faculty_id' => $facultyId,
                                            ':course_id' => $data['course_id'],
                                        ];
                                        error_log("profile: Add specialization query - " . $insertSpecializationStmt->queryString . ", Params: " . print_r($specializationParams, true));

                                        if (!$insertSpecializationStmt->execute($specializationParams)) {
                                            $errorInfo = $insertSpecializationStmt->errorInfo();
                                            error_log("profile: Add specialization failed - " . print_r($errorInfo, true));
                                            throw new Exception("Failed to add specialization");
                                        }
                                        error_log("profile: Successfully added specialization");
                                    } else {
                                        $errors[] = 'Course is required to add specialization.';
                                    }
                                    break;

                                case 'remove_specialization':
                                    if (!empty($data['course_id'])) {
                                        error_log("profile: Attempting to remove specialization with course_id: " . $data['course_id'] . ", faculty_id: $facultyId");

                                        $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM specializations WHERE faculty_id = :faculty_id AND course_id = :course_id");
                                        $checkStmt->execute([':faculty_id' => $facultyId, ':course_id' => $data['course_id']]);
                                        $recordExists = $checkStmt->fetchColumn();
                                        error_log("profile: Records found for deletion: $recordExists");

                                        if ($recordExists > 0) {
                                            $deleteStmt = $this->db->prepare("DELETE FROM specializations WHERE faculty_id = :faculty_id AND course_id = :course_id");
                                            $deleteParams = [
                                                ':faculty_id' => $facultyId,
                                                ':course_id' => $data['course_id'],
                                            ];
                                            error_log("profile: Remove specialization query - " . $deleteStmt->queryString . ", Params: " . print_r($deleteParams, true));

                                            if ($deleteStmt->execute($deleteParams)) {
                                                $affectedRows = $deleteStmt->rowCount();
                                                error_log("profile: Successfully deleted $affectedRows rows");
                                                if ($affectedRows === 0) {
                                                    error_log("profile: Warning - No rows were affected by delete operation");
                                                    $errors[] = 'No specialization was removed. It may have already been deleted.';
                                                }
                                            } else {
                                                $errorInfo = $deleteStmt->errorInfo();
                                                error_log("profile: Delete failed - " . print_r($errorInfo, true));
                                                throw new Exception("Failed to execute delete query: " . $errorInfo[2]);
                                            }
                                        } else {
                                            error_log("profile: No record found for deletion");
                                            $errors[] = 'Specialization not found for removal.';
                                        }
                                    } else {
                                        $errors[] = 'Course ID is required to remove specialization.';
                                    }
                                    break;

                                case 'edit_specialization':
                                    if (!empty($data['specialization_index'])) {
                                        error_log("profile: Edit specialization triggered for index: " . $data['specialization_index']);
                                        // No database update needed here, just trigger the modal
                                    }
                                    break;

                                default:
                                    error_log("profile: Unknown action: " . $data['action']);
                                    break;
                            }
                        }
                    }

                    // If there are validation errors, rollback and don't commit
                    if (!empty($errors)) {
                        $this->db->rollBack();
                        error_log("profile: Validation errors found, rolling back transaction: " . implode(', ', $errors));
                    } else {
                        $this->db->commit();
                        error_log("profile: Transaction committed successfully");

                        $_SESSION['username'] = $data['username'] ?: $_SESSION['username'];
                        $_SESSION['last_name'] = $data['last_name'] ?: $_SESSION['last_name'];
                        $_SESSION['middle_name'] = $data['middle_name'] ?: $_SESSION['middle_name'];
                        $_SESSION['suffix'] = $data['suffix'] ?: $_SESSION['suffix'];
                        $_SESSION['title'] = $data['title'] ?: $_SESSION['title'];
                        $_SESSION['first_name'] = $data['first_name'] ?: $_SESSION['first_name'];
                        $_SESSION['email'] = $data['email'] ?: $_SESSION['email'];

                        if ($profilePicturePath) {
                            $_SESSION['profile_picture'] = $profilePicturePath;
                            error_log("profile: Updated session profile_picture to: " . $profilePicturePath);
                        }

                        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Profile updated successfully'];
                    }
                } catch (PDOException $e) {
                    if ($this->db->inTransaction()) {
                        $this->db->rollBack();
                    }
                    error_log("profile: PDO Database error - " . $e->getMessage());
                    $errors[] = 'Database error occurred: ' . $e->getMessage();
                } catch (Exception $e) {
                    if ($this->db->inTransaction()) {
                        $this->db->rollBack();
                    }
                    error_log("profile: General error - " . $e->getMessage());
                    $errors[] = $e->getMessage();
                }

                if (!empty($errors)) {
                    $_SESSION['flash'] = ['type' => 'error', 'message' => implode('<br>', $errors)];
                }

                header('Location: /dean/profile');
                exit;
            }

            // GET request - Display profile
            $stmt = $this->db->prepare("
            SELECT u.*, d.department_name, c.college_name, r.role_name,
                   f.academic_rank, f.employment_type, f.classification, f.bachelor_degree, f.master_degree,
                   f.doctorate_degree, f.post_doctorate_degree, f.advisory_class, f.designation
            FROM users u
            LEFT JOIN departments d ON u.department_id = d.department_id
            LEFT JOIN colleges c ON u.college_id = c.college_id
            LEFT JOIN roles r ON u.role_id = r.role_id
            LEFT JOIN faculty f ON u.user_id = f.user_id
            WHERE u.user_id = :user_id
        ");
            $stmt->execute([':user_id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new Exception('User not found.');
            }

            $specializationStmt = $this->db->prepare("
            SELECT s.expertise_level AS level, c.course_code, c.course_name, s.course_id
            FROM specializations s
            JOIN courses c ON s.course_id = c.course_id
            WHERE s.faculty_id = (SELECT faculty_id FROM faculty WHERE user_id = :user_id)
            ORDER BY c.course_code
        ");
            $specializationStmt->execute([':user_id' => $userId]);
            $specializations = $specializationStmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch user data and stats...
            $stmt = $this->db->prepare("
            SELECT u.*, d.department_name, c.college_name, r.role_name,
                   f.academic_rank, f.employment_type, f.classification, f.bachelor_degree, f.master_degree,
                   f.doctorate_degree, f.post_doctorate_degree, f.advisory_class, f.designation,
                   (SELECT COUNT(*) FROM faculty f2 JOIN users fu ON f2.user_id = fu.user_id WHERE fu.department_id = u.department_id) as facultyCount,
                   (SELECT COUNT(DISTINCT sch.course_id) FROM schedules sch WHERE sch.faculty_id = f.faculty_id) as coursesCount,
                   (SELECT COUNT(*) FROM specializations s2 WHERE s2.faculty_id = f.faculty_id) as specializationsCount,
                   (SELECT COUNT(*) FROM faculty_requests fr WHERE fr.department_id = u.department_id AND fr.status = 'pending') as pendingApplicantsCount,
                   (SELECT semester_name FROM semesters WHERE is_current = 1) as currentSemester,
                   (SELECT created_at FROM auth_logs WHERE user_id = u.user_id AND action = 'login_success' ORDER BY created_at DESC LIMIT 1) as lastLogin
            FROM users u
            LEFT JOIN departments d ON u.department_id = d.department_id
            LEFT JOIN colleges c ON u.college_id = c.college_id
            LEFT JOIN roles r ON u.role_id = r.role_id
            LEFT JOIN faculty f ON u.user_id = f.user_id
            WHERE u.user_id = :user_id
        ");
            $stmt->execute([':user_id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new Exception('User not found.');
            }

            // Extract stats
            $facultyCount = $user['facultyCount'] ?? 0;
            $coursesCount = $user['coursesCount'] ?? 0;
            $specializationsCount = $user['specializationsCount'] ?? 0;
            $pendingApplicantsCount = $user['pendingApplicantsCount'] ?? 0;
            $currentSemester = $user['currentSemester'] ?? '2nd';
            $lastLogin = $user['lastLogin'] ?? 'N/A';

            require_once __DIR__ . '/../views/dean/profile.php';
        } catch (Exception $e) {
            if (isset($this->db) && $this->db->inTransaction()) {
                $this->db->rollBack();
            }

            error_log("profile: Error - " . $e->getMessage());
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Failed to load or update profile. Please try again.'];

            $user = [
                'user_id' => $userId ?? 0,
                'username' => '',
                'first_name' => '',
                'last_name' => '',
                'middle_name' => '',
                'suffix' => '',
                'email' => '',
                'phone' => '',
                'title' => '',
                'profile_picture' => '',
                'employee_id' => '',
                'department_name' => '',
                'college_name' => '',
                'role_name' => 'College Dean',
                'academic_rank' => '',
                'employment_type' => '',
                'classification' => '',
                'bachelor_degree' => '',
                'master_degree' => '',
                'doctorate_degree' => '',
                'post_doctorate_degree' => '',
                'advisory_class' => '',
                'designation' => '',
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $specializations = [];
            require_once __DIR__ . '/../views/dean/profile.php';
        }
    }

    private function handleProfilePictureUpload($userId)
    {
        if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] == UPLOAD_ERR_NO_FILE) {
            error_log("profile: No file uploaded for user_id: $userId");
            return null;
        }

        $file = $_FILES['profile_picture'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            error_log("profile: Invalid file type for user_id: $userId - " . $file['type']);
            return "Error: Only JPEG, PNG, and GIF files are allowed.";
        }

        if ($file['size'] > $maxSize) {
            error_log("profile: File size exceeds limit for user_id: $userId - " . $file['size']);
            return "Error: File size exceeds 2MB limit.";
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = "profile_{$userId}_" . time() . ".{$ext}";
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/profile_pictures/'; // Public-accessible path
        $uploadPath = $uploadDir . $filename;

        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                error_log("profile: Failed to create upload directory: $uploadDir");
                return "Error: Failed to create upload directory.";
            }
        }

        // Remove existing profile picture
        $stmt = $this->db->prepare("SELECT profile_picture FROM users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        $currentPicture = $stmt->fetchColumn();
        if ($currentPicture && file_exists($_SERVER['DOCUMENT_ROOT'] . $currentPicture)) {
            if (!unlink($_SERVER['DOCUMENT_ROOT'] . $currentPicture)) {
                error_log("profile: Failed to delete existing profile picture: $currentPicture");
            }
        }

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            error_log("profile: Successfully uploaded file to $uploadPath for user_id: $userId");
            return "/uploads/profile_pictures/{$filename}";
        } else {
            error_log("profile: Failed to move uploaded file for user_id: $userId to $uploadPath - Check permissions or disk space");
            return "Error: Failed to upload file.";
        }
    }

    public function settings()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            error_log("settings: No user_id in session");
            http_response_code(401);
            return ['error' => 'No user session'];
        }

        $collegeId = $this->getDeanCollegeId($userId);
        if (!$collegeId) {
            error_log("settings: No college found for dean user_id: $userId");
            http_response_code(403);
            return ['error' => 'No college assigned to this dean'];
        }

        $controller = $this;
        $error = null;
        $success = null;

        try {
            // Generate CSRF token
            if (!isset($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }

            // Handle POST actions
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Validate CSRF token
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    error_log("settings: Invalid CSRF token");
                    $error = "Invalid request";
                    http_response_code(403);
                } else {
                    if (isset($_POST['update_settings'])) {
                        $result = $this->updateSettings($_POST, $collegeId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    } elseif (isset($_POST['add_department'])) {
                        $result = $this->addDepartment($_POST, $collegeId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    } elseif (isset($_POST['edit_department'])) {
                        $result = $this->editDepartment($_POST, $collegeId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    } elseif (isset($_POST['delete_department'])) {
                        $result = $this->deleteDepartment($_POST, $collegeId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    } elseif (isset($_POST['add_program'])) {
                        $result = $this->addProgram($_POST, $collegeId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    } elseif (isset($_POST['edit_program'])) {
                        $result = $this->editProgram($_POST, $collegeId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    } elseif (isset($_POST['delete_program'])) {
                        $result = $this->deleteProgram($_POST, $collegeId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    } elseif (isset($_POST['change_password'])) {
                        $result = $this->changePassword($_POST, $userId);
                        if (isset($result['error'])) {
                            $error = $result['error'];
                        } else {
                            $success = $result['success'];
                        }
                    }
                }
            }

            // Fetch college details
            $query = "SELECT college_name, logo_path FROM colleges WHERE college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':college_id' => $collegeId]);
            $college = $stmt->fetch(PDO::FETCH_ASSOC) ?: ['college_name' => '', 'logo_path' => null];

            // Fetch departments
            $query = "SELECT department_id, department_name FROM departments WHERE college_id = :college_id ORDER BY department_name";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':college_id' => $collegeId]);
            $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch programs
            $query = "
                SELECT p.program_id, p.program_code, p.program_name, p.department_id, d.department_name
                FROM programs p
                JOIN departments d ON p.department_id = d.department_id
                WHERE d.college_id = :college_id AND p.is_active = 1
                ORDER BY d.department_name, p.program_name";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':college_id' => $collegeId]);
            $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Load settings view
            require_once __DIR__ . '/../views/dean/settings.php';
        } catch (PDOException $e) {
            error_log("settings: PDO Error - " . $e->getMessage());
            $error = "Database error occurred";
            http_response_code(500);
            require_once __DIR__ . '/../views/dean/settings.php';
        } catch (Exception $e) {
            error_log("settings: Error - " . $e->getMessage());
            $error = $e->getMessage();
            http_response_code(500);
            require_once __DIR__ . '/../views/dean/settings.php';
        }
    }

    // Add this method for password change
    private function changePassword($data, $userId)
    {
        try {
            $currentPassword = trim($data['current_password'] ?? '');
            $newPassword = trim($data['new_password'] ?? '');
            $confirmPassword = trim($data['confirm_password'] ?? '');

            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                return ['error' => 'All password fields are required'];
            }

            if ($newPassword !== $confirmPassword) {
                return ['error' => 'New password and confirmation do not match'];
            }

            if (strlen($newPassword) < 8) {
                return ['error' => 'New password must be at least 8 characters'];
            }

            // Fetch current password hash
            $stmt = $this->db->prepare("SELECT password_hash FROM users WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $userId]);
            $hash = $stmt->fetchColumn();

            if (!$hash || !password_verify($currentPassword, $hash)) {
                return ['error' => 'Current password is incorrect'];
            }

            // Update password
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET password_hash = :password_hash, updated_at = NOW() WHERE user_id = :user_id");
            $stmt->execute([':password' => $newHash, ':user_id' => $userId]);

            return ['success' => 'Password changed successfully'];
        } catch (PDOException $e) {
            error_log("changePassword: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to change password'];
        }
    }

    private function updateSettings($data, $collegeId)
    {
        try {
            // Validate college name
            $collegeName = trim($data['college_name'] ?? '');
            if (empty($collegeName) || strlen($collegeName) > 100) {
                error_log("Invalid college name provided");
                return ['error' => 'College name must be 1-100 characters'];
            }

            // Handle logo upload
            $logoPath = null;
            if (isset($_FILES['college_logo']) && $_FILES['college_logo']['error'] != UPLOAD_ERR_NO_FILE) {
                $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                $maxSize = 2 * 1024 * 1024; // 2MB
                $fileType = $_FILES['college_logo']['type'];
                $fileSize = $_FILES['college_logo']['size'];

                if (!in_array($fileType, $allowedTypes)) {
                    error_log("Invalid file type for college logo");
                    return ['error' => 'Invalid file type. Use PNG, JPEG, or GIF'];
                }

                if ($fileSize > $maxSize) {
                    error_log("College logo file too large: $fileSize bytes");
                    return ['error' => 'File size exceeds 2MB limit'];
                }

                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/logo/college_logo/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = 'college_' . $collegeId . '_' . time() . '.' . pathinfo($_FILES['college_logo']['name'], PATHINFO_EXTENSION);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['college_logo']['tmp_name'], $uploadPath)) {
                    $logoPath = '/assets/logo/college_logo/' . $fileName;
                } else {
                    error_log("Failed to move uploaded college logo");
                    return ['error' => 'Failed to upload logo'];
                }
            }

            // Update college details
            $query = "
                UPDATE colleges 
                SET college_name = :college_name" . ($logoPath ? ", logo_path = :logo_path" : "") . "
                WHERE college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $params = [
                ':college_name' => $collegeName,
                ':college_id' => $collegeId
            ];
            if ($logoPath) {
                $params[':logo_path'] = $logoPath;
            }
            $stmt->execute($params);

            return ['success' => 'Settings updated successfully'];
        } catch (PDOException $e) {
            error_log("updateSettings: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to update settings'];
        }
    }

    private function addDepartment($data, $collegeId)
    {
        try {
            $departmentName = trim($data['department_name'] ?? '');
            if (empty($departmentName) || strlen($departmentName) > 100) {
                error_log("Invalid department name provided");
                return ['error' => 'Department name must be 1-100 characters'];
            }

            // Check if department exists
            $query = "SELECT COUNT(*) FROM departments WHERE department_name = :department_name AND college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_name' => $departmentName, ':college_id' => $collegeId]);
            if ($stmt->fetchColumn() > 0) {
                error_log("Department already exists: $departmentName");
                return ['error' => 'Department already exists'];
            }

            // Insert department
            $query = "INSERT INTO departments (department_name, college_id) VALUES (:department_name, :college_id)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_name' => $departmentName, ':college_id' => $collegeId]);

            return ['success' => 'Department added successfully'];
        } catch (PDOException $e) {
            error_log("addDepartment: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to add department'];
        }
    }

    private function editDepartment($data, $collegeId)
    {
        try {
            $departmentId = intval($data['department_id'] ?? 0);
            $departmentName = trim($data['department_name'] ?? '');
            if (empty($departmentName) || strlen($departmentName) > 100) {
                error_log("Invalid department name provided");
                return ['error' => 'Department name must be 1-100 characters'];
            }

            // Verify department belongs to college
            $query = "SELECT COUNT(*) FROM departments WHERE department_id = :department_id AND college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_id' => $departmentId, ':college_id' => $collegeId]);
            if ($stmt->fetchColumn() == 0) {
                error_log("Department not found or unauthorized: $departmentId");
                return ['error' => 'Department not found'];
            }

            // Update department
            $query = "UPDATE departments SET department_name = :department_name WHERE department_id = :department_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_name' => $departmentName, ':department_id' => $departmentId]);

            return ['success' => 'Department updated successfully'];
        } catch (PDOException $e) {
            error_log("editDepartment: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to update department'];
        }
    }

    private function deleteDepartment($data, $collegeId)
    {
        try {
            $departmentId = intval($data['department_id'] ?? 0);

            // Verify department belongs to college
            $query = "SELECT COUNT(*) FROM departments WHERE department_id = :department_id AND college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_id' => $departmentId, ':college_id' => $collegeId]);
            if ($stmt->fetchColumn() == 0) {
                error_log("Department not found or unauthorized: $departmentId");
                return ['error' => 'Department not found'];
            }

            // Check for dependent programs
            $query = "SELECT COUNT(*) FROM programs WHERE department_id = :department_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_id' => $departmentId]);
            if ($stmt->fetchColumn() > 0) {
                error_log("Cannot delete department with programs: $departmentId");
                return ['error' => 'Cannot delete department with associated programs'];
            }

            // Delete department
            $query = "DELETE FROM departments WHERE department_id = :department_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_id' => $departmentId]);

            return ['success' => 'Department deleted successfully'];
        } catch (PDOException $e) {
            error_log("deleteDepartment: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to delete department'];
        }
    }

    private function addProgram($data, $collegeId)
    {
        try {
            $programName = trim($data['program_name'] ?? '');
            $departmentId = intval($data['department_id'] ?? 0);
            if (empty($programName) || strlen($programName) > 100) {
                error_log("Invalid program name provided");
                return ['error' => 'Program name must be 1-100 characters'];
            }
            if ($departmentId <= 0) {
                error_log("Invalid department ID provided");
                return ['error' => 'Invalid department selected'];
            }
            $programCode = trim($data['program_code'] ?? '');

            // Verify department belongs to college
            $query = "SELECT COUNT(*) FROM departments WHERE department_id = :department_id AND college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':department_id' => $departmentId, ':college_id' => $collegeId]);
            if ($stmt->fetchColumn() == 0) {
                error_log("Department not found or unauthorized: $departmentId");
                return ['error' => 'Department not found'];
            }

            // Check if program exists
            $query = "SELECT COUNT(*) FROM programs WHERE program_code = :program_code, program_name = :program_name AND department_id = :department_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':program_name' => $programName, ':department_id' => $departmentId]);
            if ($stmt->fetchColumn() > 0) {
                error_log("Program already exists: $programName");
                return ['error' => 'Program already exists in this department'];
            }

            // Insert program
            $query = "INSERT INTO programs (program_code, program_name, department_id, is_active) VALUES (program_code: :program_name, :department_id, 1)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':program_name' => $programName, ':department_id' => $departmentId]);

            return ['success' => 'Program added successfully'];
        } catch (PDOException $e) {
            error_log("addProgram: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to add program'];
        }
    }

    private function editProgram($data, $collegeId)
    {
        try {
            $programId = intval($data['program_id'] ?? 0);
            $programName = trim($data['program_name'] ?? '');
            $programCode = trim($data['program_code'] ?? '');
            $departmentId = intval($data['department_id'] ?? 0);
            if (empty($programName) || strlen($programName) > 100) {
                error_log("Invalid program name provided");
                return ['error' => 'Program name must be 1-100 characters'];
            }
            if ($departmentId <= 0) {
                error_log("Invalid department ID provided");
                return ['error' => 'Invalid department selected'];
            }

            // Verify program and department
            $query = "
                SELECT COUNT(*) 
                FROM programs p
                JOIN departments d ON p.department_id = d.department_id
                WHERE p.program_id = :program_id AND d.college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':program_id' => $programId, ':college_id' => $collegeId]);
            if ($stmt->fetchColumn() == 0) {
                error_log("Program not found or unauthorized: $programId");
                return ['error' => 'Program not found'];
            }

            // Update program
            $query = "UPDATE programs SET program_code = program_code: program_name = :program_name, department_id = :department_id WHERE program_id = :program_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':program_code' => $programCode,
                ':program_name' => $programName,
                ':department_id' => $departmentId,
                ':program_id' => $programId
            ]);

            return ['success' => 'Program updated successfully'];
        } catch (PDOException $e) {
            error_log("editProgram: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to update program'];
        }
    }

    private function deleteProgram($data, $collegeId)
    {
        try {
            $programId = intval($data['program_id'] ?? 0);

            // Verify program
            $query = "
                SELECT COUNT(*) 
                FROM programs p
                JOIN departments d ON p.department_id = d.department_id
                WHERE p.program_id = :program_id AND d.college_id = :college_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':program_id' => $programId, ':college_id' => $collegeId]);
            if ($stmt->fetchColumn() == 0) {
                error_log("Program not found or unauthorized: $programId");
                return ['error' => 'Program not found'];
            }

            // Delete program
            $query = "DELETE FROM programs WHERE program_id = :program_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':program_id' => $programId]);

            return ['success' => 'Program deleted successfully'];
        } catch (PDOException $e) {
            error_log("deleteProgram: PDO Error - " . $e->getMessage());
            return ['error' => 'Failed to delete program'];
        }
    }
}
