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
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Find Friends</h1>
                <p class="text-gray-600 mt-1">Discover and connect with new people</p>
            </div>
            <a href="/" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Home Page
            </a>
        </div>
        <!-- Search and Filters -->
        <div class="mb-6">
            <div class="relative mb-4">
                <input type="text" class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search friends...">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
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
                            <img src="<?= getProfilePicture($friend)?>" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2 object-cover">
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
                                            <img src="<?= getProfilePicture($mutualFriend) ?? 'https://ui-avatars.com/api/?name=' . urlencode($mutualFriend->first_name . '+' . $mutualFriend->last_name) . '&size=24&background=667eea&color=fff&rounded=true' ?>" 
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
                                <?php if($friend->areFriends && $friend->user_id != $loggedUser):?>
                                <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">Message</button>
                                <?php elseif(!$friend->areFriends && $friend->user_id != $loggedUser):?>
                                 <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">Add Friend</button>
                                    <?php endif;?>
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
                <!-- RECEIVED FRIEND REQUESTS -->

 
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
                    <!-- FIXED: Added data-friendship-id attribute to the container -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50" 
                         data-friendship-id="<?= $request->friendship_id ?>">
                        <div class="flex items-center">
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
                            <!-- FIXED: Simplified buttons without onclick, rely on event listeners -->
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center transition-colors accept-btn">
                                <i class="fas fa-check mr-2"></i> Accept
                            </button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center transition-colors decline-btn">
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
    <div class="space-y-4" id="sentRequestsContainer">
        <?php if(!empty($sentRequests)): ?>
            <?php foreach($sentRequests as $request): ?>
                <!-- FIXED: Added data-friendship-id for cancel functionality -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg sent-request-item" 
                     data-friendship-id="<?= $request->friendship_id ?>">
                    <div class="flex items-center">
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
                        <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg text-sm">
                            <i class="fas fa-clock mr-1"></i> Pending
                        </span>
                        <!-- FIXED: Updated cancel button with proper functionality -->
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center transition-colors cancel-request-btn">
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
    <!-- Friend Suggestions (NEW SECTION) -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">People You May Know</h2>
            <span class="text-sm text-gray-500"><?= count($friendSuggestions ?? []) ?> suggestions</span>
        </div>
        
        <div class="space-y-4">
            <?php if(!empty($friendSuggestions)): ?>
                <?php foreach($friendSuggestions as $suggestion): ?>
                    <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <a href="/users/profile/<?= $suggestion->user_id ?>" class="group relative">
                            <img src="<?= $suggestion->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" 
                                 alt="<?= $suggestion->first_name ?> <?= $suggestion->last_name ?>" 
                                 class="w-16 h-16 rounded-full mr-4 object-cover border-2 border-transparent group-hover:border-orange-500 transition-all">
                        </a>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800"><?= $suggestion->first_name ?> <?= $suggestion->last_name ?></div>
                            <div class="text-sm text-gray-600 mb-1">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <?= $suggestion->city ?>, <?= $suggestion->country ?>
                            </div>
                            <?php if(!empty($suggestion->occupation)): ?>
                                <div class="text-sm text-gray-500 mb-2"><?= $suggestion->occupation ?></div>
                            <?php endif; ?>
                            
                            <!-- Mutual Friends Display -->
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-user-friends mr-1"></i>
                                <span><?= $suggestion->mutual_friends_count ?> mutual friend<?= $suggestion->mutual_friends_count != 1 ? 's' : '' ?></span>
                                
                                <?php if(!empty($suggestion->mutualFriendsDetails)): ?>
                                    <div class="flex -space-x-1 ml-2">
                                        <?php foreach($suggestion->mutualFriendsDetails as $mutual): ?>
                                            <img src="<?= $mutual->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($mutual->first_name . '+' . $mutual->last_name) . '&size=20&background=667eea&color=fff&rounded=true' ?>" 
                                                 alt="<?= $mutual->first_name ?> <?= $mutual->last_name ?>" 
                                                 class="w-5 h-5 rounded-full border border-white object-cover"
                                                 title="<?= $mutual->first_name ?> <?= $mutual->last_name ?>">
                                        <?php endforeach; ?>
                                        
                                        <?php if($suggestion->mutual_friends_count > count($suggestion->mutualFriendsDetails)): ?>
                                            <div class="w-5 h-5 rounded-full border border-white bg-gray-300 flex items-center justify-center text-xs text-gray-600">
                                                +<?= $suggestion->mutual_friends_count - count($suggestion->mutualFriendsDetails) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="/users/profile/<?= $suggestion->user_id ?>">
                                <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    View Profile
                                </button>
                            </a>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors send-friend-request" 
                                    data-user-id="<?= $suggestion->user_id ?>">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-users fa-3x mb-4"></i>
                    <p>No friend suggestions available</p>
                    <p class="text-sm">Connect with more people to get suggestions!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
            
            </div>
        </div>

        <!-- Replace the script section at the bottom of your friends.view.php with this: -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Friendship system initializing...');

    // Tab switching functionality
    const tabItems = document.querySelectorAll('.tab-item');
    const tabContents = document.querySelectorAll('.tab-content');
    
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
    
    // Tab click handlers
    const allFriendsTab = document.getElementById('allFriendsTab');
    const requestsTab = document.getElementById('requestsTab');
    const findFriendsTabBtn = document.getElementById('findFriendsTabBtn');
    const findFriendsBtn = document.getElementById('findFriendsBtn');
    const findFriendsFromEmpty = document.getElementById('findFriendsFromEmpty');
    
    if (allFriendsTab) {
        allFriendsTab.addEventListener('click', () => switchTab('allFriendsTab', 'allFriendsSection'));
    }
    
    if (requestsTab) {
        requestsTab.addEventListener('click', () => switchTab('requestsTab', 'requestsSection'));
    }
    
    if (findFriendsTabBtn) {
        findFriendsTabBtn.addEventListener('click', () => switchTab('findFriendsTabBtn', 'findFriendsSection'));
    }
    
    if (findFriendsBtn) {
        findFriendsBtn.addEventListener('click', () => switchTab('findFriendsTabBtn', 'findFriendsSection'));
    }
    
    if (findFriendsFromEmpty) {
        findFriendsFromEmpty.addEventListener('click', () => switchTab('findFriendsTabBtn', 'findFriendsSection'));
    }

    // Enhanced button handlers - IMPROVED VERSION
    document.addEventListener('click', function(e) {
        const button = e.target.closest('button');
        if (!button) return;
        
        const buttonText = button.textContent.trim();
        const friendshipId = button.closest('[data-friendship-id]')?.getAttribute('data-friendship-id');
        
        if (!friendshipId) {
            console.error('No friendship ID found for button:', buttonText);
            return;
        }
        
        // Handle Accept button
        if (buttonText.includes('Accept')) {
            e.preventDefault();
            console.log('Accept clicked for friendship:', friendshipId);
            handleFriendRequest(friendshipId, 'accept');
        }
        
        // Handle Decline button  
        else if (buttonText.includes('Decline')) {
            e.preventDefault();
            console.log('Decline clicked for friendship:', friendshipId);
            handleFriendRequest(friendshipId, 'decline');
        }
        
        // Handle Cancel button (NEW)
        else if (buttonText.includes('Cancel')) {
            e.preventDefault();
            console.log('Cancel clicked for friendship:', friendshipId);
            
            // Show confirmation dialog
            if (confirm('Are you sure you want to cancel this friend request?')) {
                handleCancelRequest(friendshipId);
            }
        }
    });

    // Search functionality
    const searchInput = document.querySelector('input[placeholder*="Search friends"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const friendCards = document.querySelectorAll('.bg-gray-50');
            
            friendCards.forEach(card => {
                const nameElement = card.querySelector('.font-semibold');
                if (nameElement) {
                    const name = nameElement.textContent.toLowerCase();
                    if (name.includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    }
    
    console.log('Friendship system initialized successfully');
});

/**
 * Handle friend request accept/decline - EXISTING FUNCTION
 */
async function handleFriendRequest(friendshipId, action) {
    console.log('Processing friendship request:', friendshipId, action);
    
    // Validate inputs
    if (!friendshipId || !action) {
        console.error('Missing friendship ID or action');
        showNotification('Invalid request data', 'error');
        return;
    }
    
    // Find the request element
    const requestElement = document.querySelector(`[data-friendship-id="${friendshipId}"]`);
    if (!requestElement) {
        console.error('Request element not found');
        showNotification('Request element not found', 'error');
        return;
    }
    
    // Show loading state
    requestElement.style.opacity = '0.6';
    requestElement.style.pointerEvents = 'none';
    
    // Find and disable buttons
    const buttons = requestElement.querySelectorAll('button');
    buttons.forEach(btn => {
        btn.disabled = true;
        if (btn.textContent.includes('Accept')) {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
        }
    });
    
    try {
        console.log('Sending request to /api/friendship/handle');
        
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
        
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Server response:', data);
        
        if (data.success) {
            showNotification(data.message, 'success');
            
            // Remove the request from UI with animation
            requestElement.style.transition = 'all 0.5s ease';
            requestElement.style.opacity = '0';
            requestElement.style.height = '0px';
            requestElement.style.marginBottom = '0px';
            requestElement.style.paddingTop = '0px';
            requestElement.style.paddingBottom = '0px';
            
            setTimeout(() => {
                requestElement.remove();
                updateRequestCounter();
                
                // Check if no more requests
                const remainingRequests = document.querySelectorAll('[data-friendship-id]');
                if (remainingRequests.length === 0) {
                    const container = document.getElementById('friendRequestsContainer');
                    if (container) {
                        container.innerHTML = `
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-user-plus fa-3x mb-4"></i>
                                <p>No pending friend requests</p>
                            </div>
                        `;
                    }
                }
            }, 500);
            
        } else {
            throw new Error(data.message || 'Unknown error occurred');
        }
        
    } catch (error) {
        console.error('Request failed:', error);
        showNotification(error.message || 'Network error. Please try again.', 'error');
        
        // Restore element state
        requestElement.style.opacity = '1';
        requestElement.style.pointerEvents = 'auto';
        
        // Restore buttons
        buttons.forEach(btn => {
            btn.disabled = false;
            if (btn.textContent.includes('Processing')) {
                btn.innerHTML = '<i class="fas fa-check mr-2"></i> Accept';
            }
        });
    }
}

/**
 * Handle cancel sent friend request - NEW FUNCTION
 */
async function handleCancelRequest(friendshipId) {
    console.log('Canceling friendship request:', friendshipId);
    
    // Validate input
    if (!friendshipId) {
        console.error('Missing friendship ID');
        showNotification('Invalid request data', 'error');
        return;
    }
    
    // Find the request element
    const requestElement = document.querySelector(`[data-friendship-id="${friendshipId}"]`);
    if (!requestElement) {
        console.error('Request element not found');
        showNotification('Request element not found', 'error');
        return;
    }
    
    // Show loading state
    requestElement.style.opacity = '0.6';
    requestElement.style.pointerEvents = 'none';
    
    // Find and update cancel button
    const cancelButton = requestElement.querySelector('.cancel-request-btn');
    if (cancelButton) {
        cancelButton.disabled = true;
        cancelButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Canceling...';
    }
    
    try {
        console.log('Sending cancel request to /api/friendship/cancel');
        
        const response = await fetch('/api/friendship/cancel', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                friendship_id: parseInt(friendshipId)
            })
        });
        
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Server response:', data);
        
        if (data.success) {
            showNotification(data.message, 'success');
            
            // Remove the request from UI with animation
            requestElement.style.transition = 'all 0.5s ease';
            requestElement.style.opacity = '0';
            requestElement.style.height = '0px';
            requestElement.style.marginBottom = '0px';
            requestElement.style.paddingTop = '0px';
            requestElement.style.paddingBottom = '0px';
            
            setTimeout(() => {
                requestElement.remove();
                updateSentRequestCounter();
                
                // Check if no more sent requests
                const remainingSentRequests = document.querySelectorAll('.sent-request-item');
                if (remainingSentRequests.length === 0) {
                    const container = document.getElementById('sentRequestsContainer');
                    if (container) {
                        container.innerHTML = `
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-paper-plane fa-3x mb-4"></i>
                                <p>No pending sent requests</p>
                            </div>
                        `;
                    }
                }
            }, 500);
            
        } else {
            throw new Error(data.message || 'Unknown error occurred');
        }
        
    } catch (error) {
        console.error('Cancel request failed:', error);
        showNotification(error.message || 'Network error. Please try again.', 'error');
        
        // Restore element state
        requestElement.style.opacity = '1';
        requestElement.style.pointerEvents = 'auto';
        
        // Restore cancel button
        if (cancelButton) {
            cancelButton.disabled = false;
            cancelButton.innerHTML = '<i class="fas fa-times mr-2"></i> Cancel';
        }
    }
}

