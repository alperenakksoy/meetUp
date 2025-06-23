<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Report;

class AdminController extends BaseController {
    protected $userModel;
    protected $eventModel;
    protected $reportModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->eventModel = new Event();
        $this->reportModel = new Report();
        
        // Ensure only admins can access these methods
        $this->requireAdmin();
    }
    
    public function dashboard() {
        // Show admin dashboard
    }
    
    public function users() {
        // Show user management
    }
    
    public function events() {
        // Show event management
    }
    
    public function reports() {
        // Show reports management
    }
}