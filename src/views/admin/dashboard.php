<?php
ob_start();
?>

<style>
    /* Custom styles for better table presentation */
    .table-container {
        min-height: 400px;
    }

    .schedule-table {
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .schedule-table {
            font-size: 0.75rem;
        }

        .schedule-table th,
        .schedule-table td {
            padding: 0.5rem 0.25rem;
        }
    }

    .activity-logs-container {
        max-height: 600px;
        overflow-y: auto;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
        font-size: 0.75rem;
        font-weight: 500;
    }
</style>

<div class="min-h-screen">

    <!-- Main Content -->
    <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- Success/Error Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 mb-8 rounded-xl" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-6 h-6 bg-amber-500 rounded-xl flex items-center justify-center">
                            <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-amber-800 font-medium"><?php echo htmlspecialchars($_SESSION['success']);
                                                                unset($_SESSION['success']); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-xl" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-6 h-6 bg-red-500 rounded-xl flex items-center justify-center">
                            <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-red-800 font-medium"><?php echo htmlspecialchars($_SESSION['error']);
                                                            unset($_SESSION['error']); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Main Header Section -->
        <div class="bg-gray-800 text-white rounded-xl p-6 mb-8">
            <div class="border-l-4 border-amber-500 pl-4">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-4 lg:mb-0">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold">PRMSU Scheduling System</h1>
                                <?php if (isset($departmentName) && !empty($departmentName)): ?>
                                    <p class="text-amber-300 mt-1">Department of <?php echo htmlspecialchars($departmentName); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="text-gray-300">Welcome to your comprehensive scheduling dashboard.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="bg-gray-700 px-3 py-2 rounded-xl flex items-center">
                            <svg class="w-4 h-4 mr-2 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium">
                                <?php echo htmlspecialchars($semesterInfo ?? 'Current Semester', ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </div>
                        <div class="bg-amber-500 px-3 py-2 rounded-xl flex items-center">
                            <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-sm font-medium">Active Term</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-white rounded-xl border border-gray-200">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">
                                <?php echo htmlspecialchars($userCount ?? '0', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="text-xs font-medium text-gray-500 uppercase">Total Users</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="h-1 bg-amber-500 rounded-xl flex-1 mr-3"></div>
                        <a href="/admin/users" class="text-sm font-medium text-amber-600 hover:text-amber-800">
                            View →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Colleges Card -->
            <div class="bg-white rounded-xl border border-gray-200">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">
                                <?php echo htmlspecialchars($collegeCount ?? '0', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="text-xs font-medium text-gray-500 uppercase">Total Colleges</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="h-1 bg-amber-500 rounded-xl flex-1 mr-3"></div>
                        <a href="/admin/colleges" class="text-sm font-medium text-amber-600 hover:text-amber-800">
                            Manage →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Departments Card -->
            <div class="bg-white rounded-xl border border-gray-200">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">
                                <?php echo htmlspecialchars($departmentCount ?? '0', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="text-xs font-medium text-gray-500 uppercase">Total Departments</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="h-1 bg-amber-500 rounded-xl flex-1 mr-3"></div>
                        <a href="/admin/colleges" class="text-sm font-medium text-amber-600 hover:text-amber-800">
                            Manage →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Faculty Card -->
            <div class="bg-white rounded-xl border border-gray-200">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">
                                <?php echo htmlspecialchars($facultyCount ?? '0', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="text-xs font-medium text-gray-500 uppercase">Total Faculty</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="h-1 bg-amber-500 rounded-xl flex-1 mr-3"></div>
                        <a href="/admin/faculty" class="text-sm font-medium text-amber-600 hover:text-amber-800">
                            View →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Schedules Card -->
            <div class="bg-white rounded-xl border border-gray-200">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">
                                <?php echo htmlspecialchars($scheduleCount ?? '0', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="text-xs font-medium text-gray-500 uppercase">Total Schedules</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="h-1 bg-amber-500 rounded-xl flex-1 mr-3"></div>
                        <a href="/admin/schedules" class="text-sm font-medium text-amber-600 hover:text-amber-800">
                            View →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Semester Selection Form -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-amber-500 rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Semester Configuration</h2>
                    <p class="text-gray-600 text-sm mt-1">Set the current active academic semester</p>
                </div>
            </div>

            <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="semester_name" class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                    <select id="semester_name" name="semester_name" class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="1st" <?php echo $currentSemester && $currentSemester['semester_name'] === '1st' ? 'selected' : ''; ?>>1st Semester</option>
                        <option value="2nd" <?php echo $currentSemester && $currentSemester['semester_name'] === '2nd' ? 'selected' : ''; ?>>2nd Semester</option>
                        <option value="Summer" <?php echo $currentSemester && $currentSemester['semester_name'] === 'Summer' ? 'selected' : ''; ?>>Mid Year</option>
                    </select>
                </div>

                <div>
                    <label for="academic_year" class="block text-sm font-medium text-gray-700 mb-2">Academic Year</label>
                    <input type="text" id="academic_year" name="academic_year"
                        value="<?php echo htmlspecialchars($currentSemester['academic_year'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                        placeholder="e.g., 2024-2025">
                </div>

                <div class="flex items-end">
                    <button type="submit" name="set_semester"
                        class="w-full bg-amber-500 text-white px-4 py-2 rounded-xl hover:bg-amber-600 font-medium">
                        Update Semester
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 lg:gap-8">
            <!-- My Schedule Section -->
            <div class="xl:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 h-full">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <h3 class="text-xl font-semibold text-gray-900">My Schedule</h3>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium"><?php echo htmlspecialchars($semesterInfo ?? '2nd Semester 2024-2025'); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Table Container -->
                    <div class="table-container">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 schedule-table">
                                <thead class="bg-yellow-600">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Course Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Course Code</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Section</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Room</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Day</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Time</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Type</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    <?php if (isset($schedules) && !empty($schedules)): ?>
                                        <?php foreach ($schedules as $schedule): ?>
                                            <tr class="hover:bg-yellow-50 transition-colors duration-200">
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($schedule['course_name'] ?? 'N/A'); ?></div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-semibold text-gray-700"><?php echo htmlspecialchars($schedule['course_code'] ?? 'N/A'); ?></div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <span class="inline-flex px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full"><?php echo htmlspecialchars($schedule['section_name'] ?? 'N/A'); ?></span>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-600"><?php echo htmlspecialchars($schedule['room_name'] ?? 'TBD'); ?></div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($schedule['day_of_week'] ?? 'N/A'); ?></div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-600"><?php echo htmlspecialchars(($schedule['start_time'] ?? '') . ' - ' . ($schedule['end_time'] ?? '') ?: 'N/A'); ?></div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <span class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full"><?php echo htmlspecialchars($schedule['schedule_type'] ?? 'N/A'); ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No schedules found</h3>
                                                    <p class="text-gray-500 text-center max-w-sm">No schedules found for this term.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <div class="flex justify-end">
                            <a href="/chair/my_schedule" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                View Full Schedule
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Logs -->
            <div class="xl:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 h-full flex flex-col">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200 flex-shrink-0">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-yellow-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Table Container with scroll -->
                    <div class="activity-logs-container flex-1 overflow-hidden">
                        <div class="overflow-x-auto h-full">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">User</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Action</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">Entity</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Description</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    <?php
                                    try {
                                        $stmt = $controller->db->prepare("
                                            SELECT al.log_id, al.action_type, al.action_description, al.entity_type, al.entity_id, 
                                                   al.created_at, u.first_name, u.last_name
                                            FROM activity_logs al
                                            JOIN users u ON al.user_id = u.user_id
                                            ORDER BY al.created_at DESC
                                            LIMIT 5
                                        ");
                                        $stmt->execute();
                                        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        if (empty($logs)) {
                                            echo '<tr><td colspan="5" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                    </svg>
                                                    <p class="text-gray-500 font-medium">No recent activity logs found</p>
                                                    <p class="text-gray-400 text-sm mt-1">Activity will appear here as users interact with the system</p>
                                                </div>
                                              </td></tr>';
                                        } else {
                                            foreach ($logs as $index => $log) {
                                                $bgClass = $index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                                                echo '<tr class="' . $bgClass . ' hover:bg-yellow-50 transition-colors duration-200">';

                                                // User column
                                                echo '<td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="user-avatar mr-3">
                                                            ' . strtoupper(substr($log['first_name'], 0, 1)) . strtoupper(substr($log['last_name'], 0, 1)) . '
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-900 truncate max-w-24">' . htmlspecialchars($log['first_name'] . ' ' . $log['last_name'], ENT_QUOTES, 'UTF-8') . '</div>
                                                    </div>
                                                  </td>';

                                                // Action column
                                                echo '<td class="px-4 py-4 whitespace-nowrap">
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        ' . htmlspecialchars($log['action_type'], ENT_QUOTES, 'UTF-8') . '
                                                    </span>
                                                  </td>';

                                                // Entity column (hidden on mobile)
                                                echo '<td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600 hidden md:table-cell">' . htmlspecialchars($log['entity_type'] ?? 'N/A', ENT_QUOTES, 'UTF-8') . '</td>';

                                                // Description column (hidden on mobile and tablet)
                                                echo '<td class="px-4 py-4 text-sm text-gray-600 max-w-xs truncate hidden lg:table-cell" title="' . htmlspecialchars($log['action_description'] ?? 'No description', ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($log['action_description'] ?? 'No description', ENT_QUOTES, 'UTF-8') . '</td>';

                                                // Date column
                                                echo '<td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="text-sm font-medium text-gray-900">' . date('M d, Y', strtotime($log['created_at'])) . '</div>
                                                    <div class="text-xs text-gray-500">' . date('H:i', strtotime($log['created_at'])) . '</div>
                                                  </td>';

                                                echo '</tr>';
                                            }
                                        }
                                    } catch (PDOException $e) {
                                        error_log("Activity logs error: " . $e->getMessage());
                                        echo '<tr><td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-red-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                                <p class="text-red-600 font-medium">Error loading activity logs</p>
                                                <p class="text-red-400 text-sm mt-1">Please try refreshing the page or contact support</p>
                                            </div>
                                          </td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex-shrink-0">
                        <a href="/admin/act_logs" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm w-full justify-center">
                            View All Activity Logs
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $content = ob_get_clean();
    require_once __DIR__ . '/layout.php';
    ?>