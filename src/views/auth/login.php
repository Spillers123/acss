<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PRMSU Scheduling System</title>
    <meta name="description" content="Login to the President Ramon Magsaysay State University Scheduling System.">
    <link href="/css/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Background image with responsive behavior */
        .bg-image {
            background-image: url(/assets/logo/main_logo/statuee.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        @media (max-width: 640px) {
            .bg-image {
                background-attachment: scroll; /* Prevent fixed background on mobile for performance */
            }
        }

        /* Overlay for better text readability */
        .bg-overlay {
            background-color: rgba(0, 0, 0, 0.6); /* Slightly darker for contrast */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            transition: opacity 0.3s ease-in-out;
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 1.5rem;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 28rem; /* 448px */
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 640px) {
            .modal-content {
                margin: 20% auto;
                padding: 1rem;
                max-width: 95%;
            }
        }

        .close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            font-size: 1.25rem;
            cursor: pointer;
            color: #374151;
        }

        .modal-content.show {
            transform: scale(1);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 relative">
    <!-- Background Image and Overlay -->
    <div class="bg-image"></div>
    <div class="bg-overlay"></div>

    <!-- Flex Wrapper to Center the Container -->
    <div class="flex items-center justify-center min-h-screen relative z-10">
        <!-- Centered Login Container -->
        <div class="w-full max-w-md px-4 sm:px-6 py-8 bg-white/40 backdrop-blur-lg rounded-lg shadow-lg sm:max-w-lg md:max-w-xl">
            <!-- Header -->
            <div class="text-center mb-6">
                <img src="/assets/logo/main_logo/PRMSUlogo.png" alt="PRMSU Logo" class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4">
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-yellow-300 mb-2">Welcome Back</h1>
                <p class="text-xs sm:text-sm md:text-base text-white">Sign in to access your account</p>
            </div>

            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $awaitingApproval = false;
            if (isset($_SESSION['user_id']) && isset($_SESSION['is_active']) && $_SESSION['is_active'] == 0) {
                $awaitingApproval = true;
            }
            $success = isset($_GET['success']) ? htmlspecialchars(urldecode($_GET['success'])) : '';
            if ($success === "Registration submitted successfully. Awaiting Dean approval.") {
                $awaitingApproval = true;
            }
            ?>

            <?php if ($awaitingApproval): ?>
                <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded-lg flex items-center text-xs sm:text-sm">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <p>Your account is awaiting approval from the Dean's office. You will be notified via email once approved. Please try logging in later.</p>
                </div>
            <?php endif; ?>

            <?php if (isset($email_verification_required) && $email_verification_required): ?>
                <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded-lg flex items-center text-xs sm:text-sm">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <p>Your email is not verified. Please check your inbox for a verification link or <a href="/resend-verification" class="underline hover:text-yellow-600">resend verification email</a>.</p>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg text-xs sm:text-sm"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="POST" action="/login" class="space-y-4 text-white">
                <div>
                    <label for="employee_id" class="block text-xs sm:text-sm font-medium">Employee ID</label>
                    <div class="mt-1 relative">
                        <input type="text" id="employee_id" name="employee_id" required class="block w-full pl-3 pr-3 py-2 border border-white bg-transparent rounded-md shadow-sm text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 placeholder-white" placeholder="Enter your employee ID">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-xs sm:text-sm font-medium">Password</label>
                    <div class="mt-1 relative">
                        <input type="password" id="password" name="password" required class="block w-full pl-3 pr-3 py-2 border border-white bg-transparent rounded-md shadow-sm text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 placeholder-white" placeholder="Enter your password">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-white rounded">
                        <label for="remember-me" class="ml-2 block text-xs sm:text-sm">Remember me</label>
                    </div>
                    <a id="forgot-password-link" class="text-xs sm:text-sm text-yellow-300 hover:text-yellow-200 cursor-pointer">Forgot password?</a>
                </div>
                <button type="submit" class="w-full bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-150 ease-in-out text-xs sm:text-sm md:text-base">
                    Sign In
                </button>
            </form>

            <!-- Footer -->
            <div class="text-center mt-4 text-xs sm:text-sm text-white">
                Don't have an account? <a href="/register" class="text-yellow-300 hover:text-yellow-200">Create new account</a>
            </div>
            <div class="text-center mt-4 text-xs sm:text-sm text-white">
                © 2025 President Ramon Magsaysay State University. All rights reserved.
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgot-password-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-lg font-bold mb-4 text-center text-gray-700">Forgot Password</h2>
            <div id="forgot-password-message" class="mb-4"></div>
            <form id="forgot-password-form" class="space-y-4">
                <div>
                    <label for="forgot-employee_id" class="block text-xs sm:text-sm font-medium text-gray-700">Employee ID</label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 sm:h-5 w-4 sm:w-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                        </div>
                        <input type="text" id="forgot-employee_id" name="employee_id" required class="block w-full pl-9 sm:pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Enter your employee ID">
                    </div>
                </div>
                <button type="submit" class="w-full bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-150 ease-in-out text-xs sm:text-sm">
                    Send Reset Link
                </button>
            </form>
        </div>
    </div>

    <script>
        // Forgot Password Modal
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const forgotPasswordModal = document.getElementById('forgot-password-modal');
        const closeModal = forgotPasswordModal.querySelector('.close');
        const forgotPasswordForm = document.getElementById('forgot-password-form');
        const forgotPasswordMessage = document.getElementById('forgot-password-message');

        forgotPasswordLink.addEventListener('click', (e) => {
            e.preventDefault();
            forgotPasswordModal.style.display = 'block';
            forgotPasswordMessage.innerHTML = ''; // Clear previous message
            forgotPasswordModal.querySelector('.modal-content').classList.add('show');
        });

        closeModal.addEventListener('click', () => {
            forgotPasswordModal.style.display = 'none';
            forgotPasswordModal.querySelector('.modal-content').classList.remove('show');
        });

        window.addEventListener('click', (e) => {
            if (e.target === forgotPasswordModal) {
                forgotPasswordModal.style.display = 'none';
                forgotPasswordModal.querySelector('.modal-content').classList.remove('show');
            }
        });

        forgotPasswordForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const employeeId = document.getElementById('forgot-employee_id').value;
            const response = await fetch('/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    employee_id: employeeId
                })
            });
            const data = await response.json();
            forgotPasswordMessage.innerHTML = `<div class="p-3 ${data.success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'} rounded-lg text-xs sm:text-sm">${data.message}</div>`;
        });
    </script>
</body>
</html>