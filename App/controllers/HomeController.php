<?php
namespace App\Controllers;

class HomeController extends BaseController {
    public function index() {
        // Load the homepage
        loadView('home');
    }
}