<?php
// Set page variables
$pageTitle = 'Event Management - SocialLoop';
$activePage = 'events';
$isLoggedIn = true;

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    redirect('/login');
    exit;
}
?>
<?php loadPartial('head') ?>

<body class="bg-gray-50">
<?php loadPartial('navbar') ?>

<!-- Main Content -->
<div class="container mx-auto px-4 py-6 max-w-7xl mt-20">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Event Management</h1>
                <p class="text-gray-600">Manage your events, view attendees, and track analytics</p>
            </div>
            <a href="/events/create" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition duration-200">
                <i class="fas fa-plus mr-2"></i> Create New Event
            </a>
        </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Events</p>
                    <p class="text-2xl font-bold text-gray-800"><?= $stats['total_events'] ?? 0 ?></p>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-calendar-alt text-orange-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Upcoming Events</p>
                    <p class="text-2xl font-bold text-gray-800"><?= $stats['upcoming_events'] ?? 0 ?></p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-clock text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Attendees</p>
                    <p class="text-2xl font-bold text-gray-800"><?= $stats['total_attendees'] ?? 0 ?></p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-users text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Avg. Rating</p>
                    <p class="text-2xl font-bold text-gray-800"><?= number_format($stats['average_rating'] ?? 0, 1) ?></p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-star text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Main Content -->
        <div class="lg:w-3/4 space-y-6">
            <!-- Events Management Card -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-200">
                    <button class="tab-btn px-6 py-3 bg-orange-500 text-white font-medium" data-tab="upcoming">
                        Upcoming Events (<?= count($upcomingEvents ?? []) ?>)
                    </button>
                    <button class="tab-btn px-6 py-3 text-gray-600 hover:bg-gray-100 font-medium" data-tab="past">
                        Past Events (<?= count($pastEvents ?? []) ?>)
                    </button>
                </div>

                <!-- Tab Content: Upcoming Events -->
                <div id="upcoming-content" class="tab-content p-4">
                    <?php if (isset($upcomingEvents) && count($upcomingEvents) > 0): ?>
                        <div class="mb-4">
                            <input type="text" class="search-input w-full p-3 border border-gray-300 rounded-lg" 
                                   placeholder="Search your events..." data-tab="upcoming">
                        </div>

                        <div class="space-y-4">
                            <?php foreach($upcomingEvents as $event): ?>
                                <div class="event-item flex flex-col md:flex-row border border-gray-200 rounded-lg hover:border-orange-500 transition duration-200">
                                    <img src="<?= getEventImage($event) ?>" alt="<?= htmlspecialchars($event->title) ?>" 
                                         class="w-full md:w-32 h-32 object-cover rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
                                    
                                    <div class="flex-1 p-4">
                                        <div class="flex flex-col md:flex-row justify-between items-start gap-2">
                                            <div class="flex-1">
                                                <h3 class="font-bold text-lg mb-2"><?= htmlspecialchars($event->title) ?></h3>
                                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                                    <span class="flex items-center">
                                                        <i class="far fa-calendar mr-2"></i> 
                                                        <?= reDate($event->event_date) ?>
                                                    </span>
                                                    <span class="flex items-center">
                                                        <i class="far fa-clock mr-2"></i> 
                                                        <?= reTime($event->start_time) ?> - <?= reTime($event->end_time) ?>
                                                    </span>
                                                    <span class="flex items-center">
                                                        <i class="fas fa-map-marker-alt mr-2"></i> 
                                                        <?= htmlspecialchars($event->location_name) ?>, <?= htmlspecialchars($event->city) ?>
                                                    </span>
                                                </div>
                                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600">
                                                    <span class="flex items-center">
                                                        <i class="fas fa-users mr-2"></i> 
                                                        <?= $event->attendee_count ?? 0 ?>/<?= $event->max_attendees ?? '∞' ?> Attendees
                                                    </span>
                                                    <?php if(isset($event->pending_count) && $event->pending_count > 0): ?>
                                                        <span class="flex items-center text-orange-600">
                                                            <i class="fas fa-user-plus mr-2"></i> 
                                                            <?= $event->pending_count ?> Pending Requests
                                                        </span>
                                                    <?php endif; ?>
                                                    <span class="flex items-center">
                                                        <i class="fas fa-eye mr-2"></i> 
                                                        <?= $event->view_count ?? 0 ?> Views
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="flex flex-wrap gap-2 mt-3 md:mt-0">
                                                <?php if(isset($event->pending_count) && $event->pending_count > 0): ?>
                                                    <button onclick="openAttendeeModal(<?= $event->event_id ?>)" 
                                                            class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                                                        <i class="fas fa-user-check mr-1"></i> Requests
                                                    </button>
                                                <?php endif; ?>
                                                <a href="/events/<?= $event->event_id ?>" 
                                                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                                    <i class="fas fa-eye mr-1"></i> View
                                                </a>
                                                <a href="/events/edit/<?= $event->event_id ?>" 
                                                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <button onclick="cancelEvent(<?= $event->event_id ?>)" 
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium">
                                                    <i class="fas fa-times mr-1"></i> Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">You don't have any upcoming events.</p>
                            <a href="/events/create" class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded">
                                Create Your First Event
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tab Content: Past Events -->
                <div id="past-content" class="tab-content hidden p-4">
                    <?php if (isset($pastEvents) && count($pastEvents) > 0): ?>
                        <div class="mb-4">
                            <input type="text" class="search-input w-full p-3 border border-gray-300 rounded-lg" 
                                   placeholder="Search past events..." data-tab="past">
                        </div>

                        <div class="space-y-4">
                            <?php foreach($pastEvents as $event): ?>
                                <div class="event-item flex flex-col md:flex-row border border-gray-200 rounded-lg hover:border-orange-500 transition duration-200">
                                    <img src="<?= getEventImage($event) ?>" alt="<?= htmlspecialchars($event->title) ?>" 
                                         class="w-full md:w-32 h-32 object-cover rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
                                    
                                    <div class="flex-1 p-4">
                                        <div class="flex flex-col md:flex-row justify-between items-start gap-2">
                                            <div class="flex-1">
                                                <h3 class="font-bold text-lg mb-2"><?= htmlspecialchars($event->title) ?></h3>
                                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                                    <span class="flex items-center">
                                                        <i class="far fa-calendar mr-2"></i> 
                                                        <?= reDate($event->event_date) ?>
                                                    </span>
                                                    <span class="flex items-center">
                                                        <i class="fas fa-map-marker-alt mr-2"></i> 
                                                        <?= htmlspecialchars($event->location_name) ?>, <?= htmlspecialchars($event->city) ?>
                                                    </span>
                                                </div>
                                                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600">
                                                    <span class="flex items-center">
                                                        <i class="fas fa-users mr-2"></i> 
                                                        <?= $event->attendee_count ?? 0 ?> Attended
                                                    </span>
                                                    <span class="flex items-center">
                                                        <i class="fas fa-star mr-2"></i> 
                                                        <?= number_format($event->average_rating ?? 0, 1) ?>/5
                                                    </span>
                                                    <span class="flex items-center">
                                                        <i class="fas fa-comment mr-2"></i> 
                                                        <?= $event->review_count ?? 0 ?> Reviews
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="flex flex-wrap gap-2 mt-3 md:mt-0">
                                                <a href="/events/reviews/<?= $event->event_id ?>" 
                                                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                                    <i class="fas fa-star mr-1"></i> Reviews
                                                </a>
                                                <a href="/events/<?= $event->event_id ?>" 
                                                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm font-medium">
                                                    <i class="fas fa-eye mr-1"></i> View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <p class="text-gray-500">You don't have any past events.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Current Attendee Management -->
            <?php if(isset($currentEventAttendees) && !empty($currentEventAttendees)): ?>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="flex flex-col md:flex-row md:items-center justify-between p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 md:mb-0">Attendee Management</h2>
                    <select id="event-selector" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-2 rounded text-sm font-medium">
                        <?php foreach($upcomingEvents as $event): ?>
                            <option value="<?= $event->event_id ?>"><?= htmlspecialchars($event->title) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="p-4 space-y-4">
                    <div id="attendees-list">
                        <!-- Attendees will be loaded here via AJAX -->
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/4 space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Quick Stats</h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500"><?= $stats['total_events'] ?? 0 ?></div>
                            <div class="text-xs text-gray-600">Total Events</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500"><?= $stats['total_attendees'] ?? 0 ?></div>
                            <div class="text-xs text-gray-600">Total Attendees</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500"><?= number_format($stats['average_rating'] ?? 0, 1) ?></div>
                            <div class="text-xs text-gray-600">Average Rating</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-orange-500"><?= $stats['upcoming_events'] ?? 0 ?></div>
                            <div class="text-xs text-gray-600">Upcoming</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
                </div>
                <div class="p-4 space-y-4">
                    <?php if(isset($recentActivity) && count($recentActivity) > 0): ?>
                        <?php foreach($recentActivity as $activity): ?>
                            <div class="border-b border-gray-100 pb-3 last:border-0">
                                <div class="text-sm">
                                    <?= htmlspecialchars($activity->description) ?>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <?= timeSince($activity->created_at) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 text-sm">No recent activity</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Your Next Event -->
            <?php if(isset($nextEvent)): ?>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Your Next Event</h2>
                </div>
                <div class="p-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="bg-orange-500 text-white text-center rounded-lg p-2 min-w-12">
                            <div class="text-xs font-bold uppercase">
                                <?= date('M', strtotime($nextEvent->event_date)) ?>
                            </div>
                            <div class="text-lg font-bold">
                                <?= date('d', strtotime($nextEvent->event_date)) ?>
                            </div>
                        </div>
                        <div>
                            <div class="font-medium"><?= htmlspecialchars($nextEvent->title) ?></div>
                            <div class="text-xs text-gray-500">
                                <?= reTime($nextEvent->start_time) ?> • <?= htmlspecialchars($nextEvent->city) ?>
                            </div>
                        </div>
                    </div>
                    <a href="/events/<?= $nextEvent->event_id ?>" 
                       class="block text-center bg-orange-500 hover:bg-orange-600 text-white py-2 rounded">
                        View Event
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Quick Links</h2>
                </div>
                <div class="p-4 space-y-3">
                    <a href="/events/create" class="block bg-orange-500 hover:bg-orange-600 text-white text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-plus mr-2"></i> Create Event
                    </a>
                    <a href="/messages" class="block bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-envelope mr-2"></i> Messages
                    </a>
                    <a href="/notifications" class="block bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-bell mr-2"></i> Notifications
                    </a>
                    <a href="/help" class="block bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-question-circle mr-2"></i> Help
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendee Request Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="attendeeRequestModal">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl max-h-[80vh] overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">Pending Join Requests</h3>
            <button onclick="closeAttendeeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <div class="p-4 space-y-4 overflow-y-auto max-h-[calc(80vh-120px)]" id="pending-requests-content">
            <!-- Pending requests will be loaded here via AJAX -->
        </div>
        <div class="flex justify-end gap-3 p-4 border-t border-gray-200">
            <button onclick="closeAttendeeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium">
                Close
            </button>
        </div>
    </div>
