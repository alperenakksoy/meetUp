<?php
// App/views/listings/hangouts/index.view.php

// Set page variables
$pageTitle = 'Hangouts';
$activePage = 'hangouts';
$isLoggedIn = true;

use Framework\Session;
$currentUserId = Session::get('user_id');

// Helper function to get activity emoji
function getActivityEmoji($activityType) {
    $emojis = [
        'coffee' => '☕',
        'food' => '🍕',
        'walk' => '🚶',
        'drink' => '🍺'
    ];
    return $emojis[$activityType] ?? '📍';
}

// Helper function to get activity color
function getActivityColor($activityType) {
    $colors = [
        'coffee' => 'bg-amber-100 text-amber-800',
        'food' => 'bg-blue-100 text-blue-800',
        'walk' => 'bg-purple-100 text-purple-800',
        'drink' => 'bg-green-100 text-green-800'
    ];
    return $colors[$activityType] ?? 'bg-gray-100 text-gray-800';
}

// Helper function to get profile picture URL
function getHangoutProfilePicture($user) {
    if (empty($user->profile_picture) || $user->profile_picture === 'default_profile.jpg') {
        $name = ($user->first_name ?? 'U') . '+' . ($user->last_name ?? 'ser');
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&size=40&background=667eea&color=fff&rounded=true";
    }
    
    if (strpos($user->profile_picture, 'http') === 0) {
        return $user->profile_picture;
    }
    
    return "/uploads/profiles/{$user->profile_picture}";
}

// Helper function to check if current user is attending
function isUserAttending($hangout, $currentUserId) {
    if (!empty($hangout->attendees)) {
        foreach($hangout->attendees as $attendee) {
            if ($attendee->user_id == $currentUserId) {
                return true;
            }
        }
    }
    return false;
}
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>

