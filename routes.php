<?php
// Home routes
$router->get('/', 'HomeController@index');

// Authentication routes
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@registerForm');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');
$router->get('/forgot-password', 'AuthController@forgotForm');
$router->post('/forgot-password', 'AuthController@forgotPassword');

// User routes
$router->get('/users/profile/{id}', 'UserController@profile');
$router->get('/users/edit/{id}', 'UserController@edit');
$router->put('/users/{id}', 'UserController@update');
$router->get('/users/friends', 'UserController@friends');
$router->get('/users/references/{id}', 'UserController@references');
$router->get('/users/settings', 'UserController@settings');

// Event routes
$router->get('/events', 'EventController@index');
$router->get('/events/create', 'EventController@create');
$router->post('/events', 'EventController@store');
$router->get('/events/past', 'EventController@pastEvents');
$router->get('/events/{id}', 'EventController@show');
$router->get('/events/edit/{id}', 'EventController@edit');
$router->put('/events/{id}', 'EventController@update');
$router->delete('/events/{id}', 'EventController@destroy');
$router->get('/events/reviews/{id}', 'EventController@reviews');
$router->get('/events/management', 'EventController@management');

// Message routes
$router->get('/messages', 'MessageController@index');
$router->post('/messages/send', 'MessageController@send');
$router->get('/messages/{id}', 'MessageController@conversation');

// Admin routes
$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/users', 'AdminController@users');
$router->get('/admin/events', 'AdminController@events');
$router->get('/admin/reports', 'AdminController@reports');