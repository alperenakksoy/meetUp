<?php
// Home routes
$router->get('/', 'HomeController@index');

// User routes - FIXED ORDER AND STRUCTURE
// Current user's profile (no ID needed)
$router->get('/users/profile', 'UserController@profile');

// Specific user's profile (with ID)
$router->get('/users/profile/{id}', 'UserController@profile');

// Edit current user's profile
$router->get('/users/edit', 'UserController@edit');

// Update current user's profile - FIXED: uses current user ID from session
$router->put('/users/update', 'UserController@update');

// Alternative update route with ID parameter (for consistency)
$router->put('/users/{id}', 'UserController@update');

// Other user pages
$router->get('/users/references', 'UserController@references');
$router->get('/users/friends', 'UserController@friends');
$router->get('/users/settings', 'UserController@settings');

// Friendship Handle
$router->post('/api/friendship/handle', 'FriendshipController@handleRequest');
$router->post('/api/friendship/cancel', 'FriendshipController@cancelRequest');
$router->post('/api/friendship/send', 'FriendshipController@sendRequest');

// Event routes
$router->get('/events', 'EventController@index');
$router->get('/events/create', 'EventController@create');
$router->post('/events', 'EventController@store');
$router->get('/events/past', 'EventController@pastEvents');
$router->get('/events/management', 'EventController@management');
$router->get('/events/{id}', 'EventController@show');
$router->get('/events/edit/{id}', 'EventController@edit');
$router->put('/events/{id}', 'EventController@update');
$router->delete('/events/{id}', 'EventController@destroy');
$router->get('/events/reviews/{id}', 'EventController@reviews');

// Event actions
$router->post('/events/{id}/join', 'EventController@joinEvent');
$router->post('/events/{id}/leave', 'EventController@leaveEvent');
$router->post('/events/{id}/debug', 'EventController@debugEndpoint');

// HANGOUT ROUTES
$router->get('/hangouts', 'HangoutController@index');
$router->get('/hangouts/index', 'HangoutController@index');
$router->get('/hangouts/create', 'HangoutController@create');
$router->post('/hangouts', 'HangoutController@store');
$router->get('/hangouts/{id}', 'HangoutController@show');
$router->post('/hangouts/{id}/join', 'HangoutController@join');
$router->post('/hangouts/{id}/leave', 'HangoutController@leave');
$router->delete('/hangouts/{id}', 'HangoutController@destroy');

// API routes for hangouts
$router->get('/api/hangouts/filter', 'HangoutController@filter');
$router->get('/api/hangouts/search', 'HangoutController@search');
$router->get('/api/hangouts/nearby', 'HangoutController@nearby');
$router->get('/api/hangouts/starting-soon', 'HangoutController@startingSoon');

// Message routes
$router->get('/messages', 'MessageController@index');
$router->post('/messages/send', 'MessageController@send');
$router->get('/messages/{id}', 'MessageController@conversation');

// Notification routes
$router->get('/notifications', 'NotificationController@index');
$router->post('/api/notifications/{id}/read', 'NotificationController@markAsRead');
$router->post('/api/notifications/mark-all-read', 'NotificationController@markAllAsRead');
$router->get('/api/notifications/count', 'NotificationController@getCount');

// Authentication routes
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@registerForm');
$router->post('/register', 'AuthController@register');
$router->post('/logout', 'AuthController@logout');
$router->get('/forgot-password', 'AuthController@forgotForm');
$router->post('/forgot-password', 'AuthController@forgotPassword');

// Admin routes
$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/users', 'AdminController@users');
$router->get('/admin/events', 'AdminController@events');
$router->get('/admin/reports', 'AdminController@reports');

// API routes for AJAX calls
$router->get('/api/notifications/count', 'MessageController@getCount');

// Static pages routes
$router->get('/about', 'PageController@about');
$router->get('/howitworks', 'PageController@howitworks');
$router->get('/faq', 'PageController@faq');
$router->get('/report', 'PageController@report');
$router->get('/safety', 'PageController@safety');
$router->get('/features', 'PageController@features');
$router->get('/contact', 'PageController@contact');
$router->post('/contact', 'PageController@submitContact');

// Error handling routes
$router->get('/404', 'ErrorController@notFound');
$router->get('/403', 'ErrorController@unauthorized');