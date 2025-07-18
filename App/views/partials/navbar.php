<?php
use Framework\Session;
use App\Models\Message;

// Get user session data
$user = Session::get('user');
$isLoggedIn = Session::get('is_logged_in', false);
$userId = Session::get('user_id');

// Function to get profile picture URL
if (!function_exists('getNavbarProfilePicture')) {
    function getNavbarProfilePicture($user) {
        // Add array check for extra safety
        if (!$user || !is_array($user) || empty($user['profile_picture']) || $user['profile_picture'] === 'default_profile.jpg') {
            $firstName = $user['first_name'] ?? 'U';
            $lastName = $user['last_name'] ?? 'ser';
           
            return "https://ui-avatars.com/api/?name=" . urlencode($firstName . '+' . $lastName) . "&size=40&background=f97316&color=fff&rounded=true";
        }
        
        // Check if it's already a full URL
        if (strpos($user['profile_picture'], 'http') === 0) {
            return $user['profile_picture'];
        }
        
        // Local file path
        return "/uploads/profiles/" . $user['profile_picture'];
    }
}

// Get notification count for logged-in users
$notificationCount = 0;
if ($isLoggedIn && $userId) {
    $notificationCount = getNotificationCount();
}
?>

<!-- Navbar -->
<nav class="bg-white shadow-lg fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-orange-600 font-volkhov">
                    SocialLoop
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-gray-700 hover:text-orange-600 transition-colors">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <a href="/events" class="text-gray-700 hover:text-orange-600 transition-colors">
                    <i class="fas fa-calendar-alt mr-1"></i> Events
                </a>
                <a href="/hangouts/index" class="text-gray-700 hover:text-orange-600 transition-colors">
                    <i class="fas fa-list-alt mr-2"></i> Hangouts
                </a>
                <a href="/users/friends/<?=$userId?>" class="text-gray-700 hover:text-orange-600 transition-colors">
                    <i class="fas fa-users mr-1"></i> Friends
                </a>
                <a href="/messages" class="text-gray-700 hover:text-orange-600 transition-colors relative">
                    <i class="fas fa-envelope mr-1"></i> Messages
                    <span id="messagesBadge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full min-w-[20px] h-5 flex items-center justify-center font-bold hidden animate-pulse">
                        0
                    </span>
                </a>
            </div>

            <!-- User Menu -->
            <?php if ($isLoggedIn): ?>
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <a href="/notifications" class="text-gray-700 hover:text-orange-600 transition-colors relative block p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-bell text-xl"></i>
                            <?php if ($notificationCount > 0): ?>
                                <span class="notification-badge absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold animate-pulse">
                                    <?= $notificationCount > 99 ? '99+' : $notificationCount ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-2 text-gray-700 hover:text-orange-600 transition-colors focus:outline-none">
                            <!-- Profile Picture -->
                            <img src="<?= htmlspecialchars(getNavbarProfilePicture($user)) ?>" 
                                 alt="<?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>" 
                                 class="w-10 h-10 rounded-full border-2 border-gray-200 hover:border-orange-500 transition-colors object-cover"
                                 onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode(($user['first_name'] ?? 'U') . '+' . ($user['last_name'] ?? 'ser')) ?>&size=40&background=dc2626&color=fff&rounded=true';">
          
                            <!-- Dropdown Arrow -->
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdownMenu" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <img src="<?= htmlspecialchars(getNavbarProfilePicture($user)) ?>" 
                                         alt="Profile" 
                                         class="w-12 h-12 rounded-full object-cover">
                                    <div>
                                        <div class="font-semibold text-gray-800">
                                            <?php
                                                $fullname = strtolower(($user['first_name'] ?? '') . " " . ($user['last_name'] ?? ''));
                                                $fullname = ucwords($fullname);
                                            ?>
                                            <?= htmlspecialchars($fullname) ?>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <?= htmlspecialchars($user['email'] ?? '') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-2">
                                <a href="/users/profile" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-user mr-3 text-orange-500"></i>
                                    View Profile
                                </a>
                                <a href="/users/edit" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-edit mr-3 text-orange-500"></i>
                                    Edit Profile
                                </a>
                                <a href="/users/settings" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-cog mr-3 text-orange-500"></i>
                                    Settings
                                </a>
                                
                                <!-- Admin Link (if admin) -->
                                <?php if (isset($user['is_admin']) && $user['is_admin']): ?>
                                    <div class="border-t border-gray-200 mt-2 pt-2">
                                        <a href="/admin/dashboard" class="flex items-center px-4 py-2 text-purple-700 hover:bg-purple-50 transition-colors">
                                            <i class="fas fa-shield-alt mr-3 text-purple-500"></i>
                                            Admin Panel
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Logout -->
                                <div class="border-t border-gray-200 mt-2 pt-2">
                                    <form method="POST" action="/logout" class="m-0">
                                        <button type="submit" class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-red-50 transition-colors text-left">
                                            <i class="fas fa-sign-out-alt mr-3 text-red-500"></i>
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Login/Register buttons for non-logged-in users -->
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-orange-600 transition-colors">
                        Login
                    </a>
                    <a href="/register" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Sign Up
                    </a>
                </div>
            <?php endif; ?>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobileMenuButton" class="text-gray-700 hover:text-orange-600 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden bg-white border-t border-gray-200">
            <div class="px-4 py-4 space-y-4">
                <?php if ($isLoggedIn): ?>
                    <!-- Mobile User Info -->
                    <div class="flex items-center space-x-3 pb-4 border-b border-gray-200">
                        <img src="<?= htmlspecialchars(getNavbarProfilePicture($user)) ?>" 
                             alt="Profile" 
                             class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <div class="font-semibold text-gray-800">
                                <?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>
                            </div>
                            <div class="text-sm text-gray-600">
                                <?= htmlspecialchars($user['email'] ?? '') ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Navigation Links -->
                    <a href="/" class="block py-2 text-gray-700 hover:text-orange-600 transition-colors">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="/events" class="block py-2 text-gray-700 hover:text-orange-600 transition-colors">
                        <i class="fas fa-calendar-alt mr-2"></i> Events
                    </a>
                    <a href="/hangouts/index" class="block py-2 text-gray-700 hover:text-orange-600 transition-colors">
                        <i class="fas fa-list-alt mr-2"></i> Hangouts
                    </a>
                    <a href="/users/friends/<?=$userId?>" class="block py-2 text-gray-700 hover:text-orange-600 transition-colors">
                        <i class="fas fa-users mr-2"></i> Friends
                    </a>
                    <?php if(isset($user)): ?>
                    <a href="/messages" class="block py-2 text-gray-700 hover:text-orange-600 transition-colors relative">
                        <i class="fas fa-envelope mr-2"></i> Messages
                        <span id="messagesBadgeMobile" class="absolute top-1 left-8 bg-red-500 text-white text-xs rounded-full min-w-[16px] h-4 flex items-center justify-center font-bold hidden text-[10px]">
                            0
                        </span>
                    </a>
                    <?php endif; ?>
                    <a href="/notifications" class="flex items-center justify-between py-2 text-gray-700 hover:text-orange-600 transition-colors">
                        <span><i class="fas fa-bell mr-2"></i> Notifications</span>
                        <?php if ($notificationCount > 0): ?>
                            <span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                <?= $notificationCount > 99 ? '99+' : $notificationCount ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <a href="/users/profile" class="block py-2 text-gray-700 hover:text-orange-600 transition-colors">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    
                    <form method="POST" action="/logout" class="pt-4 border-t border-gray-200">
                        <button type="submit" class="w-full text-left py-2 text-red-600 hover:text-red-700 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                        </button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="block py-2 text-gray-700 hover:text-orange-600 transition-colors">
                        Login
                    </a>
                    <a href="/register" class="block py-2 bg-orange-600 text-white text-center rounded-lg hover:bg-orange-700 transition-colors">
                        Sign Up
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript and CSS for Navbar Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // User dropdown toggle
    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdownMenu = document.getElementById('userDropdownMenu');
    
    if (userMenuButton && userDropdownMenu) {
        userMenuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuButton.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }

    <?php if(isset($user) && $isLoggedIn): ?>
    
    // Function to update unread message count
    function updateUnreadMessageCount() {
        fetch('/messages/unread-count')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Unread count response:', data);
                
                // Get badge elements
                const desktopBadge = document.getElementById('messagesBadge');
                const mobileBadge = document.getElementById('messagesBadgeMobile');
                
                if (data.success && data.count > 0) {
                    // Show badges with count
                    const displayCount = data.count > 99 ? '99+' : data.count.toString();
                    
                    if (desktopBadge) {
                        desktopBadge.textContent = displayCount;
                        desktopBadge.classList.remove('hidden');
                        desktopBadge.classList.add('message-badge');
                    }
                    
                    if (mobileBadge) {
                        mobileBadge.textContent = displayCount;
                        mobileBadge.classList.remove('hidden');
                        mobileBadge.classList.add('message-badge');
                    }
                    
                    // Update page title with unread count
                    const originalTitle = document.title.replace(/^\(\d+\)\s/, '');
                    document.title = `(${data.count}) ${originalTitle}`;
                    
                } else {
                    // Hide badges when no unread messages
                    if (desktopBadge) {
                        desktopBadge.classList.add('hidden');
                        desktopBadge.classList.remove('message-badge');
                    }
                    
                    if (mobileBadge) {
                        mobileBadge.classList.add('hidden');
                        mobileBadge.classList.remove('message-badge');
                    }
                    
                    // Reset page title
                    const originalTitle = document.title.replace(/^\(\d+\)\s/, '');
                    document.title = originalTitle;
                }
            })
            .catch(error => {
                console.error('Error fetching unread message count:', error);
            });
    }
    
    // Update count immediately when page loads
    updateUnreadMessageCount();
    
    // Update count every 30 seconds for real-time updates
    setInterval(updateUnreadMessageCount, 30000);
    
    // Update when user focuses on the page (in case they read messages in another tab)
    window.addEventListener('focus', updateUnreadMessageCount);
    
    // Update when user returns from messages page
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || window.location.pathname.includes('/messages')) {
            setTimeout(updateUnreadMessageCount, 1000);
        }
    });
    
    // Optional: Clear badge when user clicks on messages link
    const messagesLinks = document.querySelectorAll('a[href="/messages"]');
    messagesLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Small delay to let the page navigation happen
            setTimeout(() => {
                const desktopBadge = document.getElementById('messagesBadge');
                const mobileBadge = document.getElementById('messagesBadgeMobile');
                
                if (desktopBadge) desktopBadge.classList.add('hidden');
                if (mobileBadge) mobileBadge.classList.add('hidden');
            }, 500);
        });
    });
    
    <?php endif; ?>
});

// Function to manually update badge (useful for when messages are sent/read)
function updateMessageBadge() {
    if (typeof updateUnreadMessageCount === 'function') {
        updateUnreadMessageCount();
    }
}
</script>

<style>
.message-badge {
    animation: pulse 2s infinite;
    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
}

@keyframes pulse {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
    }
    
    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
    }
    
    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
    }
}

/* Ensure badge stays on top */
.relative .absolute {
    z-index: 10;
}

/* Fix dropdown menu positioning */
#userDropdownMenu {
    z-index: 1000;
}

/* Mobile menu improvements */
@media (max-width: 768px) {
    #mobileMenu {
        transition: all 0.3s ease;
    }
    
    #mobileMenu.hidden {
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
    }
    
    #mobileMenu:not(.hidden) {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
}

/* Improved hover effects */
.hover\:bg-gray-100:hover {
    background-color: rgb(243 244 246);
}

.hover\:bg-red-50:hover {
    background-color: rgb(254 242 242);
}

.hover\:bg-purple-50:hover {
    background-color: rgb(250 245 255);
}
</style>