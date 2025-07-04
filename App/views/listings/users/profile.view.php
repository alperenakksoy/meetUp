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
                        <!-- FIXED: Use helper function for profile picture -->
                        <img src="<?= getUserProfilePicture($user, 150) ?>" 
                             alt="Profile Picture" 
                             class="w-36 h-36 rounded-full border-4 border-gray-100 mx-auto object-cover"
                             onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode(($user->first_name ?? 'U') . '+' . ($user->last_name ?? 'ser')) ?>&size=150&background=f97316&color=fff&rounded=true';">
                    </div>
                    <h1 class="text-xl font-bold font-volkhov text-gray-800 mb-1"> 
                        <?= htmlspecialchars(mb_convert_case(mb_strtolower($user->first_name . ' ' . $user->last_name, 'UTF-8'), MB_CASE_TITLE, 'UTF-8')) ?>
                    </h1>
                    <div class="flex items-center justify-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                        <span><?= $user->city .', '.$user->country ?></span>
                    </div>
                    <div class="flex justify-between mb-4">
                       
                       <a href="/events/past">  
                            <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                                <div class="text-xl font-bold text-orange-500"><?=count($pastEvents) ?? 0?></div>
                                <div class="text-xs text-gray-500">Events</div>
                            </div>
                        </a>
                            
                        <a href="/users/friends/<?=$user->user_id?>"> 
                            <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                                <div class="text-xl font-bold text-orange-500"><?=$friendsCount ?? 0?></div>
                                <div class="text-xs text-gray-500">Friends</div>
                            </div>
                        </a>
                        
                        <a href="/users/references/<?=$user->user_id?>"> 
                            <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer">
                                <div class="text-xl font-bold text-orange-500"><?=count($reviews)?? 0?></div>
                                <div class="text-xs text-gray-500">References</div>
                            </div>
                        </a>
                    </div>
                    
                    <?php if ($isOwnProfile): ?>
    <!-- Own Profile - Show Edit Button -->
    <a href="/users/edit" class="block w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-md text-center transition-colors">
        <i class="fas fa-edit mr-1"></i> Edit Profile
    </a>
<?php else: ?>
    <!-- Someone Else's Profile -->
    <?php if ($areFriends): ?>
        <!-- Already Friends - Show Message Button -->
        <a href="/messages/conversation/<?= $user->user_id ?>" class="block w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md text-center transition-colors">
            <i class="fas fa-comment mr-1"></i> Send Message
        </a>
    <?php elseif ($friendshipStatus === 'pending'): ?>
        <!-- Request Already Sent -->
        <button class="block w-full bg-gray-400 text-white py-2 px-4 rounded-md text-center cursor-not-allowed" disabled>
            <i class="fas fa-clock mr-1"></i> Request Sent
        </button>
    <?php else: ?>
        <!-- Send Friend Request -->
        <button class="block w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-md text-center transition-colors send-friend-request" 
                data-user-id="<?= $user->user_id ?>">
            <i class="fas fa-user-plus mr-1"></i> Add Friend
        </button>
    <?php endif; ?>
