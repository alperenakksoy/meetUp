<?php
// Set page variables
$pageTitle = 'Edit Profile';
$activePage = 'profile';
$isLoggedIn = true;
?>
<?php
// Fix for the foreach error - add this logic before the HTML output
// Convert comma-separated strings to arrays if they aren't already arrays
if (isset($user->languages)) {
    if (is_string($user->languages)) {
        // Handle different possible formats:
        // Case 1: JSON-like string '["English","Spanish"]'
        if (strpos($user->languages, '["') === 0) {
            $user->languages = json_decode($user->languages, true) ?: [];
        }
        // Case 2: Regular comma-separated string 'English,Spanish'
        elseif (strpos($user->languages, ',') !== false) {
            $user->languages = explode(',', $user->languages);
        }
        // Case 3: Space-separated or other format 'English Spanish'
        elseif (!empty($user->languages)) {
            // Try to split by various delimiters
            $user->languages = preg_split('/[,;\s]+/', $user->languages, -1, PREG_SPLIT_NO_EMPTY);
        }
        else {
            $user->languages = [];
        }
        
        // Clean up the array
        $user->languages = array_map('trim', $user->languages);
        $user->languages = array_filter($user->languages, function($lang) {
            return !empty($lang) && $lang !== '""' && $lang !== '"';
        });
        // Remove quotes if they exist
        $user->languages = array_map(function($lang) {
            return trim($lang, '"');
        }, $user->languages);
    } elseif (!is_array($user->languages)) {
        $user->languages = [];
    }
} else {
    $user->languages = [];
}

// Enhanced data processing for interests (same logic)
if (isset($user->interests)) {
    if (is_string($user->interests)) {
        // Handle different possible formats:
        // Case 1: JSON-like string '["Software Development","Travel"]'
        if (strpos($user->interests, '["') === 0) {
            $user->interests = json_decode($user->interests, true) ?: [];
        }
        // Case 2: Malformed JSON-like string without commas '["Software Development""Travel"]'
        elseif (strpos($user->interests, '"]["') !== false || (strpos($user->interests, '["') === 0 && strpos($user->interests, '","') === false)) {
            // Extract content between quotes
            preg_match_all('/"([^"]+)"/', $user->interests, $matches);
            $user->interests = $matches[1] ?? [];
        }
        // Case 3: Regular comma-separated string 'Software Development,Travel'
        elseif (strpos($user->interests, ',') !== false) {
            $user->interests = explode(',', $user->interests);
        }
        // Case 4: Single interest
        elseif (!empty($user->interests)) {
            $user->interests = [$user->interests];
        }
        else {
            $user->interests = [];
        }
        
        // Clean up the array
        $user->interests = array_map('trim', $user->interests);
        $user->interests = array_filter($user->interests, function($interest) {
            return !empty($interest) && $interest !== '""' && $interest !== '"';
        });
        // Remove quotes if they exist
        $user->interests = array_map(function($interest) {
            return trim($interest, '"');
        }, $user->interests);
    } elseif (!is_array($user->interests)) {
        $user->interests = [];
    }
} else {
    $user->interests = [];
}

// Predefined languages list
$predefinedLanguages = [
    'English', 'Spanish', 'French', 'German', 'Italian', 'Portuguese', 'Russian', 'Chinese (Mandarin)', 
    'Japanese', 'Korean', 'Arabic', 'Hindi', 'Dutch', 'Swedish', 'Norwegian', 'Danish', 'Finnish',
    'Polish', 'Czech', 'Hungarian', 'Romanian', 'Bulgarian', 'Greek', 'Turkish', 'Hebrew', 
    'Thai', 'Vietnamese', 'Indonesian', 'Malay', 'Tagalog', 'Swahili', 'Urdu', 'Bengali',
    'Tamil', 'Telugu', 'Gujarati', 'Punjabi', 'Ukrainian', 'Croatian', 'Serbian', 'Slovak',
    'Slovenian', 'Estonian', 'Latvian', 'Lithuanian', 'Icelandic', 'Irish', 'Welsh', 'Catalan'
];

