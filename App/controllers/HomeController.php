<?php
namespace App\Controllers;

class HomeController extends BaseController {
    public function index() {
        // Load the homepage
        loadView('home');
    }
    public function notifications($count) {
        // Load the homepage
        loadView('home');
    }

}