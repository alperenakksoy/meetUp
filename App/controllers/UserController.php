<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController {
    protected $userModel;
    
    // public function __construct() {
    //     $this->userModel = new User();
    // }
    
    public function profile($params) {
        // Show user profile
    }
    
    public function edit($params) {
        // Show edit profile form
    }
    
    public function update($params) {
        // Process profile update
    }
    
    public function friends() {
        loadView('users/friends');
    }
    
    public function references($params) {
        // Show user's references
    }
}