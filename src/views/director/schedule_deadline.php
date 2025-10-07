<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['title']); ?></title>
    <link rel="stylesheet" href="/css/output.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto px-4 py-8 max-w-7xl">
            <!-- Success/Error Messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-green-800 font-medium"><?php echo htmlspecialchars($_SESSION['success']);
                                                                    unset($_SESSION['success']); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                        <span class="text-red-800 font-medium"><?php echo htmlspecialchars($_SESSION['error']);
                                                                unset($_SESSION['error']); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Header -->
            <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900"><?php echo htmlspecialchars($data['title']); ?></h1>
                        <div class="mt-2 flex items-center space-x-4">
                            <div class="text-sm text-gray-600">
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Current Semester: <?php echo htmlspecialchars($data['current_semester']['semester_name'] ?? 'Not Set'); ?> Semester
                                    A.Y <?php echo htmlspecialchars($data['current_semester']['academic_year'] ?? 'Not Set'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
                <!-- Form Section -->
                <div class="xl:col-span-3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-calendar-alt text-yellow-primary mr-3"></i>
                                Set Schedule Deadline
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">Choose the scope and deadline for schedule submissions</p>
                        </div>

                        <form method="POST" id="deadlineForm" class="p-6">
                            <!-- Application Scope -->
                            <div class="mb-6">
                                <label class="text-sm font-medium text-gray-700 mb-4 block">Application Scope</label>
                                <div class="space-y-4">
                                    <?php if ($data['is_system_admin']): ?>
                                        <!-- Specific Colleges -->
                                        <div class="border border-gray-200 rounded-lg p-4 hover:border-yellow-primary transition-colors scope-option">
                                            <div class="flex items-start space-x-3">
                                                <input type="radio" id="scope_specific_colleges" name="apply_scope" value="specific_colleges"
                                                    class="mt-1 h-4 w-4 text-yellow-primary focus:ring-yellow-primary border-gray-300">
                                                <div class="flex-1">
                                                    <label for="scope_specific_colleges" class="text-sm font-medium text-gray-900 cursor-pointer flex items-center">
                                                        <i class="fas fa-check-square text-purple-500 mr-2"></i>
                                                        Specific Colleges
                                                    </label>
                                                    <p class="text-xs text-gray-600 mt-1 mb-3">Choose specific colleges to apply deadline</p>

                                                    <!-- College Selection -->
                                                    <div id="college-selection" class="hidden mt-3">
                                                        <div class="border border-gray-200 rounded p-3 bg-gray-50">
                                                            <div class="flex items-center justify-between mb-3">
                                                                <span class="text-sm font-medium text-gray-700">Select Colleges:</span>
                                                                <button type="button" class="text-xs text-yellow-primary hover:text-yellow-dark" onclick="toggleAllColleges()">
                                                                    <span id="toggleCollegesText">Select All</span>
                                                                </button>
                                                            </div>
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-40 overflow-y-auto">
                                                                <?php if (!empty($data['all_colleges'])): ?>
                                                                    <?php foreach ($data['all_colleges'] as $college): ?>
                                                                        <label class="flex items-center space-x-2 text-sm hover:bg-gray-100 p-2 rounded">
                                                                            <input type="checkbox" name="selected_colleges[]" value="<?php echo $college['college_id']; ?>"
                                                                                class="rounded text-yellow-primary college-checkbox">
                                                                            <span><?php echo htmlspecialchars($college['college_name']); ?></span>
                                                                            <span class="text-xs text-gray-500">(<?php echo $college['department_count'] ?? 0; ?> depts)</span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Specific Departments -->
                                        <div class="border border-gray-200 rounded-lg p-4 hover:border-yellow-primary transition-colors scope-option">
                                            <div class="flex items-start space-x-3">
                                                <input type="radio" id="scope_specific_departments" name="apply_scope" value="specific_departments"
                                                    class="mt-1 h-4 w-4 text-yellow-primary focus:ring-yellow-primary border-gray-300">
                                                <div class="flex-1">
                                                    <label for="scope_specific_departments" class="text-sm font-medium text-gray-900 cursor-pointer flex items-center">
                                                        <i class="fas fa-list-check text-orange-500 mr-2"></i>
                                                        Specific Departments
                                                    </label>
                                                    <p class="text-xs text-gray-600 mt-1 mb-3">Choose specific departments to apply deadline</p>

                                                    <!-- Department Selection -->
                                                    <div id="department-selection" class="hidden mt-3">
                                                        <div class="border border-gray-200 rounded p-3 bg-gray-50">
                                                            <div class="flex items-center justify-between mb-3">
                                                                <span class="text-sm font-medium text-gray-700">Select Departments:</span>
                                                                <button type="button" class="text-xs text-yellow-primary hover:text-yellow-dark" onclick="toggleAllDepartments()">
                                                                    <span id="toggleDepartmentsText">Select All</span>
                                                                </button>
                                                            </div>
                                                            <div class="space-y-3 max-h-60 overflow-y-auto">
                                                                <?php if (!empty($data['departments_by_college'])): ?>
                                                                    <?php foreach ($data['departments_by_college'] as $college_id => $departments): ?>
                                                                        <div class="border border-gray-200 rounded p-3 bg-white">
                                                                            <div class="flex items-center justify-between mb-2">
                                                                                <h5 class="text-sm font-medium text-gray-700">
                                                                                    <?php
                                                                                    // Find college name
                                                                                    $college_name = 'Unknown College';
                                                                                    if (!empty($data['all_colleges'])) {
                                                                                        foreach ($data['all_colleges'] as $college) {
                                                                                            if ($college['college_id'] == $college_id) {
                                                                                                $college_name = $college['college_name'];
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    echo htmlspecialchars($college_name);
                                                                                    ?>
                                                                                </h5>
                                                                                <button type="button" class="text-xs text-blue-600 hover:text-blue-800"
                                                                                    onclick="toggleCollegeDepartments(<?php echo $college_id; ?>)">
                                                                                    <span id="toggleCollege<?php echo $college_id; ?>Text">Select All</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                                                <?php foreach ($departments as $department): ?>
                                                                                    <label class="flex items-center space-x-2 text-sm hover:bg-gray-50 p-1 rounded">
                                                                                        <input type="checkbox" name="selected_departments[]"
                                                                                            value="<?php echo $department['department_id']; ?>"
                                                                                            class="rounded text-yellow-primary department-checkbox college-<?php echo $college_id; ?>-dept">
                                                                                        <span><?php echo htmlspecialchars($department['department_name']); ?></span>
                                                                                    </label>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- All Colleges (System-wide) - Warning Style -->
                                        <div class="border-2 border-red-200 rounded-lg p-4 bg-red-50 hover:border-red-300 transition-colors scope-option">
                                            <div class="flex items-start space-x-3">
                                                <input type="radio" id="scope_all_colleges" name="apply_scope" value="all_colleges"
                                                    class="mt-1 h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300">
                                                <div class="flex-1">
                                                    <label for="scope_all_colleges" class="text-sm font-medium text-red-900 cursor-pointer flex items-center">
                                                        <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                                        All Colleges (System-wide)
                                                    </label>
                                                    <p class="text-xs text-red-700 mt-1">
                                                        <strong>⚠️ CAUTION:</strong> This will set the deadline for ALL departments across ALL colleges in the system
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <!-- For non-system admins, show department selection only within their college -->
                                        <div class="border border-gray-200 rounded-lg p-4 hover:border-yellow-primary transition-colors scope-option">
                                            <div class="flex items-start space-x-3">
                                                <input type="radio" id="scope_specific_departments" name="apply_scope" value="specific_departments"
                                                    class="mt-1 h-4 w-4 text-yellow-primary focus:ring-yellow-primary border-gray-300">
                                                <div class="flex-1">
                                                    <label for="scope_specific_departments" class="text-sm font-medium text-gray-900 cursor-pointer flex items-center">
                                                        <i class="fas fa-list-check text-orange-500 mr-2"></i>
                                                        Specific Departments in My College
                                                    </label>
                                                    <p class="text-xs text-gray-600 mt-1 mb-3">Choose specific departments in your college</p>

                                                    <!-- Department Selection for Non-System Admin -->
                                                    <div id="department-selection-regular" class="hidden mt-3">
                                                        <div class="border border-gray-200 rounded p-3 bg-gray-50">
                                                            <div class="flex items-center justify-between mb-3">
                                                                <span class="text-sm font-medium text-gray-700">Select Departments in <?php echo htmlspecialchars($data['college_name']); ?>:</span>
                                                                <button type="button" class="text-xs text-yellow-primary hover:text-yellow-dark" onclick="toggleAllDepartments()">
                                                                    <span id="toggleDepartmentsText">Select All</span>
                                                                </button>
                                                            </div>
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-40 overflow-y-auto">
                                                                <?php if (!empty($data['all_departments'])): ?>
                                                                    <?php foreach ($data['all_departments'] as $department): ?>
                                                                        <label class="flex items-center space-x-2 text-sm hover:bg-gray-100 p-2 rounded">
                                                                            <input type="checkbox" name="selected_departments[]"
                                                                                value="<?php echo $department['department_id']; ?>"
                                                                                class="rounded text-yellow-primary department-checkbox">
                                                                            <span><?php echo htmlspecialchars($department['department_name']); ?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Scope Feedback -->
                            <div id="scope-feedback" class="mb-6 text-sm"></div>

                            <!-- Quick Presets -->
                            <div class="mb-6">
                                <label class="text-sm font-medium text-gray-700 mb-3 block">Quick Presets</label>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2" id="presets">
                                    <button type="button" class="preset-btn" data-hours="24">
                                        <i class="fas fa-sun text-yellow-500 mb-1"></i>
                                        <div class="text-xs font-medium">Tomorrow</div>
                                    </button>
                                    <button type="button" class="preset-btn" data-hours="168">
                                        <i class="fas fa-calendar-week text-blue-500 mb-1"></i>
                                        <div class="text-xs font-medium">Next Week</div>
                                    </button>
                                    <button type="button" class="preset-btn" data-hours="336">
                                        <i class="fas fa-calendar-alt text-green-500 mb-1"></i>
                                        <div class="text-xs font-medium">2 Weeks</div>
                                    </button>
                                    <button type="button" class="preset-btn" data-hours="720">
                                        <i class="fas fa-calendar text-purple-500 mb-1"></i>
                                        <div class="text-xs font-medium">1 Month</div>
                                    </button>
                                </div>
                            </div>

                            <!-- Date & Time Input -->
                            <div class="mb-6">
                                <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deadline Date & Time
                                </label>
                                <div class="relative">
                                    <input
                                        type="datetime-local"
                                        id="deadline"
                                        name="deadline"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-primary focus:border-yellow-primary transition-colors duration-200 text-gray-900"
                                        required
                                        min="<?php echo date('Y-m-d\TH:i'); ?>">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i class="fas fa-calendar-alt text-yellow-primary"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Select a future date and time when submissions will close
                                </p>
                                <div id="deadline-feedback" class="mt-2 text-sm font-medium"></div>
                            </div>

                            <!-- Timezone Info -->
                            <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <div class="flex items-center text-sm text-yellow-800">
                                    <i class="fas fa-globe text-yellow-600 mr-2"></i>
                                    <span>All times are in your local timezone (<?php echo date('T'); ?>)</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                <button type="button" onclick="window.history.back()" class="flex-1 sm:flex-none px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-primary transition-all duration-200">
                                    Cancel
                                </button>
                                <button type="submit" id="submitBtn" class="flex-1 px-6 py-3 bg-yellow-600 bg-gradient-to-r from-yellow-primary to-yellow-dark text-white rounded-lg text-sm font-medium hover:from-yellow-dark hover:to-yellow-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-primary transition-all duration-200 flex items-center justify-center">
                                    <i class="fas fa-save mr-2"></i>
                                    <span class="btn-text">Set Deadline</span>
                                    <i class="fas fa-spinner fa-spin hidden ml-2" id="loadingIcon"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Status Overview -->
                <div class="xl:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-list-alt text-yellow-primary mr-3"></i>
                                Current Deadlines
                            </h3>
                        </div>
                        <div class="p-6 max-h-96 overflow-y-auto">
                            <?php if (!empty($data['deadlines'])): ?>
                                <div class="space-y-4">
                                    <?php foreach ($data['deadlines'] as $deadline): ?>
                                        <div class="border-l-4 <?php echo $deadline['department_id'] == $data['user_department_id'] ? 'border-yellow-primary bg-yellow-light bg-opacity-10' : 'border-gray-200'; ?> pl-4">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <h4 class="font-medium text-gray-900 text-sm">
                                                        <?php echo htmlspecialchars($deadline['department_name']); ?>
                                                        <?php if ($deadline['department_id'] == $data['user_department_id']): ?>
                                                            <span class="text-xs text-yellow-primary">(Your Dept)</span>
                                                        <?php endif; ?>
                                                    </h4>
                                                    <?php if ($data['is_system_admin'] && isset($deadline['college_name'])): ?>
                                                        <p class="text-xs text-gray-500 mb-1">
                                                            <i class="fas fa-university mr-1"></i>
                                                            <?php echo htmlspecialchars($deadline['college_name']); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <p class="text-sm <?php echo strtotime($deadline['deadline']) < time() ? 'text-red-600' : 'text-green-600'; ?> font-medium">
                                                        <?php echo date('M j, Y g:i A', strtotime($deadline['deadline'])); ?>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        Set <?php echo isset($deadline['set_by_name']) ? 'by ' . htmlspecialchars($deadline['set_by_name']) : 'by User #' . $deadline['user_id']; ?>
                                                    </p>
                                                </div>
                                                <div class="ml-2">
                                                    <?php if (strtotime($deadline['deadline']) < time()): ?>
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            Expired
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Active
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-calendar-times text-2xl text-gray-400"></i>
                                    </div>
                                    <p class="text-sm text-gray-500">No deadlines set</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Information Card -->
                    <div class="mt-6 bg-blue-50 rounded-xl border border-blue-200 p-6">
                        <h4 class="text-sm font-semibold text-blue-900 mb-3 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Important Information
                        </h4>
                        <ul class="text-xs text-blue-800 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check text-blue-600 mt-0.5 mr-2 text-xs"></i>
                                Faculty receive notifications about deadlines
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-blue-600 mt-0.5 mr-2 text-xs"></i>
                                Late submissions require approval
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-blue-600 mt-0.5 mr-2 text-xs"></i>
                                Deadlines can be updated anytime
                            </li>
                            <?php if ($data['is_system_admin']): ?>
                                <li class="flex items-start">
                                    <i class="fas fa-crown text-blue-600 mt-0.5 mr-2 text-xs"></i>
                                    System-wide deadlines affect all colleges
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-red-600 mt-0.5 mr-2 text-xs"></i>
                                    Use system-wide settings with caution
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .preset-btn {
            @apply bg-gray-50 border border-gray-200 rounded-lg p-3 text-center hover:bg-yellow-primary hover:text-white hover:border-yellow-primary transition-all duration-200 cursor-pointer flex flex-col items-center;
        }

        .preset-btn:hover i {
            @apply text-white;
        }

        .scope-option:has(input:checked) {
            @apply border-yellow-primary bg-yellow-light bg-opacity-5;
        }

        .scope-option:has(input:checked) label {
            @apply text-yellow-dark;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('deadlineForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingIcon = document.getElementById('loadingIcon');
            const btnText = submitBtn.querySelector('.btn-text');
            const deadlineInput = document.getElementById('deadline');
            const scopeRadios = document.querySelectorAll('input[name="apply_scope"]');

            // Show/hide selection areas based on scope
            function handleScopeChange() {
                const selectedScope = document.querySelector('input[name="apply_scope"]:checked')?.value;

                // Hide all selection areas
                const collegeSelection = document.getElementById('college-selection');
                const departmentSelection = document.getElementById('department-selection');
                const departmentSelectionRegular = document.getElementById('department-selection-regular');

                if (collegeSelection) collegeSelection.classList.add('hidden');
                if (departmentSelection) departmentSelection.classList.add('hidden');
                if (departmentSelectionRegular) departmentSelectionRegular.classList.add('hidden');

                // Show appropriate selection area
                switch (selectedScope) {
                    case 'specific_colleges':
                        if (collegeSelection) collegeSelection.classList.remove('hidden');
                        break;
                    case 'specific_departments':
                        if (departmentSelection) departmentSelection.classList.remove('hidden');
                        if (departmentSelectionRegular) departmentSelectionRegular.classList.remove('hidden');
                        break;
                }

                updateScopeFeedback();
            }

            // Update scope feedback
            function updateScopeFeedback() {
                const selectedScope = document.querySelector('input[name="apply_scope"]:checked')?.value;
                const scopeFeedback = document.getElementById('scope-feedback');
                let feedbackText = '';
                let feedbackClass = 'text-gray-600';
                let buttonText = 'Set Deadline';

                switch (selectedScope) {
                    case 'department_only':
                        feedbackText = '<i class="fas fa-building mr-1"></i>Deadline will be set only for your department';
                        buttonText = 'Set Deadline';
                        break;
                    case 'college_wide':
                        feedbackText = '<i class="fas fa-university mr-1"></i>Deadline will be set for all departments in your college';
                        feedbackClass = 'text-blue-600';
                        buttonText = 'Set College-wide Deadline';
                        break;
                    case 'specific_colleges':
                        const selectedColleges = document.querySelectorAll('input[name="selected_colleges[]"]:checked');
                        if (selectedColleges.length > 0) {
                            feedbackText = `<i class="fas fa-university mr-1"></i>Deadline will be set for all departments in ${selectedColleges.length} selected college(s)`;
                            feedbackClass = 'text-purple-600';
                        } else {
                            feedbackText = '<i class="fas fa-university mr-1"></i>Please select at least one college above';
                            feedbackClass = 'text-orange-600';
                        }
                        buttonText = 'Set College-wide Deadline';
                        break;
                    case 'specific_departments':
                        const selectedDepartments = document.querySelectorAll('input[name="selected_departments[]"]:checked');
                        if (selectedDepartments.length > 0) {
                            feedbackText = `<i class="fas fa-list-check mr-1"></i>Deadline will be set for ${selectedDepartments.length} selected department(s)`;
                            feedbackClass = 'text-green-600';
                        } else {
                            feedbackText = '<i class="fas fa-list-check mr-1"></i>Please select at least one department above';
                            feedbackClass = 'text-orange-600';
                        }
                        buttonText = 'Set Departmental Deadline';
                        break;
                    case 'all_colleges':
                        feedbackText = '<i class="fas fa-exclamation-triangle mr-1"></i><strong>SYSTEM-WIDE:</strong> Deadline will be set for ALL departments across ALL colleges';
                        feedbackClass = 'text-red-600 font-semibold';
                        buttonText = 'Set System-wide Deadline';
                        break;
                }

                scopeFeedback.innerHTML = feedbackText;
                scopeFeedback.className = `mb-6 text-sm ${feedbackClass}`;
                btnText.textContent = buttonText;
            }

            // Initialize
            handleScopeChange();

            // Listen for scope changes
            scopeRadios.forEach(radio => {
                radio.addEventListener('change', handleScopeChange);
            });

            // Listen for college/department selection changes
            document.addEventListener('change', function(e) {
                if (e.target.name === 'selected_colleges[]' || e.target.name === 'selected_departments[]') {
                    updateScopeFeedback();
                }
            });

            // Preset buttons functionality
            document.getElementById('presets').addEventListener('click', function(e) {
                const btn = e.target.closest('.preset-btn');
                if (btn) {
                    const hours = parseInt(btn.dataset.hours);
                    const futureDate = new Date();
                    futureDate.setHours(futureDate.getHours() + hours);

                    const formattedDate = futureDate.toISOString().slice(0, 16);
                    deadlineInput.value = formattedDate;

                    deadlineInput.dispatchEvent(new Event('change'));

                    btn.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        btn.style.transform = '';
                    }, 150);
                }
            });

            // Form validation
            form.addEventListener('submit', function(e) {
                const deadlineValue = deadlineInput.value;
                const selectedScope = document.querySelector('input[name="apply_scope"]:checked')?.value;

                if (!deadlineValue) {
                    e.preventDefault();
                    showAlert('Please select a deadline date and time.', 'error');
                    return;
                }

                // Validate selections based on scope
                if (selectedScope === 'specific_colleges') {
                    const selectedColleges = document.querySelectorAll('input[name="selected_colleges[]"]:checked');
                    if (selectedColleges.length === 0) {
                        e.preventDefault();
                        showAlert('Please select at least one college.', 'error');
                        return;
                    }
                }

                if (selectedScope === 'specific_departments') {
                    const selectedDepartments = document.querySelectorAll('input[name="selected_departments[]"]:checked');
                    if (selectedDepartments.length === 0) {
                        e.preventDefault();
                        showAlert('Please select at least one department.', 'error');
                        return;
                    }
                }

                const selectedDate = new Date(deadlineValue);
                const now = new Date();

                if (selectedDate <= now) {
                    e.preventDefault();
                    showAlert('Deadline must be in the future.', 'error');
                    return;
                }

                // Special confirmation for system-wide deadlines
                if (selectedScope === 'all_colleges') {
                    const confirmed = confirm('⚠️ SYSTEM-WIDE DEADLINE\n\nThis will set the deadline for ALL departments across ALL colleges in the entire system.\n\nAre you absolutely sure you want to proceed?');
                    if (!confirmed) {
                        e.preventDefault();
                        return;
                    }
                }

                showLoadingState();
            });

            // Real-time validation feedback
            deadlineInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const now = new Date();
                const diffHours = (selectedDate - now) / (1000 * 60 * 60);

                let feedback = '';
                let feedbackClass = '';

                if (!this.value) {
                    feedback = '';
                } else if (selectedDate <= now) {
                    feedback = '⚠️ Deadline must be in the future';
                    feedbackClass = 'text-red-600';
                } else if (diffHours < 24) {
                    feedback = '⏰ Less than 24 hours from now';
                    feedbackClass = 'text-yellow-600';
                } else {
                    const days = Math.floor(diffHours / 24);
                    feedback = `✅ ${days} day${days !== 1 ? 's' : ''} from now`;
                    feedbackClass = 'text-green-600';
                }

                const feedbackEl = document.getElementById('deadline-feedback');
                feedbackEl.textContent = feedback;
                feedbackEl.className = `mt-2 text-sm font-medium ${feedbackClass}`;
            });

            function showLoadingState() {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                loadingIcon.classList.remove('hidden');
                btnText.textContent = 'Setting Deadline...';
            }

            function showAlert(message, type) {
                const alertDiv = document.createElement('div');
                const bgColor = type === 'error' ? 'bg-red-50 border-red-200' : 'bg-green-50 border-green-200';
                const textColor = type === 'error' ? 'text-red-800' : 'text-green-800';
                const iconColor = type === 'error' ? 'text-red-500' : 'text-green-500';
                const icon = type === 'error' ? 'fa-exclamation-triangle' : 'fa-check-circle';

                alertDiv.className = `mb-6 ${bgColor} border rounded-lg p-4`;
                alertDiv.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas ${icon} ${iconColor} mr-3"></i>
                        <span class="${textColor} font-medium">${message}</span>
                    </div>
                `;

                const container = document.querySelector('.container');
                container.insertBefore(alertDiv, container.querySelector('.grid'));

                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }
        });

        // Toggle functions for select all/none
        function toggleAllColleges() {
            const checkboxes = document.querySelectorAll('.college-checkbox');
            const toggleText = document.getElementById('toggleCollegesText');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
            });

            toggleText.textContent = allChecked ? 'Select All' : 'Select None';

            // Trigger feedback update
            document.querySelector('input[name="apply_scope"]:checked').dispatchEvent(new Event('change'));
        }

        function toggleAllDepartments() {
            const checkboxes = document.querySelectorAll('.department-checkbox');
            const toggleText = document.getElementById('toggleDepartmentsText');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
            });

            toggleText.textContent = allChecked ? 'Select All' : 'Select None';

            // Trigger feedback update
            document.querySelector('input[name="apply_scope"]:checked').dispatchEvent(new Event('change'));
        }

        function toggleCollegeDepartments(collegeId) {
            const checkboxes = document.querySelectorAll(`.college-${collegeId}-dept`);
            const toggleText = document.getElementById(`toggleCollege${collegeId}Text`);
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
            });

            toggleText.textContent = allChecked ? 'Select All' : 'Select None';

            // Trigger feedback update
            document.querySelector('input[name="apply_scope"]:checked').dispatchEvent(new Event('change'));
        }
    </script>
</body>

</html>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>