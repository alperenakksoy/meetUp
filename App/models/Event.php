<?php
namespace App\Models;
use Framework\Validation;

class Event extends BaseModel {
    protected $table = 'events';
    
    // Get upcoming events
    public function getUpcomingEvents($limit = 10) {
        $limit = (int)$limit;
        
        $query = "SELECT e.*, u.first_name, u.last_name, u.profile_picture,
                  (SELECT COUNT(*) FROM event_attendees WHERE event_id = e.event_id 
                   AND status IN ('attending', 'approved')) as attendee_count
                  FROM {$this->table} e
                  JOIN users u ON e.host_id = u.user_id
                  WHERE e.event_date >= CURDATE() 
                  AND e.status = 'upcoming'
                  ORDER BY e.event_date ASC
                  LIMIT {$limit}";
        
        return $this->db->query($query)->fetchAll();
    }

    /**
     * Get recommended events based on user interests
     * @param int $userId
     * @param int $limit
     * @return array
     */
    public function getRecommendedEvents($userId, $limit = 5) {
        // First, get user's interests
        $userQuery = "SELECT interests FROM users WHERE user_id = :user_id";
        $userResult = $this->db->query($userQuery, ['user_id' => $userId])->fetch();
        
        if (!$userResult || empty($userResult->interests)) {
            // If user has no interests, return random upcoming events
            return $this->getUpcomingEvents($limit);
        }
        
        // Parse user interests (handle JSON or comma-separated format)
        $userInterests = [];
        if (is_string($userResult->interests)) {
            // Try to decode as JSON first
            $decodedInterests = json_decode($userResult->interests, true);
            if (is_array($decodedInterests)) {
                $userInterests = $decodedInterests;
            } else {
                // Fall back to comma-separated
                $userInterests = array_map('trim', explode(',', $userResult->interests));
            }
        }
        
        if (empty($userInterests)) {
            return $this->getUpcomingEvents($limit);
        }
        
        // Create mapping of interests to event categories
        $interestToCategoryMap = $this->getInterestToCategoryMapping();
        
        // Find matching categories for user interests
        $matchingCategories = [];
        foreach ($userInterests as $interest) {
            $interest = strtolower(trim($interest, '"'));
            if (isset($interestToCategoryMap[$interest])) {
                $matchingCategories = array_merge($matchingCategories, $interestToCategoryMap[$interest]);
            }
        }
        
        // Remove duplicates
        $matchingCategories = array_unique($matchingCategories);
        
        if (empty($matchingCategories)) {
            return $this->getUpcomingEvents($limit);
        }
        
        // Build query for events matching user interests
        $placeholders = str_repeat('?,', count($matchingCategories) - 1) . '?';
        
        $query = "SELECT e.*, u.first_name, u.last_name, u.profile_picture,
                  (SELECT COUNT(*) FROM event_attendees WHERE event_id = e.event_id 
                   AND status IN ('attending', 'approved')) as attendee_count,
                  CASE 
                    WHEN e.category IN ($placeholders) THEN 1 
                    ELSE 0 
                  END as relevance_score
                  FROM {$this->table} e
                  JOIN users u ON e.host_id = u.user_id
                  WHERE e.event_date >= CURDATE() 
                  AND e.status = 'upcoming'
                  AND e.host_id != :user_id
                  AND e.event_id NOT IN (
                    SELECT event_id FROM event_attendees 
                    WHERE user_id = :user_id_2
                  )
                  ORDER BY relevance_score DESC, e.event_date ASC
                  LIMIT :limit";
        
        $params = array_merge($matchingCategories, [
            'user_id' => $userId,
            'user_id_2' => $userId,
            'limit' => $limit
        ]);
        
        return $this->db->query($query, $params)->fetchAll();
    }
    
