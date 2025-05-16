<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Friendship;
use App\Models\Review;
use App\Models\EventAttendee;
use Framework\Session;


class UserController extends BaseController {
    protected $userModel;
    protected $eventModel;
    protected $friendshipModel;
    protected $reviewModel;
    protected $eventAttendeeModel;
    
     public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->eventModel = new Event();
        $this->friendshipModel = new Friendship();
        $this->reviewModel = new Review();
        $this->eventAttendeeModel = new EventAttendee(); 
    }
    
    public function profile($params) {
        loadView('users/profile');
    }
    
    public function update($params) {
        // Process profile update
    }
    
    public function friends() {
        loadView('users/friends');
    }
    
    public function references($params) {

        loadView('users/references');
    }
    public function settings() {
        // Check if user is logged in
      loadView('users/settings',[]);
    }

}