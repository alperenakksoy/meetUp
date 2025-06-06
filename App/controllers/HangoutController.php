<?php
// App/controllers/HangoutController.php
namespace App\Controllers;

use App\Models\Hangout;
use App\Models\HangoutAttendee;
use App\Models\User;
use Framework\Session;
use Framework\Validation;
use Exception;

class HangoutController extends BaseController {
    protected $hangoutModel;
    protected $hangoutAttendeeModel;
    protected $userModel;

    public function __construct() {
        parent::__construct();
        $this->hangoutModel = new Hangout();
        $this->hangoutAttendeeModel = new HangoutAttendee();
        $this->userModel = new User();
    }
    
    /**
     * Display all active hangouts
     */
    public function index() {
        try {
            // Get active hangouts (not expired)
            $hangouts = $this->hangoutModel->getActiveHangouts();
            
            // Add attendee information to each hangout
            foreach($hangouts as $hangout) {
                $hangout->attendees = $this->hangoutAttendeeModel->getAttendeesByHangout($hangout->hangout_id);
                $hangout->attendee_count = count($hangout->attendees);
            }
            
            loadView('hangouts/index', [
                'hangouts' => $hangouts
            ]);
        } catch (Exception $e) {
            error_log("Error in hangouts index: " . $e->getMessage());
            $_SESSION['error_message'] = 'Error loading hangouts';
            redirect('/');
        }
    }
    
    /**
     * Show hangout details
     */
    public function show($params) {
        $hangoutId = $params['id'] ?? null;
        if (!$hangoutId) {
            $_SESSION['error_message'] = 'Hangout not found';
            redirect('/hangouts');
            return;
        }
        
        try {
            $hangout = $this->hangoutModel->getHangoutWithDetails($hangoutId);
            if (!$hangout) {
                $_SESSION['error_message'] = 'Hangout not found';
                redirect('/hangouts');
                return;
            }
            
            // Get attendees
            $attendees = $this->hangoutAttendeeModel->getAttendeesByHangout($hangoutId);
            
            loadView('hangouts/show', [
                'hangout' => $hangout,
                'attendees' => $attendees
            ]);
            
        } catch (Exception $e) {
            error_log("Error showing hangout: " . $e->getMessage());
            $_SESSION['error_message'] = 'Error loading hangout';
            redirect('/hangouts');
        }
    }
    
    /**
     * Show create hangout form (optional)
     */
    public function create() {
        // Check if user is logged in
        $userId = Session::get('user_id');
        if (!$userId) {
            $_SESSION['error_message'] = 'Please log in to create hangouts';
            redirect('/login');
            return;
        }
        
        loadView('hangouts/create');
    }
    
    /**
     * Store a new hangout
     */
    
public function store() {
    // Check if user is logged in
    $userId = Session::get('user_id');
    if (!$userId) {
        $_SESSION['error_message'] = 'Please log in to create hangouts';
        redirect('/login');
        return;
    }

    // Get user's city from their profile
    $user = $this->userModel->usergetById($userId);
    if (!$user) {
        $_SESSION['error_message'] = 'User not found';
        redirect('/hangouts');
        return;
    }

    // Validate and sanitize input
    $allowedFields = [
        'activity',
        'description', 
        'when',
        'location',
        'max_people'
    ];
    
    $hangoutData = array_intersect_key($_POST, array_flip($allowedFields));
    $hangoutData = array_map('sanitize', $hangoutData);
    
    // ... existing validation code ...
    
    if (!empty($errors)) {
        $_SESSION['error_message'] = implode(', ', $errors);
        redirect('/hangouts');
        return;
    }
    
    try {
        // Calculate start time based on 'when' selection
        $startTime = $this->calculateStartTime($hangoutData['when']);
        
        // Prepare data for database - NOW INCLUDING USER'S CITY
        $dbData = [
            'host_id' => $userId,
            'activity_type' => $hangoutData['activity'],
            'description' => $hangoutData['description'],
            'location' => $hangoutData['location'],
            'city' => $user->city ?? 'Unknown', // Add user's city
            'country' => $user->country ?? 'Unknown', // Add user's country
            'start_time' => $startTime,
            'max_people' => !empty($hangoutData['max_people']) ? (int)$hangoutData['max_people'] : null,
            'status' => 'active'
        ];
        
        // Create the hangout
        $hangoutId = $this->hangoutModel->create($dbData);
        
        if ($hangoutId) {
            // Auto-join the creator to the hangout
            $this->hangoutAttendeeModel->create([
                'hangout_id' => $hangoutId,
                'user_id' => $userId,
                'status' => 'attending'
            ]);
            
            $_SESSION['success_message'] = 'Hangout created successfully! 🎉';
            redirect('/hangouts');
        } else {
            $_SESSION['error_message'] = 'Failed to create hangout';
            redirect('/hangouts');
        }
        
    } catch (Exception $e) {
        error_log("Error creating hangout: " . $e->getMessage());
        $_SESSION['error_message'] = 'An error occurred while creating the hangout';
        redirect('/hangouts');
    }
}
    
    
/**
 * Join a hangout
 */
public function join($params) {
    // Set JSON header first
    header('Content-Type: application/json');
    
    $userId = Session::get('user_id');
    if (!$userId) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please log in to join hangouts']);
        exit;
    }
    
