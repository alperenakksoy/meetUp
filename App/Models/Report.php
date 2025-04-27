<?php
namespace App\Models;

class Report extends BaseModel {
    protected $table = 'reports';
    
    // Get all reports
    public function getAllReports($status = null, $limit = 20, $offset = 0) {
        $query = "SELECT r.*, 
                u1.first_name as reporter_first_name, u1.last_name as reporter_last_name,
                u2.first_name as reported_first_name, u2.last_name as reported_last_name,
                e.title as event_title
                FROM {$this->table} r
                JOIN users u1 ON r.reporter_id = u1.user_id
                JOIN users u2 ON r.reported_id = u2.user_id
                LEFT JOIN events e ON r.event_id = e.event_id";
                
        $params = [];
        
        if ($status) {
            $query .= " WHERE r.status = :status";
            $params['status'] = $status;
        }
        
        $query .= " ORDER BY r.created_at DESC LIMIT :limit OFFSET :offset";
        $params['limit'] = $limit;
        $params['offset'] = $offset;
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get report count by status
    public function getReportCountByStatus() {
        $query = "SELECT status, COUNT(*) as count FROM {$this->table} GROUP BY status";
        return $this->db->query($query)->fetchAll();
    }
    
    // Get reports by user
    public function getReportsByReportedUser($userId) {
        $query = "SELECT r.*, 
                u1.first_name as reporter_first_name, u1.last_name as reporter_last_name,
                e.title as event_title
                FROM {$this->table} r
                JOIN users u1 ON r.reporter_id = u1.user_id
                LEFT JOIN events e ON r.event_id = e.event_id
                WHERE r.reported_id = :user_id
                ORDER BY r.created_at DESC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get reports for an event
    public function getReportsByEvent($eventId) {
        $query = "SELECT r.*, 
                u1.first_name as reporter_first_name, u1.last_name as reporter_last_name,
                u2.first_name as reported_first_name, u2.last_name as reported_last_name
                FROM {$this->table} r
                JOIN users u1 ON r.reporter_id = u1.user_id
                JOIN users u2 ON r.reported_id = u2.user_id
                WHERE r.event_id = :event_id
                ORDER BY r.created_at DESC";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Resolve a report
    public function resolveReport($reportId) {
        $query = "UPDATE {$this->table} SET 
                status = 'resolved', 
                resolved_at = NOW()
                WHERE report_id = :report_id";
        $params = ['report_id' => $reportId];
        return $this->db->query($query, $params);
    }
    
    // Dismiss a report
    public function dismissReport($reportId) {
        $query = "UPDATE {$this->table} SET 
                status = 'dismissed', 
                resolved_at = NOW()
                WHERE report_id = :report_id";
        $params = ['report_id' => $reportId];
        return $this->db->query($query, $params);
    }
    
    // Check if user has been reported multiple times
    public function checkUserReportCount($userId, $threshold = 3) {
        $query = "SELECT COUNT(*) as count FROM {$this->table}
                WHERE reported_id = :user_id AND status = 'pending'";
        $params = ['user_id' => $userId];
        $result = $this->db->query($query, $params)->fetch();
        
        return $result->count >= $threshold;
    }
}