<?php
namespace App\Models;

class EventAttendee extends BaseModel {
    protected $table = 'event_attendees';
    
    // Get attendees for an event
    public function getAttendeesByEvent($eventId) {
        $query = "SELECT ea.*, u.first_name, u.last_name, u.profile_picture 
                FROM {$this->table} ea
                JOIN users u ON ea.user_id = u.user_id
                WHERE ea.event_id = :event_id
                ORDER BY ea.joined_at ASC";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get pending requests for an event
    public function getPendingRequests($eventId) {
        $query = "SELECT ea.*, u.first_name, u.last_name, u.profile_picture 
                FROM {$this->table} ea
                JOIN users u ON ea.user_id = u.user_id
                WHERE ea.event_id = :event_id AND ea.status = 'pending'
                ORDER BY ea.joined_at ASC";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Approve attendance request
    public function approveRequest($attendeeId) {
        $query = "UPDATE {$this->table} SET status = 'approved' WHERE attendee_id = :attendee_id";
        $params = ['attendee_id' => $attendeeId];
        return $this->db->query($query, $params);
    }
    
    // Decline attendance request
    public function declineRequest($attendeeId) {
        $query = "UPDATE {$this->table} SET status = 'declined' WHERE attendee_id = :attendee_id";
        $params = ['attendee_id' => $attendeeId];
        return $this->db->query($query, $params);
    }
    
    // Check if user is attending event
    public function isUserAttending($eventId, $userId) {
        $query = "SELECT * FROM {$this->table} 
                WHERE event_id = :event_id AND user_id = :user_id 
                AND status IN ('attending', 'approved')";
        $params = [
            'event_id' => $eventId,
            'user_id' => $userId
        ];
        return $this->db->query($query, $params)->fetch() ? true : false;
    }
    
    // Get events a user has pending requests for
    public function getUserPendingRequests($userId) {
        $query = "SELECT ea.*, e.title, e.event_date, e.location_name
                FROM {$this->table} ea
                JOIN events e ON ea.event_id = e.event_id
                WHERE ea.user_id = :user_id AND ea.status = 'pending'
                ORDER BY e.event_date ASC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get count of attendees for an event
    public function getAttendeesCount($eventId) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
                WHERE event_id = :event_id AND status IN ('attending', 'approved')";
        $params = ['event_id' => $eventId];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count;
    }


/**
 * Remove attendee from event
 */
public function removeAttendee($eventId, $userId) {
    $query = "DELETE FROM {$this->table}
              WHERE event_id = :event_id AND user_id = :user_id";
    
    $params = [
        'event_id' => $eventId,
        'user_id' => $userId
    ];
    
    return $this->db->query($query, $params);
}

/**
 * Get events a user is attending (upcoming)
 */
public function getUserUpcomingEvents($userId, $limit = 10) {
    $query = "SELECT ea.*, e.title, e.event_date, e.start_time, e.location_name,
                     u.first_name as host_first_name, u.last_name as host_last_name
              FROM {$this->table} ea
              JOIN events e ON ea.event_id = e.event_id
              JOIN users u ON e.host_id = u.user_id
              WHERE ea.user_id = :user_id
              AND ea.status IN ('attending', 'approved')
              AND e.event_date >= CURDATE()
              AND e.status = 'upcoming'
              ORDER BY e.event_date ASC
              LIMIT :limit";
    
    $params = [
        'user_id' => $userId,
        'limit' => $limit
    ];
    
    return $this->db->query($query, $params)->fetchAll();
}

/**
 * Check if event is at capacity
 */
public function isEventFull($eventId) {
    // First get max_attendees for the event
    $eventQuery = "SELECT max_attendees FROM events WHERE event_id = :event_id";
    $eventResult = $this->db->query($eventQuery, ['event_id' => $eventId])->fetch();
    
    if (!$eventResult || !$eventResult->max_attendees) {
        return false; // No limit set
    }
    
    $currentCount = $this->getAttendeesCount($eventId);
    return $currentCount >= $eventResult->max_attendees;
}

/**
 * Join event with status (for events requiring approval)
 */
public function joinEvent($eventId, $userId, $requiresApproval = false) {
    $status = $requiresApproval ? 'pending' : 'attending';
    
    $data = [
        'event_id' => $eventId,
        'user_id' => $userId,
        'status' => $status,
        'joined_at' => date('Y-m-d H:i:s')
    ];
    
    return $this->create($data);
}
}