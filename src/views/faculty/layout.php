<?php
require_once __DIR__ . '/../../controllers/FacultyController.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 6) {
    header('Location: /login?error=Unauthorized access');
    exit;
}

// Determine current page for active navigation highlighting
$currentUri = $_SERVER['REQUEST_URI'];

// Fetch profile picture from session or database
$profilePicture = $_SESSION['profile_picture'] ?? null;
if (!$profilePicture) {
    try {
        $db = (new Database())->connect();
        $stmt = $db->prepare("SELECT profile_picture FROM users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $profilePicture = $stmt->fetchColumn() ?: '';
        $_SESSION['profile_picture'] = $profilePicture; // Cache in session
    } catch (PDOException $e) {
        error_log("layout: Error fetching profile picture - " . $e->getMessage());
        $profilePicture = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
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

        /* Header Styles */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            z-index: 10;
            transition: all 0.3s ease;
        }

        /* Desktop header - fixed positioning */
        @media (min-width: 768px) {
            .header {
                position: fixed;
                top: 0;
                left: 256px;
                /* Sidebar width */
                right: 0;
            }

            .header-content {
                padding: 1rem 1.5rem;
            }
        }

        /* Mobile header - full width */
        @media (max-width: 767px) {
            .header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
            }

            .header-content {
                padding: 0.75rem 1rem;
            }
        }

        /* Sidebar Styles */
        .sidebar {
            background: linear-gradient(to bottom, #1F2937, #111827);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1100;
        }

        /* Desktop sidebar */
        @media (min-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 256px;
                height: 100vh;
                transform: translateX(0);
            }
        }

        /* Mobile sidebar */
        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 60vw;
                /* Updated to 60vw as requested */
                height: 100vh;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Close button for mobile sidebar */
        .close-sidebar-btn {
            background: none;
            border: none;
            color: #d4af37;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.2s ease;
        }

        .close-sidebar-btn:hover {
            color: #B8860B;
        }

        .close-sidebar-btn:focus {
            outline: 2px solid #D4AF37;
            outline-offset: 2px;
        }

        /* Hamburger Menu Button */
        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            color: #4B5563;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .hamburger-btn:hover {
            background-color: #F3F4F6;
            color: #D4AF37;
        }

        .hamburger-btn:focus {
            outline: 2px solid #D4AF37;
            outline-offset: 2px;
        }

        @media (max-width: 767px) {
            .hamburger-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* Navigation Items */
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

        /* Dropdown Styles */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            border-radius: 0.375rem;
            background: #1F2937;
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.2s ease;
        }

        .dropdown-menu.show {
            display: flex;
            flex-direction: column;
            transform: translateY(0);
            opacity: 1;
        }

        /* Main Content */
        .main-content {
            transition: all 0.3s ease;
            min-height: 100vh;
            background-color: #F5F5F5;
        }

        /* Desktop main content */
        @media (min-width: 768px) {
            .main-content {
                margin-left: 256px;
                padding-top: 5rem;
                /* Account for fixed header */
            }
        }

        /* Mobile main content */
        @media (max-width: 767px) {
            .main-content {
                margin-left: 0;
                padding-top: 4.5rem;
                /* Account for mobile header */
            }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .sidebar {
                width: 60vw;
            }

            .main-content {
                padding-top: 4rem;
            }

            .header-content {
                padding: 0.5rem 1rem;
            }
        }

        /* University logo */
        .university-logo {
            height: 40px;
            transition: transform 0.3s ease;
        }

        .university-logo:hover {
            transform: scale(1.05);
        }

        /* Button animations */
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

        /* Custom scrollbar */
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

        /* Notification styles */
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

        /* Card animations */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        /* Focus styles for accessibility */
        .nav-item:focus,
        .dropdown button:focus {
            outline: 2px solid #D4AF37;
            outline-offset: 2px;
        }
    </style>
</head>

