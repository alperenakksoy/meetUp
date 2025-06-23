<?php
// Home routes
$router->get('/', 'HomeController@index', ['auth']);
$router->get('/users/profile', 'UserController@profile', ['auth']);
$router->get('/users/profile/{id}', 'UserController@profile', ['auth']);
$router->get('/users/edit', 'UserController@edit', ['auth']);
$router->put('/users/update', 'UserController@update', ['auth']);
$router->put('/users/{id}', 'UserController@update', ['auth']);

// Other user pages
$router->get('/users/references/{id}', 'UserController@references');
$router->get('/users/friends/{id}', 'UserController@friends');
$router->get('/users/settings', 'UserController@settings', ['auth']);

// Friendship Handle
$router->post('/api/friendship/handle', 'FriendshipController@handleRequest', ['auth']);
$router->post('/api/friendship/cancel', 'FriendshipController@cancelRequest', ['auth']);
$router->post('/api/friendship/send', 'FriendshipController@sendRequest', ['auth']);

// Event routes
$router->get('/events', 'EventController@index', ['auth']);
$router->get('/events/create', 'EventController@create', ['auth']);
$router->post('/events', 'EventController@store', ['auth']);
$router->get('/events/past', 'EventController@pastEvents', ['auth']);
$router->get('/events/management', 'EventController@management', ['auth']);
$router->get('/events/{id}', 'EventController@show', ['auth']);
$router->get('/events/edit/{id}', 'EventController@edit', ['auth']);
$router->put('/events/{id}', 'EventController@update', ['auth']);
$router->delete('/events/{id}', 'EventController@destroy', ['auth']);
$router->get('/events/reviews/{id}', 'EventController@reviews', ['auth']);

// Event actions
$router->post('/events/{id}/join', 'EventController@joinEvent', ['auth']);
$router->post('/events/{id}/leave', 'EventController@leaveEvent', ['auth']);
$router->post('/events/{id}/debug', 'EventController@debugEndpoint', ['auth']);

// HANGOUT ROUTES
$router->get('/hangouts', 'HangoutController@index', ['auth']);
$router->get('/hangouts/index', 'HangoutController@index', ['auth']);
$router->get('/hangouts/create', 'HangoutController@create', ['auth']);
$router->post('/hangouts', 'HangoutController@store', ['auth']);
$router->get('/hangouts/{id}', 'HangoutController@show', ['auth']);
$router->post('/hangouts/{id}/join', 'HangoutController@join', ['auth']);
$router->post('/hangouts/{id}/leave', 'HangoutController@leave', ['auth']);
$router->delete('/hangouts/{id}', 'HangoutController@destroy', ['auth']);

// API routes for hangouts
$router->get('/api/hangouts/filter', 'HangoutController@filter');
$router->get('/api/hangouts/search', 'HangoutController@search');
$router->get('/api/hangouts/nearby', 'HangoutController@nearby');
$router->get('/api/hangouts/starting-soon', 'HangoutController@startingSoon');

// Messages routes
$router->get('/messages', 'MessageController@index',['auth']);
$router->get('/messages/conversation/{id}', 'MessageController@conversation',['auth']);
$router->get('/messages/get-new/{friendId}/{lastMessageId}', 'MessageController@getNewMessages',['auth']);
$router->get('/messages/start/{friendId}', 'MessageController@startConversation',['auth']);
$router->post('/messages/send', 'MessageController@send',['auth']);
$router->delete('/messages/{id}', 'MessageController@delete',['auth']);

// Add unread count endpoint
$router->get('/messages/unread-count', 'MessageController@getUnreadCount');
// Notification routes
$router->get('/notifications', 'NotificationController@index', ['auth']);
$router->post('/api/notifications/{id}/read', 'NotificationController@markAsRead', ['auth']);
$router->post('/api/notifications/mark-all-read', 'NotificationController@markAllAsRead', ['auth']);
$router->get('/api/notifications/count', 'NotificationController@getCount', ['auth']);

// Authentication routes (guest middleware - only accessible when NOT logged in)
$router->get('/login', 'AuthController@loginForm', ['guest']);
$router->post('/login', 'AuthController@login', ['guest']);
$router->get('/register', 'AuthController@registerForm', ['guest']);
$router->post('/register', 'AuthController@register', ['guest']);
$router->post('/logout', 'AuthController@logout', ['auth']);
$router->get('/forgot-password', 'AuthController@forgotForm', ['guest']);
$router->post('/forgot-password', 'AuthController@forgotPassword', ['guest']);

// Admin routes (you may want to create an 'admin' middleware instead of 'auth')
$router->get('/admin/dashboard', 'AdminController@dashboard', ['auth']);
$router->get('/admin/users', 'AdminController@users', ['auth']);
$router->get('/admin/events', 'AdminController@events', ['auth']);
$router->get('/admin/reports', 'AdminController@reports', ['auth']);

// API routes for AJAX calls
$router->get('/api/notifications/count', 'MessageController@getCount', ['auth']);

// Static pages routes (public access)
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