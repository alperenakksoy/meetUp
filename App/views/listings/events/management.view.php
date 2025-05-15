<?php
// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>

<!-- Main Content -->
<div class="container mx-auto px-4 py-6 max-w-7xl mt-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Event Management</h1>
        <a href="create_event.php" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition duration-200">
            <i class="fas fa-plus mr-2"></i> Create New Event
        </a>
    </div>

    <!-- Dashboard Layout -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Main Content -->
        <div class="lg:w-3/4 space-y-6">
            <!-- Events Management Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-200">
                    <div class="px-4 py-3 bg-orange-500 text-white font-medium cursor-pointer">Upcoming Events</div>
                    <div class="px-4 py-3 text-gray-600 hover:bg-gray-100 font-medium cursor-pointer">Past Events</div>
                </div>

                <!-- Tab Content: Upcoming Events -->
                <div class="p-4">
                    <div class="relative mb-4">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Search your events...">
                    </div>

                    <div class="space-y-4">
                        <!-- Event 1 -->
                        <div class="flex flex-col md:flex-row border border-gray-200 rounded-lg hover:border-orange-500 transition duration-200">
                            <img src="/api/placeholder/100/100" alt="Event Image" class="w-full md:w-32 h-32 object-cover rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
                            <div class="flex-1 p-4">
                                <div class="font-bold text-lg mb-2">Coffee & Cultural Exchange</div>
                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center"><i class="far fa-calendar mr-2"></i> Apr 5, 2025</span>
                                    <span class="flex items-center"><i class="far fa-clock mr-2"></i> 15:00 - 17:00</span>
                                    <span class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Kadıköy, Istanbul</span>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center"><i class="fas fa-users mr-2"></i> 7/12 Attendees</span>
                                    <span class="flex items-center"><i class="fas fa-user-plus mr-2"></i> 3 Pending Requests</span>
                                    <span class="flex items-center"><i class="fas fa-eye mr-2"></i> 156 Views</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap md:flex-col justify-end gap-2 p-4 border-t md:border-t-0 md:border-l border-gray-200">
                                <button onclick="openAttendeeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-user-check mr-1"></i> Requests
                                </button>
                                <a href="event_details.php?id=1" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <a href="edit_event.php?id=1" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Event 2 -->
                        <div class="flex flex-col md:flex-row border border-gray-200 rounded-lg hover:border-orange-500 transition duration-200">
                            <img src="CreateEventForm/event_image.webp" alt="Event Image" class="w-full md:w-32 h-32 object-cover rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
                            <div class="flex-1 p-4">
                                <div class="font-bold text-lg mb-2">Hiking Belgrad Forest</div>
                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center"><i class="far fa-calendar mr-2"></i> Apr 8, 2025</span>
                                    <span class="flex items-center"><i class="far fa-clock mr-2"></i> 09:00 - 14:00</span>
                                    <span class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Belgrad Forest, Istanbul</span>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center"><i class="fas fa-users mr-2"></i> 8/15 Attendees</span>
                                    <span class="flex items-center"><i class="fas fa-user-plus mr-2"></i> 2 Pending Requests</span>
                                    <span class="flex items-center"><i class="fas fa-eye mr-2"></i> 124 Views</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap md:flex-col justify-end gap-2 p-4 border-t md:border-t-0 md:border-l border-gray-200">
                                <button onclick="openAttendeeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-user-check mr-1"></i> Requests
                                </button>
                                <a href="event_details.php?id=2" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <a href="edit_event.php?id=2" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Event 3 -->
                        <div class="flex flex-col md:flex-row border border-gray-200 rounded-lg hover:border-orange-500 transition duration-200">
                            <img src="/api/placeholder/100/100" alt="Event Image" class="w-full md:w-32 h-32 object-cover rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
                            <div class="flex-1 p-4">
                                <div class="font-bold text-lg mb-2">Historical Istanbul Tour</div>
                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center"><i class="far fa-calendar mr-2"></i> Apr 10, 2025</span>
                                    <span class="flex items-center"><i class="far fa-clock mr-2"></i> 10:00 - 15:00</span>
                                    <span class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Sultanahmet, Istanbul</span>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                    <span class="flex items-center"><i class="fas fa-users mr-2"></i> 12/20 Attendees</span>
                                    <span class="flex items-center"><i class="fas fa-user-plus mr-2"></i> 5 Pending Requests</span>
                                    <span class="flex items-center"><i class="fas fa-eye mr-2"></i> 198 Views</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap md:flex-col justify-end gap-2 p-4 border-t md:border-t-0 md:border-l border-gray-200">
                                <button onclick="openAttendeeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-user-check mr-1"></i> Requests
                                </button>
                                <a href="event_details.php?id=3" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <a href="edit_event.php?id=3" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendees Management -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex flex-col md:flex-row md:items-center justify-between p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 md:mb-0">Attendee Management</h2>
                    <select class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option>Coffee & Cultural Exchange</option>
                        <option>Hiking Belgrad Forest</option>
                        <option>Historical Istanbul Tour</option>
                    </select>
                </div>
                <div class="p-4 space-y-4">
                    <!-- Attendee 1 -->
                    <div class="flex flex-col md:flex-row items-center gap-4 p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Attendee" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="font-medium">Emma Johnson</div>
                            <div class="text-sm text-gray-500">Joined Apr 1, 2025 • First-time attendee</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="profile.php?id=101" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-user mr-1"></i> Profile
                            </a>
                            <a href="#" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-envelope mr-1"></i> Message
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-user-times mr-1"></i> Remove
                            </a>
                        </div>
                    </div>

                    <!-- Attendee 2 -->
                    <div class="flex flex-col md:flex-row items-center gap-4 p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Attendee" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="font-medium">David Wilson</div>
                            <div class="text-sm text-gray-500">Joined Mar 30, 2025 • Attended 3 of your events</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="profile.php?id=102" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-user mr-1"></i> Profile
                            </a>
                            <a href="#" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-envelope mr-1"></i> Message
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-user-times mr-1"></i> Remove
                            </a>
                        </div>
                    </div>

                    <!-- More attendees... -->
                    <div class="flex flex-col md:flex-row items-center gap-4 p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Attendee" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="font-medium">Olivia Martinez</div>
                            <div class="text-sm text-gray-500">Joined Apr 2, 2025 • Attended 1 of your events</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="profile.php?id=103" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-user mr-1"></i> Profile
                            </a>
                            <a href="#" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-envelope mr-1"></i> Message
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-user-times mr-1"></i> Remove
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Analytics -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex flex-col md:flex-row md:items-center justify-between p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 md:mb-0">Event Analytics</h2>
                    <select class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option>Coffee & Cultural Exchange</option>
                        <option>Hiking Belgrad Forest</option>
                        <option>Historical Istanbul Tour</option>
                    </select>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-orange-500">156</div>
                            <div class="text-sm text-gray-600">Page Views</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-orange-500">32</div>
                            <div class="text-sm text-gray-600">Interested Clicks</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-orange-500">7</div>
                            <div class="text-sm text-gray-600">Confirmed Attendees</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-orange-500">3</div>
                            <div class="text-sm text-gray-600">Pending Requests</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-8 rounded-lg text-center cursor-pointer hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-chart-line fa-3x text-orange-500 mb-2"></i>
                            <p class="text-gray-600">View Traffic Chart</p>
                        </div>
                        <div class="bg-gray-50 p-8 rounded-lg text-center cursor-pointer hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-chart-pie fa-3x text-orange-500 mb-2"></i>
                            <p class="text-gray-600">Attendee Demographics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/4 space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Quick Stats</h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500">24</div>
                            <div class="text-xs text-gray-600">Total Events</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500">356</div>
                            <div class="text-xs text-gray-600">Total Attendees</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500">4.7</div>
                            <div class="text-xs text-gray-600">Average Rating</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500">3</div>
                            <div class="text-xs text-gray-600">Upcoming Events</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
                </div>
                <div class="p-4 space-y-4">
                    <div class="border-b border-gray-100 pb-3">
                        <div class="text-sm"><strong>Emma Johnson</strong> joined your "Coffee & Cultural Exchange" event.</div>
                        <div class="text-xs text-gray-500 mt-1">30 minutes ago</div>
                    </div>
                    <div class="border-b border-gray-100 pb-3">
                        <div class="text-sm"><strong>David Wilson</strong> requested to join your "Hiking Belgrad Forest" event.</div>
                        <div class="text-xs text-gray-500 mt-1">1 hour ago</div>
                    </div>
                    <div class="border-b border-gray-100 pb-3">
                        <div class="text-sm"><strong>Sophie Chen</strong> left a comment on your "Historical Istanbul Tour" event.</div>
                        <div class="text-xs text-gray-500 mt-1">2 hours ago</div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Your Upcoming Events</h2>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-500 text-white text-center rounded-lg p-2 min-w-12">
                            <div class="text-xs font-bold uppercase">APR</div>
                            <div class="text-lg font-bold">5</div>
                        </div>
                        <div>
                            <div class="font-medium">Coffee & Cultural Exchange</div>
                            <div class="text-xs text-gray-500">15:00 • Kadıköy, Istanbul</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-500 text-white text-center rounded-lg p-2 min-w-12">
                            <div class="text-xs font-bold uppercase">APR</div>
                            <div class="text-lg font-bold">8</div>
                        </div>
                        <div>
                            <div class="font-medium">Hiking Belgrad Forest</div>
                            <div class="text-xs text-gray-500">09:00 • Belgrad Forest, Istanbul</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-500 text-white text-center rounded-lg p-2 min-w-12">
                            <div class="text-xs font-bold uppercase">APR</div>
                            <div class="text-lg font-bold">10</div>
                        </div>
                        <div>
                            <div class="font-medium">Historical Istanbul Tour</div>
                            <div class="text-xs text-gray-500">10:00 • Sultanahmet, Istanbul</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Quick Links</h2>
                </div>
                <div class="p-4 space-y-3">
                    <a href="create_event.php" class="block bg-orange-500 hover:bg-orange-600 text-white text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-plus mr-2"></i> Create Event
                    </a>
                    <a href="messages.php" class="block bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-envelope mr-2"></i> Messages
                    </a>
                    <a href="notifications.php" class="block bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-bell mr-2"></i> Notifications
                    </a>
                    <a href="help.php" class="block bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-question-circle mr-2"></i> Help & Resources
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendee Request Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="attendeeRequestModal">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">Pending Join Requests (3)</h3>
            <button onclick="closeAttendeeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <div class="p-4 space-y-4">
            <!-- Request 1 -->
            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg">
                <img src="https://randomuser.me/api/portraits/men/82.jpg" alt="Requestor" class="w-12 h-12 rounded-full">
                <div class="flex-1">
                    <div class="font-medium">Alex Thompson</div>
                    <div class="text-sm text-gray-500">Requested Apr 2, 2025 • First-time attendee</div>
                    <div class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-comment mr-1"></i> "I'm excited to join this cultural exchange! I've been in Istanbul for just a month."
                    </div>
                </div>
            </div>

            <!-- Request 2 -->
            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg">
                <img src="https://randomuser.me/api/portraits/women/76.jpg" alt="Requestor" class="w-12 h-12 rounded-full">
                <div class="flex-1">
                    <div class="font-medium">Sophia Klein</div>
                    <div class="text-sm text-gray-500">Requested Apr 1, 2025 • Attended 1 of your events</div>
                    <div class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-comment mr-1"></i> "Really enjoyed your last event, would love to join this one too!"
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-3 p-4 border-t border-gray-200">
            <button onclick="closeAttendeeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium">
                Close
            </button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Approve All
            </button>
        </div>
    </div>