// Predefined interests list
$predefinedInterests = [
    // Technology & Computing
    'Programming', 'Web Development', 'Mobile Development', 'Artificial Intelligence', 'Machine Learning',
    'Data Science', 'Cybersecurity', 'Game Development', 'UI/UX Design', 'Software Engineering',
    
    // Creative Arts
    'Photography', 'Digital Art', 'Graphic Design', 'Video Editing', 'Animation', 'Drawing', 'Painting',
    'Music Production', 'Writing', 'Blogging', 'Creative Writing', 'Poetry', 'Filmmaking',
    
    // Sports & Fitness
    'Running', 'Cycling', 'Swimming', 'Yoga', 'Gym Workout', 'Football', 'Basketball', 'Tennis',
    'Hiking', 'Rock Climbing', 'Martial Arts', 'Dancing', 'Skateboarding', 'Surfing',
    
    // Hobbies & Crafts
    'Cooking', 'Baking', 'Gardening', 'DIY Projects', 'Woodworking', 'Knitting', 'Sewing',
    'Pottery', 'Jewelry Making', 'Model Building', 'Origami', 'Calligraphy',
    
    // Entertainment & Media
    'Movies', 'TV Shows', 'Anime', 'Documentary Films', 'Podcasts', 'Books', 'Comics', 'Board Games',
    'Video Games', 'Streaming', 'Theater', 'Stand-up Comedy', 'Live Music', 'Concerts',
    
    // Travel & Culture
    'Travel', 'Cultural Exchange', 'Language Learning', 'History', 'Archaeology', 'Museums',
    'Local Culture', 'Food Tourism', 'Backpacking', 'Road Trips', 'International Cuisine',
    
    // Business & Career
    'Entrepreneurship', 'Startup Culture', 'Investing', 'Stock Market', 'Real Estate',
    'Digital Marketing', 'Social Media', 'Public Speaking', 'Networking', 'Leadership',
    
    // Science & Learning
    'Astronomy', 'Physics', 'Chemistry', 'Biology', 'Environmental Science', 'Psychology',
    'Philosophy', 'Economics', 'Politics', 'Current Events', 'Research', 'Online Learning',
    
    // Music & Audio
    'Playing Guitar', 'Playing Piano', 'Singing', 'Music Theory', 'Audio Engineering',
    'DJ-ing', 'Concert Going', 'Vinyl Collecting', 'Music Discovery', 'Karaoke',
    
    // Outdoor Activities
    'Camping', 'Fishing', 'Hunting', 'Bird Watching', 'Nature Photography', 'Geocaching',
    'Skiing', 'Snowboarding', 'Kayaking', 'Sailing', 'Mountain Biking',
    
    // Social & Community
    'Volunteering', 'Community Service', 'Mentoring', 'Event Planning', 'Meetups',
    'Social Activism', 'Environmental Conservation', 'Animal Welfare', 'Charity Work'
];

?>

<?php loadPartial('head') ?>

