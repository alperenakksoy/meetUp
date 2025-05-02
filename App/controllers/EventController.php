<?php
namespace App\Controllers;

use App\Models\Event;

class EventController extends BaseController {
    protected $eventModel;
    
    public function __construct() {
        $this->eventModel = new Event();

    }
    
    public function index() {
        // Get upcoming events from the model
        $events = $this->eventModel->getUpcomingEvents();
        
        // Load view and pass events data to it
        loadView('events/index', [
            'events' => $events
        ]);
    }
    
    public function create() {
        loadView('events/create');

    }
    
    public function store() {
        // Process event creation
    }
    
    public function show($params) {
      $event = $this->eventModel->getEventWithDetails($params['id']);

        loadView('events/show',[
            'event' => $event
        ]);
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
        $events = $this->eventModel->getPastEvents();
        loadView('events/past',[
            'events' => $events
        ]);
    }
    
    public function reviews($params) {
        $event = $this->eventModel->getEventWithDetails($params['id']);
        loadView('events/reviews',[
            'event' => $event
        ]);
    }
    
    public function management() {
        // Show event management page
    }
}