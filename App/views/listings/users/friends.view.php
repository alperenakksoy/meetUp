<?php
// Set page variables
$pageTitle = 'Friends';
$activePage = 'friends';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body class="bg-gray-100">
<?php loadPartial('navbar') ?>
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6 mt-20">
            <h1 class="text-3xl font-bold text-gray-800">Friends</h1>
            <button id="findFriendsBtn" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                <i class="fas fa-user-plus mr-2"></i> Find Friends
            </button>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6">
            <div class="relative mb-4">
                <input type="text" class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search friends...">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <div class="flex flex-wrap gap-4">
                <select class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">All Locations</option>
                    <option value="istanbul">Istanbul</option>
                    <option value="ankara">Ankara</option>
                    <option value="izmir">Izmir</option>
                    <option value="international">International</option>
                </select>
                <select class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">All Interests</option>
                    <option value="travel">Travel</option>
                    <option value="photography">Photography</option>
                    <option value="food">Food</option>
                    <option value="sports">Sports</option>
                    <option value="culture">Culture</option>
                </select>
                <select class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">Sort By</option>
                    <option value="recent">Recently Added</option>
                    <option value="name">Name (A-Z)</option>
                </select>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex border-b mb-6">
            <div id="allFriendsTab" class="tab-item px-6 py-3 text-orange-600 border-b-2 border-orange-600 cursor-pointer font-medium">
                All Friends
            </div>
            <div id="requestsTab" class="tab-item px-6 py-3 text-gray-600 hover:text-orange-600 cursor-pointer font-medium flex items-center">
                Requests <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1"><?= (count($pendingRequests ?? []))?></span>
            </div>
            <div id="findFriendsTabBtn" class="tab-item px-6 py-3 text-gray-600 hover:text-orange-600 cursor-pointer font-medium">
                Find Friends
            </div>
        </div>
<!-- All Friends Section -->
<div id="allFriendsSection" class="tab-content">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800">All Friends (<?= $friendsCount ?? 0 ?>)</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php if(!empty($friends)): ?>
                <?php foreach($friends as $friend): ?>     
                    <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="h-24 bg-gradient-to-r from-orange-200 to-purple-200"></div>
                        <div class="relative">
                            <img src="<?= $friend->profile_picture ?>" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2 object-cover">
                        </div>
                        <div class="p-4 pt-12 text-center">
                            <h3 class="font-semibold text-gray-800"><?= $friend->first_name ?> <?= $friend->last_name ?></h3>
                            <div class="text-sm text-gray-600 flex items-center justify-center">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <?= "{$friend->city}, {$friend->country}" ?>
                            </div>
                            <div class="text-sm text-gray-500 mt-1"><?= $friend->occupation ?? 'Professional' ?></div>
                            
                            <!-- Mutual Friends Section -->
                            <div class="flex justify-center mt-2">
                                <?php if(!empty($friend->mutualFriendsDetails) && count($friend->mutualFriendsDetails) > 0): ?>
                                    <div class="flex -space-x-2">
                                        <?php foreach($friend->mutualFriendsDetails as $mutualFriend): ?>
                                            <img src="<?= $mutualFriend->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($mutualFriend->first_name . '+' . $mutualFriend->last_name) . '&size=24&background=667eea&color=fff&rounded=true' ?>" 
                                                 alt="<?= $mutualFriend->first_name ?> <?= $mutualFriend->last_name ?>" 
                                                 class="w-6 h-6 rounded-full border-2 border-white object-cover"
                                                 title="<?= $mutualFriend->first_name ?> <?= $mutualFriend->last_name ?>">
                                        <?php endforeach; ?>
                                        
                                        <!-- Show "+X more" if there are more mutual friends -->
                                        <?php if(($friend->mutualFriends ?? 0) > count($friend->mutualFriendsDetails)): ?>
                                            <div class="w-6 h-6 rounded-full border-2 border-white bg-gray-300 flex items-center justify-center text-xs text-gray-600">
                                                +<?= ($friend->mutualFriends - count($friend->mutualFriendsDetails)) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">
                                        <?= $friend->mutualFriends ?? 0 ?> mutual friend<?= ($friend->mutualFriends != 1) ? 's' : '' ?>
                                    </span>
                                <?php else: ?>
                                    <!-- No mutual friends -->
                                    <span class="text-sm text-gray-500">No mutual friends</span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mt-4 flex justify-center gap-2">
                                <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">Message</button>
                                <a href="/users/profile/<?= $friend->user_id ?>">
                                    <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- No friends message -->
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-user-friends fa-4x"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No Friends Yet</h3>
                    <p class="text-gray-500 mb-4">Start connecting with people to build your network!</p>
                    <button id="findFriendsFromEmpty" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i> Find Friends
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

       <!-- Friend Requests Section -->
