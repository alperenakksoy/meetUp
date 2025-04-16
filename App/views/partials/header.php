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
                        <li><a href="../navigations/aboutUs.html" class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-[#e5941d]">About Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-right flex items-center gap-4">
                <select class="py-1.5 px-2.5 mr-8 border border-gray-300 rounded">
                    <option>English</option>
                    <option>Turkish</option>
                    <option>Spanish</option>
                    <option>Arabic</option>
                    <option>French</option>
                </select>
                <div class="user-menu relative flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="w-9 h-9 rounded-full object-cover cursor-pointer border-2 border-[#f5a623]">
                    <div class="notification-badge bg-[#e74c3c] text-white rounded-full w-4.5 h-4.5 text-xs flex items-center justify-center absolute -top-1 -right-1">3</div>
                </div>
            </div>
        </div>
    </header>
