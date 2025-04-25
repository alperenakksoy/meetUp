<?php
namespace App\Controllers;

use App\Models\User;
use Framework\Validation;

class AuthController extends BaseController {
    protected $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function loginForm() {
        // Show login form
        loadView('auth/login');
    }
    
    public function login() {
        // Process login
    }
    
    public function registerForm() {
        // Show registration form
        loadView('auth/register');
    }
    
    public function register() {
        // Process registration
    }
    
    public function logout() {
        // Process logout
    }
    
    public function forgotForm() {
        // Show forgot password form
        loadView('auth/forgot');
    }
    
    public function forgotPassword() {
        // Process forgot password
    }
}