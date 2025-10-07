<?php
ob_start();
?>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 font-sans text-gray-800">
    <div class="container mx-auto p-6 lg:p-12">

        <!-- Enhanced Notifications -->
        <?php if (isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg mb-6 shadow-sm animate-fade-in" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-red-800 font-medium"><?php echo nl2br(htmlspecialchars($error)); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg mb-6 shadow-sm animate-fade-in" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-800 font-medium"><?php echo htmlspecialchars($success); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Enhanced Filter Form -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8 border border-gray-200">
            <div class="flex items-center mb-6">
                <div class="bg-blue-100 rounded-lg p-2 mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900">Filter Options</h3>
            </div>

            <form method="POST" action="/chair/schedule_history" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <input type="hidden" name="tab" value="history">

                <!-- Semester Dropdown with enhanced styling -->
                <div class="space-y-1">
                    <label for="semester_id" class="block text-sm font-semibold text-gray-700">Semester</label>
                    <div class="relative">
                        <select name="semester_id" id="semester_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white hover:border-yellow-400" onchange="this.form.submit()">
                            <option value="">All Semesters</option>
                            <?php foreach ($allSemesters as $semester): ?>
                                <option value="<?php echo htmlspecialchars($semester['semester_id']); ?>"
                                    <?php echo (isset($_POST['semester_id']) && $_POST['semester_id'] == $semester['semester_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($semester['semester_name'] . ' - ' . $semester['academic_year']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Academic Year Dropdown with enhanced styling -->
                <div class="space-y-1">
                    <label for="academic_year" class="block text-sm font-semibold text-gray-700">Academic Year</label>
                    <div class="relative">
                        <select name="academic_year" id="academic_year" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white hover:border-yellow-400" onchange="this.form.submit()">
                            <option value="">All Years</option>
                            <?php
                            $years = array_unique(array_column($allSemesters, 'academic_year'));
                            rsort($years); // Most recent first
                            foreach ($years as $year): ?>
                                <option value="<?php echo htmlspecialchars($year); ?>"
                                    <?php echo (isset($_POST['academic_year']) && $_POST['academic_year'] == $year) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($year); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="md:col-span-1">
                    <button type="submit" class="w-full bg-gradient-to-r from-yellow-600 to-yellow-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:from-yellow-700 hover:to-yellow-800 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transform hover:scale-105">
                        <div class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            View History
                        </div>
                    </button>
                </div>

                <!-- Clear Filters Button -->
                <div class="md:col-span-1">
                    <a href="/chair/schedule_history" class="w-full block text-center bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg shadow hover:bg-gray-200 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Clear Filters
                    </a>
                </div>
            </form>
        </div>

        <!-- Professional Table Display -->
        <?php if (!empty($historicalSchedules)): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-white">Historical Schedules</h3>
                            <p class="text-gray-300 mt-1"><?php echo count($historicalSchedules); ?> record(s) found</p>
                        </div>
                        <div class="flex space-x-3">
                            <!-- Export buttons -->
                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export
                            </button>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                Print
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>Period</span>
                                        <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Subject Code</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Subject Title</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Instructor</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Schedule</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Room</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Units</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $currentPeriod = '';
                            $rowCount = 0;
                            foreach ($historicalSchedules as $schedule):
                                $rowCount++;
                                $period = $schedule['semester_name'] . ' - ' . $schedule['academic_year'];
                                $showPeriod = ($period !== $currentPeriod);
                                $currentPeriod = $period;
                            ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-150 <?php echo $rowCount % 2 == 0 ? 'bg-gray-25' : 'bg-white'; ?>">
                                    <?php if ($showPeriod): ?>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-yellow-100 rounded-full p-2 mr-3">
                                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($schedule['semester_name']); ?></div>
                                                    <div class="text-xs text-gray-500"><?php echo htmlspecialchars($schedule['academic_year']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-8 h-1 bg-gray-300 rounded"></div>
                                        </td>
                                    <?php endif; ?>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900 bg-blue-100 px-2 py-1 rounded inline-block">
                                            <?php echo htmlspecialchars($schedule['course_code'] ?? 'N/A'); ?>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($schedule['course_name'] ?? 'N/A'); ?>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="bg-green-100 rounded-full p-1 mr-2">
                                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="text-sm text-gray-900">
                                                <?php echo htmlspecialchars($schedule['faculty_name'] ?? 'TBA'); ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <div class="font-medium"><?php echo htmlspecialchars($schedule['day_of_week'] ?? 'TBA'); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo htmlspecialchars($schedule['start_time'] . '-' . $schedule['end_time'] ?? 'TBA'); ?></div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            <?php echo htmlspecialchars($schedule['room_name'] ?? 'TBA'); ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            <?php echo htmlspecialchars(isset($schedule['units']) ? $schedule['units'] : '3'); // Default to 3 if not present 
                                            ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer with Stats -->
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="text-sm text-gray-600">
                                Total Records: <span class="font-semibold text-gray-900"><?php echo count($historicalSchedules); ?></span>
                            </div>
                            <div class="text-sm text-gray-600">
                                Total Units: <span class="font-semibold text-gray-900"><?php echo array_sum(array_column($historicalSchedules, 'units')) ?: '0'; ?></span>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500">
                            Last updated: <?php echo date('M d, Y H:i'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-200">
                <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Historical Records Found</h3>
                <p class="text-gray-600 mb-6">There are no schedule records matching your current filter criteria.</p>
                <a href="/chair/schedule_history" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Clear All Filters
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add custom styles for animations -->
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    .bg-gray-25 {
        background-color: #fafafa;
    }

    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>