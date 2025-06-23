<?php
namespace App\Models;

/**
 * Report Model for handling user reports and moderation
 */
class Report extends BaseModel {
    protected $table = 'reports';
    
    /**
     * Create a new report
     */
    public function createReport($data) {
        $query = "INSERT INTO {$this->table} 
                  (reporter_user_id, reported_user_id, reported_event_id, report_type, description, status, created_at)
                  VALUES (:reporter_user_id, :reported_user_id, :reported_event_id, :report_type, :description, 'pending', NOW())";
        
        return $this->db->query($query, $data);
    }
    
    /**
     * Get reports with filters for admin panel
     */
    public function getReportsWithFilters($status = 'pending', $type = 'all', $limit = 10, $offset = 0) {
        $whereConditions = ['r.status = :status'];
        $params = ['status' => $status, 'limit' => $limit, 'offset' => $offset];
        
        if ($type !== 'all') {
            $whereConditions[] = 'r.report_type = :type';
            $params['type'] = $type;
        }
        
        $whereClause = implode(' AND ', $whereConditions);
        
        $query = "SELECT r.*,
                  ru.first_name as reporter_first_name,
                  ru.last_name as reporter_last_name,
                  rep.first_name as reported_first_name,
                  rep.last_name as reported_last_name,
                  e.title as event_title
                  FROM {$this->table} r
                  LEFT JOIN users ru ON r.reporter_user_id = ru.user_id
                  LEFT JOIN users rep ON r.reported_user_id = rep.user_id
                  LEFT JOIN events e ON r.reported_event_id = e.event_id
                  WHERE {$whereClause}
                  ORDER BY r.created_at DESC
                  LIMIT :limit OFFSET :offset";
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Update report status
     */
    public function updateStatus($reportId, $status, $adminNotes = '') {
        $query = "UPDATE {$this->table} 
                  SET status = :status, 
                      admin_notes = :admin_notes,
                      resolved_at = NOW(),
                      resolved_by = :admin_id
                  WHERE report_id = :report_id";
        
        $params = [
            'report_id' => $reportId,
            'status' => $status,
            'admin_notes' => $adminNotes,
            'admin_id' => $_SESSION['user_id']
        ];
        
        return $this->db->query($query, $params);
    }
    
    /**
     * Get pending reports count
     */
    public function getPendingCount() {
        $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE status = 'pending'";
        $result = $this->db->query($query)->fetch();
        return $result->count;
    }
    
    /**
     * Get reports for export
     */
    public function getAllForExport() {
        $query = "SELECT 
                    r.report_id,
                    r.report_type,
                    r.description,
                    r.status,
                    r.created_at,
                    ru.email as reporter_email,
                    rep.email as reported_email,
                    e.title as event_title
                  FROM {$this->table} r
                  LEFT JOIN users ru ON r.reporter_user_id = ru.user_id
                  LEFT JOIN users rep ON r.reported_user_id = rep.user_id
                  LEFT JOIN events e ON r.reported_event_id = e.event_id
                  ORDER BY r.created_at DESC";
        
        return $this->db->query($query)->fetchAll();
    }
}

/**
 * Analytics Model for generating reports and statistics
 */
class Analytics extends BaseModel {
    
    /**
     * Get comprehensive dashboard statistics
     */
    public function getDashboardAnalytics($timeRange = 30) {
        $analytics = [];
        
        // User analytics
        $analytics['users'] = $this->getUserAnalytics($timeRange);
        
        // Event analytics
        $analytics['events'] = $this->getEventAnalytics($timeRange);
        
        // Activity analytics
        $analytics['activity'] = $this->getActivityAnalytics($timeRange);
        
        // Revenue analytics (if applicable)
        $analytics['revenue'] = $this->getRevenueAnalytics($timeRange);
        
        return $analytics;
    }
    
