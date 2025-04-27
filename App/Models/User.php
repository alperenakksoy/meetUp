<?php
namespace App\Models;

class User extends BaseModel {
    protected $table = 'users';
    
    // Find user by email
    public function findByEmail($email) {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        $params = ['email' => $email];
        return $this->db->query($query, $params)->fetch();
    }
    
    // Get all users with pagination
    public function getAllWithPagination($limit = 10, $offset = 0) {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Count total users
    public function getTotalCount() {
        $query = "SELECT COUNT(*) as count FROM {$this->table}";
        $result = $this->db->query($query)->fetch();
        return $result->count;
    }
    
    // Find users by location
    public function findByLocation($city, $country) {
        $query = "SELECT * FROM {$this->table} WHERE city = :city AND country = :country";
        $params = [
            'city' => $city,
            'country' => $country
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Set user as admin
    public function setAdmin($userId, $isAdmin = true) {
        $query = "UPDATE {$this->table} SET is_admin = :is_admin WHERE user_id = :user_id";
        $params = [
            'is_admin' => $isAdmin ? 1 : 0,
            'user_id' => $userId
        ];
        return $this->db->query($query, $params);
    }
    
    // Search users
    public function search($term) {
        $searchTerm = "%$term%";
        $query = "SELECT * FROM {$this->table} 
                 WHERE first_name LIKE :term 
                 OR last_name LIKE :term 
                 OR email LIKE :term 
                 OR city LIKE :term
                 OR country LIKE :term";
        $params = ['term' => $searchTerm];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get user's profile with stats
    public function getProfileWithStats($userId) {
        $query = "SELECT u.*, 
                (SELECT COUNT(*) FROM events WHERE host_id = u.user_id) as events_hosted,
                (SELECT COUNT(*) FROM event_attendees WHERE user_id = u.user_id AND status = 'attending') as events_attended,
                (SELECT COUNT(*) FROM friendships WHERE (user_id_1 = u.user_id OR user_id_2 = u.user_id) AND status = 'accepted') as friends_count,
                (SELECT AVG(rating) FROM reviews WHERE reviewed_id = u.user_id) as average_rating
                FROM {$this->table} u
                WHERE u.user_id = :user_id";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetch();
    }
}