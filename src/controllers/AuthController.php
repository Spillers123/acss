<?php
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../services/EmailService.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $authService;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->authService = new AuthService($this->db);
    }

    /**
     * Handle login request
     */
    public function login()
    {
        if ($this->authService->isLoggedIn()) {
            $this->redirectBasedOnRole();
        }

        $rememberMe = isset($_POST['remember-me']) && $_POST['remember-me'] === '1'; // Changed to match checkbox value
        $error = $_GET['error'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeId = trim($_POST['employee_id'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($employeeId) || empty($password)) {
                error_log("Login failed: Missing employee_id or password");
                $error = "Employee ID and password are required.";
                require_once __DIR__ . '/../views/auth/login.php';
                return;
            }

            $query = "SELECT u.user_id, u.password_hash, u.is_active, u.role_id, u.email FROM users u WHERE u.employee_id = :employee_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':employee_id' => $employeeId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                if ($user['is_active'] == 0) {
                    error_log("Login failed for employee_id: $employeeId - Account is pending approval");
                    $error = "Your account is pending approval. Please contact the Dean.";
                    require_once __DIR__ . '/../views/auth/login.php';
                    return;
                }

                $userData = $this->authService->login($employeeId, $password);
                if ($userData) {
                    $this->authService->startSession($userData);
                
                    if ($rememberMe) {
                        $token = bin2hex(random_bytes(32));
                        $expiry = time() + (30 * 24 * 60 * 60); // 30 days
                        setcookie('remember_me', $token, $expiry, '/', '', true, true); // Secure, HttpOnly cookie

                        $updateQuery = "UPDATE users SET remember_token = :token, remember_token_expiry = :expiry WHERE user_id = :user_id";
                        $stmt = $this->db->prepare($updateQuery);
                        $result = $stmt->execute([
                            ':token' => $token,
                            ':expiry' => date('Y-m-d H:i:s', $expiry),
                            ':user_id' => $user['user_id']
                        ]);
                        if (!$result) {
                            error_log("Failed to update remember_token for user_id: " . $user['user_id'] . " - " . implode(", ", $stmt->errorInfo()));
                        } else {
                            error_log("Remember token saved for user_id: " . $user['user_id']);
                        }
                    } else {
                        if (isset($_COOKIE['remember_me'])) {
                            $updateQuery = "UPDATE users SET remember_token = NULL, remember_token_expiry = NULL WHERE user_id = :user_id";
                            $stmt = $this->db->prepare($updateQuery);
                            $stmt->execute([':user_id' => $user['user_id']]);
                            setcookie('remember_me', '', time() - 3600, '/', '', true, true);
                        }
                    }
                }
                error_log("Login successful for employee_id: $employeeId");
                $this->redirectBasedOnRole();
            } else {
                error_log("Login failed for employee_id: $employeeId - Invalid credentials");
                $error = "Invalid Employee ID or password.";
                require_once __DIR__ . '/../views/auth/login.php';
            }
        } else {
            if (isset($_COOKIE['remember_me'])) {
                $token = $_COOKIE['remember_me'];
                $query = "SELECT user_id, employee_id, role_id, is_active FROM users WHERE remember_token = :token AND remember_token_expiry > NOW()";
                $stmt = $this->db->prepare($query);
                $stmt->execute([':token' => $token]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && $user['is_active'] == 1) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['role_id'] = $user['role_id'];
                    $_SESSION['is_active'] = $user['is_active'];
                    error_log("Auto-login successful for user_id: " . $user['user_id']);
                    $this->redirectBasedOnRole();
                } else {
                    error_log("Auto-login failed for token: $token - Invalid or inactive user");
                    setcookie('remember_me', '', time() - 3600, '/', '', true, true);
                }
            }
            require_once __DIR__ . '/../views/auth/login.php';
        }
    }

    /**
     * Handle registration request
     */
    public function register()
    {
        if ($this->authService->isLoggedIn()) {
            $this->redirectBasedOnRole();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'employee_id' => trim($_POST['employee_id'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'email' => trim($_POST['email'] ?? ''),
                'first_name' => trim($_POST['first_name'] ?? ''),
                'middle_name' => trim($_POST['middle_name'] ?? ''),
                'last_name' => trim($_POST['last_name'] ?? ''),
                'suffix' => trim($_POST['suffix'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'role_id' => intval($_POST['role_id'] ?? 0),
                'college_id' => intval($_POST['college_id'] ?? 0),
                'department_id' => intval($_POST['department_id'] ?? 0),
                'academic_rank' => trim($_POST['academic_rank'] ?? ''),
                'employment_type' => trim($_POST['employment_type'] ?? ''),
                'classification' => trim($_POST['classification'] ?? ''),
                'program_id' => !empty($_POST['program_id']) ? intval($_POST['program_id']) : null
            ];

            $errors = [];
            if (empty($data['employee_id'])) $errors[] = "Employee ID is required.";
            if (empty($data['username'])) $errors[] = "Username is required.";
            if (empty($data['password']) || strlen($data['password']) < 6) $errors[] = "Password must be at least 6 characters.";
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
            if (empty($data['first_name'])) $errors[] = "First name is required.";
            if (empty($data['last_name'])) $errors[] = "Last name is required.";
            if ($data['role_id'] < 1 || $data['role_id'] > 6) $errors[] = "Invalid role selected.";
            if ($data['college_id'] < 1) $errors[] = "Invalid college selected.";
            if ($data['department_id'] < 1) $errors[] = "Invalid department selected.";
            if ($data['role_id'] == 5 && empty($data['program_id'])) {
                $errors[] = "Program ID is required for Program Chair.";
            }

            if (empty($errors)) {
                try {
                    if ($this->authService->register($data)) {
                        $success = $data['role_id'] == 5 || $data['role_id'] == 6
                            ? "Registration submitted successfully. Awaiting Dean approval."
                            : "Registration successful. You can now log in.";
                        header('Location: /login?success=' . urlencode($success));
                        exit;
                    } else {
                        $error = "Registration failed. Employee ID or email may already be in use.";
                        require_once __DIR__ . '/../views/auth/register.php';
                    }
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    require_once __DIR__ . '/../views/auth/register.php';
                }
            } else {
                $error = implode("<br>", $errors);
                require_once __DIR__ . '/../views/auth/register.php';
            }
        } else {
            require_once __DIR__ . '/../views/auth/register.php';
        }
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword()
    {
        header('Content-Type: application/json');
        error_log("Forgot password request received for employee_id: " . ($_POST['employee_id'] ?? 'N/A'));

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            exit;
        }

        $employeeId = trim($_POST['employee_id'] ?? '');

        if (empty($employeeId)) {
            echo json_encode(['success' => false, 'message' => 'Employee ID is required.']);
            exit;
        }

        $query = "SELECT user_id, email, first_name FROM users WHERE employee_id = :employee_id AND is_active = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':employee_id' => $employeeId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expiry = time() + (24 * 60 * 60);
            $updateQuery = "UPDATE users SET reset_token = :token, reset_token_expiry = :expiry WHERE user_id = :user_id";
            $stmt = $this->db->prepare($updateQuery);
            $stmt->execute([
                ':token' => $token,
                ':expiry' => date('Y-m-d H:i:s', $expiry),
                ':user_id' => $user['user_id']
            ]);

            $emailService = new EmailService();
            $resetLink = "http://localhost:8000/reset-password?token=" . $token;
            try {
                if ($emailService->sendForgotPasswordEmail($user['email'], $user['first_name'], $resetLink)) {
                    echo json_encode(['success' => true, 'message' => 'A password reset link has been sent to your email.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to send reset email. Please try again or contact support.']);
                    error_log("Failed to send forgot password email to " . $user['email'] . " - Email service error");
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Failed to send reset email. Please try again or contact support.']);
                error_log("Exception in sending forgot password email to " . $user['email'] . ": " . $e->getMessage());
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No active account found with that Employee ID.']);
        }
        exit;
    }
    /**
     * Handle password reset request
     */
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $newPassword = $_POST['password'] ?? '';

            if (empty($token) || empty($newPassword)) {
                $error = "Token and new password are required.";
                require_once __DIR__ . '/../views/auth/reset_password.php';
                return;
            }

            $query = "SELECT user_id FROM users WHERE reset_token = :token AND reset_token_expiry > NOW()";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':token' => $token]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE users SET password_hash = :password_hash, reset_token = NULL, reset_token_expiry = NULL WHERE user_id = :user_id";
                $stmt = $this->db->prepare($updateQuery);
                $stmt->execute([
                    ':password_hash' => $passwordHash,
                    ':user_id' => $user['user_id']
                ]);
                $success = "Password reset successfully. You can now <a href='/login'>login</a>.";
            } else {
                $error = "Invalid or expired reset token.";
            }
            require_once __DIR__ . '/../views/auth/reset_password.php';
        } else {
            $token = $_GET['token'] ?? '';
            if (empty($token)) {
                $error = "Invalid reset token.";
                require_once __DIR__ . '/../views/auth/reset_password.php';
                return;
            }
            require_once __DIR__ . '/../views/auth/reset_password.php';
        }
    }

    /**
     * Get departments API endpoint
     */
    public function getDepartments()
    {
        header('Content-Type: application/json');

        try {
            $collegeId = intval($_GET['college_id'] ?? 0);
            if ($collegeId < 1) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid college ID'
                ]);
                exit;
            }

            $userModel = new UserModel();
            $departments = $userModel->getDepartmentsByCollege($collegeId);

            echo json_encode([
                'success' => true,
                'departments' => $departments
            ]);
        } catch (Exception $e) {
            error_log("Error in getDepartments: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error loading departments: ' . $e->getMessage()
            ]);
        }
        exit;
    }

    /**
     * Handle logout request
     */
    public function logout()
    {
        $this->authService->logout();
        header('Location: /home');
        exit;
    }

    /**
     * Redirect based on user role
     */
    private function redirectBasedOnRole()
    {
        if (!isset($_SESSION['role_id'])) {
            $this->logout();
            exit;
        }

        $roleId = (int)$_SESSION['role_id'];

        switch ($roleId) {
            case 1: // Admin
            case 2: // Also Admin
                header('Location: /admin/dashboard');
                break;
            case 3: // DI
                header('Location: /director/dashboard');
                break;
            case 4: // Dean
                header('Location: /dean/dashboard');
                break;
            case 5: // Program Chair
                header('Location: /chair/dashboard');
                break;
            case 6: // Faculty
                header('Location: /faculty/dashboard');
                break;
            default:
                $this->logout();
                exit;
        }
        exit;
    }
}