<!-- Main Content -->
<div class="container mx-auto px-4 py-6 max-w-7xl mt-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Hangouts</h1>
            <p class="text-gray-600">Quick & spontaneous meetups happening now</p>
        </div>
        <button id="createHangoutBtn" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition duration-200">
            <i class="fas fa-plus mr-2"></i> Quick Hangout
        </button>
    </div>

    <!-- My Upcoming Hangouts Section -->
    <?php 
    // Get user's upcoming hangouts
    $myUpcomingHangouts = [];
    if ($currentUserId && !empty($hangouts)) {
        foreach($hangouts as $hangout) {
            if (isUserAttending($hangout, $currentUserId) || $hangout->host_id == $currentUserId) {
                $now = new DateTime();
                $start = new DateTime($hangout->start_time);
                if ($start > $now) {
                    $myUpcomingHangouts[] = $hangout;
                }
            }
        }
    }
    ?>
    
    <?php if (!empty($myUpcomingHangouts)): ?>
    <div class="mb-8 bg-blue-50 rounded-lg p-4">
        <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
            <i class="fas fa-calendar-check text-blue-600 mr-2"></i>
            Your Upcoming Hangouts
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            <?php foreach($myUpcomingHangouts as $upcomingHangout): ?>
                <?php 
                $isHost = $upcomingHangout->host_id == $currentUserId;
                $now = new DateTime();
                $start = new DateTime($upcomingHangout->start_time);
                $diff = $start->diff($now);
                $totalMinutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
                ?>
                <div class="bg-white rounded-lg p-3 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800"><?= htmlspecialchars($upcomingHangout->description) ?></h4>
                            <p class="text-sm text-gray-600">
                                <?= $isHost ? 'You\'re hosting' : 'Hosted by ' . htmlspecialchars($upcomingHangout->first_name) ?>
                            </p>
                        </div>
                        <span class="<?= getActivityColor($upcomingHangout->activity_type) ?> text-xs px-2 py-1 rounded-full">
                            <?= getActivityEmoji($upcomingHangout->activity_type) ?>
                        </span>
                    </div>
                    
                    <div class="space-y-1 text-sm text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-blue-600 mr-2 w-4"></i>
                            <span class="font-medium">
                                <?php
                                if ($totalMinutes <= 60) {
                                    echo "In {$totalMinutes} minutes";
                                } elseif ($totalMinutes <= 1440) {
                                    $hours = floor($totalMinutes / 60);
                                    echo "In {$hours} hour" . ($hours > 1 ? 's' : '');
                                } else {
                                    echo date('M j, g:i A', strtotime($upcomingHangout->start_time));
                                }
                                ?>
                            </span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-2 w-4"></i>
                            <span class="truncate"><?= htmlspecialchars($upcomingHangout->location) ?></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users text-blue-600 mr-2 w-4"></i>
                            <span><?= $upcomingHangout->attendee_count ?> attending</span>
                        </div>
                    </div>
                    
                    <div class="mt-3 flex gap-2">
                        <?php if (!$isHost): ?>
                            <button class="leave-btn flex-1 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded text-sm font-medium transition-colors"
                                    data-hangout-id="<?= $upcomingHangout->hangout_id ?>">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </button>
                        <?php else: ?>
                            <button class="flex-1 bg-gray-100 text-gray-700 px-3 py-1 rounded text-sm font-medium cursor-not-allowed" disabled>
                                <i class="fas fa-crown mr-1"></i> You're hosting
                            </button>
                        <?php endif; ?>
                        <a href="/hangouts/<?= $upcomingHangout->hangout_id ?>" 
                           class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm font-medium text-center transition-colors">
                            <i class="fas fa-info-circle mr-1"></i> Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Quick Filters -->
    <div class="flex space-x-2 mb-6 overflow-x-auto pb-2">
        <button class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer hover:bg-orange-600 filter-btn active" data-filter="all">
            All Hangouts
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="coffee">
            ☕ Coffee
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="food">
            🍕 Food
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="walk">
            🚶 Walk
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="drink">
            🍺 Drinks
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="starting-soon">
            ⏰ Starting Soon
        </button>
    </div>

    <!-- Hangouts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="hangoutsContainer">
        <?php if (!empty($hangouts)): ?>
            <?php foreach($hangouts as $hangout): ?>
                <?php 
                $userIsAttending = isUserAttending($hangout, $currentUserId);
                $isHost = $hangout->host_id == $currentUserId;
                ?>
                <div class="hangout-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 p-4" 
                     data-category="<?= htmlspecialchars($hangout->activity_type) ?>"
                     data-hangout-id="<?= $hangout->hangout_id ?>">
                    
                    <!-- Header with host info and activity type -->
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center">
                            <img src="<?= htmlspecialchars(getHangoutProfilePicture($hangout)) ?>" 
                                 alt="Host" 
                                 class="w-10 h-10 rounded-full mr-3 object-cover">
                            <div>
                                <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($hangout->description) ?></h3>
                                <p class="text-sm text-gray-600">
                                    <?= $isHost ? 'You' : htmlspecialchars($hangout->first_name . ' ' . $hangout->last_name) ?>
                                </p>
                            </div>
                        </div>
                        <span class="<?= getActivityColor($hangout->activity_type) ?> text-xs px-2 py-1 rounded-full">
                            <?= getActivityEmoji($hangout->activity_type) ?> <?= ucfirst($hangout->activity_type) ?>
                        </span>
                    </div>
                    
                    <!-- Location and Time Info -->
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clock mr-2 text-orange-500"></i>
                            <span class="time-status" data-start-time="<?= $hangout->start_time ?>">
                                <?php
                                // Calculate time status
                                $now = new DateTime();
                                $start = new DateTime($hangout->start_time);
                                $diff = $now->diff($start);
                                
                                if ($start <= $now) {
                                    $minutesPast = $diff->i + ($diff->h * 60) + ($diff->days * 24 * 60);
                                    if ($minutesPast <= 180) {
                                        echo '<span class="text-green-600 font-medium">🔴 Live Now</span>';
                                    } else {
                                        echo '<span class="text-gray-500">Ended</span>';
                                    }
                                } else {
                                    $totalMinutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
                                    if ($totalMinutes <= 30) {
                                        echo '<span class="text-orange-600 font-medium">⏰ Starting Soon</span>';
                                    } elseif ($totalMinutes <= 60) {
                                        echo "In {$totalMinutes} min";
                                    } else {
                                        $hours = floor($totalMinutes / 60);
                                        echo "In {$hours}h";
                                    }
                                }
                                ?>
                            </span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2 text-orange-500"></i>
                            <span><?= htmlspecialchars($hangout->location) ?></span>
                        </div>
                        <?php if ($hangout->max_people): ?>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-users mr-2 text-orange-500"></i>
                                <span>Max <?= $hangout->max_people ?> people</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Attendees and Action Button -->
                    <div class="flex items-center justify-between">
                        <!-- Left side: Profile pics and count -->
                        <div class="flex items-center space-x-2">
                            <?php if (!empty($hangout->attendees) && count($hangout->attendees) > 0): ?>
                                <div class="flex -space-x-2">
                                    <?php foreach (array_slice($hangout->attendees, 0, 4) as $attendee): ?>
                                        <img src="<?= htmlspecialchars(getHangoutProfilePicture($attendee)) ?>" 
                                             alt="<?= htmlspecialchars($attendee->first_name ?? 'Attendee') ?>" 
                                             class="w-6 h-6 rounded-full border-2 border-white object-cover"
                                             title="<?= htmlspecialchars(($attendee->first_name ?? '') . ' ' . ($attendee->last_name ?? '')) ?>">
                                    <?php endforeach; ?>
                                    <?php if ($hangout->attendee_count > 4): ?>
                                        <div class="w-6 h-6 rounded-full border-2 border-white bg-gray-300 flex items-center justify-center text-xs text-gray-600">
                                            +<?= $hangout->attendee_count - 4 ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <span class="text-sm text-gray-500">
                                <?php if ($hangout->attendee_count == 0): ?>
                                    Be the first to join!
                                <?php elseif ($hangout->attendee_count == 1): ?>
                                    1 person going
                                <?php else: ?>
                                    <?= $hangout->attendee_count ?> people going
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <!-- Right side: Action buttons -->
                        <div class="flex space-x-2">
                            <?php if ($isHost): ?>
                                <button class="bg-gray-500 text-white px-3 py-1 rounded text-sm font-medium cursor-not-allowed" disabled>
                                    <i class="fas fa-crown mr-1"></i> Host
                                </button>
                            <?php elseif ($userIsAttending): ?>
                                <button class="leave-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium"
                                        data-hangout-id="<?= $hangout->hangout_id ?>">
                                    <i class="fas fa-times mr-1"></i> Leave
                                </button>
                            <?php else: ?>
                                <?php 
                                $isLive = false;
                                $now = new DateTime();
                                $start = new DateTime($hangout->start_time);
                                if ($start <= $now) {
                                    $diff = $now->diff($start);
                                    $minutesPast = $diff->i + ($diff->h * 60) + ($diff->days * 24 * 60);
                                    $isLive = $minutesPast <= 180;
                                }
                                ?>
                                <?php if ($isLive): ?>
                                    <button class="join-btn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm font-medium"
                                            data-hangout-id="<?= $hangout->hangout_id ?>">
                                        <i class="fas fa-running mr-1"></i> Join Live
                                    </button>
                                <?php else: ?>
                                    <button class="join-btn bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium"
                                            data-hangout-id="<?= $hangout->hangout_id ?>">
                                        <i class="fas fa-plus mr-1"></i> Join
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="<?= empty($hangouts) ? '' : 'hidden' ?> text-center py-12">
        <div class="text-gray-400 mb-4">
            <i class="fas fa-calendar-times fa-4x"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">No hangouts found</h3>
        <p class="text-gray-500 mb-4">Be the first to create a spontaneous hangout!</p>
        <button id="createFirstHangout" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Create First Hangout
        </button>
    </div>
