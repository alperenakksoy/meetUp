<?php
namespace App\Controllers;

use App\Models\Message;
use App\Models\Friendship;
use App\Models\User;
use Framework\Session;

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
    public function index() {
        if (!Session::has('user')) {
            redirect('/auth/login');
        }
        
        $userId =Session::get('user_id');
        $conversations = $this->messageModel->getUserConversations($userId);
        $unreadCount = $this->messageModel->getUnreadCount($userId);
        
        loadView('messages/index', [
            'conversations' => $conversations,
            'unreadCount' => $unreadCount
        ]);
    }
    
    /**
     * Show conversation with specific user
     */
    public function conversation($friendId) {
        if (!Session::has('user')) {
            redirect('/auth/login');
        }
        
        $userId =Session::get('user_id');
        
        // Check if users are friends
        if (!$this->friendshipModel->areFriends($userId, $friendId)) {
            $_SESSION['error_message'] = 'You can only message friends.';
            redirect('/messages');
        }
        
        // Get friend info
        $friend = $this->userModel->getById($friendId);
        if (!$friend) {
            $_SESSION['error_message'] = 'User not found.';
            redirect('/messages');
        }
        
        // Get conversation messages
        $messages = $this->messageModel->getConversation($userId, $friendId);
        
        // Mark messages as read
        $this->messageModel->markAsRead($friendId, $userId);
        
        // Get all conversations for sidebar
        $conversations = $this->messageModel->getUserConversations($userId);
        
        loadView('messages/conversation', [
            'friend' => $friend,
            'messages' => $messages,
            'conversations' => $conversations,
            'currentFriendId' => $friendId
        ]);
    }
    
    /**
     * Send a message via AJAX
     */
    public function send() {
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
        $receiverId = $data['receiver_id'] ?? null;
        $message = trim($data['message'] ?? '');
        
        if (!$receiverId || !$message) {
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            return;
        }
        
        $senderId =Session::get('user_id');

        
        // Check if users are friends
        if (!$this->friendshipModel->areFriends($senderId, $receiverId)) {
            echo json_encode(['success' => false, 'message' => 'You can only message friends']);
            return;
        }
        
        $messageId = $this->messageModel->sendMessage($senderId, $receiverId, $message);
        
        if ($messageId) {
            echo json_encode([
                'success' => true,
                'message_id' => $messageId,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send message']);
        }
    }
    
    /**
     * Get new messages via AJAX (for real-time updates)
     */
    public function getNewMessages($friendId, $lastMessageId = 0) {
        if (!Session::has('user')) {
            http_response_code(401);
            echo json_encode(['success' => false]);
            return;
        }
        
        $userId =Session::get('user_id');
        
        // Check if users are friends
        if (!$this->friendshipModel->areFriends($userId, $friendId)) {
            http_response_code(403);
            echo json_encode(['success' => false]);
            return;
        }
        
        $query = "SELECT m.*, 
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
            'last_message_id' => $lastMessageId
        ];
        
        $messages = $this->messageModel->query($query, $params)->fetchAll();
        
        // Mark new messages from friend as read
        if (!empty($messages)) {
            $this->messageModel->markAsRead($friendId, $userId);
        }
        
        echo json_encode([
            'success' => true,
            'messages' => $messages
        ]);
    }
    
    /**
     * Delete a message
     */
    public function delete($messageId) {
        if (!Session::has('user')) {
            http_response_code(401);
            echo json_encode(['success' => false]);
            return;
        }
        
        $userId =Session::get('user_id');
        $result = $this->messageModel->deleteMessage($messageId, $userId);
        
        echo json_encode(['success' => (bool)$result]);
    }
    
    /**
     * Get unread message count for current user
     */
    public function getUnreadCount() {
        if (!Session::has('user')) {
            http_response_code(401);
            echo json_encode(['success' => false]);
            return;
        }
        
        $userId =Session::get('user_id');
        $count = $this->messageModel->getUnreadCount($userId);
        
        echo json_encode([
            'success' => true,
            'count' => $count
        ]);
    }
    
    /**
     * Start conversation with a friend (from friends page)
     */
    public function startConversation($friendId) {
        if (!Session::has('user')) {
            redirect('/auth/login');
        }
        
        $userId =Session::get('user_id');
        
        // Check if users are friends
        if (!$this->friendshipModel->areFriends($userId, $friendId)) {
            $_SESSION['error_message'] = 'You can only message friends.';
            redirect('/friends');
        }
        
        // Redirect to conversation
        redirect("/messages/conversation/{$friendId}");
    }
}