<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Hangout;
use App\Models\Report;
use Framework\Session;
use Exception;

class AdminController extends BaseController {
    protected $userModel;
    protected $eventModel;
    protected $hangoutModel;
    protected $reportModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->eventModel = new Event();
        $this->hangoutModel = new Hangout();
        $this->reportModel = new Report();
        
        // Ensure only admins can access these methods
        $this->requireAdmin();
    }
    
    /**
     * Dashboard with analytics and quick stats
     */
    public function dashboard() {
        try {
            $stats = $this->getDashboardStats();
            $recentActivity = $this->getRecentActivity();
            $topUsers = $this->getTopUsers();
            $systemHealth = $this->getSystemHealth();
            
            loadView('admin/dashboard', [
                'pageTitle' => 'Admin Dashboard',
                'stats' => $stats,
                'recentActivity' => $recentActivity,
                'topUsers' => $topUsers,
                'systemHealth' => $systemHealth
            ]);
        } catch (Exception $e) {
            error_log("Dashboard error: " . $e->getMessage());
            $this->handleError('Failed to load dashboard');
        }
    }
    
    /**
     * User Management Functions
     */
    public function users() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $search = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? 'all';
        
        try {
            if ($search) {
                $users = $this->userModel->search($search);
                $totalUsers = count($users);
            } else {
                $users = $this->getUsersByStatus($status, $limit, $offset);
                $totalUsers = $this->userModel->getTotalCount();
            }
            
            $totalPages = ceil($totalUsers / $limit);
            
            loadView('admin/users', [
                'pageTitle' => 'User Management',
                'users' => $users,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'search' => $search,
                'status' => $status,
                'totalUsers' => $totalUsers
            ]);
        } catch (Exception $e) {
            error_log("Users page error: " . $e->getMessage());
            $this->handleError('Failed to load users');
        }
    }
    
    /**
     * Promote user to admin
     */
    public function promoteToAdmin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            $reason = $_POST['reason'] ?? '';
            
            if (!$userId) {
                $_SESSION['error'] = 'User ID is required';
                redirect('/admin/users');
                return;
            }
            
            try {
                $user = $this->userModel->usergetById($userId);
                if (!$user) {
                    $_SESSION['error'] = 'User not found';
                    redirect('/admin/users');
                    return;
                }
                
                $this->userModel->setAdmin($userId, true);
                $this->logAdminAction('promote_admin', $userId, $reason);
                
                $_SESSION['success'] = "User {$user->first_name} {$user->last_name} promoted to admin";
                redirect('/admin/users');
            } catch (Exception $e) {
                error_log("Promote admin error: " . $e->getMessage());
                $_SESSION['error'] = 'Failed to promote user';
                redirect('/admin/users');
            }
        }
    }
    
    /**
     * Suspend user account
     */
    public function suspendUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            $reason = $_POST['reason'] ?? '';
            $duration = $_POST['duration'] ?? 30; // days
            
            if (!$userId || !$reason) {
                $_SESSION['error'] = 'User ID and reason are required';
                redirect('/admin/users');
                return;
            }
            
            try {
                $suspendedUntil = date('Y-m-d H:i:s', strtotime("+{$duration} days"));
                
                $this->userModel->suspendUser($userId, $reason, $suspendedUntil);
                $this->logAdminAction('suspend_user', $userId, $reason);
                
                $_SESSION['success'] = 'User suspended successfully';
                redirect('/admin/users');
            } catch (Exception $e) {
                error_log("Suspend user error: " . $e->getMessage());
                $_SESSION['error'] = 'Failed to suspend user';
                redirect('/admin/users');
            }
        }
    }
    
    /**
     * Event Management Functions
     */
    public function events() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;
        $status = $_GET['status'] ?? 'all';
        $category = $_GET['category'] ?? 'all';
        
        try {
            $events = $this->getEventsWithFilters($status, $category, $limit, $offset);
            $totalEvents = $this->eventModel->getTotalCount();
            $totalPages = ceil($totalEvents / $limit);
            
            $eventStats = $this->getEventStats();
            
            loadView('admin/events', [
                'pageTitle' => 'Event Management',
                'events' => $events,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'status' => $status,
                'category' => $category,
                'eventStats' => $eventStats
            ]);
        } catch (Exception $e) {
            error_log("Events page error: " . $e->getMessage());
            $this->handleError('Failed to load events');
        }
    }
    
    /**
     * Feature event (highlight on homepage)
     */
    public function featureEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventId = $_POST['event_id'] ?? null;
            $featured = $_POST['featured'] ?? 0;
            
            if (!$eventId) {
                $_SESSION['error'] = 'Event ID is required';
                redirect('/admin/events');
                return;
            }
            
            try {
                $this->eventModel->setFeatured($eventId, $featured);
                $action = $featured ? 'featured' : 'unfeatured';
                $this->logAdminAction("event_{$action}", $eventId);
                
                $_SESSION['success'] = 'Event updated successfully';
                redirect('/admin/events');
            } catch (Exception $e) {
                error_log("Feature event error: " . $e->getMessage());
                $_SESSION['error'] = 'Failed to update event';
                redirect('/admin/events');
            }
        }
    }
    
    /**
     * Reports Management
     */
    public function reports() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $status = $_GET['status'] ?? 'pending';
        $type = $_GET['type'] ?? 'all';
        
        try {
            $reports = $this->getReportsWithFilters($status, $type, $limit, $offset);
            $totalReports = $this->reportModel->getTotalCount();
            $totalPages = ceil($totalReports / $limit);
            
            loadView('admin/reports', [
                'pageTitle' => 'Reports Management',
                'reports' => $reports,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'status' => $status,
                'type' => $type
            ]);
        } catch (Exception $e) {
            error_log("Reports page error: " . $e->getMessage());
            $this->handleError('Failed to load reports');
        }
    }
    
    /**
     * Handle report action (approve/reject/investigate)
     */
    public function handleReport() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reportId = $_POST['report_id'] ?? null;
            $action = $_POST['action'] ?? null;
            $notes = $_POST['admin_notes'] ?? '';
            
            if (!$reportId || !$action) {
                $_SESSION['error'] = 'Report ID and action are required';
                redirect('/admin/reports');
                return;
            }
            
            try {
                $this->reportModel->updateStatus($reportId, $action, $notes);
                $this->logAdminAction("report_{$action}", $reportId, $notes);
                
                // Take action based on report type and decision
                if ($action === 'approved') {
                    $this->processApprovedReport($reportId);
                }
                
                $_SESSION['success'] = 'Report processed successfully';
                redirect('/admin/reports');
            } catch (Exception $e) {
                error_log("Handle report error: " . $e->getMessage());
                $_SESSION['error'] = 'Failed to process report';
                redirect('/admin/reports');
            }
        }
    }
    
    /**
     * Analytics and Statistics
     */
    public function analytics() {
        try {
            $timeRange = $_GET['range'] ?? '30'; // days
            
            $analytics = [
                'userGrowth' => $this->getUserGrowthData($timeRange),
                'eventStats' => $this->getEventAnalytics($timeRange),
                'activityStats' => $this->getActivityStats($timeRange),
                'locationStats' => $this->getLocationStats(),
                'revenueStats' => $this->getRevenueStats($timeRange)
            ];
            
            loadView('admin/analytics', [
                'pageTitle' => 'Analytics Dashboard',
                'analytics' => $analytics,
                'timeRange' => $timeRange
            ]);
        } catch (Exception $e) {
            error_log("Analytics error: " . $e->getMessage());
            $this->handleError('Failed to load analytics');
        }
    }
    
    /**
     * System Settings
     */
    public function settings() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updateSystemSettings($_POST);
        }
        
        try {
            $settings = $this->getSystemSettings();
            
            loadView('admin/settings', [
                'pageTitle' => 'System Settings',
                'settings' => $settings
            ]);
        } catch (Exception $e) {
            error_log("Settings error: " . $e->getMessage());
            $this->handleError('Failed to load settings');
        }
    }
    
    /**
     * Bulk Operations
     */
    public function bulkActions() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['bulk_action'] ?? null;
            $items = $_POST['selected_items'] ?? [];
            $entityType = $_POST['entity_type'] ?? null;
            
            if (!$action || empty($items) || !$entityType) {
                $_SESSION['error'] = 'Invalid bulk action parameters';
                redirect('/admin/' . $entityType);
                return;
            }
            
            try {
                $result = $this->processBulkAction($action, $items, $entityType);
                
                $_SESSION['success'] = "Bulk action completed: {$result['processed']} items processed";
                redirect('/admin/' . $entityType);
            } catch (Exception $e) {
                error_log("Bulk action error: " . $e->getMessage());
                $_SESSION['error'] = 'Bulk action failed';
                redirect('/admin/' . $entityType);
            }
        }
    }
    
    /**
     * Export Data
     */
    public function exportData() {
        $type = $_GET['type'] ?? 'users';
        $format = $_GET['format'] ?? 'csv';
        
        try {
            switch ($type) {
                case 'users':
                    $data = $this->userModel->getAllForExport();
                    break;
                case 'events':
                    $data = $this->eventModel->getAllForExport();
                    break;
                case 'reports':
                    $data = $this->reportModel->getAllForExport();
                    break;
                default:
                    throw new Exception('Invalid export type');
            }
            
            $this->generateExport($data, $type, $format);
        } catch (Exception $e) {
            error_log("Export error: " . $e->getMessage());
            $_SESSION['error'] = 'Export failed';
            redirect('/admin/analytics');
        }
    }
    
    // Helper Methods
    private function getDashboardStats() {
        return [
            'totalUsers' => $this->userModel->getTotalCount(),
            'activeUsers' => $this->userModel->getActiveCount(),
            'totalEvents' => $this->eventModel->getTotalCount(),
            'upcomingEvents' => $this->eventModel->getUpcomingCount(),
            'pendingReports' => $this->reportModel->getPendingCount(),
            'newUsersToday' => $this->userModel->getNewUsersCount(1),
            'eventsToday' => $this->eventModel->getEventsCount(1)
        ];
    }
    
    private function getRecentActivity($limit = 10) {
        $query = "
            (SELECT 'user_joined' as type, first_name, last_name, created_at, user_id as entity_id 
             FROM users ORDER BY created_at DESC LIMIT 5)
            UNION ALL
            (SELECT 'event_created' as type, title as first_name, '' as last_name, created_at, event_id as entity_id 
             FROM events ORDER BY created_at DESC LIMIT 5)
            ORDER BY created_at DESC LIMIT :limit
        ";
        
        return $this->db->query($query, ['limit' => $limit])->fetchAll();
    }
    
    private function logAdminAction($action, $entityId, $notes = '') {
        $query = "INSERT INTO admin_logs (admin_id, action, entity_id, notes, created_at) 
                  VALUES (:admin_id, :action, :entity_id, :notes, NOW())";
        
        $params = [
            'admin_id' => Session::get('user_id'),
            'action' => $action,
            'entity_id' => $entityId,
            'notes' => $notes
        ];
        
        $this->db->query($query, $params);
    }
    
    private function handleError($message) {
        $_SESSION['error'] = $message;
        redirect('/admin/dashboard');
    }
    
    private function processBulkAction($action, $items, $entityType) {
        $processed = 0;
        
        foreach ($items as $itemId) {
            switch ($entityType) {
                case 'users':
                    if ($action === 'suspend') {
                        $this->userModel->suspendUser($itemId, 'Bulk suspension');
                        $processed++;
                    }
                    break;
                case 'events':
                    if ($action === 'delete') {
                        $this->eventModel->delete($itemId);
                        $processed++;
                    }
                    break;
            }
        }
        
        return ['processed' => $processed];
    }
    
    private function generateExport($data, $type, $format) {
        if ($format === 'csv') {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $type . '_export_' . date('Y-m-d') . '.csv"');
            
            $output = fopen('php://output', 'w');
            
            if (!empty($data)) {
                // Write headers
                fputcsv($output, array_keys((array)$data[0]));
                
                // Write data
                foreach ($data as $row) {
                    fputcsv($output, (array)$row);
                }
            }
            
            fclose($output);
            exit;
        }
    }
}