<?php
namespace App\Models;

use Framework\Database;

class BaseModel {
    protected $db;
    protected $table;
    
    public function __construct() {
        $config = require basePath('config/db.php');
        $this->db = new Database($config['database']);
    }
    
    // Basic CRUD operations
    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        return $this->db->query($query)->fetchAll();
    }
    
    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE event_id = :id";
        $params = ['id' => $id];
        return $this->db->query($query, $params)->fetch();
    }
    public function usergetById($id) {
        $query = "SELECT * FROM {$this->table} WHERE user_id = :id";
        $params = ['id' => $id];
        return $this->db->query($query, $params)->fetch();
    }
    
    
    public function create($data) {
        // Build the query dynamically
        $fields = array_keys($data);
        $fieldString = implode(', ', $fields);
        $valueParams = array_map(fn($field) => ":$field", $fields);
        $valueString = implode(', ', $valueParams);
        
        $query = "INSERT INTO {$this->table} ($fieldString) VALUES ($valueString)";
        
        $this->db->query($query, $data);
        return $this->db->conn->lastInsertId();
    }
    // update an event
    public function update($id, $data) {
        // Build update statement dynamically
        $fields = array_keys($data);
        $fieldSet = array_map(fn($field) => "$field = :$field", $fields);
        $fieldSetString = implode(', ', $fieldSet);
        
        $query = "UPDATE {$this->table} SET $fieldSetString WHERE event_id = :id";
        
        // Add id to parameters
        $data['id'] = $id;
        
        return $this->db->query($query, $data);
    }

    
    public function delete($id) {
    $query = "DELETE FROM {$this->table} WHERE event_id = :id";
    $params = ['id' => $id];
    return $this->db->query($query, $params);
}
}