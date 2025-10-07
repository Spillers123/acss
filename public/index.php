<?php
require __DIR__ . '/../vendor/autoload.php';

// Load environment
Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

// Initialize secure session
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => isset($_SERVER['HTTPS']),
    'cookie_httponly' => true,
    'use_strict_mode' => true
]);

// Include middleware
require_once __DIR__ . '/../src/middleware/AuthMiddleware.php';

// Define route handler functions
function handleAdminRoutes($path)
{
    error_log("Entering handleAdminRoutes with path: $path");
    AuthMiddleware::handle('admin'); // Require admin role

    require_once __DIR__ . '/../src/controllers/AdminController.php';
    $controller = new AdminController();

    // Normalize path for comparison
    $normalizedPath = '/' . trim($path, '/');
    error_log("Normalized path: $normalizedPath");

    switch ($normalizedPath) {
        case '/admin/dashboard':
            error_log("Routing to AdminController::dashboard");
            $controller->dashboard();
            break;
        case '/admin/act_logs':
            error_log("Routing to AdminController::activityLogs");
            $controller->activityLogs();
            break;
        case '/admin/schedule':
            error_log("Routing to AdminController::schedule");
            $controller->mySchedule();
            break;
        case '/admin/users':
        case '/admin/edit_user':
            error_log("Routing to AdminController::users");
            $controller->manageUsers();
            break;
        case '/admin/colleges':
        case '/admin/departments': // Redirect departments to colleges
            error_log("Routing to AdminController::collegesDepartments");
            $controller->collegesDepartments();
            break;
        case '/admin/colleges_departments/create':
            error_log("Routing to AdminController::createCollegeDepartment");
            $controller->createCollegeDepartment();
            break;
        case '/admin/colleges_departments/update':
            error_log("Routing to AdminController::update college/departments");
            break;
        case '/admin/classroom':
            error_log("Routing to AdminController::classroom");
            $controller->classroom();
            break;
        case '/admin/faculty':
            error_log("Routing to AdminController::faculty");
            $controller->faculty();
            break;
        case '/admin/faculty/create':
            error_log("Routing to AdminController::createFaculty");
            $controller->createFaculty();
            break;
        case '/admin/schedules':
            error_log("Routing to AdminController::schedules");
            $controller->schedules();
            break;
        case '/admin/profile':
            error_log("Routing to AdminController::profile");
            $controller->profile();
            break;
        case '/admin/settings':
            error_log("Routing to AdminController::settings");
            $controller->settings();
            break;
        case '/admin/logout':
            error_log("Routing to AuthController::logout");
            require_once __DIR__ . '/../src/controllers/AuthController.php';
            (new AuthController())->logout();
            exit;
        default:
            error_log("No matching admin route for: $normalizedPath");
            http_response_code(404);
            echo "404 Not Found: $normalizedPath";
            exit;
    }
}

function handleVpaaRoutes($path)
{
    AuthMiddleware::handle('vpaa'); // Require vpaa role
    http_response_code(404);
    echo "VPAA routes not implemented";
    exit;
}

function handleDirectorRoutes($path)
{
    error_log("Entering handleDirectorRoutes with path: $path");
    AuthMiddleware::handle('di'); // Require di role

    require_once __DIR__ . '/../src/controllers/DirectorController.php';
    $controller = new DirectorController();

    // Normalize path for comparison
    $normalizedPath = '/' . trim($path, '/');
    error_log("Normalized path: $normalizedPath");

    switch ($normalizedPath) {
        case '/director/dashboard':
            error_log("Routing to DirectorController::dashboard");
            $controller->dashboard();
            break;
        case '/director/schedule':
            error_log("Routing to DirectorController::mySchedule");
            $controller->mySchedule();
            break;
        case '/director/monitor':
            error_log("Routing to DirectorController::monitoring");
            $controller->monitor();
            break;
        case '/director/profile':
            error_log("Routing to DirectorController::profile");
            $controller->profile();
            break;
        case '/director/schedule_deadline':
            error_log("Routing to DirectorController::setSchedule");
            $controller->setScheduleDeadline();
            break;
        case '/director/logout':
            error_log("Routing to AuthController::logout");
            require_once __DIR__ . '/../src/controllers/AuthController.php';
            (new AuthController())->logout();
            exit;
        default:
            http_response_code(404);
            echo "Page not found";
            exit;
    }
   
}

