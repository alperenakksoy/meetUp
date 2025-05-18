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