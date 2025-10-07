<?php
ob_start();
?>

<style>
    :root {
        --gold: #D4AF37;
        --white: #FFFFFF;
        --gray-dark: #4B5563;
        --gray-light: #E5E7EB;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .slide-in-left {
        animation: slideInLeft 0.5s ease-in;
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

    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .modal {
        transition: opacity 0.3s ease;
    }

    .modal.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .modal-content {
        transition: transform 0.3s ease;
    }

    .input-focus {
        transition: all 0.2s ease;
    }

    .input-focus:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    .btn-gold {
        background-color: var(--gold);
        color: var(--white);
    }

    .btn-gold:hover {
        background-color: #b8972e;
    }

    .loading::after {
        content: '';
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid var(--gold);
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin-left: 8px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .tab-active {
        background-color: var(--gold);
        color: var(--white);
    }

    .tab-active:hover {
        background-color: #b8972e;
    }
</style>

<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bg-clip-text text-transparent bg-gradient-to-r from-yellow-600 to-yellow-400 slide-in-left">
                        User Management
                    </h1>
                    <p class="mt-2 text-gray-600 slide-in-right">Manage system users, roles, and permissions</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="card bg-white rounded-xl shadow-md p-6 border border-gray-200 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo count($users); ?></p>
                    </div>
                </div>
            </div>
            <div class="card bg-white rounded-xl shadow-md p-6 border border-gray-200 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Users</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo count(array_filter($users, fn($u) => $u['is_active'])); ?></p>
                    </div>
                </div>
            </div>
            <div class="card bg-white rounded-xl shadow-md p-6 border border-gray-200 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Roles</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo count($roles); ?></p>
                    </div>
                </div>
            </div>
            <div class="card bg-white rounded-xl shadow-md p-6 border border-gray-200 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Departments</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo count($departments); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 mb-6">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" id="searchUsers" placeholder="Search users..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <select id="roleFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">All Roles</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo htmlspecialchars($role['role_name'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($role['role_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <select id="collegeFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">All Colleges</option>
                            <?php foreach ($colleges as $college): ?>
                                <option value="<?php echo htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <nav class="flex space-x-6 border-b border-gray-200">
                <button id="tab-all" class="tab px-4 py-2 text-sm font-medium rounded-t-lg transition-colors duration-200 <?php echo !isset($_GET['tab']) || $_GET['tab'] === 'all' ? 'tab-active' : 'text-gray-500 hover:text-gray-700'; ?>" onclick="switchTab('all')">All Users</button>
                <button id="tab-active" class="tab px-4 py-2 text-sm font-medium rounded-t-lg transition-colors duration-200 <?php echo isset($_GET['tab']) && $_GET['tab'] === 'active' ? 'tab-active' : 'text-gray-500 hover:text-gray-700'; ?>" onclick="switchTab('active')">Active Users</button>
                <button id="tab-inactive" class="tab px-4 py-2 text-sm font-medium rounded-t-lg transition-colors duration-200 <?php echo isset($_GET['tab']) && $_GET['tab'] === 'inactive' ? 'tab-active' : 'text-gray-500 hover:text-gray-700'; ?>" onclick="switchTab('inactive')">Inactive Users</button>
                <button id="tab-pending" class="tab px-4 py-2 text-sm font-medium rounded-t-lg transition-colors duration-200 <?php echo isset($_GET['tab']) && $_GET['tab'] === 'pending' ? 'tab-active' : 'text-gray-500 hover:text-gray-700'; ?>" onclick="switchTab('pending')">Pending Users <span id="pending-count" class="ml-1 bg-red-500 text-white text-xs rounded-full px-2 py-0.5"><?php echo count(array_filter($users, fn($u) => !$u['is_active'] && /* Add pending condition */ true)); ?></span></button>
            </nav>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900" id="table-title">Users Directory</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="usersTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider resize-x cursor-col-resize">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider resize-x cursor-col-resize">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider resize-x cursor-col-resize">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider resize-x cursor-col-resize">College</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider resize-x cursor-col-resize">Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider resize-x cursor-col-resize">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider resize-x cursor-col-resize">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
                        <?php foreach ($users as $user): ?>
                            <tr class="user-row <?php echo !$user['is_active'] ? 'pending-user' : ($user['is_active'] ? 'active-user' : 'inactive-user'); ?> hover:bg-gray-50 transition-colors duration-150 cursor-pointer" data-user-id="<?php echo $user['user_id']; ?>" style="display: <?php echo !isset($_GET['tab']) || $_GET['tab'] === 'all' ? '' : 'none'; ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <?php if (!empty($user['profile_picture'])): ?>
                                                <img src="<?php echo htmlspecialchars($user['profile_picture'], ENT_QUOTES, 'UTF-8'); ?>" alt="Profile picture" class="h-10 w-10 rounded-full">
                                            <?php else: ?>
                                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                                    <span class="text-sm font-medium text-yellow-600">
                                                        <?php echo strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1)); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($user['title'] . ' ' . $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ' ' . $user['suffix'], ENT_QUOTES, 'UTF-8'); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                @<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($user['email'] ?? 'Not provided', ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <?php echo htmlspecialchars($user['role_name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($user['college_name'] ?? 'Not assigned', ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($user['department_name'] ?? 'Not assigned', ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php $isActive = isset($user['is_active']) && $user['is_active']; ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $isActive ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="editUser(<?php echo $user['user_id']; ?>)" class="text-green-600 hover:text-green-900 p-1 rounded transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <?php if (!$isActive): ?>
                                            <button onclick="approveUser(<?php echo $user['user_id']; ?>, '<?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?>')" class="text-yellow-600 hover:text-yellow-900 p-1 rounded transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </button>
                                            <button onclick="declineUser(<?php echo $user['user_id']; ?>, '<?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?>')" class="text-red-600 hover:text-red-900 p-1 rounded transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </button>
                                        <?php elseif ($isActive): ?>
                                            <button onclick="disableUser(<?php echo $user['user_id']; ?>, '<?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?>')" class="text-red-600 hover:text-red-900 p-1 rounded transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                                </svg>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Decline User Confirmation Modal -->
    <div id="declineUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="relative mx-auto p-6 border w-96 shadow-lg rounded-xl bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Decline User Account</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to decline <span id="declineUserName" class="font-semibold"></span>? This action will permanently remove the user.
                    </p>
                </div>
                <div class="flex justify-center space-x-3 px-4 py-3">
                    <button onclick="closeDeclineUserModal()" class="px-4 py-2 bg-white text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-colors">
                        Cancel
                    </button>
                    <button onclick="confirmDeclineUser()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                        Decline User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Disable User Confirmation Modal -->
    <div id="disableUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="relative mx-auto p-6 border w-96 shadow-lg rounded-xl bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Disable User Account</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to disable <span id="disableUserName" class="font-semibold"></span>? This action will prevent the user from logging in.
                    </p>
                </div>
                <div class="flex justify-center space-x-3 px-4 py-3">
                    <button onclick="closeDisableUserModal()" class="px-4 py-2 bg-white text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-colors">
                        Cancel
                    </button>
                    <button onclick="confirmDisableUser()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                        Disable User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View User Modal -->
    <div id="viewUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="relative mx-auto p-6 border w-full max-w-2xl shadow-lg rounded-xl bg-white">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900">User Details</h3>
                <button onclick="closeViewUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="userDetailsContent" class="space-y-4">
                <!-- Populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        let currentUserId = null;

        function disableUser(userId, userName) {
            currentUserId = userId;
            document.getElementById('disableUserName').textContent = userName;
            document.getElementById('disableUserModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function declineUser(userId, userName) {
            currentUserId = userId;
            document.getElementById('declineUserName').textContent = userName;
            document.getElementById('declineUserModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeclineUserModal() {
            document.getElementById('declineUserModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentUserId = null;
        }

        function confirmDeclineUser() {
            if (currentUserId) {
                fetch(`/admin/users?action=decline&user_id=${currentUserId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-Token': '<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeDeclineUserModal();
                            location.reload();
                        } else {
                            alert('Failed to decline user: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while declining the user');
                    });
            }
        }

        // Update approveUser to include confirmation
        function approveUser(userId, userName) {
            if (confirm(`Are you sure you want to approve ${userName}?`)) {
                fetch(`/admin/users?action=approve&user_id=${userId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-Token': '<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to approve user: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while approving the user');
                    });
            }
        }

        function enableUser(userId, userName) {
            if (confirm(`Are you sure you want to enable ${userName}?`)) {
                fetch(`/admin/users?action=enable&user_id=${userId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-Token': '<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to enable user: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while enabling the user');
                    });
            }
        }

        function closeDisableUserModal() {
            document.getElementById('disableUserModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentUserId = null;
        }

        function confirmDisableUser() {
            if (currentUserId) {
                fetch(`/admin/users?action=disable&user_id=${currentUserId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-Token': '<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeDisableUserModal();
                            location.reload();
                        } else {
                            alert('Failed to disable user: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while disabling the user');
                    });
            }
        }

        function showUserDetails(row) {
            currentUserId = row.getAttribute('data-user-id');
            const cells = row.getElementsByTagName('td');
            const user = {
                username: cells[0].querySelector('.text-gray-500').textContent.replace('@', ''),
                email: cells[1].textContent,
                first_name: cells[0].querySelector('.text-gray-900').textContent.split(' ')[0],
                last_name: cells[0].querySelector('.text-gray-900').textContent.split(' ')[1],
                role_name: cells[2].textContent,
                college_name: cells[3].textContent,
                department_name: cells[4].textContent,
                is_active: cells[5].textContent === 'Inactive'
            };
            const content = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700">Username</label><p class="mt-1 text-gray-900">${user.username}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700">Email</label><p class="mt-1 text-gray-900">${user.email}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700">Full Name</label><p class="mt-1 text-gray-900">${user.first_name} ${user.last_name}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700">Role</label><p class="mt-1 text-gray-900">${user.role_name}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700">College</label><p class="mt-1 text-gray-900">${user.college_name}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700">Department</label><p class="mt-1 text-gray-900">${user.department_name}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700">Status</label><p class="mt-1 text-gray-900">${user.is_active ? 'Inactive' : 'Active'}</p></div>
                </div>
            `;
            document.getElementById('userDetailsContent').innerHTML = content;
            document.getElementById('viewUserModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeViewUserModal() {
            document.getElementById('viewUserModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentUserId = null;
        }

        // ... (other functions like approveUser, filterTable, etc.)

        // Event listeners
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('.user-row');
            rows.forEach(row => {
                row.addEventListener('click', () => showUserDetails(row));
            });

            const defaultTab = '<?php echo isset($_GET['tab']) ? htmlspecialchars($_GET['tab'], ENT_QUOTES, 'UTF-8') : 'all'; ?>';
            if (['all', 'active', 'inactive', 'pending'].includes(defaultTab)) {
                switchTab(defaultTab);
            } else {
                switchTab('all');
            }
        });

        function approveUser(userId, userName) {
            if (confirm(`Are you sure you want to approve ${userName}?`)) {
                fetch(`/admin/users?action=approve&user_id=${userId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-Token': '<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to approve user: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while approving the user');
                    });
            }
        }

        // Search and filter functionality
        document.getElementById('searchUsers').addEventListener('input', function() {
            filterTable();
        });

        document.getElementById('roleFilter').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('collegeFilter').addEventListener('change', function() {
            filterTable();
        });

        function switchTab(tab) {
            const tabs = document.querySelectorAll('.tab');
            const rows = document.querySelectorAll('.user-row');
            tabs.forEach(t => t.classList.remove('tab-active'));
            document.getElementById(`tab-${tab}`).classList.add('tab-active');
            document.getElementById('table-title').textContent = `${tab.charAt(0).toUpperCase() + tab.slice(1)} Users`;
            rows.forEach(row => {
                row.style.display = 'none';
                if (tab === 'all') row.style.display = '';
                else if (tab === 'active' && row.classList.contains('active-user')) row.style.display = '';
                else if (tab === 'inactive' && row.classList.contains('inactive-user')) row.style.display = '';
                else if (tab === 'pending' && row.classList.contains('pending-user')) row.style.display = '';
            });
            window.history.pushState({}, '', `?tab=${tab}`);
            filterTable();
        }

        function filterTable() {
            const searchTerm = document.getElementById('searchUsers').value.toLowerCase();
            const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
            const collegeFilter = document.getElementById('collegeFilter').value.toLowerCase();
            const activeTab = document.querySelector('.tab-active')?.id.replace('tab-', '') || 'all';

            const rows = document.querySelectorAll('.user-row');
            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                if (cells.length > 0) {
                    const userName = cells[0].textContent.toLowerCase();
                    const userEmail = cells[1].textContent.toLowerCase();
                    const userRole = cells[2].textContent.toLowerCase();
                    const userCollege = cells[3].textContent.toLowerCase();
                    const isVisible = (activeTab === 'all' ||
                        (activeTab === 'active' && row.classList.contains('active-user')) ||
                        (activeTab === 'inactive' && row.classList.contains('inactive-user')) ||
                        (activeTab === 'pending' && row.classList.contains('pending-user')));

                    const matchesSearch = userName.includes(searchTerm) || userEmail.includes(searchTerm);
                    const matchesRole = roleFilter === '' || userRole.includes(roleFilter);
                    const matchesCollege = collegeFilter === '' || userCollege.includes(collegeFilter);

                    row.style.display = isVisible && matchesSearch && matchesRole && matchesCollege ? '' : 'none';
                }
            });
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const addModal = document.getElementById('addUserModal');
            const disableModal = document.getElementById('disableUserModal');
            const viewModal = document.getElementById('viewUserModal');
            const editModal = document.getElementById('editUserModal');

            if (event.target === addModal) closeAddUserModal();
            if (event.target === disableModal) closeDisableUserModal();
            if (event.target === viewModal) closeViewUserModal();
            if (event.target === editModal) closeEditUserModal();
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeAddUserModal();
                closeDisableUserModal();
                closeViewUserModal();
                closeEditUserModal();
            }
        });

        // Column resizing
        const thElements = document.querySelectorAll('th[role="columnheader"]');
        thElements.forEach(th => {
            let startX, startWidth;

            th.addEventListener('mousedown', (e) => {
                startX = e.pageX;
                startWidth = th.offsetWidth;
                th.style.userSelect = 'none';

                function resize(e) {
                    const diff = e.pageX - startX;
                    th.style.width = (startWidth + diff) + 'px';
                }

                function stopResize() {
                    document.removeEventListener('mousemove', resize);
                    document.removeEventListener('mouseup', stopResize);
                    th.style.userSelect = '';
                }

                document.addEventListener('mousemove', resize);
                document.addEventListener('mouseup', stopResize);
            });
        });

        // Initialize default tab
        document.addEventListener('DOMContentLoaded', () => {
            const defaultTab = '<?php echo isset($_GET['tab']) ? htmlspecialchars($_GET['tab'], ENT_QUOTES, 'UTF-8') : 'all'; ?>';
            if (['all', 'active', 'inactive', 'pending'].includes(defaultTab)) {
                switchTab(defaultTab);
            } else {
                switchTab('all');
            }
        });
    </script>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>