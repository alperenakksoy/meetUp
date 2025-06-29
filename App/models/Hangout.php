<?php
// App/models/Hangout.php
namespace App\Models;

class Hangout extends BaseModel {
    protected $table = 'hangouts';
    
  /**
 * Get all active hangouts (not expired)
 */
public function getActiveHangouts($limit = 20) {
    $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture, u.city, u.country,
              TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start
              FROM {$this->table} h
              JOIN users u ON h.host_id = u.user_id
              WHERE h.status = 'active' 
              AND h.start_time > DATE_SUB(NOW(), INTERVAL 4 HOUR)
              ORDER BY 
                CASE 
                  WHEN h.start_time <= NOW() AND h.start_time > DATE_SUB(NOW(), INTERVAL 3 HOUR) THEN 1
                  ELSE 2
                END,
                h.start_time ASC
              LIMIT :limit";
    
    $params = ['limit' => $limit];
    return $this->db->query($query, $params)->fetchAll();
}
    /**
     * Get hangouts by category/activity type
     */
    public function getHangoutsByCategory($category, $limit = 20) {
        $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  WHERE h.status = 'active' 
                  AND h.activity_type = :category
                  AND h.start_time > DATE_SUB(NOW(), INTERVAL 3 HOUR)
                  ORDER BY h.start_time ASC
                  LIMIT :limit";
        
        $params = [
            'category' => $category,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get hangout with host details
     */
    public function getHangoutWithDetails($hangoutId) {
        $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture, u.city, u.country,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start,
                  (SELECT COUNT(*) FROM hangout_attendees WHERE hangout_id = h.hangout_id AND status = 'attending') as attendee_count
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  WHERE h.hangout_id = :hangout_id";
        
        $params = ['hangout_id' => $hangoutId];
        return $this->db->query($query, $params)->fetch();
    }
    
    /**
     * Get hangouts by host
     */
    public function getHangoutsByHost($hostId) {
        $query = "SELECT h.*, 
                  (SELECT COUNT(*) FROM hangout_attendees WHERE hangout_id = h.hangout_id AND status = 'attending') as attendee_count
                  FROM {$this->table} h
                  WHERE h.host_id = :host_id
                  ORDER BY h.created_at DESC";
        
        $params = ['host_id' => $hostId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get hangouts user is attending
     */
    public function getHangoutsUserAttending($userId) {
        $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start,
                  ha.joined_at
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  JOIN hangout_attendees ha ON h.hangout_id = ha.hangout_id
                  WHERE ha.user_id = :user_id
                  AND ha.status = 'attending'
                  AND h.status = 'active'
                  ORDER BY h.start_time ASC";
        
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get nearby hangouts (based on location string matching)
     */
    public function getNearbyHangouts($location, $limit = 10) {
        $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  WHERE h.status = 'active'
                  AND h.location LIKE :location
                  AND h.start_time > DATE_SUB(NOW(), INTERVAL 3 HOUR)
                  ORDER BY h.start_time ASC
                  LIMIT :limit";
        
        $params = [
            'location' => "%{$location}%",
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get starting soon hangouts (within next 30 minutes)
     */
    public function getStartingSoonHangouts($limit = 10) {
        $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  WHERE h.status = 'active'
                  AND h.start_time BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 MINUTE)
                  ORDER BY h.start_time ASC
                  LIMIT :limit";
        
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get popular activity types
     */
    public function getPopularActivityTypes($limit = 5) {
        $query = "SELECT activity_type, COUNT(*) as hangout_count
                  FROM {$this->table}
                  WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                  AND status = 'active'
                  GROUP BY activity_type
                  ORDER BY hangout_count DESC
                  LIMIT :limit";
        
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Update hangout status
     */
    public function updateStatus($hangoutId, $status) {
        $query = "UPDATE {$this->table} 
                  SET status = :status, updated_at = NOW()
                  WHERE hangout_id = :hangout_id";
        
        $params = [
            'status' => $status,
            'hangout_id' => $hangoutId
        ];
        return $this->db->query($query, $params);
    }
    
    /**
     * Mark expired hangouts as inactive
     */
    public function markExpiredAsInactive() {
        $query = "UPDATE {$this->table} 
                  SET status = 'expired'
                  WHERE status = 'active'
                  AND start_time < DATE_SUB(NOW(), INTERVAL 3 HOUR)";
        
        return $this->db->query($query);
    }
    
    /**
     * Get hangout statistics for admin
     */
    public function getHangoutStats() {
        $query = "SELECT 
                    COUNT(*) as total_hangouts,
                    COUNT(CASE WHEN status = 'active' THEN 1 END) as active_hangouts,
                    COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) THEN 1 END) as todays_hangouts,
                    COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN 1 END) as weekly_hangouts,
                    AVG(CASE WHEN max_people IS NOT NULL THEN max_people END) as avg_max_people
                  FROM {$this->table}";
        
        return $this->db->query($query)->fetch();
    }
    
    /**
     * Search hangouts by description or location
     */
    public function searchHangouts($searchTerm, $limit = 20) {
        $searchTerm = "%{$searchTerm}%";
        
        $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  WHERE h.status = 'active'
                  AND (h.description LIKE :search_term OR h.location LIKE :search_term2)
                  AND h.start_time > DATE_SUB(NOW(), INTERVAL 3 HOUR)
                  ORDER BY h.start_time ASC
                  LIMIT :limit";
        
        $params = [
            'search_term' => $searchTerm,
            'search_term2' => $searchTerm,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get hangouts for a specific user (hosted or attending)
     */
    public function getUserHangouts($userId, $includeExpired = false) {
        $expiredCondition = $includeExpired ? "" : "AND h.status = 'active'";
        
        $query = "SELECT DISTINCT h.*, u.first_name, u.last_name, u.profile_picture,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start,
                  (CASE WHEN h.host_id = :user_id THEN 'host' ELSE 'attendee' END) as user_role,
                  (SELECT COUNT(*) FROM hangout_attendees WHERE hangout_id = h.hangout_id AND status = 'attending') as attendee_count
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  LEFT JOIN hangout_attendees ha ON h.hangout_id = ha.hangout_id
                  WHERE (h.host_id = :user_id_2 OR (ha.user_id = :user_id_3 AND ha.status = 'attending'))
                  {$expiredCondition}
                  ORDER BY h.start_time DESC";
        
        $params = [
            'user_id' => $userId,
            'user_id_2' => $userId,
            'user_id_3' => $userId
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get upcoming hangouts for user dashboard
     */
    public function getUserUpcomingHangouts($userId, $limit = 5) {
        $query = "SELECT h.*, u.first_name, u.last_name, u.profile_picture,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start,
                  (CASE WHEN h.host_id = :user_id THEN 'host' ELSE 'attendee' END) as user_role
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  LEFT JOIN hangout_attendees ha ON h.hangout_id = ha.hangout_id
                  WHERE (h.host_id = :user_id_2 OR (ha.user_id = :user_id_3 AND ha.status = 'attending'))
                  AND h.status = 'active'
                  AND h.start_time > NOW()
                  ORDER BY h.start_time ASC
                  LIMIT :limit";
        
        $params = [
            'user_id' => $userId,
            'user_id_2' => $userId,
            'user_id_3' => $userId,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Override getById to use hangout_id as primary key
     */
    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE hangout_id = :id";
        $params = ['id' => $id];
        return $this->db->query($query, $params)->fetch();
    }
    
    /**
     * Override update to use hangout_id as primary key
     */
    public function update($id, $data) {
        $fields = array_keys($data);
        $fieldSet = array_map(fn($field) => "$field = :$field", $fields);
        $fieldSetString = implode(', ', $fieldSet);
        
        $query = "UPDATE {$this->table} SET $fieldSetString WHERE hangout_id = :id";
        
        $data['id'] = $id;
        return $this->db->query($query, $data);
    }
    
    /**
     * Override delete to use hangout_id as primary key
     */
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE hangout_id = :id";
        $params = ['id' => $id];
        return $this->db->query($query, $params);
    }
    
    /**
     * Get recent hangout activity for admin dashboard
     */
    public function getRecentActivity($limit = 10) {
        $query = "SELECT h.hangout_id, h.description, h.activity_type, h.created_at,
                  u.first_name, u.last_name,
                  (SELECT COUNT(*) FROM hangout_attendees WHERE hangout_id = h.hangout_id AND status = 'attending') as attendee_count
                  FROM {$this->table} h
                  JOIN users u ON h.host_id = u.user_id
                  ORDER BY h.created_at DESC
                  LIMIT :limit";
        
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get activity statistics by time period
     */
    public function getActivityStats($days = 30) {
        $query = "SELECT 
                    DATE(created_at) as date,
                    COUNT(*) as hangouts_created,
                    COUNT(CASE WHEN status = 'active' THEN 1 END) as active_hangouts,
                    COUNT(CASE WHEN status = 'cancelled' THEN 1 END) as cancelled_hangouts
                  FROM {$this->table}
                  WHERE created_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
                  GROUP BY DATE(created_at)
                  ORDER BY date DESC";
        
        $params = ['days' => $days];
        return $this->db->query($query, $params)->fetchAll();
    }
    /**
 * Calculate start time based on when selection
 */
private function calculateStartTime($when) {
    switch ($when) {
        case 'now':
            // Add 5 minutes buffer for "now" to avoid immediate expiry
            return date('Y-m-d H:i:s', strtotime('+5 minutes'));
        case '30min':
            return date('Y-m-d H:i:s', strtotime('+30 minutes'));
        case '1hour':
            return date('Y-m-d H:i:s', strtotime('+1 hour'));
        default:
            return date('Y-m-d H:i:s', strtotime('+5 minutes'));
    }
}
}