<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('header') ?>
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
                    <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                        <option value="all">All Events</option>
                        <option value="hosted">Events I Hosted</option>
                        <option value="attended">Events I Attended</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">Date Range</label>
                    <div class="flex gap-2">
                        <input type="date" placeholder="From" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                        <input type="date" placeholder="To" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">Location</label>
                    <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
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
                        <input type="checkbox" value="coffee" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span>Coffee & Drinks</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="cultural" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span>Cultural</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="outdoor" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span>Sports & Outdoor</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="language" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span>Language Exchange</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="food" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span>Food & Dining</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="art" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span>Art & Music</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="tech" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span>Technology</span>
                    </label>
                </div>
            </div>

<<<<<<< HEAD
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Rating</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="5" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span class="text-[#f5a623]">★★★★★</span> <span>(5 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="4" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span class="text-[#f5a623]">★★★★</span><span class="text-gray-300">★</span> <span>(4 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="3" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span class="text-[#f5a623]">★★★</span><span class="text-gray-300">★★</span> <span>(3 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="2" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span class="text-[#f5a623]">★★</span><span class="text-gray-300">★★★</span> <span>(2 Stars)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="1" class="rounded text-[#f5a623] focus:ring-[#f5a623]">
                        <span class="text-[#f5a623]">★</span><span class="text-gray-300">★★★★</span> <span>(1 Star)</span>
                    </label>
                </div>
            </div>

=======
>>>>>>> 3b2d076 (updated)
            <div class="flex gap-2">
                <button class="bg-[#f5a623] text-white py-2 px-4 rounded flex-1 hover:bg-[#e5941d] transition-colors">Apply Filters</button>
                <button class="bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded flex-1 hover:bg-gray-100 transition-colors">Reset</button>
            </div>
        </div>

        <!-- Events Content -->
        <div class="lg:col-span-3">
            <!-- Search and Sort Bar -->
            <div class="bg-white rounded-lg shadow p-4 mb-5 flex flex-col md:flex-row md:items-center gap-4">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]" placeholder="Search events by title, location, etc.">
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600 whitespace-nowrap">Sort by:</span>
                    <select class="p-2 border border-gray-300 rounded focus:outline-none focus:border-[#f5a623]">
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
                <?php if(count($events)>0): ?>
                    <?php foreach($events as $event):?>
                <!-- Event 1 -->
                <div class="bg-white rounded-lg shadow flex flex-col md:flex-row overflow-hidden transform transition-transform hover:scale-[1.01]">
                    <img src="/api/placeholder/200/150" alt="Event" class="w-full md:w-48 h-40 object-cover">
                    <div class="p-4 flex-1">
                        <div class="mb-2">
                            <span class="inline-block bg-[#3498db] text-white text-xs px-2 py-1 rounded mr-2">Hosted</span>
                            <h3 class="inline-block text-lg font-semibold"><?=$event->title?></h3>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-600 mb-3">
                            <span><i class="far fa-calendar mr-1"></i><?= reDate($event->event_date);?></span>
                            <span><i class="far fa-clock mr-1"></i>
                            <?= reTime($event->start_time); ?> -
                            <?= reTime($event->end_time ?? ''); ?>
                        </span>
                            <span><i class="fas fa-map-marker-alt mr-1"></i><?= $event->location_name ?>,
                             <?= $event->city ?>, <?= $event->country ?></span>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm mb-3">
                            <div class="flex items-center">
                                <i class="fas fa-users text-[#f5a623] mr-1"></i> <?=$event->attendee_count ?? 0?>/<?=$event->capacity ?? 25?> Attended
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-comment text-[#f5a623] mr-1"></i> <?=$event->review_count?> Reviews
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-[#f5a623] mr-1"></i><?=number_format($event->average_rating ?? 0,1)?>/5 Rating
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex md:flex-col gap-2 justify-end bg-gray-50">
                        <a href="/events/reviews/<?=$event->event_id?>" class="bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded text-sm flex items-center gap-1 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
                <?php else: ?>
                    <div class="col-span-3 text-center py-10">
            <p class="text-gray-500">No Past events found.</p>
            <a href="/events/" class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded">Go Back to Events</a>
        </div>
        <?php endif; ?>
            <!-- Pagination -->
            <div class="flex justify-center mt-6">
                <div class="flex">
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-l cursor-pointer hover:bg-gray-100">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 bg-[#f5a623] text-white cursor-pointer">1</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100">2</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100">3</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100">4</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 cursor-pointer hover:bg-gray-100">5</div>
                    <div class="w-9 h-9 flex items-center justify-center border border-gray-300 border-l-0 rounded-r cursor-pointer hover:bg-gray-100">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
       // View Switcher
    document.addEventListener('DOMContentLoaded', function() {
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
    });
        
        // Tag filters
        const tagFilters = document.querySelectorAll('.tag-filter');
        tagFilters.forEach(tag => {
            tag.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const listItems = document.querySelectorAll('.event-list-item');
            const gridItems = document.querySelectorAll('.event-card');
            
            // Filter list view items
            listItems.forEach(item => {
                const title = item.querySelector('.event-list-title').textContent.toLowerCase();
                const meta = item.querySelector('.event-list-meta').textContent.toLowerCase();
                
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

        // Apply filters (simplified for demo)
        document.querySelector('.apply-btn').addEventListener('click', function() {
            alert('Filters would be applied here. This would trigger an AJAX request to fetch filtered events in a real implementation.');
        });
        
        // Reset filters
        document.querySelector('.reset-btn').addEventListener('click', function() {
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
            
            // Reset tag filters
            document.querySelectorAll('.tag-filter.active').forEach(tag => {
                tag.classList.remove('active');
            });
            
            // In a real implementation, this would also trigger a reset of the displayed events
            alert('Filters have been reset. This would trigger an AJAX request to fetch all events in a real implementation.');
        });

        // Pagination (simplified for demo)
        document.querySelectorAll('.pagination-item').forEach(item => {
            item.addEventListener('click', function() {
                if (!this.classList.contains('active') && !this.querySelector('i')) {
                    document.querySelector('.pagination-item.active').classList.remove('active');
                    this.classList.add('active');
                    
                    // In a real implementation, this would load the corresponding page of events
                    alert(`Page ${this.textContent} would be loaded in a real implementation.`);
                }
            });
        });

        // Event card click to view details
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('click', function() {
                const title = this.querySelector('.event-title').textContent;
                window.location.href = `event_details.php?title=${encodeURIComponent(title)}`;
            });
        });
    </script>
      <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>