</div>

<!-- Quick Create Hangout Modal -->
<div id="createHangoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Quick Hangout</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        
        <form id="quickHangoutForm" action="/hangouts" method="POST" class="p-4 space-y-4">
            <!-- Quick Activity Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">What do you want to do?</label>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="coffee">
                        <div class="text-center">
                            <div class="text-2xl mb-1">☕</div>
                            <div class="text-sm font-medium">Coffee</div>
                        </div>
                    </button>
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="food">
                        <div class="text-center">
                            <div class="text-2xl mb-1">🍕</div>
                            <div class="text-sm font-medium">Food</div>
                        </div>
                    </button>
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="walk">
                        <div class="text-center">
                            <div class="text-2xl mb-1">🚶</div>
                            <div class="text-sm font-medium">Walk</div>
                        </div>
                    </button>
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="drink">
                        <div class="text-center">
                            <div class="text-2xl mb-1">🍺</div>
                            <div class="text-sm font-medium">Drinks</div>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="selectedActivity" name="activity" required>
            </div>

            <!-- Quick Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Quick description</label>
                <input type="text" id="description" name="description" 
                       placeholder="e.g., Coffee at Starbucks Taksim" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" 
                       required maxlength="100">
            </div>

            <!-- When -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">When?</label>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" class="when-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors text-sm" data-when="now">
                        Now
                    </button>
                    <button type="button" class="when-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors text-sm" data-when="30min">
                        30 min
                    </button>
                    <button type="button" class="when-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors text-sm" data-when="1hour">
                        1 hour
                    </button>
                </div>
                <input type="hidden" id="selectedWhen" name="when" required>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Where?</label>
                <input type="text" id="location" name="location" 
                       placeholder="e.g., Taksim Square, Istanbul" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" 
                       required>
            </div>

            <!-- Max People (Optional) -->
            <div>
                <label for="maxPeople" class="block text-sm font-medium text-gray-700 mb-1">Max people (optional)</label>
                <select id="maxPeople" name="max_people" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">No limit</option>
                    <option value="2">2 people</option>
                    <option value="3">3 people</option>
                    <option value="4">4 people</option>
                    <option value="5">5 people</option>
                    <option value="6">6 people</option>
                    <option value="8">8 people</option>
                    <option value="10">10 people</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                <i class="fas fa-rocket mr-2"></i> Create Hangout
            </button>
        </form>
    </div>
