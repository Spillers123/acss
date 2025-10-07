<?php
ob_start();
?>

<div>
    <!-- Dashboard Header -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white rounded-xl p-6 sm:p-8 mb-8 shadow-lg relative overflow-hidden">
        <div class="absolute top-0 left-0 w-2 h-full bg-yellow-500"></div>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold">PRMSU Scheduling System</h1>
                <p class="text-gray-300 mt-2"><?php echo htmlspecialchars($college['college_name'] ?? 'College'); ?></p>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 mt-4 sm:mt-0">
                <span class="text-sm bg-gray-700 px-3 py-1 rounded-full flex items-center">
                    <svg class="w-4 h-4 mr-1 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <?php echo htmlspecialchars($currentSemester); ?>
                </span>
                <span class="bg-yellow-500 px-3 py-1 rounded-full flex items-center text-gray-900 font-semibold">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Active Term
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Faculty Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Faculty</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $stats['total_faculty']; ?></h3>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-users text-blue-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Classrooms Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Classrooms</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $stats['total_classrooms']; ?></h3>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-door-open text-green-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Departments Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Departments</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $stats['total_departments']; ?></h3>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-building text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Approvals Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pending Approvals</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $stats['pending_approvals']; ?></h3>
                </div>
                <div class="bg-orange-100 rounded-full p-3">
                    <i class="fas fa-clock text-orange-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 mb-8">
        <!-- Current Schedule Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 border-l-4 border-yellow-500">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center mb-2 sm:mb-0">
                        <i class="fas fa-calendar-alt mr-3 text-yellow-400"></i>
                        My Current Schedule
                    </h3>
                    <div class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 mr-1 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?php echo htmlspecialchars($currentSemester); ?>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-book mr-1 text-yellow-500"></i> Course Code
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-graduation-cap mr-1 text-yellow-500"></i> Course Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-door-open mr-1 text-yellow-500"></i> Room
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-calendar-day mr-1 text-yellow-500"></i> Days
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-clock mr-1 text-yellow-500"></i> Time
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="scheduleTableBody">
                            <?php if (empty($schedules)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                                            <p class="text-lg font-medium">No schedules available</p>
                                            <p class="text-sm mt-1">Your schedule for the current semester will appear here.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach (array_slice($schedules, 0, 5) as $schedule): ?>
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($schedule['course_code']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <?php echo htmlspecialchars($schedule['course_name']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?php echo htmlspecialchars($schedule['room_name'] ?? 'TBD'); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <div class="text-sm font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded inline-block"><?php echo htmlspecialchars($schedule['day_of_week'] ?? 'TBD'); ?></div>
                                            <div class="text-xs text-gray-500 mt-1"><?php echo htmlspecialchars(($schedule['start_time'] ?? '') . ' - ' . ($schedule['end_time'] ?? '')); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?php echo htmlspecialchars($schedule['start_time'] . ' - ' . $schedule['end_time']); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (!empty($schedules)): ?>
                    <div class="mt-6 text-center">
                        <a href="/dean/schedule" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-yellow-400 rounded-lg hover:bg-yellow-500 transition-colors duration-300">
                            <i class="fas fa-eye mr-2"></i>
                            View All Schedules
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        <!-- Faculty Distribution by Employment Type Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b-2 border-yellow-500">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Faculty Employment Type</h2>
                    <p class="text-xs text-gray-500 mt-1">Distribution of faculty by employment status</p>
                </div>
                <i class="fas fa-chart-pie text-yellow-500 text-2xl"></i>
            </div>
            <div class="h-64 flex items-center justify-center">
                <?php if (!empty($facultyDistribution)): ?>
                    <canvas id="facultyDistributionChart"></canvas>
                <?php else: ?>
                    <div class="text-center text-gray-400">
                        <i class="fas fa-chart-pie text-5xl mb-3"></i>
                        <p>No faculty data available</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Faculty Count by Department Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b-2 border-blue-500">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Faculty by Department</h2>
                    <p class="text-xs text-gray-500 mt-1">Number of faculty members per department</p>
                </div>
                <i class="fas fa-chart-bar text-blue-500 text-2xl"></i>
            </div>
            <div class="h-64 flex items-center justify-center">
                <?php if (!empty($departmentOverview)): ?>
                    <canvas id="departmentOverviewChart"></canvas>
                <?php else: ?>
                    <div class="text-center text-gray-400">
                        <i class="fas fa-chart-bar text-5xl mb-3"></i>
                        <p>No department data available</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- Department Overview Table -->
    <div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-building mr-3 text-yellow-500"></i>
                    Department Overview
                </h2>
                <span class="text-sm text-gray-300"><?php echo htmlspecialchars($currentSemester); ?></span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-yellow-500">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Faculty</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Courses</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Active Schedules</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($departmentOverview)): ?>
                        <?php foreach ($departmentOverview as $dept): ?>
                            <tr class="hover:bg-yellow-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($dept['department_name']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm font-semibold text-gray-900"><?php echo $dept['faculty_count']; ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm font-semibold text-gray-900"><?php echo $dept['course_count']; ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm font-bold text-gray-900"><?php echo $dept['active_schedules']; ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <?php if ($dept['faculty_count'] > 0 && $dept['active_schedules'] > 0): ?>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>Active
                                        </span>
                                    <?php elseif ($dept['faculty_count'] > 0): ?>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-circle mr-1"></i>Partial
                                        </span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>No departments found</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Two Column Layout for Additional Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        <!-- Classroom Utilization Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 border-l-4 border-green-500">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-door-open mr-3 text-green-400"></i>
                    Top Utilized Classrooms
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Capacity</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Schedules</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Usage</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($classroomUtilization)): ?>
                            <?php foreach ($classroomUtilization as $room): ?>
                                <?php
                                $utilization = $room['total_schedules'] > 0 ? min(100, ($room['total_schedules'] / 5) * 100) : 0;
                                $utilizationColor = $utilization >= 80 ? 'bg-green-500' : ($utilization >= 50 ? 'bg-yellow-500' : 'bg-red-500');
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($room['room_name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="text-sm text-gray-600"><?php echo $room['capacity']; ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <?php echo $room['total_schedules']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="<?php echo $utilizationColor; ?> h-2.5 rounded-full transition-all" style="width: <?php echo $utilization; ?>%"></div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-door-open text-4xl mb-2"></i>
                                    <p>No classroom data available</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Schedule Changes Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 border-l-4 border-orange-500">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-history mr-3 text-orange-400"></i>
                    Recent Schedule Updates
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Time</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($recentScheduleChanges)): ?>
                            <?php foreach ($recentScheduleChanges as $change): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($change['course_code']); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo htmlspecialchars($change['course_name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($change['faculty_name']); ?></div>
                                        <div class="text-xs text-gray-500">
                                            <?php echo htmlspecialchars($change['room_name'] ?? 'TBA'); ?> •
                                            <?php echo htmlspecialchars($change['day_of_week']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo date('g:i A', strtotime($change['start_time'])); ?> -
                                            <?php echo date('g:i A', strtotime($change['end_time'])); ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?php echo date('M d', strtotime($change['updated_at'])); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-calendar-check text-4xl mb-2"></i>
                                    <p>No recent schedule changes</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Faculty Distribution Pie Chart
        const facultyCtx = document.getElementById('facultyDistributionChart');
        if (facultyCtx) {
            <?php if (!empty($facultyDistribution)): ?>
                new Chart(facultyCtx, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode(array_column($facultyDistribution, 'employment_type')); ?>,
                        datasets: [{
                            data: <?php echo json_encode(array_column($facultyDistribution, 'count')); ?>,
                            backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'],
                            borderWidth: 3,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    font: {
                                        size: 12
                                    },
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        let value = context.parsed || 0;
                                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        let percentage = ((value / total) * 100).toFixed(1);
                                        return label + ': ' + value + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            <?php endif; ?>
        }

        // Department Overview Bar Chart
        const deptCtx = document.getElementById('departmentOverviewChart');
        if (deptCtx) {
            <?php if (!empty($departmentOverview)): ?>
                const deptNames = <?php echo json_encode(array_column($departmentOverview, 'department_name')); ?>;
                new Chart(deptCtx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_column($departmentOverview, 'department_code')); ?>,
                        datasets: [{
                            label: 'Faculty Count',
                            data: <?php echo json_encode(array_column($departmentOverview, 'faculty_count')); ?>,
                            backgroundColor: '#3B82F6',
                            borderColor: '#2563EB',
                            borderWidth: 2,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                callbacks: {
                                    title: function(context) {
                                        return deptNames[context[0].dataIndex];
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                },
                                title: {
                                    display: true,
                                    text: 'Faculty Count'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Department'
                                }
                            }
                        }
                    }
                });
            <?php endif; ?>
        }

    });
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>