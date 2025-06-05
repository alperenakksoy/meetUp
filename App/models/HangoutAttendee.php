<?php
// App/models/HangoutAttendee.php
namespace App\Models;

class HangoutAttendee extends BaseModel {
    protected $table = 'hangout_attendees';
    
    /**
     * Get attendees for a specific hangout
     */
    public function getAttendeesByHangout($hangoutId) {
        $query = "SELECT ha.*, u.first_name, u.last_name, u.profile_picture, u.city, u.country
                  FROM {$this->table} ha
                  JOIN users u ON ha.user_id = u.user_id
                  WHERE ha.hangout_id = :hangout_id
                  AND ha.status = 'attending'
                  ORDER BY ha.joined_at ASC";
        
        $params = ['hangout_id' => $hangoutId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Check if user is attending a hangout
     */
    public function isUserAttending($hangoutId, $userId) {
        $query = "SELECT COUNT(*) as count FROM {$this->table}
                  WHERE hangout_id = :hangout_id 
                  AND user_id = :user_id 
                  AND status = 'attending'";
        
        $params = [
            'hangout_id' => $hangoutId,
            'user_id' => $userId
        ];
        
        $result = $this->db->query($query, $params)->fetch();
        return $result->count > 0;
    }
    
    /**
     * Get attendee count for a hangout
     */
    public function getAttendeeCount($hangoutId) {
        $query = "SELECT COUNT(*) as count FROM {$this->table}
                  WHERE hangout_id = :hangout_id AND status = 'attending'";
        
        $params = ['hangout_id' => $hangoutId];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }
    
    /**
     * Remove attendee from hangout
     */
    public function removeAttendee($hangoutId, $userId) {
        $query = "DELETE FROM {$this->table}
                  WHERE hangout_id = :hangout_id AND user_id = :user_id";
        
        $params = [
            'hangout_id' => $hangoutId,
            'user_id' => $userId
        ];
        
        return $this->db->query($query, $params);
    }
    
    /**
     * Get hangouts a user is attending
     */
    public function getUserHangouts($userId) {
        $query = "SELECT ha.*, h.description, h.location, h.start_time, h.activity_type,
                  u.first_name as host_first_name, u.last_name as host_last_name
                  FROM {$this->table} ha
                  JOIN hangouts h ON ha.hangout_id = h.hangout_id
                  JOIN users u ON h.host_id = u.user_id
                  WHERE ha.user_id = :user_id
                  AND ha.status = 'attending'
                  AND h.status = 'active'
                  ORDER BY h.start_time ASC";
        
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get upcoming hangouts for a user
     */
    public function getUserUpcomingHangouts($userId, $limit = 5) {
        $query = "SELECT ha.*, h.description, h.location, h.start_time, h.activity_type,
                  u.first_name as host_first_name, u.last_name as host_last_name,
                  TIMESTAMPDIFF(MINUTE, NOW(), h.start_time) as minutes_until_start
                  FROM {$this->table} ha
                  JOIN hangouts h ON ha.hangout_id = h.hangout_id
                  JOIN users u ON h.host_id = u.user_id
                  WHERE ha.user_id = :user_id
                  AND ha.status = 'attending'
                  AND h.status = 'active'
                  AND h.start_time > NOW()
                  ORDER BY h.start_time ASC
                  LIMIT :limit";
        
        $params = [
            'user_id' => $userId,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get mutual attendees (people who attended hangouts with user)
     */
    public function getMutualAttendees($userId, $limit = 10) {
        $query = "SELECT DISTINCT u.user_id, u.first_name, u.last_name, u.profile_picture, u.city, u.country,
                  COUNT(DISTINCT ha1.hangout_id) as mutual_hangouts
                  FROM {$this->table} ha1
                  JOIN {$this->table} ha2 ON ha1.hangout_id = ha2.hangout_id
                  JOIN users u ON ha2.user_id = u.user_id
                  WHERE ha1.user_id = :user_id
                  AND ha2.user_id != :user_id_2
                  AND ha1.status = 'attending'
                  AND ha2.status = 'attending'
                  GROUP BY u.user_id
                  HAVING mutual_hangouts >= 1
                  ORDER BY mutual_hangouts DESC
                  LIMIT :limit";
        
        $params = [
            'user_id' => $userId,
            'user_id_2' => $userId,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Get attendee statistics for admin
     */
    public function getAttendeeStats() {
        $query = "SELECT 
                    COUNT(DISTINCT user_id) as unique_attendees,
                    COUNT(*) as total_attendances,
                    AVG(attendances_per_user) as avg_attendances_per_user
                  FROM (
                    SELECT user_id, COUNT(*) as attendances_per_user
                    FROM {$this->table}
                    WHERE status = 'attending'
                    GROUP BY user_id
                  ) as user_stats";
        
        return $this->db->query($query)->fetch();
    }
    
    /**
     * Get most active attendees
     */
    public function getMostActiveAttendees($limit = 10) {
        $query = "SELECT u.user_id, u.first_name, u.last_name, u.profile_picture,
                  COUNT(ha.attendee_id) as hangout_count
                  FROM users u
                  JOIN {$this->table} ha ON u.user_id = ha.user_id
                  WHERE ha.status = 'attending'
                  AND ha.joined_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                  GROUP BY u.user_id
                  ORDER BY hangout_count DESC
                  LIMIT :limit";
        
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Check if hangout has space available
     */
    public function hasSpaceAvailable($hangoutId, $maxPeople = null) {
        if ($maxPeople === null) {
            return true; // No limit set
        }
        
        $currentCount = $this->getAttendeeCount($hangoutId);
        return $currentCount < $maxPeople;
    }
    
    /**
     * Get attendees with host information
     */
    public function getAttendeesWithHost($hangoutId) {
        $query = "SELECT ha.*, u.user_id, u.first_name, u.last_name, u.profile_picture, u.city, u.country,
                  (CASE WHEN h.host_id = u.user_id THEN 1 ELSE 0 END) as is_host
                  FROM {$this->table} ha
                  JOIN users u ON ha.user_id = u.user_id
                  JOIN hangouts h ON ha.hangout_id = h.hangout_id
                  WHERE ha.hangout_id = :hangout_id
                  AND ha.status = 'attending'
                  ORDER BY is_host DESC, ha.joined_at ASC";
        
        $params = ['hangout_id' => $hangoutId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Remove all attendees from a hangout (when hangout is cancelled)
     */
    public function removeAllAttendees($hangoutId) {
        $query = "DELETE FROM {$this->table} WHERE hangout_id = :hangout_id";
        $params = ['hangout_id' => $hangoutId];
        return $this->db->query($query, $params);
    }
    
    /**
     * Get attendee join history for a user
     */
    public function getUserAttendanceHistory($userId, $limit = 20) {
        $query = "SELECT ha.*, h.description, h.location, h.start_time, h.activity_type, h.status as hangout_status,
                  u.first_name as host_first_name, u.last_name as host_last_name
                  FROM {$this->table} ha
                  JOIN hangouts h ON ha.hangout_id = h.hangout_id
                  JOIN users u ON h.host_id = u.user_id
                  WHERE ha.user_id = :user_id
                  ORDER BY ha.joined_at DESC
                  LIMIT :limit";
        
        $params = [
            'user_id' => $userId,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
}