<body class="bg-gray-200 font-sans">
    <!-- Toast notifications container -->
    <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-4"></div>

    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    <!-- Header -->
    <header class="header">
        <div class="header-content max-w-full mx-auto flex items-center justify-between">
            <!-- Left: Hamburger Menu and Logo -->
            <div class="flex items-center space-x-4">
                <button id="hamburger-btn" class="hamburger-btn" aria-label="Toggle navigation menu">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="/faculty/dashboard" class="flex items-center space-x-2">
                    <img src="/assets/logo/main_logo/PRMSUlogo.png" alt="PRMSU Logo" class="university-logo">
                    <span class="text-lg font-heading text-gray-800 hidden sm:inline">ACSS</span>
                </a>
            </div>

            <!-- Right: User Profile and Notifications -->
            <div class="flex items-center space-x-2 md:space-x-4">
                <!-- User Profile Dropdown -->
                <div class="dropdown relative">
                    <button class="flex items-center text-gray-600 hover:text-yellow-400 focus:outline-none p-1 rounded-md transition-colors">
                        <?php if (!empty($profilePicture)): ?>
                            <img class="h-8 w-8 rounded-full border-2 border-yellow-400 object-cover"
                                src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile">
                        <?php else: ?>
                            <div class="h-8 w-8 rounded-full border-2 border-yellow-400 bg-yellow-400 flex items-center justify-center text-white text-sm font-bold">
                                <?php echo strtoupper(substr($_SESSION['first_name'], 0, 1) . substr($_SESSION['last_name'], 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                        <span class="ml-2 hidden sm:inline text-sm font-medium max-w-24 truncate"><?php echo htmlspecialchars($_SESSION['first_name']); ?></span>
                        <i class="fas fa-chevron-down ml-1 md:ml-2 text-xs"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="/faculty/profile" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-600 hover:text-yellow-300 transition-colors">
                            <i class="fas fa-user w-5 mr-2"></i> Profile
                        </a>
                        <a href="/faculty/settings" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-600 hover:text-yellow-300 transition-colors">
                            <i class="fas fa-cog w-5 mr-2"></i> Settings
                        </a>
                        <a href="/faculty/logout" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-600 hover:text-yellow-300 transition-colors">
                            <i class="fas fa-sign-out-alt w-5 mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar text-white overflow-y-auto">
        <!-- Sidebar Header -->
        <div class="py-6 px-6 flex flex-col items-center justify-center border-b border-gray-700 bg-gray-900">
            <div class="flex items-center justify-center mb-3">
                <img src="/assets/logo/main_logo/PRMSUlogo.png" alt="PRMSU Logo" class="h-12">
            </div>
            <h2 class="text-xl font-bold text-yellow-400 text-center">PRMSU Automated Classroom Scheduling System - ACSS</h2>
            <p class="text-xs text-gray-400 mt-1 text-center">Faculty Management System</p>
            <button id="close-sidebar-btn" class="close-sidebar-btn absolute top-4 right-4 md:hidden" aria-label="Close navigation menu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- User Profile Section -->
        <div class="p-4 border-b border-gray-700 bg-gray-800/70">
            <div class="flex items-center space-x-3">
                <?php if (!empty($profilePicture)): ?>
                    <img class="h-12 w-12 rounded-full border-2 border-yellow-400 object-cover shadow-md flex-shrink-0"
                        src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile">
                <?php else: ?>
                    <div class="h-12 w-12 rounded-full border-2 border-yellow-400 bg-yellow-400 flex items-center justify-center text-white text-lg font-bold shadow-md flex-shrink-0">
                        <?php echo strtoupper(substr($_SESSION['first_name'], 0, 1) . substr($_SESSION['last_name'], 0, 1)); ?>
                    </div>
                <?php endif; ?>
                <div class="min-w-0 flex-1">
                    <p class="font-medium text-white truncate"><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></p>
                    <div class="flex items-center text-xs text-yellow-400">
                        <i class="fas fa-circle text-green-500 mr-1 text-xs"></i>
                        <span>Faculty</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-4 px-2 flex-1">
            <!-- Dashboard Link -->
            <a href="/faculty/dashboard" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?php echo strpos($currentUri, '/faculty/dashboard') !== false ? 'active-nav bg-gray-800 text-yellow-400' : ''; ?>">
                <i class="fas fa-tachometer-alt w-5 mr-3 flex-shrink-0 <?php echo strpos($currentUri, '/faculty/dashboard') !== false ? 'text-yellow-400' : 'text-gray-400'; ?>"></i>
                <span>Dashboard</span>
            </a>

            <!-- My Schedule Link -->
            <a href="/faculty/schedule" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?php echo strpos($currentUri, '/faculty/schedule') !== false ? 'active-nav bg-gray-800 text-yellow-400' : ''; ?>">
                <i class="fas fa-calendar-alt w-5 mr-3 flex-shrink-0 <?php echo strpos($currentUri, '/faculty/schedule') !== false ? 'text-yellow-400' : 'text-gray-400'; ?>"></i>
                <span>My Schedule</span>
            </a>

            <!-- Profile Link -->
            <a href="/faculty/profile" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?php echo strpos($currentUri, '/faculty/profile') !== false ? 'active-nav bg-gray-800 text-yellow-400' : ''; ?>">
                <i class="fas fa-user-circle w-5 mr-3 flex-shrink-0 <?php echo strpos($currentUri, '/faculty/profile') !== false ? 'text-yellow-400' : 'text-gray-400'; ?>"></i>
                <span>Profile</span>
            </a>

            <!-- Settings Link -->
            <a href="/faculty/settings" class="nav-item flex items-center px-4 py-3 text-gray-200 rounded-lg mb-1 hover:text-white transition-all duration-300 <?php echo strpos($currentUri, '/faculty/settings') !== false ? 'active-nav bg-gray-800 text-yellow-400' : ''; ?>">
                <i class="fas fa-cog w-5 mr-3 flex-shrink-0 <?php echo strpos($currentUri, '/faculty/settings') !== false ? 'text-yellow-400' : 'text-gray-400'; ?>"></i>
                <span>Settings</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-900 border-t border-gray-700 hidden md:block">
            <div class="flex items-center justify-between text-xs text-gray-400">
                <div>
                    <p>Faculty System</p>
                    <p>Version 2.1.0</p>
                </div>
                <a href="/faculty/system/status" class="text-yellow-400 hover:text-yellow-300 transition-all duration-300">
                    <i class="fas fa-circle text-green-500 mr-1"></i> Online
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content p-4 md:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <?php
            $segments = explode('/', trim($currentUri, '/'));
            if (count($segments) > 1):
            ?>
                <nav class="flex mb-5 text-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 flex-wrap">
                        <li class="inline-flex items-center">
                            <a href="/faculty/dashboard" class="inline-flex items-center text-gray-500 hover:text-yellow-400 transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Home
                            </a>
                        </li>
                        <?php
                        $path = '/faculty';
                        foreach ($segments as $index => $segment):
                            if ($index == 0) continue;
                            $path .= '/' . $segment;
                            $isLast = ($index === count($segments) - 1);
                        ?>
                            <li class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-1 md:mx-2 text-xs"></i>
                                <?php if ($isLast): ?>
                                    <span class="text-yellow-400 font-medium"><?php echo ucfirst(str_replace('-', ' ', $segment)); ?></span>
                                <?php else: ?>
                                    <a href="<?php echo $path; ?>" class="text-gray-500 hover:text-yellow-400 transition-colors"><?php echo ucfirst(str_replace('-', ' ', $segment)); ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </nav>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="slide-in-left">
                <?php echo $content; ?>
            </div>
        </div>
    </main>

    <script>
        // DOM Elements
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const closeSidebarBtn = document.getElementById('close-sidebar-btn'); // Updated ID

        // Sidebar toggle function
        function toggleSidebar() {
            const isMobile = window.innerWidth < 768;

            if (isMobile) {
                const isOpen = sidebar.classList.contains('active');

                if (isOpen) {
                    // Close sidebar
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                } else {
                    // Open sidebar
                    sidebar.classList.add('active');
                    sidebarOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }
        }

        // Close sidebar function
        function closeSidebar() {
            if (window.innerWidth < 768) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Event listeners
        hamburgerBtn.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);
        // New event listener for the close button
        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener('click', closeSidebar);
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                // Desktop view - ensure sidebar is visible and overlay is hidden
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Close sidebar when clicking on navigation links (mobile)
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    closeSidebar();
                }
            });
        });

        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', () => {
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                const trigger = dropdown.querySelector('button');
                const menu = dropdown.querySelector('.dropdown-menu');

                trigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = menu.classList.contains('show');

                    // Close all dropdowns
                    dropdowns.forEach(d => {
                        d.querySelector('.dropdown-menu').classList.remove('show');
                    });

                    // Toggle current dropdown
                    if (!isOpen) {
                        menu.classList.add('show');
                    }
                });

                // Close dropdown on outside click
                document.addEventListener('click', (event) => {
                    if (!dropdown.contains(event.target)) {
                        menu.classList.remove('show');
                    }
                });
            });
        });

        // Keyboard navigation support
        document.addEventListener('keydown', (e) => {
            // Close sidebar with Escape key
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });

        // Smooth page transitions
        document.addEventListener('DOMContentLoaded', () => {
            // Add fade-in animation to main content
            const mainContent = document.querySelector('.main-content');
            if (mainContent) {
                mainContent.classList.add('fade-in');
            }
        });
    </script>
</body>

</html>