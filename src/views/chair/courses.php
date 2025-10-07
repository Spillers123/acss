<?php
require_once __DIR__ . '/../../controllers/ChairController.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();

// Assuming $error, $success, $courses, $editCourse, $page, $offset, $perPage, $totalCourses, $totalPages, $departmentId are set by ChairController
$searchTerm = ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search']) && trim($_GET['search']) !== '') ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses | ACSS</title>
    <link rel="stylesheet" href="/css/output.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        :root {
            --yellow-primary: #FFC107;
            --yellow-secondary: #FFCA28;
            --yellow-light: #FFF8E1;
            --gray-dark: #333;
            --gray-light: #F5F5F5;
        }

        .bg-yellow-primary {
            background-color: var(--yellow-primary);
        }

        .bg-yellow-secondary {
            background-color: var(--yellow-secondary);
        }

        .text-yellow-primary {
            color: var(--yellow-primary);
        }

        .border-yellow-primary {
            border-color: var(--yellow-primary);
        }

        .form-input {
            padding-left: 2.5rem;
            /* Increased to accommodate icon */
            border: 1px solid var(--gray-light);
            border-radius: 0.5rem;
            background-color: white;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-input:focus {
            border-color: var(--yellow-primary);
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
            outline: none;
        }

        .form-input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--gray-dark);
        }

        .btn-gold {
            background-color: var(--yellow-primary);
            color: white;
        }

        .btn-gold:hover {
            background-color: var(--yellow-secondary);
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.3);
        }

        .search-highlight {
            background-color: var(--yellow-light);
            color: var(--gray-dark);
            padding: 0 2px;
            border-radius: 2px;
        }

        .table-header {
            background-color: var(--yellow-light);
            color: var(--gray-dark);
        }

        .modal-content {
            border: 1px solid var(--yellow-light);
        }
    </style>
</head>

