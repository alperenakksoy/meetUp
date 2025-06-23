<?php
namespace App\Controllers;

use App\Models\Message;
use App\Models\Friendship;
use App\Models\User;
use Framework\Database;
use Framework\Session;
use Exception;

class MessageController {
    private $messageModel;
    private $friendshipModel;
    private $userModel;
    
    public function __construct() {
        $this->messageModel = new Message();
        $this->friendshipModel = new Friendship();
        $this->userModel = new User();
    }
    
    /**
     * Show messages page with conversations list
     */
    // Add this temporary debug version to your MessageController index method
    
    
    public function index() {
        if (!Session::has('user')) {
            redirect('/auth/login');
        }
        
        $userId = Session::get('user_id');
        
        // Debug: Check user ID
        error_log("Debug: User ID is " . $userId);
        error_log("Debug: Session data: " . print_r($_SESSION, true));
        
        try {
            // Get conversations
            $conversations = $this->messageModel->getUserConversations($userId);
            
            // If the main method fails, try the simple method
            if (empty($conversations)) {
                error_log("Debug: Primary getUserConversations returned empty, trying simple method");
                $conversations = $this->messageModel->getUserConversationsSimple($userId);
            }
            
            $unreadCount = $this->messageModel->getUnreadCount($userId);
            
            // Debug: Check conversations data
            error_log("Debug: Conversations count: " . count($conversations));
            error_log("Debug: First conversation data: " . print_r($conversations[0] ?? 'none', true));
            error_log("Debug: Unread count: " . $unreadCount);
            
            // Validate conversation data structure
            foreach ($conversations as $index => $conversation) {
                if (!isset($conversation->friend_id)) {
                    error_log("Warning: Conversation $index missing friend_id");
                }
                if (!isset($conversation->first_name)) {
                    error_log("Warning: Conversation $index missing first_name");
                }
            }
            
            loadView('messages/index', [
                'conversations' => $conversations,
                'unreadCount' => $unreadCount
            ]);
            
        } catch (Exception $e) {
            error_log("Error in MessageController::index: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            // Load view with empty data to prevent fatal errors
            loadView('messages/index', [
                'conversations' => [],
                'unreadCount' => 0,
                'error' => 'Failed to load conversations: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Enhanced conversation method with better error handling
     */
    public function conversation($friendId) {
        if (!Session::has('user')) {
            redirect('/auth/login');
        }
        
        $userId = Session::get('user_id');
        
        // Debug logs
        error_log("Debug: Opening conversation - User ID: $userId, Friend ID: $friendId");
        
        // Validate friend ID
        if (!$friendId || !is_numeric($friendId)) {
            error_log("Error: Invalid friend ID: $friendId");
            $_SESSION['error_message'] = 'Invalid conversation ID.';
            redirect('/messages');
            return;
        }
        
        try {
            // Check if users are friends
            if (!$this->friendshipModel->areFriends($userId, $friendId)) {
                error_log("Error: Users are not friends - User: $userId, Friend: $friendId");
                $_SESSION['error_message'] = 'You can only message friends.';
                redirect('/messages');
                return;
            }
            
            // Get friend info
            $friend = $this->userModel->usergetById($friendId);
            if (!$friend) {
                error_log("Error: Friend not found - ID: $friendId");
                $_SESSION['error_message'] = 'User not found.';
                redirect('/messages');
                return;
            }
            
            // Get conversation messages
            $messages = $this->messageModel->getConversation($userId, $friendId);
            
            // Mark messages as read
            $this->messageModel->markAsRead($friendId, $userId);
            
            // Get all conversations for sidebar
            $conversations = $this->messageModel->getUserConversations($userId);
            
            // Debug
            error_log("Debug: Loaded conversation - Messages: " . count($messages) . ", Conversations: " . count($conversations));
            
            loadView('messages/conversation', [
                'friend' => $friend,
                'messages' => $messages,
                'conversations' => $conversations,
                'currentFriendId' => $friendId,
                'userId' => $userId
            ]);
            
        } catch (Exception $e) {
            error_log("Error in MessageController::conversation: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $_SESSION['error_message'] = 'Error loading conversation.';
            redirect('/messages');
        }
    } 
/**
     * Send a message via AJAX
     */
    public function send() {
        // Set proper headers
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, must-revalidate');
        
        try {
            if (!Session::has('user')) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Not authenticated']);
                return;
            }
            
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
                return;
            }
            
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Validate JSON input
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
                return;
            }
            
            $receiverId = filter_var($data['receiver_id'] ?? null, FILTER_VALIDATE_INT);
            $message = trim($data['message'] ?? '');
            
            // Validate inputs
            if (!$receiverId || $receiverId <= 0) {
                echo json_encode(['success' => false, 'message' => 'Invalid receiver ID']);
                return;
            }
            
            if (empty($message)) {
                echo json_encode(['success' => false, 'message' => 'Message cannot be empty']);
                return;
            }
            
            // Check message length (e.g., max 1000 characters)
            if (strlen($message) > 1000) {
                echo json_encode(['success' => false, 'message' => 'Message too long (max 1000 characters)']);
                return;
            }
            
            $senderId = Session::get('user_id');
            
            // Can't message yourself
            if ($senderId == $receiverId) {
                echo json_encode(['success' => false, 'message' => 'Cannot send message to yourself']);
                return;
            }
            
            // Check if users are friends
            if (!$this->friendshipModel->areFriends($senderId, $receiverId)) {
                echo json_encode(['success' => false, 'message' => 'You can only message friends']);
                return;
            }
            
            // Sanitize message content
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
            
            $messageId = $this->messageModel->sendMessage($senderId, $receiverId, $message);
            
            if ($messageId) {
                echo json_encode([
                    'success' => true,
                    'message_id' => $messageId,
                    'timestamp' => date('Y-m-d H:i:s'),
                    'message' => 'Message sent successfully'
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to send message']);
            }
            
        } catch (Exception $e) {
            error_log("Message send error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        }
        
        exit;
    }
    
    /**
     * Get new messages via AJAX (for real-time updates)
     */
    public function getNewMessages($friendId, $lastMessageId = 0) {
        header('Content-Type: application/json');
        
        try {
            if (!Session::has('user')) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Not authenticated']);
                return;
            }
            
            $userId = Session::get('user_id');
            $friendId = filter_var($friendId, FILTER_VALIDATE_INT);
            $lastMessageId = filter_var($lastMessageId, FILTER_VALIDATE_INT);
            
            if (!$friendId || $friendId <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid friend ID']);
                return;
            }
            
            // Check if users are friends
            if (!$this->friendshipModel->areFriends($userId, $friendId)) {
                http_response_code(403);
                echo json_encode(['success' => false, 'message' => 'Not authorized']);
                return;
            }
            
            $query = "SELECT m.message_id, m.sender_id, m.receiver_id, m.message_content, m.created_at,
                             sender.first_name as sender_name,
                             sender.profile_picture as sender_picture
                      FROM messages m
                      JOIN users sender ON m.sender_id = sender.user_id
                      WHERE ((m.sender_id = :user_id AND m.receiver_id = :friend_id)
                         OR (m.sender_id = :friend_id AND m.receiver_id = :user_id))
                        AND m.message_id > :last_message_id
                      ORDER BY m.created_at ASC";
            
            $params = [
                'user_id' => $userId,
                'friend_id' => $friendId,
                'last_message_id' => $lastMessageId ?: 0
            ];
            
            $newMessages = $this->messageModel->query($query, $params)->fetchAll();
            
            // Mark new messages as read if they're from the friend
            if (!empty($newMessages)) {
                $this->messageModel->markAsRead($friendId, $userId);
            }
            
            echo json_encode([
                'success' => true,
                'messages' => $newMessages,
                'count' => count($newMessages)
            ]);
            
        } catch (Exception $e) {
            error_log("Get new messages error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        }
        
        exit;
    }
    
    /**
     * Delete a message
     */
    public function deleteMessage() {
        header('Content-Type: application/json');
        
        try {
            if (!Session::has('user')) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Not authenticated']);
                return;
            }
            
            $data = json_decode(file_get_contents('php://input'), true);
            $messageId = filter_var($data['message_id'] ?? null, FILTER_VALIDATE_INT);
            $userId = Session::get('user_id');
            
            if (!$messageId) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid message ID']);
                return;
            }
            
            // Check if user owns the message
            $message = $this->messageModel->getById($messageId);
            if (!$message || $message->sender_id != $userId) {
                http_response_code(403);
                echo json_encode(['success' => false, 'message' => 'Not authorized to delete this message']);
                return;
            }
            
            $result = $this->messageModel->delete($messageId);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Message deleted']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to delete message']);
            }
            
        } catch (Exception $e) {
            error_log("Delete message error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        }
        
        exit;
    }
    
    /**
     * Get unread message count
     */
    public function getUnreadCount() {
        header('Content-Type: application/json');
        
        try {
            if (!Session::has('user')) {
                http_response_code(401);
                echo json_encode(['success' => false]);
                return;
            }
            
            $userId = Session::get('user_id');
            $unreadCount = $this->messageModel->getUnreadCount($userId);
            
            echo json_encode([
                'success' => true,
                'unread_count' => $unreadCount
            ]);
            
        } catch (Exception $e) {
            error_log("Get unread count error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false]);
        }
        
        exit;
    }
}