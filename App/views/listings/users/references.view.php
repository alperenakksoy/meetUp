<?php
// Set page variables
$pageTitle = 'References';
$activePage = 'profile';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>
<body class="bg-gray-50 pt-20">
    <?=loadPartial('navbar')?>
    <!-- Main Content -->
    <div class="container mx-auto px-4 ">
        <div class="max-w-6xl mx-auto">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div class="flex items-center">
                    <a href="/users/profile/1" class="text-gray-500 hover:text-orange-500 mr-2">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800 font-volkhov">References</h1>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/users/profile/1" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg transition-colors">
                        Back to Profile
                    </a>
                    <div class="bg-gray-200 text-gray-700 py-2 px-4 rounded-lg">
                        <i class="fas fa-star text-orange-500 mr-1"></i>
                        <span class="font-semibold">4.8</span>
                        <span class="text-sm text-gray-500">(5 references)</span>
                    </div>
                </div>
            </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- User Card -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-24"></div>
                    <div class="p-4 text-center relative">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User Profile" class="w-24 h-24 rounded-full border-4 border-white mx-auto absolute -top-12 left-1/2 transform -translate-x-1/2">
                        <div class="mt-14">
                            <h2 class="text-xl font-bold text-gray-800"><?=$user->first_name.' '. $user->last_name?></h2>
                            <div class="flex items-center justify-center text-gray-600 mt-1">
                                <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                                <span><?=$user->city.', '. $user->country?></span>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- Ratings Breakdown -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Ratings Breakdown</h3>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <div class="w-16 flex items-center text-sm">
                                    <i class="fas fa-star text-orange-500 mr-1"></i> 5
                                </div>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-orange-500 h-full" style="width: 80%"></div>
                                </div>
                                <div class="w-8 text-sm text-gray-600 text-right">4</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-16 flex items-center text-sm">
                                    <i class="fas fa-star text-orange-500 mr-1"></i> 4
                                </div>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-orange-500 h-full" style="width: 20%"></div>
                                </div>
                                <div class="w-8 text-sm text-gray-600 text-right">1</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-16 flex items-center text-sm">
                                    <i class="fas fa-star text-orange-500 mr-1"></i> 3
                                </div>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-orange-500 h-full" style="width: 0%"></div>
                                </div>
                                <div class="w-8 text-sm text-gray-600 text-right">0</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-16 flex items-center text-sm">
                                    <i class="fas fa-star text-orange-500 mr-1"></i> 2
                                </div>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-orange-500 h-full" style="width: 0%"></div>
                                </div>
                                <div class="w-8 text-sm text-gray-600 text-right">0</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-16 flex items-center text-sm">
                                    <i class="fas fa-star text-orange-500 mr-1"></i> 1
                                </div>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-orange-500 h-full" style="width: 0%"></div>
                                </div>
                                <div class="w-8 text-sm text-gray-600 text-right">0</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Common Tags -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Most Mentioned</h3>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-wrap gap-2">
                            <div class="bg-gray-100 py-1 px-3 rounded-full text-sm flex items-center">
                                <i class="fas fa-thumbs-up text-orange-500 mr-1"></i> Knowledgeable
                            </div>
                            <div class="bg-gray-100 py-1 px-3 rounded-full text-sm flex items-center">
                                <i class="fas fa-thumbs-up text-orange-500 mr-1"></i> Friendly
                            </div>
                            <div class="bg-gray-100 py-1 px-3 rounded-full text-sm flex items-center">
                                <i class="fas fa-thumbs-up text-orange-500 mr-1"></i> Welcoming
                            </div>
                            <div class="bg-gray-100 py-1 px-3 rounded-full text-sm flex items-center">
                                <i class="fas fa-thumbs-up text-orange-500 mr-1"></i> Helpful
                            </div>
                            <div class="bg-gray-100 py-1 px-3 rounded-full text-sm flex items-center">
                                <i class="fas fa-thumbs-up text-orange-500 mr-1"></i> Patient
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Options -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Filter References</h3>
                    </div>
                    <div class="p-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">By Rating</label>
                            <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="all">All Ratings</option>
                                <option value="5">5 Star Only</option>
                                <option value="4">4 Star Only</option>
                                <option value="3">3 Star Only</option>
                                <option value="2">2 Star Only</option>
                                <option value="1">1 Star Only</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">By Event</label>
                            <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="all">All Events</option>
                                <option value="201">Bosphorus Sunset Cruise</option>
                                <option value="202">Historical Istanbul Tour</option>
                                <option value="203">Coffee & Cultural Exchange</option>
                                <option value="204">Turkish Cooking Workshop</option>
                                <option value="205">Language Exchange Meetup</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">By Date</label>
                            <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                            </select>
                        </div>
                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded transition-colors">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- References List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <!-- Search Box -->
                    <div class="p-4 border-b border-gray-100">
                        <div class="relative">
                            <input type="text" placeholder="Search references..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- References -->
                    <div class="divide-y divide-gray-100">
                        <?php foreach($reviews as $review):?>
                        <!-- References -->
                        <div class="p-5">
                            <div class="flex gap-4 mb-4">
                                <?= inspectAndDie($review->reviewer_profile_picture);?>
                            <img src="/uploads/profiles/<?=$review->reviewer_profile_picture ?? 'default_profile.png' ?>" alt="<?=$review->reviewer_first_name.' '. $review->reviewer_last_name?>" class="w-12 h-12 rounded-full object-cover">
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <a href="#" class="font-semibold text-gray-800 hover:text-orange-500"><?=$review->reviewer_first_name.' '. $review->reviewer_last_name?></a>
                                            <div class="text-sm text-gray-600"><?=$reviewer[$review->reviewer_id]->city.', '. $reviewer[$review->reviewer_id]->country?></div>
                                        </div>
                                        <div class="flex items-center">
                                        <div class="flex text-orange-500">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($i <= $review->rating): ?>
                                     <i class="fas fa-star"></i>
                                 <?php else: ?>
                                 <i class="far fa-star"></i>
                                 <?php endif; ?>
                                  <?php endfor; ?>
                                                </div>
                                            <div class="text-xs text-gray-500 ml-2"><?=reDate($review->created_at)?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <a href="#" class="text-sm text-gray-600 hover:text-orange-500">
                                    <i class="far fa-calendar mr-1"></i> <?=$review->event_title.' '.'('.reDate($review->event_date).')'?> 
                                </a>
                            </div>

                            <div class="mb-4">
                                <p class="text-gray-700"><?=$review->content?></p>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded">Knowledgeable</span>
                                <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded">Friendly</span>
                                <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded">Welcoming</span>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center p-4 border-t border-gray-100">
                        <div class="flex">
                            <a href="#" class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-l cursor-pointer hover:bg-gray-100">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 bg-orange-500 text-white cursor-pointer">1</a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100">2</a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 rounded-r cursor-pointer hover:bg-gray-100">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=loadPartial(name: 'footer'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search Functionality
        const searchInput = document.querySelector('input[placeholder="Search references..."]');
        const referenceItems = document.querySelectorAll('.divide-y.divide-gray-100 > div');
        
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            
            referenceItems.forEach(item => {
                const content = item.textContent.toLowerCase();
                
                if (content.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Filter Functionality
        const filterSelects = document.querySelectorAll('select');
        const applyFilterBtn = document.querySelector('button');
        
        applyFilterBtn.addEventListener('click', function() {
            // In a real application, you would apply filters based on select values
            alert('Filters would be applied in a real application');
        });
    });
</script>
</body>
</html>