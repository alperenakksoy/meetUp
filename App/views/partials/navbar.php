<?php
use Framework\Session;
use App\Controllers\MessageController;
$title = $title ?? 'SocialLoop';
loadPartial('scripts');

// Initialize notification count
$notificationCount = 0;

// Only try to get notifications if user is logged in
if(Session::has('user_id')) {
    $userId = Session::get('user_id');
    $notification = new MessageController();
    try {
        $notificationCount = $notification->getCount($userId);
    } catch (Exception $e) {
        // Handle error silently or log it
        error_log("Error getting notification count: " . $e->getMessage());
    }
}
?>

<!-- Header Navigation -->
<header class="bg-white py-2.5 px-5 border-b border-gray-200 w-full flex items-center fixed top-0 left-0 z-10 shadow-sm transition-transform duration-300 transform">
    <div class="header-container flex w-full justify-between items-center">
        <div class="header-left flex items-center">
            <div class="logo w-10 h-10 bg-cover bg-center bg-no-repeat rounded-full mr-5" style="background-image: url('../homepage/homeImg/logo.png')"></div>
            <nav>
                <ul class="flex gap-5">
                    <li><a href="/" class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-[#e5941d]">Home</a></li>
                    <li><a href="/events" class="no-underline text-[#e5941d] text-base font-bold py-2.5 px-2.5 transition-all duration-300">Events</a></li>
                    <li><a href="/messages" class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-[#e5941d]">Messages</a></li>
                    <li><a href="/users/friends" class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-[#e5941d]">Friends</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right flex items-center gap-4">
            <select class="py-1.5 px-2.5 border border-gray-300 rounded">
                <option>English</option>
                <option>Turkish</option>
            </select>
            
            <!-- Notification Icon -->
            <div class="relative mx-4 hover:scale-110 transition-transform duration-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    <?= $notificationCount ?? 0 ?>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" id="profileDropdown">
                <div id="profileButton" class="profile-image hover:scale-110 transition-transform duration-200 cursor-pointer">
                    <img src="<?= Session::has('profile_picture') ? Session::get('profile_pic') : '/uploads/profiles/default_profile.png' ?>" 
                         alt="Profile Picture" 
                         class="w-9 h-9 rounded-full border-2 border-orange-500">
                </div>
                
               <!-- Dropdown Menu -->
<div id="profileMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 hidden">
    <a href="/users/profile/<?= $_SESSION['user_id'] ?? '' ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        <i class="fas fa-user mr-2"></i> Profile
    </a>
    <a href="/users/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        <i class="fas fa-cog mr-2"></i> Settings
    </a>
    <div class="border-t border-gray-100 my-1"></div>
    <form action="/logout" method="POST" class="block">
    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 focus:outline-none">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </button>
</form>
</div>
        </div>
    </div>
</header>

<!-- Add JavaScript for dropdown functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Settings dropdown functionality
        const settingsButton = document.getElementById('settingsButton');
        const settingsDropdown = document.getElementById('settingsDropdown');
        
        if (settingsButton && settingsDropdown) {
            // Toggle dropdown when clicking the settings button
            settingsButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent click from immediately bubbling to document
                settingsDropdown.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!settingsButton.contains(e.target) && !settingsDropdown.contains(e.target)) {
                    settingsDropdown.classList.add('hidden');
                }
            });
        }
        
        // Profile dropdown functionality
        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');
        
        if (profileButton && profileMenu) {
            // Toggle dropdown when clicking the profile button
            profileButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent click from immediately bubbling to document
                profileMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!profileButton.contains(e.target) && !profileMenu.contains(e.target)) {
                    profileMenu.classList.add('hidden');
                }
            });
        }
        
        // Initialize header scroll behavior
        if (typeof initHeaderScrollBehavior === 'function') {
            initHeaderScrollBehavior();
        }
    });
</script>