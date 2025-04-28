<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('header') ?>
<!-- Main Content -->
<div class="container mx-auto px-4 py-6 max-w-7xl mt-20">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Messages</h1>
    </div>

    <!-- Messages Layout -->
    <div class="flex border rounded-lg overflow-hidden bg-white shadow-sm">
        <!-- Conversations List -->
        <div class="w-1/3 border-r border-gray-200 bg-gray-50">
            <!-- Search Box -->
            <div class="p-3 border-b border-gray-200">
                <input type="text" class="w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Search messages...">
            </div>

            <!-- Conversation Items -->
            <div class="divide-y divide-gray-200 overflow-y-auto" style="height: calc(100vh - 150px);">
                <!-- Active Conversation -->
                <div class="flex items-center p-3 bg-orange-50 border-l-4 border-orange-500 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <span class="font-medium text-gray-900 truncate">Emma Johnson</span>
                            <span class="text-xs text-gray-500 ml-2">10:30 AM</span>
                        </div>
                        <div class="text-sm text-gray-600 truncate">
                            Hey Ahmet! I'm excited about the coffee meetup tomorrow. Is it still at Kadıköy?
                        </div>
                    </div>
                    <div class="ml-2 bg-orange-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">2</div>
                </div>

                <!-- Unread Conversation -->
                <div class="flex items-center p-3 hover:bg-gray-100 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <span class="font-medium text-gray-900 truncate">David Wilson</span>
                            <span class="text-xs text-gray-500 ml-2">Yesterday</span>
                        </div>
                        <div class="text-sm text-gray-600 truncate">
                            I found this amazing hidden spot in Balat that would be perfect for a photo walk event!
                        </div>
                    </div>
                    <div class="ml-2 bg-orange-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">1</div>
                </div>

                <!-- Read Conversations -->
                <div class="flex items-center p-3 hover:bg-gray-100 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <span class="font-medium text-gray-900 truncate">Olivia Martinez</span>
                            <span class="text-xs text-gray-500 ml-2">2 days ago</span>
                        </div>
                        <div class="text-sm text-gray-500 truncate">
                            Thanks for showing me around Istanbul last week! I had such a great time exploring the city with you.
                        </div>
                    </div>
                </div>

                <div class="flex items-center p-3 hover:bg-gray-100 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <span class="font-medium text-gray-900 truncate">Michael Brown</span>
                            <span class="text-xs text-gray-500 ml-2">3 days ago</span>
                        </div>
                        <div class="text-sm text-gray-500 truncate">
                            Hey! Are you going to join the hiking trip this weekend? We need to confirm the numbers.
                        </div>
                    </div>
                </div>

                <div class="flex items-center p-3 hover:bg-gray-100 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <span class="font-medium text-gray-900 truncate">Sophie Chen</span>
                            <span class="text-xs text-gray-500 ml-2">5 days ago</span>
                        </div>
                        <div class="text-sm text-gray-500 truncate">
                            The language exchange was so much fun! We should organize another one soon.
                        </div>
                    </div>
                </div>

                <div class="flex items-center p-3 hover:bg-gray-100 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <span class="font-medium text-gray-900 truncate">James Taylor</span>
                            <span class="text-xs text-gray-500 ml-2">1 week ago</span>
                        </div>
                        <div class="text-sm text-gray-500 truncate">
                            Do you know any good cafes near Taksim where I can work remotely?
                        </div>
                    </div>
                </div>

                <div class="flex items-center p-3 hover:bg-gray-100 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <span class="font-medium text-gray-900 truncate">Isabella Johnson</span>
                            <span class="text-xs text-gray-500 ml-2">2 weeks ago</span>
                        </div>
                        <div class="text-sm text-gray-500 truncate">
                            I just moved to Istanbul! Looking forward to joining some of your events.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Area -->
        <div class="w-2/3 flex flex-col">
            <!-- Chat Header -->
            <div class="flex items-center p-3 border-b border-gray-200 bg-white">
                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="w-10 h-10 rounded-full mr-3">
                <div class="flex-1">
                    <div class="font-medium text-gray-900">Emma Johnson</div>
                    <div class="flex items-center text-sm text-gray-500">
                        <div class="w-2 h-2 rounded-full bg-green-500 mr-1"></div>
                        <span>Online</span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="text-gray-500 hover:text-orange-500">
                        <i class="fas fa-phone"></i>
                    </button>
                    <button class="text-gray-500 hover:text-orange-500">
                        <i class="fas fa-video"></i>
                    </button>
                    <button class="text-gray-500 hover:text-orange-500">
                        <i class="fas fa-info-circle"></i>
                    </button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 p-4 overflow-y-auto bg-gray-50" style="height: calc(100vh - 200px);">
                <!-- Date Divider -->
                <div class="flex items-center my-4">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <div class="px-3 text-xs text-gray-500">Yesterday</div>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Incoming Message -->
                <div class="flex mb-4">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="w-8 h-8 rounded-full mr-2 mt-1">
                    <div>
                        <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs lg:max-w-md">
                            Hi Ahmet! I saw you're hosting a coffee meetup this weekend. Is there still space to join?
                        </div>
                        <div class="text-xs text-gray-500 mt-1 ml-1">4:30 PM</div>
                    </div>
                </div>

                <!-- Outgoing Message -->
                <div class="flex mb-4 justify-end">
                    <div class="text-right">
                        <div class="bg-orange-500 text-white p-3 rounded-lg rounded-tr-none shadow-sm max-w-xs lg:max-w-md inline-block">
                            Hey Emma! Yes, we still have spots available. Would love to have you join us!
                        </div>
                        <div class="text-xs text-gray-500 mt-1 mr-1">4:35 PM</div>
                    </div>
                </div>

                <!-- More Messages -->
                <div class="flex mb-4">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="w-8 h-8 rounded-full mr-2 mt-1">
                    <div>
                        <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs lg:max-w-md">
                            That's great! What time does it start, and where exactly in Kadıköy are you meeting?
                        </div>
                        <div class="text-xs text-gray-500 mt-1 ml-1">4:38 PM</div>
                    </div>
                </div>

                <div class="flex mb-4 justify-end">
                    <div class="text-right">
                        <div class="bg-orange-500 text-white p-3 rounded-lg rounded-tr-none shadow-sm max-w-xs lg:max-w-md inline-block">
                            We're meeting at 3:00 PM at Mandabatmaz Coffee. It's a small, hidden gem with amazing Turkish coffee. I can send you the exact location if that helps!
                        </div>
                        <div class="text-xs text-gray-500 mt-1 mr-1">4:42 PM</div>
                    </div>
                </div>

                <div class="flex mb-4">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="w-8 h-8 rounded-full mr-2 mt-1">
                    <div>
                        <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs lg:max-w-md">
                            Perfect! I'd appreciate the location. I've been wanting to try authentic Turkish coffee since I arrived.
                        </div>
                        <div class="text-xs text-gray-500 mt-1 ml-1">4:45 PM</div>
                    </div>
                </div>

                <!-- Today's Date Divider -->
                <div class="flex items-center my-4">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <div class="px-3 text-xs text-gray-500">Today</div>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <div class="flex mb-4">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="w-8 h-8 rounded-full mr-2 mt-1">
                    <div>
                        <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs lg:max-w-md">
                            Hey Ahmet! I'm excited about the coffee meetup tomorrow. Is it still at Kadıköy? How many people will be there?
                        </div>
                        <div class="text-xs text-gray-500 mt-1 ml-1">10:30 AM</div>
                    </div>
                </div>

                <div class="flex mb-4">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="w-8 h-8 rounded-full mr-2 mt-1">
                    <div>
                        <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs lg:max-w-md">
                            Also, is it okay if I bring a friend who's visiting from Spain? She'd love to meet locals too!
                        </div>
                        <div class="text-xs text-gray-500 mt-1 ml-1">10:31 AM</div>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="p-3 border-t border-gray-200 bg-white">
                <div class="flex items-center">
                    <div class="flex space-x-2 mr-2">
                        <button class="text-gray-500 hover:text-orange-500 p-2 rounded-full hover:bg-gray-100">
                            <i class="far fa-image"></i>
                        </button>
                        <button class="text-gray-500 hover:text-orange-500 p-2 rounded-full hover:bg-gray-100">
                            <i class="far fa-smile"></i>
                        </button>
                    </div>
                    <textarea class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none" rows="1" placeholder="Type a message..."></textarea>
                    <button class="ml-2 bg-orange-500 text-white p-2 rounded-full hover:bg-orange-600">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        // Conversation item selection
        document.addEventListener('DOMContentLoaded', function() {
            const conversationItems = document.querySelectorAll('.conversation-item');
            
            conversationItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    conversationItems.forEach(i => i.classList.remove('active'));
                    // Add active class to clicked item
                    item.classList.add('active');
                    // Remove unread badge if present
                    const badge = item.querySelector('.unread-badge');
                    if (badge) {
                        badge.style.display = 'none';
                    }
                    // Remove unread styling
                    item.classList.remove('unread');
                });
            });
        });
    </script>
    <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>
