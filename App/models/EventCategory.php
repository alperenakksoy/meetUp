<?php
namespace App\Models;

class EventCategory extends BaseModel {
    protected $table = 'event_categories';
    
    // Get all categories
    public function getAllCategories() {
        $query = "SELECT * FROM {$this->table} ORDER BY category_name ASC";
        return $this->db->query($query)->fetchAll();
    }
    
    // Get category by name
    public function getCategoryByName($name) {
        $query = "SELECT * FROM {$this->table} WHERE category_name = :name";
        $params = ['name' => $name];
        return $this->db->query($query, $params)->fetch();
    }
    
    // Add a new category
    public function addCategory($name, $description, $icon) {
        $query = "INSERT INTO {$this->table} (category_name, description, icon)
                VALUES (:name, :description, :icon)";
        $params = [
            'name' => $name,
            'description' => $description,
            'icon' => $icon
        ];
        
        return $this->db->query($query, $params);
    }
    
    // Update a category
    public function updateCategory($categoryId, $data) {
        $fields = array_map(fn($field) => "$field = :$field", array_keys($data));
        $fieldSetString = implode(', ', $fields);
        
        $query = "UPDATE {$this->table} SET $fieldSetString WHERE category_id = :category_id";
        
        // Add id to parameters
        $data['category_id'] = $categoryId;
        
        return $this->db->query($query, $data);
    }
    
    // Get events count by category
    public function getEventsCountByCategory() {
        $query = "SELECT c.category_name, c.icon, COUNT(e.event_id) as event_count
                FROM {$this->table} c
                LEFT JOIN events e ON c.category_id = e.category_id
                GROUP BY c.category_id
                ORDER BY event_count DESC";
        
        return $this->db->query($query)->fetchAll();
    }
}