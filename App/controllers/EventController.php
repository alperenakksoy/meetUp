<?php
namespace App\Controllers;

use Framework\Database;
use App\Models\Event;
use App\Models\EventTag;
use App\Models\UserActivity;
use Framework\Validation;
use Exception; 

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
        
        $newEventData = array_intersect_key($_POST, array_flip($allowedFields));
        $newEventData = array_map('sanitize', $newEventData);
    
        // Create a mapping from form field names to database column names
        $fieldMapping = [
            'event_title' => 'title',
            'event_date' => 'event_date',
            'event_time' => 'start_time',
            'event_end_date' => 'end_date',
            'event_end_time' => 'end_time',
            'event_category' => 'category',
            'event_max_attendees' => 'max_attendees',
            'event_location_name' => 'location_name',
            'event_location_address' => 'location_address',
            'event_location_details' => 'location_details',
            'event_city' => 'city',
            'event_country' => 'country',
            'event_description' => 'description'
        ];
    
        // Create a new array with properly mapped column names
        $dbData = [];
        foreach ($newEventData as $formField => $value) {
            if (isset($fieldMapping[$formField])) {
                $dbColumn = $fieldMapping[$formField];
                $dbData[$dbColumn] = $value;
            }
        }
        
        // Add the host_id - this is critical!
        $dbData['host_id'] = 1; // Or get from session if available
    
        // Validate required fields
        $requiredFields = [
            'title',
            'event_date',
            'start_time',
            'location_name',
            'location_address',
            'city',
            'country',
            'description'
        ];
    
        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($dbData[$field]) || !Validation::string($dbData[$field])) {
                $formField = array_search($field, $fieldMapping) ?: $field;
                $errors[$formField] = ucfirst(str_replace('_', ' ', $formField)) . ' field is required.';
            }
        }
    
        if (!empty($errors)) {
            loadView('events/create', [
                'errors' => $errors,
                'event' => $newEventData
            ]);
        } else {
            try {
                // Use the Event model to store the data
                $eventId = $this->eventModel->create($dbData);
                
                // Redirect to the event page
                redirect('/events/' . $eventId);
            } catch (Exception $e) {
                // Log the error and display a user-friendly message
                error_log($e->getMessage());
                $errors['database'] = 'There was an error saving your event. Please try again.';
                loadView('events/create', [
                    'errors' => $errors,
                    'event' => $newEventData
                ]);
            }
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