<?php
namespace App\Models;

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
    
    // Get past events
    public function getPastEvents($limit = 10, $offset = 0) {
        $query = "SELECT e.*, u.first_name, u.last_name, u.profile_picture 
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
    public function getEventsUserAttending($userId) {
        $query = "SELECT e.*, u.first_name, u.last_name 
                FROM {$this->table} e
                JOIN users u ON e.host_id = u.user_id
                JOIN event_attendees ea ON e.event_id = ea.event_id
                WHERE ea.user_id = :user_id
                AND ea.status IN ('attending', 'approved')
                ORDER BY e.event_date ASC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Update event status to past
    public function updateEventStatusToPast() {
        $query = "UPDATE {$this->table} SET status = 'past' WHERE event_date < CURDATE() AND status = 'upcoming'";
        return $this->db->query($query);
    }
}