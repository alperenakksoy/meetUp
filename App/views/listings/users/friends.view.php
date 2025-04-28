<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body class="bg-gray-100">
<?php loadPartial('header') ?>
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
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Friend" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="font-semibold text-gray-800">Thomas Anderson</div>
                            <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> 3 mutual friends</div>
                            <div class="text-sm text-gray-500">2 days ago</div>
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/70.jpg" alt="Friend" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="font-semibold text-gray-800">Maria Garcia</div>
                            <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> 5 mutual friends</div>
                            <div class="text-sm text-gray-500">4 days ago</div>
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Friend" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="font-semibold text-gray-800">John Walker</div>
                            <div class="text-sm text-gray-600"><i class="fas fa-user-friends mr-1"></i> 2 mutual friends</div>
                            <div class="text-sm text-gray-500">1 week ago</div>
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
            </div>
        </div>

        <!-- All Friends Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">All Friends (156)</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Friend 1 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">Emma Johnson</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> London, UK
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
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Friend 2 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">David Wilson</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Berlin, Germany
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
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Friend 3 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">Sophie Chen</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Tokyo, Japan
                        </div>
                        <div class="text-sm text-gray-500 mt-1">Food lover, Cultural experiences</div>
                        <div class="flex justify-center mt-2">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                            </div>
                            <span class="text-sm text-gray-600 ml-2">1 mutual friend</span>
                        </div>
                        <div class="mt-4 flex justify-center gap-2">
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Friend 4 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">Michael Brown</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Istanbul, Turkey
                        </div>
                        <div class="text-sm text-gray-500 mt-1">Hiking, Outdoor activities</div>
                        <div class="flex justify-center mt-2">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                            </div>
                            <span class="text-sm text-gray-600 ml-2">3 mutual friends</span>
                        </div>
                        <div class="mt-4 flex justify-center gap-2">
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Friend 5 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">Olivia Martinez</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Barcelona, Spain
                        </div>
                        <div class="text-sm text-gray-500 mt-1">Art, Museums, Culture</div>
                        <div class="flex justify-center mt-2">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                            </div>
                            <span class="text-sm text-gray-600 ml-2">2 mutual friends</span>
                        </div>
                        <div class="mt-4 flex justify-center gap-2">
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Friend 6 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">James Taylor</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Amsterdam, Netherlands
                        </div>
                        <div class="text-sm text-gray-500 mt-1">Cycling, Coffee, Digital nomad</div>
                        <div class="flex justify-center mt-2">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                            </div>
                            <span class="text-sm text-gray-600 ml-2">4 mutual friends</span>
                        </div>
                        <div class="mt-4 flex justify-center gap-2">
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Friend 7 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">Isabella Johnson</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Rome, Italy
                        </div>
                        <div class="text-sm text-gray-500 mt-1">History, Architecture, Food</div>
                        <div class="flex justify-center mt-2">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                            </div>
                            <span class="text-sm text-gray-600 ml-2">1 mutual friend</span>
                        </div>
                        <div class="mt-4 flex justify-center gap-2">
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
                <!-- Friend 8 -->
                <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                    <div class="h-24 bg-gray-200"></div>
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Friend" class="w-20 h-20 rounded-full border-4 border-white absolute -top-10 left-1/2 transform -translate-x-1/2">
                    </div>
                    <div class="p-4 pt-12 text-center">
                        <h3 class="font-semibold text-gray-800">Alexander Kim</h3>
                        <div class="text-sm text-gray-600 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Seoul, South Korea
                        </div>
                        <div class="text-sm text-gray-500 mt-1">Technology, Street food, Photography</div>
                        <div class="flex justify-center mt-2">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Mutual Friend" class="w-6 h-6 rounded-full border-2 border-white">
                            </div>
                            <span class="text-sm text-gray-600 ml-2">2 mutual friends</span>
                        </div>
                        <div class="mt-4 flex justify-center gap-2">
                            <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-100">Message</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Profile</button>
                        </div>
                    </div>
                </div>
            </div>
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
