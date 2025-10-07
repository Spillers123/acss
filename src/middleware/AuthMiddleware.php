<?php

class AuthMiddleware
{
    private static $roleMap = [
        'admin' => 1,
        'vpaa' => 2,
        'di' => 3,
        'dean' => 4,
        'chair' => 5,
        'faculty' => 6
    ];

    public static function handle($requiredRole = null)
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            error_log("AuthMiddleware: No user session, redirecting to /login");
            header('Location: /login');
            exit;
        }

        // Check if role is required
        if ($requiredRole) {
            $requiredRoleId = is_numeric($requiredRole) ?
                (int)$requiredRole : (self::$roleMap[strtolower($requiredRole)] ?? null);

            // Get role_id from session (not from user_id)
            if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] !== $requiredRoleId) {
                error_log("AuthMiddleware: Role mismatch, expected $requiredRoleId, got " . ($_SESSION['role_id'] ?? 'none'));

                // Instead of redirecting to /unauthorized (which might cause loops), 
                // show a 403 error directly
                http_response_code(403);
                include __DIR__ . '/../views/errors/403.php';
                exit;
            }
        }

        error_log("AuthMiddleware: Access granted for role " . ($_SESSION['role_id'] ?? 'unknown'));
    }
}
