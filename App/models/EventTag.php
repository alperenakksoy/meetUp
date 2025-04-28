<?php
namespace App\Models;

class EventTag extends BaseModel {
    protected $table = 'event_tags';
    
    // Get tags for an event
    public function getTagsByEvent($eventId) {
        $query = "SELECT * FROM {$this->table} WHERE event_id = :event_id";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Get events by tag
    public function getEventsByTag($tagName) {
        $query = "SELECT e.* FROM events e
                JOIN {$this->table} et ON e.event_id = et.event_id
                WHERE et.tag_name = :tag_name
                ORDER BY e.event_date ASC";
        $params = ['tag_name' => $tagName];
        return $this->db->query($query, $params)->fetchAll();
    }
    
    // Add tags to an event
    public function addTagsToEvent($eventId, array $tags) {
        $success = true;
        
        foreach ($tags as $tag) {
            $data = [
                'event_id' => $eventId,
                'tag_name' => $tag
            ];
            
            $query = "INSERT INTO {$this->table} (event_id, tag_name) VALUES (:event_id, :tag_name)";
            $result = $this->db->query($query, $data);
            
            if (!$result) {
                $success = false;
            }
        }
        
        return $success;
    }
    
    // Remove all tags from an event
    public function removeAllTagsFromEvent($eventId) {
        $query = "DELETE FROM {$this->table} WHERE event_id = :event_id";
        $params = ['event_id' => $eventId];
        return $this->db->query($query, $params);
    }
    
    // Get popular tags
    public function getPopularTags($limit = 10) {
        $query = "SELECT tag_name, COUNT(*) as count 
                FROM {$this->table} 
                GROUP BY tag_name 
                ORDER BY count DESC 
                LIMIT :limit";
        $params = ['limit' => $limit];
        return $this->db->query($query, $params)->fetchAll();
    }
}