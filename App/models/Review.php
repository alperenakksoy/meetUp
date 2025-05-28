<?php
namespace App\Models;

class Review extends BaseModel {
    protected $table = 'reviews';

    
    
    // Get reviews for a user
    public function getReviewsForUser($userId, $limit = 10, $offset = 0) {
        $query = "SELECT r.*, 
                u.first_name as reviewer_first_name, 
                u.last_name as reviewer_last_name, 
                u.profile_picture as reviewer_profile_picture,
                e.title as event_title, 
                e.event_date
                FROM {$this->table} r
                JOIN users u ON r.reviewer_id = u.user_id
                JOIN events e ON r.event_id = e.event_id
                WHERE r.reviewed_id = :user_id
                ORDER BY r.created_at DESC
                LIMIT :limit OFFSET :offset";
        $params = [
            'user_id' => $userId,
            'limit' => $limit,
            'offset' => $offset
        ];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get reviews for an event
    public function getReviewsForEvent($eventId) {
        $query = "SELECT r.*, 
                u.first_name as reviewer_first_name, 
                u.last_name as reviewer_last_name, 
                u.profile_picture as reviewer_profile_picture
                FROM {$this->table} r
                JOIN users u ON r.reviewer_id = u.user_id
                WHERE r.event_id = :event_id
                ORDER BY r.created_at DESC";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Check if user has already reviewed
    public function hasUserReviewed($reviewerId, $reviewedId, $eventId) {
        $query = "SELECT COUNT(*) as count FROM {$this->table}
                WHERE reviewer_id = :reviewer_id 
                AND reviewed_id = :reviewed_id
                AND event_id = :event_id";
        $params = [
            'reviewer_id' => $reviewerId,
            'reviewed_id' => $reviewedId,
            'event_id' => $eventId
        ];
        $result = $this->db->query($query, $params)->fetch();
        return $result->count > 0;
    }
    
    // Get average rating for a user
    public function getAverageRating($userId) {
        $query = "SELECT AVG(rating) as average FROM {$this->table} WHERE reviewed_id = :user_id";
        $params = ['user_id' => $userId];
        $result = $this->db->query($query, $params)->fetch();
        return $result->average ? round($result->average, 1) : 0;
    }
    
    // Get rating distribution for a user
    public function getRatingDistribution($userId) {
        $query = "SELECT rating, COUNT(*) as count FROM {$this->table}
                WHERE reviewed_id = :user_id
                GROUP BY rating
                ORDER BY rating DESC";
        $params = ['user_id' => $userId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Etkinliğin ortalama rating'ini getir
    
   public function getEventAverageRating($eventId) {
       $query = "SELECT 
           COALESCE(AVG(rating), 0) AS average_rating,
           COUNT(rating) AS total_reviews
       FROM reviews 
       WHERE event_id = :event_id";
       
       $params = ['event_id' => $eventId];
       return $this->db->query($query, $params)->fetch();
   }

    // Get most frequent tags in reviews
    public function getCommonTags($userId, $limit = 10) {
        // This would require a table for review tags or parsing content for tags
        // For now, assuming there's a field or way to extract tags
        $query = "SELECT tag, COUNT(*) as count FROM review_tags
                WHERE review_id IN (SELECT review_id FROM {$this->table} WHERE reviewed_id = :user_id)
                GROUP BY tag
                ORDER BY count DESC
                LIMIT :limit";
        $params = [
            'user_id' => $userId,
            'limit' => $limit
        ];
        // This is a placeholder, as the actual implementation would depend on how tags are stored
        // return $this->db->query($query, $params)->fetchAll();
        
        // Returning mock data for now
        return [
            (object)['tag' => 'Friendly', 'count' => 15],
            (object)['tag' => 'Knowledgeable', 'count' => 12],
            (object)['tag' => 'Helpful', 'count' => 10],
            (object)['tag' => 'Welcoming', 'count' => 8],
            (object)['tag' => 'Organized', 'count' => 7]
        ];
    }
}