    private function getUserAnalytics($days) {
        $queries = [
            'total_users' => "SELECT COUNT(*) as count FROM users",
            'new_users' => "SELECT COUNT(*) as count FROM users WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)",
            'active_users' => "SELECT COUNT(DISTINCT user_id) as count FROM 
                              (SELECT host_id as user_id FROM events WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)
                               UNION
                               SELECT user_id FROM event_attendees WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)) as active",
            'user_growth' => "SELECT DATE(created_at) as date, COUNT(*) as count 
                             FROM users 
                             WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)
                             GROUP BY DATE(created_at)
                             ORDER BY date"
        ];
        
        $results = [];
        foreach ($queries as $key => $query) {
            if ($key === 'user_growth') {
                $results[$key] = $this->db->query($query)->fetchAll();
            } else {
                $result = $this->db->query($query)->fetch();
                $results[$key] = $result->count;
            }
        }
        
        return $results;
    }
    
    private function getEventAnalytics($days) {
        $queries = [
            'total_events' => "SELECT COUNT(*) as count FROM events",
            'new_events' => "SELECT COUNT(*) as count FROM events WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)",
            'upcoming_events' => "SELECT COUNT(*) as count FROM events WHERE event_date > NOW()",
            'events_by_category' => "SELECT 
                                     COALESCE(et.tag_name, 'Uncategorized') as category,
                                     COUNT(DISTINCT e.event_id) as count
                                   FROM events e
                                   LEFT JOIN event_tags et ON e.event_id = et.event_id
                                   WHERE e.created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)
                                   GROUP BY et.tag_name
                                   ORDER BY count DESC",
            'popular_locations' => "SELECT city, country, COUNT(*) as count 
                                   FROM events 
                                   WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)
                                   GROUP BY city, country 
                                   ORDER BY count DESC 
                                   LIMIT 10"
        ];
        
        $results = [];
        foreach ($queries as $key => $query) {
            if (in_array($key, ['events_by_category', 'popular_locations'])) {
                $results[$key] = $this->db->query($query)->fetchAll();
            } else {
                $result = $this->db->query($query)->fetch();
                $results[$key] = $result->count;
            }
        }
        
        return $results;
    }
    
    private function getActivityAnalytics($days) {
        $query = "SELECT 
                    DATE(created_at) as date,
                    COUNT(CASE WHEN table_name = 'users' THEN 1 END) as new_users,
                    COUNT(CASE WHEN table_name = 'events' THEN 1 END) as new_events,
                    COUNT(CASE WHEN table_name = 'event_attendees' THEN 1 END) as new_attendees
                  FROM (
                    SELECT 'users' as table_name, created_at FROM users WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)
                    UNION ALL
                    SELECT 'events' as table_name, created_at FROM events WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)
                    UNION ALL
                    SELECT 'event_attendees' as table_name, created_at FROM event_attendees WHERE created_at > DATE_SUB(NOW(), INTERVAL {$days} DAY)
                  ) as combined
                  GROUP BY DATE(created_at)
                  ORDER BY date";
        
        return $this->db->query($query)->fetchAll();
    }
    
    private function getRevenueAnalytics($days) {
        // Placeholder for revenue analytics if you implement paid features
        return [
            'total_revenue' => 0,
            'monthly_revenue' => 0,
            'revenue_growth' => []
        ];
    }
}

/**
 * System Settings Model
 */
class SystemSettings extends BaseModel {
    protected $table = 'system_settings';
    
    /**
     * Get all system settings
     */
    public function getAllSettings() {
        $query = "SELECT setting_key, setting_value, description FROM {$this->table}";
        $results = $this->db->query($query)->fetchAll();
        
        $settings = [];
        foreach ($results as $setting) {
            $settings[$setting->setting_key] = [
                'value' => $setting->setting_value,
                'description' => $setting->description
            ];
        }
        
        return $settings;
    }
    
    /**
     * Update system setting
     */
    public function updateSetting($key, $value) {
        $query = "INSERT INTO {$this->table} (setting_key, setting_value, updated_at) 
                  VALUES (:key, :value, NOW())
                  ON DUPLICATE KEY UPDATE 
                  setting_value = :value2, updated_at = NOW()";
        
        $params = [
            'key' => $key,
            'value' => $value,
            'value2' => $value
        ];
        
        return $this->db->query($query, $params);
    }
    
    /**
     * Get setting by key
     */
    public function getSetting($key, $default = null) {
        $query = "SELECT setting_value FROM {$this->table} WHERE setting_key = :key";
        $result = $this->db->query($query, ['key' => $key])->fetch();
        
        return $result ? $result->setting_value : $default;
    }
}

/**
 * Admin Log Model for tracking admin actions
 */
class AdminLog extends BaseModel {
    protected $table = 'admin_logs';
    