</div>

<script>
// Tab Navigation
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Update button styles
            tabBtns.forEach(b => {
                b.classList.remove('bg-orange-500', 'text-white');
                b.classList.add('text-gray-600');
            });
            this.classList.remove('text-gray-600');
            this.classList.add('bg-orange-500', 'text-white');
            
            // Show/hide content
            tabContents.forEach(content => {
                if (content.id === tabName + '-content') {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });
    
    // Search functionality
    document.querySelectorAll('.search-input').forEach(input => {
        input.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const tabName = this.getAttribute('data-tab');
            const container = document.getElementById(tabName + '-content');
            const items = container.querySelectorAll('.event-item');
            
            items.forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                if (title.includes(query)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Load attendees when event is selected
    const eventSelector = document.getElementById('event-selector');
    if (eventSelector) {
        eventSelector.addEventListener('change', loadAttendees);
        // Load initial attendees
        loadAttendees();
    }
});

// Attendee request modal functions
function openAttendeeModal(eventId) {
    document.getElementById('attendeeRequestModal').classList.remove('hidden');
    loadPendingRequests(eventId);
}

function closeAttendeeModal() {
    document.getElementById('attendeeRequestModal').classList.add('hidden');
}

// Load pending requests via AJAX
function loadPendingRequests(eventId) {
    fetch(`/api/events/${eventId}/pending-requests`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('pending-requests-content');
            if (data.requests && data.requests.length > 0) {
                container.innerHTML = data.requests.map(request => `
                    <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg">
                        <img src="${getProfilePicture(request)}" alt="${request.first_name}" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="font-medium">${request.first_name} ${request.last_name}</div>
                            <div class="text-sm text-gray-500">Requested ${timeSince(request.joined_at)}</div>
                            ${request.message ? `<div class="text-sm text-gray-600 mt-1"><i class="fas fa-comment mr-1"></i> "${request.message}"</div>` : ''}
                        </div>
                        <div class="flex gap-2">
                            <button onclick="handleRequest(${request.attendee_id}, 'approve')" 
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                Approve
                            </button>
                            <button onclick="handleRequest(${request.attendee_id}, 'decline')" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Decline
                            </button>
                        </div>
                    </div>
                `).join('');
            } else {
                container.innerHTML = '<p class="text-center text-gray-500">No pending requests</p>';
            }
        })
        .catch(error => {
            console.error('Error loading pending requests:', error);
            document.getElementById('pending-requests-content').innerHTML = 
                '<p class="text-center text-red-500">Error loading requests</p>';
        });
}

// Handle approve/decline request
function handleRequest(attendeeId, action) {
    fetch(`/api/attendees/${attendeeId}/${action}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': '<?= $_SESSION['csrf_token'] ?? '' ?>'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the pending requests
            const eventId = document.querySelector('[onclick*="openAttendeeModal"]').getAttribute('onclick').match(/\d+/)[0];
            loadPendingRequests(eventId);
            // Show success message
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message || 'An error occurred', 'error');
        }
    })
    .catch(error => {
        console.error('Error handling request:', error);
        showNotification('An error occurred', 'error');
    });
}

// Load attendees for selected event
function loadAttendees() {
    const eventId = document.getElementById('event-selector').value;
    const container = document.getElementById('attendees-list');
    
    fetch(`/api/events/${eventId}/attendees`)
        .then(response => response.json())
        .then(data => {
            if (data.attendees && data.attendees.length > 0) {
                container.innerHTML = data.attendees.map(attendee => `
                    <div class="flex flex-col md:flex-row items-center gap-4 p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <img src="${getProfilePicture(attendee)}" alt="${attendee.first_name}" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <div class="font-medium">${attendee.first_name} ${attendee.last_name}</div>
                            <div class="text-sm text-gray-500">Joined ${timeSince(attendee.joined_at)}</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="/users/profile/${attendee.user_id}" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-user mr-1"></i> Profile
                            </a>
                            <a href="/messages?user=${attendee.user_id}" class="text-orange-500 hover:text-orange-700 text-sm">
                                <i class="fas fa-envelope mr-1"></i> Message
                            </a>
                            <button onclick="removeAttendee(${attendee.attendee_id})" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-user-times mr-1"></i> Remove
                            </button>
                        </div>
                    </div>
                `).join('');
            } else {
                container.innerHTML = '<p class="text-center text-gray-500">No attendees yet</p>';
            }
        })
        .catch(error => {
            console.error('Error loading attendees:', error);
            container.innerHTML = '<p class="text-center text-red-500">Error loading attendees</p>';
        });
}

// Cancel event
function cancelEvent(eventId) {
    if (confirm('Are you sure you want to cancel this event? This action cannot be undone.')) {
        fetch(`/api/events/${eventId}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= $_SESSION['csrf_token'] ?? '' ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Event cancelled successfully', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotification(data.message || 'Failed to cancel event', 'error');
            }
        })
        .catch(error => {
            console.error('Error cancelling event:', error);
            showNotification('An error occurred', 'error');
        });
    }
}

