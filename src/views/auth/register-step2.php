<?php
session_start();
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/UserModel.php';
require_once __DIR__ . '/../../services/AuthService.php';

// Check if step 1 data exists
if (!isset($_SESSION['registration_step1'])) {
    header('Location: /register');
    exit;
}

// Initialize database connection and services
$db = (new Database())->connect();
$userModel = new UserModel($db);
$authService = new AuthService($db);

// Initialize variables
$error = '';
$success = '';
$roles = [];
$colleges = [];
$departments = [];

// Fetch roles and colleges for dropdowns
try {
    $roles = $userModel->getRoles();
    $colleges = $userModel->getColleges();
} catch (Exception $e) {
    $error = "Error loading registration data: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $requiredFields = [
            'role_id',
            'college_id',
            'department_id'
        ];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("All required fields must be filled.");
            }
        }

        // Combine step 1 and step 2 data
        $userData = array_merge($_SESSION['registration_step1'], [
            'role_id' => (int)$_POST['role_id'],
            'college_id' => (int)$_POST['college_id'],
            'department_id' => (int)$_POST['department_id'],
            'is_active' => 0,
            'academic_rank' => trim($_POST['academic_rank'] ?? ''),
            'employment_type' => trim($_POST['employment_type'] ?? ''),
            'classification' => trim($_POST['classification'] ?? null)
        ]);

        if ($authService->register($userData)) {
            // Clear session data
            unset($_SESSION['registration_step1']);
            $success = "Registration successful! You can now login.";
            header('Location: /login?success=' . urlencode($success));
            exit;
        } else {
            throw new Exception("Registration failed. Please try again.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Step 2 | PRMSU Scheduling System</title>
    <meta name="description" content="Complete your registration for the President Ramon Magsaysay State University Scheduling System.">
    <link href="/css/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/assets/logo/main_logo/campus.jpg');
            background-size: cover;
            background-position: center;
            z-index: 1;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 2;
        }

        .radio-group input[type="radio"]:checked+.radio-label {
            border-color: #d97706;
            background-color: #fef3c7;
            box-shadow: 0 0 0 2px #d97706;
        }

        .radio-group input[type="radio"]:checked+.radio-label .radio-circle {
            border-color: #d97706;
        }

        .radio-group input[type="radio"]:checked+.radio-label .radio-dot {
            opacity: 1;
        }

        .form-container {
            min-height: 100vh;
        }

        @media (max-width: 767px) {
            .form-section {
                padding: 1rem;
            }

            .form-wrapper {
                max-width: none;
                width: 100%;
            }
        }

        @media (min-width: 768px) {
            .form-section {
                padding: 2rem;
            }
        }

        .input-group {
            margin-bottom: 1.25rem;
        }

        .input-group:last-child {
            margin-bottom: 0;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .step {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-weight: 600;
            font-size: 14px;
        }

        .step.completed {
            background-color: #10b981;
            color: white;
        }

        .step.active {
            background-color: #d97706;
            color: white;
        }

        .step.inactive {
            background-color: #e5e7eb;
            color: #6b7280;
        }

        .step-line {
            width: 60px;
            height: 2px;
            background-color: #10b981;
            margin: 0 10px;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 font-poppins">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Section (Background with University Image, Logo and Text) -->
        <div class="w-full lg:w-1/2 text-white flex items-center justify-center p-4 sm:p-6 lg:p-12 relative overflow-hidden min-h-[40vh] lg:min-h-screen">
            <div class="bg-image"></div>
            <div class="bg-overlay"></div>

            <div class="text-center z-10 flex flex-col items-center max-w-lg">
                <div class="mb-4 lg:mb-6">
                    <img src="/assets/logo/main_logo/PRMSUlogo.png" alt="PRMSU Logo" class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 mx-auto drop-shadow-lg">
                </div>
                <h1 class="text-xl sm:text-2xl lg:text-4xl font-bold mb-2 lg:mb-4 drop-shadow-md">President Ramon Magsaysay State University</h1>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-2 lg:mb-4 drop-shadow-md">Scheduling System</h2>
                <p class="text-sm sm:text-base lg:text-lg mb-3 lg:mb-6 px-4 drop-shadow-sm">Streamlining class scheduling for better academic planning and resource management.</p>
                <p class="text-xs sm:text-sm lg:text-base italic drop-shadow-sm">"Quality Education for Service"</p>
            </div>
        </div>

        <!-- Right Section (Registration Form) -->
        <div class="w-full lg:w-1/2 bg-white flex items-start justify-center form-section form-container overflow-y-auto">
            <div class="w-full max-w-2xl form-wrapper py-4 lg:py-8">
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step completed">1</div>
                    <div class="step-line"></div>
                    <div class="step active">2</div>
                </div>

                <div class="text-center mb-6 lg:mb-8">
                    <img src="/assets/logo/main_logo/PRMSUlogo.png" alt="PRMSU Logo" class="mx-auto w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 rounded-full border-4 border-white shadow-lg">
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-yellow-600 mb-2">Almost Done!</h1>
                    <p class="text-sm sm:text-base text-gray-600">Step 2: Academic Information</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 4a8 8 0 100 16 8 8 0 000-16z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700"><?= htmlspecialchars($error) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Welcome Message -->
                <div class="bg-gradient-to-r from-yellow-100 to-orange-100 border border-yellow-200 p-4 mb-6 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-800">
                                Welcome <strong><?= htmlspecialchars($_SESSION['registration_step1']['first_name']) ?>!</strong>
                                Please complete your academic information to finish your registration.
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" class="space-y-6">
                    <!-- Required Academic Information -->
                    <div class="bg-red-50 p-6 rounded-lg border border-red-200">
                        <h3 class="text-lg lg:text-xl font-semibold text-gray-700 mb-4 flex items-center">
                            <svg class="h-5 w-5 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Required Information
                        </h3>

                        <!-- Role -->
                        <div class="input-group">
                            <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select id="role_id" name="role_id" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 appearance-none transition duration-200">
                                    <option value="">Select Your Role</option>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= $role['role_id'] ?>" <?= (isset($_POST['role_id']) && $_POST['role_id'] == $role['role_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($role['role_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- College -->
                        <div class="input-group">
                            <label for="college_id" class="block text-sm font-medium text-gray-700 mb-2">College <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select id="college_id" name="college_id" required onchange="loadDepartments()"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 appearance-none transition duration-200">
                                    <option value="">Select Your College</option>
                                    <?php foreach ($colleges as $college): ?>
                                        <option value="<?= $college['college_id'] ?>" <?= (isset($_POST['college_id']) && $_POST['college_id'] == $college['college_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($college['college_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="input-group">
                            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">Department <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select id="department_id" name="department_id" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 appearance-none transition duration-200">
                                    <option value="">Select Department First</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Please select a college first to load departments</p>
                        </div>
                    </div>

                    <!-- Optional Academic Details -->
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                        <h3 class="text-lg lg:text-xl font-semibold text-gray-700 mb-4 flex items-center">
                            <svg class="h-5 w-5 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a2 2 0 012-2h2a2 2 0 012 2v5m-4-6h.01" />
                            </svg>
                            Additional Details <span class="text-sm font-normal text-gray-500">(Optional)</span>
                        </h3>

                        <!-- Academic Rank -->
                        <div class="input-group">
                            <label for="academic_rank" class="block text-sm font-medium text-gray-700 mb-2">Academic Rank</label>
                            <div class="relative">
                                <select id="academic_rank" name="academic_rank"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 appearance-none transition duration-200">
                                    <option value="">Select Academic Rank</option>
                                    <option value="Instructor I" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Instructor I') ? 'selected' : '' ?>>Instructor I</option>
                                    <option value="Instructor II" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Instructor II') ? 'selected' : '' ?>>Instructor II</option>
                                    <option value="Instructor III" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Instructor III') ? 'selected' : '' ?>>Instructor III</option>
                                    <option value="Assistant Professor I" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Assistant Professor I') ? 'selected' : '' ?>>Assistant Professor I</option>
                                    <option value="Assistant Professor II" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Assistant Professor II') ? 'selected' : '' ?>>Assistant Professor II</option>
                                    <option value="Assistant Professor III" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Assistant Professor III') ? 'selected' : '' ?>>Assistant Professor III</option>
                                    <option value="Assistant Professor IV" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Assistant Professor IV') ? 'selected' : '' ?>>Assistant Professor IV</option>
                                    <option value="Associate Professor I" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Associate Professor I') ? 'selected' : '' ?>>Associate Professor I</option>
                                    <option value="Associate Professor II" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Associate Professor II') ? 'selected' : '' ?>>Associate Professor II</option>
                                    <option value="Associate Professor III" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Associate Professor III') ? 'selected' : '' ?>>Associate Professor III</option>
                                    <option value="Associate Professor IV" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Associate Professor IV') ? 'selected' : '' ?>>Associate Professor IV</option>
                                    <option value="Associate Professor V" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Associate Professor V') ? 'selected' : '' ?>>Associate Professor V</option>
                                    <option value="Professor" <?= (isset($_POST['academic_rank']) && $_POST['academic_rank'] == 'Professor') ? 'selected' : '' ?>>Professor</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Employment Type -->
                        <div class="input-group">
                            <label for="employment_type" class="block text-sm font-medium text-gray-700 mb-2">Employment Type</label>
                            <div class="relative">
                                <select id="employment_type" name="employment_type"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 appearance-none transition duration-200">
                                    <option value="">Select Employment Type</option>
                                    <option value="Regular" <?= (isset($_POST['employment_type']) && $_POST['employment_type'] == 'Regular') ? 'selected' : '' ?>>Regular</option>
                                    <option value="Contractual" <?= (isset($_POST['employment_type']) && $_POST['employment_type'] == 'Contractual') ? 'selected' : '' ?>>Contractual</option>
                                    <option value="Part-time" <?= (isset($_POST['employment_type']) && $_POST['employment_type'] == 'Part-time') ? 'selected' : '' ?>>Part-time</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Classification -->
                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Classification</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- TL Radio Button -->
                                <div class="relative radio-group">
                                    <input
                                        type="radio"
                                        id="classification_tl"
                                        name="classification"
                                        value="TL"
                                        class="hidden"
                                        <?= (isset($_POST['classification']) && $_POST['classification'] == 'TL') ? 'checked' : '' ?>>
                                    <label
                                        for="classification_tl"
                                        class="flex items-center w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base cursor-pointer transition-all duration-200 hover:bg-gray-50 radio-label">
                                        <div class="flex items-center">
                                            <div class="w-4 h-4 border-2 border-gray-300 rounded-full mr-3 flex items-center justify-center transition-all duration-200 radio-circle">
                                                <div class="w-2 h-2 rounded-full bg-yellow-500 opacity-0 transition-opacity duration-200 radio-dot"></div>
                                            </div>
                                            <span class="text-gray-700 font-medium">TL (Teaching Load)</span>
                                        </div>
                                    </label>
                                </div>

                                <!-- VSL Radio Button -->
                                <div class="relative radio-group">
                                    <input
                                        type="radio"
                                        id="classification_vsl"
                                        name="classification"
                                        value="VSL"
                                        class="hidden"
                                        <?= (isset($_POST['classification']) && $_POST['classification'] == 'VSL') ? 'checked' : '' ?>>
                                    <label
                                        for="classification_vsl"
                                        class="flex items-center w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base cursor-pointer transition-all duration-200 hover:bg-gray-50 radio-label">
                                        <div class="flex items-center">
                                            <div class="w-4 h-4 border-2 border-gray-300 rounded-full mr-3 flex items-center justify-center transition-all duration-200 radio-circle">
                                                <div class="w-2 h-2 rounded-full bg-yellow-500 opacity-0 transition-opacity duration-200 radio-dot"></div>
                                            </div>
                                            <span class="text-gray-700 font-medium">VSL (Variable Service Load)</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4 pt-4">
                        <a href="/register" class="w-full sm:w-auto bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-200 ease-in-out text-base font-medium text-center shadow-md">
                            ← Back to Step 1
                        </a>

                        <button type="submit" class="w-full sm:w-auto bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 ease-in-out text-base font-medium shadow-md">
                            Complete Registration ✓
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-600">Already have an account? <a href="/login" class="text-yellow-600 hover:text-yellow-500 font-medium">Sign in</a></p>
                    </div>
                </form>

                <div class="text-center mt-6 text-sm text-gray-500">
                    © 2025 President Ramon Magsaysay State University. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Load departments when college is selected
        function loadDepartments() {
            const collegeId = $('#college_id').val();
            const deptSelect = $('#department_id');

            if (collegeId) {
                // Show loading state
                deptSelect.empty().append('<option value="">Loading departments...</option>').prop('disabled', true);

                $.ajax({
                    url: '/api/departments?college_id=' + collegeId,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        deptSelect.prop('disabled', false).empty();
                        deptSelect.append('<option value="">Select Department</option>');

                        if (response.success && response.departments) {
                            response.departments.forEach(function(dept) {
                                deptSelect.append(`<option value="${dept.department_id}">${dept.department_name}</option>`);
                            });
                        } else {
                            deptSelect.append('<option value="">No departments found</option>');
                            console.error('Error:', response.message || 'Unknown error');
                        }
                    },
                    error: function(xhr, status, error) {
                        deptSelect.prop('disabled', false).empty();
                        deptSelect.append('<option value="">Error loading departments</option>');
                        console.error('AJAX Error:', error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            } else {
                deptSelect.empty().append('<option value="">Select College First</option>').prop('disabled', false);
            }
        }

        $(document).ready(function() {
            // Bind the loadDepartments function to college selection change
            $('#college_id').on('change', loadDepartments);

            // Initial load of departments if college_id is pre-selected
            <?php if (isset($_POST['college_id']) && !empty($_POST['college_id'])): ?>
                loadDepartments();
            <?php endif; ?>

            // Auto-focus first input on desktop
            if (window.innerWidth >= 768) {
                $('#role_id').focus();
            }

            // Form validation feedback
            $('form').on('submit', function(e) {
                const requiredFields = ['role_id', 'college_id', 'department_id'];
                let hasError = false;

                requiredFields.forEach(function(fieldId) {
                    const field = $('#' + fieldId);
                    if (!field.val()) {
                        field.addClass('border-red-500');
                        hasError = true;
                    } else {
                        field.removeClass('border-red-500');
                    }
                });

                if (hasError) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $('.border-red-500').first().offset().top - 100
                    }, 500);
                }
            });

            // Remove error styling when user selects a value
            $('select[required]').on('change', function() {
                $(this).removeClass('border-red-500');
            });
        });
    </script>
</body>

</html>