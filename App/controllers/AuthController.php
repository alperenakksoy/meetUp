<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Auth;
use App\Models\Notification;
use Framework\Validation;
use Framework\Session;

class AuthController extends BaseController {
    protected $userModel;
    protected $auth;
    protected $notify;

    
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->auth = new Auth();
        $this->notify = new Notification();
    }
    
    public function loginForm() {
        // Show login form
        loadView('auth/login');
    }
    
    public function login() {       
        $email = $_POST['email'];
        $password = $_POST['password'];
        $this->auth->login($email,$password);

    }
    
    public function registerForm() {
        // Show registration form
        loadView('auth/register');
    }
    
    public function register() {
        $userData = [
            'first_name' => $_POST['first_name'] ?? '',
            'last_name' => $_POST['last_name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
            'date_of_birth' => $_POST['date_of_birth'] ?? null,
            'gender' => $_POST['gender'] ?? null
        ];

       $this->auth->register($userData);

    }
    /**
     * 
     * Kill the session
     * @return void
     */
    public function logout() {
        // Clear all session data
        Session::clearAll();
    
        // Destroy the PHP session cookie
        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSID',              // cookie name
            '',                       // empty value
            time() - 86400,           // expired in the past
            $params['path'],          // path
            $params['domain'],        // domain
            $params['secure'],        // secure
            $params['httponly']       // httponly
        );
    
        // Optionally also call session_destroy
        session_destroy();
    
        // Redirect to login
        redirect('/login');
    }
    
    public function forgotForm() {
        // Show forgot password form
        loadView('auth/forgot');
    }
    
    public function forgotPassword() {
        // Process forgot password
    }
}