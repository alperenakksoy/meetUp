<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Friendship;
use App\Models\Review;
use App\Models\EventAttendee;
use Framework\Session;

class HomeController extends BaseController {
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
                
                // DEBUG: Add this temporary line to see how many we found
                // echo "Found " . count($recommendedEvents) . " recommended events<br>";
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
            
            // DEBUG: Uncomment these lines to debug
            // echo "User interests: " . print_r($userInterests, true) . "<br>";
            // echo "Matching categories: " . print_r($matchingCategories, true) . "<br>";
            
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
                
                // DEBUG: Uncomment to see how many events we're checking
                // echo "Total upcoming events: " . count($allUpcomingEvents) . "<br>";
                // echo "User attending: " . count($userEventIds) . "<br>";
                
                // Filter events based on matching categories
                foreach($allUpcomingEvents as $event) {
                    // Skip if user is already attending this event
                    if (!empty($userEventIds) && in_array($event->event_id, $userEventIds)) {
                        continue;
                    }
                    
                    // DEBUG: Uncomment to see event categories
                    // echo "Event: {$event->title} - Category: {$event->category}<br>";
                    
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
        
        loadView('home',[
            'user' => $user,
            'upEvents' => $upcomingEvents,
            'recommendedEvents' => $recommendedEvents
        ]);
    }
}