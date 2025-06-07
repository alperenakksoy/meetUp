<?php
// Set page variables
$pageTitle = 'Notifications - SocialLoop';
$activePage = 'notifications';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>

<!-- Main Content -->
<div class="container max-w-4xl mx-auto px-5 mt-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Notifications</h1>
            <p class="text-gray-600 mt-1">Stay updated with your latest activities</p>
        </div>
        <?php if($unreadCount > 0): ?>
            <button id="markAllRead" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                <i class="fas fa-check-double mr-2"></i>Mark All as Read
            </button>
        <?php endif; ?>
    </div>

    <!-- Notification Stats -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Unread: <span class="font-semibold" id="unreadCount"><?= $unreadCount ?></span></span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-gray-300 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Total: <span class="font-semibold"><?= count($notifications) ?></span></span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <i class="fas fa-sync-alt mr-1"></i>
                <span id="lastUpdated">Just updated</span>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="space-y-3" id="notificationsList">
        <?php if(count($notifications) > 0): ?>
            <?php foreach($notifications as $notification): ?>
                <div class="notification-item bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:border-orange-300 transition duration-200 <?= $notification->is_read ? '' : 'bg-orange-50 border-orange-200' ?>" 
                     data-notification-id="<?= $notification->notification_id ?>"
                     data-is-read="<?= $notification->is_read ? 'true' : 'false' ?>">
                    
                    <div class="flex items-start space-x-4">
                        <!-- Notification Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                                <i class="<?= $notification->icon ?> <?= $notification->color_class ?>"></i>
                            </div>
                        </div>
                        
                        <!-- Notification Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-sm font-medium text-gray-900 capitalize">
                                    <?= str_replace('_', ' ', $notification->type) ?>
                                </p>
                                <div class="flex items-center space-x-2">
                                    <?php if(!$notification->is_read): ?>
                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                    <?php endif; ?>
                                    <span class="text-xs text-gray-500"><?= $notification->time_ago ?></span>
                                </div>
                            </div>
                            
                            <p class="text-sm text-gray-700 mb-2">
                                <?= $notification->formatted_content ?>
                            </p>
                            
                            <!-- Notification Actions -->
                            <div class="flex items-center space-x-3">
                                <?php if(!$notification->is_read): ?>
                                    <button class="mark-read-btn text-xs text-orange-600 hover:text-orange-700 font-medium" 
                                            data-notification-id="<?= $notification->notification_id ?>">
                                        <i class="fas fa-check mr-1"></i>Mark as Read
                                    </button>
                                <?php endif; ?>
                                
                                <!-- Type-specific action buttons -->
                                <?php if($notification->type === 'friend_request'): ?>
                                    <a href="/users/friends" class="text-xs text-blue-600 hover:text-blue-700 font-medium">
                                        <i class="fas fa-user-friends mr-1"></i>View Requests
                                    </a>
                                <?php elseif($notification->type === 'event_invitation'): ?>
                                    <a href="/events/<?= $notification->related_id ?>" class="text-xs text-green-600 hover:text-green-700 font-medium">
                                        <i class="fas fa-calendar mr-1"></i>View Event
                                    </a>
                                <?php elseif($notification->type === 'new_message'): ?>
                                    <a href="/messages/<?= $notification->related_id ?>" class="text-xs text-purple-600 hover:text-purple-700 font-medium">
                                        <i class="fas fa-reply mr-1"></i>Reply
                                    </a>
                                <?php elseif($notification->type === 'new_review'): ?>
                                    <a href="/users/references" class="text-xs text-indigo-600 hover:text-indigo-700 font-medium">
                                        <i class="fas fa-star mr-1"></i>View Review
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No notifications yet</h3>
                <p class="text-gray-500 mb-4">When you receive notifications, they'll appear here.</p>
                <a href="/events" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium">
                    <i class="fas fa-calendar mr-2"></i>
                    Explore Events
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Load More Button (if needed) -->
    <?php if(count($notifications) >= 50): ?>
        <div class="text-center mt-6">
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition duration-200">
                <i class="fas fa-chevron-down mr-2"></i>Load More
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-orange-500"></div>
        <span class="text-gray-700">Processing...</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark individual notification as read
    const markReadBtns = document.querySelectorAll('.mark-read-btn');
    markReadBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const notificationId = this.getAttribute('data-notification-id');
            markNotificationAsRead(notificationId);
        });
    });

    // Mark all notifications as read
    const markAllReadBtn = document.getElementById('markAllRead');
    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function() {
            markAllNotificationsAsRead();
        });
    }

    // Auto-refresh notifications every 60 seconds
    setInterval(function() {
        updateNotificationCount();
        updateLastUpdatedTime();
    }, 60000);

    // Mark notification as read when clicking on the notification item
    const notificationItems = document.querySelectorAll('.notification-item');
    notificationItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Don't mark as read if clicking on action buttons
            if (e.target.closest('button') || e.target.closest('a')) {
                return;
            }
            
            const notificationId = this.getAttribute('data-notification-id');
            const isRead = this.getAttribute('data-is-read') === 'true';
            
            if (!isRead) {
                markNotificationAsRead(notificationId);
            }
        });
    });
});

