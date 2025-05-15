<?php
namespace App\Models;
use Framework\Validation;
use Framework\Session;

class Auth {
    protected $db;
    protected $userModel;
    protected $userActivityModel;

    public function __construct() {
        $config = require basePath('config/db.php');
        $this->db = new \Framework\Database($config['database']);
        $this->userModel = new User();
        $this->userActivityModel = new UserActivity();
    }

    // Register a new user
    public function register($userData) {

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

        $existingUser = $this->userModel->findByEmail($userData['email']);
        if ($existingUser) {
            $errors['emailRegistered'] = 'Email already registered';
        }
         // there is no confirm_password in database so we undestting after confirmation.
         unset($userData['confirm_password']);

         if(!empty($errors)){
            loadView('auth/register',[
            'errors' => $errors,
            'user' => $userData]);
            exit;
        }
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);


           // Insert the user
        $userId = $this->userModel->create($userData);
           if (!$userId) {
              $errors['create'] = 'Failed to create an account';
           }

        // Log the registration
        $this->userActivityModel->logActivity($userId, 'registration', 'User registered');
        redirect('/login');
    }

    // Login a user
    public function login($email, $password) {
        $errors = [];
    
        if(!Validation::email($email)){
            $errors['email'] = 'Please enter a valid email';
        }
        
        if(!Validation::string($password, 6)){
            $errors['password'] = 'Password must be at least 6 characters.';
        }
        
        // Check for errors
        if(!empty($errors)){
            loadView('auth/login', [
                'errors' => $errors
            ]);
            exit;
        }
        
        // Check for emails that registered before or exist
        $user = $this->userModel->findByEmail($email);
        if(!$user){
            $errors['login'] = 'Incorrect credentials';
            loadView('auth/login', [
                'errors' => $errors
            ]);
            exit;
        }
    
        // Check password matches
        if(!password_verify($password, $user->password)){
            $errors['login'] = 'Incorrect credentials';
            loadView('auth/login', [
                'errors' => $errors
            ]);
            exit;
        }
        
        // If we get here, login is successful
        // Set session data and redirect
        Session::set('user', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'profile_picture' => $user->profile_picture,
            'bio' => $user->bio,
            'city' => $user->city,
            'country' => $user->country,
            'is_admin' => $user->is_admin ?? false
        ]);
        Session::set('user_id', $user->user_id);
        Session::set('is_logged_in', true);
        Session::set('login_time', time());
    
        // Log the login
        $this->userActivityModel->logActivity($user->user_id, 'login', 'User logged in');
        redirect('/');
    }

    // Logout the current user
    public function logout() {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Log the logout
            $this->userActivityModel->logActivity($userId, 'logout', 'User logged out');

            // Clear session
            session_unset();
            session_destroy();

            return true;
        }

        return false;
    }

    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Get current user
    public function getCurrentUser() {
        if ($this->isLoggedIn()) {
            return $this->userModel->getById($_SESSION['user_id']);
        }

        return null;
    }

    // Check if current user is admin
    public function isAdmin() {
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
    }

    // Reset password request
    public function requestPasswordReset($email) {
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Email not found'
            ];
        }

        // Generate token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store token in database
        $query = "INSERT INTO password_resets (email, token, expires) VALUES (:email, :token, :expires)";
        $params = [
            'email' => $email,
            'token' => $token,
            'expires' => $expires
        ];

        $result = $this->db->query($query, $params);

        if (!$result) {
            return [
                'success' => false,
                'message' => 'Failed to process password reset request'
            ];
        }

        // In a real application, you would send an email with the reset link
        // For now, we'll just return the token
        return [
            'success' => true,
            'token' => $token,
            'message' => 'Password reset request processed'
        ];
    }

    // Reset password with token
    public function resetPassword($token, $password) {
        // Check if token exists and is valid
        $query = "SELECT * FROM password_resets WHERE token = :token AND expires > NOW()";
        $params = ['token' => $token];

        $reset = $this->db->query($query, $params)->fetch();

        if (!$reset) {
            return [
                'success' => false,
                'message' => 'Invalid or expired token'
            ];
        }

        // Get user by email
        $user = $this->userModel->findByEmail($reset->email);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found'
            ];
        }

        // Update password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->userModel->update($user->user_id, ['password' => $hashedPassword]);

        if (!$result) {
            return [
                'success' => false,
                'message' => 'Failed to update password'
            ];
        }

        // Delete used token
        $query = "DELETE FROM password_resets WHERE token = :token";
        $this->db->query($query, ['token' => $token]);

        // Log the password reset
        $this->userActivityModel->logActivity($user->user_id, 'password_reset', 'User reset password');

        return [
            'success' => true,
            'message' => 'Password has been reset successfully'
        ];
    }
}