</div>

<!-- Success/Error Messages -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="fixed top-20 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <?= htmlspecialchars($_SESSION['success_message']) ?>
        <?php unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <?= htmlspecialchars($_SESSION['error_message']) ?>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal controls
    const createBtn = document.getElementById('createHangoutBtn');
    const createFirstBtn = document.getElementById('createFirstHangout');
    const modal = document.getElementById('createHangoutModal');
    const closeModal = document.getElementById('closeModal');

    // Show modal
    [createBtn, createFirstBtn].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        }
    });

    // Hide modal
    closeModal.addEventListener('click', () => {
        hideModal();
    });

    // Close modal when clicking outside
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            hideModal();
        }
    });

    function hideModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('quickHangoutForm').reset();
        resetFormButtons();
    }

    // Activity selection
    const activityBtns = document.querySelectorAll('.activity-btn');
    const selectedActivityInput = document.getElementById('selectedActivity');

    activityBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            activityBtns.forEach(b => {
                b.classList.remove('border-orange-500', 'bg-orange-50');
                b.classList.add('border-gray-300');
            });
            
            // Add active class to clicked button
            btn.classList.remove('border-gray-300');
            btn.classList.add('border-orange-500', 'bg-orange-50');
            
            // Set selected value
            selectedActivityInput.value = btn.dataset.activity;
        });
    });

    // When selection
    const whenBtns = document.querySelectorAll('.when-btn');
    const selectedWhenInput = document.getElementById('selectedWhen');

    whenBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            whenBtns.forEach(b => {
                b.classList.remove('border-orange-500', 'bg-orange-50');
                b.classList.add('border-gray-300');
            });
            
            // Add active class to clicked button
            btn.classList.remove('border-gray-300');
            btn.classList.add('border-orange-500', 'bg-orange-50');
            
            // Set selected value
            selectedWhenInput.value = btn.dataset.when;
        });
    });

    function resetFormButtons() {
        // Reset activity buttons
        activityBtns.forEach(btn => {
            btn.classList.remove('border-orange-500', 'bg-orange-50');
            btn.classList.add('border-gray-300');
        });
        
        // Reset when buttons
        whenBtns.forEach(btn => {
            btn.classList.remove('border-orange-500', 'bg-orange-50');
            btn.classList.add('border-gray-300');
        });
        
        // Clear hidden inputs
        selectedActivityInput.value = '';
        selectedWhenInput.value = '';
    }

    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const hangoutCards = document.querySelectorAll('.hangout-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            
            // Update active filter button
            filterBtns.forEach(b => {
                b.classList.remove('bg-orange-500', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-800');
            });
            btn.classList.remove('bg-gray-200', 'text-gray-800');
            btn.classList.add('bg-orange-500', 'text-white');
            
            // Filter cards
            let visibleCount = 0;
            hangoutCards.forEach(card => {
                const category = card.dataset.category;
                const timeStatus = card.querySelector('.time-status');
                
                let shouldShow = false;
                
                if (filter === 'all') {
                    shouldShow = true;
                } else if (filter === 'starting-soon' && timeStatus) {
                    const text = timeStatus.textContent.trim();
                    shouldShow = text.includes('Starting Soon') || text.includes('Live Now');
                } else {
                    shouldShow = category === filter;
                }
                
                if (shouldShow) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show/hide empty state
            const emptyState = document.getElementById('emptyState');
            const container = document.getElementById('hangoutsContainer');
            if (visibleCount === 0) {
                container.style.display = 'none';
                emptyState.classList.remove('hidden');
            } else {
                container.style.display = 'grid';
                emptyState.classList.add('hidden');
            }
        });
    });

    // Form validation
    const form = document.getElementById('quickHangoutForm');
    form.addEventListener('submit', (e) => {
        // Basic validation
        if (!selectedActivityInput.value) {
            e.preventDefault();
            alert('Please select an activity type');
            return;
        }
        
        if (!selectedWhenInput.value) {
            e.preventDefault();
            alert('Please select when this hangout will happen');
            return;
        }
    });

    // Join/Leave hangout functionality
    document.addEventListener('click', async (e) => {
        // Check if clicked element is or is inside a join button
        const joinBtn = e.target.closest('.join-btn');
        if (joinBtn) {
            e.preventDefault();
            const hangoutId = joinBtn.dataset.hangoutId;
            await joinHangout(hangoutId, joinBtn);
            return; // Stop here to prevent triggering leave button logic
        }
        
        // Check if clicked element is or is inside a leave button
        const leaveBtn = e.target.closest('.leave-btn');
        if (leaveBtn) {
            e.preventDefault();
            const hangoutId = leaveBtn.dataset.hangoutId;
            
            if (confirm('Are you sure you want to leave this hangout?')) {
                await leaveHangout(hangoutId, leaveBtn);
            }
            return;
        }
    });

    // Join hangout function
    async function joinHangout(hangoutId, button) {
        const originalText = button.innerHTML;
        
        try {
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Joining...';
            button.disabled = true;
            
            const response = await fetch(`/hangouts/${hangoutId}/join`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Update button to leave state
                button.className = 'leave-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium';
                button.innerHTML = '<i class="fas fa-times mr-1"></i> Leave';
                
                // Update attendee count
                const card = button.closest('.hangout-card');
                const countSpan = card.querySelector('.text-sm.text-gray-500');
                const newCount = result.attendee_count;
                
                if (newCount === 1) {
                    countSpan.textContent = '1 person going';
                } else {
                    countSpan.textContent = `${newCount} people going`;
                }
                
                // Show success message
                showTempMessage(result.message, 'success');
                
            } else {
                showTempMessage(result.message, 'error');
                button.innerHTML = originalText;
            }
            
        } catch (error) {
            console.error('Error joining hangout:', error);
            showTempMessage('Failed to join hangout', 'error');
            button.innerHTML = originalText;
        } finally {
            button.disabled = false;
        }
    }

    // Leave hangout function
    async function leaveHangout(hangoutId, button) {
        const originalText = button.innerHTML;
        
        try {
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Leaving...';
            button.disabled = true;
            
            const response = await fetch(`/hangouts/${hangoutId}/leave`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Update button to join state
                button.className = 'join-btn bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium';
                button.innerHTML = '<i class="fas fa-plus mr-1"></i> Join';
                
                // Update attendee count
                const card = button.closest('.hangout-card');
                const countSpan = card.querySelector('.text-sm.text-gray-500');
                const newCount = result.attendee_count;
                
                if (newCount === 0) {
                    countSpan.textContent = 'Be the first to join!';
                } else if (newCount === 1) {
                    countSpan.textContent = '1 person going';
                } else {
                    countSpan.textContent = `${newCount} people going`;
                }
                
                // Show success message
                showTempMessage(result.message, 'success');
                
            } else {
                showTempMessage(result.message, 'error');
                button.innerHTML = originalText;
            }
            
        } catch (error) {
            console.error('Error leaving hangout:', error);
            showTempMessage('Failed to leave hangout', 'error');
            button.innerHTML = originalText;
        } finally {
            button.disabled = false;
        }
    }

    // Show temporary message function
    function showTempMessage(message, type = 'info') {
        const messageDiv = document.createElement('div');
        messageDiv.className = `fixed top-20 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white max-w-sm ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 
            'bg-blue-500'
        }`;
        
        messageDiv.innerHTML = `
            <div class="flex items-center justify-between">
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(messageDiv);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (messageDiv.parentElement) {
                messageDiv.remove();
            }
        }, 5000);
    }

    // Update time statuses every minute
    setInterval(() => {
        document.querySelectorAll('.time-status').forEach(statusElement => {
            const startTime = statusElement.dataset.startTime;
            if (startTime) {
                const now = new Date();
                const start = new Date(startTime);
                const diff = now - start;
                const diffMinutes = Math.floor(diff / 60000);
                
                if (diffMinutes >= 0) {
                    // Event has started
                    if (diffMinutes <= 180) {
                        statusElement.innerHTML = '<span class="text-green-600 font-medium">🔴 Live Now</span>';
                    } else {
                        statusElement.innerHTML = '<span class="text-gray-500">Ended</span>';
                    }
                } else {
                    // Event hasn't started yet
                    const minutesUntil = Math.abs(diffMinutes);
                    if (minutesUntil <= 30) {
                        statusElement.innerHTML = '<span class="text-orange-600 font-medium">⏰ Starting Soon</span>';
                    } else if (minutesUntil <= 60) {
                        statusElement.textContent = `In ${minutesUntil} min`;
                    } else {
                        const hours = Math.floor(minutesUntil / 60);
                        statusElement.textContent = `In ${hours}h`;
                    }
                }
            }
        });
    }, 60000); // Update every minute
});
</script>

<?= loadPartial('scripts'); ?>
<?= loadPartial('footer'); ?>
</body>
</html>