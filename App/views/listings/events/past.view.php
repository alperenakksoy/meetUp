<?php
// Set page variables
$pageTitle = 'Past Events - SocialLoop';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body class="bg-gray-50">
<?php loadPartial('navbar') ?>

<!-- Main Content -->
<div class="container max-w-7xl mx-auto px-4 py-8 mt-20">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Past Events Archive</h1>
                <p class="text-gray-600">Browse through events you've attended and leave reviews</p>
            </div>
            <a href="/events" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Events</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Filters Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                
                <!-- Role Filter -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">My Role</label>
                    <select id="role-filter" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="all">All Events</option>
                        <option value="hosted">Events I Hosted</option>
                        <option value="attended">Events I Attended</option>
                    </select>
                </div>

                <!-- Date Range -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                    <div class="space-y-2">
                        <input type="date" id="date-from" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <input type="date" id="date-to" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <!-- Categories -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <div class="space-y-2">
                        <?php 
                        $categories = ['coffee' => 'Coffee & Drinks', 'cultural' => 'Cultural', 'sports' => 'Sports & Outdoor', 
                                      'language' => 'Language Exchange', 'food' => 'Food & Dining', 'art' => 'Art & Music', 
                                      'tech' => 'Technology'];
                        foreach($categories as $value => $label): 
                        ?>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" value="<?= $value ?>" class="rounded text-orange-500 focus:ring-orange-500">
                            <span class="text-sm"><?= $label ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Apply/Reset Buttons -->
                <div class="flex gap-2">
                    <button id="apply-filters" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg transition duration-200">
                        Apply
                    </button>
                    <button id="reset-filters" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg transition duration-200">
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Events Content -->
        <div class="lg:col-span-3">
            <!-- Search Bar -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="search-input" placeholder="Search events..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <select id="sort-select" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="date_desc">Date (Newest)</option>
                        <option value="date_asc">Date (Oldest)</option>
                        <option value="rating_desc">Rating (Highest)</option>
                        <option value="attendees_desc">Attendees (Most)</option>
                    </select>
                </div>
            </div>

            <!-- Events List -->
            <?php if(count($events) > 0): ?>
                <div class="space-y-4">
                    <?php foreach($events as $event): ?>
                        <!-- Event Card -->
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <!-- Event Image -->
                                <div class="md:w-48 h-48 md:h-auto relative">
                                    <img src="<?= getEventImage($event) ?>" 
                                         alt="<?= htmlspecialchars($event->title) ?>" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute top-2 right-2 <?= getCategoryColor($event->category) ?> text-white px-3 py-1 rounded-full text-xs">
                                        <?= ucfirst($event->category ?? 'Event') ?>
                                    </div>
                                </div>
                                
                                <!-- Event Details -->
                                <div class="flex-1 p-6">
                                    <div class="flex flex-col md:flex-row justify-between gap-4">
                                        <div class="flex-1">
                                            <!-- Title and Host Badge -->
                                            <div class="flex items-start gap-3 mb-3">
                                                <h3 class="text-xl font-semibold text-gray-800">
                                                    <?= htmlspecialchars($event->title) ?>
                                                </h3>
                                                <?php if($event->host_id == ($_SESSION['user_id'] ?? 0)): ?>
                                                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">Hosted</span>
                                                <?php else: ?>
                                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">Attended</span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Event Meta -->
                                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                                <div class="flex items-center gap-2">
                                                    <i class="far fa-calendar w-4"></i>
                                                    <span><?= reDate($event->event_date) ?></span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-map-marker-alt w-4"></i>
                                                    <span><?= htmlspecialchars($event->location_name) ?>, <?= htmlspecialchars($event->city) ?></span>
                                                </div>
                                            </div>
                                            
                                            <!-- Stats -->
                                            <div class="flex flex-wrap gap-4 text-sm">
                                                <div class="flex items-center gap-1">
                                                    <i class="fas fa-users text-orange-500"></i>
                                                    <span><?= $event->attendee_count ?? 0 ?> attended</span>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <i class="fas fa-star text-orange-500"></i>
                                                    <span><?= number_format($event->average_rating ?? 0, 1) ?>/5</span>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <i class="fas fa-comment text-orange-500"></i>
                                                    <span><?= $event->review_count ?? 0 ?> reviews</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Action Button -->
                                        <div class="flex items-center">
                                            <a href="/events/reviews/<?= $event->event_id ?>" 
                                               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                                                <i class="fas fa-eye"></i>
                                                <span>View Details</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav class="flex items-center gap-1">
                        <button class="px-3 py-2 rounded-lg hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 rounded-lg bg-orange-500 text-white">1</button>
                        <button class="px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-200">2</button>
                        <button class="px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-200">3</button>
                        <span class="px-2">...</span>
                        <button class="px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-200">10</button>
                        <button class="px-3 py-2 rounded-lg hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Past Events Found</h3>
                    <p class="text-gray-500 mb-6">You haven't attended any events yet.</p>
                    <a href="/events" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg inline-block transition duration-200">
                        Browse Upcoming Events
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('search-input').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const eventCards = document.querySelectorAll('.bg-white.rounded-lg.shadow-sm.hover\\:shadow-md');
    
    eventCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const location = card.querySelector('.fa-map-marker-alt').parentElement.textContent.toLowerCase();
        
        if (title.includes(searchTerm) || location.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Filter functionality
document.getElementById('apply-filters').addEventListener('click', function() {
    // This would typically make an AJAX request to filter events
    console.log('Applying filters...');
});

document.getElementById('reset-filters').addEventListener('click', function() {
    document.getElementById('role-filter').value = 'all';
    document.getElementById('date-from').value = '';
    document.getElementById('date-to').value = '';
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
});

// Sort functionality
document.getElementById('sort-select').addEventListener('change', function(e) {
    console.log('Sorting by:', e.target.value);
    // This would typically reorder the events
});
</script>

<?= loadPartial('footer'); ?>
</body>
</html>