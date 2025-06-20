<?php
// App/views/listings/hangouts/show.view.php

// Set page variables
$pageTitle = 'Hangout Details';
$activePage = 'hangouts';
$isLoggedIn = true;

use Framework\Session;
$currentUserId = Session::get('user_id');

// Check if user is attending or hosting
$isHost = $hangout->host_id == $currentUserId;
$isAttending = false;
foreach($attendees as $attendee) {
    if ($attendee->user_id == $currentUserId) {
        $isAttending = true;
        break;
    }
}

// Helper function for profile pictures
function getShowProfilePicture($user) {
    if (empty($user->profile_picture) || $user->profile_picture === 'default_profile.jpg') {
        $name = ($user->first_name ?? 'U') . '+' . ($user->last_name ?? 'ser');
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&size=150&background=667eea&color=fff&rounded=true";
    }
    
    if (strpos($user->profile_picture, 'http') === 0) {
        return $user->profile_picture;
    }
    
    return "/uploads/profiles/{$user->profile_picture}";
}

// Calculate hangout status
$now = new DateTime();
$start = new DateTime($hangout->start_time);
$diff = $now->diff($start);

$hangoutStatus = '';
$statusColor = '';
$canJoin = true;

if ($start <= $now) {
    $minutesPast = $diff->i + ($diff->h * 60) + ($diff->days * 24 * 60);
    if ($minutesPast <= 180) {
        $hangoutStatus = '🔴 Live Now';
        $statusColor = 'text-green-600';
    } else {
        $hangoutStatus = 'Ended';
        $statusColor = 'text-gray-500';
        $canJoin = false;
    }
} else {
    $totalMinutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
    if ($totalMinutes <= 30) {
        $hangoutStatus = '⏰ Starting Soon';
        $statusColor = 'text-orange-600';
    } else {
        $hangoutStatus = 'Upcoming';
        $statusColor = 'text-blue-600';
    }
}

// Get activity details
function getActivityDetails($activityType) {
    $details = [
        'coffee' => ['emoji' => '☕', 'name' => 'Coffee', 'color' => 'bg-amber-100 text-amber-800'],
        'food' => ['emoji' => '🍕', 'name' => 'Food', 'color' => 'bg-blue-100 text-blue-800'],
        'walk' => ['emoji' => '🚶', 'name' => 'Walk', 'color' => 'bg-purple-100 text-purple-800'],
        'drink' => ['emoji' => '🍺', 'name' => 'Drinks', 'color' => 'bg-green-100 text-green-800']
    ];
    return $details[$activityType] ?? ['emoji' => '📍', 'name' => 'Hangout', 'color' => 'bg-gray-100 text-gray-800'];
}

$activityInfo = getActivityDetails($hangout->activity_type);
?>

<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>