    $hangoutId = $params['id'] ?? null;
    if (!$hangoutId) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid hangout ID']);
        exit;
    }
    
    try {
        // Check if hangout exists and is active
        $hangout = $this->hangoutModel->getById($hangoutId);
        if (!$hangout || $hangout->status !== 'active') {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Hangout not found or inactive']);
            exit;
        }
        
        // Check if user is the host
        if ($hangout->host_id == $userId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You cannot join your own hangout']);
            exit;
        }
        
        // Check if user is already attending
        if ($this->hangoutAttendeeModel->isUserAttending($hangoutId, $userId)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You are already attending this hangout']);
            exit;
        }
        
        // Check if hangout is full
        $currentAttendees = $this->hangoutAttendeeModel->getAttendeeCount($hangoutId);
        if ($hangout->max_people && $currentAttendees >= $hangout->max_people) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'This hangout is full']);
            exit;
        }
        
        // Join the hangout
        $result = $this->hangoutAttendeeModel->create([
            'hangout_id' => $hangoutId,
            'user_id' => $userId,
            'status' => 'attending'
        ]);
        
        if ($result) {
            echo json_encode([
                'success' => true, 
                'message' => 'Successfully joined the hangout! 🎉',
                'attendee_count' => $currentAttendees + 1
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to join hangout']);
        }
        
    } catch (Exception $e) {
        error_log("Error joining hangout: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'An error occurred while joining']);
    }
    exit;
}

/**
 * Leave a hangout
 */
public function leave($params) {
    // Set JSON header first
    header('Content-Type: application/json');
    
    $userId = Session::get('user_id');
    if (!$userId) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Please log in']);
        exit;
    }
    
    $hangoutId = $params['id'] ?? null;
    if (!$hangoutId) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid hangout ID']);
        exit;
    }
    
    try {
        // Check if hangout exists
        $hangout = $this->hangoutModel->getById($hangoutId);
        if (!$hangout) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Hangout not found']);
            exit;
        }
        
        // Check if user is the host
        if ($hangout->host_id == $userId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You cannot leave your own hangout. Cancel it instead.']);
            exit;
        }
        
        // Check if user is attending
        if (!$this->hangoutAttendeeModel->isUserAttending($hangoutId, $userId)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'You are not attending this hangout']);
            exit;
        }
        
        // Leave the hangout
        $result = $this->hangoutAttendeeModel->removeAttendee($hangoutId, $userId);
        
        if ($result) {
            $currentAttendees = $this->hangoutAttendeeModel->getAttendeeCount($hangoutId);
            echo json_encode([
                'success' => true, 
                'message' => 'You have left the hangout',
                'attendee_count' => $currentAttendees
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to leave hangout']);
        }
        
    } catch (Exception $e) {
        error_log("Error leaving hangout: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'An error occurred while leaving']);
    }
    exit;
}

/**
 * Delete a hangout (only by host) - Updated method
 */
public function destroy($params) {
    $userId = Session::get('user_id');
    if (!$userId) {
        $_SESSION['error_message'] = 'Please log in';
        redirect('/hangouts');
        return;
    }
    
    $hangoutId = $params['id'] ?? null;
    if (!$hangoutId) {
        $_SESSION['error_message'] = 'Invalid hangout';
        redirect('/hangouts');
        return;
    }
    
    try {
        $hangout = $this->hangoutModel->getById($hangoutId);
        if (!$hangout) {
            $_SESSION['error_message'] = 'Hangout not found';
            redirect('/hangouts/' . $hangoutId);
            return;
        }
        
        // Check if user is the host
        if ($hangout->host_id != $userId) {
            $_SESSION['error_message'] = 'You can only cancel your own hangouts';
            redirect('/hangouts/' . $hangoutId);
            return;
        }
        
        // First remove all attendees
        $this->hangoutAttendeeModel->removeAllAttendees($hangoutId);
        
        // Then delete the hangout
        $result = $this->hangoutModel->delete($hangoutId);
        
        if ($result) {
            $_SESSION['success_message'] = 'Hangout cancelled successfully';
            redirect('/hangouts');
        } else {
            $_SESSION['error_message'] = 'Failed to cancel hangout';
            redirect('/hangouts/' . $hangoutId);
        }
        
    } catch (Exception $e) {
        error_log("Error deleting hangout: " . $e->getMessage());
        $_SESSION['error_message'] = 'An error occurred while cancelling the hangout';
        redirect('/hangouts/' . $hangoutId);
    }
}
    /**
     * Get hangouts by filter (AJAX endpoint)
     */
    public function filter() {
        $category = $_GET['category'] ?? 'all';
        
        try {
            if ($category === 'all') {
                $hangouts = $this->hangoutModel->getActiveHangouts();
            } else if ($category === 'starting-soon') {
                $hangouts = $this->hangoutModel->getStartingSoonHangouts();
            } else {
                $hangouts = $this->hangoutModel->getHangoutsByCategory($category);
            }
            
            // Add attendee information
            foreach($hangouts as $hangout) {
                $hangout->attendees = $this->hangoutAttendeeModel->getAttendeesByHangout($hangout->hangout_id);
                $hangout->attendee_count = count($hangout->attendees);
            }
            
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'hangouts' => $hangouts]);
            
        } catch (Exception $e) {
            error_log("Error filtering hangouts: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Error filtering hangouts']);
        }
        exit;
    }
    
    /**
     * Search hangouts (AJAX endpoint)
     */
    public function search() {
        $searchTerm = $_GET['q'] ?? '';
        
        if (empty($searchTerm)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Search term required']);
            exit;
        }
        
        try {
            $hangouts = $this->hangoutModel->searchHangouts($searchTerm);
            
            // Add attendee information
            foreach($hangouts as $hangout) {
                $hangout->attendees = $this->hangoutAttendeeModel->getAttendeesByHangout($hangout->hangout_id);
                $hangout->attendee_count = count($hangout->attendees);
            }
            
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'hangouts' => $hangouts]);
            
        } catch (Exception $e) {
            error_log("Error searching hangouts: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Error searching hangouts']);
        }
        exit;
    }
    
    /**
     * Get nearby hangouts (AJAX endpoint)
     */
    public function nearby() {
        $location = $_GET['location'] ?? '';
        
        if (empty($location)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Location required']);
            exit;
        }
        
        try {
            $hangouts = $this->hangoutModel->getNearbyHangouts($location);
            
            // Add attendee information
            foreach($hangouts as $hangout) {
                $hangout->attendees = $this->hangoutAttendeeModel->getAttendeesByHangout($hangout->hangout_id);
                $hangout->attendee_count = count($hangout->attendees);
            }
            
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'hangouts' => $hangouts]);
            
        } catch (Exception $e) {
            error_log("Error getting nearby hangouts: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Error getting nearby hangouts']);
        }
        exit;
    }
    
    /**
     * Get starting soon hangouts (AJAX endpoint)
     */
    public function startingSoon() {
        try {
            $hangouts = $this->hangoutModel->getStartingSoonHangouts();
            
            // Add attendee information
            foreach($hangouts as $hangout) {
                $hangout->attendees = $this->hangoutAttendeeModel->getAttendeesByHangout($hangout->hangout_id);
                $hangout->attendee_count = count($hangout->attendees);
            }
            
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'hangouts' => $hangouts]);
            
        } catch (Exception $e) {
            error_log("Error getting starting soon hangouts: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Error getting starting soon hangouts']);
        }
        exit;
    }
    
    /**
     * Calculate start time based on when selection
     */
    private function calculateStartTime($when) {
        switch ($when) {
            case 'now':
                return date('Y-m-d H:i:s');
            case '30min':
                return date('Y-m-d H:i:s', strtotime('+30 minutes'));
            case '1hour':
                return date('Y-m-d H:i:s', strtotime('+1 hour'));
            default:
                return date('Y-m-d H:i:s');
        }
    }
}