<body class="bg-gray-light font-sans antialiased max-w-full">
    <div id="toast-container" class="fixed top-5 right-5 z-50"></div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <!-- Header Content -->
                <div class="slide-in-left">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-dark">Manage Courses</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Add, edit, and manage courses for your department</p>
                </div>

                <!-- Action Button -->
                <div class="flex-shrink-0">
                    <button id="openAddCourseModalBtn"
                        class="w-full lg:w-auto px-6 py-3 rounded-xl bg-yellow-primary text-white font-medium shadow-lg
                       hover:bg-yellow-secondary btn-hover-lift transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-primary focus:ring-opacity-50
                       flex items-center justify-center gap-2 text-sm md:text-base">
                        <i class="fas fa-plus"></i>
                        <span>Add New Course</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Search Form -->
            <form method="GET" class="w-full">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none form-input-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" id="searchInput" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>"
                        placeholder="Search by course code or name"
                        class="form-input pl-12 pr-4 py-3 w-full text-base rounded-xl shadow-sm">
                </div>
            </form>

            <div class="flex space-x-3 w-full sm:w-auto">
                <select id="statusFilter" class="border border-gray-light rounded-lg px-4 py-3 bg-white text-gray-dark w-full sm:w-auto shadow-sm focus:ring focus:ring-yellow-primary focus:ring-opacity-50">
                    <option value="">All Subject Types</option>
                    <option value="Professional Course">Professional Course</option>
                    <option value="General Education">General Education</option>
                </select>
                <span id="filterCount" class="filter-count hidden">0</span>
            </div>
        </div>

        <!-- Add Course Modal -->
        <div id="addCourseModal" class="modal fixed inset-0 backdrop-blur-md flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 transform modal-content scale-95">
                <div class="flex justify-between items-center p-6 border-b border-yellow-light bg-gradient-to-r from-white to-gray-50 rounded-t-xl">
                    <h5 class="text-xl font-bold text-gray-dark">Add New Course</h5>
                    <button id="closeAddCourseModalBtn"
                        class="text-gray-dark hover:text-gray-700 focus:outline-none bg-gray-light hover:bg-gray-200 rounded-full h-8 w-8 flex items-center justify-center transition-all duration-200"
                        aria-label="Close modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6" id="addCourseForm">
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <div>
                        <label for="course_code_add" class="block text-sm font-medium text-gray-dark mb-1">Course Code <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <input type="text" id="course_code_add" name="course_code" required
                                class="form-input pl-10 pr-4 py-3 w-full rounded-lg"
                                placeholder="e.g., CS101" aria-required="true">
                        </div>
                        <p id="courseCodeWarning" class="course-code-warning">This course code already exists.</p>
                        <p class="text-red-500 text-xs mt-1 hidden error-message">Course code is required.</p>
                    </div>
                    <div>
                        <label for="course_name_add" class="block text-sm font-medium text-gray-dark mb-1">Course Name <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <input type="text" id="course_name_add" name="course_name" required
                                class="form-input pl-10 pr-4 py-3 w-full rounded-lg"
                                placeholder="e.g., Introduction to Programming" aria-required="true">
                        </div>
                        <p class="text-red-500 text-xs mt-1 hidden error-message">Course name is required.</p>
                    </div>
                    <div>
                        <label for="subject_type_add" class="block text-sm font-medium text-gray-dark mb-1">Subject Type <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-list"></i>
                            </div>
                            <select id="subject_type_add" name="subject_type" required
                                class="form-input pl-10 pr-10 py-3 w-full rounded-lg appearance-none">
                                <option value="General Education">General Education</option>
                                <option value="Professional Course">Professional Course</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-dark"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="units_add" class="block text-sm font-medium text-gray-dark mb-1">Total Units <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <input type="number" id="units_add" name="units" value="3" min="1" required
                                class="form-input pl-10 pr-4 py-3 w-full rounded-lg"
                                aria-required="true">
                        </div>
                        <p class="text-red-500 text-xs mt-1 hidden error-message">Total units must be at least 1.</p>
                    </div>
                    <div>
                        <label for="lecture_units_add" class="block text-sm font-medium text-gray-dark mb-1">Lecture Units</label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <input type="number" id="lecture_units_add" name="lecture_units" value="0" min="0"
                                class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                        </div>
                    </div>
                    <div>
                        <label for="lab_units_add" class="block text-sm font-medium text-gray-dark mb-1">Lab Units</label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <input type="number" id="lab_units_add" name="lab_units" value="0" min="0"
                                class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                        </div>
                    </div>
                    <div>
                        <label for="lecture_hours_add" class="block text-sm font-medium text-gray-dark mb-1">Lecture Hours</label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <input type="number" id="lecture_hours_add" name="lecture_hours" value="0" min="0"
                                class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                        </div>
                    </div>
                    <div>
                        <label for="lab_hours_add" class="block text-sm font-medium text-gray-dark mb-1">Lab Hours</label>
                        <div class="relative">
                            <div class="form-input-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <input type="number" id="lab_hours_add" name="lab_hours" value="0" min="0"
                                class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                        </div>
                    </div>
                    <div class="md:col-span-2 flex justify-end space-x-3 pt-4 border-t border-yellow-light">
                        <button type="button" id="cancelAddCourseModalBtn"
                            class="bg-gray-light text-gray-dark px-5 py-3 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">Cancel</button>
                        <button type="submit" class="btn-gold px-5 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-medium">Add Course</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Course Modal -->
        <?php if ($editCourse): ?>
            <div id="editCourseModal" class="modal fixed inset-0 backdrop-blur-md flex items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 transform modal-content scale-95">
                    <div class="flex justify-between items-center p-6 border-b border-yellow-light bg-gradient-to-r from-white to-gray-50 rounded-t-xl">
                        <h5 class="text-xl font-bold text-gray-dark">Edit Course</h5>
                        <button id="closeEditCourseModalBtn"
                            class="text-gray-dark hover:text-gray-700 focus:outline-none bg-gray-light hover:bg-gray-200 rounded-full h-8 w-8 flex items-center justify-center transition-all duration-200"
                            aria-label="Close modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6" id="editCourseForm">
                        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($editCourse['course_id']); ?>">
                        <input type="hidden" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                        <div>
                            <label for="course_code_edit" class="block text-sm font-medium text-gray-dark mb-1">Course Code <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <input type="text" id="course_code_edit" name="course_code" required
                                    value="<?php echo htmlspecialchars($editCourse['course_code'] ?? ''); ?>"
                                    class="form-input pl-10 pr-4 py-3 w-full rounded-lg"
                                    placeholder="e.g., CS101" aria-required="true">
                            </div>
                            <p class="text-red-500 text-xs mt-1 hidden error-message">Course code is required.</p>
                        </div>
                        <div>
                            <label for="course_name_edit" class="block text-sm font-medium text-gray-dark mb-1">Course Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <input type="text" id="course_name_edit" name="course_name" required
                                    value="<?php echo htmlspecialchars($editCourse['course_name'] ?? ''); ?>"
                                    class="form-input pl-10 pr-4 py-3 w-full rounded-lg"
                                    placeholder="e.g., Introduction to Programming" aria-required="true">
                            </div>
                            <p class="text-red-500 text-xs mt-1 hidden error-message">Course name is required.</p>
                        </div>
                        <div>
                            <label for="subject_type_edit" class="block text-sm font-medium text-gray-dark mb-1">Subject Type <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-list"></i>
                                </div>
                                <select id="subject_type_edit" name="subject_type" required
                                    class="form-input pl-10 pr-10 py-3 w-full rounded-lg appearance-none">
                                    <option value="General Education" <?php echo ($editCourse['subject_type'] === 'General Education') ? 'selected' : ''; ?>>General Education</option>
                                    <option value="Professional Course" <?php echo ($editCourse['subject_type'] === 'Professional Course') ? 'selected' : ''; ?>>Professional Course</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-dark"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="units_edit" class="block text-sm font-medium text-gray-dark mb-1">Total Units <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <input type="number" id="units_edit" name="units" min="1" required
                                    value="<?php echo htmlspecialchars($editCourse['units'] ?? '3'); ?>"
                                    class="form-input pl-10 pr-4 py-3 w-full rounded-lg"
                                    aria-required="true">
                            </div>
                            <p class="text-red-500 text-xs mt-1 hidden error-message">Total units must be at least 1.</p>
                        </div>
                        <div>
                            <label for="lecture_units_edit" class="block text-sm font-medium text-gray-dark mb-1">Lecture Units</label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <input type="number" id="lecture_units_edit" name="lecture_units" min="0"
                                    value="<?php echo htmlspecialchars($editCourse['lecture_units'] ?? '0'); ?>"
                                    class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                            </div>
                        </div>
                        <div>
                            <label for="lab_units_edit" class="block text-sm font-medium text-gray-dark mb-1">Lab Units</label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <input type="number" id="lab_units_edit" name="lab_units" min="0"
                                    value="<?php echo htmlspecialchars($editCourse['lab_units'] ?? '0'); ?>"
                                    class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                            </div>
                        </div>
                        <div>
                            <label for="lecture_hours_edit" class="block text-sm font-medium text-gray-dark mb-1">Lecture Hours</label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <input type="number" id="lecture_hours_edit" name="lecture_hours" min="0"
                                    value="<?php echo htmlspecialchars($editCourse['lecture_hours'] ?? '0'); ?>"
                                    class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                            </div>
                        </div>
                        <div>
                            <label for="lab_hours_edit" class="block text-sm font-medium text-gray-dark mb-1">Lab Hours</label>
                            <div class="relative">
                                <div class="form-input-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <input type="number" id="lab_hours_edit" name="lab_hours" min="0"
                                    value="<?php echo htmlspecialchars($editCourse['lab_hours'] ?? '0'); ?>"
                                    class="form-input pl-10 pr-4 py-3 w-full rounded-lg">
                            </div>
                        </div>
                        <div class="md:col-span-2 flex justify-end space-x-3 pt-4 border-t border-yellow-light">
                            <button type="button" id="cancelEditCourseModalBtn"
                                class="bg-gray-light text-gray-dark px-5 py-3 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">Cancel</button>
                            <button type="submit" class="btn-gold px-5 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-medium">Update Course</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Courses Table -->
        <div class="bg-white rounded-xl shadow-lg fade-in">
            <div class="flex justify-between items-center p-6 border-b border-yellow-light bg-gradient-to-r from-white to-gray-50 rounded-t-xl">
                <h5 class="text-xl font-bold text-gray-dark">Courses List</h5>
                <div class="flex items-center gap-4">
                    <span id="resultCount" class="text-sm font-medium text-gray-600">Showing all courses</span>
                    <span class="text-sm font-medium text-gray-dark bg-yellow-light px-3 py-1 rounded-full"><?php echo $totalCourses; ?> Total</span>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="responsive-table w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="table-header text-left">Course Code</th>
                                <th class="table-header text-left">Course Name</th>
                                <th class="table-header text-left hidden sm:table-cell">Department</th>
                                <th class="table-header text-left">Subject Type</th>
                                <th class="table-header text-left hidden md:table-cell">Units</th>
                                <th class="table-header text-left hidden lg:table-cell">Lecture</th>
                                <th class="table-header text-left hidden lg:table-cell">Lab</th>
                                <th class="table-header text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="courseTableBody" class="divide-y divide-gray-100">
                            <?php if (empty($courses)): ?>
                                <tr id="noCoursesRow">
                                    <td colspan="9" class="table-cell text-center text-gray-500 py-12">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-book-open text-gray-400 text-3xl mb-3"></i>
                                            <p class="text-lg font-medium">No courses found</p>
                                            <p class="text-sm text-gray-400 mt-1">Start by adding your first course</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($courses as $course): ?>
                                    <tr class="table-row curriculum-row"
                                        data-code="<?php echo htmlspecialchars(strtolower($course['course_code'])); ?>"
                                        data-name="<?php echo htmlspecialchars(strtolower($course['course_name'])); ?>"
                                        data-department="<?php echo htmlspecialchars(strtolower($course['department_name'] ?? '')); ?>"
                                        data-subject-type="<?php echo htmlspecialchars(strtolower($course['subject_type'])); ?>">

                                        <td class="table-cell">
                                            <div class="font-semibold text-gray-900 curriculum-code">
                                                <?php echo htmlspecialchars($course['course_code']); ?>
                                            </div>
                                            <div class="sm:hidden text-xs text-gray-500 mt-1">
                                                <?php echo htmlspecialchars($course['subject_type']); ?>
                                            </div>
                                        </td>

                                        <td class="table-cell">
                                            <div class="font-medium text-gray-900 curriculum-name">
                                                <?php echo htmlspecialchars($course['course_name']); ?>
                                            </div>
                                            <div class="sm:hidden text-xs text-gray-500 mt-1 mobile-stack">
                                                <div><?php echo htmlspecialchars($course['department_name'] ?? 'N/A'); ?></div>
                                                <div><?php echo htmlspecialchars($course['units']); ?> units</div>
                                            </div>
                                        </td>

                                        <td class="table-cell hidden sm:table-cell text-gray-600">
                                            <?php echo htmlspecialchars($course['department_name'] ?? 'N/A'); ?>
                                        </td>

                                        <td class="table-cell">
                                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full curriculum-subject-type
                                                <?php echo ($course['subject_type'] === 'Professional Course')
                                                    ? 'bg-blue-100 text-blue-800'
                                                    : 'bg-green-100 text-green-800'; ?>">
                                                <?php echo htmlspecialchars($course['subject_type']); ?>
                                            </span>
                                        </td>

                                        <td class="table-cell hidden md:table-cell text-gray-600 font-medium">
                                            <?php echo htmlspecialchars($course['units']); ?>
                                        </td>

                                        <td class="table-cell hidden lg:table-cell text-gray-600 text-xs">
                                            <div><?php echo htmlspecialchars($course['lecture_units']); ?> units</div>
                                            <div class="text-gray-400"><?php echo htmlspecialchars($course['lecture_hours']); ?> hrs</div>
                                        </td>

                                        <td class="table-cell hidden lg:table-cell text-gray-600 text-xs">
                                            <div><?php echo htmlspecialchars($course['lab_units']); ?> units</div>
                                            <div class="text-gray-400"><?php echo htmlspecialchars($course['lab_hours']); ?> hrs</div>
                                        </td>

                                        <td class="table-cell">
                                            <div class="flex sm:flex-row gap-6">
                                                <div class="relative group">
                                                    <a href="courses?edit=<?php echo htmlspecialchars($course['course_id']); ?>&page=<?php echo $page; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                                        class="text-yellow-primary hover:text-yellow-900 action-icon" title="Edit Course">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <span class="tooltip">Edit</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- No results row for filtered results -->
                <div id="noResultsRow" style="display: none;" class="text-center py-12 px-6">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-search text-gray-400 text-3xl mb-3"></i>
                        <p class="text-lg font-medium text-gray-600">No courses match your criteria</p>
                        <p class="text-sm text-gray-400 mt-1">Try adjusting your search or filter settings</p>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="px-6 py-4 bg-gray-50 border-t border-yellow-200 rounded-b-xl">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-gray-600">
                            Showing <?php echo ($offset + 1); ?> to <?php echo min($offset + $perPage, $totalCourses); ?> of <?php echo $totalCourses; ?> courses
                        </div>
                        <div class="flex items-center gap-2">
                            <?php if ($page > 1): ?>
                                <a href="courses?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    Previous
                                </a>
                            <?php endif; ?>

                            <?php
                            $startPage = max(1, $page - 2);
                            $endPage = min($totalPages, $page + 2);

                            if ($startPage > 1): ?>
                                <a href="courses?page=1&search=<?php echo urlencode($searchTerm); ?>"
                                    class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">1</a>
                                <?php if ($startPage > 2): ?>
                                    <span class="px-2 text-gray-400">...</span>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <a href="courses?page=<?php echo $i; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="px-3 py-2 text-sm rounded-lg transition-colors duration-200 <?php echo $i === $page
                                                                                                            ? 'bg-yellow-primary text-white font-medium'
                                                                                                            : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50'; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>

                            <?php if ($endPage < $totalPages): ?>
                                <?php if ($endPage < $totalPages - 1): ?>
                                    <span class="px-2 text-gray-400">...</span>
                                <?php endif; ?>
                                <a href="courses?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200"><?php echo $totalPages; ?></a>
                            <?php endif; ?>

                            <?php if ($page < $totalPages): ?>
                                <a href="courses?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    Next
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Define utility functions first
        function showToast(message, bgColor) {
            const toast = document.createElement('div');
            toast.className = `toast ${bgColor} text-white px-4 py-2 rounded-lg shadow-lg`;
            toast.textContent = message;
            toast.setAttribute('role', 'alert');
            document.getElementById('toast-container').appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) {
                console.error(`Modal with ID ${modalId} not found`);
                return;
            }
            const modalContent = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            const modalContent = modal.querySelector('.modal-content');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                const form = modal.querySelector('form');
                if (form) {
                    form.reset();
                    form.querySelectorAll('.error-message').forEach(msg => msg.classList.add('hidden'));
                    form.querySelectorAll('input, select').forEach(input => input.classList.remove('border-red-500'));
                }
            }, 200);
        }

        // Function to check course code availability
        function checkCourseCodeAvailability(input) {
            const courseCode = input.value.trim();
            const warning = document.getElementById('courseCodeWarning');
            const inputField = document.querySelector('.course-code-input');

            if (courseCode.length > 0) {
                fetch('/chair/checkCourseCode', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `course_code=${encodeURIComponent(courseCode)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            warning.style.display = 'block';
                            inputField.classList.add('invalid');
                        } else {
                            warning.style.display = 'none';
                            inputField.classList.remove('invalid');
                        }
                    })
                    .catch(error => console.error('Error checking course code:', error));
            } else {
                warning.style.display = 'none';
                inputField.classList.remove('invalid');
            }
        }

        // Client-side course search and filter functionality
        let searchTimeout;

        function initializeCourseSearchAndFilter() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const filterCount = document.getElementById('filterCount');
            const tableBody = document.querySelector('#courseTableBody');
            const noResultsRow = document.getElementById('noResultsRow');
            const resultCount = document.getElementById('resultCount');

            function filterCourses() {
                const searchTerm = searchInput.value.toLowerCase();
                const filterType = statusFilter.value;
                const rows = tableBody.querySelectorAll('.curriculum-row');
                let visibleCount = 0;

                rows.forEach(row => {
                    const code = row.dataset.code || '';
                    const name = row.dataset.name || '';
                    const department = row.dataset.department || '';
                    const subjectType = row.dataset.subjectType || '';
                    const status = row.dataset.status || '';

                    const matchesSearch = searchTerm === '' ||
                        code.includes(searchTerm) ||
                        name.includes(searchTerm) ||
                        department.includes(searchTerm) ||
                        subjectType.includes(searchTerm);

                    const matchesFilter = filterType === '' ||
                        subjectType === filterType.toLowerCase();

                    if (matchesSearch && matchesFilter) {
                        row.style.display = '';
                        visibleCount++;
                        if (searchTerm !== '') {
                            highlightText(row, searchTerm);
                        } else {
                            removeHighlight(row);
                        }
                    } else {
                        row.style.display = 'none';
                        removeHighlight(row);
                    }
                });

                // Update no results message
                noResultsRow.style.display = visibleCount === 0 ? '' : 'none';
                if (visibleCount === 0) {
                    const message = noResultsRow.querySelector('p:first-of-type');
                    message.textContent = searchTerm || filterType ? 'No courses match your criteria' : 'No courses found';
                }

                // Update result count
                resultCount.textContent = `Showing ${visibleCount} course${visibleCount !== 1 ? 's' : ''}`;

                // Update filter count
                filterCount.textContent = visibleCount;
                filterCount.classList.toggle('hidden', filterType === '');
            }

            function highlightText(row, searchTerm) {
                const elementsToHighlight = row.querySelectorAll('.curriculum-code, .curriculum-name, .curriculum-subject-type');
                elementsToHighlight.forEach(element => {
                    const text = element.textContent;
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    element.innerHTML = text.replace(regex, '<span class="search-highlight">$1</span>');
                });
            }

            function removeHighlight(row) {
                const highlightedElements = row.querySelectorAll('.search-highlight');
                highlightedElements.forEach(element => {
                    const parent = element.parentNode;
                    parent.replaceChild(document.createTextNode(element.textContent), element);
                    parent.normalize();
                });
            }

            // Event listeners
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(filterCourses, 300);
            });

            statusFilter.addEventListener('change', function() {
                statusFilter.classList.toggle('filter-active', this.value !== '');
                filterCourses();
            });

            // Initial filter to handle pre-loaded search term or filter
            if (searchInput.value || statusFilter.value) {
                filterCourses();
            }
        }

        // Function to update hours based on units
        function updateHours() {
            const forms = ['addCourseForm', 'editCourseForm'];
            forms.forEach(formId => {
                const form = document.getElementById(formId);
                if (form) {
                    const lectureUnits = form.querySelector('[name="lecture_units"]');
                    const labUnits = form.querySelector('[name="lab_units"]');
                    const lectureHours = form.querySelector('[name="lecture_hours"]');
                    const labHours = form.querySelector('[name="lab_hours"]');

                    if (lectureUnits && lectureHours) {
                        lectureHours.value = parseInt(lectureUnits.value) || 0; // 1 unit = 1 hour
                    }
                    if (labUnits && labHours) {
                        labHours.value = (parseInt(labUnits.value) * 2) || 0; // 1 unit = 2 hours
                    }
                }
            });
        }

        // Event listeners and initialization
        document.addEventListener('DOMContentLoaded', () => {
            // Show toast messages
            <?php if ($success): ?>
                showToast('<?php echo htmlspecialchars($success); ?>', 'bg-green-500');
            <?php endif; ?>
            <?php if ($error): ?>
                showToast('<?php echo htmlspecialchars($error); ?>', 'bg-red-500');
            <?php endif; ?>

            // Initialize course search and filter
            initializeCourseSearchAndFilter();

            // Modal event listeners
            const openAddCourseModalBtn = document.getElementById('openAddCourseModalBtn');
            const closeAddCourseModalBtn = document.getElementById('closeAddCourseModalBtn');
            const cancelAddCourseModalBtn = document.getElementById('cancelAddCourseModalBtn');

            if (openAddCourseModalBtn) {
                openAddCourseModalBtn.addEventListener('click', () => openModal('addCourseModal'));
            }
            if (closeAddCourseModalBtn) {
                closeAddCourseModalBtn.addEventListener('click', () => closeModal('addCourseModal'));
            }
            if (cancelAddCourseModalBtn) {
                cancelAddCourseModalBtn.addEventListener('click', () => closeModal('addCourseModal'));
            }

            const closeEditCourseModalBtn = document.getElementById('closeEditCourseModalBtn');
            const cancelEditCourseModalBtn = document.getElementById('cancelEditCourseModalBtn');

            if (closeEditCourseModalBtn) {
                closeEditCourseModalBtn.addEventListener('click', () => closeModal('editCourseModal'));
            }
            if (cancelEditCourseModalBtn) {
                cancelEditCourseModalBtn.addEventListener('click', () => closeModal('editCourseModal'));
            }

            <?php if ($editCourse): ?>
                openModal('editCourseModal');
            <?php endif; ?>

                ['addCourseModal', 'editCourseModal'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.addEventListener('click', (e) => {
                            if (e.target === modal) closeModal(modalId);
                        });
                    }
                });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    ['addCourseModal', 'editCourseModal'].forEach(modalId => {
                        const modal = document.getElementById(modalId);
                        if (modal && !modal.classList.contains('hidden')) closeModal(modalId);
                    });
                }
            });

            ['addCourseForm', 'editCourseForm'].forEach(formId => {
                const form = document.getElementById(formId);
                if (form) {
                    form.addEventListener('submit', (e) => {
                        let isValid = true;
                        form.querySelectorAll('input[required], select[required]').forEach(input => {
                            const errorMessage = input.nextElementSibling;
                            if (!input.value.trim()) {
                                input.classList.add('border-red-500');
                                errorMessage.classList.remove('hidden');
                                isValid = false;
                            } else {
                                input.classList.remove('border-red-500');
                                errorMessage.classList.add('hidden');
                            }
                        });

                        const unitsInput = form.querySelector('[name="units"]');
                        const unitsError = unitsInput.nextElementSibling;
                        if (unitsInput.value < 1) {
                            unitsInput.classList.add('border-red-500');
                            unitsError.classList.remove('hidden');
                            isValid = false;
                        } else {
                            unitsInput.classList.remove('border-red-500');
                            unitsError.classList.add('hidden');
                        }

                        if (!isValid) e.preventDefault();
                    });

                    form.querySelectorAll('input[required], select[required]').forEach(input => {
                        input.addEventListener('input', () => {
                            const errorMessage = input.nextElementSibling;
                            if (input.value.trim()) {
                                input.classList.remove('border-red-500');
                                errorMessage.classList.add('hidden');
                            }
                        });
                    });

                    form.querySelector('[name="units"]').addEventListener('input', function() {
                        const errorMessage = this.nextElementSibling;
                        if (this.value >= 1) {
                            this.classList.remove('border-red-500');
                            errorMessage.classList.add('hidden');
                        }
                    });

                    const lectureUnits = form.querySelector('[name="lecture_units"]');
                    const labUnits = form.querySelector('[name="lab_units"]');

                    if (lectureUnits) {
                        lectureUnits.addEventListener('input', updateHours);
                    }
                    if (labUnits) {
                        labUnits.addEventListener('input', updateHours);
                    }

                    // Initial update when form loads (e.g., for edit mode)
                    updateHours();
                }
            });

            // Add course code availability check
            const courseCodeInput = document.getElementById('course_code_add');
            if (courseCodeInput) {
                courseCodeInput.addEventListener('input', function() {
                    checkCourseCodeAvailability(this);
                });
            }
        });
    </script>
</body>

</html>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>