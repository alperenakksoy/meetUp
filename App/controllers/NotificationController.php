<?php
namespace App\Controllers;

use App\Models\Notification;
use App\Models\User;
use Framework\Session;
use Exception;

class NotificationController extends BaseController {
    protected $notificationModel;
    protected $userModel;
    
    public function __construct() {
        parent::__construct();
        $this->notificationModel = new Notification();
        $this->userModel = new User();
    }
    
    /**
     * Display all notifications for the current user
     */
    public function index() {
        // Check if user is logged in
        $userId = Session::get('user_id');
        if (!$userId) {
            redirect('/login');
            return;
        }
        
        try {
            // Get user's notifications
            $notifications = $this->notificationModel->getUserNotifications($userId, 50);
            
            // Get unread count
            $unreadCount = $this->notificationModel->getUnreadCount($userId);
            
            // Get user info
            $user = $this->userModel->usergetById($userId);
            
            // Process notifications to add additional data
            foreach($notifications as $notification) {
                // Parse time ago
                $notification->time_ago = $this->timeAgo($notification->created_at);
                
                // Add icon based on type
                $notification->icon = $this->getNotificationIcon($notification->type);
                
                // Add color class based on type
                $notification->color_class = $this->getNotificationColorClass($notification->type);
                
                // Format content with proper links
                $notification->formatted_content = $this->formatNotificationContent($notification);
            }
            
            loadView('notifications/index', [
                'notifications' => $notifications,
                'unreadCount' => $unreadCount,
                'user' => $user
            ]);
            
        } catch (Exception $e) {
            error_log("Error in notifications index: " . $e->getMessage());
            $_SESSION['error_message'] = 'Error loading notifications';
            redirect('/');
        }
    }
    
    /**
     * Mark a notification as read
     */
    public function markAsRead($params) {
        // Clear any previous output and set JSON headers
        if (ob_get_level()) {
            ob_clean();
        }
        header('Content-Type: application/json');
        
        try {
            $userId = Session::get('user_id');
            if (!$userId) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Please log in']);
                exit;
            }
            
            $notificationId = $params['id'] ?? null;
            
            if (!$notificationId) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid notification ID']);
                exit;
            }
            
            // Mark as read
            $result = $this->notificationModel->markAsRead($notificationId);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Notification marked as read']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to mark notification as read']);
            }
            
        } catch (Exception $e) {
            error_log("Mark notification as read error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        }
        
        exit;
    }
    
    /**
     * Mark all notifications as read
     */
    public function markAllAsRead() {
        // Clear any previous output and set JSON headers
        if (ob_get_level()) {
            ob_clean();
        }
        header('Content-Type: application/json');
        
        try {
            $userId = Session::get('user_id');
            if (!$userId) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Please log in']);
                exit;
            }
            
            // Mark all as read
            $result = $this->notificationModel->markAllAsRead($userId);
            
            if ($result) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'All notifications marked as read',
                    'unread_count' => 0
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to mark notifications as read']);
            }
            
        } catch (Exception $e) {
            error_log("Mark all notifications as read error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        }
        
        exit;
    }
    
    /**
     * Get notification count (AJAX endpoint)
     */
    public function getCount() {
        // Clear any previous output and set JSON headers
        if (ob_get_level()) {
            ob_clean();
        }
        header('Content-Type: application/json');
        
        try {
            $userId = Session::get('user_id');
            if (!$userId) {
                echo json_encode(['count' => 0]);
                exit;
            }
            
            $count = $this->notificationModel->getUnreadCount($userId);
            echo json_encode(['count' => $count]);
            
        } catch (Exception $e) {
            error_log("Get notification count error: " . $e->getMessage());
            echo json_encode(['count' => 0]);
        }
        
        exit;
    }
    
    /**
     * Get notification icon based on type
     */
    private function getNotificationIcon($type) {
        $icons = [
            'event_invitation' => 'fas fa-calendar-plus',
            'friend_request' => 'fas fa-user-plus',
            'event_update' => 'fas fa-calendar-edit',
            'new_attendee' => 'fas fa-users',
            'new_message' => 'fas fa-envelope',
            'event_reminder' => 'fas fa-bell',
            'new_review' => 'fas fa-star'
        ];
        
        return $icons[$type] ?? 'fas fa-bell';
    }
    
    /**
     * Get notification color class based on type
     */
    private function getNotificationColorClass($type) {
        $colors = [
            'event_invitation' => 'text-blue-500',
            'friend_request' => 'text-green-500',
            'event_update' => 'text-orange-500',
            'new_attendee' => 'text-purple-500',
            'new_message' => 'text-pink-500',
            'event_reminder' => 'text-yellow-500',
            'new_review' => 'text-indigo-500'
        ];
        
        return $colors[$type] ?? 'text-gray-500';
    }
    
    /**
     * Format notification content with proper links
     */
    private function formatNotificationContent($notification) {
        $content = $notification->content;
        
        // Add links based on notification type
        switch($notification->type) {
            case 'event_invitation':
            case 'event_update':
            case 'event_reminder':
                $content .= ' <a href="/events/' . $notification->related_id . '" class="text-orange-500 hover:underline">View Event</a>';
                break;
                
            case 'friend_request':
                $content .= ' <a href="/users/friends" class="text-orange-500 hover:underline">Manage Requests</a>';
                break;
                
            case 'new_message':
                $content .= ' <a href="/messages/' . $notification->related_id . '" class="text-orange-500 hover:underline">Read Message</a>';
                break;
                
            case 'new_review':
                $content .= ' <a href="/users/references" class="text-orange-500 hover:underline">View Reviews</a>';
                break;
        }
        
        return $content;
    }
    
    /**
     * Calculate time ago from timestamp
     */
    private function timeAgo($datetime) {
        $time = time() - strtotime($datetime);
        
        if ($time < 60) {
            return 'just now';
        } elseif ($time < 3600) {
            $minutes = floor($time / 60);
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        } elseif ($time < 86400) {
            $hours = floor($time / 3600);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } elseif ($time < 2592000) {
            $days = floor($time / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        } elseif ($time < 31536000) {
            $months = floor($time / 2592000);
            return $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
        } else {
            $years = floor($time / 31536000);
            return $years . ' year' . ($years > 1 ? 's' : '') . ' ago';
        }
    }
}