<?php endif; ?>
                
                <!-- User Details -->
                <div class="mt-6">
                    <div class="mb-4">
                        <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mb-3 font-volkhov">Personal Information</h3>
                        <?php if($user->show_age == 1):?>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-user text-orange-500 w-5 mr-2"></i>
                            <span><?=calcAge($user->date_of_birth)?> years old</span>
                        </div>
                        <?php endif;?>
                        <?php if(isset($user->occupation)):?>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-briefcase text-orange-500 w-5 mr-2"></i>
                            <span><?=$user->occupation?></span>
                        </div>
                        <?php endif;?>
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
                        <?php if(isset($user->bio)):?>
                        <p class="text-sm text-gray-600"><?=$user->bio?></p>
                        <?php endif;?>
                    </div>

                    <?php if($user->linkedin || $user->twitter || $user->instagram || $user->website): ?>
                        <div class="mb-4">
                            <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mb-3 font-volkhov">Connect with Me</h3>
                            <div class="flex flex-wrap gap-3">
                                <?php if($user->linkedin): ?>
                                    <a href="<?= htmlspecialchars($user->linkedin) ?>" target="_blank" class="flex items-center text-sm text-blue-700 hover:underline">
                                        <i class="fab fa-linkedin mr-1"></i> LinkedIn
                                    </a>
                                <?php endif; ?>
                                
                                <?php if($user->twitter): ?>
                                    <a href="<?= htmlspecialchars($user->twitter) ?>" target="_blank" class="flex items-center text-sm text-blue-500 hover:underline">
                                        <i class="fab fa-twitter mr-1"></i> Twitter
                                    </a>
                                <?php endif; ?>
                                <?php if($user->instagram): ?>
                                    <a href="<?= htmlspecialchars($user->instagram) ?>" target="_blank" class="flex items-center text-sm text-pink-600 hover:underline">
                                        <i class="fab fa-instagram mr-1"></i> Instagram
                                    </a>
                                <?php endif; ?>
                                <?php if($user->website): ?>
                                    <a href="<?= htmlspecialchars($user->website) ?>" target="_blank" class="flex items-center text-sm text-orange-500 hover:underline">
                                        <i class="fas fa-globe mr-1"></i> Website
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                     <!-- Interests -->
                    <div>
                        <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mb-3 font-volkhov">Interests</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php if(isset($user->interests)):?>
                            <?php $interestsArray = explode(',', $user->interests);?>
                            <?php foreach($interestsArray as $interest):?>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer"><?=trim($interest,"[]\" \t\n\r\0\x0B")?></span>
                            <?php endforeach;?>
                            <?php else:?>
                             <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">No Interests added</span>
                            <?php endif;?>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-gray-800 font-medium border-b border-gray-100 pb-2 mt-5 mb-3 font-volkhov">Languages</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php if(isset($user->languages)):?>
                            <?php $languagesArray = explode(',', $user->languages);?>
                            <?php foreach($languagesArray as $language):?>
                            <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer"><?=trim($language,"[]\" \t\n\r\0\x0B")?></span>
                            <?php endforeach;?>
                            <?php else:?>
                             <span class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-800 px-3 py-1 rounded-full text-xs transition-colors cursor-pointer">No Languages added</span>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Events Section -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
<?php if($isOwnProfile):?>              
    <div class="flex justify-between items-center p-4 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800 font-volkhov">
            <i class="fas fa-calendar-alt text-orange-500 mr-2"></i> Unreviwed Events
        </h2>
        <a href="events.php" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
        <?php if (empty($unreviewedEvents)): ?>
            <div class="col-span-full flex items-center text-sm text-gray-600">
                <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                <span>No Unreviewed Events</span>
            </div>
        <?php else: ?>
            <?php ?>
            <?php foreach($unreviewedEvents as $unreviewedEvent): ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                    <img src="<?=getEventImage($unreviewedEvent)?>" alt="Event Image" class="w-full h-36 object-cover">
                    <div class="p-3">
                        <h3 class="font-semibold text-gray-800 mb-2"><?=$unreviewedEvent->event_title?></h3>
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                            <span><?=reDate($unreviewedEvent->event_date)?>, • <?=reTime($unreviewedEvent->start_time)?></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 w-4 mr-2"></i>
                            <span><?=$unreviewedEvent->location_name?>, <?=$unreviewedEvent->city?></span>
                        </div>
                        <?php if($unreviewedEvent->attendeesCount>0):?>
                        <div class="flex items-center">
                            <?php if($unreviewedEvent->attendeesCount == 1):?>
                            <span class="text-xs text-gray-500 ml-2">+1 other person participated</span>
                            <?php else:?>
                                <span class="text-xs text-gray-500 ml-2">+<?=$unreviewedEvent->attendeesCount?> people participated</span>
                            <?php endif;?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php endif;?>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="flex justify-between items-center p-4 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800 font-volkhov">
          <?php if($user->gender == 'Male'){$whose = 'His';}
          elseif($user->gender == 'Female'){$whose = 'Her';}
          else{$whose = 'Their';}?>  
            <i class="fas fa-calendar-alt text-orange-500 mr-2"></i> <?=$whose?> Past Events
        </h2>
        <a href="events.php" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
        <?php if (empty($pastEvents)): ?>
            <div class="col-span-full flex items-center text-sm text-gray-600">
                <i class="far fa-calendar text-orange-500 w-4 mr-2"></i>
                <span>No Past Events</span>
            </div>
        <?php else: ?>
            <?php foreach($pastEvents as $pastEvent): ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                    <img src="<?= getEventImage($pastEvent)?>" alt="Event Image" class="w-full h-36 object-cover">
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
                          
                            <span class="text-xs text-gray-500 ml-2">Reviews: <?=number_format($pastEvent->average_rating, 1)?>/5 </span>
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
        <h2 class="text-lg font-semibold text-gray-800 font-volkhov">
            <i class="fas fa-users text-orange-500 mr-2"></i> Friends (<?=$friendsCount?>)
        </h2>
        <a href="/users/friends" class="text-orange-500 hover:text-orange-600 text-sm hover:underline">View All</a>
    </div>
    
    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-4 p-4">
        <?php if($friendsCount == 0): ?>
            <div class="col-span-full text-center py-4 text-gray-500">
                <p>You don't have any friends yet.</p>
                <a href="/users/find-friends" class="text-orange-500 hover:underline mt-2 inline-block">Find Friends</a>
            </div>
        <?php elseif (!empty($friends)): ?>
            <?php foreach(array_slice($friends, 0, 6) as $friend): ?>
                <a href="/users/profile/<?= $friend->user_id ?>"><div class="text-center cursor-pointer hover:-translate-y-1 transition-transform">
                    <img src="<?= !empty($friend->profile_picture) ? $friend->profile_picture : 'https://ui-avatars.com/api/?name=' . urlencode($friend->first_name . '+' . $friend->last_name) . '&size=56&background=f97316&color=fff&rounded=true' ?>" 
                         alt="<?= htmlspecialchars($friend->first_name . ' ' . $friend->last_name) ?>" 
                         class="w-14 h-14 rounded-full border-2 border-gray-100 mx-auto mb-1 object-cover">
                </div></a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-4 text-gray-500">
                <p>Error loading friends.</p>
            </div>
        <?php endif; ?>
    </div>
