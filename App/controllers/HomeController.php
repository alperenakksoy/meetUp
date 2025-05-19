<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Friendship;
use App\Models\Review;
use App\Models\EventAttendee;
use Framework\Session;

class HomeController extends BaseController {
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

    public function index() {
        // Load the homepage
    $email = Session::get('user')['email'] ?? null;
    $events = $this->eventModel->getPastEvents();

    // finding the user's data with email
    $user = $this->userModel->findByEmail($email);
    // retrieve amount of friends to display on home.view
    $friendsCount = $this->friendshipModel->getFriendCount($user->user_id);
    // retrieve average of rating to display on home.view
    $avgRating = $this->reviewModel->getAverageRating($user->user_id);

    loadView('home',[
        'user' => $user,
        'friendsCount' => $friendsCount,
        'avgRating' => $avgRating,
        'events' => $events

    ]);
    }
  

}