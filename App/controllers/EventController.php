<?php
namespace App\Controllers;

use App\Models\Event;

class EventController extends BaseController {
    protected $eventModel;
    
    public function __construct() {
        // $this->eventModel = new Event();
        loadView('events/show');
    }
    
    public function index() {
        // Show all events
    }
    
    public function create() {
        // Show event creation form
    }
    
    public function store() {
        // Process event creation
    }
    
    public function show($params) {
        // Show single event
    }
    
    public function edit($params) {
        // Show event edit form
    }
    
    public function update($params) {
        // Process event update
    }
    
    public function destroy($params) {
        // Delete event
    }
    
    public function pastEvents() {
        // Show past events
    }
    
    public function reviews($params) {
        // Show event reviews
    }
    
    public function management() {
        // Show event management page
    }
}