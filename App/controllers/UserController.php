<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController {
    protected $userModel;
    
     public function __construct() {
        $this->userModel = new User();
    }
    
    public function profile($params) {
        loadView('users/profile');
    }
    
    public function update($params) {
        // Process profile update
    }
    
    public function friends() {
        loadView('users/friends');
    }
    
    public function references($params) {
        loadView('users/references');
    }
    public function settings() {
        // Check if user is logged in
      loadView('users/settings',[]);
    }
}