// Remove attendee
function removeAttendee(attendeeId) {
    if (confirm('Are you sure you want to remove this attendee?')) {
        fetch(`/api/attendees/${attendeeId}/remove`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= $_SESSION['csrf_token'] ?? '' ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Attendee removed successfully', 'success');
                loadAttendees(); // Reload the attendee list
            } else {
                showNotification(data.message || 'Failed to remove attendee', 'error');
            }
        })
        .catch(error => {
            console.error('Error removing attendee:', error);
            showNotification('An error occurred', 'error');
        });
    }
}

// Helper function to get profile picture URL
function getProfilePicture(user) {
    if (user.profile_picture && user.profile_picture !== 'default_profile.jpg') {
        if (user.profile_picture.startsWith('http')) {
            return user.profile_picture;
        }
        return '/uploads/profiles/' + user.profile_picture;
    }
    // Generate avatar with initials
    const name = encodeURIComponent(user.first_name + '+' + user.last_name);
    const colors = ['667eea', 'f093fb', '4facfe', '43e97b', 'fa709a', 'ffd89b'];
    const colorIndex = Math.abs(user.first_name.charCodeAt(0) + user.last_name.charCodeAt(0)) % colors.length;
    return `https://ui-avatars.com/api/?name=${name}&size=150&background=${colors[colorIndex]}&color=fff&rounded=true`;
}

// Helper function to calculate time since
function timeSince(dateString) {
    const date = new Date(dateString);
    const seconds = Math.floor((new Date() - date) / 1000);
    
    let interval = seconds / 31536000;
    if (interval > 1) return Math.floor(interval) + " years ago";
    
    interval = seconds / 2592000;
    if (interval > 1) return Math.floor(interval) + " months ago";
    
    interval = seconds / 86400;
    if (interval > 1) return Math.floor(interval) + " days ago";
    
    interval = seconds / 3600;
    if (interval > 1) return Math.floor(interval) + " hours ago";
    
    interval = seconds / 60;
    if (interval > 1) return Math.floor(interval) + " minutes ago";
    
    return "just now";
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 max-w-sm ${
        type === 'success' ? 'bg-green-500 text-white' : 
        type === 'error' ? 'bg-red-500 text-white' : 
        'bg-blue-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${
                type === 'success' ? 'fa-check-circle' : 
                type === 'error' ? 'fa-exclamation-circle' : 
                'fa-info-circle'
            } mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Handle ESC key for modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAttendeeModal();
    }
});

// Close modal when clicking outside
document.getElementById('attendeeRequestModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAttendeeModal();
    }
});
</script>

<?= loadPartial('footer'); ?>
</body>
</html>