</div>

    <script>
        // Tab Navigation
        document.addEventListener('DOMContentLoaded', function() {
            const tabItems = document.querySelectorAll('.tab-item');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabItems.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabItems.forEach(item => {
                        item.classList.remove('active');
                    });
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Show corresponding tab content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(`${tabId}-content`).classList.add('active');
                });
            });
        });
        // Attendee request modal
        function openAttendeeModal() {
            document.getElementById('attendeeRequestModal').classList.remove('hidden');
        }

        function closeAttendeeModal() {
            document.getElementById('attendeeRequestModal').classList.add('hidden');
        }   
        
        // Close modal when clicking the X
        document.querySelector('.modal-close').addEventListener('click', closeAttendeeModal);
        
        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('attendeeRequestModal');
            if (event.target === modal) {
                closeAttendeeModal();
            }
        });

        // Event selector change handler
        document.getElementById('event-selector').addEventListener('change', function() {
            // In a real application, this would fetch and update the attendee list
            console.log('Selected event ID:', this.value);
        });

        // Analytics selector change handler
        document.getElementById('event-analytics-selector').addEventListener('change', function() {
            // In a real application, this would fetch and update the analytics data
            console.log('Selected event for analytics:', this.value);
        });

        // Search functionality for events
        document.querySelectorAll('.search-input').forEach(input => {
            input.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                const tabContent = this.closest('.tab-content');
                const eventItems = tabContent.querySelectorAll('.event-item');
                
                eventItems.forEach(item => {
                    const title = item.querySelector('.event-title').textContent.toLowerCase();
                    const meta = item.querySelector('.event-meta').textContent.toLowerCase();
                    
                    if (title.includes(query) || meta.includes(query)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
      <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>
