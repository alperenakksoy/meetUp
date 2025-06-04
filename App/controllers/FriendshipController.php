<?php
namespace App\Controllers;

use App\Models\Friendship;
use App\Models\Notification;
use Framework\Session;
use Exception;

class FriendshipController extends BaseController {
    protected $friendshipModel;
    protected $notificationModel;
    
    public function __construct() {
        parent::__construct();
        $this->friendshipModel = new Friendship();
        $this->notificationModel = new Notification();
    }
    
    /**
     * Handle friend request actions (accept/decline) - SIMPLIFIED
     */
    public function handleRequest() {
        // Clear any previous output and set JSON headers
        if (ob_get_level()) {
            ob_clean();
        }
        header('Content-Type: application/json');
        
        try {
            // Check if user is logged in
            $currentUserId = Session::get('user_id');
            if (!$currentUserId) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Please log in']);
                exit;
            }
    
            // Get and validate input
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
                exit;
            }
            
            $friendshipId = $input['friendship_id'] ?? null;
            $action = $input['action'] ?? null;
    
            // Validate input
            if (!$friendshipId || !in_array($action, ['accept', 'decline'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid request parameters']);
                exit;
            }
    
            // Get the friendship record
            $friendship = $this->friendshipModel->getById($friendshipId);
    
            if (!$friendship) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Friend request not found']);
                exit;
            }
    
            // Check if current user is the receiver of this request
            if ($friendship->user_id_2 != $currentUserId) {
                http_response_code(403);
                echo json_encode(['success' => false, 'message' => 'You cannot handle this request']);
                exit;
            }
    
            // Check if request is still pending
            if ($friendship->status !== 'pending') {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'This request has already been processed']);
                exit;
            }
    
            // Process the action
            $result = false;
            $message = '';
            
            if ($action === 'accept') {
                $result = $this->friendshipModel->acceptRequest($friendshipId);
                $message = 'Friend request accepted!';
                
                // Create notification for the sender
                try {
                    $this->notificationModel->create([
                        'user_id' => $friendship->user_id_1,
                        'type' => 'friend_request_accepted', 
                        'related_id' => $currentUserId,
                        'content' => 'Your friend request has been accepted!'
                    ]);
                } catch (Exception $e) {
                    // Log notification error but don't fail the main operation
                    error_log("Failed to create notification: " . $e->getMessage());
                }
                
            } elseif ($action === 'decline') {
                $result = $this->friendshipModel->declineRequest($friendshipId);
                $message = 'Friend request declined';
            }
    
            // Return response
            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => $message,
                    'action' => $action,
                    'friendship_id' => $friendshipId
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Database operation failed']);
            }
    
        } catch (Exception $e) {
            error_log("Friendship request error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        }
        
        exit; // Ensure no additional output
    }
    
    /**
     * Send a friend request - SIMPLIFIED
     */
    public function sendRequest() {
        if (ob_get_level()) {
            ob_clean();
        }
        header('Content-Type: application/json');
        
        try {
            $currentUserId = Session::get('user_id');
            if (!$currentUserId) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Please log in']);
                exit;
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            $targetUserId = $input['user_id'] ?? null;
            
            if (!$targetUserId || $targetUserId == $currentUserId) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
                exit;
            }
            
            // Check if friendship already exists
            $existingStatus = $this->friendshipModel->checkFriendshipStatus($currentUserId, $targetUserId);
            
            if ($existingStatus !== 'none') {
                echo json_encode(['success' => false, 'message' => 'Friend request already exists']);
                exit;
            }
            
            // Create friend request
            $result = $this->friendshipModel->create([
                'user_id_1' => $currentUserId,
                'user_id_2' => $targetUserId,
                'status' => 'pending'
            ]);
            
            if ($result) {
                // Create notification
                try {
                    $this->notificationModel->create([
                        'user_id' => $targetUserId,
                        'type' => 'friend_request',
                        'related_id' => $currentUserId,
                        'content' => 'You have a new friend request!'
                    ]);
                } catch (Exception $e) {
                    error_log("Failed to create notification: " . $e->getMessage());
                }
                
                echo json_encode(['success' => true, 'message' => 'Friend request sent!']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to send request']);
            }
            
        } catch (Exception $e) {
            error_log("Send friend request error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        }
        
        exit;
    }
}