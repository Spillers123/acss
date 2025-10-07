<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['title']); ?></title>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary-yellow: #F4C029;
            --primary-dark: #1e40af;
            --secondary-yellow: #B98A0C;
            --accent-orange: #f59e0b;
            --card-bg: #ffffff;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --bg-gradient: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }

        .stats-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-color);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-yellow), var(--secondary-yellow));
        }

        .stats-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--primary-yellow);
        }

        .main-content {
            background: transparent;
            min-height: 100vh;
        }

        .dashboard-header {
            color: white;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .section-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 2px solid var(--primary-yellow);
            padding: 1.5rem;
        }

        .schedule-table {
            background: white;
        }

        .schedule-table th {
            background: var(--bg-gradient);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
        }

        .schedule-table tbody tr {
            transition: all 0.2s ease;
        }

        .schedule-table tbody tr:hover {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            transform: scale(1.01);
        }

        .schedule-table tbody td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .quick-action-btn {
            background: var(--bg-gradient);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(37, 99, 235, 0.4);
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-yellow) 100%);
        }

        .secondary-action-btn {
            background: white;
            color: var(--text-primary);
            border: 2px solid var(--border-color);
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .secondary-action-btn:hover {
            background: var(--primary-yellow);
            color: white;
            border-color: var(--primary-yellow);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(37, 99, 235, 0.2);
        }

        .semester-badge {
            background: linear-gradient(135deg, var(--accent-orange) 0%, #d97706 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
        }

        .stats-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .icon-pending {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .icon-deadline {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .icon-schedule {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .icon-system {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-secondary);
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            margin: 2rem;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
        }

        .deadline-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
            border: 2px solid #f59e0b;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 640px) {
            .quick-actions-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .stats-card {
                margin-bottom: 1rem;
            }
        }

        .action-icon {
            transition: transform 0.2s ease;
        }

        .quick-action-btn:hover .action-icon,
        .secondary-action-btn:hover .action-icon {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="main-content p-4 md:p-6 min-h-screen">
        <!-- Mobile Menu Toggle -->
        <button id="menuToggle" class="md:hidden fixed top-4 left-4 z-50 bg-yellow-600 text-white p-3 rounded-xl shadow-lg hover:bg-yellow-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Main Header Section with Gold Accent -->
        <div class="bg-gray-800 text-white rounded-xl p-6 mb-8 shadow-lg relative overflow-hidden">
            <div class="absolute top-0 left-0 w-2 h-full bg-yellow-600"></div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">PRMSU Scheduling System</h1>
                    <p class=" font-bold mb-3 bg-yellow-600 from-white to-yellow-100 bg-clip-text">Director Dashboard</p>
                    <?php if (isset($departmentName) && !empty($departmentName)): ?>
                        <p class="text-gray-300 mt-2">Department of <?php echo htmlspecialchars($departmentName); ?></p>
                    <?php endif; ?>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <span class="text-sm bg-gray-700 px-3 py-1 rounded-full flex items-center">
                        <svg class="w-4 h-4 mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?php
                        echo htmlspecialchars(
                            $data['semester']
                                ? $data['semester']['semester_name'] . ' ' . $data['semester']['academic_year']
                                : 'Unknown Semester'
                        );
                        ?>
                    </span>
                    <span class="text-sm bg-yellow-600 px-3 py-1 rounded-full flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Active Term
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Pending Approvals Card -->
            <div class="stats-card p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="stats-icon icon-pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded-full">
                        <?php echo ($data['pending_approvals'] > 0) ? 'ACTION NEEDED' : 'UP TO DATE'; ?>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-2 uppercase tracking-wide">Pending Approvals</p>
                    <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo htmlspecialchars($data['pending_approvals'] ?? '0'); ?></p>
                    <p class="text-xs text-gray-500">Curriculum reviews</p>
                </div>
            </div>

            <!-- Schedule Deadline Card -->
            <div class="stats-card p-6 hover:shadow-xl transition-all duration-300">
                <a href="/director/schedule_deadline">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stats-icon icon-deadline">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">
                            <?php echo ($data['deadline']) ? 'SET' : 'PENDING'; ?>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-2 uppercase tracking-wide">Schedule Deadline</p>
                        <p class="text-lg font-bold text-gray-900 mb-1">
                            <?php
                            if ($data['deadline']) {
                                echo htmlspecialchars(date('M d, Y', strtotime($data['deadline'])));
                            } else {
                                echo 'Not Set';
                            }
                            ?>
                        </p>
                        <p class="text-xs text-gray-500">Submission deadline</p>
                    </div>
                </a>
            </div>

            <!-- My Schedule Count Card -->
            <div class="stats-card p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="stats-icon icon-schedule">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">
                        ACTIVE
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-2 uppercase tracking-wide">My Classes</p>
                    <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo count($data['schedules'] ?? []); ?></p>
                    <p class="text-xs text-gray-500">Teaching assignments</p>
                </div>
            </div>
        </div>

        <!-- Schedule Deadline Alert (if deadline exists) -->
        <?php if ($data['deadline']): ?>
            <div class="deadline-card mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-orange-600 text-xl mr-3"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-orange-900 mb-1">Schedule Deadline Set</h3>
                            <p class="text-orange-700">Current deadline: <?php echo htmlspecialchars(date('F j, Y \a\t g:i A', strtotime($data['deadline']))); ?></p>
                        </div>
                    </div>
                    <a href="/director/schedule_deadline" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        Update Deadline
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- My Current Schedule Section -->
        <div class="content-section mb-8">
            <div class="section-header">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                    <div class="mb-4 lg:mb-0">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center">
                            <i class="fas fa-calendar-alt text-yellow-600 mr-3"></i>
                            My Current Schedule
                        </h2>
                        <p class="text-gray-600">Your teaching assignments for the current semester</p>
                    </div>
                    <div class="semester-badge">
                        <i class="fas fa-clock action-icon"></i>
                        <?php
                        echo htmlspecialchars(
                            $data['semester']
                                ? $data['semester']['semester_name'] . ' ' . $data['semester']['academic_year']
                                : 'Unknown Semester'
                        );
                        ?>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <?php if (!empty($data['schedules'])): ?>
                    <table class="w-full schedule-table">
                        <thead>
                            <tr>
                                <th class="text-left">Course Code</th>
                                <th class="text-left">Course Name</th>
                                <th class="text-left">Room</th>
                                <th class="text-left">Day</th>
                                <th class="text-left">Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach ($data['schedules'] as $schedule): ?>
                                <tr class="hover:bg-yellow-50 transition-colors duration-200">
                                    <td class="text-sm font-bold text-yellow-600"><?php echo htmlspecialchars($schedule['course_code'] ?? 'N/A'); ?></td>
                                    <td class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($schedule['course_name'] ?? 'N/A'); ?></td>
                                    <td class="text-sm text-gray-600">
                                        <i class="fas fa-door-open text-xs mr-1"></i>
                                        <?php echo htmlspecialchars($schedule['room_name'] ?? 'N/A'); ?>
                                    </td>
                                    <td class="text-sm text-gray-600">
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <?php echo htmlspecialchars($schedule['day_of_week'] ?? 'N/A'); ?>
                                        </span>
                                    </td>
                                    <td class="text-sm text-gray-600 font-medium">
                                        <?php
                                        if (isset($schedule['start_time']) && isset($schedule['end_time'])) {
                                            echo htmlspecialchars(date('h:i A', strtotime($schedule['start_time'])) . ' - ' . date('h:i A', strtotime($schedule['end_time'])));
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="mb-6">
                            <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Schedule Found</h3>
                            <p class="text-gray-500 max-w-md mx-auto">Schedule information will appear here once classes are assigned for the current semester.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="flex justify-end mt-4 px-6 pb-4">
                <a href="/director/schedule" class="text-sm bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-medium px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">
                    View Full Schedule
                </a>
            </div>
        </div>

        
    </div>

    <!-- JavaScript for Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');

            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                });
            }

            // Enhanced card interactions
            const statsCards = document.querySelectorAll('.stats-card');
            statsCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });

                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Enhanced button interactions
            const actionButtons = document.querySelectorAll('.quick-action-btn, .secondary-action-btn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;

                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);

                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>