    /**
     * Log admin action
     */
    public function logAction($adminId, $action, $entityType, $entityId, $details = '') {
        $query = "INSERT INTO {$this->table} 
                  (admin_id, action, entity_type, entity_id, details, ip_address, user_agent, created_at)
                  VALUES (:admin_id, :action, :entity_type, :entity_id, :details, :ip_address, :user_agent, NOW())";
        
        $params = [
            'admin_id' => $adminId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'details' => $details,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ];
        
        return $this->db->query($query, $params);
    }
    
    /**
     * Get admin activity logs
     */
    public function getAdminActivity($limit = 50, $adminId = null) {
        $whereClause = $adminId ? 'WHERE al.admin_id = :admin_id' : '';
        $params = ['limit' => $limit];
        
        if ($adminId) {
            $params['admin_id'] = $adminId;
        }
        
        $query = "SELECT al.*, u.first_name, u.last_name
                  FROM {$this->table} al
                  JOIN users u ON al.admin_id = u.user_id
                  {$whereClause}
                  ORDER BY al.created_at DESC
                  LIMIT :limit";
        
        return $this->db->query($query, $params)->fetchAll();
    }
}

/**
 * Cache Manager for optimizing admin panel performance
 */
class CacheManager {
    private $cacheDir;
    
    public function __construct() {
        $this->cacheDir = __DIR__ . '/../../cache/admin/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }
    
    /**
     * Get cached data
     */
    public function get($key, $maxAge = 3600) {
        $filename = $this->cacheDir . md5($key) . '.cache';
        
        if (!file_exists($filename)) {
            return null;
        }
        
        $data = unserialize(file_get_contents($filename));
        
        if (time() - $data['timestamp'] > $maxAge) {
            unlink($filename);
            return null;
        }
        
        return $data['content'];
    }
    
    /**
     * Store data in cache
     */
    public function set($key, $content, $maxAge = 3600) {
        $filename = $this->cacheDir . md5($key) . '.cache';
        
        $data = [
            'timestamp' => time(),
            'content' => $content,
            'max_age' => $maxAge
        ];
        
        file_put_contents($filename, serialize($data));
    }
    
    /**
     * Clear cache by pattern
     */
    public function clear($pattern = '*') {
        $files = glob($this->cacheDir . '*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
    }
}

/**
 * Admin Helper Functions
 */
class AdminHelpers {
    
    /**
     * Format bytes to human readable format
     */
    public static function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
    
    /**
     * Generate admin notification
     */
    public static function createNotification($type, $title, $message, $actionUrl = null) {
        return [
            'type' => $type, // success, warning, error, info
            'title' => $title,
            'message' => $message,
            'action_url' => $actionUrl,
            'timestamp' => time()
        ];
    }
    
    /**
     * Validate admin permissions
     */
    public static function hasPermission($action, $adminId = null) {
        $adminId = $adminId ?? $_SESSION['user_id'];
        
        // Basic permission check - expand based on your needs
        $permissions = [
            'manage_users' => ['super_admin', 'admin'],
            'manage_events' => ['super_admin', 'admin', 'moderator'],
            'view_analytics' => ['super_admin', 'admin'],
            'system_settings' => ['super_admin']
        ];
        
        // Get admin role from database
        $db = new \Framework\Database(require basePath('config/db.php')['database']);
        $query = "SELECT admin_role FROM users WHERE user_id = :admin_id AND is_admin = 1";
        $result = $db->query($query, ['admin_id' => $adminId])->fetch();
        
        if (!$result) {
            return false;
        }
        
        $adminRole = $result->admin_role ?? 'admin';
        
        return isset($permissions[$action]) && in_array($adminRole, $permissions[$action]);
    }
    
    /**
     * Generate secure token for admin actions
     */
    public static function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF token
     */
    public static function verifyCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Sanitize admin input
     */
    public static function sanitizeInput($input, $type = 'string') {
        switch ($type) {
            case 'email':
                return filter_var($input, FILTER_SANITIZE_EMAIL);
            case 'int':
                return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
            case 'float':
                return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            case 'url':
                return filter_var($input, FILTER_SANITIZE_URL);
            default:
                return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        }
    }
    
    /**
     * Log security event
     */
    public static function logSecurityEvent($event, $details = []) {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'admin_id' => $_SESSION['user_id'] ?? null,
            'details' => $details
        ];
        
        $logFile = __DIR__ . '/../../logs/security.log';
        file_put_contents($logFile, json_encode($logData) . "\n", FILE_APPEND | LOCK_EX);
    }
}