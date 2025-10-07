<?php
ob_start();

// Fetch current college details
$collegeId = $controller->getDeanCollegeId($_SESSION['user_id']);
$query = "SELECT college_name, logo_path FROM colleges WHERE college_id = :college_id";
$stmt = $controller->db->prepare($query);
$stmt->execute([':college_id' => $collegeId]);
$college = $stmt->fetch(PDO::FETCH_ASSOC) ?: ['college_name' => '', 'logo_path' => null];

// Initialize departments and programs if not set
$departments = $departments ?? [];
$programs = $programs ?? [];

// Check for success/error messages
$success = isset($success) ? htmlspecialchars($success, ENT_QUOTES, 'UTF-8') : null;
$error = isset($error) ? htmlspecialchars($error, ENT_QUOTES, 'UTF-8') : null;
?>

<div class="min-h-screen bg-gray-50 py-8">
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
            <p class="text-gray-600 mt-2">Manage your college settings, departments, and account preferences</p>
        </div>

        <!-- Success/Error Alerts -->
        <?php if ($success): ?>
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-700"><?php echo $success; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <p class="text-red-700"><?php echo $error; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Sidebar - Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Settings Menu</h3>
                    <nav class="space-y-2" id="settings-nav">
                        <button class="settings-nav-btn active w-full text-left px-4 py-3 rounded-lg transition-colors bg-yellow-50 text-yellow-700 border border-yellow-200"
                            data-section="college">
                            <i class="fas fa-university mr-3"></i>
                            College Settings
                        </button>
                        <button class="settings-nav-btn w-full text-left px-4 py-3 rounded-lg transition-colors text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            data-section="departments">
                            <i class="fas fa-building mr-3"></i>
                            Departments & Programs
                        </button>
                        <button class="settings-nav-btn w-full text-left px-4 py-3 rounded-lg transition-colors text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                            data-section="password">
                            <i class="fas fa-lock mr-3"></i>
                            Change Password
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="lg:col-span-2 space-y-8">
                <!-- College Settings Section -->
                <section id="college-section" class="settings-section active">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="border-b border-gray-200 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">College Settings</h2>
                            <p class="text-gray-600 mt-2">Manage your college information and branding</p>
                        </div>

                        <form action="/dean/settings" method="POST" enctype="multipart/form-data" id="settingsForm">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

                            <div class="space-y-6">
                                <!-- College Name -->
                                <div>
                                    <label for="college_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-tag mr-2 text-yellow-600"></i>
                                        College Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        id="college_name"
                                        name="college_name"
                                        value="<?php echo htmlspecialchars($college['college_name']); ?>"
                                        required
                                        maxlength="100"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                                </div>

                                <!-- College Logo -->
                                <div>
                                    <label for="college_logo" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-image mr-2 text-yellow-600"></i>
                                        College Logo
                                    </label>
                                    <input type="file"
                                        id="college_logo"
                                        name="college_logo"
                                        accept="image/png,image/jpeg,image/gif"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                        onchange="previewImage(event)">
                                    <p class="mt-2 text-xs text-gray-500">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Accepted formats: PNG, JPEG, GIF. Maximum file size: 2MB
                                    </p>

                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="mt-4 hidden">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Logo Preview</h4>
                                        <div class="bg-gray-50 border-2 border-dashed border-yellow-300 rounded-lg p-6 text-center">
                                            <img id="previewImage"
                                                src=""
                                                alt="Logo Preview"
                                                class="max-h-32 w-auto object-contain mx-auto rounded-lg">
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Logo Display -->
                                <?php if ($college['logo_path']): ?>
                                    <div class="pt-4 border-t border-gray-200">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Current Logo</h4>
                                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                                            <img src="<?php echo htmlspecialchars($college['logo_path'], ENT_QUOTES, 'UTF-8'); ?>"
                                                alt="College Logo"
                                                class="max-h-32 w-auto object-contain mx-auto rounded-lg">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Submit Button -->
                                <div class="flex justify-end pt-4">
                                    <button type="submit" name="update_settings"
                                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors flex items-center">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Settings
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Departments & Programs Section -->
                <section id="departments-section" class="settings-section hidden">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center border-b border-gray-200 pb-4 mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Departments & Programs</h2>
                                <p class="text-gray-600 mt-2">Manage academic departments and their programs</p>
                            </div>
                            <button onclick="openModal('addDepartmentProgramModal')"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors flex items-center mt-4 sm:mt-0">
                                <i class="fas fa-plus mr-2"></i>
                                Add Department
                            </button>
                        </div>

                        <?php if (empty($departments)): ?>
                            <div class="text-center py-12">
                                <i class="fas fa-university text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 text-lg font-medium">No departments found</p>
                                <p class="text-gray-400 text-sm mt-1">Create your first department to get started</p>
                                <button onclick="openModal('addDepartmentProgramModal')"
                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors flex items-center mx-auto mt-4">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create Department
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Department</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Programs</th>
                                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php foreach ($departments as $dept): ?>
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-building text-yellow-600 mr-3"></i>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <?php echo htmlspecialchars($dept['department_name'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-600">
                                                        <?php
                                                        $deptPrograms = array_filter($programs, fn($p) => $p['department_id'] == $dept['department_id']);
                                                        $programDetails = array_map(fn($p) => htmlspecialchars("{$p['program_code']} - {$p['program_name']}"), $deptPrograms);
                                                        echo !empty($programDetails) ? implode(', ', $programDetails) : 'No programs';
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex justify-end space-x-2">
                                                        <button class="text-blue-600 hover:text-blue-800 transition-colors edit-dept-btn"
                                                            data-dept-id="<?php echo $dept['department_id']; ?>"
                                                            data-dept-name="<?php echo htmlspecialchars($dept['department_name'], ENT_QUOTES, 'UTF-8'); ?>"
                                                            data-programs="<?php echo htmlspecialchars(json_encode(array_column(array_filter($programs, fn($p) => $p['department_id'] == $dept['department_id']), 'program_id')), ENT_QUOTES, 'UTF-8'); ?>"
                                                            data-program-codes="<?php echo htmlspecialchars(json_encode(array_column(array_filter($programs, fn($p) => $p['department_id'] == $dept['department_id']), 'program_code')), ENT_QUOTES, 'UTF-8'); ?>"
                                                            data-program-names="<?php echo htmlspecialchars(json_encode(array_column(array_filter($programs, fn($p) => $p['department_id'] == $dept['department_id']), 'program_name')), ENT_QUOTES, 'UTF-8'); ?>"
                                                            title="Edit Department">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="text-red-600 hover:text-red-800 transition-colors delete-dept-btn"
                                                            data-dept-id="<?php echo $dept['department_id']; ?>"
                                                            data-dept-name="<?php echo htmlspecialchars($dept['department_name'], ENT_QUOTES, 'UTF-8'); ?>"
                                                            title="Delete Department">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Change Password Section -->
                <section id="password-section" class="settings-section hidden">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="border-b border-gray-200 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Change Password</h2>
                            <p class="text-gray-600 mt-2">Update your account password for enhanced security</p>
                        </div>

                        <form action="/dean/settings" method="POST" id="passwordForm">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

                            <div class="space-y-6">
                                <!-- Current Password -->
                                <div>
                                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-2 text-yellow-600"></i>
                                        Current Password <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password"
                                        id="current_password"
                                        name="current_password"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                        placeholder="Enter your current password">
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-key mr-2 text-yellow-600"></i>
                                        New Password <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password"
                                        id="new_password"
                                        name="new_password"
                                        required
                                        minlength="8"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                        placeholder="Enter new password (min. 8 characters)">
                                    <div class="mt-2 space-y-1">
                                        <div class="flex items-center text-xs text-gray-500">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            Password must be at least 8 characters long
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm New Password -->
                                <div>
                                    <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-check-circle mr-2 text-yellow-600"></i>
                                        Confirm New Password <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password"
                                        id="confirm_password"
                                        name="confirm_password"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                        placeholder="Confirm your new password">
                                    <div id="password-match" class="mt-2 text-xs hidden">
                                        <i class="fas fa-check mr-1"></i>
                                        <span>Passwords match</span>
                                    </div>
                                </div>

                                <!-- Password Strength Indicator -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Password Requirements</h4>
                                    <ul class="text-xs text-gray-600 space-y-1">
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-green-500 mr-2"></i>
                                            At least 8 characters long
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-green-500 mr-2"></i>
                                            Include uppercase and lowercase letters
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-green-500 mr-2"></i>
                                            Include numbers and special characters
                                        </li>
                                    </ul>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end pt-4">
                                    <button type="submit" name="change_password"
                                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors flex items-center">
                                        <i class="fas fa-key mr-2"></i>
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Add Department & Program Modal -->
    <div id="addDepartmentProgramModal" class="modal-overlay hidden">
        <div class="modal-content max-w-2xl">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Add New Department</h3>
                <button onclick="closeModal('addDepartmentProgramModal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="/dean/settings" method="POST" class="p-6" id="addDepartmentProgramForm">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

                <div class="mb-6">
                    <label for="new_department_name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-building mr-2 text-yellow-600"></i>
                        Department Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="new_department_name"
                        name="department_name"
                        required
                        maxlength="100"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                        placeholder="Enter department name">
                </div>

                <div id="programFields">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-graduation-cap mr-2 text-yellow-600"></i>
                            Program Details <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <div class="flex-1">
                                <input type="text"
                                    name="program_code[]"
                                    required
                                    maxlength="100"
                                    placeholder="Program Code"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                            </div>
                            <div class="flex-1">
                                <input type="text"
                                    name="program_names[]"
                                    required
                                    maxlength="100"
                                    placeholder="Program Name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="flex space-x-4">
                        <button type="button"
                            onclick="closeModal('addDepartmentProgramModal')"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            name="add_department"
                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors flex items-center">
                            <i class="fas fa-check mr-2"></i>
                            Create Department
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Department & Program Modal -->
    <div id="editDepartmentProgramModal" class="modal-overlay hidden">
        <div class="modal-content max-w-2xl">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Department & Programs</h3>
                <button onclick="closeModal('editDepartmentProgramModal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="/dean/settings" method="POST" class="p-6" id="editDepartmentProgramForm">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="department_id" id="edit_department_id">

                <div class="mb-6">
                    <label for="edit_department_name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-building mr-2 text-yellow-600"></i>
                        Department Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="edit_department_name"
                        name="department_name"
                        required
                        maxlength="100"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                </div>

                <div id="editProgramFields">
                    <!-- Program fields will be dynamically populated -->
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="flex space-x-4">
                        <button type="button"
                            onclick="closeModal('editDepartmentProgramModal')"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            name="edit_department"
                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Department Modal -->
    <div id="deleteDepartmentModal" class="modal-overlay hidden">
        <div class="modal-content max-w-md">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Delete Department</h3>
                <button onclick="closeModal('deleteDepartmentModal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="/dean/settings" method="POST" class="p-6">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="department_id" id="delete_department_id">

                <div class="mb-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                            <div>
                                <p class="text-sm font-medium text-red-800">Warning: This action cannot be undone</p>
                                <p class="text-sm text-red-600 mt-1">All associated programs will also be deleted.</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700">
                        Are you sure you want to delete
                        <span id="delete_department_name" class="font-semibold text-gray-900"></span>?
                    </p>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <button type="button"
                        onclick="closeModal('deleteDepartmentModal')"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        name="delete_department"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors flex items-center">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show toast notifications
        const successMsg = document.querySelector('[data-success]')?.dataset.success;
        const errorMsg = document.querySelector('[data-error]')?.dataset.error;

        if (successMsg) showToast(successMsg, 'success');
        if (errorMsg) showToast(errorMsg, 'error');

        // Initialize everything
        initializeSettingsNavigation();
        initializeEventListeners();
        initializePasswordValidation();

        console.log('Initialization complete');
    });

    // ==================== SETTINGS NAVIGATION ====================
    function initializeSettingsNavigation() {
        const navButtons = document.querySelectorAll('.settings-nav-btn');

        navButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const sectionName = this.getAttribute('data-section');
                console.log('Button clicked, switching to:', sectionName);

                if (sectionName) {
                    showSection(sectionName);
                }
            });
        });

        // Show college section by default
        showSection('college');
    }

    function showSection(sectionName) {
        // Hide all sections
        const allSections = document.querySelectorAll('.settings-section');
        allSections.forEach(section => {
            section.classList.add('hidden');
            section.classList.remove('active');
        });

        // Reset all buttons
        const allButtons = document.querySelectorAll('.settings-nav-btn');
        allButtons.forEach(btn => {
            btn.classList.remove('active', 'bg-yellow-50', 'text-yellow-700', 'border-yellow-200', 'border');
            btn.classList.add('text-gray-600', 'hover:bg-gray-50', 'hover:text-gray-900');
        });

        // Show target section
        const targetSection = document.getElementById(sectionName + '-section');
        if (targetSection) {
            targetSection.classList.remove('hidden');
            targetSection.classList.add('active');
        } else {
            console.error('Section not found:', sectionName);
        }

        // Activate button
        const activeBtn = document.querySelector(`.settings-nav-btn[data-section="${sectionName}"]`);
        if (activeBtn) {
            activeBtn.classList.add('active', 'bg-yellow-50', 'text-yellow-700', 'border-yellow-200', 'border');
            activeBtn.classList.remove('text-gray-600', 'hover:bg-gray-50', 'hover:text-gray-900');
        }
    }

    // ==================== PASSWORD VALIDATION ====================
    function initializePasswordValidation() {
        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('confirm_password');
        const passwordMatch = document.getElementById('password-match');

        if (newPassword && confirmPassword && passwordMatch) {
            const validatePasswords = () => {
                if (newPassword.value && confirmPassword.value) {
                    if (newPassword.value === confirmPassword.value) {
                        passwordMatch.className = 'mt-2 text-xs text-green-600 flex items-center';
                        passwordMatch.innerHTML = '<i class="fas fa-check mr-1"></i><span>Passwords match</span>';
                        passwordMatch.classList.remove('hidden');
                    } else {
                        passwordMatch.className = 'mt-2 text-xs text-red-600 flex items-center';
                        passwordMatch.innerHTML = '<i class="fas fa-times mr-1"></i><span>Passwords do not match</span>';
                        passwordMatch.classList.remove('hidden');
                    }
                } else {
                    passwordMatch.classList.add('hidden');
                }
            };

            confirmPassword.addEventListener('input', validatePasswords);
            newPassword.addEventListener('input', validatePasswords);
        }
    }

    // ==================== TOAST NOTIFICATIONS ====================
    function showToast(message, type) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

        toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg flex items-center justify-between min-w-80 transform transition-transform duration-300 translate-x-full`;
        toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${icon} mr-3"></i>
            <span>${message}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    `;

        container.appendChild(toast);
        setTimeout(() => toast.classList.remove('translate-x-full'), 100);
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    // ==================== MODAL MANAGEMENT ====================
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('active'), 10);
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);

            const form = modal.querySelector('form');
            if (form) form.reset();
            resetProgramFields();
        }
    }

    // ==================== IMAGE PREVIEW ====================
    function previewImage(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
            previewImage.src = '';
        }
    }

    // ==================== PROGRAM FIELD MANAGEMENT ====================
    function addProgramField() {
        const programFields = document.getElementById('programFields');
        const fieldDiv = document.createElement('div');
        fieldDiv.className = 'mb-4 program-field';
        fieldDiv.innerHTML = `
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-graduation-cap mr-2 text-yellow-600"></i>
            Program Details <span class="text-red-500">*</span>
        </label>
        <div class="flex gap-2">
            <div class="flex-1">
                <input type="text" name="program_code[]" required maxlength="100" placeholder="Program Code"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
            </div>
            <div class="flex-1">
                <input type="text" name="program_names[]" required maxlength="100" placeholder="Program Name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
            </div>
            <button type="button" onclick="removeProgramField(this)" 
                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-3 rounded-lg transition-colors">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
        programFields.appendChild(fieldDiv);
    }

    function addEditProgramField() {
        const editProgramFields = document.getElementById('editProgramFields');
        const fieldDiv = document.createElement('div');
        fieldDiv.className = 'mb-4 program-field';
        fieldDiv.innerHTML = `
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-graduation-cap mr-2 text-yellow-600"></i>
            Program Details <span class="text-red-500">*</span>
        </label>
        <div class="flex gap-2">
            <div class="flex-1">
                <input type="text" name="program_code[]" required maxlength="100" placeholder="Program Code"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                <input type="hidden" name="program_ids[]" value="">
            </div>
            <div class="flex-1">
                <input type="text" name="program_names[]" required maxlength="100" placeholder="Program Name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
            </div>
            <button type="button" onclick="removeProgramField(this)" 
                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-3 rounded-lg transition-colors">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
        editProgramFields.appendChild(fieldDiv);
    }

    function removeProgramField(button) {
        button.closest('.program-field')?.remove();
    }

    function resetProgramFields() {
        const programFields = document.getElementById('programFields');
        if (programFields) {
            programFields.innerHTML = `
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-graduation-cap mr-2 text-yellow-600"></i>
                    Program Details <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-2">
                    <div class="flex-1">
                        <input type="text" name="program_code[]" required maxlength="100" placeholder="Program Code"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="program_names[]" required maxlength="100" placeholder="Program Name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                    </div>
                </div>
            </div>
        `;
        }

        const editProgramFields = document.getElementById('editProgramFields');
        if (editProgramFields) editProgramFields.innerHTML = '';
    }

    // ==================== DEPARTMENT MODALS ====================
    function openEditDepartmentProgramModal(deptId, deptName, programIds, programCodes, programNames) {
        document.getElementById('edit_department_id').value = deptId || '';
        document.getElementById('edit_department_name').value = deptName || '';

        const editProgramFields = document.getElementById('editProgramFields');
        editProgramFields.innerHTML = '';

        try {
            const ids = Array.isArray(programIds) ? programIds : [];
            const codes = Array.isArray(programCodes) ? programCodes : [];
            const names = Array.isArray(programNames) ? programNames : [];
            const maxLength = Math.max(ids.length, codes.length, names.length);

            for (let i = 0; i < maxLength; i++) {
                const fieldDiv = document.createElement('div');
                fieldDiv.className = 'mb-4 program-field';
                fieldDiv.innerHTML = `
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-graduation-cap mr-2 text-yellow-600"></i>
                    Program Details <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-2">
                    <div class="flex-1">
                        <input type="text" name="program_code[]" value="${codes[i] || ''}" required maxlength="100"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                        <input type="hidden" name="program_ids[]" value="${ids[i] || ''}">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="program_names[]" value="${names[i] || ''}" required maxlength="100"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                    </div>
                    ${i > 0 ? `<button type="button" onclick="removeProgramField(this)" class="bg-red-600 hover:bg-red-700 text-white px-3 py-3 rounded-lg transition-colors"><i class="fas fa-trash"></i></button>` : ''}
                </div>
            `;
                editProgramFields.appendChild(fieldDiv);
            }

            openModal('editDepartmentProgramModal');
        } catch (error) {
            console.error('Error populating edit modal:', error);
            showToast('Error loading department data', 'error');
        }
    }

    function openDeleteDepartmentModal(deptId, deptName) {
        document.getElementById('delete_department_id').value = deptId || '';
        document.getElementById('delete_department_name').textContent = deptName || '';
        openModal('deleteDepartmentModal');
    }

    // ==================== EVENT LISTENERS ====================
    function initializeEventListeners() {
        // Modal overlay clicks
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal(modal.id);
            });
        });

        // Escape key closes modals
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.active').forEach(modal => {
                    closeModal(modal.id);
                });
            }
        });

        // Edit department buttons
        document.querySelectorAll('.edit-dept-btn').forEach(button => {
            button.addEventListener('click', function() {
                const deptId = this.dataset.deptId;
                const deptName = this.dataset.deptName;
                const programs = JSON.parse(this.dataset.programs || '[]');
                const programCodes = JSON.parse(this.dataset.programCodes || '[]');
                const programNames = JSON.parse(this.dataset.programNames || '[]');
                openEditDepartmentProgramModal(deptId, deptName, programs, programCodes, programNames);
            });
        });

        // Delete department buttons
        document.querySelectorAll('.delete-dept-btn').forEach(button => {
            button.addEventListener('click', function() {
                openDeleteDepartmentModal(this.dataset.deptId, this.dataset.deptName);
            });
        });

        // File input validation
        const logoInput = document.getElementById('college_logo');
        if (logoInput) {
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        showToast('File size must be less than 2MB', 'error');
                        this.value = '';
                        return;
                    }
                    const allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        showToast('Please select a valid image file', 'error');
                        this.value = '';
                    }
                }
            });
        }

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('input[required], select[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    showToast('Please fill in all required fields', 'error');
                }
            });

            form.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.remove('border-red-500');
                });
            });
        });
    }

    // Make functions globally available
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.previewImage = previewImage;
    window.addProgramField = addProgramField;
    window.addEditProgramField = addEditProgramField;
    window.removeProgramField = removeProgramField;
    window.openEditDepartmentProgramModal = openEditDepartmentProgramModal;
    window.openDeleteDepartmentModal = openDeleteDepartmentModal;
    window.showSection = showSection;
    window.showToast = showToast;
</script>

<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        /* ADD THIS */
    }

    .modal-overlay.active {
        opacity: 1;
        pointer-events: auto;
        /* ADD THIS */
    }

    .modal-overlay.hidden {
        display: none !important;
        /* ADD THIS */
        pointer-events: none !important;
        /* ADD THIS */
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: scale(0.95);
        transition: transform 0.3s ease;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-overlay.active .modal-content {
        transform: scale(1);
    }

    .settings-section {
        transition: opacity 0.3s ease;
    }

    .settings-section.active {
        opacity: 1;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in-left {
        animation: slideInLeft 0.5s ease-in-out;
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-20px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>