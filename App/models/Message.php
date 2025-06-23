<?php
namespace App\Models;
use Exception;

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
    
  
public function sendMessage($senderId, $receiverId, $message) {
    // Remove the duplicate friendship check - it's already done in controller
    
    $query = "INSERT INTO {$this->table} (sender_id, receiver_id, message_content) 
              VALUES (:sender_id, :receiver_id, :message)";
    
    $params = [
        'sender_id' => $senderId,
        'receiver_id' => $receiverId,
        'message' => $message
    ];
    
    try {
        $result = $this->db->query($query, $params);
        
        if ($result) {
            $messageId = $this->db->conn->lastInsertId();
            error_log("Message inserted with ID: " . $messageId);
            
            // Update conversation table
            $this->updateConversation($senderId, $receiverId, $messageId);
            return $messageId;
        } else {
            error_log("Failed to insert message into database");
            return false;
        }
    } catch (Exception $e) {
        error_log("Error in sendMessage: " . $e->getMessage());
        return false;
    }
}
    public function getUserConversations($userId) {
        $query = "
            SELECT DISTINCT
                CASE 
                    WHEN m.sender_id = :user_id THEN m.receiver_id 
                    ELSE m.sender_id 
                END as friend_id,
                u.first_name,
                u.last_name,
                u.profile_picture,
                u.email,
                (SELECT message_content 
                 FROM messages m2 
                 WHERE (m2.sender_id = :user_id2 AND m2.receiver_id = friend_id) 
                    OR (m2.sender_id = friend_id AND m2.receiver_id = :user_id3)
                 ORDER BY m2.created_at DESC 
                 LIMIT 1) as last_message,
                (SELECT created_at 
                 FROM messages m3 
                 WHERE (m3.sender_id = :user_id4 AND m3.receiver_id = friend_id) 
                    OR (m3.sender_id = friend_id AND m3.receiver_id = :user_id5)
                 ORDER BY m3.created_at DESC 
                 LIMIT 1) as last_message_time,
                (SELECT COUNT(*) 
                 FROM messages m4 
                 WHERE m4.sender_id = friend_id 
                   AND m4.receiver_id = :user_id6 
                   AND m4.is_read = 0) as unread_count
            FROM messages m
            JOIN users u ON u.user_id = CASE 
                WHEN m.sender_id = :user_id7 THEN m.receiver_id 
                ELSE m.sender_id 
            END
            WHERE m.sender_id = :user_id8 OR m.receiver_id = :user_id9
            ORDER BY last_message_time DESC
        ";
        
        $params = [
            'user_id' => $userId,
            'user_id2' => $userId,
            'user_id3' => $userId,
            'user_id4' => $userId,
            'user_id5' => $userId,
            'user_id6' => $userId,
            'user_id7' => $userId,
            'user_id8' => $userId,
            'user_id9' => $userId
        ];
        
        try {
            $result = $this->db->query($query, $params)->fetchAll();
            
            // Debug log
            error_log("getUserConversations query result: " . print_r($result, true));
            
            return $result;
        } catch (Exception $e) {
            error_log("Error in getUserConversations: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Alternative simpler method if the above is too complex
     */
    public function getUserConversationsSimple($userId) {
        // Get all unique conversation partners
        $query = "
            SELECT DISTINCT
                CASE 
                    WHEN sender_id = :user_id THEN receiver_id 
                    ELSE sender_id 
                END as friend_id
            FROM messages 
            WHERE sender_id = :user_id2 OR receiver_id = :user_id3
        ";
        
        $conversationPartners = $this->db->query($query, [
            'user_id' => $userId,
            'user_id2' => $userId,
            'user_id3' => $userId
        ])->fetchAll();
        
        $conversations = [];
        
        foreach ($conversationPartners as $partner) {
            $friendId = $partner->friend_id;
            
            // Get friend info
            $friendQuery = "SELECT user_id, first_name, last_name, profile_picture, email FROM users WHERE user_id = :friend_id";
            $friend = $this->db->query($friendQuery, ['friend_id' => $friendId])->fetch();
            
            if ($friend) {
                // Get last message
                $lastMessageQuery = "
                    SELECT message_content, created_at 
                    FROM messages 
                    WHERE (sender_id = :user_id AND receiver_id = :friend_id) 
                       OR (sender_id = :friend_id AND receiver_id = :user_id)
                    ORDER BY created_at DESC 
                    LIMIT 1
                ";
                $lastMessage = $this->db->query($lastMessageQuery, [
                    'user_id' => $userId,
                    'friend_id' => $friendId
                ])->fetch();
                
                // Get unread count
                $unreadQuery = "
                    SELECT COUNT(*) as count 
                    FROM messages 
                    WHERE sender_id = :friend_id 
                      AND receiver_id = :user_id 
                      AND is_read = 0
                ";
                $unreadResult = $this->db->query($unreadQuery, [
                    'friend_id' => $friendId,
                    'user_id' => $userId
                ])->fetch();
                
                // Combine data
                $conversation = (object) [
                    'friend_id' => $friend->user_id,
                    'first_name' => $friend->first_name,
                    'last_name' => $friend->last_name,
                    'profile_picture' => $friend->profile_picture,
                    'email' => $friend->email,
                    'last_message' => $lastMessage ? $lastMessage->message_content : null,
                    'last_message_time' => $lastMessage ? $lastMessage->created_at : null,
                    'unread_count' => $unreadResult ? $unreadResult->count : 0
                ];
                
                $conversations[] = $conversation;
            }
        }
        
        // Sort by last message time
        usort($conversations, function($a, $b) {
            return strtotime($b->last_message_time) - strtotime($a->last_message_time);
        });
        
        return $conversations;
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