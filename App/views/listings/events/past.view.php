<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>
<!-- Main Content -->
<div class="container max-w-6xl mx-auto px-5 mt-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="font-volkhov text-4xl text-[#2c3e50]">Past Events Archive</h1>
        <a href="/events" class="bg-orange-500 text-white py-2.5 px-5 rounded flex items-center gap-2 hover:bg-orange-400 transition-colors">
            <i class="fas fa-arrow-left"></i> Back to Events
        </a>
    </div>

    <!-- Archive Container -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">
        <!-- Filters Sidebar -->
        <div class="bg-white rounded-lg shadow p-5 lg:col-span-1 h-fit">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Filters</h3>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">My Role</label>
                    <select id="role-filter" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                        <option value="all">All Events</option>
                        <option value="hosted">Events I Hosted</option>
                        <option value="attended">Events I Attended</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">Date Range</label>
                    <div class="flex gap-2">
                        <input type="date" id="date-from" placeholder="From" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                        <input type="date" id="date-to" placeholder="To" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">Location</label>
                    <select id="location-filter" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                        <option value="">All Locations</option>
                        <option value="istanbul">Istanbul</option>
                        <option value="ankara">Ankara</option>
                        <option value="izmir">Izmir</option>
                        <option value="antalya">Antalya</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Categories</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="coffee" class="rounded text-[#f5a623] focus:ring-[#f5a623] category-filter">
                        <span>Coffee & Drinks</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="cultural" class="rounded text-[#f5a623] focus:ring-[#f5a623] category-filter">
                        <span>Cultural</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="outdoor" class="rounded text-[#f5a623] focus:ring-[#f5a623] category-filter">
                        <span>Sports & Outdoor</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="language" class="rounded text-[#f5a623] focus:ring-[#f5a623] category-filter">
                        <span>Language Exchange</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="food" class="rounded text-[#f5a623] focus:ring-[#f5a623] category-filter">
                        <span>Food & Dining</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="art" class="rounded text-[#f5a623] focus:ring-[#f5a623] category-filter">
                        <span>Art & Music</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="tech" class="rounded text-[#f5a623] focus:ring-[#f5a623] category-filter">
                        <span>Technology</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Rating</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="5" class="rounded text-[#f5a623] focus:ring-[#f5a623] rating-filter">
                        <span class="text-[#f5a623]">★★★★★</span> <span>(5 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="4" class="rounded text-[#f5a623] focus:ring-[#f5a623] rating-filter">
                        <span class="text-[#f5a623]">★★★★</span><span class="text-gray-300">★</span> <span>(4 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="3" class="rounded text-[#f5a623] focus:ring-[#f5a623] rating-filter">
                        <span class="text-[#f5a623]">★★★</span><span class="text-gray-300">★★</span> <span>(3 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="2" class="rounded text-[#f5a623] focus:ring-[#f5a623] rating-filter">
                        <span class="text-[#f5a623]">★★</span><span class="text-gray-300">★★★</span> <span>(2 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="1" class="rounded text-[#f5a623] focus:ring-[#f5a623] rating-filter">
                        <span class="text-[#f5a623]">★</span><span class="text-gray-300">★★★★</span> <span>(1 Star)</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-2">
                <button id="apply-filters" class="bg-[#f5a623] text-white py-2 px-4 rounded flex-1 hover:bg-[#e5941d] transition-colors">Apply Filters</button>
                <button id="reset-filters" class="bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded flex-1 hover:bg-gray-100 transition-colors">Reset</button>
            </div>
        </div>

        <!-- Events Content -->
        <div class="lg:col-span-3">
            <!-- Search and Sort Bar -->
            <div class="bg-white rounded-lg shadow p-4 mb-5 flex flex-col md:flex-row md:items-center gap-4">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="search-input" class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]" placeholder="Search events by title, location, etc.">
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600 whitespace-nowrap">Sort by:</span>
                    <select id="sort-select" class="p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                        <option value="date_desc">Date (Newest)</option>
                        <option value="date_asc">Date (Oldest)</option>
                        <option value="rating_desc">Rating (Highest)</option>
                        <option value="attendees_desc">Attendees (Most)</option>
                        <option value="title_asc">Title (A-Z)</option>
                    </select>
                    <div class="flex border border-gray-300 rounded overflow-hidden">
                        <button class="p-2 bg-white hover:bg-gray-100" id="grid-view-btn" title="Grid View">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="p-2 bg-[#f5a623] text-white" id="list-view-btn" title="List View">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Events List View (Default) -->
            <div class="space-y-4" id="events-list-view">
                <?php if(count($events) > 0): ?>
                    <?php foreach($events as $event): ?>
                        <!-- Event Card -->
                        <div class="bg-white rounded-lg shadow flex flex-col md:flex-row overflow-hidden transform transition-transform hover:scale-[1.01] event-item" 
                             data-title="<?= htmlspecialchars($event->title) ?>" 
                             data-location="<?= htmlspecialchars($event->city) ?>" 
                             data-category="<?= htmlspecialchars($event->category ?? 'other') ?>"
                             data-rating="<?= number_format($event->average_rating ?? 0, 1) ?>">
                            
                            <div class="relative w-full md:w-48 h-40">
                                <img src="<?= getEventImage($event) ?>" 
                                     alt="<?= htmlspecialchars($event->title) ?>" 
                                     class="w-full h-full object-cover">
                                <!-- Category Badge on Image -->
                                <div class="absolute top-2 right-2 <?= getCategoryColor($event->category) ?> text-white px-2 py-1 rounded text-xs flex items-center gap-1">
                                    <i class="<?= getCategoryIcon($event->category) ?> text-xs"></i>
                                    <span><?= ucfirst($event->category ?? 'Event') ?></span>
                                </div>
                            </div>
                            
                            <div class="p-4 flex-1">
                                <div class="mb-2">
                                    <span class="inline-block bg-[#3498db] text-white text-xs px-2 py-1 rounded mr-2">
                                        <?= $event->host_id == ($_SESSION['user_id'] ?? 0) ? 'Hosted' : 'Attended' ?>
                                    </span>
                                    <h3 class="inline-block text-lg font-semibold event-title"><?= htmlspecialchars($event->title) ?></h3>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-600 mb-3 event-meta">
                                    <span><i class="far fa-calendar mr-1"></i><?= reDate($event->event_date) ?></span>
                                    <span><i class="far fa-clock mr-1"></i>
                                        <?= reTime($event->start_time) ?> -
                                        <?= reTime($event->end_time ?? '') ?>
                                    </span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($event->location_name) ?>,
                                        <?= htmlspecialchars($event->city) ?>, <?= htmlspecialchars($event->country) ?></span>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm mb-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-users text-[#f5a623] mr-1"></i> <?= $event->attendee_count ?? 0 ?>/<?= $event->capacity ?? 25 ?> Attended
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-comment text-[#f5a623] mr-1"></i> <?= $event->review_count ?> Reviews
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-[#f5a623] mr-1"></i><?= number_format($event->average_rating ?? 0, 1) ?>/5 Rating
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-4 flex md:flex-col gap-2 justify-end bg-gray-50">
                                <a href="/events/reviews/<?= $event->event_id ?>" 
                                   class="bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded text-sm flex items-center gap-1 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-3 text-center py-10">
                        <p class="text-gray-500">No Past events found.</p>
                        <a href="/events/" class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded">Go Back to Events</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Events Grid View (Hidden by default) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 hidden" id="events-grid-view">
                <?php if(count($events) > 0): ?>
                    <?php foreach($events as $event): ?>
                        <!-- Grid Event Card -->
                        <div class="bg-white rounded-lg shadow overflow-hidden transform transition-transform hover:scale-[1.01] event-card" 
                             data-title="<?= htmlspecialchars($event->title) ?>" 
                             data-location="<?= htmlspecialchars($event->city) ?>" 
                             data-category="<?= htmlspecialchars($event->category ?? 'other') ?>"
                             data-rating="<?= number_format($event->average_rating ?? 0, 1) ?>">
                            
                            <div class="relative">
                                <img src="<?= getEventImage($event) ?>" 
                                     alt="<?= htmlspecialchars($event->title) ?>" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-2 right-2 <?= getCategoryColor($event->category) ?> text-white px-2 py-1 rounded text-xs">
                                    <?= ucfirst($event->category ?? 'Event') ?>
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2 event-title"><?= htmlspecialchars($event->title) ?></h3>
                                <div class="text-sm text-gray-600 mb-3 event-meta">
                                    <div class="mb-1">
                                        <i class="far fa-calendar mr-1"></i><?= reDate($event->event_date) ?>
                                    </div>
                                    <div class="mb-1">
                                        <i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($event->city) ?>
                                    </div>
                                    <div>
                                        <i class="fas fa-star mr-1"></i><?= number_format($event->average_rating ?? 0, 1) ?>/5
                                    </div>
                                </div>
                                <a href="/events/reviews/<?= $event->event_id ?>" 
                                   class="block text-center bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition-colors">
                                    View Reviews
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-6">
                <div class="flex">
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-l cursor-pointer hover:bg-gray-100 pagination-item">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 bg-[#f5a623] text-white cursor-pointer pagination-item active">1</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100 pagination-item">2</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100 pagination-item">3</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100 pagination-item">4</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100 pagination-item">5</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 rounded-r cursor-pointer hover:bg-gray-100 pagination-item">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Switcher
    const gridViewBtn = document.getElementById('grid-view-btn');
    const listViewBtn = document.getElementById('list-view-btn');
    const gridView = document.getElementById('events-grid-view');
    const listView = document.getElementById('events-list-view');
    
    gridViewBtn.addEventListener('click', function() {
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        gridViewBtn.classList.add('bg-[#f5a623]', 'text-white');
        gridViewBtn.classList.remove('bg-white');
        listViewBtn.classList.remove('bg-[#f5a623]', 'text-white');
        listViewBtn.classList.add('bg-white');
    });
    
    listViewBtn.addEventListener('click', function() {
        gridView.classList.add('hidden');
        listView.classList.remove('hidden');
        gridViewBtn.classList.remove('bg-[#f5a623]', 'text-white');
        gridViewBtn.classList.add('bg-white');
        listViewBtn.classList.add('bg-[#f5a623]', 'text-white');
        listViewBtn.classList.remove('bg-white');
    });

    // Search functionality
    const searchInput = document.getElementById('search-input');
    searchInput.addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        const listItems = document.querySelectorAll('#events-list-view .event-item');
        const gridItems = document.querySelectorAll('#events-grid-view .event-card');
        
        // Filter list view items
        listItems.forEach(item => {
            const title = item.querySelector('.event-title').textContent.toLowerCase();
            const meta = item.querySelector('.event-meta').textContent.toLowerCase();
            
            if (title.includes(query) || meta.includes(query)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
        
        // Filter grid view items
        gridItems.forEach(item => {
            const title = item.querySelector('.event-title').textContent.toLowerCase();
            const meta = item.querySelector('.event-meta').textContent.toLowerCase();
            
            if (title.includes(query) || meta.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Apply filters
    document.getElementById('apply-filters').addEventListener('click', function() {
        const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked')).map(cb => cb.value);
        const selectedRatings = Array.from(document.querySelectorAll('.rating-filter:checked')).map(cb => cb.value);
        const roleFilter = document.getElementById('role-filter').value;
        const locationFilter = document.getElementById('location-filter').value;
        
        // Filter logic would be implemented here
        // For now, showing an alert for demonstration
        console.log('Applying filters:', {
            categories: selectedCategories,
            ratings: selectedRatings,
            role: roleFilter,
            location: locationFilter
        });
        
        alert('Filters would be applied here. This would trigger an AJAX request to fetch filtered events in a real implementation.');
    });
    
    // Reset filters
    document.getElementById('reset-filters').addEventListener('click', function() {
        // Reset checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Reset selects
        document.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
        });
        
        // Reset date inputs
        document.querySelectorAll('input[type="date"]').forEach(date => {
            date.value = '';
        });
        
        // Reset search
        document.getElementById('search-input').value = '';
        
        // Show all events
        document.querySelectorAll('.event-item, .event-card').forEach(item => {
            item.style.display = '';
        });
    });

    // Pagination
    document.querySelectorAll('.pagination-item').forEach(item => {
        item.addEventListener('click', function() {
            if (!this.classList.contains('active') && !this.querySelector('i')) {
                document.querySelector('.pagination-item.active').classList.remove('active');
                this.classList.add('active');
                
                // In a real implementation, this would load the corresponding page of events
                console.log(`Loading page ${this.textContent}`);
            }
        });
    });

    // Event card click to view details
    document.querySelectorAll('.event-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Prevent click if clicking on a link
            if (e.target.tagName === 'A' || e.target.closest('a')) {
                return;
            }
            
            const eventId = this.querySelector('a').href.split('/').pop();
            window.location.href = `/events/reviews/${eventId}`;
        });
    });
});
</script>

<?= loadPartial('scripts'); ?>
<?= loadPartial('footer'); ?>
</body>
</html>