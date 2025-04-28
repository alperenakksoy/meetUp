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
}