<?php

use Framework\Session;
// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'home';
$isLoggedIn = true;
?>
<?=loadPartial(name: 'scripts'); ?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>
<?php
// Add this helper function at the top of your PHP file
function getProfilePictureUrl($attendee) {
    // Check if profile_picture is empty or default
    if (empty($attendee->profile_picture) || $attendee->profile_picture === 'default_profile.jpg') {
        // Generate a nice placeholder with user's initials
        $name = ($attendee->first_name ?? 'U') . '+' . ($attendee->last_name ?? 'ser');
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&size=150&background=667eea&color=fff&rounded=true";
    }
    
    // Check if it's already a URL (starts with http:// or https://)
    if (strpos($attendee->profile_picture, 'http://') === 0 || strpos($attendee->profile_picture, 'https://') === 0) {
        return $attendee->profile_picture;
    }
    
    // It's a local file - construct the path
    return "/uploads/profiles/{$attendee->profile_picture}";
}
?>
<!-- Main Content -->
<div class="container mx-auto px-4 mt-20">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Left Sidebar - User Profile -->
        <div class="md:col-span-3 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-32 bg-gradient-to-r from-orange-500 to-purple-600"></div>
            <div class="px-6 py-4">
                <div class="flex justify-center -mt-16">
                    <img src="<?=$user->profile_picture?>" alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-white shadow-md">
                </div>
                <h2 class="text-xl font-bold text-center mt-2"><?= ucfirst($user->first_name).' '.ucfirst($user->last_name) ?></h2>
                <div class="flex items-center justify-center text-gray-600 mt-1">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <?= $user->city ?? null?>, <?= $user->country ?? null?>
                </div>
                <a href="/events/create" class="block mt-6 bg-orange-600 hover:bg-orange-700 text-white text-center py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i> Create New Event
                </a>
                <a href="/events/create" class="block mt-6 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i> Create New Hangout
                </a>
            </div>
            <div class="border-t border-gray-200 px-6 py-4">
                <a href="/users/profile/<?=$user->user_id?>" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-user mr-3"></i> View My Profile
                </a>
                <a href="/events/past" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
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
                        Welcome back, <strong class="font-semibold"><?=$user->first_name?></strong>! What's your plan for today?
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
    
    <?php
    $maxEventsToShow = 5;
    $count = 0;
    ?>

    <div class="divide-y divide-gray-200">
        <?php foreach($upEvents as $upEvent): ?>
            <?php
            if ($count >= $maxEventsToShow) {
                break;
            }
            $count++;
            ?>
            
            <div class="p-4 hover:bg-gray-50 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 group">
                <div class="relative mb-4">
                    <img src="<?=getEventImage($upEvent);?>" alt="<?=$upEvent->title?>" class="w-full h-48 object-cover rounded-lg group-hover:ring-2 group-hover:ring-orange-200 transition-all duration-200">
                    <div class="absolute top-3 left-3 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-sm">
                        <?= reDate($upEvent->event_date) ?? null ?> • <?= reTime($upEvent->start_time) ?? null ?>
                    </div>
                    <?php if (!empty($upEvent->category)): ?>
                        <div class="absolute top-3 right-3 <?= getCategoryColor($upEvent->category) ?> text-white px-3 py-1 rounded-full text-sm">
                            <i class="<?= getCategoryIcon($upEvent->category) ?> text-xs"></i>
                            <?= ucfirst($upEvent->category) ?? 'Event' ?>
                        </div>
                    <?php else: ?>
                        <div class="absolute top-3 right-3 bg-green-600 text-white px-3 py-1 rounded-full text-sm">
                            No Category
                        </div>
                    <?php endif; ?>
                </div>

                <h3 class="text-xl font-semibold mb-2 group-hover:text-orange-600 transition-colors duration-200"><?= ucfirst($upEvent->title) ?></h3>
                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span><?= ucfirst($upEvent->location_name) . ' ' . ($upEvent->location_details ?? '') . ", {$upEvent->city} / {$upEvent->country}" ?></span>
                    </div>
                    <a href="/users/profile/<?=$upEvent->user_id?>">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-user mr-2"></i>
                        <?php $isHost = $upEvent->host_id == $user->user_id;
                        $hostName = $isHost ? 'You' : "{$upEvent->first_name} {$upEvent->last_name}";                       
                        ?>
                        <span>Hosted by <?=$hostName?></span>
                    </div>
                     </a>
                </div>
                <p class="text-gray-700 mb-4"><?= $upEvent->description ?? null ?></p>
                
                <!-- Updated Attendees and Actions Section -->
                <div class="flex justify-between items-center">
                    <!-- Left side: Profile pics and count -->
                    <div class="flex items-center space-x-2">
                        <?php if (!empty($upEvent->attendees) && is_array($upEvent->attendees)): ?>
                            <div class="flex -space-x-2">
                                <?php foreach (array_slice($upEvent->attendees, 0, 5) as $attendee): ?>
                                    <?php $profileUrl = getProfilePictureUrl($attendee); ?>
                                    <img src="<?= htmlspecialchars($profileUrl) ?>" 
                                         alt="<?= htmlspecialchars($attendee->first_name ?? 'Attendee') ?>" 
                                         class="w-8 h-8 rounded-full border-2 border-white group-hover:ring-2 group-hover:ring-orange-200 object-cover"
                                         onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode(($attendee->first_name ?? 'U') . '+' . ($attendee->last_name ?? 'ser')) ?>&size=32&background=dc2626&color=fff&rounded=true';"
                                         loading="lazy">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php 
                        $indicator = '';
                        foreach($upEvent->attendees as $attendee):
                        if($upEvent->counts == 0):
                            $indicator = "No one has joined yet.";
                        elseif($upEvent->counts == 1 && $attendee->user_id == $user->user_id):
                            $indicator = "Only you going";
                        elseif($upEvent->counts == 1):
                            $indicator = "1 person going";
                        elseif($upEvent->counts > 1):
                            $indicator = "{$upEvent->counts} people going";
                        endif;
                    endforeach;

                        ?>
                        
                        <span class="text-sm text-gray-500"><?= $indicator ?></span>
                    </div>
                    
                    <!-- Right side: Action buttons -->
                    <div class="flex space-x-2">
                        <a href="event_management.php?id=<?= $upEvent->id ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-3 rounded-lg transition duration-200">
                            <i class="fas fa-cog mr-1"></i> Manage
                        </a>
                        <a href="/events/<?= $upEvent->event_id ?>" class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-3 rounded-lg transition duration-200">
                            <i class="fas fa-eye mr-1"></i> View
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if(count($upEvents) > $maxEventsToShow): ?>
        <div class="p-4 border-t border-gray-200">
            <a href="events.php" class="text-orange-600 hover:text-orange-800 text-sm font-medium">View All Events →</a>
        </div>
    <?php endif; ?>
