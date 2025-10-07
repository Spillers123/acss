<?php
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 5) {
    header('Location: /login?error=Unauthorized access');
    exit;
}
// Determine current page for active navigation highlighting
$currentUri = $_SERVER['REQUEST_URI'];
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Chair Dashboard</title>
    <link rel="stylesheet" href="/css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            50: '#FEF9E7',
                            100: '#FCF3CF',
                            200: '#F9E79F',
                            300: '#F7DC6F',
                            400: '#F5D33F',
                            500: '#D4AF37',
                            /* Primary gold */
                            600: '#B8860B',
                            700: '#9A7209',
                            800: '#7C5E08',
                            900: '#5E4506',
                        },
                        gray: {
                            50: '#F9FAFB',
                            100: '#F3F4F6',
                            200: '#E5E7EB',
                            300: '#D1D5DB',
                            400: '#9CA3AF',
                            500: '#6B7280',
                            600: '#4B5563',
                            700: '#374151',
                            800: '#1F2937',
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        'sans': ['Roboto', 'sans-serif'],
                        'heading': ['Poppins', 'sans-serif'],
                    },
                    boxShadow: {
                        'custom': '0 4px 6px rgba(0, 0, 0, 0.1)',
                        'hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                        'card': '0 10px 20px rgba(0, 0, 0, 0.05), 0 6px 6px rgba(0, 0, 0, 0.03)',
                    }
                },
            },
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            scroll-behavior: smooth;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

        @keyframes slideInRight {
            from {
                transform: translateX(20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        .slide-in-left {
            animation: slideInLeft 0.4s ease forwards;
        }

        .slide-in-right {
            animation: slideInRight 0.4s ease forwards;
        }

        /* Improved sidebar */
        .sidebar {
            background: linear-gradient(to bottom, #1F2937, #111827);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar-hidden {
            transform: translateX(-100%);
        }

        /* Improved dropdown */
        .dropdown-menu {
            display: none;
            position: absolute;
            min-width: 200px;
            z-index: 30;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            border-radius: 0.375rem;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            transform-origin: top center;
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }

        .dropdown-menu.show {
            display: flex;
            flex-direction: column;
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Navigation items */
        .nav-item {
            transition: all 0.3s ease;
            border-radius: 0.375rem;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background-color: rgba(212, 175, 55, 0.15);
            z-index: -1;
            transition: width 0.3s ease;
        }

        .nav-item:hover::before {
            width: 100%;
        }

        .nav-item:hover {
            color: #D4AF37;
        }

        .active-nav {
            border-left: 4px solid #D4AF37;
            background-color: rgba(212, 175, 55, 0.1);
            font-weight: 500;
        }

        /* Header improvements */
        .header-shadow {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        /* Gradient and card effects */
        .gold-gradient {
            background: linear-gradient(135deg, #D4AF37 0%, #F2D675 100%);
        }

        .gray-gradient {
            background: linear-gradient(135deg, #1F2937 0%, #374151 100%);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        /* Logo styles */
        .university-logo {
            height: 50px;
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        .university-logo:hover {
            transform: scale(1.05);
        }

        .department-logo {
            height: 40px;
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        .department-logo:hover {
            transform: scale(1.05);
        }

        /* Improved buttons */
        .btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%, -50%);
            transform-origin: 50% 50%;
        }

        .btn:hover::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #D4AF37;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #B8860B;
        }

        /* Notifications bubble */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #EF4444;
            color: white;
            border-radius: 50%;
            padding: 0.1rem 0.4rem;
            font-size: 0.65rem;
            font-weight: bold;
        }

        /* Toggle animations */
        .toggle-icon {
            transition: transform 0.3s ease;
        }

        .rotate-icon {
            transform: rotate(180deg);
        }

        /* Toast notifications */
        .toast {
            animation: slideInRight 0.5s ease forwards, fadeOut 0.5s ease 5s forwards;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
</head>


<!-- Sidebar with improved design -->
<aside id="sidebar" class="sidebar w-64 text-white fixed h-full overflow-y-auto transition-all duration-300 transform -translate-x-full md:translate-x-0 z-30">
    <!-- Sidebar Header -->
    <div class="py-6 px-6 flex flex-col items-center justify-center border-b border-gray-700 bg-gray-900">
        <div class="flex items-center justify-center mb-3">
            <img src="/assets/logo/main_logo/PRMSUlogo.png" alt="PRMSU Logo" class="h-12">
        </div>
        <h2 class="text-xl font-bold text-gold-300">PRMSU Scheduling System - ACSS</h2>
        <p class="text-xs text-gray-400 mt-1">Management System</p>
    </div>

    <!-- User Profile Section -->
    <div class="p-4 border-b border-gray-700 bg-gray-800/70">
        <div class="flex items-center space-x-3">
            <img class="h-12 w-12 rounded-full border-2 border-gold-400 object-cover shadow-md"
                src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['first_name'] . ' ' . $_SESSION['last_name']) ?>&background=D4AF37&color=FFFFFF"
                alt="Profile">
            <div>
                <p class="font-medium text-white"><?= htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']) ?></p>
                <div class="flex items-center text-xs text-gold-300">
                    <i class="fas fa-circle text-green-500 mr-1 text-xs"></i>
                    <span>Program Chair</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-4 px-2">
        <!-- Dashboard Link -->
        <a href="/chair/dashboard" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/dashboard') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-tachometer-alt w-5 mr-3 <?= strpos($currentUri, '/chair/dashboard') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Dashboard</span>
        </a>

        <!-- Schedule Dropdown -->
        <div class="dropdown relative my-1">
            <button class="nav-item w-full flex px-4 py-3 text-gray-200 hover:text-white items-center justify-between cursor-pointer rounded-lg transition-all duration-300 <?= strpos($currentUri, '/chair/schedule') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt w-5 mr-3 <?= strpos($currentUri, '/chair/schedule') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
                    <span>Schedule</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300 <?= strpos($currentUri, '/chair/schedule') !== false ? 'rotate-180' : '' ?>"></i>
            </button>
            <div class="dropdown-menu relative ml-5 mt-1 rounded-md flex-col bg-gray-800/80 overflow-hidden <?= strpos($currentUri, '/chair/schedule') !== false ? 'show' : '' ?>">
                <a href="/chair/schedule/create" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-gold-300 transition duration-300 rounded-md <?= strpos($currentUri, '/chair/schedule/create') !== false ? 'bg-gray-700 text-gold-300' : '' ?>">
                    <i class="fas fa-plus-circle w-5 mr-2"></i> Create Schedule
                </a>
                <a href="/chair/schedule" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-gold-300 transition duration-300 rounded-md <?= strpos($currentUri, '/chair/schedule') !== false && strpos($currentUri, '/create') === false && strpos($currentUri, '/history') === false ? 'bg-gray-700 text-gold-300' : '' ?>">
                    <i class="fas fa-list w-5 mr-2"></i> My Schedule
                </a>
                <a href="/chair/schedule/schedule_history" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-gold-300 transition duration-300 rounded-md <?= strpos($currentUri, '/chair/schedule/schedule_history') !== false ? 'bg-gray-700 text-gold-300' : '' ?>">
                    <i class="fas fa-history w-5 mr-2"></i> Schedule History
                </a>
            </div>
        </div>

        <!-- Faculty -->
        <a href="/chair/faculty" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/faculty') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-chalkboard-teacher w-5 mr-3 <?= strpos($currentUri, '/chair/faculty') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Faculty</span>
        </a>

        <!-- Courses -->
        <a href="/chair/courses" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/courses') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-book w-5 mr-3 <?= strpos($currentUri, '/chair/courses') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Courses</span>
        </a>

        <!-- Sections -->
        <a href="/chair/sections" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/sections') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-layer-group w-5 mr-3 <?= strpos($currentUri, '/chair/sections') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Sections</span>
        </a>

        <!-- Curriculum -->
        <a href="/chair/curriculum" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/curriculum') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-graduation-cap w-5 mr-3 <?= strpos($currentUri, '/chair/curriculum') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Curriculum</span>
        </a>

        <!-- Classrooms -->
        <a href="/chair/classroom" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/classroom') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-door-open w-5 mr-3 <?= strpos($currentUri, '/chair/classroom') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Classrooms</span>
        </a>

        <!-- Profile -->
        <a href="/chair/profile" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/profile') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-user-circle w-5 mr-3 <?= strpos($currentUri, '/chair/profile') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Profile</span>
        </a>

        <!-- Reports -->
        <a href="/chair/reports" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?= strpos($currentUri, '/chair/reports') !== false ? 'active-nav bg-gray-800 text-gold-300' : '' ?>">
            <i class="fas fa-chart-bar w-5 mr-3 <?= strpos($currentUri, '/chair/reports') !== false ? 'text-gold-400' : 'text-gray-400' ?>"></i>
            <span>Reports</span>
        </a>
    </nav>

    <!-- Sidebar Footer -->
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-900 border-t border-gray-700">
        <div class="flex items-center justify-between text-xs text-gray-400">
            <div>
                <p>Program Chair System</p>
                <p>Version 2.1.0</p>
            </div>
            <a href="/chair/system/status" class="text-gold-400 hover:text-gold-300 transition-all duration-300">
                <i class="fas fa-circle text-green-500 mr-1"></i> Online
            </a>
        </div>
    </div>
</aside>

<script>
    // Sidebar toggle functionality
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-hidden');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (event) => {
        const isSmallScreen = window.innerWidth < 640;
        const isSidebar = sidebar.contains(event.target);
        const isToggleButton = toggleSidebar.contains(event.target);

        if (isSmallScreen && !isSidebar && !isToggleButton && !sidebar.classList.contains('sidebar-hidden')) {
            sidebar.classList.add('sidebar-hidden');
        }
    });

    // Improved dropdown functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('button');
            const menu = dropdown.querySelector('.dropdown-menu');

            trigger.addEventListener('click', (e) => {
                // Close all other dropdowns
                dropdowns.forEach(d => {
                    if (d !== dropdown) {
                        d.querySelector('.dropdown-menu').classList.remove('show');
                    }
                });

                // Toggle current dropdown
                menu.classList.toggle('show');
                e.preventDefault();
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (event) => {
            dropdowns.forEach(dropdown => {
                const trigger = dropdown.querySelector('button');
                const menu = dropdown.querySelector('.dropdown-menu');

                if (!dropdown.contains(event.target)) {
                    menu.classList.remove('show');
                }
            });
        });
    });
</script>