<body class="bg-gray-50 pt-20">
    <?php loadPartial('navbar') ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6 max-w-5xl">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="/users/profile/<?= $user->user_id ?>" class="text-gray-500 hover:text-orange-500 mr-3">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-volkhov">Edit Profile</h1>
            </div>
            <div class="text-sm text-gray-500">
                <i class="fas fa-user-edit mr-1"></i>
                Keep your profile updated
            </div>
        </div>

        <!-- Profile Completion Progress -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-gray-800">Profile Completion</h3>
                <span class="text-2xl font-bold text-orange-500" id="completionPercentage">0%</span>
            </div>
            
            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                <div class="bg-gradient-to-r from-orange-400 to-orange-600 h-3 rounded-full transition-all duration-500 ease-out" 
                     id="progressBar" style="width: 0%"></div>
            </div>
            
            <!-- Progress Details -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full mr-2" id="basic-indicator"></div>
                    <span class="text-gray-600">Basic Info</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full mr-2" id="about-indicator"></div>
                    <span class="text-gray-600">About Me</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full mr-2" id="interests-indicator"></div>
                    <span class="text-gray-600">Interests</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full mr-2" id="social-indicator"></div>
                    <span class="text-gray-600">Social Links</span>
                </div>
            </div>
            
            <!-- Completion Tips -->
            <div class="mt-4 p-3 bg-orange-50 rounded-lg" id="completionTips">
                <p class="text-sm text-orange-800">
                    <i class="fas fa-lightbulb mr-1"></i>
                    <span id="tipText">Complete your profile to help others connect with you better!</span>
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <form method="POST" action="/users/<?= $user->user_id ?>" enctype="multipart/form-data" class="space-y-8">
                <input type="hidden" name="method" value="PUT">
                
                <!-- Profile Picture Section -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile Picture</h2>
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <img id="profilePreview" src="/uploads/profiles/<?= $user->profile_picture ?>" 
                                 alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-gray-100 object-cover">
                            <button type="button" id="changePhotoBtn" 
                                    class="absolute -bottom-1 -right-1 bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 shadow-md transition-colors">
                                <i class="fas fa-camera text-sm"></i>
                            </button>
                        </div>
                        <div class="flex-1">
                            <input type="file" id="profileImageInput" name="profile_picture" class="hidden" accept="image/*">
                            <button type="button" onclick="document.getElementById('profileImageInput').click()" 
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition-colors mb-2">
                                <i class="fas fa-upload mr-2"></i>Change Photo
                            </button>
                            <p class="text-sm text-gray-500">JPG, PNG or GIF. Max size 5MB. Recommended: 400x400px</p>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                            <input type="text" id="first_name" name="first_name" value="<?= $user->first_name ?>" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   required>
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" value="<?= $user->last_name ?>" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   required>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" value="<?= $user->email ?>" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   required>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="<?= $user->phone ?>" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="<?= $user->date_of_birth ?>" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select id="gender" name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">Select Gender</option>
                                <option value="Male" <?= $user->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $user->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= $user->gender == 'Other' ? 'selected' : '' ?>>Other</option>
                                <option value="Prefer not to say" <?= $user->gender == 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                            <input type="text" id="occupation" name="occupation" value="<?= $user->occupation ?>" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <div class="grid grid-cols-2 gap-3">
                                <input type="text" id="city" name="city" placeholder="City" value="<?= $user->city ?>" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <input type="text" id="country" name="country" placeholder="Country" value="<?= $user->country ?>" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Me Section -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">About Me</h2>
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea id="bio" name="bio" rows="4" maxlength="500"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none"
                                  placeholder="Tell others about yourself, your interests, and what makes you unique..."><?= $user->bio ?></textarea>
                        <div class="flex justify-between mt-1">
                            <p class="text-sm text-gray-500">This will be displayed on your profile to help others get to know you.</p>
                            <span class="text-sm text-gray-400" id="bioCounter">0/500</span>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Languages Section with Dropdown -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Languages</h2>
                    <div class="flex flex-wrap gap-2 mb-4" id="languagesContainer">
                        <?php if (!empty($user->languages) && is_array($user->languages)): ?>
                            <?php foreach($user->languages as $language): ?>
                                <?php if (!empty(trim($language))): ?>
                                    <span class="bg-blue-100 text-blue-800 px-3 py-2 rounded-full text-sm flex items-center">
                                        <?= htmlspecialchars(trim($language)) ?>
                                        <button type="button" class="ml-2 text-blue-600 hover:text-blue-800 remove-language">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Enhanced Language Input with Dropdown -->
                    <div class="relative">
                        <div class="flex gap-2">
                            <div class="flex-1 relative">
                                <input type="text" id="newLanguage" placeholder="Add a language (e.g., English, Spanish)" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                       autocomplete="off">
                                
                                <!-- Language Dropdown -->
                                <div id="languageDropdown" class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto hidden">
                                    <?php foreach($predefinedLanguages as $lang): ?>
                                        <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer language-option" data-language="<?= htmlspecialchars($lang) ?>">
                                            <?= htmlspecialchars($lang) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <button type="button" id="addLanguageBtn" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-colors">
                                <i class="fas fa-plus mr-1"></i>Add
                            </button>
                        </div>
                    </div>
                    
                    <input type="hidden" name="languages" id="languagesInput" 
                           value="<?= htmlspecialchars(is_array($user->languages) ? implode(',', $user->languages) : '') ?>">
                    <p class="text-sm text-gray-500 mt-2">Select from popular languages or type your own. Start typing to see suggestions.</p>
                </div>

                <!-- Enhanced Interests Section with Dropdown -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Interests & Hobbies</h2>
                    <div class="flex flex-wrap gap-2 mb-4" id="interestsContainer">
                        <?php if (!empty($user->interests) && is_array($user->interests)): ?>
                            <?php foreach($user->interests as $interest): ?>
                                <?php if (!empty(trim($interest))): ?>
                                    <span class="bg-orange-100 text-orange-800 px-3 py-2 rounded-full text-sm flex items-center">
                                        <?= htmlspecialchars(trim($interest)) ?>
                                        <button type="button" class="ml-2 text-orange-600 hover:text-orange-800 remove-interest">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Enhanced Interest Input with Dropdown -->
                    <div class="relative">
                        <div class="flex gap-2">
                            <div class="flex-1 relative">
                                <input type="text" id="newInterest" placeholder="Add an interest (e.g., Photography, Hiking)" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                       autocomplete="off">
                                
                                <!-- Interest Dropdown -->
                                <div id="interestDropdown" class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto hidden">
                                    <?php foreach($predefinedInterests as $interest): ?>
                                        <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer interest-option" data-interest="<?= htmlspecialchars($interest) ?>">
                                            <?= htmlspecialchars($interest) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <button type="button" id="addInterestBtn" 
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition-colors">
                                <i class="fas fa-plus mr-1"></i>Add
                            </button>
                        </div>
                    </div>
                    
                    <input type="hidden" name="interests" id="interestsInput" 
                           value="<?= htmlspecialchars(is_array($user->interests) ? implode(',', $user->interests) : '') ?>">
                    <p class="text-sm text-gray-500 mt-2">Select from popular interests or type your own. Add your interests to connect with like-minded people and discover relevant events.</p>
                </div>

                <!-- Social Media Links Section -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Social Media & Website</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-globe mr-1"></i>Website
                            </label>
                            <input type="url" id="website" name="website" value="<?= $user->website ?>" 
                                   placeholder="https://yourwebsite.com"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-linkedin mr-1"></i>LinkedIn
                            </label>
                            <input type="url" id="linkedin" name="linkedin" value="<?= $user->linkedin ?>" 
                                   placeholder="https://linkedin.com/in/username"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-instagram mr-1"></i>Instagram
                            </label>
                            <input type="text" id="instagram" name="instagram" value="<?= $user->instagram ?>" 
                                   placeholder="@username"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-twitter mr-1"></i>Twitter
                            </label>
                            <input type="text" id="twitter" name="twitter" value="<?= $user->twitter ?>" 
                                   placeholder="@username"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Privacy Settings Section -->
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Privacy Settings</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-800">Public Profile</h4>
                                <p class="text-sm text-gray-600">Make your profile visible to other users</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="profile_public" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-800">Show Contact Information</h4>
                                <p class="text-sm text-gray-600">Allow others to see your email and phone</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="show_contact" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-800">Show Age</h4>
                                <p class="text-sm text-gray-600">Display your age on your profile</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="show_age" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center p-6 bg-gray-50 border-t border-gray-200">
                    <a href="/users/profile/<?= $user->user_id ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg transition-colors">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <div class="flex space-x-3">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white py-3 px-6 rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php loadPartial('footer') ?>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile completion tracking
    const completionPercentage = document.getElementById('completionPercentage');
    const progressBar = document.getElementById('progressBar');
    const basicIndicator = document.getElementById('basic-indicator');
    const aboutIndicator = document.getElementById('about-indicator');
    const interestsIndicator = document.getElementById('interests-indicator');
    const socialIndicator = document.getElementById('social-indicator');
    const tipText = document.getElementById('tipText');

    // Define completion criteria
    const completionCriteria = {
        basic: {
            fields: ['first_name', 'last_name', 'email', 'phone', 'city', 'country', 'occupation'],
            weight: 40,
            indicator: basicIndicator,
            tips: [
                "Add your phone number to help others contact you",
                "Complete your location information",
                "Add your occupation to showcase your profession"
            ]
        },
        about: {
            fields: ['bio', 'date_of_birth', 'gender'],
            weight: 25,
            indicator: aboutIndicator,
            tips: [
                "Write a compelling bio to tell others about yourself",
                "Add your date of birth",
                "Specify your gender preferences"
            ]
        },
        interests: {
            fields: ['languages', 'interests'],
            weight: 20,
            indicator: interestsIndicator,
            tips: [
                "Add at least 3 languages you speak",
                "Add at least 5 interests to connect with like-minded people"
            ]
        },
        social: {
            fields: ['website', 'linkedin', 'instagram', 'twitter'],
            weight: 15,
            indicator: socialIndicator,
            tips: [
                "Add your website or portfolio",
                "Connect your LinkedIn profile",
                "Add your social media handles"
            ]
        }
    };

    function calculateCompletion() {
        let totalScore = 0;
        let availableScore = 0;
        let incompleteSections = [];

        Object.entries(completionCriteria).forEach(([section, criteria]) => {
            let sectionScore = 0;
            let sectionTotal = 0;

            criteria.fields.forEach(fieldName => {
                sectionTotal++;
                const field = document.getElementById(fieldName) || 
                            document.querySelector(`input[name="${fieldName}"]`) ||
                            document.querySelector(`textarea[name="${fieldName}"]`);

                if (field) {
                    let isComplete = false;

                    if (fieldName === 'languages') {
                        const languagesValue = document.getElementById('languagesInput').value;
                        isComplete = languagesValue.split(',').filter(l => l.trim()).length >= 2;
                    } else if (fieldName === 'interests') {
                        const interestsValue = document.getElementById('interestsInput').value;
                        isComplete = interestsValue.split(',').filter(i => i.trim()).length >= 3;
                    } else if (field.type === 'checkbox') {
                        isComplete = field.checked;
                    } else {
                        isComplete = field.value.trim() !== '';
                    }

                    if (isComplete) {
                        sectionScore++;
                    }
                }
            });

            const sectionPercentage = sectionTotal > 0 ? (sectionScore / sectionTotal) : 0;
            const weightedScore = (sectionPercentage * criteria.weight);
            
            totalScore += weightedScore;
            availableScore += criteria.weight;

            // Update section indicator
            if (sectionPercentage >= 0.8) {
                criteria.indicator.className = 'w-3 h-3 rounded-full mr-2 bg-green-500';
            } else if (sectionPercentage >= 0.5) {
                criteria.indicator.className = 'w-3 h-3 rounded-full mr-2 bg-yellow-500';
            } else {
                criteria.indicator.className = 'w-3 h-3 rounded-full mr-2 bg-gray-300';
                incompleteSections.push({section, criteria, percentage: sectionPercentage});
            }
        });

        const overallPercentage = Math.round((totalScore / availableScore) * 100);
        
        // Update progress bar and percentage
        completionPercentage.textContent = `${overallPercentage}%`;
        progressBar.style.width = `${overallPercentage}%`;

        // Update progress bar color based on completion
        if (overallPercentage >= 80) {
            progressBar.className = 'bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full transition-all duration-500 ease-out';
        } else if (overallPercentage >= 50) {
            progressBar.className = 'bg-gradient-to-r from-yellow-400 to-yellow-600 h-3 rounded-full transition-all duration-500 ease-out';
        } else {
            progressBar.className = 'bg-gradient-to-r from-orange-400 to-orange-600 h-3 rounded-full transition-all duration-500 ease-out';
        }

        // Update completion tips
        updateCompletionTips(overallPercentage, incompleteSections);

        return overallPercentage;
    }

    function updateCompletionTips(percentage, incompleteSections) {
        let tip = '';

        if (percentage === 100) {
            tip = "🎉 Congratulations! Your profile is 100% complete!";
            document.getElementById('completionTips').className = 'mt-4 p-3 bg-green-50 rounded-lg';
        } else if (percentage >= 80) {
            tip = "🌟 Your profile looks great! Just a few more details to make it perfect.";
            document.getElementById('completionTips').className = 'mt-4 p-3 bg-green-50 rounded-lg';
        } else if (percentage >= 60) {
            tip = "📈 You're making good progress! Keep adding more information.";
            document.getElementById('completionTips').className = 'mt-4 p-3 bg-yellow-50 rounded-lg';
        } else if (percentage >= 40) {
            tip = "⚡ Good start! Add more details to help others connect with you.";
            document.getElementById('completionTips').className = 'mt-4 p-3 bg-orange-50 rounded-lg';
        } else {
            tip = "🚀 Let's get started! Fill out your basic information first.";
            document.getElementById('completionTips').className = 'mt-4 p-3 bg-orange-50 rounded-lg';
        }

        // Add specific suggestions for incomplete sections
        if (incompleteSections.length > 0 && percentage < 100) {
            const randomSection = incompleteSections[Math.floor(Math.random() * incompleteSections.length)];
            const randomTip = randomSection.criteria.tips[Math.floor(Math.random() * randomSection.criteria.tips.length)];
            tip += ` Tip: ${randomTip}`;
        }

        tipText.innerHTML = tip;
    }

    // Track form changes and update completion
    function trackFormChanges() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('input', calculateCompletion);
            input.addEventListener('change', calculateCompletion);
        });

        // Special handling for languages and interests
        const languagesContainer = document.getElementById('languagesContainer');
        const interestsContainer = document.getElementById('interestsContainer');
        
        const observer = new MutationObserver(calculateCompletion);
        observer.observe(languagesContainer, { childList: true });
        observer.observe(interestsContainer, { childList: true });
    }

    // Initialize tracking
    trackFormChanges();
    calculateCompletion(); // Initial calculation

    // Profile image preview
    const profileImageInput = document.getElementById('profileImageInput');
    const profilePreview = document.getElementById('profilePreview');
    const changePhotoBtn = document.getElementById('changePhotoBtn');

    if (changePhotoBtn && profileImageInput) {
        changePhotoBtn.addEventListener('click', function() {
            profileImageInput.click();
        });

        profileImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // File size validation (5MB)
                if (this.files[0].size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Bio character counter
    const bioTextarea = document.getElementById('bio');
    const bioCounter = document.getElementById('bioCounter');

    if (bioTextarea && bioCounter) {
        function updateBioCounter() {
            const length = bioTextarea.value.length;
            bioCounter.textContent = `${length}/500`;
            bioCounter.className = length > 450 ? 'text-sm text-red-500' : 'text-sm text-gray-400';
        }

        bioTextarea.addEventListener('input', updateBioCounter);
        updateBioCounter(); // Initial count
    }

    // Enhanced Languages management with dropdown functionality
    const languagesContainer = document.getElementById('languagesContainer');
    const newLanguageInput = document.getElementById('newLanguage');
    const addLanguageBtn = document.getElementById('addLanguageBtn');
    const languagesInput = document.getElementById('languagesInput');
    const languageDropdown = document.getElementById('languageDropdown');

    function updateLanguagesInput() {
        const languages = [];
        languagesContainer.querySelectorAll('span').forEach(span => {
            // Get only the text content, excluding the button
            const textContent = span.childNodes[0];
            if (textContent && textContent.nodeType === Node.TEXT_NODE) {
                const text = textContent.textContent.trim();
                if (text) {
                    languages.push(text);
                }
            }
        });
        languagesInput.value = languages.join(',');
        calculateCompletion();
    }

    function filterLanguageOptions(searchTerm) {
        const options = languageDropdown.querySelectorAll('.language-option');
        let hasVisibleOptions = false;

        options.forEach(option => {
            const language = option.getAttribute('data-language').toLowerCase();
            const isMatch = language.includes(searchTerm.toLowerCase());
            
            // Check if this language is already added
            const isAlreadyAdded = isDuplicate(option.getAttribute('data-language'), languagesContainer);
            
            if (isMatch && !isAlreadyAdded) {
                option.style.display = 'block';
                hasVisibleOptions = true;
            } else {
                option.style.display = 'none';
            }
        });

        // Show/hide dropdown based on whether there are matches and input has focus
        if (searchTerm.length > 0 && hasVisibleOptions && document.activeElement === newLanguageInput) {
            languageDropdown.classList.remove('hidden');
        } else {
            languageDropdown.classList.add('hidden');
        }
    }

    if (languagesContainer && newLanguageInput && addLanguageBtn && languagesInput) {
        // Input event for filtering
        newLanguageInput.addEventListener('input', function() {
            filterLanguageOptions(this.value);
        });

        // Focus event to show dropdown
        newLanguageInput.addEventListener('focus', function() {
            filterLanguageOptions(this.value);
        });

        // Click outside to hide dropdown
        document.addEventListener('click', function(e) {
            if (!newLanguageInput.contains(e.target) && !languageDropdown.contains(e.target)) {
                languageDropdown.classList.add('hidden');
            }
        });

        // Dropdown option click
        languageDropdown.addEventListener('click', function(e) {
            if (e.target.classList.contains('language-option')) {
                const language = e.target.getAttribute('data-language');
                newLanguageInput.value = language;
                languageDropdown.classList.add('hidden');
                addLanguageBtn.click();
            }
        });

        addLanguageBtn.addEventListener('click', function() {
            const language = newLanguageInput.value.trim();
            if (language && !isDuplicate(language, languagesContainer)) {
                const languageSpan = document.createElement('span');
                languageSpan.className = 'bg-blue-100 text-blue-800 px-3 py-2 rounded-full text-sm flex items-center';
                languageSpan.innerHTML = `
                    ${language}
                    <button type="button" class="ml-2 text-blue-600 hover:text-blue-800 remove-language">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                `;
                languagesContainer.appendChild(languageSpan);
                newLanguageInput.value = '';
                languageDropdown.classList.add('hidden');
                updateLanguagesInput();
            }
        });

        languagesContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-language') || 
                e.target.parentElement.classList.contains('remove-language') ||
                e.target.closest('.remove-language')) {
                const span = e.target.closest('span');
                if (span) {
                    span.remove();
                    updateLanguagesInput();
                    // Refresh dropdown in case the removed language should now appear
                    filterLanguageOptions(newLanguageInput.value);
                }
            }
        });

        newLanguageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addLanguageBtn.click();
            }
        });

        // Initial update for existing languages
        updateLanguagesInput();
    }

    // Enhanced Interests management with dropdown functionality
    const interestsContainer = document.getElementById('interestsContainer');
    const newInterestInput = document.getElementById('newInterest');
    const addInterestBtn = document.getElementById('addInterestBtn');
    const interestsInput = document.getElementById('interestsInput');
    const interestDropdown = document.getElementById('interestDropdown');

    function updateInterestsInput() {
        const interests = [];
        interestsContainer.querySelectorAll('span').forEach(span => {
            // Get only the text content, excluding the button
            const textContent = span.childNodes[0];
            if (textContent && textContent.nodeType === Node.TEXT_NODE) {
                const text = textContent.textContent.trim();
                if (text) {
                    interests.push(text);
                }
            }
        });
        interestsInput.value = interests.join(',');
        calculateCompletion();
    }

    function filterInterestOptions(searchTerm) {
        const options = interestDropdown.querySelectorAll('.interest-option');
        let hasVisibleOptions = false;

        options.forEach(option => {
            const interest = option.getAttribute('data-interest').toLowerCase();
            const isMatch = interest.includes(searchTerm.toLowerCase());
            
            // Check if this interest is already added
            const isAlreadyAdded = isDuplicate(option.getAttribute('data-interest'), interestsContainer);
            
            if (isMatch && !isAlreadyAdded) {
                option.style.display = 'block';
                hasVisibleOptions = true;
            } else {
                option.style.display = 'none';
            }
        });

        // Show/hide dropdown based on whether there are matches and input has focus
        if (searchTerm.length > 0 && hasVisibleOptions && document.activeElement === newInterestInput) {
            interestDropdown.classList.remove('hidden');
        } else {
            interestDropdown.classList.add('hidden');
        }
    }

    if (interestsContainer && newInterestInput && addInterestBtn && interestsInput) {
        // Input event for filtering
        newInterestInput.addEventListener('input', function() {
            filterInterestOptions(this.value);
        });

        // Focus event to show dropdown
        newInterestInput.addEventListener('focus', function() {
            filterInterestOptions(this.value);
        });

        // Click outside to hide dropdown
        document.addEventListener('click', function(e) {
            if (!newInterestInput.contains(e.target) && !interestDropdown.contains(e.target)) {
                interestDropdown.classList.add('hidden');
            }
        });

        // Dropdown option click
        interestDropdown.addEventListener('click', function(e) {
            if (e.target.classList.contains('interest-option')) {
                const interest = e.target.getAttribute('data-interest');
                newInterestInput.value = interest;
                interestDropdown.classList.add('hidden');
                addInterestBtn.click();
            }
        });

        addInterestBtn.addEventListener('click', function() {
            const interest = newInterestInput.value.trim();
            if (interest && !isDuplicate(interest, interestsContainer)) {
                const interestSpan = document.createElement('span');
                interestSpan.className = 'bg-orange-100 text-orange-800 px-3 py-2 rounded-full text-sm flex items-center';
                interestSpan.innerHTML = `
                    ${interest}
                    <button type="button" class="ml-2 text-orange-600 hover:text-orange-800 remove-interest">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                `;
                interestsContainer.appendChild(interestSpan);
                newInterestInput.value = '';
                interestDropdown.classList.add('hidden');
                updateInterestsInput();
            }
        });

        interestsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-interest') || 
                e.target.parentElement.classList.contains('remove-interest') ||
                e.target.closest('.remove-interest')) {
                const span = e.target.closest('span');
                if (span) {
                    span.remove();
                    updateInterestsInput();
                    // Refresh dropdown in case the removed interest should now appear
                    filterInterestOptions(newInterestInput.value);
                }
            }
        });

        newInterestInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addInterestBtn.click();
            }
        });

        // Initial update for existing interests
        updateInterestsInput();
    }

    // Helper function to check for duplicates
    function isDuplicate(value, container) {
        const existingValues = Array.from(container.querySelectorAll('span')).map(span => {
            const textContent = span.childNodes[0];
            if (textContent && textContent.nodeType === Node.TEXT_NODE) {
                return textContent.textContent.trim().toLowerCase();
            }
            return '';
        }).filter(text => text);
        
        return existingValues.includes(value.toLowerCase());
    }

    // Form validation and submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Update hidden inputs before submission
            updateLanguagesInput();
            updateInterestsInput();

            // Basic validation
            const requiredFields = ['first_name', 'last_name', 'email'];
            let isValid = true;

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field && !field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else if (field) {
                    field.classList.remove('border-red-500');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showNotification('Please fill in all required fields.', 'error');
                return;
            }

            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
                submitBtn.disabled = true;

                // In a real application, you would submit the form here
                // For demo purposes, we'll simulate it
                setTimeout(() => {
                    showNotification('Profile updated successfully!', 'success');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 2000);

                e.preventDefault(); // Remove this in production
            }
        });
    }

    // Social media URL formatting
    const socialFields = ['instagram', 'twitter'];
    socialFields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field) {
            field.addEventListener('blur', function() {
                let value = this.value.trim();
                if (value && !value.startsWith('@')) {
                    this.value = '@' + value;
                }
            });
        }
    });
});

