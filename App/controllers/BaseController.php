<?php
namespace App\Controllers;

use Framework\Database;

class BaseController {
    protected $db;
    
    public function __construct() {
        $config = require basePath('config/db.php');
        $this->db = new Database($config['database']);
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
            exit;
        }
    }
    
    protected function requireAdmin() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            ErrorController::unauthorized();
            exit;
        }
    }
}