<?php
namespace App\Models;

class Message extends BaseModel {
    protected $table = 'messages';
    
    // Get conversation between two users
    public function getConversation($user1Id, $user2Id, $limit = 20) {
        $query = "SELECT m.*, 
                u_sender.first_name as sender_first_name, 
                u_sender.last_name as sender_last_name, 
                u_sender.profile_picture as sender_profile_picture
                FROM {$this->table} m
                JOIN users u_sender ON m.sender_id = u_sender.user_id
                WHERE (m.sender_id = :user1_id AND m.receiver_id = :user2_id)
                OR (m.sender_id = :user2_id AND m.receiver_id = :user1_id)
                ORDER BY m.sent_at DESC
                LIMIT :limit";
        $params = [
            'user1_id' => $user1Id,
            'user2_id' => $user2Id,
            'limit' => $limit
        ];
        $messages = $this->db->query($query, $params)->fetchAll();
        
        // Reverse to show oldest first
        return array_reverse($messages);
    }
    
    // Get all conversations for a user
    public function getUserConversations($userId) {
        $query = "SELECT 
                u.user_id, u.first_name, u.last_name, u.profile_picture,
                m.content, m.sent_at, m.is_read,
                (SELECT COUNT(*) FROM {$this->table} 
                 WHERE sender_id = u.user_id AND receiver_id = :user_id AND is_read = 0) as unread_count
                FROM users u
                JOIN (
                    SELECT 
                        CASE 
                            WHEN sender_id = :user_id THEN receiver_id
                            ELSE sender_id
                        END AS contact_id,
                        MAX(message_id) as latest_message_id
                    FROM {$this->table}
                    WHERE sender_id = :user_id OR receiver_id = :user_id
                    GROUP BY contact_id
                ) as latest ON (u.user_id = latest.contact_id)
                JOIN {$this->table} m ON m.message_id = latest.latest_message_id
                ORDER BY m.sent_at DESC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Mark messages as read
    public function markAsRead($senderId, $receiverId) {
        $query = "UPDATE {$this->table} 
                SET is_read = 1 
                WHERE sender_id = :sender_id AND receiver_id = :receiver_id AND is_read = 0";
        $params = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId
        ];
        return $this->db->query($query, $params);
    }
    
    // Get unread messages count
    public function getUnreadCount($userId) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
                WHERE receiver_id = :user_id AND is_read = 0";
        $params = ['user_id' => $userId];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }
    
    // Check if users have conversed before
    public function haveConversed($user1Id, $user2Id) {
        $query = "SELECT COUNT(*) as count FROM {$this->table}
                WHERE (sender_id = :user1_id AND receiver_id = :user2_id)
                OR (sender_id = :user2_id AND receiver_id = :user1_id)";
        $params = [
            'user1_id' => $user1Id,
            'user2_id' => $user2Id
        ];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count > 0;
    }
}