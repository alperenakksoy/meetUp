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
                <input type="text" id="friendsSearch" class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search friends...">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <div class="flex flex-wrap gap-4">
                <select id="locationFilter" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">All Locations</option>
                    <option value="istanbul">Istanbul</option>
                    <option value="ankara">Ankara</option>
                    <option value="izmir">Izmir</option>
                    <option value="international">International</option>
                </select>
                <select id="interestFilter" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">All Interests</option>
                    <option value="travel">Travel</option>
                    <option value="photography">Photography</option>
                    <option value="food">Food</option>
                    <option value="sports">Sports</option>
                    <option value="culture">Culture</option>
                </select>
                <select id="sortBy" class="p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
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
                Requests <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1"><?= count($pendingRequests ?? []) ?></span>
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
                            <div class="friend-card bg-gray-50 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                                <div class="h-24 bg-gradient-to-r from-orange-200 to-purple-200"></div>
                                <div class="relative">
                                    <img src="<?= htmlspecialchars($friend->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($friend->first_name . '+' . $friend->last_name) . '&size=80&background=667eea&color=fff&rounded=true') ?>" 
                                         alt="<?= htmlspecialchars($friend->first_name . ' ' . $friend->last_name) ?>" 
                                         class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2 object-cover">
                                </div>
                                <div class="p-4 pt-12 text-center">
                                    <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($friend->first_name . ' ' . $friend->last_name) ?></h3>
                                    <div class="text-sm text-gray-600 flex items-center justify-center">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?= htmlspecialchars("{$friend->city}, {$friend->country}") ?>
                                    </div>
                                    <div class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($friend->occupation ?? 'Professional') ?></div>
                                    
                                    <!-- Mutual Friends Section -->
                                    <div class="flex justify-center mt-2">
                                        <?php if(!empty($friend->mutualFriendsDetails) && count($friend->mutualFriendsDetails) > 0): ?>
                                            <div class="flex -space-x-2">
                                                <?php foreach($friend->mutualFriendsDetails as $mutualFriend): ?>
                                                    <img src="<?= htmlspecialchars($mutualFriend->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($mutualFriend->first_name . '+' . $mutualFriend->last_name) . '&size=24&background=667eea&color=fff&rounded=true') ?>" 
                                                         alt="<?= htmlspecialchars($mutualFriend->first_name . ' ' . $mutualFriend->last_name) ?>" 
                                                         class="w-6 h-6 rounded-full border-2 border-white object-cover"
                                                         title="<?= htmlspecialchars($mutualFriend->first_name . ' ' . $mutualFriend->last_name) ?>">
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
                                        <button class="message-btn border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors" data-user-id="<?= $friend->user_id ?>">Message</button>
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

        <!-- Requests Section -->
        <div id="requestsSection" class="tab-content hidden">
            <!-- Received Friend Requests -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Friend Requests</h2>
                    <span class="text-sm text-gray-500"><?= count($pendingRequests ?? []) ?> pending requests</span>
                </div>
                <div class="space-y-4">
                    <?php if(!empty($pendingRequests)): ?>
                        <?php foreach($pendingRequests as $request): ?>
                            <div class="request-item flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50" data-request-id="<?= $request->request_id ?? $request->user_id ?>">
                                <div class="flex items-center">
                                    <!-- Clickable profile picture with hover effect -->
                                    <a href="/users/profile/<?= $request->user_id ?>" class="group relative">
                                        <img src="<?= htmlspecialchars($request->profile_picture ?? '/uploads/profiles/default_profile.png') ?>" 
                                            alt="<?= htmlspecialchars($request->first_name . ' ' . $request->last_name) ?>" 
                                            class="w-12 h-12 rounded-full mr-4 object-cover border-2 border-transparent group-hover:border-orange-500 transition-all">
                                    </a>
                                    <div>
                                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($request->first_name . ' ' . $request->last_name) ?></div>
                                        <?php if(($request->mutualFriends ?? 0) > 0): ?>
                                            <div class="text-sm text-gray-600">
                                                <i class="fas fa-user-friends mr-1"></i> <?= $request->mutualFriends ?> mutual friends
                                            </div>
                                        <?php endif; ?>
                                        <div class="text-sm text-gray-500"><?= isset($request->created_at) ? timeSince($request->created_at) : '2 days ago' ?></div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="accept-btn bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center transition-colors" data-user-id="<?= $request->user_id ?>">
                                        <i class="fas fa-check mr-2"></i> Accept
                                    </button>
                                    <button class="decline-btn bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center transition-colors" data-user-id="<?= $request->user_id ?>">
                                        <i class="fas fa-times mr-2"></i> Decline
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox fa-3x mb-4"></i>
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
                            <div class="sent-request-item flex items-center justify-between p-4 border border-gray-200 rounded-lg" data-request-id="<?= $request->request_id ?? $request->user_id_2 ?>">
                                <div class="flex items-center">
                                    <!-- Clickable profile picture with hover effect -->
                                    <a href="/users/profile/<?= $request->user_id_2 ?>" class="group relative">
                                        <img src="<?= htmlspecialchars($request->profile_picture ?? '/uploads/profiles/default_profile.png') ?>" 
                                            alt="<?= htmlspecialchars($request->first_name . ' ' . $request->last_name) ?>" 
                                            class="w-12 h-12 rounded-full mr-4 object-cover border-2 border-transparent group-hover:border-orange-500 transition-all">
                                    </a>
                                    <div>
                                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($request->first_name . ' ' . $request->last_name) ?></div>
                                        <?php if(!empty($request->mutuals) && count($request->mutuals) > 0): ?>
                                            <div class="text-sm text-gray-600">
                                                <i class="fas fa-user-friends mr-1"></i> <?= count($request->mutuals) ?> mutual friends
                                            </div>
                                        <?php endif; ?>
                                        <div class="text-sm text-gray-500">Sent <?= isset($request->created_at) ? timeSince($request->created_at) : 'recently' ?></div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg text-sm">Pending</span>
                                    <button class="cancel-request-btn bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center transition-colors" data-user-id="<?= $request->user_id_2 ?>">
                                        <i class="fas fa-times mr-2"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-paper-plane fa-3x mb-4"></i>
                            <p>No sent requests</p>
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
                        <select id="findLocationFilter" class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="">Filter by Location</option>
                            <option value="istanbul">Istanbul</option>
                            <option value="ankara">Ankara</option>
                            <option value="izmir">Izmir</option>
                        </select>
                        <select id="findInterestFilter" class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="suggestedFriends">
                        <?php if(!empty($suggestedFriends)): ?>
                            <?php foreach($suggestedFriends as $suggestion): ?>
                                <div class="suggestion-card flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50" data-user-id="<?= $suggestion->user_id ?>">
                                    <img src="<?= htmlspecialchars($suggestion->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($suggestion->first_name . '+' . $suggestion->last_name) . '&size=64&background=667eea&color=fff&rounded=true') ?>" 
                                         alt="<?= htmlspecialchars($suggestion->first_name . ' ' . $suggestion->last_name) ?>" 
                                         class="w-16 h-16 rounded-full mr-4 object-cover">
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($suggestion->first_name . ' ' . $suggestion->last_name) ?></div>
                                        <div class="text-sm text-gray-600 mb-1">
                                            <i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($suggestion->city . ', ' . $suggestion->country) ?>
                                        </div>
                                        <div class="text-sm text-gray-500 mb-2"><?= htmlspecialchars($suggestion->occupation ?? 'Professional') ?></div>
                                        <?php if(($suggestion->mutualFriends ?? 0) > 0): ?>
                                            <div class="text-xs text-gray-500">
                                                <i class="fas fa-user-friends mr-1"></i><?= $suggestion->mutualFriends ?> mutual friends
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <button class="add-friend-btn bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors" data-user-id="<?= $suggestion->user_id ?>">
                                        <i class="fas fa-user-plus mr-2"></i> Add Friend
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default suggestions for demo -->
                            <div class="suggestion-card flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Suggested Friend" class="w-16 h-16 rounded-full mr-4 object-cover">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">Lisa Martinez</div>
                                    <div class="text-sm text-gray-600 mb-1">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Madrid, Spain
                                    </div>
                                    <div class="text-sm text-gray-500 mb-2">Travel blogger, Photography enthusiast</div>
                                    <div class="text-xs text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>3 mutual friends
                                    </div>
                                </div>
                                <button class="add-friend-btn bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                    <i class="fas fa-user-plus mr-2"></i> Add Friend
                                </button>
                            </div>

                            <div class="suggestion-card flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Suggested Friend" class="w-16 h-16 rounded-full mr-4 object-cover">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">Marco Rossi</div>
                                    <div class="text-sm text-gray-600 mb-1">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Rome, Italy
                                    </div>
                                    <div class="text-sm text-gray-500 mb-2">Chef, Food culture explorer</div>
                                    <div class="text-xs text-gray-500">
                                        <i class="fas fa-user-friends mr-1"></i>2 mutual friends
                                    </div>
                                </div>
                                <button class="add-friend-btn bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                    <i class="fas fa-user-plus mr-2"></i> Add Friend
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Search Results -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Search Results</h3>
                    <div class="relative mb-4">
                        <input type="text" id="findFriendsSearch" class="w-full p-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search by name, email, or interests...">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <div class="space-y-4" id="searchResults">
                        <!-- Search results will be populated here -->
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-search fa-3x mb-4"></i>
                            <p>Enter a search term to find friends</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
            
            // Tab click handlers
            document.getElementById('allFriendsTab').addEventListener('click', function() {
                switchTab('allFriendsTab', 'allFriendsSection');
            });
            
            document.getElementById('requestsTab').addEventListener('click', function() {
                switchTab('requestsTab', 'requestsSection');
            });
            
            document.getElementById('findFriendsTabBtn').addEventListener('click', function() {
                switchTab('findFriendsTabBtn', 'findFriendsSection');
            });
            
            // Find Friends button in header
            document.getElementById('findFriendsBtn').addEventListener('click', function() {
                switchTab('findFriendsTabBtn', 'findFriendsSection');
            });

            // Find Friends button from empty state
            const findFriendsFromEmpty = document.getElementById('findFriendsFromEmpty');
            if (findFriendsFromEmpty) {
                findFriendsFromEmpty.addEventListener('click', function() {
                    switchTab('findFriendsTabBtn', 'findFriendsSection');
                });
            }

            // Accept/Decline button functionality
            document.querySelectorAll('.accept-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    const requestItem = this.closest('.request-item');
                    
                    // Here you would make an AJAX call to accept the friend request
                    // For now, we'll just update the UI
                    requestItem.style.opacity = '0.6';
                    this.innerHTML = '<i class="fas fa-check mr-2"></i> Accepted';
                    this.disabled = true;
                    this.classList.add('opacity-75', 'cursor-not-allowed');
                    
                    // Hide decline button
                    const declineBtn = requestItem.querySelector('.decline-btn');
                    if (declineBtn) {
                        declineBtn.style.display = 'none';
                    }
                    
                    // Update the requests count
                    updateRequestsCount(-1);
                });
            });

            document.querySelectorAll('.decline-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    const requestItem = this.closest('.request-item');
                    
                    // Here you would make an AJAX call to decline the friend request
                    // For now, we'll just update the UI
                    requestItem.style.display = 'none';
                    
                    // Update the requests count
                    updateRequestsCount(-1);
                });
            });

            // Cancel request functionality
            document.querySelectorAll('.cancel-request-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    const requestItem = this.closest('.sent-request-item');
                    
                    // Here you would make an AJAX call to cancel the friend request
                    // For now, we'll just update the UI
                    requestItem.style.display = 'none';
                });
            });

            // Add Friend button functionality
            document.querySelectorAll('.add-friend-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    
                    // Here you would make an AJAX call to send a friend request
                    // For now, we'll just update the UI
                    this.innerHTML = '<i class="fas fa-clock mr-2"></i> Request Sent';
                    this.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                    this.classList.add('bg-gray-400', 'cursor-not-allowed');
                    this.disabled = true;
                });
            });

            // Search functionality for friends list
            const friendsSearchInput = document.getElementById('friendsSearch');
            if (friendsSearchInput) {
                friendsSearchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const friendCards = document.querySelectorAll('.friend-card');
                    
                    friendCards.forEach(card => {
                        const name = card.querySelector('h3');
                        if (name && name.textContent.toLowerCase().includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            // Search functionality for find friends
            const findFriendsSearchInput = document.getElementById('findFriendsSearch');
            if (findFriendsSearchInput) {
                findFriendsSearchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.trim();
                    const searchResults = document.getElementById('searchResults');
                    
                    if (searchTerm.length >= 2) {
                        // Here you would make an AJAX call to search for users
                        // For now, we'll show sample results
                        searchResults.innerHTML = `
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
                                    <button class="add-friend-btn bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                        <i class="fas fa-user-plus mr-2"></i> Add Friend
                                    </button>
                                </div>
                            </div>
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
                                    <button class="add-friend-btn bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 flex items-center transition-colors">
                                        <i class="fas fa-user-plus mr-2"></i> Add Friend
                                    </button>
                                </div>
                            </div>
                        `;
                        
                        // Bind event listeners to new add friend buttons
                        searchResults.querySelectorAll('.add-friend-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                this.innerHTML = '<i class="fas fa-clock mr-2"></i> Request Sent';
                                this.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                                this.classList.add('bg-gray-400', 'cursor-not-allowed');
                                this.disabled = true;
                            });
                        });
                    } else if (searchTerm.length === 0) {
                        searchResults.innerHTML = `
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-search fa-3x mb-4"></i>
                                <p>Enter a search term to find friends</p>
                            </div>
                        `;
                    }
                });
            }

            // Filter functionality
            const locationFilter = document.getElementById('locationFilter');
            const interestFilter = document.getElementById('interestFilter');
            const sortBy = document.getElementById('sortBy');

            if (locationFilter) {
                locationFilter.addEventListener('change', function() {
                    filterFriends();
                });
            }

            if (interestFilter) {
                interestFilter.addEventListener('change', function() {
                    filterFriends();
                });
            }

            if (sortBy) {
                sortBy.addEventListener('change', function() {
                    sortFriends();
                });
            }

            // Filter friends function
            function filterFriends() {
                const locationValue = locationFilter ? locationFilter.value.toLowerCase() : '';
                const interestValue = interestFilter ? interestFilter.value.toLowerCase() : '';
                const friendCards = document.querySelectorAll('.friend-card');

                friendCards.forEach(card => {
                    let showCard = true;
                    
                    if (locationValue) {
                        const location = card.querySelector('.text-gray-600').textContent.toLowerCase();
                        if (!location.includes(locationValue)) {
                            showCard = false;
                        }
                    }
                    
                    // For interest filtering, you would need to add interest data to the cards
                    // This is just a placeholder for the concept
                    
                    card.style.display = showCard ? '' : 'none';
                });
            }

            // Sort friends function
            function sortFriends() {
                const sortValue = sortBy ? sortBy.value : '';
                const friendsContainer = document.querySelector('#allFriendsSection .grid');
                const friendCards = Array.from(document.querySelectorAll('.friend-card'));

                if (sortValue === 'name') {
                    friendCards.sort((a, b) => {
                        const nameA = a.querySelector('h3').textContent.trim();
                        const nameB = b.querySelector('h3').textContent.trim();
                        return nameA.localeCompare(nameB);
                    });

                    // Re-append sorted cards
                    friendCards.forEach(card => {
                        friendsContainer.appendChild(card);
                    });
                }
                // Add more sorting options as needed
            }

            // Message button functionality
            document.querySelectorAll('.message-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    // Here you would redirect to messaging or open a chat modal
                    // For now, we'll just show an alert
                    alert('Opening message for user ID: ' + userId);
                    // In a real application: window.location.href = '/messages/' + userId;
                });
            });

            // Helper function to update requests count
            function updateRequestsCount(change) {
                const countSpan = document.querySelector('#requestsTab span');
                if (countSpan) {
                    const currentCount = parseInt(countSpan.textContent) || 0;
                    const newCount = Math.max(0, currentCount + change);
                    countSpan.textContent = newCount;
                    
                    // Hide the badge if count is 0
                    if (newCount === 0) {
                        countSpan.style.display = 'none';
                    }
                }
            }

            // Initialize tooltips (if you're using a tooltip library)
            // initializeTooltips();
        });

        // AJAX functions for real implementation
        function acceptFriendRequest(userId) {
            return fetch('/api/friends/accept', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error accepting friend request:', error);
                alert('Error accepting friend request. Please try again.');
            });
        }

        function declineFriendRequest(userId) {
            return fetch('/api/friends/decline', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error declining friend request:', error);
                alert('Error declining friend request. Please try again.');
            });
        }

        function sendFriendRequest(userId) {
            return fetch('/api/friends/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error sending friend request:', error);
                alert('Error sending friend request. Please try again.');
            });
        }

        function cancelFriendRequest(userId) {
            return fetch('/api/friends/cancel', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error canceling friend request:', error);
                alert('Error canceling friend request. Please try again.');
            });
        }

        function searchUsers(query) {
            return fetch('/api/users/search', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                params: new URLSearchParams({ q: query })
            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error searching users:', error);
            });
        }
    </script>
    
    <?= loadPartial('scripts'); ?>
    <?= loadPartial('footer'); ?>
</body>
</html>