<?php
// Home routes
$router->get('/', 'HomeController@index');

// User routes
$router->get('/users/references', 'UserController@references');
$router->get('/users/friends', 'UserController@friends');
$router->get('/users/settings', 'UserController@settings');

// Current user's profile (no ID needed)
$router->get('/users/profile', 'UserController@profile');
// Specific user's profile (with ID)
$router->get('/users/profile/{id}', 'UserController@profile');

// User edit routes
$router->get('/users/edit', 'UserController@edit');
$router->get('/users/{id}', 'UserController@edit');
$router->put('/users/{id}', 'UserController@update');

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

// Hangout routes
$router->get('/hangouts', 'HangoutController@index');
$router->get('/hangouts/index', 'HangoutController@index');
$router->post('/hangouts', 'HangoutController@store');
$router->get('/hangouts/{id}', 'HangoutController@show');
$router->post('/hangouts/{id}/join', 'HangoutController@join');
$router->post('/hangouts/{id}/leave', 'HangoutController@leave');
$router->delete('/hangouts/{id}', 'HangoutController@destroy');


// Remove duplicate routes and fix the structure
$router->get('/hangouts', 'HangoutController@index');
$router->get('/hangouts/index', 'HangoutController@index'); // Redirect alias
$router->get('/hangouts/create', 'HangoutController@create'); // Optional create form page
$router->post('/hangouts', 'HangoutController@store');
$router->get('/hangouts/{id}', 'HangoutController@show');

// AJAX routes for join/leave (these need to be POST requests)
$router->post('/hangouts/{id}/join', 'HangoutController@join');
$router->post('/hangouts/{id}/leave', 'HangoutController@leave');

// Delete hangout (using proper method override)
$router->delete('/hangouts/{id}', 'HangoutController@destroy');

// Additional API routes for filtering/searching
$router->get('/api/hangouts/filter', 'HangoutController@filter');
$router->get('/api/hangouts/search', 'HangoutController@search');
$router->get('/api/hangouts/nearby', 'HangoutController@nearby');
$router->get('/api/hangouts/starting-soon', 'HangoutController@startingSoon');

// Hangout API routes for AJAX
$router->get('/api/hangouts/filter', 'HangoutController@filter');
$router->get('/api/hangouts/search', 'HangoutController@search');
$router->get('/api/hangouts/nearby', 'HangoutController@nearby');
$router->get('/api/hangouts/starting-soon', 'HangoutController@startingSoon');
// Message routes
$router->get('/messages', 'MessageController@index');
$router->post('/messages/send', 'MessageController@send');
$router->get('/messages/{id}', 'MessageController@conversation');

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