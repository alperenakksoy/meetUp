<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
loadPartial('head') ?>

<body class="bg-gray-50 pt-20">
    <!-- Header Navigation -->
    <?php loadPartial('navbar') ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Left Sidebar - Profile Information -->
            <div class="lg:col-span-1 bg-white rounded-lg shadow-sm p-6 lg:sticky lg:top-24 self-start">
                <div class="text-center pb-6 border-b border-gray-100">
                    <div class="mx-auto mb-4">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="w-36 h-36 rounded-full border-4 border-gray-100 mx-auto">
                    </div>
                    <h1 class="text-xl font-bold font-volkhov text-gray-800 mb-1">Ahmet Alperen Aksoy</h1>
                    <div class="flex items-center justify-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                        <span>Istanbul, Turkey</span>
                    </div>
                    <div class="flex justify-between mb-4">
                   
                   <a href="/events/past">  <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                            <div class="text-xl font-bold text-orange-500">24</div>
                            <div class="text-xs text-gray-500">Events</div>
                        </div></a>
                        
                    <a href="/users/friends"> <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                            <div class="text-xl font-bold text-orange-500">156</div>
                            <div class="text-xs text-gray-500">Friends</div>
                        </div></a>
                        
                    <a href="/users/references/{id}"> <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                            <div class="text-xl font-bold text-orange-500">42</div>
                            <div class="text-xs text-gray-500">References</div>
                        </div></a>
                    </div>
                    <a href="/../App/profileNavs/edit_profile.php" class="block w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-md text-center transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit Profile
                    </a>
                </div>

                <!-- User Details -->
                <div class="mt-6">
                    <div class="mb-4">
                        <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mb-3 font-volkhov">Personal Information</h3>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-user text-orange-500 w-5 mr-2"></i>
                            <span>27 years old</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-briefcase text-orange-500 w-5 mr-2"></i>
                            <span>Software Engineer</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clock text-orange-500 w-5 mr-2"></i>
                            <span>Member since January 2023</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mb-3 font-volkhov">About Me</h3>
                        <p class="text-sm text-gray-600">Software engineering graduate passionate about travel, technology, and bringing people together. Created SocialLoop as my B.Sc. thesis project to help travelers connect with locals through shared experiences.</p>
                    </div>

                    <div>
                        <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mb-3 font-volkhov">Interests</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">Travel</span>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">Photography</span>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">Hiking</span>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">Coffee</span>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">Technology</span>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">Languages</span>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">Culture</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Events Section -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="flex justify-between items-center p-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-800 font-volkhov"><i class="fas fa-calendar-alt text-orange-500 mr-2"></i> My Events</h2>
                        <a href="events.php" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
                        <!-- Event 1 -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                            <img src="/api/placeholder/400/150" alt="Event Image" class="w-full h-36 object-cover">
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-800 mb-2">Coffee & Cultural Exchange</h3>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                                    <span>April 5, 2025 • 15:00</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-map-marker-alt text-orange-500 w-4 mr-2"></i>
                                    <span>Kadıköy, Istanbul</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">+4 going</span>
                                </div>
                            </div>
                        </div>

                        <!-- Event 2 -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                            <img src="/api/placeholder/400/150" alt="Event Image" class="w-full h-36 object-cover">
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-800 mb-2">Hiking Belgrad Forest</h3>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                                    <span>April 8, 2025 • 09:00</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-map-marker-alt text-orange-500 w-4 mr-2"></i>
                                    <span>Belgrad Forest, Istanbul</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">+6 going</span>
                                </div>
                            </div>
                        </div>

                        <!-- Event 3 -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                            <img src="/api/placeholder/400/150" alt="Event Image" class="w-full h-36 object-cover">
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-800 mb-2">Historical Istanbul Tour</h3>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                                    <span>April 10, 2025 • 10:00</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-map-marker-alt text-orange-500 w-4 mr-2"></i>
                                    <span>Sultanahmet, Istanbul</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Participant" class="w-7 h-7 rounded-full border-2 border-white">
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">+8 going</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Friends Section -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="flex justify-between items-center p-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-800 font-volkhov"><i class="fas fa-users text-orange-500 mr-2"></i> Friends</h2>
                        <a href="friends.php" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
                    </div>
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-4 p-4">
                        <!-- Friend 1 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">Emma</div>
                        </div>
                        <!-- Friend 2 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">David</div>
                        </div>
                        <!-- Friend 3 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">Sophie</div>
                        </div>
                        <!-- Friend 4 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">Michael</div>
                        </div>
                        <!-- Friend 5 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">Olivia</div>
                        </div>
                        <!-- Friend 6 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">James</div>
                        </div>
                        <!-- Friend 7 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">Isabella</div>
                        </div>
                        <!-- Friend 8 -->
                        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                            <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
                            <div class="text-xs text-gray-800 truncate">Alexander</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=loadPartial(name: 'footer'); ?>
<script>
        // Add click events to cards for navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Make event cards clickable to navigate to event details
            const eventCards = document.querySelectorAll('.bg-white.rounded-lg.shadow-sm');
            eventCards.forEach(card => {
                card.addEventListener('click', function() {
                    const eventTitle = this.querySelector('h3').textContent;
                    // In a real app, this would use an event ID instead of title
                    window.location.href = `event_details.php?title=${encodeURIComponent(eventTitle)}`;
                });
            });
            
            // Make friend items clickable to navigate to friend profiles
            const friendItems = document.querySelectorAll('.text-center.cursor-pointer');
            friendItems.forEach(item => {
                item.addEventListener('click', function() {
                    const friendName = this.querySelector('div').textContent;
                    // In a real app, this would use a user ID instead of name
                    window.location.href = `profile.php?name=${encodeURIComponent(friendName)}`;
                });
            });
            
            // Make message items clickable to open conversation
            const messageItems = document.querySelectorAll('.flex.p-4');
            messageItems.forEach(item => {
                item.addEventListener('click', function() {
                    const senderName = this.querySelector('.font-semibold').textContent;
                    // In a real app, this would use a conversation ID
                    window.location.href = `messages.php?conversation=${encodeURIComponent(senderName)}`;
                });
            });
        });
    </script>
</body>
</html>