    /**
     * Create mapping between user interests and event categories
     * @return array
     */
    private function getInterestToCategoryMapping() {
        return [
            // Coffee & Drinks category
            'coffee' => ['coffee'],
            'drinks' => ['coffee'],
            'cafe' => ['coffee'],
            'barista' => ['coffee'],
            'brewing' => ['coffee'],
            'wine tasting' => ['coffee'],
            'cocktails' => ['coffee'],
            
            // Cultural category
            'culture' => ['cultural'],
            'cultural' => ['cultural'],
            'history' => ['cultural'],
            'museums' => ['cultural'],
            'art' => ['cultural', 'art'],
            'heritage' => ['cultural'],
            'traditions' => ['cultural'],
            'archaeology' => ['cultural'],
            'local culture' => ['cultural'],
            'cultural exchange' => ['cultural'],
            
            // Sports & Outdoor category
            'sports' => ['sports'],
            'outdoor' => ['sports'],
            'hiking' => ['sports'],
            'running' => ['sports'],
            'cycling' => ['sports'],
            'swimming' => ['sports'],
            'yoga' => ['sports'],
            'fitness' => ['sports'],
            'gym workout' => ['sports'],
            'football' => ['sports'],
            'basketball' => ['sports'],
            'tennis' => ['sports'],
            'rock climbing' => ['sports'],
            'martial arts' => ['sports'],
            'dancing' => ['sports', 'art'],
            'skateboarding' => ['sports'],
            'surfing' => ['sports'],
            'skiing' => ['sports'],
            'snowboarding' => ['sports'],
            'kayaking' => ['sports'],
            'sailing' => ['sports'],
            'mountain biking' => ['sports'],
            'camping' => ['sports'],
            'fishing' => ['sports'],
            'nature' => ['sports'],
            
            // Language Exchange category
            'language' => ['language'],
            'languages' => ['language'],
            'language exchange' => ['language'],
            'language learning' => ['language'],
            'linguistics' => ['language'],
            'education' => ['language'],
            'teaching' => ['language'],
            
            // Food & Dining category
            'food' => ['food'],
            'cooking' => ['food'],
            'culinary' => ['food'],
            'baking' => ['food'],
            'cuisine' => ['food'],
            'restaurant' => ['food'],
            'dining' => ['food'],
            'culinary arts' => ['food'],
            'food tourism' => ['food'],
            'international cuisine' => ['food'],
            'street food' => ['food'],
            'wine' => ['food'],
            'food tours' => ['food'],
            'spice trading' => ['food'],
            'traditional cooking' => ['food'],
            
            // Art & Music category
            'music' => ['art'],
            'art' => ['art', 'cultural'],
            'photography' => ['art'],
            'painting' => ['art'],
            'drawing' => ['art'],
            'creative arts' => ['art'],
            'digital art' => ['art'],
            'graphic design' => ['art'],
            'video editing' => ['art'],
            'animation' => ['art'],
            'music production' => ['art'],
            'writing' => ['art'],
            'creative writing' => ['art'],
            'poetry' => ['art'],
            'filmmaking' => ['art'],
            'theater' => ['art'],
            'concerts' => ['art'],
            'exhibitions' => ['art'],
            'galleries' => ['art'],
            'vintage fashion' => ['art'],
            'design' => ['art'],
            'calligraphy' => ['art'],
            'pottery' => ['art'],
            'jewelry making' => ['art'],
            'jazz music' => ['art'],
            'art therapy' => ['art'],
            
            // Technology category
            'technology' => ['tech'],
            'tech' => ['tech'],
            'programming' => ['tech'],
            'coding' => ['tech'],
            'software development' => ['tech'],
            'web development' => ['tech'],
            'mobile development' => ['tech'],
            'artificial intelligence' => ['tech'],
            'machine learning' => ['tech'],
            'data science' => ['tech'],
            'cybersecurity' => ['tech'],
            'game development' => ['tech'],
            'ui/ux design' => ['tech'],
            'software engineering' => ['tech'],
            'startup' => ['tech'],
            'innovation' => ['tech'],
            'fintech' => ['tech'],
            'digital marketing' => ['tech'],
            'social media' => ['tech'],
            'networking' => ['tech'],
            'entrepreneurship' => ['tech'],
            
            // Other mappings
            'travel' => ['cultural', 'sports'],
            'photography' => ['art', 'cultural'],
            'networking' => ['tech', 'coffee'],
            'socializing' => ['coffee', 'language'],
            'volunteering' => ['cultural'],
            'community service' => ['cultural'],
            'environmental' => ['sports', 'cultural'],
            'sustainability' => ['cultural', 'sports'],
            'meditation' => ['sports', 'cultural'],
            'wellness' => ['sports'],
            'mindfulness' => ['cultural', 'sports']
        ];
    }
    public function getFilteredEvents($filters) {
        $query = "SELECT * FROM events WHERE status = 'upcoming'";
        
        if ($filters['location']) {
            $query .= " AND city = :location";
        }
    }
    /**
     * Get events by category with better filtering
     * @param string $category
     * @param int $limit
     * @param int $excludeUserId - exclude events user is already attending
     * @return array
     */
    public function getEventsByCategory($category, $limit = 10, $excludeUserId = null) {
        $query = "SELECT e.*, u.first_name, u.last_name, u.profile_picture,
                  (SELECT COUNT(*) FROM event_attendees WHERE event_id = e.event_id 
                   AND status IN ('attending', 'approved')) as attendee_count
                  FROM {$this->table} e
                  JOIN users u ON e.host_id = u.user_id
                  WHERE e.category = :category
                  AND e.event_date >= CURDATE() 
                  AND e.status = 'upcoming'";
        
        $params = ['category' => $category];
        
        if ($excludeUserId) {
            $query .= " AND e.host_id != :exclude_user_id
                       AND e.event_id NOT IN (
                         SELECT event_id FROM event_attendees 
                         WHERE user_id = :exclude_user_id_2
                       )";
            $params['exclude_user_id'] = $excludeUserId;
            $params['exclude_user_id_2'] = $excludeUserId;
        }
        
        $query .= " ORDER BY e.event_date ASC LIMIT :limit";
        $params['limit'] = $limit;
        
        return $this->db->query($query, $params)->fetchAll();
    }

