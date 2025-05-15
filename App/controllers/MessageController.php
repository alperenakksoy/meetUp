<?php
namespace App\Controllers;

use App\Models\Message;
use App\Models\Notification; // Add this
use App\Models\User;
use Exception;
class MessageController extends BaseController {
    protected $messageModel;
    protected $notificationModel; 
    protected $userModel;
    
    public function __construct() {
        parent::__construct(); // Call parent constructor if needed
        $this->messageModel = new Message();
        $this->notificationModel = new Notification(); // Initialize the model
        $this->userModel = new User();       
    }
    public function index() {
        // Show all messages/conversations
        loadView('messages/index'); 
       }
    
    public function send() {
        // Process sending a message
    }
    
    public function conversation($params) {
        // Show a specific conversation
    }

    //Notification Counter
    public function getCount($userId) {
        if (!$userId) {
            return 0; // Return 0 if no user ID is provided
        }
        
        try {
            $notifyCount = $this->notificationModel->getUnreadCount($userId);
            return $notifyCount;
        } catch (Exception $e) {
            error_log("Error in getCount: " . $e->getMessage());
            return 0;
        }
    }
}