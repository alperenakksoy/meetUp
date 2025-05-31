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
    
    public function profile() {
    $email = Session::get('user')['email'] ?? null;   
    // finding the user's data with email
    $user = $this->userModel->findByEmail($email);
    // get past events where user attended
    $pastEvents = $this->eventModel->getPastEventsUserAttended($user->user_id);
    // retrieve amount of friends to display on home.view
    $friendsCount = $this->friendshipModel->getFriendCount($user->user_id);
    // retrieve average of rating to display on home.view
    $avgRating = $this->reviewModel->getAverageRating($user->user_id);
    // get average rating for event
    foreach($pastEvents as $event) {
        $ratingData = $this->reviewModel->getEventAverageRating($event->event_id);
        $event->average_rating = $ratingData->average_rating; // Obje içinden değeri alın
        $event->total_reviews = $ratingData->total_reviews;   // Toplam review sayısını da ekleyin
    }    // get reviews object array
    $reviews = $this->reviewModel->getReviewsForUser($user->user_id);
    // get events by host to show MY EVENTS section.
    $hostedEvents = $this->eventModel->getEventsByHost($user->user_id);
    // get events that user attending
    $attendeeUpcomingEvents = $this->eventModel->getEventsUserAttending($user->user_id);
    // get the datas for the events that user attending
    $upEventsList = [];
    foreach ($attendeeUpcomingEvents as $event) {
        $hostID = $event->host_id;
        if (!isset($upEventsList[$hostID])) {
            $host = $this->userModel->usergetById($hostID);
            $upEventsList[$hostID] = $host;
        }
    }
// Get events that user attending
$attendeeUpcomingEvents = $this->eventModel->getEventsUserAttending($user->user_id);

// Add attendee count to each event
foreach($attendeeUpcomingEvents as $event) {
    $event->attendee_count = $this->eventAttendeeModel->getAttendeesCount($event->event_id);
}
//get past events user attended but hasn't reviewed
$unreviewedEvents = $this->eventModel->getPastEventsUserAttendedWithoutReview($user->user_id);
// get atteendees for past events that hasnt reviewed yet
foreach($unreviewedEvents as $unreviewedEvent){
    $unreviewedEvent->attendees = $this->eventAttendeeModel->getAttendeesByEvent($unreviewedEvent->event_id);
}
loadView('users/profile',[
        'user' => $user,
        'friendsCount' => $friendsCount,
        'avgRating' => $avgRating,
        'pastEvents' => $pastEvents,
        'reviews' => $reviews,
        'hostedEvents' => $hostedEvents,
        'upevents' => $attendeeUpcomingEvents,
        'unreviewedEvents'=>$unreviewedEvents
    ]);
    }
  
    
    public function update($params) {
    }

    public function edit() {
        $email = Session::get('user')['email'] ?? null;   
        // finding the user's data with email
        $user = $this->userModel->findByEmail($email);
        loadView('users/edit',[
           'user'=>$user 
        ]);
    }
    
    public function friends() {
        loadView('users/friends');
    }
    
    public function references() {
    $userId = Session::get(key: 'user_id') ?? null; 
    // if userid NOT exist go back to login page
    if (!$userId) {
        redirect('/login');
        return;
    }
    $user = $this->userModel->usergetById($userId);
    $reference = $this->reviewModel->getReviewsForUser($userId);
    $reviews = $this->reviewModel->getReviewsForUser($userId);
    $ratingDistribution = $this->reviewModel->getRatingDistribution($userId);
    $averageRating = $this->reviewModel->getAverageRating($user->user_id);

        // Her yıldız için sayıları hazırla
        $fiveStarCount = 0;
        $fourStarCount = 0;
        $threeStarCount = 0;
        $twoStarCount = 0;
        $oneStarCount = 0;
        $totalReviews = count($reviews);
        
        // Derecelendirme dağılımını işle
        foreach ($ratingDistribution as $rating) {
            switch ($rating->rating) {
                case 5: $fiveStarCount = $rating->count; break;
                case 4: $fourStarCount = $rating->count; break;
                case 3: $threeStarCount = $rating->count; break;
                case 2: $twoStarCount = $rating->count; break;
                case 1: $oneStarCount = $rating->count; break;
            }
        }

     // Yorumcuların detaylarını al
     $reviewers = [];
     foreach($reviews as $review){
         $reviewerId = $review->reviewer_id;
         if(!isset($reviewers[$reviewerId])){
             $reviewers[$reviewerId] = $this->userModel->usergetById($reviewerId);
         }
     }

    loadView('users/references',[
            'reference' => $reference,
            'reviews' => $reviews,
            'user' => $user,
            'reviewer' => $reviewers,
            'averageRating' => $averageRating,
        'totalReviews' => $totalReviews,
        'fiveStarCount' => $fiveStarCount,
        'fourStarCount' => $fourStarCount,
        'threeStarCount' => $threeStarCount,
        'twoStarCount' => $twoStarCount,
        'oneStarCount' => $oneStarCount
        ]);
    }
    public function settings() {
        // Check if user is logged in
      loadView('users/settings',[]);
    }

}