<!-- Main Content -->
<div class="container mx-auto px-4 py-6 max-w-4xl mt-20">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="/hangouts" class="text-gray-600 hover:text-orange-600 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Hangouts
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Hangout Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Hangout Header Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($hangout->description) ?></h1>
                        <div class="flex items-center space-x-4">
                            <span class="<?= $activityInfo['color'] ?> px-3 py-1 rounded-full text-sm font-medium">
                                <?= $activityInfo['emoji'] ?> <?= $activityInfo['name'] ?>
                            </span>
                            <span class="<?= $statusColor ?> font-medium">
                                <?= $hangoutStatus ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Time and Location Info -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-clock text-orange-500 w-6"></i>
                        <div class="ml-3">
                            <div class="font-medium">
                                <?= date('l, F j, Y', strtotime($hangout->start_time)) ?>
                            </div>
                            <div class="text-sm text-gray-600">
                                <?= date('g:i A', strtotime($hangout->start_time)) ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-map-marker-alt text-orange-500 w-6"></i>
                        <div class="ml-3">
                            <div class="font-medium"><?= htmlspecialchars($hangout->location) ?></div>
                            <a href="https://maps.google.com/?q=<?= urlencode($hangout->location) ?>" 
                               target="_blank" 
                               class="text-sm text-orange-600 hover:underline">
                                View on Map <i class="fas fa-external-link-alt text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <?php if ($hangout->max_people): ?>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-users text-orange-500 w-6"></i>
                        <div class="ml-3">
                            <div class="font-medium">
                                <?= $hangout->attendee_count ?> / <?= $hangout->max_people ?> attending
                            </div>
                            <div class="text-sm text-gray-600">
                                <?= $hangout->max_people - $hangout->attendee_count ?> spots left
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-users text-orange-500 w-6"></i>
                        <div class="ml-3">
                            <div class="font-medium">
                                <?= $hangout->attendee_count ?> attending
                            </div>
                            <div class="text-sm text-gray-600">No attendee limit</div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <?php if ($isHost): ?>
                        <button class="flex-1 bg-gray-500 text-white py-3 px-4 rounded-lg font-medium cursor-not-allowed" disabled>
                            <i class="fas fa-crown mr-2"></i> You're Hosting
                        </button>
                        <form action="/hangouts/<?= $hangout->hangout_id ?>" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to cancel this hangout?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                <i class="fas fa-trash mr-2"></i> Cancel Hangout
                            </button>
                        </form>
                    <?php elseif ($isAttending): ?>
                        <button class="flex-1 bg-green-500 text-white py-3 px-4 rounded-lg font-medium cursor-not-allowed" disabled>
                            <i class="fas fa-check-circle mr-2"></i> You're Attending
                        </button>
                        <button class="flex-1 leave-btn bg-red-500 hover:bg-red-600 text-white py-3 px-4 rounded-lg font-medium transition-colors"
                                data-hangout-id="<?= $hangout->hangout_id ?>">
                            <i class="fas fa-times mr-2"></i> Leave Hangout
                        </button>
                    <?php elseif ($canJoin): ?>
                        <?php if ($hangout->max_people && $hangout->attendee_count >= $hangout->max_people): ?>
                            <button class="flex-1 bg-gray-400 text-white py-3 px-4 rounded-lg font-medium cursor-not-allowed" disabled>
                                <i class="fas fa-user-slash mr-2"></i> Hangout Full
                            </button>
                        <?php else: ?>
                            <button class="flex-1 join-btn bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors"
                                    data-hangout-id="<?= $hangout->hangout_id ?>">
                                <i class="fas fa-plus-circle mr-2"></i> Join Hangout
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="flex-1 bg-gray-400 text-white py-3 px-4 rounded-lg font-medium cursor-not-allowed" disabled>
                            <i class="fas fa-clock mr-2"></i> Hangout Ended
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Attendees Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-users text-orange-500 mr-2"></i> 
                    Attendees (<?= count($attendees) ?>)
                </h2>

                <?php if (empty($attendees)): ?>
                    <p class="text-gray-500 text-center py-8">No one has joined yet. Be the first!</p>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php foreach($attendees as $attendee): ?>
                            <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                <a href="/users/profile/<?= $attendee->user_id ?>" class="flex items-center space-x-3 flex-1">
                                    <img src="<?= htmlspecialchars(getShowProfilePicture($attendee)) ?>" 
                                         alt="<?= htmlspecialchars($attendee->first_name . ' ' . $attendee->last_name) ?>" 
                                         class="w-12 h-12 rounded-full object-cover">
                                    <div>
                                        <div class="font-medium text-gray-800">
                                            <?= htmlspecialchars($attendee->first_name . ' ' . $attendee->last_name) ?>
                                            <?php if ($attendee->user_id == $hangout->host_id): ?>
                                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full ml-2">Host</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <?= htmlspecialchars($attendee->city . ', ' . $attendee->country) ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column - Host Info -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Host Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-user-circle text-orange-500 mr-2"></i> Host
                </h2>
                
                <div class="text-center">
                    <a href="/users/profile/<?= $hangout->host_id ?>" class="inline-block">
                        <img src="<?= htmlspecialchars(getShowProfilePicture($hangout)) ?>" 
                             alt="<?= htmlspecialchars($hangout->first_name . ' ' . $hangout->last_name) ?>" 
                             class="w-24 h-24 rounded-full mx-auto mb-3 object-cover hover:ring-4 hover:ring-orange-200 transition-all">
                    </a>
                    <h3 class="font-medium text-gray-800">
                        <?= $isHost ? 'You' : htmlspecialchars($hangout->first_name . ' ' . $hangout->last_name) ?>
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        <?= htmlspecialchars($hangout->city . ', ' . $hangout->country) ?>
                    </p>
                    
                    <?php if (!$isHost): ?>
                        <div class="space-y-2">
                            <a href="/users/profile/<?= $hangout->host_id ?>" 
                               class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-user mr-2"></i> View Profile
                            </a>
                            <a href="/messages/<?= $hangout->host_id ?>" 
                               class="block w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg transition-colors">
                                <i class="fas fa-envelope mr-2"></i> Send Message
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message Container -->
<div id="messageContainer" class="fixed top-20 right-4 z-50"></div>