    // App/models/Event.php içinde

public function getPastEventsUserAttended($userId) {
    $query = "SELECT e.*, u.first_name, u.last_name, u.profile_picture 
              FROM {$this->table} e
              JOIN users u ON e.host_id = u.user_id
              JOIN event_attendees ea ON e.event_id = ea.event_id
              WHERE ea.user_id = :user_id
              AND ea.status IN ('attending', 'approved')
              AND (e.event_date < CURDATE() OR e.status = 'past')
              ORDER BY e.event_date DESC";
    
    $params = ['user_id' => $userId];
    return $this->db->query($query, $params)->fetchAll();
}
    
    // Get past events
    public function getPastEvents($limit = 10, $offset = 0) {
        $query = "SELECT e.*, u.first_name, u.last_name, u.profile_picture,
                (SELECT COUNT(*) FROM event_attendees WHERE event_id = e.event_id 
                 AND status IN ('attending', 'approved')) as attendee_count,
                (SELECT COUNT(*) FROM reviews WHERE event_id = e.event_id) as review_count,
                (SELECT AVG(rating) FROM reviews WHERE event_id = e.event_id) as average_rating
                FROM {$this->table} e
                JOIN users u ON e.host_id = u.user_id
                WHERE e.event_date < CURDATE() 
                OR e.status = 'past'
                ORDER BY e.event_date DESC
                LIMIT :limit OFFSET :offset";
        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get events by host
    public function getEventsByHost($hostId) {
        $query = "SELECT * FROM {$this->table} WHERE host_id = :host_id ORDER BY event_date DESC";
        $params = ['host_id' => $hostId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get event with details
    public function getEventWithDetails($eventId) {
        $query = "SELECT e.*, u.first_name, u.last_name, u.profile_picture,
                (SELECT COUNT(*) FROM event_attendees WHERE event_id = e.event_id AND status IN ('attending', 'approved')) as attendee_count
                FROM {$this->table} e
                JOIN users u ON e.host_id = u.user_id
                WHERE e.event_id = :event_id";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetch();
    }
    
    // Get events a user is attending
    public function getEventsUserAttending($userId,$limit=5) {
        $query = "SELECT e.*, u.first_name, u.last_name 
                FROM {$this->table} e
                JOIN users u ON e.host_id = u.user_id
                JOIN event_attendees ea ON e.event_id = ea.event_id
                WHERE ea.user_id = :user_id
                AND ea.status IN ('attending', 'approved')
                ORDER BY e.event_date ASC
                LIMIT {$limit}";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Update event status to past
    public function updateEventStatusToPast() {
        $query = "UPDATE {$this->table} SET status = 'past' WHERE event_date < CURDATE() AND status = 'upcoming'";
        return $this->db->query($query);
    }

    // Get reviews for an event
    public function getEventReviews($eventId) {
        $query = "SELECT r.*, 
                u_reviewer.first_name as reviewer_first_name, 
                u_reviewer.last_name as reviewer_last_name,
                u_reviewer.profile_picture as reviewer_profile_picture,
                u_reviewer.city as reviewer_city,
                u_reviewer.country as reviewer_country,
                u_reviewed.first_name as reviewed_first_name,
                u_reviewed.last_name as reviewed_last_name
                FROM reviews r
                JOIN users u_reviewer ON r.reviewer_id = u_reviewer.user_id
                JOIN users u_reviewed ON r.reviewed_id = u_reviewed.user_id
                WHERE r.event_id = :event_id
                ORDER BY r.created_at DESC";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetchAll();
    }

    // Get past events with details
    public function getPastEventsUserAttendedWithDetails($userId) {
        $query = "SELECT 
            -- Event Details
            e.event_id,
            e.title AS event_title,
            e.description,
            e.location_name,
            e.location_address,
            e.location_details,
            e.city,
            e.country,
            e.event_date,
            e.start_time,
            e.end_time,
            e.end_date,
            e.cover_image,
            e.category,
            e.status AS event_status,
            e.created_at AS event_created_at,
            
            -- Host Details
            h.user_id AS host_id,
            CONCAT(h.first_name, ' ', h.last_name) AS host_name,
            h.first_name AS host_first_name,
            h.last_name AS host_last_name,
            h.profile_picture AS host_profile_picture,
            h.city AS host_city,
            h.country AS host_country,
            
            -- User's Attendance Details
            ea.status AS attendance_status,
            ea.joined_at AS registration_date,
            
            -- Event Statistics
            (SELECT COUNT(*) 
             FROM event_attendees ea2 
             WHERE ea2.event_id = e.event_id 
             AND ea2.status IN ('attending', 'approved')) AS total_attendees,
             
            (SELECT AVG(rating) 
             FROM reviews r 
             WHERE r.event_id = e.event_id) AS average_rating,
             
            (SELECT COUNT(*) 
             FROM reviews r 
             WHERE r.event_id = e.event_id) AS total_reviews,
             
            -- User's Review (if exists)
            ur.rating AS user_rating,
            ur.content AS user_review,
            ur.created_at AS review_date,
            
            -- Event Tags
            GROUP_CONCAT(et.tag_name SEPARATOR ', ') AS event_tags

        FROM 
            event_attendees ea
        JOIN 
            {$this->table} e ON ea.event_id = e.event_id
        JOIN 
            users h ON e.host_id = h.user_id
        LEFT JOIN 
            reviews ur ON e.event_id = ur.event_id AND ur.reviewer_id = ea.user_id
        LEFT JOIN 
            event_tags et ON e.event_id = et.event_id

        WHERE 
            ea.user_id = :user_id
            AND ea.status IN ('attending', 'approved')
            AND (e.event_date < CURDATE() OR e.status = 'past')

        GROUP BY 
            e.event_id, ea.attendee_id, ur.review_id

        ORDER BY 
            e.event_date DESC";
        
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }

    // Get past events without review
    public function getPastEventsUserAttendedWithoutReview($userId) {
        $query = "SELECT 
            -- Event Details
            e.event_id,
            e.title AS event_title,
            e.description,
            e.location_name,
            e.location_address,
            e.location_details,
            e.city,
            e.country,
            e.event_date,
            e.start_time,
            e.end_time,
            e.end_date,
            e.cover_image,
            e.category,
            e.status AS event_status,
            e.created_at AS event_created_at,
            
            -- Host Details
            h.user_id AS host_id,
            CONCAT(h.first_name, ' ', h.last_name) AS host_name,
            h.first_name AS host_first_name,
            h.last_name AS host_last_name,
            h.profile_picture AS host_profile_picture,
            h.city AS host_city,
            h.country AS host_country,
            
            -- User's Attendance Details
            ea.status AS attendance_status,
            ea.joined_at AS registration_date,
            
            -- Event Statistics
            (SELECT COUNT(*) 
             FROM event_attendees ea2 
             WHERE ea2.event_id = e.event_id 
             AND ea2.status IN ('attending', 'approved')) AS total_attendees,
             
            (SELECT AVG(rating) 
             FROM reviews r 
             WHERE r.event_id = e.event_id) AS average_rating,
             
            (SELECT COUNT(*) 
             FROM reviews r 
             WHERE r.event_id = e.event_id) AS total_reviews

        FROM 
            event_attendees ea
        JOIN 
            {$this->table} e ON ea.event_id = e.event_id
        JOIN 
            users h ON e.host_id = h.user_id
        LEFT JOIN 
            reviews ur ON e.event_id = ur.event_id AND ur.reviewer_id = ea.user_id

        WHERE 
            ea.user_id = :user_id
            AND ea.status IN ('attending', 'approved')
            AND (e.event_date < CURDATE() OR e.status = 'past')
            AND ur.review_id IS NULL  -- This ensures no review exists

        ORDER BY 
            e.event_date DESC";
        
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }

    // Add a validation method to your model
    public function validate($data, $requiredFields) {
        $errors = [];
        
        foreach($requiredFields as $field) {
            if(empty($data[$field]) || !Validation::string($data[$field])) {
                $errors[$field] = ucfirst($field) . ' field is required.';
            }
        }
        
        return $errors;
    }
    
}