/**
 * Update received request counter
 */
function updateRequestCounter() {
    const badge = document.querySelector('#requestsTab span');
    if (badge) {
        let count = parseInt(badge.textContent) || 0;
        count = Math.max(0, count - 1);
        badge.textContent = count;
        
        if (count === 0) {
            badge.style.display = 'none';
        }
    }
}

/**
 * Update sent request counter - NEW FUNCTION
 */
function updateSentRequestCounter() {
    // Update the sent requests count display if you have one
    const sentCountElement = document.querySelector('.sent-requests-count');
    if (sentCountElement) {
        let count = parseInt(sentCountElement.textContent) || 0;
        count = Math.max(0, count - 1);
        sentCountElement.textContent = count;
    }
}

/**
 * Show notification
 */
function showNotification(message, type = 'info') {
    // Remove existing notifications
    document.querySelectorAll('.notification-toast').forEach(n => n.remove());
    
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
document.addEventListener('click', function(e) {
    const button = e.target.closest('button');
    if (!button) return;
    
    // Handle existing Accept, Decline, Cancel buttons (keep existing code)
    const buttonText = button.textContent.trim();
    const friendshipId = button.closest('[data-friendship-id]')?.getAttribute('data-friendship-id');
    
    if (friendshipId) {
        // Existing friendship handling code (keep as is)
        if (buttonText.includes('Accept')) {
            e.preventDefault();
            handleFriendRequest(friendshipId, 'accept');
        }
        else if (buttonText.includes('Decline')) {
            e.preventDefault();
            handleFriendRequest(friendshipId, 'decline');
        }
        else if (buttonText.includes('Cancel')) {
            e.preventDefault();
            if (confirm('Are you sure you want to cancel this friend request?')) {
                handleCancelRequest(friendshipId);
            }
        }
    }
    
    // NEW: Handle send friend request for suggestions
    if (button.classList.contains('send-friend-request')) {
        e.preventDefault();
        const userId = button.getAttribute('data-user-id');
        if (userId) {
            handleSendFriendRequest(userId, button);
        }
    }
});

/**
 * Send friend request to suggested user - NEW FUNCTION
 */
async function handleSendFriendRequest(userId, button) {
    console.log('Sending friend request to user:', userId);
    
    // Show loading state
    const originalHTML = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
    
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
            button.innerHTML = '<i class="fas fa-clock mr-2"></i>Request Sent';
            button.classList.remove('bg-orange-500', 'hover:bg-orange-600', 'send-friend-request');
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
</script>

    <?= loadPartial('scripts'); ?>
    <?= loadPartial('footer'); ?>
</body>
</html>