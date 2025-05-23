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
                    <h1 class="text-xl font-bold font-volkhov text-gray-800 mb-1"><?="{$user->first_name} {$user->last_name}"?></h1>
                    <div class="flex items-center justify-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                        <span><?= $user->city .', '.$user->country ?></span>
                    </div>
                    <div class="flex justify-between mb-4">
                   
                   <a href="/events/past">  <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                            <div class="text-xl font-bold text-orange-500"><?=count($pastEvents)?></div>
                            <div class="text-xs text-gray-500">Events</div>
                        </div></a>
                        
                    <a href="/users/friends"> <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                            <div class="text-xl font-bold text-orange-500"><?=$friendsCount?></div>
                            <div class="text-xs text-gray-500">Friends</div>
                        </div></a>
                    <a href="/users/references"> <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                            <div class="text-xl font-bold text-orange-500"><?=count($reviews)?></div>
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
                            <span><?=calcAge($user->date_of_birth)?> years old</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-briefcase text-orange-500 w-5 mr-2"></i>
                            <span>Software Engineer</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clock text-orange-500 w-5 mr-2"></i>
                            <span>Member since <?=reDate($user->created_at)?></span>
                        </div>
                        <?php if($user->gender =='Female' || $user->gender =='Male'):?>
                        <div class="flex items-center text-sm text-gray-600 mb-2 mt-2 ml-0.5">
                            <i class="fas fa-<?=strtolower($user->gender)?> text-orange-500 w-5 mr-2"></i>
                            <span>Gender: <?=ucfirst($user->gender)?></span>
                        </div>
                        <?php endif;?>
            
                    
                    </div>

                    <div class="mb-4">
                        <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mb-3 font-volkhov">About Me</h3>
                        <p class="text-sm text-gray-600"><?=$user->bio?></p>
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
        <h2 class="text-lg font-semibold text-gray-800 font-volkhov">
            <i class="fas fa-calendar-alt text-orange-500 mr-2"></i> My Upcoming Events
        </h2>
        <a href="events.php" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
        <?php if (empty($upevents)): ?>
            <div class="col-span-full flex items-center text-sm text-gray-600">
                <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                <span>No Upcoming Events</span>
            </div>
        <?php else: ?>
            <?php foreach($upevents as $upevent): ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                    <img src="/api/placeholder/400/150" alt="Event Image" class="w-full h-36 object-cover">
                    <div class="p-3">
                        <h3 class="font-semibold text-gray-800 mb-2"><?=$upevent->title?></h3>
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                            <span><?=reDate($upevent->event_date)?>, • <?=reTime($upevent->start_time)?></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 w-4 mr-2"></i>
                            <span><?=$upevent->location_name?>, <?=$upevent->city?></span>
                        </div>
                        <div class="flex items-center">
                            
                            <span class="text-xs text-gray-500 ml-2">+4 going</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="flex justify-between items-center p-4 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800 font-volkhov">
            <i class="fas fa-calendar-alt text-orange-500 mr-2"></i> My Past Events
        </h2>
        <a href="events.php" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
        <?php if (empty($pastEvents)): ?>
            <div class="col-span-full flex items-center text-sm text-gray-600">
                <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                <span>No Upcoming Events</span>
            </div>
        <?php else: ?>
            <?php foreach($pastEvents as $pastEvent): ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                    <img src="/api/placeholder/400/150" alt="Event Image" class="w-full h-36 object-cover">
                    <div class="p-3">
                        <h3 class="font-semibold text-gray-800 mb-2"><?=$pastEvent->title?></h3>
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                            <span><?=reDate($pastEvent->event_date)?>, • <?=reTime($pastEvent->start_time)?></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 w-4 mr-2"></i>
                            <span><?=$pastEvent->location_name?>, <?=$pastEvent->city?></span>
                        </div>
                        <div class="flex items-center">
                          
                            <span class="text-xs text-gray-500 ml-2"></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

                <!-- Friends Section -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="flex justify-between items-center p-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-800 font-volkhov"><i class="fas fa-users text-orange-500 mr-2"></i> Friends (<?=$friendsCount?>)</h2>
                        <a href="friends.php" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
                    </div>
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-4 p-4">
    <?php 
    // $friendsCount 6'dan büyükse, gösterilecek arkadaş sayısını 6 ile sınırla
    $displayCount = ($friendsCount > 6) ? 6 : $friendsCount;
    
    // Belirlenen sayıya kadar arkadaşları göster
    for($i = 0; $i < $displayCount; $i++): 
    ?>
        <div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
            <img src="https://randomuser.me/api/portraits/women/<?= (63 + $i) % 99 ?>.jpg" alt="Friend" class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1">
            <div class="text-xs text-gray-800 truncate">Friend <?= $i+1 ?></div>
        </div>
    <?php endfor; ?>
    
    <?php if($friendsCount == 0): ?>
        <div class="col-span-full text-center py-4 text-gray-500">
            <p>You don't have any friends yet.</p>
            <a href="/users/find-friends" class="text-orange-500 hover:underline mt-2 inline-block">Find Friends</a>
        </div>
    <?php endif; ?>
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