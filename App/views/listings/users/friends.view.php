<a?php

$pageTitle = 'Dashboard';
$activePage = 'events';
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
            <a href="#" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-user-plus mr-2"></i> Find Friends
            </a>
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
            <div class="px-4 py-2 text-orange-600 border-b-2 border-orange-600 cursor-pointer">All Friends</div>
            <div class="px-4 py-2 text-gray-600 hover:text-orange-600 cursor-pointer flex items-center">
                Requests <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">3</span>
            </div>
        </div>

        <!-- Friend Requests Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Friend Requests</h2>
                <a href="#" class="text-orange-600 hover:underline">See All</a>
            </div>
            <?php foreach($pendingRequests as $request):?>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="<?=$request->profile_picture ?? 'public/uploads/profiles/default_profile.png'?>" alt="Friend" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="font-semibold text-gray-800"><?="{$request->first_name} {$request->last_name}"?></div>
                            <?php if($request->mutualFriends >0):?>
                            <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> <?=$request->mutualFriends?> mutual friends</div>
                            <?php endif;?>
                            <div class="text-sm text-gray-500"><?= timeSince($request->created_at)?></div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center">
                            <i class="fas fa-check mr-2"></i> Accept
                        </button>
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center">
                            <i class="fas fa-times mr-2"></i> Decline
                        </button>
                    </div>
                </div>
                <?php endforeach;?>
                </div>
               
            </div>
        </div>

        <!-- All Friends Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">All Friends (<?=$friendsCount?>)</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Friends Index -->
            <?php foreach($friends as $friend):?>     
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="<?=$friend->profile_picture?>" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800"><?=$friend->first_name?> <?=$friend->last_name?></h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i><?="{$friend->city}, {$friend->country}"?>
                        </div>
                        <div class="text-sm text-gray-500 mt-1"><?=$friend->occupation?></div>
                        <div class="flex justify-center mt-2">
                          <?php foreach($friend->mutualFriendsDetails as $mutualfriend):?>  
                            <div class="flex -space-x-2">
                                <img src="<?=$mutualfriend->profile_picture?>" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                            </div>
                            <?php endforeach;?>
                            <?php if($friend->mutualFriends >0):?>
                            <span class="text-sm text-gray-600 ml-2"><?= $friend->mutualFriends?> mutual friends</span>
                            <?php endif;?>
                        </div>
                        <div class="mt-4 flex justify-center gap-2">
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                           <a href="/users/profile/<?=$friend->user_id?>"> <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button></a>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

    </div>
</body>
</html>

    <script>

        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-item');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
    <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>
