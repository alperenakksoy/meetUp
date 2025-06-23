<?php
namespace App\Models;
use Exception;

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

     /**
     * Get users by status with additional filtering
     */
    public function getUsersByStatus($status = 'all', $limit = 20, $offset = 0) {
        $whereClause = '';
        $params = ['limit' => $limit, 'offset' => $offset];
        
        switch ($status) {
            case 'active':
                $whereClause = 'WHERE suspended_until IS NULL OR suspended_until < NOW()';
                break;
            case 'suspended':
                $whereClause = 'WHERE suspended_until IS NOT NULL AND suspended_until > NOW()';
                break;
            case 'admin':
                $whereClause = 'WHERE is_admin = 1';
                break;
            case 'new':
                $whereClause = 'WHERE created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)';
                break;
        }
        
        $query = "SELECT u.*, 
                  (SELECT COUNT(*) FROM events WHERE host_id = u.user_id) as events_hosted,
                  (SELECT COUNT(*) FROM event_attendees WHERE user_id = u.user_id) as events_attended,
                  (SELECT COUNT(*) FROM reports WHERE reported_user_id = u.user_id AND status = 'pending') as pending_reports
                  FROM {$this->table} u 
                  {$whereClause}
                  ORDER BY u.created_at DESC 
                  LIMIT :limit OFFSET :offset";
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get user statistics for dashboard
     */
    public function getActiveCount() {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
                  WHERE (suspended_until IS NULL OR suspended_until < NOW()) 
                  AND created_at > DATE_SUB(NOW(), INTERVAL 30 DAY)";
        $result = $this->db->query($query)->fetch();
        return $result->count;
    }
    
    public function getNewUsersCount($days = 1) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
                  WHERE created_at > DATE_SUB(NOW(), INTERVAL :days DAY)";
        $params = ['days' => $days];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }
    
    /**
     * Suspend user functionality
     */
    public function suspendUser($userId, $reason, $suspendedUntil) {
        $query = "UPDATE {$this->table} 
                  SET suspended_until = :suspended_until, 
                      suspension_reason = :reason,
                      updated_at = NOW()
                  WHERE user_id = :user_id";
        
        $params = [
            'user_id' => $userId,
            'suspended_until' => $suspendedUntil,
            'reason' => $reason
        ];
        
        return $this->db->query($query, $params);
    }
    
    /**
     * Unsuspend user
     */
    public function unsuspendUser($userId) {
        $query = "UPDATE {$this->table} 
                  SET suspended_until = NULL, 
                      suspension_reason = NULL,
                      updated_at = NOW()
                  WHERE user_id = :user_id";
        
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params);
    }
    
    /**
     * Get top users by activity
     */
    public function getTopUsers($limit = 10) {
        $query = "SELECT u.user_id, u.first_name, u.last_name, u.profile_picture,
                  COUNT(DISTINCT e.event_id) as events_hosted,
                  COUNT(DISTINCT ea.event_id) as events_attended,
                  (COUNT(DISTINCT e.event_id) + COUNT(DISTINCT ea.event_id)) as total_activity
                  FROM {$this->table} u
                  LEFT JOIN events e ON u.user_id = e.host_id
                  LEFT JOIN event_attendees ea ON u.user_id = ea.user_id AND ea.status = 'attending'
                  WHERE u.suspended_until IS NULL OR u.suspended_until < NOW()
                  GROUP BY u.user_id
                  ORDER BY total_activity DESC
                  LIMIT :limit";
        
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get user growth data for analytics
     */
    public function getUserGrowthData($days = 30) {
        $query = "SELECT DATE(created_at) as date, COUNT(*) as new_users
                  FROM {$this->table}
                  WHERE created_at > DATE_SUB(NOW(), INTERVAL :days DAY)
                  GROUP BY DATE(created_at)
                  ORDER BY date ASC";
        
        $params = ['days' => $days];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get location statistics
     */
    public function getLocationStats() {
        $query = "SELECT 
                    country,
                    city,
                    COUNT(*) as user_count
                  FROM {$this->table}
                  WHERE country IS NOT NULL AND city IS NOT NULL
                  GROUP BY country, city
                  ORDER BY user_count DESC
                  LIMIT 20";
        
        return $this->db->query($query)->fetchAll();
    }
    
    /**
     * Advanced search with filters
     */
    public function advancedSearch($filters) {
        $whereConditions = [];
        $params = [];
        
        if (!empty($filters['name'])) {
            $whereConditions[] = "(first_name LIKE :name OR last_name LIKE :name OR email LIKE :name)";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        if (!empty($filters['location'])) {
            $whereConditions[] = "(city LIKE :location OR country LIKE :location)";
            $params['location'] = '%' . $filters['location'] . '%';
        }
        
        if (!empty($filters['date_from'])) {
            $whereConditions[] = "created_at >= :date_from";
            $params['date_from'] = $filters['date_from'];
        }
        
        if (!empty($filters['date_to'])) {
            $whereConditions[] = "created_at <= :date_to";
            $params['date_to'] = $filters['date_to'] . ' 23:59:59';
        }
        
        if (!empty($filters['status'])) {
            if ($filters['status'] === 'suspended') {
                $whereConditions[] = "suspended_until IS NOT NULL AND suspended_until > NOW()";
            } elseif ($filters['status'] === 'active') {
                $whereConditions[] = "(suspended_until IS NULL OR suspended_until < NOW())";
            }
        }
        
        $whereClause = empty($whereConditions) ? '' : 'WHERE ' . implode(' AND ', $whereConditions);
        
        $query = "SELECT u.*, 
                  (SELECT COUNT(*) FROM events WHERE host_id = u.user_id) as events_hosted,
                  (SELECT COUNT(*) FROM event_attendees WHERE user_id = u.user_id) as events_attended
                  FROM {$this->table} u 
                  {$whereClause}
                  ORDER BY u.created_at DESC";
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get user profile with complete stats
     */
    public function getUserProfileWithStats($userId) {
        $query = "SELECT u.*,
                  COUNT(DISTINCT e.event_id) as events_hosted,
                  COUNT(DISTINCT ea.event_id) as events_attended,
                  COUNT(DISTINCT ha.hangout_id) as hangouts_attended,
                  AVG(r.rating) as average_rating,
                  COUNT(DISTINCT r.rating) as total_ratings,
                  COUNT(DISTINCT rep.report_id) as reports_against
                  FROM {$this->table} u
                  LEFT JOIN events e ON u.user_id = e.host_id
                  LEFT JOIN event_attendees ea ON u.user_id = ea.user_id AND ea.status = 'attending'
                  LEFT JOIN hangout_attendees ha ON u.user_id = ha.user_id AND ha.status = 'attending'
                  LEFT JOIN ratings r ON u.user_id = r.rated_user_id
                  LEFT JOIN reports rep ON u.user_id = rep.reported_user_id
                  WHERE u.user_id = :user_id
                  GROUP BY u.user_id";
        
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetch();
    }
    
    /**
     * Get users for export
     */
    public function getAllForExport() {
        $query = "SELECT 
                    user_id,
                    first_name,
                    last_name,
                    email,
                    city,
                    country,
                    created_at,
                    is_admin,
                    CASE 
                        WHEN suspended_until IS NOT NULL AND suspended_until > NOW() THEN 'Suspended'
                        ELSE 'Active'
                    END as status,
                    (SELECT COUNT(*) FROM events WHERE host_id = u.user_id) as events_hosted,
                    (SELECT COUNT(*) FROM event_attendees WHERE user_id = u.user_id) as events_attended
                  FROM {$this->table} u
                  ORDER BY created_at DESC";
        
        return $this->db->query($query)->fetchAll();
    }
    
    /**
     * Update user with validation
     */
    public function updateUser($userId, $data) {
        // Remove empty values and validate
        $allowedFields = [
            'first_name', 'last_name', 'email', 'bio', 'city', 'country',
            'phone', 'occupation', 'date_of_birth', 'gender', 'languages',
            'interests', 'instagram', 'linkedin', 'profile_picture'
        ];
        
        $updateData = [];
        foreach ($data as $field => $value) {
            if (in_array($field, $allowedFields) && $value !== '') {
                $updateData[$field] = $value;
            }
        }
        
        if (empty($updateData)) {
            return false;
        }
        
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        
        // Build update query
        $fields = array_keys($updateData);
        $fieldSet = array_map(fn($field) => "$field = :$field", $fields);
        $fieldSetString = implode(', ', $fieldSet);
        
        $query = "UPDATE {$this->table} SET $fieldSetString WHERE user_id = :user_id";
        
        // Add user_id to parameters
        $updateData['user_id'] = $userId;
        
        return $this->db->query($query, $updateData);
    }
    
    /**
     * Delete user and all related data
     */
    public function deleteUser($userId) {
        try {
            $this->db->conn->beginTransaction();
            
            // Delete related records first
            $queries = [
                "DELETE FROM event_attendees WHERE user_id = :user_id",
                "DELETE FROM hangout_attendees WHERE user_id = :user_id",
                "DELETE FROM reports WHERE reported_user_id = :user_id OR reporter_user_id = :user_id",
                "DELETE FROM ratings WHERE rated_user_id = :user_id OR rater_user_id = :user_id",
                "DELETE FROM events WHERE host_id = :user_id",
                "DELETE FROM hangouts WHERE host_id = :user_id",
                "DELETE FROM {$this->table} WHERE user_id = :user_id"
            ];
            
            foreach ($queries as $query) {
                $this->db->query($query, ['user_id' => $userId]);
            }
            
            $this->db->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->db->conn->rollback();
            error_log("Delete user error: " . $e->getMessage());
            return false;
        }
    }
}