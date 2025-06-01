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
                Requests <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1"><?= (count($pendingRequests ?? []) + count($sentRequests ?? [])) ?></span>
            </div>
            <div id="findFriendsTabBtn" class="tab-item px-6 py-3 text-gray-600 hover:text-orange-600 cursor-pointer font-medium">
                Find Friends
            </div>
        </div>

        <!-- All Friends Section -->
        <div id="allFriendsSection" class="tab-content">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">All Friends (<?= $friendsCount ?? 156 ?>)</h2>
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
                                    <div class="flex justify-center mt-2">
                                        <div class="flex -space-x-2">
                                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">2 mutual friends</span>
                                    </div>
                                    <div class="mt-4 flex justify-center gap-2">
                                        <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">Message</button>
                                        <a href="/users/profile/<?= $friend->user_id ?>">
                                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">Profile</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Hard-coded examples when no friends data -->
                        <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="h-24 bg-gradient-to-r from-blue-200 to-purple-200"></div>
                            <div class="relative">
                                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2 object-cover">
                            </div>
                            <div class="p-4 pt-12 text-center">
                                <h3 class="font-semibold text-gray-800">Emma Johnson</h3>
                                <div class="text-sm text-gray-600 flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt mr-1"></i>London, UK
                                </div>
                                <div class="text-sm text-gray-500 mt-1">Travel enthusiast, Photography lover</div>
                                <div class="flex justify-center mt-2">
                                    <div class="flex -space-x-2">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">2 mutual friends</span>
                                </div>
                                <div class="mt-4 flex justify-center gap-2">
                                    <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">Message</button>
                                    <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">Profile</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="h-24 bg-gradient-to-r from-green-200 to-blue-200"></div>
                            <div class="relative">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2 object-cover">
                            </div>
                            <div class="p-4 pt-12 text-center">
                                <h3 class="font-semibold text-gray-800">David Wilson</h3>
                                <div class="text-sm text-gray-600 flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Berlin, Germany
                                </div>
                                <div class="text-sm text-gray-500 mt-1">Hiking, Photography, Cultural exploration</div>
                                <div class="flex justify-center mt-2">
                                    <div class="flex -space-x-2">
                                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">3 mutual friends</span>
                                </div>
                                <div class="mt-4 flex justify-center gap-2">
                                    <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">Message</button>
                                    <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">Profile</button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Friend Requests Section -->
        <div id="requestsSection" class="tab-content hidden">
            <!-- Received Requests -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Friend Requests Received</h2>
                    <span class="text-sm text-gray-500"><?= count($pendingRequests ?? []) ?> pending requests</span>
                </div>
                <div class="space-y-4">
                    <?php if(!empty($pendingRequests)): ?>
                        <?php foreach($pendingRequests as $request): ?>
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center">
                                    <img src="<?= $request->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" alt="Friend" class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <div>
                                        <div class="font-semibold text-gray-800"><?= "{$request->first_name} {$request->last_name}" ?></div>
                                        <?php if(($request->mutualFriends ?? 0) > 0): ?>
                                            <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> <?= $request->mutualFriends ?> mutual friends</div>
                                        <?php endif; ?>
                                        <div class="text-sm text-gray-500">2 days ago</div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center transition-colors">
                                        <i class="fas fa-check mr-2"></i> Accept
                                    </button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center transition-colors">
                                        <i class="fas fa-times mr-2"></i> Decline
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Hard-coded examples -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Friend" class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <div class="font-semibold text-gray-800">Thomas Anderson</div>
                                    <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> 3 mutual friends</div>
                                    <div class="text-sm text-gray-500">2 days ago</div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center transition-colors">
                                    <i class="fas fa-check mr-2"></i> Accept
                                </button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center transition-colors">
                                    <i class="fas fa-times mr-2"></i> Decline
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/70.jpg" alt="Friend" class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <div class="font-semibold text-gray-800">Maria Garcia</div>
                                    <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> 5 mutual friends</div>
                                    <div class="text-sm text-gray-500">4 days ago</div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center transition-colors">
                                    <i class="fas fa-check mr-2"></i> Accept
                                </button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center transition-colors">
                                    <i class="fas fa-times mr-2"></i> Decline
                                </button>
                            </div>
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
                                    <img src="<?= $request->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" alt="Friend" class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <div>
                                        <div class="font-semibold text-gray-800"><?= "{$request->first_name} {$request->last_name}" ?></div>
                                        <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> <?= $request->mutuals ?? 0 ?> mutual friends</div>
                                        <div class="text-sm text-gray-500">Sent 3 days ago</div>
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
                        <!-- Hard-coded examples -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Friend" class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <div class="font-semibold text-gray-800">Alex Chen</div>
                                    <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> 1 mutual friend</div>
                                    <div class="text-sm text-gray-500">Sent 1 week ago</div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg text-sm">Pending</span>
                                <button class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center transition-colors">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/87.jpg" alt="Friend" class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <div class="font-semibold text-gray-800">Sarah Kim</div>
                                    <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> 4 mutual friends</div>
                                    <div class="text-sm text-gray-500">Sent 3 days ago</div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg text-sm">Pending</span>
                                <button class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center transition-colors">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </button>
                            </div>
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

            // Accept/Decline button functionality
            document.querySelectorAll('.bg-green-500').forEach(button => {
                button.addEventListener('click', function() {
                    if (this.textContent.includes('Accept')) {
                        this.closest('.flex').style.opacity = '0.6';
                        this.innerHTML = '<i class="fas fa-check mr-2"></i> Accepted';
                        this.disabled = true;
                        this.classList.add('opacity-75', 'cursor-not-allowed');
                        
                        // Hide decline button
                        const declineBtn = this.parentElement.querySelector('.bg-red-500');
                        if (declineBtn) {
                            declineBtn.style.display = 'none';
                        }
                    }
                });
            });

            document.querySelectorAll('.bg-red-500').forEach(button => {
                button.addEventListener('click', function() {
                    if (this.textContent.includes('Decline')) {
                        this.closest('.flex').style.display = 'none';
                    }
                });
            });

            // Add Friend button functionality
            document.querySelectorAll('.bg-orange-500').forEach(button => {
                if (button.textContent.includes('Add Friend')) {
                    button.addEventListener('click', function() {
                        this.innerHTML = '<i class="fas fa-clock mr-2"></i> Request Sent';
                        this.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                        this.classList.add('bg-gray-400', 'cursor-not-allowed');
                        this.disabled = true;
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
        });
    </script>
    
    <?= loadPartial('scripts'); ?>
    <?= loadPartial('footer'); ?>
</body>
</html>