<?php
ob_start();
?>

<link rel="stylesheet" href="/css/schedule_management.css">

<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-yellow-500 p-3 rounded-lg">
                        <i class="fas fa-calendar-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Schedule Management</h1>
                        <p class="text-sm text-gray-600">Organize and manage academic schedules</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Print Options -->
                    <div class="relative">
                        <button id="printDropdownBtn" onclick="togglePrintDropdown()" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                            <i class="fas fa-print"></i>
                            <span>Print Options</span>
                            <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div id="printDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                            <div class="py-1">
                                <button onclick="printSchedule('all')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-calendar mr-2"></i>Print All Schedules
                                </button>
                                <button onclick="printSchedule('filtered')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-filter mr-2"></i>Print Filtered View
                                </button>
                                <button onclick="exportSchedule('excel')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-file-excel mr-2"></i>Export to Excel
                                </button>
                                <button onclick="exportSchedule('pdf')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-file-pdf mr-2"></i>Export to PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Notifications -->
        <?php if (isset($error)): ?>
            <div class="mb-6 flex items-center p-4 bg-red-50 border border-red-200 rounded-lg">
                <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                <p class="text-sm font-medium text-red-800"><?php echo nl2br(htmlspecialchars($error)); ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-lg">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <p class="text-sm font-medium text-green-800"><?php echo htmlspecialchars($success); ?></p>
            </div>
        <?php endif; ?>

        <!-- Navigation Tabs -->
        <div class="mb-8">
            <nav class="flex space-x-1 bg-white rounded-lg p-1 shadow-sm border border-gray-200">
                <button onclick="switchTab('generate')" id="tab-generate" class="tab-button flex-1 py-3 px-4 text-sm font-medium rounded-md transition-all duration-200 <?php echo $activeTab === 'generate' ? 'bg-yellow-500 text-white' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100'; ?>">
                    <i class="fas fa-magic mr-2"></i>
                    <span class="hidden sm:inline">Generate Schedules</span>
                    <span class="sm:hidden">Generate</span>
                </button>
                <button onclick="switchTab('manual')" id="tab-manual" class="tab-button flex-1 py-3 px-4 text-sm font-medium rounded-md transition-all duration-200 <?php echo $activeTab === 'manual' ? 'bg-yellow-500 text-white' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100'; ?>">
                    <i class="fas fa-edit mr-2"></i>
                    <span class="hidden sm:inline">Manual Edit</span>
                    <span class="sm:hidden">Manual</span>
                </button>
                <button onclick="switchTab('schedule')" id="tab-schedule" class="tab-button flex-1 py-3 px-4 text-sm font-medium rounded-md transition-all duration-200 <?php echo $activeTab === 'schedule-list' ? 'bg-yellow-500 text-white' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100'; ?>">
                    <i class="fas fa-calendar mr-2"></i>
                    <span class="hidden sm:inline">View Schedule</span>
                    <span class="sm:hidden">View</span>
                </button>
            </nav>
        </div>

        <!-- Generate Tab -->
        <div id="content-generate" class="tab-content <?php echo $activeTab !== 'generate' ? 'hidden' : ''; ?>">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center mb-6">
                    <div class="bg-yellow-500 p-2 rounded-lg mr-3">
                        <i class="fas fa-magic text-white"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Generate Schedules</h2>
                </div>

                <form id="generate-form" class="space-y-6">
                    <input type="hidden" name="tab" value="generate">
                    <input type="hidden" name="semester_id" value="<?php echo htmlspecialchars($currentSemester['semester_id'] ?? ''); ?>">

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-yellow-600 mr-2"></i>
                            <span class="text-sm font-medium text-gray-800">Current Semester: <?php echo htmlspecialchars($currentSemester['semester_name'] ?? 'Not Set'); ?> Semester</span>
                            <span class="text-sm font-medium text-gray-800 ml-4">A.Y <?php echo htmlspecialchars($currentSemester['academic_year'] ?? 'Not Set'); ?></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Curriculum</label>
                            <select name="curriculum_id" id="curriculum_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 bg-white" onchange="updateCourses()" required>
                                <option value="">Select Curriculum</option>
                                <?php foreach ($curricula as $curriculum): ?>
                                    <option value="<?php echo htmlspecialchars($curriculum['curriculum_id']); ?>">
                                        <?php echo htmlspecialchars($curriculum['curriculum_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Available Courses</h3>
                            <div id="courses-list" class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 h-80 overflow-y-auto">
                                <p class="text-sm text-gray-600">Please select a curriculum to view available courses.</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Available Sections</h3>
                            <div id="sections-list" class="bg-white border scroll-auto border-gray-200 rounded-lg shadow-sm p-4 h-80 overflow-y-auto">
                                <?php if (!empty($jsData['sectionsData'])): ?>
                                    <ul class="list-disc pl-5 text-sm text-gray-700">
                                        <?php foreach ($jsData['sectionsData'] as $section): ?>
                                            <li class="py-1">
                                                <?php echo htmlspecialchars($section['section_name']); ?> -
                                                <?php echo htmlspecialchars($section['year_level']); ?>
                                                (Students: <?php echo htmlspecialchars($section['current_students']); ?>/<?php echo htmlspecialchars($section['max_students']); ?>)
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-sm text-red-600">No sections found for the current semester.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="generate-btn" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-8 py-3 rounded-lg shadow-sm transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-magic mr-2"></i>
                            Generate Schedules
                        </button>
                    </div>
                </form>

                <!-- Generation Results -->
                <div id="generation-results" class="hidden mt-8 p-6 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-green-800">Schedules Generated Successfully!</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white p-3 rounded-lg text-center">
                            <div class="text-2xl font-bold text-green-600" id="total-courses">0</div>
                            <div class="text-gray-600">Courses Scheduled</div>
                        </div>
                        <div class="bg-white p-3 rounded-lg text-center">
                            <div class="text-2xl font-bold text-green-600" id="total-sections">0</div>
                            <div class="text-gray-600">Sections</div>
                        </div>
                        <div class="bg-white p-3 rounded-lg text-center">
                            <div class="text-2xl font-bold text-green-600" id="success-rate">100%</div>
                            <div class="text-gray-600">Success Rate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Edit Tab -->
        <div id="content-manual" class="tab-content <?php echo $activeTab !== 'manual' ? 'hidden' : ''; ?>">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-yellow-500 p-2 rounded-lg mr-3">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Manual Schedule Editor</h2>
                    </div>
                    <div class="flex items-center space-x-4 no-print">
                        <select id="filter-year-manual" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="filterSchedulesManual()">
                            <option value="">All Year Levels</option>
                            <?php $yearLevels = array_unique(array_column($schedules, 'year_level')); ?>
                            <?php foreach ($yearLevels as $year): ?>
                                <option value="<?php echo htmlspecialchars($year); ?>"><?php echo htmlspecialchars($year); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="filter-section-manual" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="filterSchedulesManual()">
                            <option value="">All Sections</option>
                            <?php $sectionNames = array_unique(array_column($schedules, 'section_name')); ?>
                            <?php foreach ($sectionNames as $section): ?>
                                <option value="<?php echo htmlspecialchars($section); ?>"><?php echo htmlspecialchars($section); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="filter-room-manual" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="filterSchedulesManual()">
                            <option value="">All Rooms</option>
                            <?php $rooms = array_unique(array_column($schedules, 'room_name')); ?>
                            <?php foreach ($rooms as $room): ?>
                                <option value="<?php echo htmlspecialchars($room ?? 'Online'); ?>"><?php echo htmlspecialchars($room ?? 'Online'); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button id="add-schedule-btn" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors" onclick="openAddModal()">
                            <i class="fas fa-plus"></i>
                            <span>Add Schedule</span>
                        </button>
                        <button id="save-changes-btn" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors" onclick="saveAllChanges()">
                            <i class="fas fa-save"></i>
                            <span>Save Changes</span>
                        </button>
                        <button id="delete-all-btn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors" onclick="deleteAllSchedules()">
                            <i class="fas fa-trash"></i>
                            <span>Delete All Schedules</span>
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="min-w-full">
                        <!-- Header with days -->
                        <div class="grid grid-cols-7 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                            <div class="px-4 py-3 text-sm font-semibold text-gray-700 border-r border-gray-200 bg-gray-50">
                                Time
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Monday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Tuesday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Wednesday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Thursday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Friday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700">
                                Saturday
                            </div>
                        </div>

                        <!-- Time slots -->
                        <div id="schedule-grid" class="divide-y divide-gray-200">
                            <?php
                            $timeSlots = [
                                ['07:30', '08:30'],
                                ['08:30', '10:00'],
                                ['10:00', '11:00'],
                                ['11:00', '12:30'],
                                ['12:30', '13:30'],
                                ['13:00', '14:30'],
                                ['14:30', '15:30'],
                                ['15:30', '17:00'],
                                ['17:00', '18:00']
                            ];

                            $scheduleGrid = [];
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                            foreach ($schedules as $schedule) {
                                $day = $schedule['day_of_week'];
                                $startTime = substr($schedule['start_time'], 0, 5);
                                $endTime = substr($schedule['end_time'], 0, 5);

                                if (!isset($scheduleGrid[$day])) {
                                    $scheduleGrid[$day] = [];
                                }

                                if (!isset($scheduleGrid[$day][$startTime])) {
                                    $scheduleGrid[$day][$startTime] = [];
                                }
                                $scheduleGrid[$day][$startTime][] = $schedule;
                            }
                            ?>

                            <?php foreach ($timeSlots as $time): ?>
                                <?php
                                $duration = strtotime($time[1]) - strtotime($time[0]);
                                $rowSpan = $duration / 7200;
                                ?>
                                <div class="grid grid-cols-7 min-h-[<?php echo $rowSpan * 80; ?>px] hover:bg-gray-50 transition-colors duration-200" style="grid-row: span <?php echo $rowSpan; ?>;">
                                    <div class="px-4 py-3 text-sm font-medium text-gray-600 border-r border-gray-200 bg-gray-50 flex items-center" rowspan="<?php echo $rowSpan; ?>">
                                        <span class="text-lg"><?php echo date('g:i A', strtotime($time[0])) . ' - ' . date('g:i A', strtotime($time[1])); ?></span>
                                    </div>
                                    <?php foreach ($days as $day): ?>
                                        <div class="px-2 py-2 border-r border-gray-200 last:border-r-0 min-h-[<?php echo $rowSpan * 80; ?>px] relative drop-zone"
                                            data-day="<?php echo $day; ?>"
                                            data-start-time="<?php echo $time[0]; ?>"
                                            data-end-time="<?php echo $time[1]; ?>">
                                            <?php
                                            $schedulesForSlot = isset($scheduleGrid[$day][$time[0]]) ? $scheduleGrid[$day][$time[0]] : [];
                                            foreach ($schedulesForSlot as $schedule) {
                                                $scheduleStart = substr($schedule['start_time'], 0, 5);
                                                $scheduleEnd = substr($schedule['end_time'], 0, 5);
                                                if ($scheduleStart === $time[0]) {
                                                    $colors = [
                                                        'bg-blue-100 border-blue-300 text-blue-800',
                                                        'bg-green-100 border-green-300 text-green-800',
                                                        'bg-purple-100 border-purple-300 text-purple-800',
                                                        'bg-orange-100 border-orange-300 text-orange-800',
                                                        'bg-pink-100 border-pink-300 text-pink-800'
                                                    ];
                                                    $colorClass = $colors[array_rand($colors)];
                                            ?>
                                                    <div class="schedule-card <?php echo $colorClass; ?> p-2 rounded-lg border-l-4 mb-1 draggable cursor-move"
                                                        draggable="true"
                                                        data-schedule-id="<?php echo $schedule['schedule_id']; ?>"
                                                        data-year-level="<?php echo htmlspecialchars($schedule['year_level']); ?>"
                                                        data-section-name="<?php echo htmlspecialchars($schedule['section_name']); ?>"
                                                        data-room-name="<?php echo htmlspecialchars($schedule['room_name'] ?? 'Online'); ?>">
                                                        <div class="flex justify-between items-start mb-2">
                                                            <div class="font-semibold text-xs truncate mb-1">
                                                                <?php echo htmlspecialchars($schedule['course_code']); ?>
                                                            </div>
                                                            <button onclick="editSchedule('<?php echo $schedule['schedule_id']; ?>')" class="text-yellow-600 hover:text-yellow-700 text-xs no-print">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </div>
                                                        <div class="text-xs opacity-90 truncate mb-1">
                                                            <?php echo htmlspecialchars($schedule['section_name']); ?>
                                                        </div>
                                                        <div class="text-xs opacity-75 truncate">
                                                            <?php echo htmlspecialchars($schedule['faculty_name']); ?>
                                                        </div>
                                                        <div class="text-xs opacity-75 truncate">
                                                            <?php echo htmlspecialchars($schedule['room_name'] ?? 'Online'); ?>
                                                        </div>
                                                        <div class="text-xs font-medium mt-1">
                                                            <?php echo date('g:i A', strtotime($schedule['start_time'])) . ' - ' . date('g:i A', strtotime($schedule['end_time'])); ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            }
                                            if (empty($schedulesForSlot)) {
                                                ?>
                                                <button onclick="openAddModalForSlot('<?php echo $day; ?>', '<?php echo $time[0]; ?>', '<?php echo $time[1]; ?>')" class="w-full h-full text-gray-400 hover:text-gray-600 hover:bg-yellow-50 rounded-lg border-2 border-dashed border-gray-300 hover:border-yellow-400 transition-all duration-200 no-print">
                                                    <i class="fas fa-plus text-lg"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Schedule Tab -->
        <div id="content-schedule" class="tab-content <?php echo $activeTab !== 'schedule-list' ? 'hidden' : ''; ?>">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <!-- Header with Filters -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-yellow-500 p-2 rounded-lg mr-3">
                            <i class="fas fa-calendar text-white"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Weekly Schedule View</h2>
                    </div>
                    <div class="flex items-center space-x-4 no-print">
                        <select id="filter-year" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="filterSchedules()">
                            <option value="">All Year Levels</option>
                            <?php $yearLevels = array_unique(array_column($schedules, 'year_level')); ?>
                            <?php foreach ($yearLevels as $year): ?>
                                <option value="<?php echo htmlspecialchars($year); ?>"><?php echo htmlspecialchars($year); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="filter-section" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="filterSchedules()">
                            <option value="">All Sections</option>
                            <?php $sectionNames = array_unique(array_column($schedules, 'section_name')); ?>
                            <?php foreach ($sectionNames as $section): ?>
                                <option value="<?php echo htmlspecialchars($section); ?>"><?php echo htmlspecialchars($section); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="filter-room" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="filterSchedules()">
                            <option value="">All Rooms</option>
                            <?php $rooms = array_unique(array_column($schedules, 'room_name')); ?>
                            <?php foreach ($rooms as $room): ?>
                                <option value="<?php echo htmlspecialchars($room ?? 'Online'); ?>"><?php echo htmlspecialchars($room ?? 'Online'); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button id="delete-all-btn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors" onclick="deleteAllSchedules()">
                            <i class="fas fa-trash"></i>
                            <span>Delete All Schedules</span>
                        </button>
                    </div>
                </div>

                <!-- Weekly Timetable -->
                <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="min-w-full">
                        <!-- Header with days -->
                        <div class="grid grid-cols-7 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                            <div class="px-4 py-3 text-sm font-semibold text-gray-700 border-r border-gray-200 bg-gray-50">
                                Time
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Monday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Tuesday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Wednesday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Thursday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700 border-r border-gray-200">
                                Friday
                            </div>
                            <div class="px-4 py-3 text-sm font-semibold text-center text-gray-700">
                                Saturday
                            </div>
                        </div>

                        <!-- Time slots -->
                        <div id="timetableGrid" class="divide-y divide-gray-200">
                            <?php foreach ($timeSlots as $time): ?>
                                <?php
                                $duration = strtotime($time[1]) - strtotime($time[0]);
                                $rowSpan = $duration / 7200;
                                ?>
                                <div class="grid grid-cols-7 min-h-[<?php echo $rowSpan * 80; ?>px] hover:bg-gray-50 transition-colors duration-200" style="grid-row: span <?php echo $rowSpan; ?>;">
                                    <div class="px-4 py-3 text-sm font-medium text-gray-600 border-r border-gray-200 bg-gray-50 flex items-center" rowspan="<?php echo $rowSpan; ?>">
                                        <span class="text-lg"><?php echo date('g:i A', strtotime($time[0])) . ' - ' . date('g:i A', strtotime($time[1])); ?></span>
                                    </div>
                                    <?php foreach ($days as $day): ?>
                                        <div class="px-2 py-2 border-r border-gray-200 last:border-r-0 min-h-[<?php echo $rowSpan * 80; ?>px] relative schedule-cell"
                                            data-day="<?php echo $day; ?>"
                                            data-start-time="<?php echo $time[0]; ?>"
                                            data-end-time="<?php echo $time[1]; ?>"
                                            data-year-level=""
                                            data-section-name=""
                                            data-room-name="">
                                            <?php
                                            $schedulesForSlot = isset($scheduleGrid[$day][$time[0]]) ? $scheduleGrid[$day][$time[0]] : [];
                                            foreach ($schedulesForSlot as $schedule) {
                                                $scheduleStart = substr($schedule['start_time'], 0, 5);
                                                $scheduleEnd = substr($schedule['end_time'], 0, 5);
                                                if ($scheduleStart === $time[0]) {
                                                    $colors = [
                                                        'bg-blue-100 border-blue-300 text-blue-800',
                                                        'bg-green-100 border-green-300 text-green-800',
                                                        'bg-purple-100 border-purple-300 text-purple-800',
                                                        'bg-orange-100 border-orange-300 text-orange-800',
                                                        'bg-pink-100 border-pink-300 text-pink-800'
                                                    ];
                                                    $colorClass = $colors[array_rand($colors)];
                                            ?>
                                                    <div class="schedule-card <?php echo $colorClass; ?> p-2 rounded-lg border-l-4 mb-1 schedule-item"
                                                        data-year-level="<?php echo htmlspecialchars($schedule['year_level']); ?>"
                                                        data-section-name="<?php echo htmlspecialchars($schedule['section_name']); ?>"
                                                        data-room-name="<?php echo htmlspecialchars($schedule['room_name'] ?? 'Online'); ?>">
                                                        <div class="font-semibold text-xs truncate mb-1">
                                                            <?php echo htmlspecialchars($schedule['course_code']); ?>
                                                        </div>
                                                        <div class="text-xs opacity-90 truncate mb-1">
                                                            <?php echo htmlspecialchars($schedule['section_name']); ?>
                                                        </div>
                                                        <div class="text-xs opacity-75 truncate">
                                                            <?php echo htmlspecialchars($schedule['faculty_name']); ?>
                                                        </div>
                                                        <div class="text-xs opacity-75 truncate">
                                                            <?php echo htmlspecialchars($schedule['room_name'] ?? 'Online'); ?>
                                                        </div>
                                                        <div class="text-xs font-medium mt-1">
                                                            <?php echo date('g:i A', strtotime($schedule['start_time'])) . ' - ' . date('g:i A', strtotime($schedule['end_time'])); ?>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-md flex items-center justify-center z-50 hidden">
            <div class="bg-white p-8 rounded-lg shadow-xl text-center">
                <div class="pulsing-loader mx-auto mb-4"></div>
                <p class="text-gray-700 font-medium">Generating schedules...</p>
            </div>
        </div>

        <!-- Generation Report Modal -->
        <div id="report-modal" class="fixed inset-0 bg-opacity-30 backdrop-blur-md flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900" id="report-title">Schedule Generation Report</h3>
                    <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="report-content" class="mb-6 text-gray-700">
                    <!-- Report content will be dynamically updated -->
                </div>
                <div class="flex justify-end">
                    <button onclick="closeReportModal()" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">Close</button>
                </div>
            </div>
        </div>

        <!-- Add/Edit Schedule Modal -->
        <div id="schedule-modal" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-md items-center justify-center z-50 hidden modal-overlay">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4 modal-content">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900" id="modal-title">Add Schedule</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="schedule-form" class="space-y-4" onsubmit="handleScheduleSubmit(event)">
                    <input type="hidden" id="schedule-id" name="schedule_id">
                    <input type="hidden" id="modal-day" name="day_of_week">
                    <input type="hidden" id="modal-start-time" name="start_time">
                    <input type="hidden" id="modal-end-time" name="end_time">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Course Code</label>
                        <input type="text" id="course-code" name="course_code" list="course-codes" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" required oninput="syncCourseName()">
                        <datalist id="course-codes">
                            <?php foreach (array_unique(array_column($schedules, 'course_code')) as $code): ?>
                                <option value="<?php echo htmlspecialchars($code); ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Course Name</label>
                        <input type="text" id="course-name" name="course_name" list="course-names" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" required oninput="syncCourseCode()">
                        <datalist id="course-names">
                            <?php foreach (array_unique(array_column($schedules, 'course_name')) as $name): ?>
                                <option value="<?php echo htmlspecialchars($name); ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Faculty</label>
                        <input type="text" id="faculty-name" name="faculty_name" list="faculty-names" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" required>
                        <datalist id="faculty-names">
                            <?php foreach (array_unique(array_column($schedules, 'faculty_name')) as $faculty): ?>
                                <option value="<?php echo htmlspecialchars($faculty); ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Room</label>
                        <input type="text" id="room-name" name="room_name" list="room-names" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                        <datalist id="room-names">
                            <?php foreach (array_unique(array_column(array_filter($schedules, fn($s) => $s['room_name']), 'room_name')) as $room): ?>
                                <option value="<?php echo htmlspecialchars($room); ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Section</label>
                        <input type="text" id="section-name" name="section_name" list="section-names" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" required>
                        <datalist id="section-names">
                            <?php foreach (array_unique(array_column($schedules, 'section_name')) as $section): ?>
                                <option value="<?php echo htmlspecialchars($section); ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Time</label>
                            <select id="start-time" name="start_time_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="document.getElementById('modal-start-time').value=this.value">
                                <option value="07:30">7:30 AM</option>
                                <option value="08:30">8:30 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="12:30">12:30 PM</option>
                                <option value="13:30">1:30 PM</option>
                                <option value="14:30">2:30 PM</option>
                                <option value="15:30">3:30 PM</option>
                                <option value="17:00">5:00 PM</option>
                                <option value="18:00">6:00 PM</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">End Time</label>
                            <select id="end-time" name="end_time_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="document.getElementById('modal-end-time').value=this.value">
                                <option value="08:30">8:30 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="12:30">12:30 PM</option>
                                <option value="13:30">1:30 PM</option>
                                <option value="14:30">2:30 PM</option>
                                <option value="15:30">3:30 PM</option>
                                <option value="17:00">5:00 PM</option>
                                <option value="18:00">6:00 PM</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Day</label>
                        <select id="day-select" name="day_select_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" onchange="document.getElementById('modal-day').value=this.value">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">Save Schedule</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="delete-confirmation-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm items-center justify-center z-50 hidden modal-overlay">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4 modal-content">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-red-100 p-2 rounded-full mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Delete All Schedules</h3>
                    </div>
                    <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="mb-6">
                    <p class="text-gray-700 mb-4">
                        Are you sure you want to delete <strong>ALL schedules</strong> for your department? This action cannot be undone.
                    </p>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-yellow-600 mr-2"></i>
                            <span class="text-sm font-medium text-yellow-800">This will permanently remove all generated schedules for the current semester.</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button onclick="confirmDeleteSchedules()" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                        <i class="fas fa-trash mr-2"></i>
                        Delete All Schedules
                    </button>
                </div>
            </div>
        </div>

        <script>
            // Global data
            window.scheduleData = <?php echo json_encode($schedules); ?> || [];
            window.jsData = <?php echo json_encode($jsData); ?>;
            window.departmentId = window.jsData.departmentId;
            window.currentSemester = window.jsData.currentSemester;
            window.rawSectionsData = window.jsData.sectionsData || [];
            window.currentAcademicYear = window.jsData.currentAcademicYear || "";
            window.faculty = window.jsData.faculty || [];
            window.classrooms = window.jsData.classrooms || [];
            window.curricula = window.jsData.curricula || [];

            // Transform sections data
            window.sectionsData = Array.isArray(window.rawSectionsData) ? window.rawSectionsData.map((s, index) => ({
                section_id: s.section_id ?? (index + 1),
                section_name: s.section_name ?? '',
                year_level: s.year_level ?? 'Unknown',
                academic_year: s.academic_year ?? '',
                current_students: s.current_students ?? 0,
                max_students: s.max_students ?? 30,
                semester: s.semester ?? '',
                is_active: s.is_active ?? 1
            })) : [];

            function openDeleteModal() {
                document.getElementById('delete-confirmation-modal').classList.remove('hidden');
                document.getElementById('delete-confirmation-modal').classList.add('flex');
            }

            function closeDeleteModal() {
                document.getElementById('delete-confirmation-modal').classList.add('hidden');
                document.getElementById('delete-confirmation-modal').classList.remove('flex');
            }

            // Updated delete function with confirmation
            function deleteAllSchedules() {
                openDeleteModal();
            }

            function confirmDeleteSchedules() {
                // Show loading state
                const deleteButton = document.querySelector('#delete-confirmation-modal button[onclick="confirmDeleteSchedules()"]');
                const originalText = deleteButton.innerHTML;
                deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Deleting...';
                deleteButton.disabled = true;

                fetch('/chair/generate-schedules', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'delete_schedules',
                            confirm: 'true'
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('All schedules have been deleted successfully.', 'success');

                            // Update the schedule display
                            window.scheduleData = [];
                            updateScheduleDisplay([]);

                            // Hide generation results if visible
                            const generationResults = document.getElementById('generation-results');
                            if (generationResults) {
                                generationResults.classList.add('hidden');
                            }

                        } else {
                            showNotification('Error deleting schedules: ' + (data.message || 'Unknown error'), 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Delete error:', error);
                        showNotification('Error deleting schedules: ' + error.message, 'error');
                    })
                    .finally(() => {
                        // Restore button state and close modal
                        deleteButton.innerHTML = originalText;
                        deleteButton.disabled = false;
                        closeDeleteModal();
                    });
            }

            // Close modal when clicking outside
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('delete-confirmation-modal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeDeleteModal();
                        }
                    });
                }
            });

            // Shared utility functions
            function switchTab(tabName) {
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('bg-yellow-500', 'text-white');
                    btn.classList.add('text-gray-700', 'hover:text-gray-900', 'hover:bg-gray-100');
                });
                document.getElementById(`tab-${tabName}`).classList.add('bg-yellow-500', 'text-white');
                document.getElementById(`tab-${tabName}`).classList.remove('text-gray-700', 'hover:text-gray-900', 'hover:bg-gray-100');

                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(`content-${tabName}`).classList.remove('hidden');

                const url = new URL(window.location);
                url.searchParams.set('tab', tabName === 'schedule' ? 'schedule-list' : tabName);
                window.history.pushState({}, '', url);
            }

            function formatTime(time) {
                const [hours, minutes] = time.split(':');
                const date = new Date(2000, 0, 1, hours, minutes);
                return date.toLocaleTimeString('en-US', {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            }

            function escapeHtml(unsafe) {
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            function showNotification(message, type = 'success') {
                const notification = document.getElementById('notification');
                if (!notification) {
                    const notificationDiv = document.createElement('div');
                    notificationDiv.id = 'notification';
                    notificationDiv.className = 'mb-6';
                    notificationDiv.innerHTML = `
                        <div class="flex items-center p-4 rounded-lg ${type === 'success' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'}">
                            <div class="flex-shrink-0">
                                <i class="fas ${type === 'success' ? 'fa-check-circle text-green-500' : 'fa-exclamation-circle text-red-500'} text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium ${type === 'success' ? 'text-green-800' : 'text-red-800'}" id="notificationText">${message}</p>
                            </div>
                            <div class="ml-auto pl-3">
                                <button class="${type === 'success' ? 'text-green-400 hover:text-green-600' : 'text-red-400 hover:text-red-600'}" onclick="hideNotification()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    document.querySelector('.max-w-7xl').insertBefore(notificationDiv, document.querySelector('.max-w-7xl').firstElementChild.nextElementSibling);
                } else {
                    document.getElementById('notificationText').textContent = message;
                    notification.classList.remove('hidden');
                }

                setTimeout(() => hideNotification(), 5000);
            }

            function hideNotification() {
                const notification = document.getElementById('notification');
                if (notification) notification.classList.add('hidden');
            }

            function togglePrintDropdown() {
                const dropdown = document.getElementById('printDropdown');
                dropdown.classList.toggle('hidden');
            }

            function printSchedule(type) {
                document.getElementById('printDropdown').classList.add('hidden');
                if (type === 'filtered') {
                    filterSchedules();
                } else if (type === 'all') {
                    clearFilters();
                }
                switchTab('schedule');
                setTimeout(() => {
                    window.print();
                }, 100);
            }

            function exportSchedule(format) {
                document.getElementById('printDropdown').classList.add('hidden');
                const form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';
                const actionInput = document.createElement('input');
                actionInput.name = 'action';
                actionInput.value = 'download';
                form.appendChild(actionInput);
                const formatInput = document.createElement('input');
                formatInput.name = 'format';
                formatInput.value = format;
                form.appendChild(formatInput);
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }

            function filterSchedules() {
                const yearLevel = document.getElementById('filter-year').value;
                const section = document.getElementById('filter-section').value;
                const room = document.getElementById('filter-room').value;
                const scheduleCells = document.querySelectorAll('#timetableGrid .schedule-cell');

                scheduleCells.forEach(cell => {
                    const items = cell.querySelectorAll('.schedule-item');
                    let shouldShow = false;

                    items.forEach(item => {
                        const itemYearLevel = item.getAttribute('data-year-level');
                        const itemSectionName = item.getAttribute('data-section-name');
                        const itemRoomName = item.getAttribute('data-room-name');
                        const matchesYear = !yearLevel || itemYearLevel === yearLevel;
                        const matchesSection = !section || itemSectionName === section;
                        const matchesRoom = !room || itemRoomName === room;

                        if (matchesYear && matchesSection && matchesRoom) {
                            item.style.display = 'block';
                            shouldShow = true;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    cell.style.display = shouldShow ? 'block' : 'block';
                });
            }

            function clearFilters() {
                document.getElementById('filter-year').value = '';
                document.getElementById('filter-section').value = '';
                document.getElementById('filter-room').value = '';
                filterSchedules();
            }

            function updateScheduleDisplay(schedules) {
                window.scheduleData = schedules;
                const manualGrid = document.getElementById('schedule-grid');
                if (manualGrid) {
                    manualGrid.innerHTML = '';
                    const times = [
                        ['07:30', '08:30'],
                        ['08:30', '10:00'],
                        ['10:00', '11:00'],
                        ['11:00', '12:30'],
                        ['12:30', '13:30'],
                        ['13:00', '14:30'],
                        ['14:30', '15:30'],
                        ['15:30', '17:00'],
                        ['17:00', '18:00']
                    ];
                    times.forEach(time => {
                        const row = document.createElement('div');
                        row.className = 'grid grid-cols-7 min-h-[100px] hover:bg-gray-50';
                        row.innerHTML = `<div class="px-4 py-3 text-sm font-medium text-gray-600 border-r border-gray-200 bg-gray-100 flex items-center">
                                ${formatTime(time[0])} - ${formatTime(time[1])}
                            </div>`;
                        ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'].forEach(day => {
                            const cell = document.createElement('div');
                            cell.className = 'px-2 py-3 border-r border-gray-200 last:border-r-0 drop-zone relative';
                            cell.dataset.day = day;
                            cell.dataset.startTime = time[0];
                            cell.dataset.endTime = time[1];
                            const schedule = schedules.find(s =>
                                s.day_of_week === day &&
                                s.start_time.substring(0, 5) === time[0] &&
                                s.end_time.substring(0, 5) === time[1]
                            );
                            if (schedule) {
                                cell.innerHTML = `<div class="schedule-card bg-white border-l-4 border-yellow-500 rounded-lg p-3 shadow-sm draggable cursor-move" 
                                        draggable="true" data-schedule-id="${escapeHtml(schedule.schedule_id)}" ondragstart="handleDragStart(event)" ondragend="handleDragEnd(event)">
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="font-semibold text-sm text-gray-900 truncate">${escapeHtml(schedule.course_code)}</div>
                                            <button onclick="editSchedule('${escapeHtml(schedule.schedule_id)}')" class="text-yellow-600 hover:text-yellow-700 text-xs no-print">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="text-xs text-gray-600 truncate mb-1">${escapeHtml(schedule.course_name)}</div>
                                        <div class="text-xs text-gray-600 truncate mb-1">${escapeHtml(schedule.faculty_name)}</div>
                                        <div class="text-xs text-gray-600 truncate mb-2">${escapeHtml(schedule.room_name ?? 'Online')}</div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs font-medium text-yellow-600">${escapeHtml(schedule.section_name)}</span>
                                            <button onclick="deleteSchedule('${escapeHtml(schedule.schedule_id)}')" class="text-red-500 hover:text-red-700 text-xs no-print">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>`;
                            } else {
                                cell.innerHTML = `<button onclick="openAddModalForSlot('${day}', '${time[0]}', '${time[1]}')" class="w-full h-full text-gray-400 hover:text-gray-600 hover:bg-yellow-50 rounded-lg border-2 border-dashed border-gray-300 hover:border-yellow-400 transition-all duration-200 no-print">
                                        <i class="fas fa-plus text-lg"></i>
                                    </button>`;
                            }
                            row.appendChild(cell);
                        });
                        manualGrid.appendChild(row);
                    });
                    initializeDragAndDrop();
                }

                const viewGrid = document.getElementById('timetableGrid');
                if (viewGrid) {
                    viewGrid.innerHTML = '';
                    const times = [
                        ['07:30', '08:30'],
                        ['08:30', '10:00'],
                        ['10:00', '11:00'],
                        ['11:00', '12:30'],
                        ['12:30', '13:30'],
                        ['13:00', '14:30'],
                        ['14:30', '15:30'],
                        ['15:30', '17:00'],
                        ['17:00', '18:00']
                    ];
                    times.forEach(time => {
                        const row = document.createElement('div');
                        row.className = 'grid grid-cols-7 min-h-[100px] hover:bg-gray-50';
                        row.innerHTML = `<div class="px-4 py-3 text-sm font-medium text-gray-600 border-r border-gray-200 bg-gray-100 flex items-center">
                                ${formatTime(time[0])} - ${formatTime(time[1])}
                            </div>`;
                        ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'].forEach(day => {
                            const cell = document.createElement('div');
                            cell.className = 'px-2 py-3 border-r border-gray-200 last:border-r-0 schedule-cell';
                            const daySchedules = schedules.filter(s =>
                                s.day_of_week === day &&
                                s.start_time.substring(0, 5) === time[0] &&
                                s.end_time.substring(0, 5) === time[1]
                            );
                            if (daySchedules.length > 0) {
                                daySchedules.forEach(schedule => {
                                    const colorClass = ['bg-blue-100', 'bg-green-100', 'bg-purple-100', 'bg-orange-100', 'bg-pink-100'][Math.floor(Math.random() * 5)] + ' border-l-4';
                                    cell.innerHTML += `<div class="schedule-card ${colorClass} p-2 rounded-lg mb-1 schedule-item" 
                                            data-year-level="${escapeHtml(schedule.year_level)}" 
                                            data-section-name="${escapeHtml(schedule.section_name)}" 
                                            data-room-name="${escapeHtml(schedule.room_name ?? 'Online')}">
                                            <div class="font-semibold text-xs truncate mb-1">${escapeHtml(schedule.course_code)}</div>
                                            <div class="text-xs opacity-90 truncate mb-1">${escapeHtml(schedule.section_name)}</div>
                                            <div class="text-xs opacity-75 truncate">${escapeHtml(schedule.faculty_name)}</div>
                                            <div class="text-xs opacity-75 truncate">${escapeHtml(schedule.room_name ?? 'Online')}</div>
                                        </div>`;
                                });
                            }
                            row.appendChild(cell);
                        });
                        viewGrid.appendChild(row);
                    });
                }
            }

            document.getElementById('generate-btn').addEventListener('click', function() {
                const form = document.getElementById('generate-form');
                const curriculumId = form.querySelector('#curriculum_id').value;

                if (!curriculumId) {
                    showNotification('Please select a curriculum.', 'error');
                    return;
                }

                // Show loading overlay
                const loadingOverlay = document.getElementById('loading-overlay');
                loadingOverlay.classList.remove('hidden');

                // Build form data
                const formData = new URLSearchParams({
                    action: 'generate_schedule',
                    curriculum_id: curriculumId,
                    semester_id: form.querySelector('[name="semester_id"]').value
                });

                fetch('/chair/generate-schedules', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: formData
                    })
                    .then(response => {
                        // Check if response is ok
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Received data:', data); // Debug log

                        // Hide loading overlay
                        loadingOverlay.classList.add('hidden');

                        if (!data.success) {
                            showNotification(data.message || 'Error generating schedules', 'error');
                            return; // Stop here if generation failed
                        }

                        // Update schedule data ONLY if successful
                        window.scheduleData = data.schedules || [];

                        // Update display first
                        updateScheduleDisplay(window.scheduleData);

                        // THEN show modal after display is updated
                        showReportModal(data);

                    })
                    .catch(error => {
                        loadingOverlay.classList.add('hidden');
                        console.error('Generate error:', error);
                        showNotification('Error generating schedules: ' + error.message, 'error');
                    });
            });

            // NEW: Separate function to show report modal
            function showReportModal(data) {
                const reportModal = document.getElementById('report-modal');
                const reportContent = document.getElementById('report-content');
                const reportTitle = document.getElementById('report-title');

                let statusText, statusClass;

                // Determine status based on results
                if (!data.schedules || data.schedules.length === 0) {
                    statusText = 'No schedules were created. Please check if there are available sections, courses, faculty, and rooms.';
                    statusClass = 'text-red-600 bg-red-50 border-red-200';
                    reportTitle.textContent = 'Schedule Generation Failed';
                } else if (data.unassignedCourses && data.unassignedCourses.length > 0) {
                    statusText = `Partial success. ${data.unassignedCourses.length} courses could not be scheduled: ${data.unassignedCourses.map(c => c.course_code).join(', ')}`;
                    statusClass = 'text-yellow-600 bg-yellow-50 border-yellow-200';
                    reportTitle.textContent = 'Schedule Generation Partially Complete';
                } else {
                    statusText = 'All schedules generated successfully!';
                    statusClass = 'text-green-600 bg-green-50 border-green-200';
                    reportTitle.textContent = 'Schedule Generation Complete';
                }

                // Build report content
                reportContent.innerHTML = `
                    <div class="p-4 ${statusClass} border rounded-lg mb-4">
                        <p class="font-semibold">${statusText}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white p-3 rounded-lg text-center border border-gray-200">
                            <div class="text-2xl font-bold ${statusClass.split(' ')[0]}">${data.totalCourses || 0}</div>
                            <div class="text-gray-600 mt-1">Total Courses</div>
                        </div>
                        <div class="bg-white p-3 rounded-lg text-center border border-gray-200">
                            <div class="text-2xl font-bold ${statusClass.split(' ')[0]}">${data.totalSections || 0}</div>
                            <div class="text-gray-600 mt-1">Sections</div>
                        </div>
                        <div class="bg-white p-3 rounded-lg text-center border border-gray-200">
                            <div class="text-2xl font-bold ${statusClass.split(' ')[0]}">${data.successRate || '0%'}</div>
                            <div class="text-gray-600 mt-1">Success Rate</div>
                        </div>
                    </div>
                    ${data.unassignedCourses && data.unassignedCourses.length > 0 ? `
                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm font-medium text-yellow-800 mb-2">Unscheduled Courses:</p>
                            <ul class="text-sm text-yellow-700 list-disc list-inside">
                                ${data.unassignedCourses.map(c => `<li>${c.course_code}</li>`).join('')}
                            </ul>
                        </div>
                    ` : ''}
                `;

                reportTitle.className = `text-lg font-semibold ${statusClass.split(' ')[0]}`;

                // Show the modal
                reportModal.classList.remove('hidden');
                reportModal.classList.add('flex');

                // Update generation results card if it exists
                const generationResults = document.getElementById('generation-results');
                if (generationResults && data.schedules && data.schedules.length > 0) {
                    generationResults.classList.remove('hidden');
                    document.getElementById('total-courses').textContent = data.totalCourses || 0;
                    document.getElementById('total-sections').textContent = data.totalSections || 0;
                    document.getElementById('success-rate').textContent = data.successRate || '0%';
                }
            }

            function closeReportModal() {
                const reportModal = document.getElementById('report-modal');
                reportModal.classList.add('hidden');
            }

            // Initialize page
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const tab = urlParams.get('tab');
                const reportModal = document.getElementById('report-modal');

                if (tab === 'schedule-list') switchTab('schedule');
                else if (tab === 'manual') switchTab('manual');
                else switchTab('generate');

                if (reportModal) {
                    reportModal.addEventListener('click', function(e) {
                        if (e.target === reportModal) {
                            closeReportModal();
                        }
                    });
                }
            });
        </script>

        <!-- Include external JavaScript files -->
        <script src="/assets/js/generate_schedules.js"></script>
        <script src="/assets/js/manual_schedules.js"></script>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>