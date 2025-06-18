<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Notification;
use App\Models\Friendship;
use App\Models\Review;
use App\Models\EventAttendee;
use Framework\Session;
use Exception;
use Framework\Validation;

class UserController extends BaseController {
    protected $userModel;
    protected $eventModel;
    protected $friendshipModel;
    protected $reviewModel;
    protected $eventAttendeeModel;

    protected $notificationModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->eventModel = new Event();
        $this->friendshipModel = new Friendship();
        $this->reviewModel = new Review();
        $this->eventAttendeeModel = new EventAttendee(); 
        $this->notificationModel = new Notification();

        
    }
    
    /**
     * Display user profile - can be current user or specified user
     * @param array $params - contains 'id' if viewing another user's profile
     */
    public function profile($params = []) {
        // Determine which user's profile to show
        if (isset($params['id']) && !empty($params['id'])) {
            // Show specific user's profile
            $userId = $params['id'];
            $user = $this->userModel->usergetById($userId);
            
            if (!$user) {
                $_SESSION['error_message'] = 'User not found';
                redirect('/');
                return;
            }
            
            $isOwnProfile = false;
            $currentUserId = Session::get('user_id');
            if ($currentUserId == $userId) {
                $isOwnProfile = true;
            }
        } else {
            // Show current user's profile
            $email = Session::get('user')['email'] ?? null;   
            if (!$email) {
                redirect('/login');
                return;
            }
            
            $user = $this->userModel->findByEmail($email);
            if (!$user) {
                $_SESSION['error_message'] = 'User session expired';
                redirect('/login');
                return;
            }
            
            $isOwnProfile = true;
            $userId = $user->user_id;
        }

        try {
            // Get past events where user attended
            $pastEvents = $this->eventModel->getPastEventsUserAttended($userId);
            
            // Get friends count
            $friendsCount = $this->friendshipModel->getFriendCount($userId);
            
            // Get average rating
            $avgRating = $this->reviewModel->getAverageRating($userId);
            
            // Add average rating for each past event
            foreach($pastEvents as $event) {
                $ratingData = $this->reviewModel->getEventAverageRating($event->event_id);
                $event->average_rating = $ratingData->average_rating ?? 0;
                $event->total_reviews = $ratingData->total_reviews ?? 0;
            }
            
            // Get reviews for this user
            $reviews = $this->reviewModel->getReviewsForUser($userId);
            
            // Get events hosted by this user (only if viewing own profile)
            $hostedEvents = [];
            if ($isOwnProfile) {
                $hostedEvents = $this->eventModel->getEventsByHost($userId);
            }
            
            // Get upcoming events user is attending (only if viewing own profile)
            $attendeeUpcomingEvents = [];
            if ($isOwnProfile) {
                $attendeeUpcomingEvents = $this->eventModel->getEventsUserAttending($userId);
                
                // Add attendee count to each event
                foreach($attendeeUpcomingEvents as $event) {
                    $event->attendee_count = $this->eventAttendeeModel->getAttendeesCount($event->event_id);
                }
            }
            
            // Get unreviewed events (only for own profile)
            $unreviewedEvents = [];
            if ($isOwnProfile) {
                $unreviewedEvents = $this->eventModel->getPastEventsUserAttendedWithoutReview($userId);
                
                // Process attendees for unreviewed events
                foreach($unreviewedEvents as $unreviewedEvent) {
                    $unreviewedEvent->attendees = $this->eventAttendeeModel->getAttendeesByEvent($unreviewedEvent->event_id);
                    
                    // Filter out the host and count other attendees
                    $unreviewedEvent->attendeesCount = 0;
                    foreach($unreviewedEvent->attendees as $attendee) {
                        if($attendee->user_id !== $unreviewedEvent->host_id) {
                            $unreviewedEvent->attendeesCount++;
                        }
                    }
                }
            }

            // Get user's friends
            $friends = $this->friendshipModel->getFriends($userId);
            
            // Ensure friends have proper profile pictures
            foreach($friends as $friend) {
                if (empty($friend->profile_picture) || $friend->profile_picture === 'default_profile.jpg') {
                    $friend->profile_picture = "https://ui-avatars.com/api/?name=" . 
                        urlencode($friend->first_name . '+' . $friend->last_name) . 
                        "&size=150&background=667eea&color=fff&rounded=true";
                } else if (!str_starts_with($friend->profile_picture, 'http')) {
                    $friend->profile_picture = '/uploads/profiles/' . $friend->profile_picture;
                }
            }

            // Load the view with all data
            loadView('users/profile', [
                'user' => $user,
                'friendsCount' => $friendsCount,
                'avgRating' => $avgRating,
                'pastEvents' => $pastEvents,
                'reviews' => $reviews,
                'hostedEvents' => $hostedEvents,
                'upevents' => $attendeeUpcomingEvents,
                'unreviewedEvents' => $unreviewedEvents,
                'friends' => $friends,
                'isOwnProfile' => $isOwnProfile
            ]);
            
        } catch (Exception $e) {
            error_log("Error in profile method: " . $e->getMessage());
            $_SESSION['error_message'] = 'Error loading profile data';
            redirect('/');
        }
    }
    
    /**
     * Update user profile
     * @param array $params - contains user ID
     */
    public function update($params) {
        // Check if user is logged in
        $currentUserId = Session::get('user_id');
        if (!$currentUserId) {
            redirect('/login');
            return;
        }
        
        // Check if user is updating their own profile
        $targetUserId = $params['id'] ?? $currentUserId;
        if ($currentUserId != $targetUserId) {
            $_SESSION['error_message'] = 'You can only update your own profile';
            redirect('/users/profile');
            return;
        }
        
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                try {
                    $fieldsToSanitize = [
                        'first_name', 'last_name', 'email', 'phone', 'city',
                        'country', 'occupation', 'bio', 'instagram', 'linkedin', 'facebook'
                    ];
            
                    $fieldsRaw = [
                        'date_of_birth' => null,
                        'gender' => '',
                        'languages' => '',
                        'interests' => ''
                    ];
            
                    $updateData = [];
            
                    // Sanitize string fields
                    foreach ($fieldsToSanitize as $field) {
                        $updateData[$field] = sanitize($_POST[$field] ?? '');
                    }
            
                    // Use raw (non-sanitized) or validated input for certain fields
                    foreach ($fieldsRaw as $field => $default) {
                        $updateData[$field] = $_POST[$field] ?? $default;
                    }
            
                
                // Basic validation
                $errors = [];
                
                if (empty($updateData['first_name'])) {
                    $errors[] = 'First name is required';
                }
                
                if (empty($updateData['last_name'])) {
                    $errors[] = 'Last name is required';
                }
                
                if (empty($updateData['email']) || !filter_var($updateData['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Valid email is required';
                } else {
                    // Check if email is already taken by another user
                    $existingUser = $this->userModel->findByEmail($updateData['email']);
                    if ($existingUser && $existingUser->user_id != $targetUserId) {
                        $errors[] = 'Email is already taken by another user';
                    }
                }
                
                if (!empty($errors)) {
                    $_SESSION['error_message'] = implode(', ', $errors);
                    redirect('/users/edit');
                    return;
                }
                
                // Handle profile picture upload
                if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                    $uploadResult = $this->handleProfilePictureUpload($_FILES['profile_picture'], $targetUserId);
                    if ($uploadResult['success']) {
                        $updateData['profile_picture'] = $uploadResult['filename'];
                    } else {
                        $_SESSION['error_message'] = $uploadResult['error'];
                        redirect('/users/edit');
                        return;
                    }
                }
                
                // Update user in database
                $success = $this->userModel->updateUser($targetUserId, $updateData);
                
                if ($success) {
                    // Update session data if current user updated their own profile
                    if ($currentUserId == $targetUserId) {
                        $updatedUser = $this->userModel->usergetById($targetUserId);
                        Session::set('user', [
                            'user_id' => $updatedUser->user_id,
                            'email' => $updatedUser->email,
                            'first_name' => $updatedUser->first_name,
                            'last_name' => $updatedUser->last_name
                        ]);
                    }
                    
                    $_SESSION['success_message'] = 'Profile updated successfully';
                    redirect('/users/profile');
                } else {
                    $_SESSION['error_message'] = 'Failed to update profile';
                    redirect('/users/edit');
                }
                
            } catch (Exception $e) {
                error_log("Error updating profile: " . $e->getMessage());
                $_SESSION['error_message'] = 'An error occurred while updating profile';
                redirect('/users/edit');
            }
        }
    }
    
    /**
     * Show edit profile form
     */
    public function edit() {
        $email = Session::get('user')['email'] ?? null;   
        if (!$email) {
            redirect('/login');
            return;
        }
        
        try {
            // Find the user's data with email
            $user = $this->userModel->findByEmail($email);
            if (!$user) {
                $_SESSION['error_message'] = 'User not found';
                redirect('/login');
                return;
            }
            
            loadView('users/edit', [
                'user' => $user 
            ]);
            
        } catch (Exception $e) {
            error_log("Error in edit method: " . $e->getMessage());
            $_SESSION['error_message'] = 'Error loading profile data';
            redirect('/users/profile');
        }
    }
    
    /**
     * Show friends page
     */
    public function friends() {
        $userId = Session::get('user_id');
        if (!$userId) {
            redirect('/login');
        }
    
        // Get current user data
        $currentUser = $this->userModel->usergetById($userId);
        
        // Get friends with mutual friends data
        $friends = $this->friendshipModel->getFriends($userId);
        $friendsCount = $this->friendshipModel->getFriendCount($userId);
        
        // Add mutual friends data to each friend
        foreach($friends as $friend) {
            $friend->mutualFriends = $this->friendshipModel->getMutualFriendsCount($userId, $friend->user_id);
            $friend->mutualFriendsDetails = $this->friendshipModel->getMutualFriendsSimple($userId, $friend->user_id, 3);
        }
        
        // Get pending requests received
        $pendingRequests = $this->friendshipModel->getPendingRequestsReceived($userId);
        
        // Add mutual friends count to pending requests
        foreach($pendingRequests as $request) {
            $request->mutualFriends = $this->friendshipModel->getMutualFriendsCount($userId, $request->user_id_1);
        }
        
        // Get sent requests
        $sentRequests = $this->friendshipModel->getPendingRequestsSent($userId);
        
        // Add mutual friends data to sent requests
        foreach($sentRequests as $request) {
            $request->mutualFriends = $this->friendshipModel->getMutualFriendsCount($userId, $request->user_id_2);
            $request->mutuals = $this->friendshipModel->getMutualFriendsSimple($userId, $request->user_id_2, 3);
        }
        
        // NEW: Get friend suggestions (users with 2+ mutual friends)
        $friendSuggestions = $this->friendshipModel->getFriendSuggestionsWithMutuals($userId, 2, 5);
        
        // Add mutual friends details to suggestions
        foreach($friendSuggestions as $suggestion) {
            $suggestion->mutualFriendsDetails = $this->friendshipModel->getMutualFriendsForSuggestion($userId, $suggestion->user_id, 3);
        }
    
        loadView('users/friends', [
            'friends' => $friends,
            'friendsCount' => $friendsCount,
            'pendingRequests' => $pendingRequests,
            'sentRequests' => $sentRequests,
            'friendSuggestions' => $friendSuggestions // NEW: Pass suggestions to view
        ]);
    }
    
    /**
     * Show user references/reviews
     */
    public function references() {
        $userId = Session::get('user_id') ?? null; 
        
        // If user ID doesn't exist, redirect to login page
        if (!$userId) {
            redirect('/login');
            return;
        }
        
        try {
            $user = $this->userModel->usergetById($userId);
            if (!$user) {
                $_SESSION['error_message'] = 'User not found';
                redirect('/login');
                return;
            }
            
            $reviews = $this->reviewModel->getReviewsForUser($userId);
            $ratingDistribution = $this->reviewModel->getRatingDistribution($userId);
            $averageRating = $this->reviewModel->getAverageRating($userId);

            // Initialize star counts
            $fiveStarCount = 0;
            $fourStarCount = 0;
            $threeStarCount = 0;
            $twoStarCount = 0;
            $oneStarCount = 0;
            $totalReviews = count($reviews);
            
            // Process rating distribution
            foreach ($ratingDistribution as $rating) {
                switch ($rating->rating) {
                    case 5: $fiveStarCount = $rating->count; break;
                    case 4: $fourStarCount = $rating->count; break;
                    case 3: $threeStarCount = $rating->count; break;
                    case 2: $twoStarCount = $rating->count; break;
                    case 1: $oneStarCount = $rating->count; break;
                }
            }

            // Get reviewer details
            $reviewers = [];
            foreach($reviews as $review) {
                $reviewerId = $review->reviewer_id;
                if(!isset($reviewers[$reviewerId])) {
                    $reviewers[$reviewerId] = $this->userModel->usergetById($reviewerId);
                }
            }

            loadView('users/references', [
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
            
        } catch (Exception $e) {
            error_log("Error in references method: " . $e->getMessage());
            $_SESSION['error_message'] = 'Error loading references data';
            redirect('/users/profile');
        }
    }
    
    /**
     * Show user settings page
     */
    public function settings() {
        $userId = Session::get('user_id');
        if (!$userId) {
            redirect('/login');
            return;
        }
        
        try {
            $user = $this->userModel->usergetById($userId);
            if (!$user) {
                $_SESSION['error_message'] = 'User not found';
                redirect('/login');
                return;
            }
            
            loadView('users/settings', [
                'user' => $user
            ]);
            
        } catch (Exception $e) {
            error_log("Error in settings method: " . $e->getMessage());
            $_SESSION['error_message'] = 'Error loading settings';
            redirect('/users/profile');
        }
    }
}