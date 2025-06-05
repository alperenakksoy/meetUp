<?php
namespace App\Controllers;
use App\Models\Friendship;
use App\Models\Notification;
use App\Models\User;

use Framework\Session;
use Exception;

class FriendshipController extends BaseController {
    protected $userModel;
    protected $friendshipModel;
    protected $notificationModel;
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->friendshipModel = new Friendship();
        $this->notificationModel = new Notification();
    }

    /**
     * Handle friend request (accept or decline)
     * @param array $params
     */
    public function handleRequest($params = []) {
        // Check if user is logged in
        $userId = Session::get('user_id');
        if (!$userId) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Giriş yapmalısınız']);
            exit;
        }

        // Get parameters
        $friendshipId = isset($params['friendship_id']) ? (int)$params['friendship_id'] : 0;
        $action = isset($params['action']) ? $params['action'] : '';

        if ($friendshipId <= 0 || !in_array($action, ['accept', 'decline'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Geçersiz istek']);
            exit;
        }

        // Verify the request belongs to the user
        $friendship = $this->friendshipModel->getById($friendshipId);
        if (!$friendship || $friendship->user_id_2 != $userId) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Yetkisiz işlem']);
            exit;
        }

        try {
            if ($action === 'accept') {
                $this->friendshipModel->acceptRequest($friendshipId);
                // Create notification for the requester
                $this->notificationModel->createFriendRequest($friendship->user_id_1, $userId);
                $message = 'Arkadaşlık isteği kabul edildi!';
            } else {
                $this->friendshipModel->declineRequest($friendshipId);
                $message = 'Arkadaşlık isteği reddedildi!';
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => $message]);
        } catch (Exception $e) {
            error_log("Error in handleRequest: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Bir hata oluştu']);
        }
    }

/**
 * Cancel a sent friend request
 */
public function cancelRequest() {
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

        // Validate input
        if (!$friendshipId) {
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

        // Check if current user is the sender of this request
        if ($friendship->user_id_1 != $currentUserId) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'You cannot cancel this request']);
            exit;
        }

        // Check if request is still pending
        if ($friendship->status !== 'pending') {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'This request cannot be canceled']);
            exit;
        }

        // Delete the friendship request
        $result = $this->friendshipModel->delete($friendshipId);

        // Return response
        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Friend request canceled successfully',
                'friendship_id' => $friendshipId
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to cancel request']);
        }

    } catch (Exception $e) {
        error_log("Cancel friend request error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Server error occurred']);
    }
    
    exit; // Ensure no additional output
}


/**
 * Send a friend request
 */
public function sendRequest() {
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
        
        $targetUserId = $input['user_id'] ?? null;

        // Validate input
        if (!$targetUserId || !is_numeric($targetUserId)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
            exit;
        }

        // Check if trying to send request to self
        if ($currentUserId == $targetUserId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Cannot send friend request to yourself']);
            exit;
        }

        // Check if target user exists
        $targetUser = $this->userModel->usergetById($targetUserId);
        if (!$targetUser) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'User not found']);
            exit;
        }

        // Check existing friendship status
        $existingStatus = $this->friendshipModel->checkFriendshipStatus($currentUserId, $targetUserId);
        
        if ($existingStatus === 'accepted') {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You are already friends with this user']);
            exit;
        }
        
        if ($existingStatus === 'pending') {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Friend request already sent']);
            exit;
        }

        // Send the friend request
        $friendshipId = $this->friendshipModel->sendFriendRequest($currentUserId, $targetUserId);

        if ($friendshipId) {
            // Create notification for the receiver
            $this->notificationModel->createFriendRequest($targetUserId, $currentUserId);
            
            echo json_encode([
                'success' => true,
                'message' => 'Friend request sent successfully',
                'friendship_id' => $friendshipId
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to send friend request']);
        }

    } catch (Exception $e) {
        error_log("Send friend request error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Server error occurred']);
    }
    
    exit;
}

}