<?php
namespace App\Controllers;

use App\Models\Event;

class EventController extends BaseController {
    protected $eventModel;
    
    public function __construct() {
        // $this->eventModel = new Event();

    }
    
    public function index() {
        loadView('events/index');
    }
    
    public function create() {
        loadView('events/create');

    }
    
    public function store() {
        // Process event creation
    }
    
    public function show($params) {
        loadView('events/show');
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
        loadView('events/past');
    }
    
    public function reviews($params) {
        // Show event reviews
    }
    
    public function management() {
        // Show event management page
    }
}