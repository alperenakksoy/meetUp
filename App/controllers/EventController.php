<?php
namespace App\Controllers;

use Framework\Database;
use App\Models\Event;
use App\Models\EventTag;
use App\Models\UserActivity;
use Framework\Validation;

class EventController extends BaseController {
    protected $eventModel;
    public function __construct() {
        $this->eventModel = new Event();
        
        // Initialize database
        $config = require basePath('config/db.php');
        $this->db = new Database($config['database']);
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
        $allowedFields = [
            'event_title',
            'event_date',
            'event_time',
            'event_end_date',
            'event_end_time',
            'event_category',
            'event_max_attendees',
            'event_location_name',
            'event_location_address',
            'event_city',
            'event_country',
            'event_location_details',
            'event_description'
        ];
        // array_intersect_key creates new array after matches common keys in two different array 
        // AND values are same as keys in first array.
        // array flip switches roles between keys and values.
        // if [test,pro,noob]: in this array all the indexes are value BUT with array_flip, they became keys.
        // ['a' => 1, 'b' => 2, 'c' => 3]; after array_flip ----> [1  => a, 2 => b, 3 => c ]
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        $newListingData = array_map('sanitize',$newListingData);
        $newListingData['host_id'] = 1;

        $requiredFields = [
            'event_title',
            'event_date',
            'event_time',
            'event_end_date',
            'event_location_name',
            'event_max_attendees',
            'event_location_address',
            'event_city',
            'event_country',
            'event_description'
        ];

        $errors = [];

        foreach($requiredFields as $field){
         if(empty($newListingData[$field]) || !Validation::string($newListingData[$field]) ){
            $errors[$field] = ucfirst($field) . ' field is required.';
         }
        }

        if(!empty($errors)){
            loadView('events/create',[
                'errors' => $errors,
                'events' => $newListingData
            ]);
        }else{
            $fields = [];
            foreach($newListingData as $field => $value){
                $fields[] = $field;
            }
            $fields = implode(', ',$fields);

            $values = [];
            foreach($newListingData as $field => $value){
                if($value === ''){
                    $newListingData[$field] = null;
                }
                $values[] = ':'.$field;
            }
            $values = implode(', ',$values);
            $query = "INSERT INTO events ({$fields}) VALUES ({$values})";
            $this->db->query($query,$newListingData);
            inspectAndDie($query);

        }
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