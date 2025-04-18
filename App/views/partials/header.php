<?php
$title = $title ?? 'SocialLoop';
loadPartial('scripts');
?>
<!-- Header Navigation -->
<header class="bg-white py-2.5 px-5 border-b border-gray-200 w-full flex items-center fixed top-0 left-0 z-10 shadow-sm transition-transform duration-300 transform">
    <div class="header-container flex w-full justify-between items-center">
        <div class="header-left flex items-center">
            <div class="logo w-10 h-10 bg-cover bg-center bg-no-repeat rounded-full mr-5" style="background-image: url('../homepage/homeImg/logo.png')"></div>
            <nav>
                <ul class="flex gap-5">
                    <li><a href="dashboard.php" class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-[#e5941d]">Home</a></li>
                    <li><a href="events.php" class="no-underline text-[#e5941d] text-base font-bold py-2.5 px-2.5 transition-all duration-300">Events</a></li>
                    <li><a href="messages.php" class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-[#e5941d]">Messages</a></li>
                    <li><a href="/App/userHome/friends.php" class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-[#e5941d]">Friends</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right flex items-center gap-4">
            <select class="py-1.5 px-2.5 border border-gray-300 rounded">
                <option>English</option>
                <option>Turkish</option>
            </select>
            
            <!-- Notification Icon between language select and profile picture -->
            <div class="relative mx-4 hover:scale-110 transition-transform duration-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</div>
            </div>
            
            <a href="/../../App/userHome/profile.php">
                <div class="profile-image hover:scale-110 transition-transform duration-200 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="w-9 h-9 rounded-full border-2 border-orange-500">
                </div>
            </a>
        </div>
    </div>
</header>
    <script>
         //ScrollDown Function
         document.addEventListener('DOMContentLoaded', () => {
        initHeaderScrollBehavior();  // Call only if this feature is needed
    });
    </script>