<?php
namespace App\Controllers;

use App\Models\Friendship;
use App\Models\Notification;
use Framework\Session;

class FriendshipController extends BaseController {
    protected $friendshipModel;
    protected $notificationModel;
    
    public function __construct() {
        parent::__construct();
        $this->friendshipModel = new Friendship();
        $this->notificationModel = new Notification();
    }
    
    /**
     * Handle friend request actions (accept/decline)
     */
    public function handleRequest() {
        ob_clean();
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, must-revalidate');
    
        try {
            $currentUserId = Session::get('user_id');
            if (!$currentUserId) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Unauthorized']);
                exit;
            }
    
            $input = json_decode(file_get_contents('php://input'), true);
            error_log("Friendship request received - User ID: $currentUserId, Input: " . json_encode($input));
    
            $friendshipId = $input['friendship_id'] ?? null;
            $action = $input['action'] ?? null;
    
            if (!$friendshipId || !in_array($action, ['accept', 'decline'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid request data']);
                exit;
            }
    
            // --- İkinci try bloğuna gerek yok, tek try yeterli ---
            $friendship = $this->friendshipModel->getById($friendshipId);
    
            if (!$friendship) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Friend request not found']);
                return;
            }
    
            if ($friendship->user_id_2 != $currentUserId) {
                http_response_code(403);
                echo json_encode(['success' => false, 'message' => 'Not authorized to handle this request']);
                return;
            }
    
            if ($friendship->status !== 'pending') {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Request already processed']);
                return;
            }
    
            if ($action === 'accept') {
                $result = $this->friendshipModel->acceptRequest($friendshipId);
                $message = 'Friend request accepted!';
    
                $this->notificationModel->create([
                    'user_id' => $friendship->user_id_1,
                    'type' => 'friend_request_accepted',
                    'related_id' => $currentUserId,
                    'content' => 'Your friend request has been accepted!'
                ]);
    
            } else {
                $result = $this->friendshipModel->declineRequest($friendshipId);
                $message = 'Friend request declined';
            }
    
            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => $message,
                    'action' => $action
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Database error occurred']);
            }
    
        } catch (Exception $e) {
            error_log("Friendship request error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Send a friend request
     */
    public function sendRequest() {
        $currentUserId = Session::get('user_id');
        if (!$currentUserId) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $targetUserId = $input['user_id'] ?? null;
        
        if (!$targetUserId || $targetUserId == $currentUserId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
            return;
        }
        
        try {
            // Check if friendship already exists
            $existingStatus = $this->friendshipModel->checkFriendshipStatus($currentUserId, $targetUserId);
            
            if ($existingStatus !== 'none') {
                echo json_encode(['success' => false, 'message' => 'Friend request already exists']);
                return;
            }
            
            // Create friend request
            $result = $this->friendshipModel->create([
                'user_id_1' => $currentUserId,
                'user_id_2' => $targetUserId,
                'status' => 'pending'
            ]);
            
            if ($result) {
                // Create notification
                $this->notificationModel->create([
                    'user_id' => $targetUserId,
                    'type' => 'friend_request',
                    'related_id' => $currentUserId,
                    'content' => 'You have a new friend request!'
                ]);
                
                echo json_encode(['success' => true, 'message' => 'Friend request sent!']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to send request']);
            }
            
        } catch (Exception $e) {
            error_log("Send friend request error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred']);
        }
    }
}