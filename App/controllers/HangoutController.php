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
        
        // Basic validation
        $errors = [];
        
        if (empty($hangoutData['activity'])) {
            $errors[] = 'Please select an activity type';
        }
        
        if (empty($hangoutData['description'])) {
            $errors[] = 'Please enter a description';
        }
        
        if (empty($hangoutData['when'])) {
            $errors[] = 'Please select when this hangout will happen';
        }
        
        if (empty($hangoutData['location'])) {
            $errors[] = 'Please enter a location';
        }
        
        if (!empty($errors)) {
            $_SESSION['error_message'] = implode(', ', $errors);
            redirect('/hangouts');
            return;
        }
        
        try {
            // Calculate start time based on 'when' selection
            $startTime = $this->calculateStartTime($hangoutData['when']);
            
            // Prepare data for database
            $dbData = [
                'host_id' => $userId,
                'activity_type' => $hangoutData['activity'],
                'description' => $hangoutData['description'],
                'location' => $hangoutData['location'],
                'city' => $user->city ?? 'Unknown',
                'country' => $user->country ?? 'Unknown',
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
     * Join a hangout - FIXED VERSION
     */
    public function join($params) {
        error_log("Join method called with params: " . print_r($params, true));
        
        // Set proper headers for JSON response
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, must-revalidate');
        
        $userId = Session::get('user_id');
        if (!$userId) {
            error_log("User not logged in for join request");
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Please log in to join hangouts']);
            exit;
        }
        
        $hangoutId = $params['id'] ?? null;
        if (!$hangoutId) {
            error_log("No hangout ID provided");
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid hangout ID']);
            exit;
        }
        
        error_log("User $userId attempting to join hangout $hangoutId");
        
        try {
            // Check if hangout exists and is active
            $hangout = $this->hangoutModel->getById($hangoutId);
            if (!$hangout) {
                error_log("Hangout $hangoutId not found");
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Hangout not found']);
                exit;
            }
            
            if ($hangout->status !== 'active') {
                error_log("Hangout $hangoutId is not active (status: {$hangout->status})");
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Hangout is not active']);
                exit;
            }
            
            // Check if user is the host
            if ($hangout->host_id == $userId) {
                error_log("User $userId cannot join their own hangout $hangoutId");
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'You cannot join your own hangout']);
                exit;
            }
            
            // Check if user is already attending
            if ($this->hangoutAttendeeModel->isUserAttending($hangoutId, $userId)) {
                error_log("User $userId already attending hangout $hangoutId");
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'You are already attending this hangout']);
                exit;
            }
            
            // Check if hangout is full
            $currentAttendees = $this->hangoutAttendeeModel->getAttendeeCount($hangoutId);
            if ($hangout->max_people && $currentAttendees >= $hangout->max_people) {
                error_log("Hangout $hangoutId is full ($currentAttendees/{$hangout->max_people})");
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
                error_log("User $userId successfully joined hangout $hangoutId");
                echo json_encode([
                    'success' => true, 
                    'message' => 'Successfully joined the hangout! 🎉',
                    'attendee_count' => $currentAttendees + 1
                ]);
            } else {
                error_log("Failed to create attendee record for user $userId in hangout $hangoutId");
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to join hangout']);
            }
            
        } catch (Exception $e) {
            error_log("Error in join method: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred while joining']);
        }
        exit;
    }

    /**
     * Leave a hangout - FIXED VERSION
     */
    public function leave($params) {
        error_log("Leave method called with params: " . print_r($params, true));
        
        // Set proper headers for JSON response
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, must-revalidate');
        
        $userId = Session::get('user_id');
        if (!$userId) {
            error_log("User not logged in for leave request");
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Please log in']);
            exit;
        }
        
        $hangoutId = $params['id'] ?? null;
        if (!$hangoutId) {
            error_log("No hangout ID provided for leave");
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid hangout ID']);
            exit;
        }
        
        error_log("User $userId attempting to leave hangout $hangoutId");
        
        try {
            // Check if hangout exists
            $hangout = $this->hangoutModel->getById($hangoutId);
            if (!$hangout) {
                error_log("Hangout $hangoutId not found for leave");
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Hangout not found']);
                exit;
            }
            
            // Check if user is the host
            if ($hangout->host_id == $userId) {
                error_log("User $userId cannot leave their own hangout $hangoutId");
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'You cannot leave your own hangout. Cancel it instead.']);
                exit;
            }
            
            // Check if user is attending
            if (!$this->hangoutAttendeeModel->isUserAttending($hangoutId, $userId)) {
                error_log("User $userId is not attending hangout $hangoutId");
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'You are not attending this hangout']);
                exit;
            }
            
            // Leave the hangout
            $result = $this->hangoutAttendeeModel->removeAttendee($hangoutId, $userId);
            
            if ($result) {
                $currentAttendees = $this->hangoutAttendeeModel->getAttendeeCount($hangoutId);
                error_log("User $userId successfully left hangout $hangoutId");
                echo json_encode([
                    'success' => true, 
                    'message' => 'You have left the hangout',
                    'attendee_count' => $currentAttendees
                ]);
            } else {
                error_log("Failed to remove user $userId from hangout $hangoutId");
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to leave hangout']);
            }
            
        } catch (Exception $e) {
            error_log("Error in leave method: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred while leaving']);
        }
        exit;
    }

    /**
     * Delete a hangout (only by host)
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
                redirect('/hangouts');
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
     * Calculate start time based on when selection
     */
    private function calculateStartTime($when) {
        switch ($when) {
            case 'now':
                return date('Y-m-d H:i:s', strtotime('+5 minutes')); // Add 5 minute buffer
            case '30min':
                return date('Y-m-d H:i:s', strtotime('+30 minutes'));
            case '1hour':
                return date('Y-m-d H:i:s', strtotime('+1 hour'));
            default:
                return date('Y-m-d H:i:s', strtotime('+5 minutes'));
        }
    }
}