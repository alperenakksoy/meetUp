<?php
require_once __DIR__ . '/../../helpers.php';


// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'home';
$isLoggedIn = true;
?>
<?=loadPartial(name: 'scripts'); ?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('header') ?>

<!-- Main Content -->
<div class="container mx-auto px-4 mt-20">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Left Sidebar - User Profile -->
        <div class="md:col-span-3 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-32 bg-gradient-to-r from-orange-500 to-purple-600"></div>
            <div class="px-6 py-4">
                <div class="flex justify-center -mt-16">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-white shadow-md">
                </div>
                <h2 class="text-xl font-bold text-center mt-2">Ahmet Alperen Aksoy</h2>
                <div class="flex items-center justify-center text-gray-600 mt-1">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Istanbul, Turkey
                </div>
                <div class="flex justify-between mt-6">
                    <div class="text-center">
                        <div class="font-bold text-gray-800">24</div>
                        <div class="text-sm text-gray-500">Events</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-gray-800">156</div>
                        <div class="text-sm text-gray-500">Friends</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-gray-800">4.8</div>
                        <div class="text-sm text-gray-500">Rating</div>
                    </div>
                </div>
                <a href="create_event.php" class="block mt-6 bg-orange-600 hover:bg-orange-700 text-white text-center py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i> Create New Event
                </a>
            </div>
            <div class="border-t border-gray-200 px-6 py-4">
                <a href="userHome/profile.php" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-user mr-3"></i> View My Profile
                </a>
                <a href="saved_events.php" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-bookmark mr-3"></i> Saved Events
                </a>
                <a href="past_events.php" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-history mr-3"></i> Past Events
                </a>
                <a href="notifications.php" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-bell mr-3"></i> Notifications
                    <span class="ml-auto bg-yellow-500 text-white px-2 py-0.5 rounded-full text-xs">3</span>
                </a>
                <a href="settings.php" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-cog mr-3"></i> Account Settings
                </a>
            </div>
        </div>

        <!-- Middle Column - Feed -->
        <div class="md:col-span-6 space-y-6">
            <!-- Welcome Bar -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="text-gray-700 mb-2 md:mb-0">
                        Welcome back, <strong class="font-semibold">Ahmet</strong>! What's your plan for today?
                    </div>
                    <div class="flex space-x-2">
                        <div class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-3 rounded-lg cursor-pointer transition duration-200">
                            <i class="fas fa-search mr-1"></i> Find Events
                        </div>
                        <div class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-3 rounded-lg cursor-pointer transition duration-200">
                            <i class="fas fa-user-plus mr-1"></i> Find Friends
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Your Upcoming Events</h2>
                    <a href="events.php" class="text-orange-600 hover:text-orange-800 text-sm">View All</a>
                </div>
                
                <div class="event-card">
                    <div class="relative">
                        <img src="/api/placeholder/600/200" alt="Event Image" class="w-full h-48 object-cover">
                        <div class="absolute top-3 left-3 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-sm">
                            Apr 5, 2025 • 15:00
                        </div>
                        <div class="absolute top-3 right-3 bg-green-600 text-white px-3 py-1 rounded-full text-sm">
                            Coffee & Cultural
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Coffee & Cultural Exchange</h3>
                        <div class="space-y-2 mb-3">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Mandabatmaz Coffee, Kadıköy, Istanbul</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-user mr-2"></i>
                                <span>Hosted by You</span>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4">
                            Join us for an afternoon of coffee and conversation! Share your travel stories, learn about Turkish culture, and make new friends in a cozy atmosphere.
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                </div>
                                <span class="ml-2 text-sm text-gray-500">+3 going</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="event_management.php?id=1" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-3 rounded-lg transition duration-200">
                                    <i class="fas fa-cog mr-1"></i> Manage
                                </a>
                                <a href="event_details.php?id=1" class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-3 rounded-lg transition duration-200">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Events -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Recommended For You</h2>
                    <a href="events.php?filter=recommended" class="text-orange-600 hover:text-orange-800 text-sm">View All</a>
                </div>
                
                <div class="event-card">
                    <div class="relative">
                        <img src="/api/placeholder/600/200" alt="Event Image" class="w-full h-48 object-cover">
                        <div class="absolute top-3 left-3 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-sm">
                            Apr 8, 2025 • 19:00
                        </div>
                        <div class="absolute top-3 right-3 bg-green-600 text-white px-3 py-1 rounded-full text-sm">
                            Language Exchange
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">International Language Meetup</h3>
                        <div class="space-y-2 mb-3">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Multilingual Café, Şişli, Istanbul</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-user mr-2"></i>
                                <span>Hosted by Sophia Klein</span>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4">
                            Practice languages while meeting new people! English, Turkish, Spanish, French, and more. All levels welcome. Structured activities and free conversation time.
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="https://randomuser.me/api/portraits/women/76.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="https://randomuser.me/api/portraits/men/91.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Attendee" class="w-8 h-8 rounded-full border-2 border-white">
                                </div>
                                <span class="ml-2 text-sm text-gray-500">+12 going</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-3 rounded-lg transition duration-200">
                                    <i class="far fa-bookmark mr-1"></i> Save
                                </a>
                                <a href="event_details.php?id=2" class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-3 rounded-lg transition duration-200">
                                    <i class="fas fa-check-circle mr-1"></i> Join
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Friend Activity -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Friend Activity</h2>
                </div>
                
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-start">
                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="User" class="w-10 h-10 rounded-full mr-3">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div class="font-semibold">Emma Johnson</div>
                                <div class="text-gray-500 text-sm ml-2">2 hours ago</div>
                            </div>
                            <div class="mt-1 mb-3">
                                Just signed up for the "Photography Walk in Balat" event. Anyone else going? The historic district has amazing photo opportunities! 📸
                            </div>
                            <img src="/api/placeholder/600/300" alt="Activity Image" class="w-full rounded-lg mb-3">
                            <div class="flex justify-between items-center text-gray-500">
                                <div class="flex space-x-4">
                                    <div class="flex items-center cursor-pointer hover:text-red-500">
                                        <i class="far fa-heart mr-1"></i>
                                        <span>12</span>
                                    </div>
                                    <div class="flex items-center cursor-pointer hover:text-orange-500">
                                        <i class="far fa-comment mr-1"></i>
                                        <span>4</span>
                                    </div>
                                    <div class="flex items-center cursor-pointer hover:text-green-500">
                                        <i class="far fa-share-square mr-1"></i>
                                        <span>Share</span>
                                    </div>
                                </div>
                                <a href="event_details.php?id=3" class="flex items-center text-orange-600 hover:text-orange-800">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    <span>View Event</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex items-start">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="User" class="w-10 h-10 rounded-full mr-3">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div class="font-semibold">David Wilson</div>
                                <div class="text-gray-500 text-sm ml-2">Yesterday</div>
                            </div>
                            <div class="mt-1 mb-3">
                                Had an amazing time at the "Bosphorus Sunset Cruise" yesterday! The views were incredible and I met some fantastic people. Thanks to @Ahmet for organizing!
                            </div>
                            <div class="flex justify-between items-center text-gray-500">
                                <div class="flex space-x-4">
                                    <div class="flex items-center cursor-pointer hover:text-red-500">
                                        <i class="far fa-heart mr-1"></i>
                                        <span>24</span>
                                    </div>
                                    <div class="flex items-center cursor-pointer hover:text-orange-500">
                                        <i class="far fa-comment mr-1"></i>
                                        <span>7</span>
                                    </div>
                                    <div class="flex items-center cursor-pointer hover:text-green-500">
                                        <i class="far fa-share-square mr-1"></i>
                                        <span>Share</span>
                                    </div>
                                </div>
                                <a href="event_reviews.php?id=1" class="flex items-center text-orange-600 hover:text-orange-800">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    <span>View Reviews</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="md:col-span-3 space-y-6">
            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-lg mb-3">You're Attending</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="bg-gray-100 text-center rounded-lg p-2 mr-3 min-w-12">
                            <div class="text-xs font-bold uppercase text-gray-500">APR</div>
                            <div class="text-lg font-bold">5</div>
                        </div>
                        <div>
                            <div class="font-medium">Coffee & Cultural Exchange</div>
                            <div class="text-sm text-gray-500">15:00 • Kadıköy, Istanbul</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-gray-100 text-center rounded-lg p-2 mr-3 min-w-12">
                            <div class="text-xs font-bold uppercase text-gray-500">APR</div>
                            <div class="text-lg font-bold">10</div>
                        </div>
                        <div>
                            <div class="font-medium">Historical Istanbul Tour</div>
                            <div class="text-sm text-gray-500">10:00 • Sultanahmet, Istanbul</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-gray-100 text-center rounded-lg p-2 mr-3 min-w-12">
                            <div class="text-xs font-bold uppercase text-gray-500">APR</div>
                            <div class="text-lg font-bold">15</div>
                        </div>
                        <div>
                            <div class="font-medium">Turkish Cooking Workshop</div>
                            <div class="text-sm text-gray-500">18:00 • Beşiktaş, Istanbul</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trending Topics -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-lg mb-3">Trending in Istanbul</h3>
                <div class="space-y-2">
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded">
                        <div class="font-medium">Coffee Tasting</div>
                        <div class="text-sm text-gray-500">24 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded">
                        <div class="font-medium">Boat Tours</div>
                        <div class="text-sm text-gray-500">18 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded">
                        <div class="font-medium">Photography</div>
                        <div class="text-sm text-gray-500">15 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded">
                        <div class="font-medium">Language Exchange</div>
                        <div class="text-sm text-gray-500">12 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded">
                        <div class="font-medium">Hiking</div>
                        <div class="text-sm text-gray-500">9 events</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        // User Dropdown Menu
        document.addEventListener('DOMContentLoaded', function() {
            const userMenu = document.getElementById('userMenu');
            const userDropdown = document.getElementById('userDropdown');
            
            userMenu.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent click from immediately bubbling to document
                userDropdown.classList.toggle('show');
            });
            
            // Close dropdown when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (userDropdown.classList.contains('show') && !userMenu.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
            });
        });

        // Like functionality for activity posts
        document.querySelectorAll('.activity-action .fa-heart').forEach(heart => {
            heart.addEventListener('click', function() {
                const likeCount = this.parentElement.querySelector('span');
                if (this.classList.contains('far')) { // Not liked yet
                    this.classList.remove('far');
                    this.classList.add('fas');
                    this.style.color = '#e74c3c';
                    likeCount.textContent = parseInt(likeCount.textContent) + 1;
                } else { // Already liked
                    this.classList.remove('fas');
                    this.classList.add('far');
                    this.style.color = '';
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                }
            });
        });

        // Friend request buttons
        document.querySelectorAll('.add-friend-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.textContent === '+ Add Friend') {
                    this.textContent = 'Request Sent';
                    this.style.backgroundColor = '#27ae60';
                } else {
                    this.textContent = '+ Add Friend';
                    this.style.backgroundColor = '#f5a623';
                }
            });
        });
        //ScrollDown Function
        document.addEventListener('DOMContentLoaded', () => {
        initHeaderScrollBehavior();  // Call only if this feature is needed
    });
    </script>      
    <?=loadPartial(name: 'footer'); ?>

</body>
</html>
