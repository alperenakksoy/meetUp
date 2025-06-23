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
        $dbData['host_id'] = Session::get('user_id');
        
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
        
        // Additional validation
        if (!empty($dbData['max_attendees']) && (!is_numeric($dbData['max_attendees']) || $dbData['max_attendees'] < 1)) {
            $errors['event_max_attendees'] = 'Max attendees must be a positive number.';
        }
        
        // Validate dates
        if (!empty($dbData['event_date']) && !empty($dbData['end_date'])) {
            if (strtotime($dbData['end_date']) < strtotime($dbData['event_date'])) {
                $errors['event_end_date'] = 'End date cannot be before start date.';
            }
        }
        
        if (!empty($errors)) {
            // If there are validation errors, show the form again with errors
            loadView('events/create', [
                'errors' => $errors,
                'listing' => $_POST // Pass back the submitted data
            ]);
            return;
        }
        
        try {
            // Handle image upload BEFORE saving to database
            $uploadedImage = $this->handleImageUpload();
            
            // If image upload failed and there was an error message set, show the form again
            if (isset($_SESSION['error_message'])) {
                loadView('events/create', [
                    'errors' => ['event_image' => $_SESSION['error_message']],
                    'listing' => $_POST
                ]);
                unset($_SESSION['error_message']);
                return;
            }
            
            // Add image filename to database data if upload was successful
            if ($uploadedImage) {
                $dbData['cover_image'] = $uploadedImage;
            }
            
            // Set default status
            $dbData['status'] = 'upcoming';
            $dbData['require_approval'] = 0; // or get from form if you have this field
            
            // Create the event in the database
            $eventId = $this->eventModel->create($dbData);
            
            if ($eventId) {
                // Success! Redirect to the new event
                $_SESSION['success_message'] = 'Event created successfully!';
                redirect('/events/' . $eventId);
            } else {
                // Database error
                throw new Exception('Failed to create event in database');
            }
            
        } catch (Exception $e) {
            // Log the error and display a user-friendly message
            error_log("Event creation error: " . $e->getMessage());
            loadView('events/create', [
                'errors' => ['database' => 'There was an error creating your event. Please try again.'],
                'listing' => $_POST
            ]);
        }
    }
    
    public function show($params) {
        
        $userId = Session::get('user_id');
        $user= $this->userModel->usergetById($userId); 
        $event = $this->eventModel->getEventWithDetails($params['id']);    
      $host= $this->userModel->usergetById($event->host_id); 
      // check if the host of event same as the current user who is logged in
      $isOwner = $host->user_id == $userId;
      // get events that hosted by host
      $event->hostedEvents=$this->eventModel->getEventsByHost($event->host_id);
      $eventComments = $this->eventComment->getCommentsByEvent($event->event_id);
      $attendees = $this->attendeeModel->getAttendeesByEvent($event->event_id);
    

      
        loadView('events/show',[
            'event' => $event,
            'eventComments'=>$eventComments,
            'host' => $host,
            'attendees'=>$attendees,
            'user'=>$user,
            'isOwner'=>$isOwner
            
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
                $_SESSION['error_message'] = 'Event not found';
                redirect('/events');
                return;
            }
            
            // Check if user has permission to edit (should be the host)
            if ($event->host_id != Session::get('user_id')) {
                $_SESSION['error_message'] = 'You do not have permission to edit this event';
                redirect('/events/' . $id);
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
            
            // Process form data
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
                return;
            }
            
            try {
                // Handle image upload if a new image was provided
                $uploadedImage = $this->handleImageUpload();
                
                // If image upload failed and there was an error message set, show the form again
                if (isset($_SESSION['error_message'])) {
                    loadView('events/edit', [
                        'errors' => ['event_image' => $_SESSION['error_message']],
                        'event' => $event
                    ]);
                    unset($_SESSION['error_message']);
                    return;
                }
                
                // Add new image filename to database data if upload was successful
                if ($uploadedImage) {
                    // Delete old image if it exists
                    if (!empty($event->cover_image)) {
                        $oldImagePath = basePath('public/uploads/events/' . $event->cover_image);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $dbData['cover_image'] = $uploadedImage;
                }
                
                // Update the event
                if ($this->eventModel->update($id, $dbData)) {
                    $_SESSION['success_message'] = 'Event updated successfully';
                    redirect('/events/' . $id);
                } else {
                    throw new Exception('Failed to update event in database');
                }
                
            } catch (Exception $e) {
                error_log("Event update error: " . $e->getMessage());
                loadView('events/edit', [
                    'errors' => ['database' => 'There was an error updating your event. Please try again.'],
                    'event' => $event
                ]);
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
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedTypes)) {
        $_SESSION['error_message'] = 'Only JPEG, PNG, and WebP images are allowed.';
        return null;
    }
    
    // Validate file size (5MB max)
    if ($file['size'] > 5 * 1024 * 1024) {
        $_SESSION['error_message'] = 'Image size must be less than 5MB.';
        return null;
    }
    
    // Create upload directory if it doesn't exist
    $uploadDir = basePath('public/uploads/events/');
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            $_SESSION['error_message'] = 'Failed to create upload directory.';
            return null;
        }
    }
    
    // Generate unique filename
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = 'event_' . uniqid() . '_' . time() . '.' . $extension;
    $uploadPath = $uploadDir . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return $filename; // Return just the filename, not the full path
    }
    
    $_SESSION['error_message'] = 'Failed to upload image.';
    return null;
}
/**
 * Join an event
 */
