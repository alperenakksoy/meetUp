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
<div class="container mx-auto px-4 py-6 max-w-7xl mt-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Events</h1>
        <a href="/events/create" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition duration-200">
            <i class="fas fa-plus mr-2"></i> Create New Event
        </a>
    </div>

    <!-- Event Categories -->
    <div class="flex space-x-2 mb-6 overflow-x-auto pb-2">
    <a href="App/CreateEventForm/all_events.php" class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer hover:bg-orange-600 inline-block">All Events</a>
    <a href="App/CreateEventForm/attending.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer inline-block">Attending</a>
    <a href="/events/past" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer inline-block">Past Events</a></div>

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
       
  <!-- Events Grid -->
  <?php
// Updated section of App/views/listings/events/index.view.php
// Replace the Events Grid section with this:
?>

<!-- Events Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <?=loadPartial('message')?>
    <?php if(count($events) > 0): ?>
        <?php foreach($events as $event): ?>
            <!-- Event Card -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-200 hover:border-orange-500 hover:border">
                <div class="relative">
                    <img src="<?= getEventImage($event) ?>" 
                         alt="<?= htmlspecialchars($event->title) ?>" 
                         class="w-full h-48 object-cover">
                    <!-- Category Badge -->
                    <div class="absolute top-3 right-3 <?= getCategoryColor($event->category) ?> text-white px-3 py-1 rounded-full text-sm flex items-center gap-1">
                        <i class="<?= getCategoryIcon($event->category) ?> text-xs"></i>
                        <span><?= ucfirst($event->category ?? 'Event') ?></span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center mb-3">
                        <img src="/uploads/profiles/<?= $event->profile_picture ?? 'default_profile.jpg' ?>" 
                             alt="Host" 
                             class="w-8 h-8 rounded-full mr-2">
                        <span class="text-sm font-medium"><?= htmlspecialchars($event->first_name . ' ' . $event->last_name) ?></span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 hover:text-orange-500 cursor-pointer">
                        <?= $event->title ?>
                    </h3>
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="far fa-calendar mr-2"></i>
                            <span>
                                <?= reDate($event->event_date); ?> • 
                                <?= reTime($event->start_time); ?> -
                                <?= reTime($event->end_time ?? ''); ?>
                            </span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span><?= htmlspecialchars($event->location_name) ?>, <?= htmlspecialchars($event->city) ?>, <?= htmlspecialchars($event->country) ?></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-users mr-2"></i>
                            <?php if($event->attendee_count == 1):?>
                                <span>+1 person is attending</span>
                            <?php elseif($event->attendee_count > 1):?>
                                <span>+<?=$event->attendee_count?> people attending</span>
                            <?php else:?>
                                <span>No one has joined yet</span>
                            <?php endif;?>
                        </div>
                    </div>
                    <p class="text-gray-700 text-sm mb-4">
                        <?= htmlspecialchars(strlen($event->description) > 150 ? substr($event->description, 0, 150) . '...' : $event->description) ?>
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <i class="<?= getCategoryIcon($event->category) ?> text-orange-500"></i>
                            <span class="text-sm text-gray-600"><?= ucfirst($event->category ?? 'Event') ?></span>
                        </div>
                        <a href="/events/<?= $event->event_id ?>" 
                           class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i> View
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-3 text-center py-10">
            <p class="text-gray-500">No upcoming events found.</p>
            <a href="/events/create" class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded">Create an Event</a>
        </div>
    <?php endif; ?>
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
