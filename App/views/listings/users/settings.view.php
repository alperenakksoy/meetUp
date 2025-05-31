<?php
// Set page variables
$pageTitle = 'Settings';
$activePage = 'settings';
$isLoggedIn = true;

// Mock user data - in real application, fetch from database
$user = [
    'user_id' => $_SESSION['user_id'] ?? 1,
    'first_name' => $_SESSION['user']['first_name'] ?? 'John',
    'last_name' => $_SESSION['user']['last_name'] ?? 'Doe',
    'email' => $_SESSION['user']['email'] ?? 'john@example.com',
    'profile_picture' => $_SESSION['user']['profile_picture'] ?? 'default_profile.jpg',
    'city' => $_SESSION['user']['city'] ?? 'Istanbul',
    'country' => $_SESSION['user']['country'] ?? 'Turkey',
    'bio' => $_SESSION['user']['bio'] ?? 'Software engineer passionate about connecting people.',
    'date_of_birth' => '1990-05-15',
    'gender' => 'Male',
    'phone' => '+90 555 123 4567',
    'occupation' => 'Software Engineer',
    'languages' => ['English', 'Turkish', 'Spanish'],
    'interests' => ['Travel', 'Photography', 'Hiking', 'Coffee', 'Technology']
];
?>

<?php loadPartial('head') ?>

