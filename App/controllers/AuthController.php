<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Auth;
use Framework\Validation;
use Framework\Session;

class AuthController extends BaseController {
    protected $userModel;
    protected $auth;

    
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->auth = new Auth();
    }
    
    public function loginForm() {
        // Show login form
        loadView('auth/login');
    }
    
    public function login($email,$password) {
        // Process login
        $user = $this->userModel->findByEmail($email);

        Session::set('user',[
            'id' => $user->user_id,
            'is_admin' => $user->is_admin,
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email
        ]);
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

        $errors=[];
        if(!Validation::email($userData['email'])){
            $errors['email'] = 'Please enter a valid email';
        }
        if(!Validation::string($userData['first_name'],2,50) ||
        !Validation::string($userData['last_name'],2,50)){
            $errors['first_name'] = 'First name must be in 2 and 50 charachters.';
            $errors['last_name'] = 'Last name must be in 2 and 50 charachters.';
        }
        if(!Validation::string($userData['password'],6)){
            $errors['password'] = 'Password must be minimum 6 charachters.';
        }
        if(!Validation::match($userData['password'], $userData['confirm_password'])){
            $errors['password_confirmation'] = 'Passwords do not match!';
        }

        if(!empty($errors)){
            loadView('auth/register',[
            'errors' => $errors,
            'user' => $userData]);
            exit;
        }
        // there is no confirm_password in database so we undestting after confirmation.
        unset($userData['confirm_password']);

        $result = $this->auth->register($userData);
        
        if(!$result['success']){
            loadView('auth/register',[
                'errors' => [$result['message']],
                'user' => $userData
            ]);
        }
        $_SESSION['flash_message'] = 'Registration successful! Please log in.';
        redirect('/login');

    }
    
    public function logout() {
        loadView('auth/login');
    }
    
    public function forgotForm() {
        // Show forgot password form
        loadView('auth/forgot');
    }
    
    public function forgotPassword() {
        // Process forgot password
    }
}