<div id="requestsSection" class="tab-content hidden">
    <!-- Received Friend Requests -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Friend Requests</h2>
            <span class="text-sm text-gray-500"><?= count($pendingRequests ?? []) ?> pending requests</span>
        </div>
        <div class="space-y-4" id="friendRequestsContainer">
            <?php if(!empty($pendingRequests)): ?>
                <?php foreach($pendingRequests as $request): ?>
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50" 
                         data-friendship-id="<?= $request->friendship_id ?>">
                        <div class="flex items-center">
                            <!-- Clickable profile picture with hover effect -->
                            <a href="/users/profile/<?= $request->user_id_1 ?>" class="group relative">
                                <img src="<?= $request->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" 
                                    alt="Friend" 
                                    class="w-12 h-12 rounded-full mr-4 object-cover border-2 border-transparent group-hover:border-orange-500 transition-all">
                            </a>
                            <div>
                                <div class="font-semibold text-gray-800"><?= "{$request->first_name} {$request->last_name}" ?></div>
                                <?php if(($request->mutualFriends ?? 0) > 0): ?>
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-user-friends mr-1"></i> <?= $request->mutualFriends ?> mutual friends
                                    </div>
                                <?php endif; ?>
                                <div class="text-sm text-gray-500"><?= timeSince($request->created_at) ?></div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center transition-colors"
                                    onclick="handleFriendRequest(<?= $request->friendship_id ?>, 'accept')">
                                <i class="fas fa-check mr-2"></i> Accept
                            </button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center transition-colors"
                                    onclick="handleFriendRequest(<?= $request->friendship_id ?>, 'decline')">
                                <i class="fas fa-times mr-2"></i> Decline
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-user-plus fa-3x mb-4"></i>
                    <p>No pending friend requests</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sent Requests -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Friend Requests Sent</h2>
            <span class="text-sm text-gray-500"><?= count($sentRequests ?? []) ?> pending requests</span>
        </div>
        <div class="space-y-4">
            <?php if(!empty($sentRequests)): ?>
                <?php foreach($sentRequests as $request): ?>
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <!-- Clickable profile picture with hover effect -->
                            <a href="/users/profile/<?= $request->user_id_2 ?>" class="group relative">
                                <img src="<?= $request->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" 
                                    alt="Friend" 
                                    class="w-12 h-12 rounded-full mr-4 object-cover border-2 border-transparent group-hover:border-orange-500 transition-all">
                            </a>
                            <div>
                                <div class="font-semibold text-gray-800"><?= "{$request->first_name} {$request->last_name}" ?></div>
                                <?php if(!empty($request->mutuals) && count($request->mutuals) > 0): ?>
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-user-friends mr-1"></i> <?= count($request->mutuals) ?> mutual friends
                                    </div>
                                <?php endif; ?>
                                <div class="text-sm text-gray-500">Sent <?= timeSince($request->created_at) ?></div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg text-sm">Pending</span>
                            <button class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center transition-colors">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-paper-plane fa-3x mb-4"></i>
                    <p>No pending sent requests</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

        <!-- Find Friends Section -->
        <div id="findFriendsSection" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Discover New Friends</h2>
                    <div class="flex gap-2">
                        <select class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="">Filter by Location</option>
                            <option value="istanbul">Istanbul</option>
                            <option value="ankara">Ankara</option>
                            <option value="izmir">Izmir</option>
                        </select>
                        <select class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="">Filter by Interest</option>
                            <option value="travel">Travel</option>
                            <option value="photography">Photography</option>
                            <option value="food">Food</option>
                        </select>
                    </div>
                </div>

                <!-- Suggested Friends -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">People You May Know</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Suggested Friend 1 -->
                        <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Suggested Friend" class="w-16 h-16 rounded-full mr-4 object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800">Lisa Martinez</div>
                                <div class="text-sm text-gray-600 mb-1">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Madrid, Spain
                                </div>
                                <div class="text-sm text-gray-500 mb-2">Travel blogger, Photography enthusiast</div>
                                <div class="text-xs text-gray-500">
                                    <i class="fas fa-user-friends mr-1"></i>3 mutual friends: Emma, David, Alex
                                </div>
                            </div>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>

                        <!-- Suggested Friend 2 -->
                        <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Suggested Friend" class="w-16 h-16 rounded-full mr-4 object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800">Marco Rossi</div>
                                <div class="text-sm text-gray-600 mb-1">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Rome, Italy
                                </div>
                                <div class="text-sm text-gray-500 mb-2">Chef, Food culture explorer</div>
                                <div class="text-xs text-gray-500">
                                    <i class="fas fa-user-friends mr-1"></i>2 mutual friends: Maria, Sofia
                                </div>
                            </div>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Search Results -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Search Results</h3>
                    <div class="relative mb-4">
                        <input type="text" class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search by name, email, or interests...">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Search Result 1 -->
                        <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <img src="https://randomuser.me/api/portraits/women/91.jpg" alt="Search Result" class="w-12 h-12 rounded-full mr-4 object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800">Anna Kowalski</div>
                                <div class="text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Warsaw, Poland
                                </div>
                                <div class="text-sm text-gray-500">Software Engineer, Tech enthusiast</div>
                            </div>
                            <div class="flex gap-2">
                                <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    View Profile
                                </button>
                                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                    <i class="fas fa-user-plus mr-2"></i> Add Friend
                                </button>
                            </div>
                        </div>

                        <!-- Search Result 2 -->
                        <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="Search Result" class="w-12 h-12 rounded-full mr-4 object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800">Raj Patel</div>
                                <div class="text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Mumbai, India
                                </div>
                                <div class="text-sm text-gray-500">Digital marketer, Cricket fan</div>
                            </div>
                            <div class="flex gap-2">
                                <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    View Profile
                                </button>
                                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                    <i class="fas fa-user-plus mr-2"></i> Add Friend
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>

            <script>