<!-- FIXED JAVASCRIPT SECTION -->
<script>
console.log('Hangout show page script starting...');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing hangout functionality');
    
    // Add event delegation for join/leave buttons
    document.addEventListener('click', handleButtonClick);
    
    console.log('Event listeners attached successfully');
});

async function handleButtonClick(e) {
    console.log('Click detected on:', e.target);
    
    // Check if click is on join button or inside it
    const joinBtn = e.target.closest('.join-btn');
    if (joinBtn) {
        e.preventDefault();
        console.log('Join button clicked');
        
        const hangoutId = joinBtn.dataset.hangoutId;
        console.log('Hangout ID:', hangoutId);
        
        if (!hangoutId) {
            console.error('No hangout ID found');
            showMessage('Error: No hangout ID found', 'error');
            return;
        }
        
        await handleJoin(hangoutId, joinBtn);
        return;
    }
    
    // Check if click is on leave button or inside it
    const leaveBtn = e.target.closest('.leave-btn');
    if (leaveBtn) {
        e.preventDefault();
        console.log('Leave button clicked');
        
        const hangoutId = leaveBtn.dataset.hangoutId;
        console.log('Hangout ID:', hangoutId);
        
        if (!hangoutId) {
            console.error('No hangout ID found');
            showMessage('Error: No hangout ID found', 'error');
            return;
        }
        
        if (confirm('Are you sure you want to leave this hangout?')) {
            await handleLeave(hangoutId, leaveBtn);
        }
        return;
    }
}

async function handleJoin(hangoutId, button) {
    console.log(`Starting join process for hangout ${hangoutId}`);
    
    const originalHTML = button.innerHTML;
    
    try {
        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Joining...';
        button.disabled = true;
        
        console.log('Making fetch request...');
        
        const response = await fetch(`/hangouts/${hangoutId}/join`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });
        
        console.log('Response received:', response.status, response.statusText);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('HTTP Error:', response.status, errorText);
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const contentType = response.headers.get('content-type');
        console.log('Content-Type:', contentType);
        
        if (!contentType || !contentType.includes('application/json')) {
            const textResponse = await response.text();
            console.error('Non-JSON response received:', textResponse);
            throw new Error('Server returned non-JSON response');
        }
        
        const data = await response.json();
        console.log('Join response data:', data);
        
        if (data.success) {
            showMessage(data.message || 'Successfully joined!', 'success');
            // Reload page after short delay
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showMessage(data.message || 'Failed to join hangout', 'error');
            button.innerHTML = originalHTML;
            button.disabled = false;
        }
        
    } catch (error) {
        console.error('Join error:', error);
        showMessage(`Error: ${error.message}`, 'error');
        button.innerHTML = originalHTML;
        button.disabled = false;
    }
}

async function handleLeave(hangoutId, button) {
    console.log(`Starting leave process for hangout ${hangoutId}`);
    
    const originalHTML = button.innerHTML;
    
    try {
        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Leaving...';
        button.disabled = true;
        
        console.log('Making leave request...');
        
        const response = await fetch(`/hangouts/${hangoutId}/leave`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });
        
        console.log('Leave response received:', response.status, response.statusText);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('HTTP Error:', response.status, errorText);
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const textResponse = await response.text();
            console.error('Non-JSON response received:', textResponse);
            throw new Error('Server returned non-JSON response');
        }
        
        const data = await response.json();
        console.log('Leave response data:', data);
        
        if (data.success) {
            showMessage(data.message || 'Successfully left hangout', 'success');
            // Reload page after short delay
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showMessage(data.message || 'Failed to leave hangout', 'error');
            button.innerHTML = originalHTML;
            button.disabled = false;
        }
        
    } catch (error) {
        console.error('Leave error:', error);
        showMessage(`Error: ${error.message}`, 'error');
        button.innerHTML = originalHTML;
        button.disabled = false;
    }
}

function showMessage(message, type = 'info') {
    console.log(`Showing message: ${message} (${type})`);
    
    // Remove existing messages
    document.querySelectorAll('.notification-message').forEach(msg => msg.remove());
    
    const container = document.getElementById('messageContainer');
    if (!container) {
        console.error('Message container not found');
        return;
    }
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `notification-message px-6 py-3 rounded-lg shadow-lg text-white max-w-sm mb-3 ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 
        'bg-blue-500'
    }`;
    
    messageDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    container.appendChild(messageDiv);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentElement) {
            messageDiv.remove();
        }
    }, 5000);
}

console.log('Script loaded successfully');
</script>

<?= loadPartial('scripts'); ?>
<?= loadPartial('footer'); ?>
</body>
</html>