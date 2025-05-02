<?php
namespace App\Controllers;

use App\Models\Event;
use App\Models\EventTag;
use App\Models\UserActivity;

class EventController extends BaseController {
    protected $eventModel;
    
    public function __construct() {
        $this->eventModel = new Event();

    }
    
    public function index() {
        // Get upcoming events from the model
        $events = $this->eventModel->getUpcomingEvents();
        
        // Load view and pass events data to it
        loadView('events/index', [
            'events' => $events
        ]);
    }
    
    public function create() {
        loadView('events/create');

    }
    
    public function store() {
      
    }
    
    public function show($params) {
      $event = $this->eventModel->getEventWithDetails($params['id']);

        loadView('events/show',[
            'event' => $event
        ]);
    }
    
    public function edit($params) {
        // Show event edit form
    }
    
    public function update($params) {
        // Process event update
    }
    
    public function destroy($params) {
        // Delete event
    }
    
    public function pastEvents() {
        $events = $this->eventModel->getPastEvents();
        loadView('events/past',[
            'events' => $events
        ]);
    }
    
    public function reviews($params) {
<<<<<<< HEAD
        $event = $this->eventModel->getEventWithDetails($params['id']);
        loadView('events/reviews',[
            'event' => $event
        ]);
=======
        
        $event = $this->eventModel->getEventWithDetails($params['id']);
        $reviews = $this->eventModel->getEventReviews($params['id']);
          // Calculate statistics
    $totalReviews = count($reviews);
    $averageRating = 0;
    $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    
    if($totalReviews > 0) {
        $totalRating = 0;
        foreach($reviews as $review) {
            $totalRating += $review->rating;
            $ratingCounts[$review->rating]++;
        }
        $averageRating = $totalRating / $totalReviews;
    }

    loadView('events/reviews',[
        'event' => $event,
        'reviews'=> $reviews,
        'totalReviews' => $totalReviews,
        'averageRating' => $averageRating,
        'ratingCounts' => $ratingCounts
    ]);
>>>>>>> 3b2d076 (updated)
    }
    
    public function management() {
        // Show event management page
    }
}