<?php
session_start();

// Require the Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use Framework\Router;
use Framework\Database;

// Load configuration
$config = require basePath('config/db.php');

// Initialize database
$db = new Database($config['database']);

// Initialize router
$router = new Router();

// Load routes
require basePath('routes.php');

// Get URI and remove query string
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);