/**
 * Handle friend request actions (accept/decline)
 */
async function handleFriendRequest(friendshipId, action) {
    console.log('Handling friend request:', friendshipId, action); // Debug log
    
    // Show loading state
    const requestElement = document.querySelector(`[data-friendship-id="${friendshipId}"]`);
    if (requestElement) {
        requestElement.style.opacity = '0.6';
        requestElement.style.pointerEvents = 'none';
    }
    
    try {
        const response = await fetch('/api/friendship/handle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                friendship_id: parseInt(friendshipId),
                action: action
            })
        });
        
        console.log('Response status:', response.status); // Debug log
        console.log('Response headers:', response.headers); // Debug log
        
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            console.error('Response is not JSON:', await response.text());
            throw new Error('Server returned non-JSON response');
        }
        
        const data = await response.json();
        console.log('Response data:', data); // Debug log
        
        if (response.ok && data.success) {
            // Show success message
            showNotification(data.message, 'success');
            
            // Update UI based on action
            if (action === 'accept') {
                updateRequestUI(friendshipId, 'accepted');
            } else if (action === 'decline') {
                updateRequestUI(friendshipId, 'declined');
            }
            
            // Update counters
            updateRequestCounters();
            
        } else {
            // Show error message
            showNotification(data.message || 'An error occurred', 'error');
            
            // Restore element state
            if (requestElement) {
                requestElement.style.opacity = '1';
                requestElement.style.pointerEvents = 'auto';
            }
        }
        
    } catch (error) {
        console.error('Error handling friend request:', error);
        
        // More specific error message based on error type
        let errorMessage = 'Network error occurred';
        if (error.message.includes('JSON')) {
            errorMessage = 'Server response error. Please try again.';
        } else if (error.name === 'TypeError') {
            errorMessage = 'Connection failed. Check your internet connection.';
        }
        
        showNotification(errorMessage, 'error');
        
        // Restore element state
        if (requestElement) {
            requestElement.style.opacity = '1';
            requestElement.style.pointerEvents = 'auto';
        }
    }
}

