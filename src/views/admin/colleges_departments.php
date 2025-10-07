<?php
ob_start();
?>

<style>
    :root {
        --yellow: #D4AF37;
        --dark-gray: #4B5563;
        --white: #FFFFFF;
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

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translate(-50%, -60%);
            opacity: 0;
        }

        to {
            transform: translate(-50%, -50%);
            opacity: 1;
        }
    }

    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 50;
        transform: translateX(120%);
        animation: slideIn 0.5s forwards, fadeOut 0.5s forwards 3s;
    }

    .toast.success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .toast.error {
        background-color: #fee2e2;
        color: #991b1b;
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
        }
    }
</style>

<div class="min-h-screen bg-white py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-dark-gray mb-6 fade-in">Manage Colleges & Departments</h1>

        <!-- Toast Notifications -->
        <?php if (isset($_SESSION['success'])): ?>
            <div id="success-toast" class="toast success hidden">
                <?php echo htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const toast = document.getElementById('success-toast');
                    toast.classList.remove('hidden');
                    setTimeout(() => toast.remove(), 3500);
                });
            </script>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div id="error-toast" class="toast error hidden">
                <?php echo htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const toast = document.getElementById('error-toast');
                    toast.classList.remove('hidden');
                    setTimeout(() => toast.remove(), 3500);
                });
            </script>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Tabs -->
        <div class="mb-8">
            <div class="border-b border-gray-700/20">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button id="college-tab" class="tab-button border-transparent text-gray-800 hover:text-yellow-600 hover:border-yellow-400 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200" data-tab="college">
                        Colleges
                    </button>
                    <button id="department-tab" class="tab-button border-transparent text-gray-800 hover:text-yellow-600 hover:border-yellow-400 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200" data-tab="department">
                        Departments
                    </button>
                </nav>
            </div>
        </div>

        <!-- College Section -->
        <div id="college-content" class="tab-content fade-in">
            <!-- Create College Button -->
            <div class="mb-6">
                <button id="open-college-modal" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow/90 focus:ring-2 focus:ring-yellow/50 transition-colors duration-200">
                    Add New College
                </button>
            </div>
            <!-- Colleges Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg border border-dark-gray/10">
                <h2 class="text-xl font-semibold text-dark-gray mb-5">Colleges List</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead class="bg-dark-gray/5">
                            <tr>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">Name</th>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">Code</th>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($colleges)): ?>
                                <tr>
                                    <td colspan="3" class="p-4 text-center text-dark-gray/60">No colleges found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($colleges as $college): ?>
                                    <tr class="border-t border-dark-gray/10 hover:bg-dark-gray/5 transition-colors duration-200">
                                        <td class="p-3 text-sm text-dark-gray"><?php echo htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="p-3 text-sm text-dark-gray"><?php echo htmlspecialchars($college['college_code'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="p-3 text-sm">
                                            <button class="edit-btn bg-yellow-600/20 text-yellow px-3 py-1 rounded-lg hover:bg-yellow/40 transition-colors duration-200" data-type="college" data-id="<?php echo htmlspecialchars($college['college_id'], ENT_QUOTES, 'UTF-8'); ?>" data-name="<?php echo htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?>" data-code="<?php echo htmlspecialchars($college['college_code'], ENT_QUOTES, 'UTF-8'); ?>">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Department Section -->
        <div id="department-content" class="tab-content hidden fade-in">
            <!-- Create Department Button -->
            <div class="mb-6">
                <button id="open-department-modal" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow/90 focus:ring-2 focus:ring-yellow/50 transition-colors duration-200">
                    Add New Department
                </button>
            </div>
            <!-- Departments Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg border border-dark-gray/10">
                <h2 class="text-xl font-semibold text-dark-gray mb-5">Departments List</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead class="bg-dark-gray/5">
                            <tr>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">Name</th>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">College</th>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">Program Name</th>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">Program Code</th>
                                <th class="p-3 text-left text-sm font-medium text-dark-gray uppercase tracking-wide">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($departments)): ?>
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-dark-gray/60">No departments found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($departments as $department): ?>
                                    <tr class="border-t border-dark-gray/10 hover:bg-dark-gray/5 transition-colors duration-200">
                                        <td class="p-3 text-sm text-dark-gray"><?php echo htmlspecialchars($department['department_name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="p-3 text-sm text-dark-gray"><?php echo htmlspecialchars($department['college_name'] ?? 'Not Assigned', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="p-3 text-sm text-dark-gray"><?php echo htmlspecialchars($department['program_name'] ?? 'Not Assigned', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="p-3 text-sm text-dark-gray"><?php echo htmlspecialchars($department['program_code'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="p-3 text-sm">
                                            <button class="edit-btn bg-yellow-600/20 text-yellow px-3 py-1 rounded-lg hover:bg-yellow/40 transition-colors duration-200" data-type="department" data-id="<?php echo htmlspecialchars($department['department_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" data-name="<?php echo htmlspecialchars($department['department_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" data-college-id="<?php echo htmlspecialchars($department['college_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" data-college-name="<?php echo htmlspecialchars($department['college_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" data-program-name="<?php echo htmlspecialchars($department['program_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" data-program-code="<?php echo htmlspecialchars($department['program_code'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- College Modal -->
        <div id="college-modal" class="modal">
            <div class="modal-content">
                <h2 class="text-xl font-semibold text-dark-gray mb-4">Add New College</h2>
                <form action="/admin/colleges_departments/create" method="POST" class="space-y-4" novalidate>
                    <input type="hidden" name="type" value="college">
                    <div>
                        <label for="college_name" class="block text-sm font-medium text-dark-gray mb-2">College Name *</label>
                        <input type="text" id="college_name" name="college_name" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors" placeholder="e.g., College of Engineering">
                        <p class="mt-1 text-xs text-red-600 hidden" id="college_name_error">College name is required</p>
                    </div>
                    <div>
                        <label for="college_code" class="block text-sm font-medium text-dark-gray mb-2">College Code *</label>
                        <input type="text" id="college_code" name="college_code" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors" placeholder="e.g., COE">
                        <p class="mt-1 text-xs text-red-600 hidden" id="college_code_error">College code is required</p>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" id="close-college-modal" class="px-4 py-2 border border-dark-gray/20 rounded-lg text-dark-gray hover:bg-dark-gray/10 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600/90 focus:ring-2 focus:ring-yellow/50 transition-colors duration-200">
                            Create College
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Department Modal -->
        <div id="department-modal" class="modal">
            <div class="modal-content">
                <h2 class="text-xl font-semibold text-dark-gray mb-4">Add New Department</h2>
                <form action="/admin/colleges_departments/create" method="POST" class="space-y-4" novalidate>
                    <input type="hidden" name="type" value="department">
                    <div>
                        <label for="department_name" class="block text-sm font-medium text-dark-gray mb-2">Department Name *</label>
                        <input type="text" id="department_name" name="department_name" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors" placeholder="e.g., Computer Science">
                        <p class="mt-1 text-xs text-red-600 hidden" id="department_name_error">Department name is required</p>
                    </div>
                    <div>
                        <label for="college_id" class="block text-sm font-medium text-dark-gray mb-2">College *</label>
                        <select id="college_id" name="college_id" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                            <option value="" disabled selected>Select a college</option>
                            <?php foreach ($colleges as $college): ?>
                                <option value="<?php echo htmlspecialchars($college['college_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="mt-1 text-xs text-red-600 hidden" id="college_id_error">College is required</p>
                    </div>
                    <div>
                        <label for="program_name" class="block text-sm font-medium text-dark-gray mb-2">Program Name *</label>
                        <input type="text" id="program_name" name="program_name" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors" placeholder="e.g., Bachelor of Science in CS">
                        <p class="mt-1 text-xs text-red-600 hidden" id="program_name_error">Program name is required</p>
                    </div>
                    <div>
                        <label for="program_code" class="block text-sm font-medium text-dark-gray mb-2">Program Code *</label>
                        <input type="text" id="program_code" name="program_code" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors" placeholder="e.g., BSCS">
                        <p class="mt-1 text-xs text-red-600 hidden" id="program_code_error">Program code is required</p>
                    </div>
                    <div>
                        <label for="program_type" class="block text-sm font-medium text-dark-gray mb-2">Program Type *</label>
                        <select id="program_type" name="program_type" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                            <option value="Major">Major</option>
                            <option value="Minor">Minor</option>
                            <option value="Concentration">Concentration</option>
                        </select>
                        <p class="mt-1 text-xs text-red-600 hidden" id="program_type_error">Program type is required</p>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" id="close-department-modal" class="px-4 py-2 border border-dark-gray/20 rounded-lg text-dark-gray hover:bg-dark-gray/10 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600/90 focus:ring-2 focus:ring-yellow/50 transition-colors duration-200">
                            Create Department
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="edit-modal" class="modal">
            <div class="modal-content">
                <h2 class="text-xl font-semibold text-dark-gray mb-4" id="edit-modal-title"></h2>
                <form action="/admin/colleges_departments/update" method="POST" class="space-y-4" novalidate>
                    <input type="hidden" name="type" id="edit-type">
                    <input type="hidden" name="id" id="edit-id">
                    <div id="edit-college-fields" class="space-y-4">
                        <div>
                            <label for="edit_college_name" class="block text-sm font-medium text-dark-gray mb-2">College Name *</label>
                            <input type="text" id="edit_college_name" name="college_name" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                            <p class="mt-1 text-xs text-red-600 hidden" id="edit_college_name_error">College name is required</p>
                        </div>
                        <div>
                            <label for="edit_college_code" class="block text-sm font-medium text-dark-gray mb-2">College Code *</label>
                            <input type="text" id="edit_college_code" name="college_code" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                            <p class="mt-1 text-xs text-red-600 hidden" id="edit_college_code_error">College code is required</p>
                        </div>
                    </div>
                    <div id="edit-department-fields" class="space-y-4 hidden">
                        <div>
                            <label for="edit_department_name" class="block text-sm font-medium text-dark-gray mb-2">Department Name *</label>
                            <input type="text" id="edit_department_name" name="department_name" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                            <p class="mt-1 text-xs text-red-600 hidden" id="edit_department_name_error">Department name is required</p>
                        </div>
                        <div>
                            <label for="edit_college_id" class="block text-sm font-medium text-dark-gray mb-2">College *</label>
                            <select id="edit_college_id" name="college_id" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                                <option value="" disabled>Select a college</option>
                                <?php foreach ($colleges as $college): ?>
                                    <option value="<?php echo htmlspecialchars($college['college_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php echo htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="mt-1 text-xs text-red-600 hidden" id="edit_college_id_error">College is required</p>
                        </div>
                        <div>
                            <label for="edit_program_name" class="block text-sm font-medium text-dark-gray mb-2">Program Name *</label>
                            <input type="text" id="edit_program_name" name="program_name" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                            <p class="mt-1 text-xs text-red-600 hidden" id="edit_program_name_error">Program name is required</p>
                        </div>
                        <div>
                            <label for="edit_program_code" class="block text-sm font-medium text-dark-gray mb-2">Program Code *</label>
                            <input type="text" id="edit_program_code" name="program_code" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                            <p class="mt-1 text-xs text-red-600 hidden" id="edit_program_code_error">Program code is required</p>
                        </div>
                        <div>
                            <label for="edit_program_type" class="block text-sm font-medium text-dark-gray mb-2">Program Type *</label>
                            <select id="edit_program_type" name="program_type" required class="w-full px-4 py-2 border border-dark-gray/20 rounded-lg focus:ring-2 focus:ring-yellow focus:border-yellow transition-colors">
                                <option value="Major">Major</option>
                                <option value="Minor">Minor</option>
                                <option value="Concentration">Concentration</option>
                            </select>
                            <p class="mt-1 text-xs text-red-600 hidden" id="edit_program_type_error">Program type is required</p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" id="close-edit-modal" class="px-4 py-2 border border-dark-gray/20 rounded-lg text-dark-gray hover:bg-dark-gray/10 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="bg-yellow-400 text-white px-6 py-2 rounded-lg hover:bg-yellow-600/90 focus:ring-2 focus:ring-yellow/50 transition-colors duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-yellow', 'text-yellow', 'active-tab');
                    btn.classList.add('border-transparent', 'text-dark-gray');
                });
                tabContents.forEach(content => content.classList.add('hidden'));

                button.classList.add('border-yellow', 'text-yellow', 'active-tab');
                button.classList.remove('border-transparent', 'text-dark-gray');
                document.getElementById(`${button.dataset.tab}-content`).classList.remove('hidden');
            });
        });

        // Activate the first tab by default
        tabButtons[0].click();

        // Modal controls
        const collegeModal = document.getElementById('college-modal');
        const departmentModal = document.getElementById('department-modal');
        const editModal = document.getElementById('edit-modal');
        const openCollegeModal = document.getElementById('open-college-modal');
        const openDepartmentModal = document.getElementById('open-department-modal');
        const closeCollegeModal = document.getElementById('close-college-modal');
        const closeDepartmentModal = document.getElementById('close-department-modal');
        const closeEditModal = document.getElementById('close-edit-modal');

        openCollegeModal.addEventListener('click', () => collegeModal.style.display = 'block');
        openDepartmentModal.addEventListener('click', () => departmentModal.style.display = 'block');
        closeCollegeModal.addEventListener('click', () => collegeModal.style.display = 'none');
        closeDepartmentModal.addEventListener('click', () => departmentModal.style.display = 'none');
        closeEditModal.addEventListener('click', () => editModal.style.display = 'none');

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === collegeModal) collegeModal.style.display = 'none';
            if (e.target === departmentModal) departmentModal.style.display = 'none';
            if (e.target === editModal) editModal.style.display = 'none';
        });

        // Edit button functionality
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const type = button.getAttribute('data-type');
                const id = button.getAttribute('data-id');
                editModal.style.display = 'block';

                if (type === 'college') {
                    document.getElementById('edit-modal-title').textContent = 'Edit College';
                    document.getElementById('edit-type').value = 'college';
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-college-fields').classList.remove('hidden');
                    document.getElementById('edit-department-fields').classList.add('hidden');
                    document.getElementById('edit_college_name').value = button.getAttribute('data-name');
                    document.getElementById('edit_college_code').value = button.getAttribute('data-code');
                } else if (type === 'department') {
                    document.getElementById('edit-modal-title').textContent = 'Edit Department';
                    document.getElementById('edit-type').value = 'department';
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-college-fields').classList.add('hidden');
                    document.getElementById('edit-department-fields').classList.remove('hidden');
                    document.getElementById('edit_department_name').value = button.getAttribute('data-name');
                    document.getElementById('edit_college_id').value = button.getAttribute('data-college-id');
                    document.getElementById('edit_program_name').value = button.getAttribute('data-program-name') || '';
                    document.getElementById('edit_program_code').value = button.getAttribute('data-program-code') || '';
                    // Set program_type if available (currently not in data attributes, add if needed)
                    document.getElementById('edit_program_type').value = 'Major'; // Default; fetch if stored
                }
            });
        });

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                let isValid = true;
                form.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        e.preventDefault();
                        isValid = false;
                        const error = input.nextElementSibling;
                        if (error && error.tagName === 'P') {
                            error.classList.remove('hidden');
                        }
                    }
                });
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
        });
    });
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>