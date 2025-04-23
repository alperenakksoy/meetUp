<?php
require_once dirname(__DIR__, 4) . '/helpers.php';

// Check if user is admin - in a real application, you would verify admin credentials
// For now, setting a hardcoded variable
$isAdmin = true;
$adminName = "Ahmet Alperen Aksoy";

// Redirect if not admin

if (!$isAdmin) {
    header("Location: /App/navigations/welcomePage.php");
    exit;
}

// Set page variables
$pageTitle = 'Admin Dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - SocialLoop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#f5a623',
                        secondary: '#2c3e50',
                    },
                    fontFamily: {
                        volkhov: ['Volkhov', 'serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Admin Navigation -->
    <nav class="bg-secondary fixed w-full top-0 left-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-white text-xl font-bold">SocialLoop Admin</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="#" class="border-primary text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="#" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Users
                        </a>
                        <a href="#" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Events
                        </a>
                        <a href="#" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Reports
                        </a>
                        <a href="#" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Settings
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center gap-3">
                            <span class="text-white text-sm">Welcome, <?php echo htmlspecialchars($adminName); ?></span>
                            <a href="/App/userHome/dashboard.php" class="bg-primary hover:bg-amber-500 text-white px-3 py-1 rounded-md text-sm font-medium">
                                Exit Admin
                            </a>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="bg-secondary inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="pt-16 pb-12">
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="px-4 py-6 sm:px-0">
                    <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">Platform overview and management tools</p>
                </div>
                
                <!-- Stats Cards -->
                <div class="px-4 sm:px-0">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <!-- Stats Card - Users -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-primary/10 rounded-md p-3">
                                        <i class="fas fa-users text-primary text-xl"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">8,249</div>
                                                <div class="text-sm text-green-600">+8.1% since last month</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-amber-500">View all users</a>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Card - Events -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                        <i class="fas fa-calendar-alt text-green-600 text-xl"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Active Events</dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">1,357</div>
                                                <div class="text-sm text-green-600">+12.5% since last month</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-amber-500">View all events</a>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Card - Reports -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                        <i class="fas fa-flag text-red-600 text-xl"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Active Reports</dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">23</div>
                                                <div class="text-sm text-red-600">8 high priority</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-amber-500">View all reports</a>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Card - Reviews -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                        <i class="fas fa-star text-blue-600 text-xl"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Avg. Rating</dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">4.8</div>
                                                <div class="text-sm text-blue-600">1,249 new reviews</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-amber-500">View all reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Reports Section -->
                <div class="mt-8 px-4 sm:px-0 grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <!-- Reports Panel -->
                    <div class="bg-white shadow rounded-lg lg:col-span-1">
                        <div class="px-5 py-4 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Reports</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="flex-shrink-0 h-2 w-2 rounded-full bg-red-600"></span>
                                        <span class="ml-3 font-medium text-gray-900">Inappropriate Content</span>
                                    </div>
                                    <span class="text-sm text-gray-500">2 hours ago</span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Reported by: Emma Johnson</p>
                                <div class="mt-2 flex">
                                    <a href="#" class="text-sm text-primary hover:text-amber-500">View details</a>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="flex-shrink-0 h-2 w-2 rounded-full bg-red-600"></span>
                                        <span class="ml-3 font-medium text-gray-900">Fake Profile</span>
                                    </div>
                                    <span class="text-sm text-gray-500">5 hours ago</span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Reported by: David Wilson</p>
                                <div class="mt-2 flex">
                                    <a href="#" class="text-sm text-primary hover:text-amber-500">View details</a>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="flex-shrink-0 h-2 w-2 rounded-full bg-amber-500"></span>
                                        <span class="ml-3 font-medium text-gray-900">Commercial Activity</span>
                                    </div>
                                    <span class="text-sm text-gray-500">1 day ago</span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Reported by: Sophie Chen</p>
                                <div class="mt-2 flex">
                                    <a href="#" class="text-sm text-primary hover:text-amber-500">View details</a>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="flex-shrink-0 h-2 w-2 rounded-full bg-green-500"></span>
                                        <span class="ml-3 font-medium text-gray-900">Harassment</span>
                                    </div>
                                    <span class="text-sm text-gray-500">2 days ago</span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Reported by: Michael Brown</p>
                                <div class="mt-2 flex">
                                    <a href="#" class="text-sm text-primary hover:text-amber-500">View details</a>
                                </div>
                            </div>
                        </div>
                        <div class="px-5 py-4 bg-gray-50">
                            <a href="#" class="text-sm font-medium text-primary hover:text-amber-500">View all reports</a>
                        </div>
                    </div>

                    <!-- Recent Activities Panel -->
                    <div class="bg-white shadow rounded-lg lg:col-span-2">
                        <div class="px-5 py-4 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Activity</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="px-5 py-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/63.jpg" alt="User">
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#" class="hover:underline">Emma Johnson</a> joined the <a href="#" class="text-primary hover:underline">Coffee & Cultural Exchange</a> event
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            30 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/54.jpg" alt="User">
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#" class="hover:underline">David Wilson</a> created a new event: <a href="#" class="text-primary hover:underline">Photography Walk in Balat</a>
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            1 hour ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/29.jpg" alt="User">
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#" class="hover:underline">Olivia Martinez</a> left a review for <a href="#" class="hover:underline">Ahmet Alperen Aksoy</a>
                                        </p>
                                        <div class="mt-1 text-sm text-gray-500">
                                            <div class="flex items-center mb-1">
                                                <div class="flex text-amber-500">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="ml-2">5 stars</span>
                                            </div>
                                            <p>"Great experience! The coffee meetup was perfectly organized."</p>
                                            <p class="mt-1">2 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/22.jpg" alt="User">
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#" class="hover:underline">Michael Brown</a> registered a new account
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            3 hours ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/45.jpg" alt="User">
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#" class="hover:underline">Sophie Chen</a> updated her profile
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            5 hours ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-5 py-4 bg-gray-50">
                            <a href="#" class="text-sm font-medium text-primary hover:text-amber-500">View all activity</a>
                        </div>
                    </div>
                </div>

                <!-- User Management Section -->
                <div class="mt-8 px-4 sm:px-0">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-5 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">User Management</h3>
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <input type="text" class="w-60 pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Search users...">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                                <button class="bg-primary hover:bg-amber-500 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-plus mr-2"></i> Add User
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Location
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Joined
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Events
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/22.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Michael Brown</div>
                                                    <div class="text-sm text-gray-500">michael.brown@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Istanbul, Turkey</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            April 2, 2025
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            0 hosted, 3 attended
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary hover:text-amber-500 mr-3">View</a>
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                            <a href="#" class="text-red-600 hover:text-red-900">Suspend</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/45.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Sophie Chen</div>
                                                    <div class="text-sm text-gray-500">sophie.chen@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Tokyo, Japan</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Suspended
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            January 28, 2025
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            3 hosted, 9 attended
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-primary hover:text-amber-500 mr-3">View</a>
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Reactivate</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-5 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                            <div class="flex-1 flex justify-between sm:hidden">
                                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Previous
                                </a>
                                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Next
                                </a>
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">8,249</span> users
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Previous</span>
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                        <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            1
                                        </a>
                                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            2
                                        </a>
                                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            3
                                        </a>
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            10
                                        </a>
                                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Next</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Management Preview -->
                <div class="mt-8 px-4 sm:px-0">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-5 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Event Management</h3>
                            <button class="bg-primary hover:bg-amber-500 text-white px-4 py-2 rounded-md text-sm font-medium">
                                View All Events
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-5">
                            <!-- Event Card 1 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">Today, 15:00</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-400 hover:text-gray-500">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-md font-semibold text-gray-900 mb-2">Coffee & Cultural Exchange</h4>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <i class="fas fa-map-marker-alt mr-1 text-primary"></i>
                                        <span>Kadıköy, Istanbul</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <i class="fas fa-user mr-1 text-primary"></i>
                                        <span>Hosted by Ahmet Alperen Aksoy</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">7/12 Attendees</span>
                                        <span class="text-blue-600">3 Pending</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Event Card 2 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">Apr 8, 09:00</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-400 hover:text-gray-500">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-md font-semibold text-gray-900 mb-2">Hiking Belgrad Forest</h4>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <i class="fas fa-map-marker-alt mr-1 text-primary"></i>
                                        <span>Belgrad Forest, Istanbul</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <i class="fas fa-user mr-1 text-primary"></i>
                                        <span>Hosted by Olivia Martinez</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">8/15 Attendees</span>
                                        <span class="text-blue-600">2 Pending</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Event Card 3 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Reported
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">Apr 10, 10:00</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-400 hover:text-gray-500">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-md font-semibold text-gray-900 mb-2">Historical Istanbul Tour</h4>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <i class="fas fa-map-marker-alt mr-1 text-primary"></i>
                                        <span>Sultanahmet, Istanbul</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <i class="fas fa-user mr-1 text-primary"></i>
                                        <span>Hosted by David Wilson</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">12/20 Attendees</span>
                                        <span class="text-blue-600">5 Pending</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-5 py-4 bg-gray-50 border-t border-gray-200">
                            <a href="#" class="text-sm font-medium text-primary hover:text-amber-500">View all events</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:order-2">
                    <span class="text-sm text-gray-500">SocialLoop Administration Panel</span>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-sm text-gray-500">&copy; 2025 SocialLoop. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('button[aria-expanded]');
            
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    const expanded = this.getAttribute('aria-expanded') === 'true' || false;
                    this.setAttribute('aria-expanded', !expanded);
                    
                    // Toggle mobile menu visibility
                    const mobileMenu = document.querySelector('.sm\\:hidden');
                    if (mobileMenu) {
                        mobileMenu.classList.toggle('hidden');
                    }
                });
            }
            
            // Implement other interactive features as needed
            // For example: filter functionality, sort tables, etc.
        });
    </script>
</body>
</html>
                                    