function handleDeanRoutes($path)
{
    error_log("Entering handleDeanRoutes with path: $path");
    AuthMiddleware::handle('dean'); // Require dean role

    require_once __DIR__ . '/../src/controllers/DeanController.php';
    $controller = new DeanController();

    // Normalize path for comparison
    $normalizedPath = '/' . trim($path, '/');
    error_log("Normalized path: $normalizedPath");

    switch ($normalizedPath) {
        case '/dean/dashboard':
            $controller->dashboard();
            break;
        case '/dean/schedule':
            $controller->mySchedule();
            break;
        case '/dean/manage_schedules':
            $controller->manageSchedule();
            break;
        case '/dean/activities':
            $controller->activities();  
            break;
        case '/dean/classroom':
            $controller->classroom();
            break;
        case '/dean/faculty':
            $controller->faculty();
            break;
        case '/dean/search':
            $controller->search();
            break;
        case '/dean/courses':
            $controller->courses();
            break;
        case '/dean/curriculum':
            $controller->curriculum();
            break;
        case '/dean/profile':
            $controller->profile();
            break;
        case '/dean/profile/search_courses':
            $controller->searchCourses();
            exit;
        case '/dean/settings':
            $controller->settings();
            break;
        case '/dean/logout':
            error_log("Routing to AuthController::logout");
            require_once __DIR__ . '/../src/controllers/AuthController.php';
            (new AuthController())->logout();
            exit;
        default:
            http_response_code(404);
            echo "Page not found";
            exit;
    }
}

function handleChairRoutes($path)
{
    error_log("Entering handleChairRoutes with path: $path");
    AuthMiddleware::handle('chair');

    require_once __DIR__ . '/../src/controllers/ChairController.php';
    $controller = new ChairController();

    // Normalize path for comparison
    $normalizedPath = '/' . trim($path, '/');
    error_log("Normalized path: $normalizedPath");

    switch ($normalizedPath) {
        case '/chair/dashboard':
            error_log("Routing to ChairController::dashboard");
            $controller->dashboard();
            exit;
        case '/chair/my_schedule':
            error_log("Routing to ChairController::my_schedule");
            $controller->mySchedule();
            exit;
        case '/chair/schedule_management':
            error_log("Routing to ChairController::createSchedule");
            $controller->manageSchedule();
            exit;
        case '/chair/generate-schedules':
            error_log("Routing to ChairController::generateSchedule");
            $controller->generateSchedulesAjax();
            exit;
        case '/chair/delete-all-schedules':
            error_log("Routing to ChairController::delete all schedules");
            $controller->deleteAllSchedules();
            break;
        case '/chair/schedule_history':
            error_log("Routing to ChairController::scheduleHistory");
            $controller->viewScheduleHistory();
            exit;
        case '/chair/classroom':
            error_log("Routing to ChairController::classroom");
            $controller->classroom();
            exit;
        case '/chair/sections':
            error_log("Routing to ChairController::sections");
            $controller->sections();
            exit;
        case '/chair/faculty':
            error_log("Routing to ChairController::faculty");
            $controller->faculty();
            exit;
        case '/chair/faculty/search':
            error_log("Routing to ChairController::search");
            $controller->search();
            exit;
        case '/chair/courses':
            error_log("Routing to ChairController::courses");
            $controller->courses();
            exit;
        case '/chair/checkCourseCode': // New route for AJAX check
            error_log("Routing to ChairController::checkCourseCode");
            $controller->checkCourseCode();
            break;
        case '/chair/curriculum':
            error_log("Routing to ChairController::curriculum");
            $controller->curriculum();
            exit;
        case '/chair/profile':
            error_log("Routing to ChairController::profile");
            $controller->profile();
            exit;
        case '/chair/profile/search_courses':
            error_log("Routing to ChairController::profile");
            $controller->searchCourses();
            exit;
        case '/chair/settings':
            error_log("Routing to ChairController::settings");
            $controller->settings();
            exit;
        case '/chair/logout':
            error_log("Routing to AuthController::logout");
            require_once __DIR__ . '/../src/controllers/AuthController.php';
            (new AuthController())->logout();
            exit;
        default:
            error_log("No matching chair route for: $normalizedPath");
            http_response_code(404);
            echo "404 Not Found: $normalizedPath";
            exit;
    }
}