</div>


    
    <?=loadPartial(name: 'footer'); ?>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Profile friend request system initializing...');
    
    // Handle friend request button clicks
    document.addEventListener('click', function(e) {
        // Check if the clicked element has the send-friend-request class
        if (e.target.closest('.send-friend-request')) {
            e.preventDefault();
            const button = e.target.closest('.send-friend-request');
            const userId = button.getAttribute('data-user-id');
            
            if (userId) {
                handleSendFriendRequest(userId, button);
            }
        }
    });

    // Make event cards clickable to navigate to event details
    const eventCards = document.querySelectorAll('.bg-white.rounded-lg.shadow-sm');
    eventCards.forEach(card => {
        card.addEventListener('click', function() {
            const eventTitle = this.querySelector('h3')?.textContent;
            if (eventTitle) {
                // In a real app, this would use an event ID instead of title
                window.location.href = `event_details.php?title=${encodeURIComponent(eventTitle)}`;
            }
        });
    });
    
    // Make friend items clickable to navigate to friend profiles
    const friendItems = document.querySelectorAll('.text-center.cursor-pointer');
    friendItems.forEach(item => {
        item.addEventListener('click', function() {
            const friendName = this.querySelector('div')?.textContent;
            if (friendName) {
                // In a real app, this would use a user ID instead of name
                window.location.href = `profile.php?name=${encodeURIComponent(friendName)}`;
            }
        });
    });
    
    // Make message items clickable to open conversation
    const messageItems = document.querySelectorAll('.flex.p-4');
    messageItems.forEach(item => {
        item.addEventListener('click', function() {
            const senderName = this.querySelector('.font-semibold')?.textContent;
            if (senderName) {
                // In a real app, this would use a conversation ID
                window.location.href = `messages.php?conversation=${encodeURIComponent(senderName)}`;
            }
        });
    });
});

/**
 * Send friend request function
 */
async function handleSendFriendRequest(userId, button) {
    console.log('Sending friend request to user:', userId);
    
    // Show loading state
    const originalHTML = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Sending...';
    
    try {
        const response = await fetch('/api/friendship/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                user_id: parseInt(userId)
            })
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.success) {
            showNotification('Friend request sent successfully!', 'success');
            
            // Update button to show sent state
            button.innerHTML = '<i class="fas fa-clock mr-1"></i> Request Sent';
            button.classList.remove('bg-orange-500', 'hover:bg-orange-600');
            button.classList.add('bg-gray-400', 'cursor-not-allowed');
            button.disabled = true;
            
        } else {
            throw new Error(data.message || 'Failed to send friend request');
        }
        
    } catch (error) {
        console.error('Send friend request failed:', error);
        showNotification(error.message || 'Failed to send friend request', 'error');
        
        // Restore button state
        button.disabled = false;
        button.innerHTML = originalHTML;
    }
}

/**
 * Show notification function
 */
function showNotification(message, type = 'info') {
    // Remove any existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 
        'bg-blue-500'
    }`;
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.transition = 'opacity 0.3s ease';
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}
</script>
</body>
</html>