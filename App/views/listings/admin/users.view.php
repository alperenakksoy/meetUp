<?php
require_once __DIR__ . '/../helpers.php';

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
$pageTitle = 'User Management';

// Mock user data - in a real application, this would come from a database
$users = [
    [
        'id' => 1,
        'name' => 'Emma Johnson',
        'email' => 'emma.johnson@example.com',
        'location' => 'London, UK',
        'status' => 'active',
        'verified' => true,
        'joined' => 'January 10, 2025',
        'last_active' => 'April 15, 2025',
        'events_hosted' => 8,
        'events_attended' => 12,
        'profile_img' => 'https://randomuser.me/api/portraits/women/63.jpg',
        'reviews' => 4.9,
        'reports' => 0
    ],
    [
        'id' => 2,
        'name' => 'David Wilson',
        'email' => 'david.wilson@example.com',
        'location' => 'Berlin, Germany',
        'status' => 'active',
        'verified' => true,
        'joined' => 'February 5, 2025',
        'last_active' => 'April 14, 2025',
        'events_hosted' => 5,
        'events_attended' => 7,
        'profile_img' => 'https://randomuser.me/api/portraits/men/54.jpg',
        'reviews' => 4.7,
        'reports' => 1
    ],
    [
        'id' => 3,
        'name' => 'Olivia Martinez',
        'email' => 'olivia.martinez@example.com',
        'location' => 'Barcelona, Spain',
        'status' => 'active',
        'verified' => true,
        'joined' => 'March 15, 2025',
        'last_active' => 'April 16, 2025',
        'events_hosted' => 2,
        'events_attended' => 15,
        'profile_img' => 'https://randomuser.me/api/portraits/women/29.jpg',
        'reviews' => 4.8,
        'reports' => 0
    ],
    [
        'id' => 4,
        'name' => 'Michael Brown',
        'email' => 'michael.brown@example.com',
        'location' => 'Istanbul, Turkey',
        'status' => 'pending',
        'verified' => false,
        'joined' => 'April 2, 2025',
        'last_active' => 'April 12, 2025',
        'events_hosted' => 0,
        'events_attended' => 3,
        'profile_img' => 'https://randomuser.me/api/portraits/men/22.jpg',
        'reviews' => 4.2,
        'reports' => 0
    ],
    [
        'id' => 5,
        'name' => 'Sophie Chen',
        'email' => 'sophie.chen@example.com',
        'location' => 'Tokyo, Japan',
        'status' => 'suspended',
        'verified' => true,
        'joined' => 'January 28, 2025',
        'last_active' => 'April 5, 2025',
        'events_hosted' => 3,
        'events_attended' => 9,
        'profile_img' => 'https://randomuser.me/api/portraits/women/45.jpg',
        'reviews' => 4.5,
        'reports' => 2
    ],
    [
        'id' => 6,
        'name' => 'James Taylor',
        'email' => 'james.taylor@example.com',
        'location' => 'Amsterdam, Netherlands',
        'status' => 'active',
        'verified' => true,
        'joined' => 'February 12, 2025',
        'last_active' => 'April 16, 2025',
        'events_hosted' => 6,
        'events_attended' => 4,
        'profile_img' => 'https://randomuser.me/api/portraits/men/33.jpg',
        'reviews' => 4.6,
        'reports' => 0
    ],
    [
        'id' => 7,
        'name' => 'Isabella Johnson',
        'email' => 'isabella.johnson@example.com',
        'location' => 'Rome, Italy',
        'status' => 'active',
        'verified' => true,
        'joined' => 'March 3, 2025',
        'last_active' => 'April 15, 2025',
        'events_hosted' => 9,
        'events_attended' => 5,
        'profile_img' => 'https://randomuser.me/api/portraits/women/12.jpg',
        'reviews' => 4.9,
        'reports' => 0
    ],
    [
        'id' => 8,
        'name' => 'Alexander Kim',
        'email' => 'alexander.kim@example.com',
        'location' => 'Seoul, South Korea',
        'status' => 'pending',
        'verified' => false,
        'joined' => 'April 8, 2025',
        'last_active' => 'April 8, 2025',
        'events_hosted' => 0,
        'events_attended' => 0,
        'profile_img' => 'https://randomuser.me/api/portraits/men/42.jpg',
        'reviews' => 0,
        'reports' => 0
    ]
];
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
                        <a href="dashboard.php" class="border-transparent text-gray-300 hover:border-gray-300 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="user-management.php" class="border-primary text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
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
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
                            <p class="mt-1 text-sm text-gray-600">View and manage all user accounts</p>
                        </div>
                        <div>
                            <button class="bg-primary hover:bg-amber-500 text-white px-4 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-user-plus mr-2"></i> Add New User
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Filters and Search -->
                <div class="px-4 sm:px-0 mb-6">
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="w-full md:w-auto flex items-center gap-4">
                                <div class="relative flex-grow md:flex-grow-0 md:w-64">
                                    <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Search users...">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                                <select class="border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">All Statuses</option>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                                <select class="border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">All Locations</option>
                                    <option value="istanbul">Istanbul</option>
                                    <option value="london">London</option>
                                    <option value="berlin">Berlin</option>
                                    <option value="barcelona">Barcelona</option>
                                    <option value="tokyo">Tokyo</option>
                                    <option value="amsterdam">Amsterdam</option>
                                    <option value="rome">Rome</option>
                                    <option value="seoul">Seoul</option>
                                </select>
                                <select class="border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Verification Status</option>
                                    <option value="verified">Verified</option>
                                    <option value="unverified">Unverified</option>
                                </select>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <select class="border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Sort By</option>
                                    <option value="name_asc">Name (A-Z)</option>
                                    <option value="name_desc">Name (Z-A)</option>
                                    <option value="date_asc">Join Date (Oldest)</option>
                                    <option value="date_desc">Join Date (Newest)</option>
                                    <option value="events_desc">Most Events</option>
                                    <option value="reports_desc">Most Reports</option>
                                </select>
                                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-filter mr-2"></i> Apply Filters
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- User Table -->
                <div class="px-4 sm:px-0 mb-6">
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <input type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                                <span class="ml-2">User</span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Location
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Events
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Rating
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Reports
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Joined
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($users as $user): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <input type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded mr-3">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="<?php echo htmlspecialchars($user['profile_img']); ?>" alt="<?php echo htmlspecialchars($user['name']); ?>">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($user['name']); ?></div>
                                                    <div class="text-sm text-gray-500"><?php echo htmlspecialchars($user['email']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($user['status'] == 'active'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                                <?php if ($user['verified']): ?>
                                                <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    <i class="fas fa-check-circle mr-1"></i> Verified
                                                </span>
                                                <?php endif; ?>
                                            <?php elseif ($user['status'] == 'pending'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            <?php elseif ($user['status'] == 'suspended'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Suspended
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($user['location']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <?php echo $user['events_hosted']; ?> hosted, <?php echo $user['events_attended']; ?> attended
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($user['reviews'] > 0): ?>
                                            <div class="flex items-center text-gray-900">
                                                <span class="text-sm font-medium"><?php echo number_format($user['reviews'], 1); ?></span>
                                                <i class="fas fa-star text-amber-400 ml-1"></i>
                                            </div>
                                            <?php else: ?>
                                            <span class="text-sm text-gray-500">No reviews</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($user['reports'] > 0): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                <?php echo $user['reports']; ?> reports
                                            </span>
                                            <?php else: ?>
                                            <span class="text-sm text-gray-500">None</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo htmlspecialchars($user['joined']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="#" class="text-primary hover:text-amber-500" title="View Profile">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="text-blue-600 hover:text-blue-900" title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php if ($user['status'] == 'active'): ?>
                                                <a href="#" class="text-red-600 hover:text-red-900" title="Suspend User">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                                <?php elseif ($user['status'] == 'suspended'): ?>
                                                <a href="#" class="text-green-600 hover:text-green-900" title="Reactivate User">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <?php endif; ?>
                                                <button class="text-gray-400 hover:text-gray-500 relative" title="More Options">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-5 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing <span class="font-medium">1</span> to <span class="font-medium"><?php echo count($users); ?></span> of <span class="font-medium">8,249</span> users
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
                                        825
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

                <!-- Bulk Actions -->
                <div class="px-4 sm:px-0 mb-6">
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-500">
                                <span class="font-medium">0</span> users selected
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1.5 rounded text-sm font-medium" disabled>
                                    <i class="fas fa-envelope mr-1"></i> Email Selected
                                </button>
                                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1.5 rounded text-sm font-medium" disabled>
                                    <i class="fas fa-user-check mr-1"></i> Verify Selected
                                </button>
                                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1.5 rounded text-sm font-medium" disabled>
                                    <i class="fas fa-ban mr-1"></i> Suspend Selected
                                </button>
                                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1.5 rounded text-sm font-medium" disabled>
                                    <i class="fas fa-trash-alt mr-1"></i> Delete Selected
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- User Details Modal (Hidden by default) -->
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="userDetailModal">
                    <div class="bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
                            <h3 class="text-lg font-medium text-gray-900">User Details</h3>
                            <button type="button" class="text-gray-400 hover:text-gray-500" id="closeUserDetailModal">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <div class="p-6">
                            <!-- User profile content would be dynamically loaded here -->
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="md:w-1/3">
                                    <div class="text-center">
                                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="User Profile" class="h-32 w-32 rounded-full mx-auto border-4 border-gray-200">
                                        <h4 class="mt-2 text-xl font-bold">Emma Johnson</h4>
                                        <p class="text-gray-500">London, UK</p>
                                    </div>
                                    <div class="mt-6 space-y-4">
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Status:</span>
                                            <span class="font-medium text-green-600">Active</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Joined:</span>
                                            <span>January 10, 2025</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Last Active:</span>
                                            <span>April 15, 2025</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Email:</span>
                                            <span>emma.johnson@example.com</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:w-2/3">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <h5 class="font-semibold text-gray-800 mb-2">Events</h5>
                                            <div class="flex justify-between">
                                                <span>Hosted:</span>
                                                <span>8</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Attended:</span>
                                                <span>12</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Upcoming:</span>
                                                <span>3</span>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <h5 class="font-semibold text-gray-800 mb-2">Community</h5>
                                            <div class="flex justify-between">
                                                <span>Rating:</span>
                                                <div class="flex items-center">
                                                    <span>4.9</span>
                                                    <i class="fas fa-star text-amber-400 ml-1 text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Reviews:</span>
                                                <span>28 received</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Friends:</span>
                                                <span>34</span>
                                            </div>
                                        </div>
                                        
                                        <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                                            <h5 class="font-semibold text-gray-800 mb-2">Recent Activity</h5>
                                            <div class="space-y-2">
                                                <div class="text-sm">
                                                    <span class="text-gray-600">April 15, 2025:</span> Joined the "Coffee & Cultural Exchange" event
                                                </div>
                                                <div class="text-sm">
                                                    <span class="text-gray-600">April 12, 2025:</span> Created a new event: "London Photography Walk"
                                                </div>
                                                <div class="text-sm">
                                                    <span class="text-gray-600">April 10, 2025:</span> Left a review for David Wilson (5 stars)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 space-y-4">
                                        <h5 class="font-semibold text-gray-800">Admin Actions</h5>
                                        <div class="flex flex-wrap gap-2">
                                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-sm font-medium">
                                                <i class="fas fa-edit mr-1"></i> Edit User
                                            </button>
                                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-sm font-medium">
                                                <i class="fas fa-envelope mr-1"></i> Send Message
                                            </button>
                                            <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1.5 rounded text-sm font-medium">
                                                <i class="fas fa-flag mr-1"></i> View Reports
                                            </button>
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-sm font-medium">
                                                <i class="fas fa-ban mr-1"></i> Suspend User
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        // Handle checkbox selection for bulk actions
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const bulkActionButtons = document.querySelectorAll('.bulk-action-btn');
            const selectedCountSpan = document.querySelector('.selected-count');
            
            let selectedCount = 0;
            
            // Check/uncheck all functionality
            const headerCheckbox = document.querySelector('thead input[type="checkbox"]');
            const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            
            if (headerCheckbox) {
                headerCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                    
                    selectedCount = isChecked ? rowCheckboxes.length : 0;
                    updateSelectedCount();
                    updateBulkActionButtons();
                });
            }
            
            // Individual checkbox functionality
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Update header checkbox
                    if (!this.checked) {
                        if (headerCheckbox) {
                            headerCheckbox.checked = false;
                        }
                    } else {
                        // Check if all row checkboxes are checked
                        const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                        if (headerCheckbox) {
                            headerCheckbox.checked = allChecked;
                        }
                    }
                    
                    // Count selected
                    selectedCount = Array.from(rowCheckboxes).filter(cb => cb.checked).length;
                    updateSelectedCount();
                    updateBulkActionButtons();
                });
            });
            
            function updateSelectedCount() {
                if (selectedCountSpan) {
                    selectedCountSpan.textContent = selectedCount;
                }
            }
            
            function updateBulkActionButtons() {
                bulkActionButtons.forEach(button => {
                    if (selectedCount > 0) {
                        button.disabled = false;
                        button.classList.remove('bg-gray-200', 'text-gray-700');
                        button.classList.add('bg-primary', 'text-white');
                    } else {
                        button.disabled = true;
                        button.classList.remove('bg-primary', 'text-white');
                        button.classList.add('bg-gray-200', 'text-gray-700');
                    }
                });
            }
            
            // User detail modal functionality
            const viewButtons = document.querySelectorAll('a[title="View Profile"]');
            const userDetailModal = document.getElementById('userDetailModal');
            const closeUserDetailModalBtn = document.getElementById('closeUserDetailModal');
            
            if (viewButtons.length > 0 && userDetailModal) {
                viewButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        userDetailModal.classList.remove('hidden');
                        
                        // In a real application, you'd make an AJAX request to load user details
                        // For this example, we're showing hardcoded content
                    });
                });
                
                if (closeUserDetailModalBtn) {
                    closeUserDetailModalBtn.addEventListener('click', function() {
                        userDetailModal.classList.add('hidden');
                    });
                }
                
                // Close modal when clicking outside
                userDetailModal.addEventListener('click', function(e) {
                    if (e.target === userDetailModal) {
                        userDetailModal.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>