<?php
namespace App\Models;

class EventComment extends BaseModel {
    protected $table = 'event_comments';
    
    // Get comments for an event
    public function getCommentsByEvent($eventId) {
        $query = "SELECT c.*, u.first_name, u.last_name, u.profile_picture
                FROM {$this->table} c
                JOIN users u ON c.user_id = u.user_id
                WHERE c.event_id = :event_id
                ORDER BY c.created_at ASC";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get comment count for an event
    public function getCommentCount($eventId) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE event_id = :event_id";
        $params = ['event_id' => $eventId];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }
    
    // Add a comment to an event
    public function addComment($eventId, $userId, $content) {
        $query = "INSERT INTO {$this->table} (event_id, user_id, content)
                VALUES (:event_id, :user_id, :content)";
        $params = [
            'event_id' => $eventId,
            'user_id' => $userId,
            'content' => $content
        ];
        
        return $this->db->query($query, $params);
    }
    
    // Delete a comment
    public function deleteComment($commentId, $userId) {
        // First check if the user is the comment author
        $query = "SELECT * FROM {$this->table} WHERE comment_id = :comment_id AND user_id = :user_id";
        $params = [
            'comment_id' => $commentId,
            'user_id' => $userId
        ];
        
        $comment = $this->db->query($query, $params)->fetch();
        
        if (!$comment) {
            return false; // User is not the author
        }
        
        $query = "DELETE FROM {$this->table} WHERE comment_id = :comment_id";
        $params = ['comment_id' => $commentId];
        
        return $this->db->query($query, $params);
    }
    
    // Get latest comments for an event
    public function getLatestComments($eventId, $limit = 5) {
        $query = "SELECT c.*, u.first_name, u.last_name, u.profile_picture
                FROM {$this->table} c
                JOIN users u ON c.user_id = u.user_id
                WHERE c.event_id = :event_id
                ORDER BY c.created_at DESC
                LIMIT :limit";
        $params = [
            'event_id' => $eventId,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
}