function handleFacultyRoutes($path)
{
    error_log("Entering handleFacultyRoutes with path: $path");
    AuthMiddleware::handle('faculty'); // Require faculty role

    require_once __DIR__ . '/../src/controllers/FacultyController.php';
    $controller = new FacultyController();

    // Normalize path for comparison
    $normalizedPath = '/' . trim($path, '/');
    error_log("Normalized path: $normalizedPath");

    switch ($normalizedPath) {
        case '/faculty/dashboard':
            error_log("Routing to FacultyController::dashboard");
            $controller->dashboard();
            exit;
        case '/faculty/schedule':
            error_log("Routing to FacultyController::mySchedule");
            $controller->mySchedule();
            exit;
        case '/faculty/schedule/request':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                error_log("Routing to FacultyController::submitScheduleRequest (GET)");
                $controller->submitScheduleRequest();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Routing to FacultyController::submitScheduleRequest (POST)");
                $controller->submitScheduleRequest();
            }
            exit;
        case '/faculty/schedule/requests':
            error_log("Routing to FacultyController::getScheduleRequests");
            $controller->getScheduleRequests();
            exit;
        case '/faculty/profile':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                error_log("Routing to FacultyController::profile (GET)");
                $controller->profile();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Routing to FacultyController::profile (POST)");
                $controller->profile();
            }
            exit;
        case '/faculty/profile/search_courses':
            error_log("Routing to FacultyController::profile");
            $controller->searchCourses();
            exit;
        case '/faculty/logout':
            error_log("Routing to AuthController::logout");
            require_once __DIR__ . '/../src/controllers/AuthController.php';
            (new AuthController())->logout();
            exit;
        case '/faculty/settings':
            $controller->settings();
            exit;
        default:
            error_log("No matching faculty route for: $normalizedPath");
            http_response_code(404);
            echo "404 Not Found: $normalizedPath";
            exit;
    }
}

// Simple router
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Public routes that don't require authentication
$publicRoutes = ['login', 'register', '', 'home', 'public/search', 'public/departments', 'public/sections', 'forgot-password', 'api/departments'];

if (in_array($path, $publicRoutes)) {
    require_once __DIR__ . '/../src/controllers/AuthController.php';
    $controller = new AuthController();

    switch ($path) {
        case 'login':
            $controller->login();
            break;
        case 'register':
            $controller->register();
            break;
        case 'register-step2':
            $controller->register();
            break;
        case 'forgot-password':
            $controller->forgotPassword();
            break;
        case 'api/departments':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller->getDepartments();
            } else {
                http_response_code(405);
                echo "Method Not Allowed";
            }
            break;
        case '':
        case 'home':
            require_once __DIR__ . '/../src/controllers/PublicController.php';
            (new PublicController())->showHomepage();
            break;
        case 'public/search':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once __DIR__ . '/../src/controllers/PublicController.php';
                (new PublicController())->searchSchedules();
            } else {
                http_response_code(405);
                echo "Method Not Allowed";
            }
            break;
        case 'public/departments':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once __DIR__ . '/../src/controllers/PublicController.php';
                (new PublicController())->getDepartmentsByCollege();
            } else {
                http_response_code(405);
                echo "Method Not Allowed";
            }
            break;
        case 'public/sections':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once __DIR__ . '/../src/controllers/PublicController.php';
                (new PublicController())->getSectionsByDepartment();
            } else {
                http_response_code(405);
                echo "Method Not Allowed";
            }
            break;
        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }
    exit;
}

// Protected routes - require authentication
if (!isset($_SESSION['user_id'])) {
    error_log("User not authenticated, redirecting to /login");
    header('Location: /login');
    exit;
}

// Handle API routes before role-specific routes
if ($path === 'api/load_data') {
    error_log("Routing to ApiController::loadData for path: $path");
    require_once __DIR__ . '/../src/controllers/ApiController.php';
    $controller = new ApiController();
    $controller->loadData();
    exit;
}

if (preg_match('#^api/departments/(\d+)/programs$#', $path, $matches)) {
    error_log("Routing to ApiController::getPrograms for department_id: " . $matches[1]);
    require_once __DIR__ . '/../src/controllers/ApiController.php';
    $controller = new ApiController();
    $controller->getPrograms($matches[1]);
    exit;
}

// Get user role from session
$roleId = $_SESSION['role_id'] ?? null;

// Proceed with role-based routing (e.g., dashboards)

// Handle role-specific routes
switch ($roleId) {
    case 1: // Admin
    case 2: // Also Admin
        handleAdminRoutes($path);
        break;
    case 3: // DI
        handleDirectorRoutes($path);
        break;
    case 4: // Dean
        handleDeanRoutes($path);
        break;
    case 5: // Chair
        handleChairRoutes($path);
        break;
    case 6: // Faculty
        handleFacultyRoutes($path);
        break;
    default:
        error_log("Unauthorized role: $roleId");
        http_response_code(403);
        echo "Unauthorized role";
        exit;
}

// If no route matched, show 404
http_response_code(404);
echo "Page not found";
exit;