function markNotificationAsRead(notificationId) {
    showLoading();
    
    fetch(`/api/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            // Update the notification item UI
            const notificationItem = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notificationItem) {
                notificationItem.classList.remove('bg-orange-50', 'border-orange-200');
                notificationItem.setAttribute('data-is-read', 'true');
                
                // Remove the unread indicator
                const unreadDot = notificationItem.querySelector('.w-2.h-2.bg-red-500');
                if (unreadDot) {
                    unreadDot.remove();
                }
                
                // Remove the mark as read button
                const markReadBtn = notificationItem.querySelector('.mark-read-btn');
                if (markReadBtn) {
                    markReadBtn.remove();
                }
            }
            
            // Update unread count
            updateUnreadCount();
            updateNotificationCount();
        } else {
            showNotification('Error marking notification as read', 'error');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    });
}

function markAllNotificationsAsRead() {
    showLoading();
    
    fetch('/api/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            // Update all notification items UI
            const notificationItems = document.querySelectorAll('.notification-item');
            notificationItems.forEach(item => {
                item.classList.remove('bg-orange-50', 'border-orange-200');
                item.setAttribute('data-is-read', 'true');
                
                // Remove unread indicators
                const unreadDot = item.querySelector('.w-2.h-2.bg-red-500');
                if (unreadDot) {
                    unreadDot.remove();
                }
                
                // Remove mark as read buttons
                const markReadBtn = item.querySelector('.mark-read-btn');
                if (markReadBtn) {
                    markReadBtn.remove();
                }
            });
            
            // Hide the mark all as read button
            const markAllReadBtn = document.getElementById('markAllRead');
            if (markAllReadBtn) {
                markAllReadBtn.style.display = 'none';
            }
            
            // Update unread count
            document.getElementById('unreadCount').textContent = '0';
            updateNotificationCount();
            
            showNotification('All notifications marked as read', 'success');
        } else {
            showNotification('Error marking notifications as read', 'error');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    });
}

function updateNotificationCount() {
    fetch('/api/notifications/count')
        .then(response => response.json())
        .then(data => {
            // Update navbar notification badge
            const navNotificationBadges = document.querySelectorAll('.notification-badge');
            navNotificationBadges.forEach(badge => {
                if (data.count > 0) {
                    badge.textContent = data.count > 99 ? '99+' : data.count;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            });
        })
        .catch(error => console.error('Error updating notification count:', error));
}

function updateUnreadCount() {
    const unreadItems = document.querySelectorAll('.notification-item[data-is-read="false"]').length;
    document.getElementById('unreadCount').textContent = unreadItems;
    
    if (unreadItems === 0) {
        const markAllReadBtn = document.getElementById('markAllRead');
        if (markAllReadBtn) {
            markAllReadBtn.style.display = 'none';
        }
    }
}

function updateLastUpdatedTime() {
    document.getElementById('lastUpdated').textContent = 'Just updated';
}

function showLoading() {
    document.getElementById('loadingOverlay').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loadingOverlay').classList.add('hidden');
}

function showNotification(message, type = 'info') {
    // Create a simple notification toast
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    } text-white`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check' : type === 'error' ? 'fa-times' : 'fa-info'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}
</script>

<?= loadPartial('scripts'); ?>
<?= loadPartial('footer'); ?>
</body>
</html>