// Utility functions
function resetForm() {
    if (confirm('Are you sure you want to reset all changes? This will revert all fields to their original values.')) {
        location.reload();
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 
        'bg-blue-500'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}
    </script>

    <style>
        /* Profile completion progress animations */
        #progressBar {
            transition: width 0.5s ease-out, background 0.3s ease-out;
        }

        .completion-indicator {
            transition: background-color 0.3s ease-out;
        }

        /* Pulsing animation for low completion */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }
        .peer:checked ~ div {
            background-color: rgb(249 115 22);
        }
        
        .peer:focus ~ div {
            box-shadow: 0 0 0 4px rgb(254 215 170);
        }

        /* Form validation styles */
        .border-red-500 {
            border-color: #ef4444 !important;
        }

        /* Smooth transitions */
        input, textarea, select {
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        /* Profile image hover effect */
        #profilePreview {
            transition: opacity 0.2s ease-in-out;
        }

        #changePhotoBtn:hover ~ #profilePreview {
            opacity: 0.8;
        }

        /* Tag animation */
        .bg-orange-100, .bg-blue-100 {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Dropdown styles */
        #languageDropdown, #interestDropdown {
            z-index: 1000;
        }

        .language-option:hover, .interest-option:hover {
            background-color: #f3f4f6;
        }

        /* Scrollbar styling for dropdowns */
        #languageDropdown::-webkit-scrollbar, 
        #interestDropdown::-webkit-scrollbar {
            width: 6px;
        }

        #languageDropdown::-webkit-scrollbar-track, 
        #interestDropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        #languageDropdown::-webkit-scrollbar-thumb, 
        #interestDropdown::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        #languageDropdown::-webkit-scrollbar-thumb:hover, 
        #interestDropdown::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .grid.grid-cols-2 {
                grid-template-columns: 1fr;
            }

            #languageDropdown, #interestDropdown {
                max-height: 200px;
            }
        }

        /* Enhanced focus states for accessibility */
        .language-option:focus, .interest-option:focus {
            background-color: #e5e7eb;
            outline: 2px solid #f97316;
            outline-offset: -2px;
        }

        /* Loading state animation */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .fa-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</body>
</html>