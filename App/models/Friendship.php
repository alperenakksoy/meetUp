<?php
namespace App\Models;

class Friendship extends BaseModel {
    protected $table = 'friendships';
    
    // Get all friends for a user
    public function getFriends($userId) {
        $query = "SELECT u.* FROM users u
                JOIN {$this->table} f ON (u.user_id = f.user_id_1 OR u.user_id = f.user_id_2)
                WHERE (f.user_id_1 = :user_id OR f.user_id_2 = :user_id)
                AND f.status = 'accepted'
                AND u.user_id != :user_id";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    /**
 * Get the count of friends for a user
 * @param int $userId
 * @return int
 */
public function getFriendCount($userId) {
    $query = "SELECT COUNT(*) as count 
              FROM {$this->table} 
              WHERE (user_id_1 = :user_id OR user_id_2 = :user_id)
              AND status = 'accepted'";
    $params = ['user_id' => $userId];
    $result = $this->db->query($query, $params)->fetch();
    return $result->count;
}

/**
 * Get a limited list of friends for a user
 * @param int $userId
 * @param int $limit How many friends to return
 * @return array
 */
public function getLimitedFriends($userId, $limit = 5) {
    $query = "SELECT u.*
              FROM users u
              JOIN {$this->table} f ON 
                  (u.user_id = f.user_id_1 OR u.user_id = f.user_id_2)
              WHERE 
                  ((f.user_id_1 = :user_id AND f.user_id_2 = u.user_id) OR 
                  (f.user_id_2 = :user_id AND f.user_id_1 = u.user_id))
              AND f.status = 'accepted'
              LIMIT :limit";
    $params = [
        'user_id' => $userId,
        'limit' => $limit
    ];
    return $this->db->query($query, $params)->fetchAll();
}
    // Get pending friend requests sent to user
    public function getPendingRequestsReceived($userId) {
        $query = "SELECT f.*, u.first_name, u.last_name, u.profile_picture
                FROM {$this->table} f
                JOIN users u ON f.user_id_1 = u.user_id
                WHERE f.user_id_2 = :user_id AND f.status = 'pending'
                ORDER BY f.created_at DESC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get pending friend requests sent by user
    public function getPendingRequestsSent($userId) {
        $query = "SELECT f.*, u.first_name, u.last_name, u.profile_picture
                FROM {$this->table} f
                JOIN users u ON f.user_id_2 = u.user_id
                WHERE f.user_id_1 = :user_id AND f.status = 'pending'
                ORDER BY f.created_at DESC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Accept a friend request
    public function acceptRequest($friendshipId) {
        $query = "UPDATE {$this->table} SET status = 'accepted' WHERE friendship_id = :friendship_id";
        $params = ['friendship_id' => $friendshipId];
        return $this->db->query($query, $params);
    }
    
    // Decline a friend request
    public function declineRequest($friendshipId) {
        $query = "UPDATE {$this->table} SET status = 'declined' WHERE friendship_id = :friendship_id";
        $params = ['friendship_id' => $friendshipId];
        return $this->db->query($query, $params);
    }
    
    // Check if users are friends
    public function areFriends($userId1, $userId2) {
        $query = "SELECT * FROM {$this->table}
                WHERE ((user_id_1 = :user_id_1 AND user_id_2 = :user_id_2)
                OR (user_id_1 = :user_id_2 AND user_id_2 = :user_id_1))
                AND status = 'accepted'";
        $params = [
            'user_id_1' => $userId1,
            'user_id_2' => $userId2
        ];
        return $this->db->query($query, $params)->fetch() ? true : false;
    }
    
    // Check friendship status
    public function checkFriendshipStatus($userId1, $userId2) {
        $query = "SELECT * FROM {$this->table}
                WHERE ((user_id_1 = :user_id_1 AND user_id_2 = :user_id_2)
                OR (user_id_1 = :user_id_2 AND user_id_2 = :user_id_1))";
        $params = [
            'user_id_1' => $userId1,
            'user_id_2' => $userId2
        ];
        $result = $this->db->query($query, $params)->fetch();
        
        if (!$result) {
            return 'none';
        }
        
        return $result->status;
    }
    
    // Get mutual friends count
    public function getMutualFriendsCount($userId1, $userId2) {
        $query = "SELECT COUNT(*) as count
                FROM users u
                WHERE u.user_id IN (
                    SELECT f1.user_id_1 FROM {$this->table} f1
                    WHERE f1.user_id_2 = :user_id_1 AND f1.status = 'accepted'
                    UNION
                    SELECT f2.user_id_2 FROM {$this->table} f2
                    WHERE f2.user_id_1 = :user_id_1 AND f2.status = 'accepted'
                )
                AND u.user_id IN (
                    SELECT f3.user_id_1 FROM {$this->table} f3
                    WHERE f3.user_id_2 = :user_id_2 AND f3.status = 'accepted'
                    UNION
                    SELECT f4.user_id_2 FROM {$this->table} f4
                    WHERE f4.user_id_1 = :user_id_2 AND f4.status = 'accepted'
                )";
        $params = [
            'user_id_1' => $userId1,
            'user_id_2' => $userId2
        ];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }
}