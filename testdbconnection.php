<?php
require_once 'App/Framework/database.php'; // This path is correct according to your structure

// Include necessary files and use the appropriate namespace
use Framework\Database;

try {
    // Load configuration
    $config = require 'config/db.php'; // This path is correct according to your structure
    
    // Create database instance
    $db = new Database($config['database']);
    
    // Run a simple test query
    $result = $db->query("SELECT 'Connection successful!' as message");
    $message = $result->fetch();
    
    // Display success message
    echo "<h1>Database Connection Test</h1>";
    echo "<p style='color: green; font-weight: bold;'>" . $message->message . "</p>";
    echo "<p>The database connection is working correctly.</p>";
    
} catch (Exception $e) {
    // Display error message
    echo "<h1>Database Connection Error</h1>";
    echo "<p style='color: red; font-weight: bold;'>Connection failed: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database credentials and make sure the database server is running.</p>";
}