</div>
<!-- Recommended Events -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="flex justify-between items-center p-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold">Recommended For You</h2>
        <a href="/events?filter=recommended" class="text-orange-600 hover:text-orange-800 text-sm">View All</a>
    </div>
    
    <?php if (!empty($recommendedEvents)): ?>
        <div class="space-y-4">
            <?php foreach($recommendedEvents as $recEvent): ?>
                <div class="p-4 hover:bg-gray-50 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 group">
                    <div class="relative mb-4">
                        <img src="<?= getEventImage($recEvent) ?>" alt="<?= htmlspecialchars($recEvent->title) ?>" class="w-full h-48 object-cover rounded-lg group-hover:ring-2 group-hover:ring-orange-200 transition-all duration-200">
                        <div class="absolute top-3 left-3 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-sm">
                            <?= reDate($recEvent->event_date) ?> • <?= reTime($recEvent->start_time) ?>
                        </div>
                        <div class="absolute top-3 right-3 <?= getCategoryColor($recEvent->category) ?> text-white px-3 py-1 rounded-full text-sm">
                            <i class="<?= getCategoryIcon($recEvent->category) ?> text-xs"></i>
                            <?= ucfirst($recEvent->category) ?>
                        </div>
                        <!-- Recommendation reason badge -->
                        <div class="absolute bottom-3 left-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs">
                            <i class="fas fa-heart mr-1"></i> Matches your interests
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-orange-600 transition-colors duration-200">
                        <?= htmlspecialchars($recEvent->title) ?>
                    </h3>
                    
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span><?= htmlspecialchars($recEvent->location_name) ?>, <?= htmlspecialchars($recEvent->city) ?>, <?= htmlspecialchars($recEvent->country) ?></span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-user mr-2"></i>
                            <span>Hosted by <?= htmlspecialchars($recEvent->first_name . ' ' . $recEvent->last_name) ?></span>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 mb-4">
                        <?= htmlspecialchars(strlen($recEvent->description) > 120 ? substr($recEvent->description, 0, 120) . '...' : $recEvent->description) ?>
                    </p>
                    
                    <!-- Updated Attendees and Actions Section (same as upcoming events) -->
                    <div class="flex justify-between items-center">
                        <!-- Left side: Profile pics and count -->
                        <div class="flex items-center space-x-2">
                            <?php if (!empty($recEvent->attendees) && is_array($recEvent->attendees)): ?>
                                <div class="flex -space-x-2">
                                    <?php foreach (array_slice($recEvent->attendees, 0, 5) as $attendee): ?>
                                        <?php $profileUrl = getProfilePictureUrl($attendee); ?>
                                        <img src="<?= htmlspecialchars($profileUrl) ?>" 
                                             alt="<?= htmlspecialchars($attendee->first_name ?? 'Attendee') ?>" 
                                             class="w-8 h-8 rounded-full border-2 border-white group-hover:ring-2 group-hover:ring-orange-200 object-cover"
                                             onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode(($attendee->first_name ?? 'U') . '+' . ($attendee->last_name ?? 'ser')) ?>&size=32&background=dc2626&color=fff&rounded=true';"
                                             loading="lazy">
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php 
                            $attendeeCount = !empty($recEvent->attendees) ? count($recEvent->attendees) : 0;
                            $indicator = '';
                            $userIsAttending = false;
                            
                            // Check if current user is attending this event
                            if (!empty($recEvent->attendees)) {
                                foreach($recEvent->attendees as $attendee) {
                                    if($attendee->user_id == $user->user_id) {
                                        $userIsAttending = true;
                                        break;
                                    }
                                }
                            }
                            
                            if($attendeeCount == 0):
                                $indicator = "Be the first to join!";
                            elseif($attendeeCount == 1 && $userIsAttending):
                                $indicator = "Only you going";
                            elseif($attendeeCount == 1):
                                $indicator = "1 person going";
                            else:
                                $indicator = "{$attendeeCount} people going";
                            endif;
                            ?>
                            
                            <span class="text-sm text-gray-500"><?= $indicator ?></span>
                        </div>
                        
                        <!-- Right side: Action buttons -->
                        <div class="flex space-x-2">
                            <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-3 rounded-lg transition duration-200">
                                <i class="far fa-bookmark mr-1"></i> Save
                            </a>
                            <a href="/events/<?= $recEvent->event_id ?>" class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-3 rounded-lg transition duration-200">
                                <i class="fas fa-check-circle mr-1"></i> Join
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Default content when no recommendations -->
        <div class="p-4 hover:bg-gray-50 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 group">
            <div class="text-center py-8">
                <i class="fas fa-lightbulb text-orange-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">No Recommendations Yet</h3>
                <p class="text-gray-600 mb-4">Add interests to your profile to get personalized event recommendations!</p>
                <a href="/users/edit" class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-user-edit mr-1"></i> Update Profile
                </a>
            </div>
        </div>
    <?php endif; ?>
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
                        <div class="bg-gray-100 text-center rounded-lg p-2 mr-3 min-w-[48px]">
                            <div class="text-xs font-bold uppercase text-gray-500">APR</div>
                            <div class="text-lg font-bold">5</div>
                        </div>
                        <div>
                            <div class="font-medium">Coffee & Cultural Exchange</div>
                            <div class="text-sm text-gray-500">15:00 • Kadıköy, Istanbul</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-gray-100 text-center rounded-lg p-2 mr-3 min-w-[48px]">
                            <div class="text-xs font-bold uppercase text-gray-500">APR</div>
                            <div class="text-lg font-bold">10</div>
                        </div>
                        <div>
                            <div class="font-medium">Historical Istanbul Tour</div>
                            <div class="text-sm text-gray-500">10:00 • Sultanahmet, Istanbul</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-gray-100 text-center rounded-lg p-2 mr-3 min-w-[48px]">
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
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer">
                        <div class="font-medium">Coffee Tasting</div>
                        <div class="text-sm text-gray-500">24 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer">
                        <div class="font-medium">Boat Tours</div>
                        <div class="text-sm text-gray-500">18 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer">
                        <div class="font-medium">Photography</div>
                        <div class="text-sm text-gray-500">15 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer">
                        <div class="font-medium">Language Exchange</div>
                        <div class="text-sm text-gray-500">12 events</div>
                    </div>
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer">
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
        
        if (userMenu && userDropdown) {
            userMenu.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('show');
            });
            
            // Close dropdown when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (userDropdown.classList.contains('show') && !userMenu.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
            });
        }
    });

    // Like functionality for activity posts
    document.querySelectorAll('.fa-heart').forEach(heart => {
        heart.addEventListener('click', function() {
            const parentSpan = this.parentElement;
            const likeCount = parentSpan.querySelector('span');
            
            if (this.classList.contains('far')) { // Not liked yet
                this.classList.remove('far');
                this.classList.add('fas');
                parentSpan.classList.remove('hover:text-red-500');
                parentSpan.classList.add('text-red-500');
                if (likeCount) {
                    likeCount.textContent = parseInt(likeCount.textContent) + 1;
                }
            } else { // Already liked
                this.classList.remove('fas');
                this.classList.add('far');
                parentSpan.classList.add('hover:text-red-500');
                parentSpan.classList.remove('text-red-500');
                if (likeCount) {
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                }
            }
        });
    });

    // Initialize header scroll behavior if function exists
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof initHeaderScrollBehavior === 'function') {
            initHeaderScrollBehavior();
        }
    });
</script>

<?=loadPartial(name: 'footer'); ?>

</body>
</html>