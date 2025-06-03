<?php
namespace App\Controllers;

class PageController extends BaseController {
    
    public function about() {
        loadView('pages/about', [
            'pageTitle' => 'About Us - SocialLoop',
            'activePage' => 'about'
        ]);
    }
    
    public function features() {
        loadView('pages/features', [
            'pageTitle' => 'Features - SocialLoop',
            'activePage' => 'features'
        ]);
    }
    public function faq() {
        loadView('pages/faq', [
            'pageTitle' => 'FAQ - SocialLoop',
            'activePage' => 'faq'
        ]);
    }
    
    public function report() {
        loadView('pages/report', [
            'pageTitle' => 'Report an Issue - SocialLoop',
            'activePage' => 'report'
        ]);
    }
    public function safety() {
        loadView('pages/safety', [
            'pageTitle' => 'Safety - SocialLoop',
            'activePage' => 'safety'
        ]);
    }

    public function howitworks() {
        loadView('pages/howitworks', [
            'pageTitle' => 'How It Works - SocialLoop',
            'activePage' => 'howitworks'
        ]);
    }
    
    public function contact() {
        loadView('pages/contact', [
            'pageTitle' => 'Contact Us - SocialLoop',
            'activePage' => 'contact'
        ]);
    }
    
    public function submitContact() {
        // Handle contact form submission
        $name = sanitize($_POST['name'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $message = sanitize($_POST['message'] ?? '');
        
        // Basic validation
        $errors = [];
        
        if (empty($name)) {
            $errors['name'] = 'Name is required';
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required';
        }
        
        if (empty($message)) {
            $errors['message'] = 'Message is required';
        }
        
        if (!empty($errors)) {
            loadView('pages/contact', [
                'pageTitle' => 'Contact Us - SocialLoop',
                'activePage' => 'contact',
                'errors' => $errors,
                'old' => $_POST
            ]);
            return;
        }
        
        // Here you would typically save to database or send email
        // For now, just show success message
        $_SESSION['success_message'] = 'Thank you for your message! We will get back to you soon.';
        redirect('/contact');
    }
}