public function joinEvent($params) {
    // Set proper headers for JSON response
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    $userId = Session::get('user_id');
    if (!$userId) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please log in to join events']);
        exit;
    }
    
    $eventId = $params['id'] ?? null;
    if (!$eventId) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid event ID']);
        exit;
    }
    
    try {
        // Check if event exists
        $event = $this->eventModel->getById($eventId);
        if (!$event) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Event not found']);
            exit;
        }
        
        // Check if user is already attending
        if ($this->attendeeModel->isUserAttending($eventId, $userId)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You are already attending this event']);
            exit;
        }
        
        // Check if event is full
        $currentAttendees = $this->attendeeModel->getAttendeesCount($eventId);
        if ($event->max_attendees && $currentAttendees >= $event->max_attendees) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Event is full']);
            exit;
        }
        
        // Check if user is the host
        if ($event->host_id == $userId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You cannot join your own event']);
            exit;
        }
        
        // Join the event
        $result = $this->attendeeModel->create([
            'event_id' => $eventId,
            'user_id' => $userId,
            'status' => 'attending'
        ]);
        
        if ($result) {
            $newAttendeeCount = $this->attendeeModel->getAttendeesCount($eventId);
            echo json_encode([
                'success' => true, 
                'message' => 'Successfully joined the event! 🎉',
                'attendee_count' => $newAttendeeCount
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to join event']);
        }
        
    } catch (Exception $e) {
        error_log("Error in joinEvent: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'An error occurred while joining']);
    }
    exit;
}

/**
 * Leave an event
 */
public function leaveEvent($params) {
    // Set proper headers for JSON response
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    $userId = Session::get('user_id');
    if (!$userId) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please log in']);
        exit;
    }
    
    $eventId = $params['id'] ?? null;
    if (!$eventId) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid event ID']);
        exit;
    }
    
    try {
        // Check if event exists
        $event = $this->eventModel->getById($eventId);
        if (!$event) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Event not found']);
            exit;
        }
        
        // Check if user is attending
        if (!$this->attendeeModel->isUserAttending($eventId, $userId)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You are not attending this event']);
            exit;
        }
        
        // Check if user is the host
        if ($event->host_id == $userId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You cannot leave your own event. Cancel it instead.']);
            exit;
        }
        
        // Leave the event
        $result = $this->attendeeModel->removeAttendee($eventId, $userId);
        
        if ($result) {
            $newAttendeeCount = $this->attendeeModel->getAttendeesCount($eventId);
            echo json_encode([
                'success' => true, 
                'message' => 'You have left the event',
                'attendee_count' => $newAttendeeCount
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to leave event']);
        }
        
    } catch (Exception $e) {
        error_log("Error in leaveEvent: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'An error occurred while leaving']);
    }
    exit;
}
}