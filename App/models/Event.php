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
    
    // App/models/Event.php içinde

public function getEventCompleteDetails($eventId) {
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
        e.max_attendees,
        e.require_approval,
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
        h.bio AS host_bio,
        
        -- Event Statistics
        (SELECT COUNT(*) 
         FROM event_attendees ea 
         WHERE ea.event_id = e.event_id 
         AND ea.status IN ('attending', 'approved')) AS total_attendees,
         
        (SELECT COUNT(*) 
         FROM event_attendees ea 
         WHERE ea.event_id = e.event_id 
         AND ea.status = 'pending') AS pending_requests,
         
        (SELECT AVG(rating) 
         FROM reviews r 
         WHERE r.event_id = e.event_id) AS average_rating,
         
        (SELECT COUNT(*) 
         FROM reviews r 
         WHERE r.event_id = e.event_id) AS total_reviews,
         
        (SELECT COUNT(*) 
         FROM event_comments ec 
         WHERE ec.event_id = e.event_id) AS total_comments,
         
        -- Event Tags
        GROUP_CONCAT(DISTINCT et.tag_name SEPARATOR ', ') AS event_tags

    FROM 
        {$this->table} e
    JOIN 
        users h ON e.host_id = h.user_id
    LEFT JOIN 
        event_tags et ON e.event_id = et.event_id

    WHERE 
        e.event_id = :event_id

    GROUP BY 
        e.event_id";
    
    $params = ['event_id' => $eventId];
    return $this->db->query($query, $params)->fetch();
}
    // Get events by category
    public function getEventsByCategory($category) {
        $query = "SELECT e.*, u.first_name, u.last_name 
                FROM {$this->table} e
                JOIN users u ON e.host_id = u.user_id
                WHERE e.event_id IN (
                    SELECT event_id FROM event_tags WHERE tag_name = :category
                )
                ORDER BY e.event_date ASC";
        $params = ['category' => $category];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Search events
    public function searchEvents($term) {
        $searchTerm = "%$term%";
        $query = "SELECT e.*, u.first_name, u.last_name 
                FROM {$this->table} e
                JOIN users u ON e.host_id = u.user_id
                WHERE e.title LIKE :term 
                OR e.description LIKE :term 
                OR e.location_name LIKE :term
                OR e.city LIKE :term
                OR e.country LIKE :term
                ORDER BY e.event_date ASC";
        $params = ['term' => $searchTerm];
        return $this->db->query($query, $params)->fetchAll();
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


    // App/models/Event.php içinde

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
/**
 * Get past events that user attended but hasn't reviewed yet
 * @param int $userId
 * @return array
 */
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

}