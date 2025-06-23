<?php
namespace App\Models;

class Message extends BaseModel {
    protected $table = 'messages';
    
    /**
     * Get conversation between two users
     */
    public function getConversation($userId1, $userId2, $limit = 50) {
        $query = "SELECT m.*, 
                         sender.first_name as sender_name,
                         sender.profile_picture as sender_picture,
                         receiver.first_name as receiver_name,
                         receiver.profile_picture as receiver_picture
                  FROM {$this->table} m
                  JOIN users sender ON m.sender_id = sender.user_id
                  JOIN users receiver ON m.receiver_id = receiver.user_id
                  WHERE (m.sender_id = :user1 AND m.receiver_id = :user2)
                     OR (m.sender_id = :user2 AND m.receiver_id = :user1)
                  ORDER BY m.created_at DESC
                  LIMIT :limit";
        
        $params = [
            'user1' => $userId1,
            'user2' => $userId2,
            'limit' => $limit
        ];
        
        return array_reverse($this->db->query($query, $params)->fetchAll());
    }
    
    /**
     * Send a message
     */
    public function sendMessage($senderId, $receiverId, $message) {
        // First check if users are friends
        $friendship = new Friendship();
        if (!$friendship->areFriends($senderId, $receiverId)) {
            return false;
        }
        
        $query = "INSERT INTO {$this->table} (sender_id, receiver_id, message_content) 
                  VALUES (:sender_id, :receiver_id, :message)";
        
        $params = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message
        ];
        
        $result = $this->db->query($query, $params);
        
        if ($result) {
            $messageId = $this->db->conn->lastInsertId();
            $this->updateConversation($senderId, $receiverId, $messageId);
            return $messageId;
        }
        
        return false;
    }
    
    /**
     * Get all conversations for a user
     */
    public function getUserConversations($userId) {
        $query = "SELECT DISTINCT
                    CASE 
                        WHEN m.sender_id = :user_id THEN m.receiver_id
                        ELSE m.sender_id
                    END as friend_id,
                    u.first_name,
                    u.last_name,
                    u.profile_picture,
                    MAX(m.created_at) as last_message_time,
                    (SELECT message_content 
                     FROM {$this->table} m2 
                     WHERE ((m2.sender_id = :user_id AND m2.receiver_id = friend_id) 
                           OR (m2.receiver_id = :user_id AND m2.sender_id = friend_id))
                     ORDER BY m2.created_at DESC 
                     LIMIT 1) as last_message,
                    (SELECT COUNT(*) 
                     FROM {$this->table} m3 
                     WHERE m3.sender_id = friend_id 
                           AND m3.receiver_id = :user_id 
                           AND m3.is_read = FALSE) as unread_count
                  FROM {$this->table} m
                  JOIN users u ON (
                    (m.sender_id = u.user_id AND m.receiver_id = :user_id) OR
                    (m.receiver_id = u.user_id AND m.sender_id = :user_id)
                  )
                  WHERE m.sender_id = :user_id OR m.receiver_id = :user_id
                  GROUP BY friend_id, u.first_name, u.last_name, u.profile_picture
                  ORDER BY last_message_time DESC";
        
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Mark messages as read
     */
    public function markAsRead($senderId, $receiverId) {
        $query = "UPDATE {$this->table} 
                  SET is_read = TRUE 
                  WHERE sender_id = :sender_id AND receiver_id = :receiver_id AND is_read = FALSE";
        
        $params = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId
        ];
        
        return $this->db->query($query, $params);
    }
    
    /**
     * Get unread message count
     */
    public function getUnreadCount($userId) {
        $query = "SELECT COUNT(*) as count 
                  FROM {$this->table} 
                  WHERE receiver_id = :user_id AND is_read = FALSE";
        
        $params = ['user_id' => $userId];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }
    
    /**
     * Update conversation table
     */
    private function updateConversation($userId1, $userId2, $messageId) {
        // Ensure consistent order for conversation
        $user1 = min($userId1, $userId2);
        $user2 = max($userId1, $userId2);
        
        $query = "INSERT INTO conversations (user1_id, user2_id, last_message_id, last_activity)
                  VALUES (:user1, :user2, :message_id, NOW())
                  ON DUPLICATE KEY UPDATE 
                  last_message_id = :message_id, 
                  last_activity = NOW()";
        
        $params = [
            'user1' => $user1,
            'user2' => $user2,
            'message_id' => $messageId
        ];
        
        return $this->db->query($query, $params);
    }
    
    /**
     * Execute a custom query
     */
    public function query($sql, $params = []) {
        return $this->db->query($sql, $params);
    }
    
    /**
     * Delete a message
     */
    public function deleteMessage($messageId, $userId) {
        $query = "DELETE FROM {$this->table} 
                  WHERE message_id = :message_id AND sender_id = :user_id";
        
        $params = [
            'message_id' => $messageId,
            'user_id' => $userId
        ];
        
        return $this->db->query($query, $params);
    }
}