<?php
// setup-default-images.php
// Run this script once to set up the default images directory

// Create the defaults directory
$defaultsDir = __DIR__ . '/public/uploads/events/defaults';

if (!is_dir($defaultsDir)) {
    mkdir($defaultsDir, 0755, true);
    echo "Created defaults directory at: " . $defaultsDir . "\n";
} else {
    echo "Defaults directory already exists at: " . $defaultsDir . "\n";
}

// Create placeholder files for each category
$categories = [
    'coffee' => 'default_coffee.jpg',
    'cultural' => 'default_cultural.jpg',
    'sports' => 'default_sports.jpg',
    'language' => 'default_language.jpg',
    'food' => 'default_food.jpg',
    'art' => 'default_art.jpg',
    'tech' => 'default_tech.jpg',
    'other' => 'default_event.jpg'
];

echo "\nDefault images needed:\n";
echo "=====================\n";
foreach ($categories as $category => $filename) {
    $filepath = $defaultsDir . '/' . $filename;
    echo "- $filename (for '$category' category)\n";
    
    // Create a simple placeholder if file doesn't exist
    if (!file_exists($filepath)) {
        // You can replace this with actual image creation or copying
        file_put_contents($filepath . '.txt', "Placeholder for $category category image");
    }
}

echo "\nSetup complete!\n";
echo "Now add your default images to: $defaultsDir\n";
echo "\nRecommended image specifications:\n";
echo "- Size: 1200x600 pixels\n";
echo "- Format: JPEG\n";
echo "- File size: Under 500KB each\n";