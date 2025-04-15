<?php
require_once __DIR__ . '/../../helpers.php';

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('header') ?>
<!-- Main Content -->
<div class="container mx-auto px-4 py-6 max-w-7xl mt-15">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Events</h1>
        <a href="create_event.php" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition duration-200">
            <i class="fas fa-plus mr-2"></i> Create New Event
        </a>
    </div>

    <!-- Event Categories -->
    <div class="flex space-x-2 mb-6 overflow-x-auto pb-2">
        <div class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer">All Events</div>
        <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer">My Events</div>
        <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer">Attending</div>
        <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer">Saved</div>
        <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer">Past Events</div>
    </div>

    <!-- Filters -->
    <div class="mb-6">
        <div class="flex flex-wrap gap-4 mb-3">
            <div class="flex-1 min-w-[200px]">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <select id="location" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Any Location</option>
                    <option value="istanbul">Istanbul</option>
                    <option value="ankara">Ankara</option>
                    <option value="izmir">Izmir</option>
                    <option value="antalya">Antalya</option>
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" id="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select id="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    <option value="coffee">Coffee & Drinks</option>
                    <option value="cultural">Cultural</option>
                    <option value="sports">Sports & Outdoor</option>
                    <option value="language">Language Exchange</option>
                    <option value="food">Food & Dining</option>
                    <option value="art">Art & Music</option>
                    <option value="tech">Technology</option>
                </select>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <div class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-medium cursor-pointer">Popular</div>
            <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded-full text-xs font-medium cursor-pointer">This Week</div>
            <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded-full text-xs font-medium cursor-pointer">Weekends</div>
            <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded-full text-xs font-medium cursor-pointer">Free</div>
            <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded-full text-xs font-medium cursor-pointer">Morning</div>
            <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded-full text-xs font-medium cursor-pointer">Evening</div>
            <div class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded-full text-xs font-medium cursor-pointer">Beginner Friendly</div>
        </div>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Event Card 1 -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-200 hover:border-orange-500 hover:border">
            <img src="/api/placeholder/400/180" alt="Event Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Host" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-sm font-medium">Ahmet Alperen Aksoy</span>
                </div>
                <h3 class="text-lg font-bold mb-2 hover:text-orange-500 cursor-pointer">Coffee & Cultural Exchange</h3>
                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="far fa-calendar mr-2"></i>
                        <span>April 5, 2025 • 15:00 - 17:00</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>Mandabatmaz Coffee, Kadıköy, Istanbul</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>7 people attending</span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mb-4">
                    Join us for an afternoon of coffee and conversation! Share your travel stories, learn about Turkish culture, and make new friends in a cozy atmosphere.
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded">Coffee</span>
                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Cultural</span>
                    </div>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Join
                    </button>
                </div>
            </div>
        </div>

        <!-- Event Card 2 -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-200 hover:border-orange-500 hover:border">
            <img src="/api/placeholder/400/180" alt="Event Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Host" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-sm font-medium">Olivia Martinez</span>
                </div>
                <h3 class="text-lg font-bold mb-2 hover:text-orange-500 cursor-pointer">Hiking Belgrad Forest</h3>
                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="far fa-calendar mr-2"></i>
                        <span>April 8, 2025 • 09:00 - 14:00</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>Belgrad Forest, Istanbul</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>12 people attending</span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mb-4">
                    Explore the beautiful Belgrad Forest with a group of nature lovers! We'll hike for about 8 km at a moderate pace, with plenty of stops for photos and rest.
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Outdoor</span>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Hiking</span>
                    </div>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Join
                    </button>
                </div>
            </div>
        </div>

        <!-- Event Card 3 -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-200 hover:border-orange-500 hover:border">
            <img src="/api/placeholder/400/180" alt="Event Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Host" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-sm font-medium">David Wilson</span>
                </div>
                <h3 class="text-lg font-bold mb-2 hover:text-orange-500 cursor-pointer">Historical Istanbul Tour</h3>
                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="far fa-calendar mr-2"></i>
                        <span>April 10, 2025 • 10:00 - 15:00</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>Sultanahmet Square, Istanbul</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>15 people attending</span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mb-4">
                    Discover the rich history of Istanbul's old city. We'll visit Hagia Sophia, Blue Mosque, Topkapi Palace, and more. Suitable for history enthusiasts and first-time visitors.
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Cultural</span>
                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">History</span>
                    </div>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Join
                    </button>
                </div>
            </div>
        </div>

        <!-- Event Card 4 -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-200 hover:border-orange-500 hover:border">
            <img src="/api/placeholder/400/180" alt="Event Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Host" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-sm font-medium">Sophie Chen</span>
                </div>
                <h3 class="text-lg font-bold mb-2 hover:text-orange-500 cursor-pointer">Turkish Cooking Workshop</h3>
                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="far fa-calendar mr-2"></i>
                        <span>April 12, 2025 • 18:00 - 21:00</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>Community Kitchen, Beşiktaş, Istanbul</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>8 people attending</span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mb-4">
                    Learn to prepare traditional Turkish dishes with a local chef! We'll make mezze, main courses, and baklava. No prior cooking experience required.
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Food</span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Cooking</span>
                    </div>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Join
                    </button>
                </div>
            </div>
        </div>

        <!-- Event Card 5 -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-200 hover:border-orange-500 hover:border">
            <img src="/api/placeholder/400/180" alt="Event Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Host" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-sm font-medium">Michael Brown</span>
                </div>
                <h3 class="text-lg font-bold mb-2 hover:text-orange-500 cursor-pointer">Language Exchange Meetup</h3>
                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="far fa-calendar mr-2"></i>
                        <span>April 15, 2025 • 19:00 - 22:00</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>Multilingual Cafe, Şişli, Istanbul</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>20 people attending</span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mb-4">
                    Practice languages while meeting new people! English, Turkish, Spanish, French, and more. All levels welcome. Structured activities and free conversation time.
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded">Language</span>
                        <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded">Social</span>
                    </div>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Join
                    </button>
                </div>
            </div>
        </div>

        <!-- Event Card 6 -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-200 hover:border-orange-500 hover:border">
            <img src="/api/placeholder/400/180" alt="Event Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Host" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-sm font-medium">Isabella Johnson</span>
                </div>
                <h3 class="text-lg font-bold mb-2 hover:text-orange-500 cursor-pointer">Bosphorus Sunset Cruise</h3>
                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="far fa-calendar mr-2"></i>
                        <span>April 18, 2025 • 17:30 - 20:30</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>Eminönü Pier, Istanbul</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>25 people attending</span>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mb-4">
                    Experience Istanbul from the water! Join our group for a beautiful sunset cruise along the Bosphorus with drinks, snacks, and amazing photo opportunities.
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">Sightseeing</span>
                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">Social</span>
                    </div>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Join
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center space-x-1">
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 cursor-pointer">
            <i class="fas fa-chevron-left text-gray-600"></i>
        </div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-orange-500 text-white font-medium cursor-pointer">1</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 cursor-pointer">2</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 cursor-pointer">3</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 cursor-pointer">4</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 cursor-pointer">5</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 cursor-pointer">
            <i class="fas fa-chevron-right text-gray-600"></i>
        </div>
    </div>
</div>
    <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>

    <script>
    
        // Join button popup functionality
        document.addEventListener('DOMContentLoaded', function() {
            const joinButtons = document.querySelectorAll('.join-btn');
            const loginPopup = document.getElementById('loginPopup');
            
            joinButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    loginPopup.classList.add('active');
                });
            });
            
            loginPopup.addEventListener('click', function(e) {
                if (e.target === loginPopup) {
                    loginPopup.classList.remove('active');
                }
            });
            
            document.querySelectorAll('.close-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    loginPopup.classList.remove('active');
                });
            });
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && loginPopup.classList.contains('active')) {
                    loginPopup.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
