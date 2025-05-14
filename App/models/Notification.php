<?php
namespace App\Models;

class Notification extends BaseModel {
    protected $table = 'notifications';
    
    // Get notifications for a user
    public function getUserNotifications($userId, $limit = 20) {
        $query = "SELECT * FROM {$this->table}
                WHERE user_id = :user_id
                ORDER BY created_at DESC
                LIMIT :limit";
        $params = [
            'user_id' => $userId,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get unread notifications count
    public function getUnreadCount($userId) {
        $query = "SELECT COUNT(*) as count FROM {$this->table}
                WHERE user_id = :user_id AND is_read = 0";
        $params = ['user_id' => $userId];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }
    
    // Mark notification as read
    public function markAsRead($notificationId) {
        $query = "UPDATE {$this->table} SET is_read = 1 WHERE notification_id = :notification_id";
        $params = ['notification_id' => $notificationId];
        return $this->db->query($query, $params);
    }
    
    // Mark all notifications as read
    public function markAllAsRead($userId) {
        $query = "UPDATE {$this->table} SET is_read = 1 WHERE user_id = :user_id AND is_read = 0";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params);
    }
    
    // Create event invitation notification
    public function createEventInvitation($userId, $eventId, $inviterId) {
        $query = "INSERT INTO {$this->table} (user_id, type, related_id, content)
                VALUES (:user_id, 'event_invitation', :event_id, :content)";
        
        // Get event and inviter details
        $eventModel = new Event();
        $userModel = new User();
        
        $event = $eventModel->getById($eventId);
        $inviter = $userModel->getById($inviterId);
        
        if (!$event || !$inviter) {
            return false;
        }
        
        $content = "{$inviter->first_name} {$inviter->last_name} invited you to {$event->title}";
        
        $params = [
            'user_id' => $userId,
            'event_id' => $eventId,
            'content' => $content
        ];
        
        return $this->db->query($query, $params);
    }
    
    // Create friend request notification
    public function createFriendRequest($userId, $requesterId) {
        $query = "INSERT INTO {$this->table} (user_id, type, related_id, content)
                VALUES (:user_id, 'friend_request', :requester_id, :content)";
        
        // Get requester details
        $userModel = new User();
        $requester = $userModel->getById($requesterId);
        
        if (!$requester) {
            return false;
        }
        
        $content = "{$requester->first_name} {$requester->last_name} sent you a friend request";
        
        $params = [
            'user_id' => $userId,
            'requester_id' => $requesterId,
            'content' => $content
        ];
        
        return $this->db->query($query, $params);
    }
    
    // Create event reminder notification
    public function createEventReminder($userId, $eventId) {
        $query = "INSERT INTO {$this->table} (user_id, type, related_id, content)
                VALUES (:user_id, 'event_reminder', :event_id, :content)";
        
        // Get event details
        $eventModel = new Event();
        $event = $eventModel->getById($eventId);
        
        if (!$event) {
            return false;
        }
        
        $content = "Reminder: {$event->title} is tomorrow!";
        
        $params = [
            'user_id' => $userId,
            'event_id' => $eventId,
            'content' => $content
        ];
        
        return $this->db->query($query, $params);
    }
}
?>

<script>
// Function to update notification count
function updateNotificationCount() {
    fetch('/api/notifications/count')
        .then(response => response.json())
        .then(data => {
            const notificationBadge = document.querySelector('.notification-badge');
            if (notificationBadge && data.count) {
                notificationBadge.textContent = data.count;
                notificationBadge.style.display = data.count > 0 ? 'flex' : 'none';
            }
        })
        .catch(error => console.error('Error updating notification count:', error));
}

// Update notification count every 60 seconds
if (document.querySelector('.notification-badge')) {
    setInterval(updateNotificationCount, 60000);
}
</script>