/**
 * Send a friend request
 */
async function sendFriendRequest(userId) {
    const button = document.querySelector(`[data-user-id="${userId}"]`);
    if (button) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
    }
    
    try {
        const response = await fetch('/api/friendship/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                user_id: userId
            })
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            showNotification(data.message, 'success');
            
            if (button) {
                button.innerHTML = '<i class="fas fa-clock mr-2"></i>Request Sent';
                button.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                button.classList.add('bg-gray-400', 'cursor-not-allowed');
            }
        } else {
            showNotification(data.message || 'Failed to send request', 'error');
            
            if (button) {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-user-plus mr-2"></i>Add Friend';
            }
        }
        
    } catch (error) {
        console.error('Error sending friend request:', error);
        showNotification('Network error occurred', 'error');
        
        if (button) {
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-user-plus mr-2"></i>Add Friend';
        }
    }
}

/**
 * Update the UI after processing a friend request
 */
function updateRequestUI(friendshipId, action) {
    const requestElement = document.querySelector(`[data-friendship-id="${friendshipId}"]`);
    
    if (!requestElement) return;
    
    if (action === 'accepted') {
        // Update to show "Friends" status
        const imgElement = requestElement.querySelector('img');
        const nameElement = requestElement.querySelector('.font-semibold');
        const userName = nameElement ? nameElement.textContent : 'User';
        
        requestElement.innerHTML = `
            <div class="flex items-center justify-between p-4 border border-green-200 rounded-lg bg-green-50">
                <div class="flex items-center">
                    ${imgElement ? imgElement.outerHTML : ''}
                    <div>
                        <div class="font-semibold text-gray-800">${userName}</div>
                        <div class="text-sm text-green-600">
                            <i class="fas fa-check mr-1"></i> Friend request accepted
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="window.location.href='/messages'">
                        <i class="fas fa-envelope mr-2"></i> Message
                    </button>
                </div>
            </div>
        `;
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            requestElement.style.transition = 'opacity 0.5s ease-out';
            requestElement.style.opacity = '0';
            setTimeout(() => {
                requestElement.remove();
            }, 500);
        }, 3000);
        
    } else if (action === 'declined') {
        // Fade out and remove
        requestElement.style.transition = 'opacity 0.5s ease-out, height 0.3s ease-out';
        requestElement.style.opacity = '0';
        requestElement.style.height = '0px';
        requestElement.style.marginBottom = '0px';
        requestElement.style.paddingTop = '0px';
        requestElement.style.paddingBottom = '0px';
        
        setTimeout(() => {
            requestElement.remove();
        }, 500);
    }
}

/**
 * Update request counters in the UI
 */
function updateRequestCounters() {
    const badge = document.querySelector('.notification-badge');
    if (badge) {
        let currentCount = parseInt(badge.textContent) || 0;
        currentCount = Math.max(0, currentCount - 1);
        
        if (currentCount === 0) {
            badge.style.display = 'none';
        } else {
            badge.textContent = currentCount;
        }
    }
    
    // Update tab counter
    const requestsTab = document.getElementById('requestsTab');
    if (requestsTab) {
        const tabBadge = requestsTab.querySelector('span');
        if (tabBadge) {
            let currentTabCount = parseInt(tabBadge.textContent) || 0;
            currentTabCount = Math.max(0, currentTabCount - 1);
            tabBadge.textContent = currentTabCount;
            
            if (currentTabCount === 0) {
                tabBadge.style.display = 'none';
            }
        }
    }
}

