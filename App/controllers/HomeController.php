<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Friendship;
use App\Models\Review;
use App\Models\EventAttendee;
use Framework\Session;
use App\Models\Notification;

class HomeController extends BaseController {
    protected $userModel;
    protected $eventModel;
    protected $friendshipModel;
    protected $reviewModel;
    protected $eventAttendeeModel;
    protected $notifyModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->eventModel = new Event();
        $this->friendshipModel = new Friendship();
        $this->reviewModel = new Review();
        $this->eventAttendeeModel = new EventAttendee();
        $this->notifyModel = new Notification();
    }

    public function index() {
        $email = Session::get('user')['email'] ?? null;
        $user = $this->userModel->findByEmail($email);
        
        // Get events that user attending in upcoming events section
        $upcomingEvents = $this->eventModel->getEventsUserAttending($user->user_id);
        
        // Get upcoming event's attendees and counts by an event
        foreach($upcomingEvents as $upEvent){
            $upEvent->attendees = $this->eventAttendeeModel->getAttendeesByEvent($upEvent->event_id);
            $upEvent->counts = count($upEvent->attendees);
        }
        
        // GET RECOMMENDED EVENTS BASED ON USER INTERESTS
        $recommendedEvents = [];
        if (!empty($user->interests)) {
            // Parse user interests (handle JSON format)
            $userInterests = [];
            if (is_string($user->interests)) {
                // Handle JSON array format like ["Travel","Photography"]
                if (strpos($user->interests, '["') === 0) {
                    $userInterests = json_decode($user->interests, true) ?: [];
                } else {
                    // Handle comma-separated format
                    $userInterests = explode(',', $user->interests);
                }
            }
            
            // Clean up interests array
            $userInterests = array_map('trim', $userInterests);
            $userInterests = array_filter($userInterests, function($interest) {
                return !empty($interest) && $interest !== '""' && $interest !== '"';
            });
            $userInterests = array_map(function($interest) {
                return trim($interest, '"');
            }, $userInterests);
            
            // Comprehensive interest to event category mapping
            $interestToCategory = [
                // Technology & Computing → Technology
                'Programming' => 'tech', 'Web Development' => 'tech', 'Mobile Development' => 'tech',
                'Artificial Intelligence' => 'tech', 'Machine Learning' => 'tech', 'Data Science' => 'tech',
                'Cybersecurity' => 'tech', 'Game Development' => 'tech', 'UI/UX Design' => 'tech',
                'Software Engineering' => 'tech', 'Technology' => 'tech',
                
                // Creative Arts → Art & Music
                'Photography' => 'art', 'Digital Art' => 'art', 'Graphic Design' => 'art',
                'Video Editing' => 'art', 'Animation' => 'art', 'Drawing' => 'art', 'Painting' => 'art',
                'Music Production' => 'art', 'Writing' => 'art', 'Blogging' => 'art',
                'Creative Writing' => 'art', 'Poetry' => 'art', 'Filmmaking' => 'art',
                
                // Sports & Fitness → Sports & Outdoor
                'Running' => 'sports', 'Cycling' => 'sports', 'Swimming' => 'sports', 'Yoga' => 'sports',
                'Gym Workout' => 'sports', 'Football' => 'sports', 'Basketball' => 'sports', 'Tennis' => 'sports',
                'Hiking' => 'sports', 'Rock Climbing' => 'sports', 'Martial Arts' => 'sports',
                'Dancing' => 'sports', 'Skateboarding' => 'sports', 'Surfing' => 'sports',
                
                // Hobbies & Crafts → Art & Music (creative) or Food & Dining (cooking)
                'Cooking' => 'food', 'Baking' => 'food',
                'Gardening' => 'art', 'DIY Projects' => 'art', 'Woodworking' => 'art',
                'Knitting' => 'art', 'Sewing' => 'art', 'Pottery' => 'art',
                'Jewelry Making' => 'art', 'Model Building' => 'art', 'Origami' => 'art', 'Calligraphy' => 'art',
                
                // Entertainment & Media → Cultural
                'Movies' => 'cultural', 'TV Shows' => 'cultural', 'Anime' => 'cultural',
                'Documentary Films' => 'cultural', 'Podcasts' => 'cultural', 'Books' => 'cultural',
                'Comics' => 'cultural', 'Board Games' => 'cultural', 'Video Games' => 'cultural',
                'Streaming' => 'cultural', 'Theater' => 'cultural', 'Stand-up Comedy' => 'cultural',
                'Live Music' => 'art', 'Concerts' => 'art',
                
                // Travel & Culture → Cultural
                'Travel' => 'cultural', 'Cultural Exchange' => 'cultural', 'Language Learning' => 'language',
                'History' => 'cultural', 'Archaeology' => 'cultural', 'Museums' => 'cultural',
                'Local Culture' => 'cultural', 'Food Tourism' => 'food', 'Backpacking' => 'cultural',
                'Road Trips' => 'cultural', 'International Cuisine' => 'food',
                
                // Business & Career → Technology (networking/professional)
                'Entrepreneurship' => 'tech', 'Startup Culture' => 'tech', 'Investing' => 'tech',
                'Stock Market' => 'tech', 'Real Estate' => 'tech', 'Digital Marketing' => 'tech',
                'Social Media' => 'tech', 'Public Speaking' => 'cultural', 'Networking' => 'tech',
                'Leadership' => 'tech',
                
                // Science & Learning → Cultural
                'Astronomy' => 'cultural', 'Physics' => 'cultural', 'Chemistry' => 'cultural',
                'Biology' => 'cultural', 'Environmental Science' => 'cultural', 'Psychology' => 'cultural',
                'Philosophy' => 'cultural', 'Economics' => 'cultural', 'Politics' => 'cultural',
                'Current Events' => 'cultural', 'Research' => 'cultural', 'Online Learning' => 'cultural',
                
                // Music & Audio → Art & Music
                'Playing Guitar' => 'art', 'Playing Piano' => 'art', 'Singing' => 'art',
                'Music Theory' => 'art', 'Audio Engineering' => 'art', 'DJ-ing' => 'art',
                'Concert Going' => 'art', 'Vinyl Collecting' => 'art', 'Music Discovery' => 'art',
                'Karaoke' => 'art',
                
                // Outdoor Activities → Sports & Outdoor
                'Camping' => 'sports', 'Fishing' => 'sports', 'Hunting' => 'sports',
                'Bird Watching' => 'sports', 'Nature Photography' => 'sports', 'Geocaching' => 'sports',
                'Skiing' => 'sports', 'Snowboarding' => 'sports', 'Kayaking' => 'sports',
                'Sailing' => 'sports', 'Mountain Biking' => 'sports',
                
                // Social & Community → Cultural
                'Volunteering' => 'cultural', 'Community Service' => 'cultural', 'Mentoring' => 'cultural',
                'Event Planning' => 'cultural', 'Meetups' => 'cultural', 'Social Activism' => 'cultural',
                'Environmental Conservation' => 'cultural', 'Animal Welfare' => 'cultural',
                'Charity Work' => 'cultural',
                
                // Coffee → Coffee & Drinks
                'Coffee' => 'coffee'
            ];
            
            // Find matching categories based on user interests
            $matchingCategories = [];
            foreach($userInterests as $interest) {
                $interestTrimmed = trim($interest);
                // Direct match first (exact interest name)
                if (isset($interestToCategory[$interestTrimmed])) {
                    $matchingCategories[] = $interestToCategory[$interestTrimmed];
                }
                // Fallback: partial match for backward compatibility
                else {
                    $interestLower = strtolower($interestTrimmed);
                    foreach($interestToCategory as $key => $category) {
                        if (strpos($interestLower, strtolower($key)) !== false || strpos(strtolower($key), $interestLower) !== false) {
                            $matchingCategories[] = $category;
                            break; // Only take first match to avoid duplicates
                        }
                    }
                }
            }
            
            // Remove duplicates
            $matchingCategories = array_unique($matchingCategories);
            
            // Get recommended events if we have matching categories
            if (!empty($matchingCategories)) {
                // Get all upcoming events first
                $allUpcomingEvents = $this->eventModel->getUpcomingEvents(50); // Get more events to filter from
                
                // Get user's current event IDs to exclude them
                $userEventIds = [];
                if (!empty($upcomingEvents)) {
                    foreach($upcomingEvents as $userEvent) {
                        $userEventIds[] = $userEvent->event_id;
                    }
                }
                
                // Filter events based on matching categories
                foreach($allUpcomingEvents as $event) {
                    // Skip if user is already attending this event
                    if (!empty($userEventIds) && in_array($event->event_id, $userEventIds)) {
                        continue;
                    }
                    
                    // Check if event category matches user interests  
                    if (!empty($event->category) && in_array($event->category, $matchingCategories)) {
                        $recommendedEvents[] = $event;
                        
                        // Limit to 3 recommendations
                        if (count($recommendedEvents) >= 3) {
                            break;
                        }
                    }
                }
            }
        }
        
        // Get attendees and counts for recommended events (UPDATED SECTION)
        foreach($recommendedEvents as $recEvent){
            $recEvent->attendees = $this->eventAttendeeModel->getAttendeesByEvent($recEvent->event_id);
            $recEvent->counts = count($recEvent->attendees); // Add this line for consistency
        }
        
        // NEW: Get recent activity feed
        $recentActivity = $this->getRecentActivity(6);

        // get unread notification for user
        $unreadNotify = $this->notifyModel->getUnreadCount($user->user_id);
        
        loadView('home',[
            'user' => $user,
            'upEvents' => $upcomingEvents,
            'recommendedEvents' => $recommendedEvents,
            'recentActivity' => $recentActivity,
            'unreadNotify'=> $unreadNotify,
        ]);
    }
    
    /**
     * Get recent activity for the activity feed
     * @param int $limit Number of activities to return
     * @return array Recent activities
     */
    private function getRecentActivity($limit = 6) {
        $query = "SELECT 
            'event_created' as activity_type,
            e.created_at as activity_time,
            u.first_name,
            u.last_name,
            u.profile_picture,
            e.title as event_title,
            e.event_id,
            e.category,
            NULL as review_rating
        FROM events e
        JOIN users u ON e.host_id = u.user_id
        WHERE e.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        AND e.status = 'upcoming'
        
        UNION ALL
        
        SELECT 
            'review_posted' as activity_type,
            r.created_at as activity_time,
            u.first_name,
            u.last_name,
            u.profile_picture,
            e.title as event_title,
            e.event_id,
            e.category,
            r.rating as review_rating
        FROM reviews r
        JOIN users u ON r.reviewer_id = u.user_id
        JOIN events e ON r.event_id = e.event_id
        WHERE r.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        
        UNION ALL
        
        SELECT 
            'user_joined' as activity_type,
            u.created_at as activity_time,
            u.first_name,
            u.last_name,
            u.profile_picture,
            NULL as event_title,
            NULL as event_id,
            NULL as category,
            NULL as review_rating
        FROM users u
        WHERE u.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        AND u.is_active = 1
        
        UNION ALL
        
        SELECT 
            'event_joined' as activity_type,
            ea.joined_at as activity_time,
            u.first_name,
            u.last_name,
            u.profile_picture,
            e.title as event_title,
            e.event_id,
            e.category,
            NULL as review_rating
        FROM event_attendees ea
        JOIN users u ON ea.user_id = u.user_id
        JOIN events e ON ea.event_id = e.event_id
        WHERE ea.joined_at >= DATE_SUB(NOW(), INTERVAL 3 DAY)
        AND ea.status IN ('attending', 'approved')
        AND e.status = 'upcoming'
        
        ORDER BY activity_time DESC
        LIMIT :limit";
        
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
}