<body class="bg-gray-50 pt-20">
    <?php loadPartial('navbar') ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6 max-w-6xl">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="/users/profile/<?= $user['user_id'] ?>" class="text-gray-500 hover:text-orange-500 mr-3">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-volkhov">Account Settings</h1>
            </div>
            <div class="text-sm text-gray-500">
                <i class="fas fa-shield-alt mr-1"></i>
                Your data is secure with us
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Settings Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden sticky top-24">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Settings Menu</h3>
                    </div>
                    <nav class="p-2">
                        <a href="#profile" class="settings-nav-item active flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-user mr-3 w-4"></i>
                            Profile Information
                        </a>
                        <a href="#security" class="settings-nav-item flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-lock mr-3 w-4"></i>
                            Security & Password
                        </a>
                        <a href="#privacy" class="settings-nav-item flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-shield-alt mr-3 w-4"></i>
                            Privacy Settings
                        </a>
                        <a href="#notifications" class="settings-nav-item flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-bell mr-3 w-4"></i>
                            Notifications
                        </a>
                        <a href="#preferences" class="settings-nav-item flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-cog mr-3 w-4"></i>
                            Preferences
                        </a>
                        <a href="#account" class="settings-nav-item flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-user-cog mr-3 w-4"></i>
                            Account Management
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="lg:col-span-3">
                <form method="POST" action="/users/settings/update" enctype="multipart/form-data" class="space-y-6">
                    <!-- Profile Information Section -->
                    <div id="profile" class="settings-section bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Profile Information</h2>
                            <p class="text-gray-600 text-sm">Update your personal information and profile picture.</p>
                        </div>
                        <div class="p-6">
                            <!-- Profile Picture -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Profile Picture</label>
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <img id="profilePreview" src="/uploads/profiles/<?= $user['profile_picture'] ?>" 
                                             alt="Profile Picture" class="w-20 h-20 rounded-full border-4 border-gray-100 object-cover">
                                        <button type="button" id="changePhotoBtn" 
                                                class="absolute -bottom-1 -right-1 bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 shadow-md transition-colors">
                                            <i class="fas fa-camera text-xs"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <input type="file" id="profileImageInput" name="profile_picture" class="hidden" accept="image/*">
                                        <button type="button" onclick="document.getElementById('profileImageInput').click()" 
                                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm transition-colors">
                                            Change Photo
                                        </button>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF. Max size 2MB.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="first_name" name="first_name" value="<?= $user['first_name'] ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="<?= $user['last_name'] ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" id="email" name="email" value="<?= $user['email'] ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" value="<?= $user['phone'] ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" value="<?= $user['date_of_birth'] ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                    <select id="gender" name="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                        <option value="Other" <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                                        <option value="Prefer not to say" <?= $user['gender'] == 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
                                    </select>
                                </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div id="security" class="settings-section bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Security & Password</h2>
                            <p class="text-gray-600 text-sm">Manage your password and account security settings.</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div></div>
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" id="new_password" name="new_password" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-3">Leave password fields empty if you don't want to change your password.</p>
                            
                            <!-- Two-Factor Authentication -->
                            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Two-Factor Authentication</h4>
                                        <p class="text-sm text-gray-600">Add an extra layer of security to your account</p>
                                    </div>
                                    <button type="button" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                        Enable 2FA
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Settings -->
                    <div id="privacy" class="settings-section bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Privacy Settings</h2>
                            <p class="text-gray-600 text-sm">Control who can see your information and how you appear to others.</p>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Profile Visibility</h4>
                                        <p class="text-sm text-gray-600">Make your profile visible to other users</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="profile_public" value="1" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Show Email Address</h4>
                                        <p class="text-sm text-gray-600">Allow other users to see your email</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_email" value="1" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Show Phone Number</h4>
                                        <p class="text-sm text-gray-600">Allow other users to see your phone number</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_phone" value="1" class="sr-only peer">
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
                                
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Allow Friend Requests</h4>
                                        <p class="text-sm text-gray-600">Let others send you friend requests</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="allow_friend_requests" value="1" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div id="notifications" class="settings-section bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Notification Preferences</h2>
                            <p class="text-gray-600 text-sm">Choose what notifications you want to receive.</p>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-medium text-gray-800 mb-4">Email Notifications</h4>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-sm font-medium text-gray-700">Event Invitations</span>
                                                <p class="text-xs text-gray-500">When someone invites you to an event</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="email_event_invitations" value="1" class="sr-only peer" checked>
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-800 mb-4">Push Notifications</h4>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-sm font-medium text-gray-700">New Messages</span>
                                                <p class="text-xs text-gray-500">When you receive a new message</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="push_messages" value="1" class="sr-only peer" checked>
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                            </label>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-sm font-medium text-gray-700">Event Updates</span>
                                                <p class="text-xs text-gray-500">When events you're attending are updated</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="push_event_updates" value="1" class="sr-only peer" checked>
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preferences -->
                    <div id="preferences" class="settings-section bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">App Preferences</h2>
                            <p class="text-gray-600 text-sm">Customize your SocialLoop experience.</p>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div>
                                    <label for="language" class="block text-sm font-medium text-gray-700 mb-2">App Language</label>
                                    <select id="language" name="app_language" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        <option value="en">English</option>
                                        <option value="tr">Türkçe</option>
                                        <option value="es">Español</option>
                                        <option value="fr">Français</option>
                                        <option value="de">Deutsch</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                                    <select id="timezone" name="timezone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        <option value="Europe/Istanbul">Istanbul (UTC+3)</option>
                                        <option value="Europe/London">London (UTC+0)</option>
                                        <option value="America/New_York">New York (UTC-5)</option>
                                        <option value="Asia/Tokyo">Tokyo (UTC+9)</option>
                                        <option value="Australia/Sydney">Sydney (UTC+10)</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="distance_unit" class="block text-sm font-medium text-gray-700 mb-2">Distance Unit</label>
                                    <select id="distance_unit" name="distance_unit" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        <option value="km">Kilometers</option>
                                        <option value="miles">Miles</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="theme" class="block text-sm font-medium text-gray-700 mb-2">Theme Preference</label>
                                    <select id="theme" name="theme" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        <option value="light">Light Mode</option>
                                        <option value="dark">Dark Mode</option>
                                        <option value="auto">Auto (System)</option>
                                    </select>
                                </div>
                                
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Show Online Status</h4>
                                        <p class="text-sm text-gray-600">Let others see when you're online</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_online_status" value="1" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Auto-Join Events</h4>
                                        <p class="text-sm text-gray-600">Automatically join events without approval requirement</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="auto_join_events" value="1" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Management -->
                    <div id="account" class="settings-section bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Account Management</h2>
                            <p class="text-gray-600 text-sm">Manage your account data and deactivation options.</p>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Data Export -->
                                <div class="p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-medium text-gray-800">Export Your Data</h4>
                                            <p class="text-sm text-gray-600">Download a copy of your data including events, messages, and profile information</p>
                                        </div>
                                        <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                            <i class="fas fa-download mr-2"></i>
                                            Export Data
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Account Deactivation -->
                                <div class="p-4 border border-yellow-200 bg-yellow-50 rounded-lg">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="font-medium text-yellow-800">Deactivate Account</h4>
                                            <p class="text-sm text-yellow-700 mt-1">Temporarily deactivate your account. You can reactivate it anytime by logging in.</p>
                                            <ul class="text-xs text-yellow-600 mt-2 space-y-1">
                                                <li>• Your profile will be hidden from other users</li>
                                                <li>• You won't receive notifications</li>
                                                <li>• Your events will remain active</li>
                                                <li>• Your data will be preserved</li>
                                            </ul>
                                        </div>
                                        <button type="button" onclick="confirmDeactivation()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                            Deactivate
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Account Deletion -->
                                <div class="p-4 border border-red-200 bg-red-50 rounded-lg">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="font-medium text-red-800">Delete Account</h4>
                                            <p class="text-sm text-red-700 mt-1">Permanently delete your account and all associated data.</p>
                                            <ul class="text-xs text-red-600 mt-2 space-y-1">
                                                <li>• This action cannot be undone</li>
                                                <li>• All your data will be permanently deleted</li>
                                                <li>• Your events will be cancelled</li>
                                                <li>• Your messages will be removed</li>
                                            </ul>
                                        </div>
                                        <button type="button" onclick="confirmDeletion()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                            Delete Account
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                        <a href="/users/profile/<?= $user['user_id'] ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg transition-colors">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                        <div class="flex space-x-3">
                            <button type="button" onclick="resetForm()" class="bg-yellow-500 hover:bg-yellow-600 text-white py-3 px-6 rounded-lg transition-colors">
                                <i class="fas fa-undo mr-2"></i>
                                Reset Changes
                            </button>
                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white py-3 px-6 rounded-lg transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= loadPartial('footer') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Settings navigation
            const navItems = document.querySelectorAll('.settings-nav-item');
            const sections = document.querySelectorAll('.settings-section');

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    
                    // Update active nav item
                    navItems.forEach(nav => nav.classList.remove('active', 'bg-orange-50', 'text-orange-600'));
                    this.classList.add('active', 'bg-orange-50', 'text-orange-600');
                    
                    // Scroll to section
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            // Profile image preview
            const profileImageInput = document.getElementById('profileImageInput');
            const profilePreview = document.getElementById('profilePreview');
            const changePhotoBtn = document.getElementById('changePhotoBtn');

            changePhotoBtn.addEventListener('click', function() {
                profileImageInput.click();
            });

            profileImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Languages management
            const languagesContainer = document.getElementById('languagesContainer');
            const newLanguageInput = document.getElementById('newLanguage');
            const addLanguageBtn = document.getElementById('addLanguageBtn');
            const languagesInput = document.getElementById('languagesInput');

            function updateLanguagesInput() {
                const languages = [];
                languagesContainer.querySelectorAll('span').forEach(span => {
                    const text = span.textContent.trim();
                    if (text) languages.push(text);
                });
                languagesInput.value = languages.join(',');
            }

            addLanguageBtn.addEventListener('click', function() {
                const language = newLanguageInput.value.trim();
                if (language) {
                    const languageSpan = document.createElement('span');
                    languageSpan.className = 'bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm flex items-center';
                    languageSpan.innerHTML = `
                        ${language}
                        <button type="button" class="ml-2 text-orange-600 hover:text-orange-800 remove-language">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    `;
                    languagesContainer.appendChild(languageSpan);
                    newLanguageInput.value = '';
                    updateLanguagesInput();
                }
            });

            languagesContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-language') || e.target.parentElement.classList.contains('remove-language')) {
                    const span = e.target.closest('span');
                    span.remove();
                    updateLanguagesInput();
                }
            });

            newLanguageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addLanguageBtn.click();
                }
            });

            // Interests management
            const interestsContainer = document.getElementById('interestsContainer');
            const newInterestInput = document.getElementById('newInterest');
            const addInterestBtn = document.getElementById('addInterestBtn');
            const interestsInput = document.getElementById('interestsInput');

            function updateInterestsInput() {
                const interests = [];
                interestsContainer.querySelectorAll('span').forEach(span => {
                    const text = span.textContent.trim();
                    if (text) interests.push(text);
                });
                interestsInput.value = interests.join(',');
            }

            addInterestBtn.addEventListener('click', function() {
                const interest = newInterestInput.value.trim();
                if (interest) {
                    const interestSpan = document.createElement('span');
                    interestSpan.className = 'bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm flex items-center';
                    interestSpan.innerHTML = `
                        ${interest}
                        <button type="button" class="ml-2 text-gray-600 hover:text-gray-800 remove-interest">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    `;
                    interestsContainer.appendChild(interestSpan);
                    newInterestInput.value = '';
                    updateInterestsInput();
                }
            });

            interestsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-interest') || e.target.parentElement.classList.contains('remove-interest')) {
                    const span = e.target.closest('span');
                    span.remove();
                    updateInterestsInput();
                }
            });

            newInterestInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addInterestBtn.click();
                }
            });

            // Password validation
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('confirm_password');

            function validatePasswords() {
                if (newPassword.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords don't match");
                } else {
                    confirmPassword.setCustomValidity('');
                }
            }

            newPassword.addEventListener('input', validatePasswords);
            confirmPassword.addEventListener('input', validatePasswords);

            // Form submission
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
                submitBtn.disabled = true;

                // Simulate form submission (replace with actual form submission)
                setTimeout(() => {
                    // Show success message
                    showNotification('Settings saved successfully!', 'success');
                    
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            });
        });

        // Utility functions
        function resetForm() {
            if (confirm('Are you sure you want to reset all changes? This will revert all fields to their original values.')) {
                location.reload();
            }
        }

        function confirmDeactivation() {
            if (confirm('Are you sure you want to deactivate your account? You can reactivate it anytime by logging in.')) {
                // Handle account deactivation
                window.location.href = '/users/deactivate';
            }
        }

        function confirmDeletion() {
            const confirmation = prompt('To permanently delete your account, type "DELETE" below:');
            if (confirmation === 'DELETE') {
                if (confirm('This action cannot be undone. Are you absolutely sure you want to delete your account?')) {
                    // Handle account deletion
                    window.location.href = '/users/delete';
                }
            } else if (confirmation !== null) {
                alert('Account deletion cancelled. You must type "DELETE" exactly to confirm.');
            }
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 
                'bg-blue-500'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }

        // Intersection Observer for navigation highlighting
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    const navItems = document.querySelectorAll('.settings-nav-item');
                    navItems.forEach(item => {
                        item.classList.remove('active', 'bg-orange-50', 'text-orange-600');
                        if (item.getAttribute('href') === `#${id}`) {
                            item.classList.add('active', 'bg-orange-50', 'text-orange-600');
                        }
                    });
                }
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('.settings-section').forEach(section => {
            observer.observe(section);
        });
    </script>

    <style>
        .settings-nav-item.active {
            background-color: rgb(255 237 213);
            color: rgb(234 88 12);
        }
        
        .settings-section {
            scroll-margin-top: 100px;
        }
        
        /* Custom toggle switch styling */
        .peer:checked ~ div {
            background-color: rgb(249 115 22);
        }
        
        .peer:focus ~ div {
            box-shadow: 0 0 0 4px rgb(254 215 170);
        }
    </style>
</body>
</html></div>
                                            </label>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-sm font-medium text-gray-700">Friend Requests</span>
                                                <p class="text-xs text-gray-500">When someone sends you a friend request</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="email_friend_requests" value="1" class="sr-only peer" checked>
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                            </label>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-sm font-medium text-gray-700">Event Reminders</span>
                                                <p class="text-xs text-gray-500">Reminders for upcoming events you're attending</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="email_event_reminders" value="1" class="sr-only peer" checked>
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                            </label>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-sm font-medium text-gray-700">Weekly Digest</span>
                                                <p class="text-xs text-gray-500">Weekly summary of activities and new events</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="email_weekly_digest" value="1" class="sr-only peer">
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">