/**
 * Show notification messages
 */
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification-toast');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification-toast fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white max-w-sm ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 
        'bg-blue-500'
    }`;
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.transition = 'opacity 0.3s ease-out';
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }, 5000);
}

// Main DOM Ready Functions
document.addEventListener('DOMContentLoaded', function() {
    // Handle "Find Friends" button click from empty state
    const findFriendsFromEmpty = document.getElementById('findFriendsFromEmpty');
    if (findFriendsFromEmpty) {
        findFriendsFromEmpty.addEventListener('click', function() {
            // Switch to Find Friends tab (assuming the tab switching function exists)
            if (typeof switchTab === 'function') {
                switchTab('findFriendsTabBtn', 'findFriendsSection');
            }
        });
    }
    
    // Tab switching functionality
    const tabItems = document.querySelectorAll('.tab-item');
    const tabContents = document.querySelectorAll('.tab-content');
    
    // Function to switch tabs
    function switchTab(activeTabId, activeContentId) {
        // Remove active classes from all tabs
        tabItems.forEach(tab => {
            tab.classList.remove('text-orange-600', 'border-b-2', 'border-orange-600');
            tab.classList.add('text-gray-600');
        });
        
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });
        
        // Activate selected tab
        const activeTab = document.getElementById(activeTabId);
        if (activeTab) {
            activeTab.classList.remove('text-gray-600');
            activeTab.classList.add('text-orange-600', 'border-b-2', 'border-orange-600');
        }
        
        // Show selected content
        const activeContent = document.getElementById(activeContentId);
        if (activeContent) {
            activeContent.classList.remove('hidden');
        }
    }
    
    // Make switchTab function globally available
    window.switchTab = switchTab;
    
    // Tab click handlers
    const allFriendsTab = document.getElementById('allFriendsTab');
    const requestsTab = document.getElementById('requestsTab');
    const findFriendsTabBtn = document.getElementById('findFriendsTabBtn');
    const findFriendsBtn = document.getElementById('findFriendsBtn');
    
    if (allFriendsTab) {
        allFriendsTab.addEventListener('click', function() {
            switchTab('allFriendsTab', 'allFriendsSection');
        });
    }
    
    if (requestsTab) {
        requestsTab.addEventListener('click', function() {
            switchTab('requestsTab', 'requestsSection');
        });
    }
    
    if (findFriendsTabBtn) {
        findFriendsTabBtn.addEventListener('click', function() {
            switchTab('findFriendsTabBtn', 'findFriendsSection');
        });
    }
    
    // Find Friends button in header
    if (findFriendsBtn) {
        findFriendsBtn.addEventListener('click', function() {
            switchTab('findFriendsTabBtn', 'findFriendsSection');
        });
    }

    // Add Friend button functionality
    document.querySelectorAll('.add-friend-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            if (userId) {
                sendFriendRequest(userId);
            }
        });
    });

    // General "Add Friend" buttons (for buttons with orange background)
    document.querySelectorAll('.bg-orange-500').forEach(button => {
        if (button.textContent.includes('Add Friend')) {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                if (userId) {
                    sendFriendRequest(userId);
                }
            });
        }
    });

    // Decline button functionality (remove from UI immediately)
    document.querySelectorAll('.bg-red-500').forEach(button => {
        if (button.textContent.includes('Decline')) {
            button.addEventListener('click', function() {
                const friendshipId = this.getAttribute('data-friendship-id') || 
                                   this.closest('[data-friendship-id]')?.getAttribute('data-friendship-id');
                if (friendshipId) {
                    handleFriendRequest(friendshipId, 'decline');
                }
            });
        }
    });

    // Accept button functionality
    document.querySelectorAll('.bg-green-500').forEach(button => {
        if (button.textContent.includes('Accept')) {
            button.addEventListener('click', function() {
                const friendshipId = this.getAttribute('data-friendship-id') || 
                                   this.closest('[data-friendship-id]')?.getAttribute('data-friendship-id');
                if (friendshipId) {
                    handleFriendRequest(friendshipId, 'accept');
                }
            });
        }
    });

    // Search functionality
    const searchInput = document.querySelector('input[placeholder*="Search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const friendCards = document.querySelectorAll('.bg-gray-50, .flex.items-center.p-4');
            
            friendCards.forEach(card => {
                const name = card.querySelector('.font-semibold');
                if (name && name.textContent.toLowerCase().includes(searchTerm)) {
                    card.style.display = '';
                } else if (name) {
                    card.style.display = 'none';
                }
            });
        });
    }
    
    console.log('Friendship system initialized successfully');
});

// Make functions globally available
window.handleFriendRequest = handleFriendRequest;
window.sendFriendRequest = sendFriendRequest;
window.showNotification = showNotification;
</script>

    <?= loadPartial('scripts'); ?>
    <?= loadPartial('footer'); ?>
</body>
</html>