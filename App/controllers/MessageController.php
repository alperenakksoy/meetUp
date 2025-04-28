<?php
namespace App\Controllers;

use App\Models\Message;

class MessageController extends BaseController {
    protected $messageModel;
    
    public function __construct() {
        // $this->messageModel = new Message();
       
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
}