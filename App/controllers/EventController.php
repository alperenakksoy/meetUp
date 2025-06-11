<?php
namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventTag;
use App\Models\EventComment;
use App\Models\UserActivity;
use App\Models\BaseModel;
use App\Models\EventAttendee;
use App\Models\User;
use Framework\Validation;
use Exception; 


class EventController extends BaseController {
    protected $eventModel;
    protected $eventCategory;
    protected $eventComment;
    protected $baseModel;
    protected $attendeeModel;
    protected $userModel;

    public function __construct() {
        $this->eventModel = new Event(); 
        $this->eventCategory = new EventCategory();
        $this->eventComment = new EventComment();
        $this->baseModel = new BaseModel(); 
        $this->attendeeModel = new EventAttendee();
        $this->userModel = new User(); 
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
        $userId = Session::get('user_id');

        $user= $this->userModel->usergetById($userId); 
        $event = $this->eventModel->getEventWithDetails($params['id']);    
      $host= $this->userModel->usergetById($event->host_id); 
      // get events that hosted by host
      $event->hostedEvents=$this->eventModel->getEventsByHost($event->host_id);
      $eventComments = $this->eventComment->getCommentsByEvent($event->event_id);
      $attendees = $this->attendeeModel->getAttendeesByEvent($event->event_id);
      
      
      
        loadView('events/show',[
            'event' => $event,
            'eventComments'=>$eventComments,
            'host' => $host,
            'attendees'=>$attendees,
            'user'=>$user
            
        ]);
    }

    
    
    public function edit($params) {

            $id = $params['id'];
            
            // Get event by ID
            $event = $this->eventModel->getById($id);
            
            if (!$event) {
                // Event not found
                $_SESSION['error_message'] = 'Event not found';
                redirect('/events');
                return;
            }

            loadView('events/edit', [
                'event' => $event
            ]);
        
        }
    
        public function update($params) {
            $id = $params['id'];
            
            // First check if event exists
            $event = $this->eventModel->getById($id);
            
            if (!$event) {
                // Event not found
                $_SESSION['error_message'] = 'Event not found';
                redirect('/events');
                return;
            }
            
            // Define allowed fields
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
            
            // Process form data similar to store method
            $updateEventData = array_intersect_key($_POST, array_flip($allowedFields));
            $updateEventData = array_map('sanitize', $updateEventData);
            
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
            foreach ($updateEventData as $formField => $value) {
                if (isset($fieldMapping[$formField])) {
                    $dbColumn = $fieldMapping[$formField];
                    $dbData[$dbColumn] = $value;
                }
            }
            
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
                loadView('events/edit', [
                    'errors' => $errors,
                    'event' => $event
                ]);
            } else {
                try {
                    // Handle image upload if needed
                    
                    // Update the event
                    if ($this->eventModel->update($id, $dbData)) {
                        // Success
                        $_SESSION['success_message'] = 'Event updated successfully';
                        redirect('/events/' . $id);
                    } else {
                        // Failed
                        $errors['database'] = 'Failed to update event';
                        loadView('events/edit', [
                            'errors' => $errors,
                            'event' => $event
                        ]);
                    }
                } catch (Exception $e) {
                    // Log the error and display a user-friendly message
                    error_log($e->getMessage());
                    $errors['database'] = 'There was an error updating your event. Please try again.';
                    loadView('events/edit', [
                        'errors' => $errors,
                        'event' => $event
                    ]);
                }
            }
        }
    
    public function destroy($params) {
        $id = $params['id'];
        
        // Get the event to check if it exists
        $event = $this->eventModel->getById($id);
        
        if (!$event) {
            // Event not found
            $_SESSION['error_message'] = 'Event not found';
            redirect('/events');
            return;
        }
        
        // Check if user has permission to delete (e.g., is the host or admin)
        // For now, we'll skip this check, but in a real application, you should add it
        
        // Delete the event
        if ($this->eventModel->delete($id)) {
            // Success
            $_SESSION['success_message'] = 'Event deleted successfully';
        } else {
            // Failed
            $_SESSION['error_message'] = 'Failed to delete event';
        }
        
        // Redirect to events list
        redirect('/events');
    }
    
    public function pastEvents() {
        $events = $this->eventModel->getPastEvents();
        loadView('events/past',[
            'events' => $events
        ]);
    }
    
    public function reviews($params) {
        
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
    }

    
    public function management() {
        loadView('events/management');
}
private function handleImageUpload() {
    // Check if no file was uploaded or if there was an error
    if (!isset($_FILES['event_image']) || $_FILES['event_image']['error'] === UPLOAD_ERR_NO_FILE) {
        // No file uploaded - this is okay, we'll use default image
        return null;
    }
    
    // Check for other upload errors
    if ($_FILES['event_image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error_message'] = 'There was an error uploading the image.';
        return null;
    }
    
    $file = $_FILES['event_image'];
    
    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
    if (!in_array($file['type'], $allowedTypes)) {
        $_SESSION['error_message'] = 'Only JPEG, PNG, and WebP images are allowed.';
        return null;
    }
    
    // Validate file size (5MB max)
    if ($file['size'] > 5 * 1024 * 1024) {
        $_SESSION['error_message'] = 'Image size must be less than 5MB.';
        return null;
    }
    
    // Create upload directory if it doesn't exist
    $uploadDir = 'uploads/events/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('event_') . '.' . $extension;
    $uploadPath = $uploadDir . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return $filename; // Return just the filename, not the full path
    }
    
    $_SESSION['error_message'] = 'Failed to upload image.';
    return null;
}
}