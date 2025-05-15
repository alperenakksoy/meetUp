<?php
namespace App\Controllers;
use App\Models\User;
use Framework\Session;

class HomeController extends BaseController {
    public function index() {
        // Load the homepage
    $email = Session::get('user')['email'];

    $userModel = new User();

    $user = $userModel->findByEmail($email);

    loadView('home',[
        'user' => $user
    ]);
    }
  

}