<?php
namespace App\Models;

class UserActivity extends BaseModel {
    protected $table = 'user_activity';
    
    // Log user activity
    public function logActivity($userId, $activityType, $details, $ipAddress = null) {
        if ($ipAddress === null) {
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        }
        
        $query = "INSERT INTO {$this->table} (user_id, activity_type, activity_details, ip_address)
                VALUES (:user_id, :activity_type, :activity_details, :ip_address)";
        $params = [
            'user_id' => $userId,
            'activity_type' => $activityType,
            'activity_details' => $details,
            'ip_address' => $ipAddress
        ];
        
        return $this->db->query($query, $params);
    }
    
    // Get recent activity for a user
    public function getUserActivity($userId, $limit = 20) {
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
    
    // Get activity by type
    public function getActivityByType($activityType, $limit = 20) {
        $query = "SELECT a.*, u.first_name, u.last_name
                FROM {$this->table} a
                JOIN users u ON a.user_id = u.user_id
                WHERE a.activity_type = :activity_type
                ORDER BY a.created_at DESC
                LIMIT :limit";
        $params = [
            'activity_type' => $activityType,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get recent activity feed (public activity)
    public function getActivityFeed($limit = 20) {
        $query = "SELECT a.*, u.first_name, u.last_name, u.profile_picture
                FROM {$this->table} a
                JOIN users u ON a.user_id = u.user_id
                WHERE a.activity_type IN ('join_event', 'create_event', 'write_review')
                ORDER BY a.created_at DESC
                LIMIT :limit";
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get login history for a user
    public function getLoginHistory($userId, $limit = 10) {
        $query = "SELECT * FROM {$this->table}
                WHERE user_id = :user_id AND activity_type = 'login'
                ORDER BY created_at DESC
                LIMIT :limit";
        $params = [
            'user_id' => $userId,
            'limit' => $limit
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Check for suspicious activity
    public function checkSuspiciousActivity($userId, $timeFrame = '24 hours') {
        $query = "SELECT COUNT(*) as count, COUNT(DISTINCT ip_address) as ip_count
                FROM {$this->table}
                WHERE user_id = :user_id
                AND activity_type = 'login'
                AND created_at >= NOW() - INTERVAL :time_frame";
        $params = [
            'user_id' => $userId,
            'time_frame' => $timeFrame
        ];
        return $this->db->query($query, $params)->fetch();
    }
}