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

<!-- Main Content -->
<div class="container mx-auto px-4 mt-20">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Left Sidebar - User Profile -->
        <div class="md:col-span-3 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-32 bg-gradient-to-r from-orange-500 to-purple-600"></div>
            <div class="px-6 py-4">
                <div class="flex justify-center -mt-16">
                    <!-- FIXED: Use helper function for profile picture -->
                    <img src="<?= getUserProfilePicture($user, 150) ?>" 
                         alt="Profile Picture" 
                         class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover"
                         onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode(($user->first_name ?? 'U') . '+' . ($user->last_name ?? 'ser')) ?>&size=150&background=f97316&color=fff&rounded=true';">
                </div>
                <h2 class="text-xl font-bold text-center mt-2">
                    <?= htmlspecialchars(mb_convert_case(mb_strtolower($user->first_name . ' ' . $user->last_name, 'UTF-8'), MB_CASE_TITLE, 'UTF-8')) ?>
                </h2>
                <div class="flex items-center justify-center text-gray-600 mt-1">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <?= $user->city ?? null?>, <?= $user->country ?? null?>
                </div>
                <a href="/events/create" class="block mt-6 bg-orange-600 hover:bg-orange-700 text-white text-center py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-calendar-alt mr-1"></i> Create an Event
                </a>
                <a href="/hangouts/index" class="block mt-6 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-list-alt mr-2"></i> Create a Hangout
                </a>
            </div>
            <div class="border-t border-gray-200 px-6 py-4">
                <a href="/users/profile/<?=$user->user_id?>" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-user mr-3"></i> View My Profile
                </a>
                <a href="/events/past" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-history mr-3"></i> Past Events
                </a>
                <a href="/notifications" class="flex items-center py-2 text-gray-700 hover:text-orange-600">
                    <i class="fas fa-bell mr-3"></i> Notifications
                    <span class="ml-auto bg-yellow-500 text-white px-2 py-0.5 rounded-full text-xs"><?=$unreadNotify ?? 0?></span>
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
                        Welcome back, <strong class="font-semibold"><?=htmlspecialchars(mb_convert_case(mb_strtolower($user->first_name, 'UTF-8'), MB_CASE_TITLE, 'UTF-8')) ?></strong>! What's your plan for today?
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
                                                <!-- FIXED: Use helper function for attendee profile pictures -->
                                                <img src="<?= getUserProfilePicture($attendee, 32) ?>" 
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
           <!-- Popular Categories -->
<div class="bg-white rounded-lg shadow-md p-4">
    <h3 class="font-semibold text-lg mb-3">Popular Categories</h3>
    <div class="space-y-2">
        <?php if(!empty($popularCategories)): ?>
            <?php foreach($popularCategories as $category): ?>
                <a href="/events?category=<?= urlencode($category->category) ?>" 
                   class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer transition-colors">
                    <div class="flex items-center">
                        <i class="<?= getCategoryIcon($category->category) ?> text-orange-500 mr-2"></i>
                        <span class="font-medium"><?= ucfirst($category->category) ?></span>
                    </div>
                    <div class="text-sm text-gray-500"><?= $category->event_count ?> events</div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 text-sm">No categories available</p>
        <?php endif; ?>
    </div>
    <div class="mt-3 pt-3 border-t">
        <a href="/events" class="text-orange-500 hover:text-orange-600 text-sm font-medium">
            View All Events →
        </a>
    </div>
</div>

        <!-- Recent Activity Feed -->
        <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-lg flex items-center">
                        <i class="fas fa-pulse text-orange-500 mr-2"></i>
                        Recent Activity
                    </h3>
                    <span class="text-xs text-gray-500">Last 7 days</span>
                </div>
                
                <div class="space-y-3">
                    <?php if(!empty($recentActivity)): ?>
                        <?php foreach($recentActivity as $activity): ?>
                            <div class="flex items-start space-x-3 hover:bg-gray-50 p-2 rounded-lg transition-colors group">
                                <!-- Profile Picture -->
                                <div class="flex-shrink-0">
                                    <img src="<?= getProfilePicture($activity) ?>" 
                                         alt="<?= htmlspecialchars($activity->first_name) ?>" 
                                         class="w-8 h-8 rounded-full ring-2 ring-white group-hover:ring-orange-100 transition-all">
                                </div>
                                
                                <!-- Activity Content -->
                                <div class="flex-1 min-w-0">
                                    <?php if($activity->activity_type === 'event_created'): ?>
                                        <p class="text-sm">
                                            <span class="font-medium text-gray-900"><?= htmlspecialchars($activity->first_name) ?></span>
                                            <span class="text-gray-600">created</span>
                                            <a href="/events/<?= $activity->event_id ?>" 
                                               class="text-orange-500 hover:text-orange-600 font-medium hover:underline">
                                                <?= htmlspecialchars($activity->event_title) ?>
                                            </a>
                                            <?php if($activity->category): ?>
                                                <span class="inline-flex items-center ml-1 px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-600">
                                                    <i class="<?= getCategoryIcon($activity->category) ?> mr-1"></i>
                                                    <?= ucfirst($activity->category) ?>
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                        
                                    <?php elseif($activity->activity_type === 'review_posted'): ?>
                                        <p class="text-sm">
                                            <span class="font-medium text-gray-900"><?= htmlspecialchars($activity->first_name) ?></span>
                                            <span class="text-gray-600">reviewed</span>
                                            <a href="/events/reviews/<?= $activity->event_id ?>" 
                                               class="text-orange-500 hover:text-orange-600 font-medium hover:underline">
                                                <?= htmlspecialchars($activity->event_title) ?>
                                            </a>
                                            <?php if($activity->review_rating): ?>
                                                <span class="inline-flex items-center ml-1">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fas fa-star text-xs <?= $i <= $activity->review_rating ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                                    <?php endfor; ?>
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                        
                                    <?php elseif($activity->activity_type === 'user_joined'): ?>
                                        <p class="text-sm">
                                            <span class="font-medium text-gray-900"><?= htmlspecialchars($activity->first_name) ?></span>
                                            <span class="text-gray-600">joined SocialLoop!</span>
                                            <span class="text-green-500 ml-1">🎉</span>
                                        </p>
                                        
                                    <?php elseif($activity->activity_type === 'event_joined'): ?>
                                        <p class="text-sm">
                                            <span class="font-medium text-gray-900"><?= htmlspecialchars($activity->first_name) ?></span>
                                            <span class="text-gray-600">joined</span>
                                            <a href="/events/<?= $activity->event_id ?>" 
                                               class="text-orange-500 hover:text-orange-600 font-medium hover:underline">
                                                <?= htmlspecialchars($activity->event_title) ?>
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <!-- Timestamp -->
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= timeSince($activity->activity_time) ?>
                                    </p>
                                </div>
                                
                                <!-- Activity Icon -->
                                <div class="flex-shrink-0">
                                    <i class="<?= getActivityIcon($activity->activity_type) ?> text-xs <?= getActivityColor($activity->activity_type) ?>"></i>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-6">
                            <i class="fas fa-clock text-gray-300 text-2xl mb-2"></i>
                            <p class="text-gray-500 text-sm">No recent activity</p>
                            <p class="text-gray-400 text-xs">Check back later for updates!</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Footer with link to full activity page -->
                <?php if(!empty($recentActivity)): ?>
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <a href="/activity" 
                           class="text-orange-500 hover:text-orange-600 text-sm font-medium flex items-center justify-center hover:bg-orange-50 py-2 rounded-lg transition-colors">
                            <span>View All Activity</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                <?php endif; ?>
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