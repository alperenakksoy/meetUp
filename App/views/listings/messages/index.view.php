<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'message';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>
<!-- Main Content -->

<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden" style="height: 600px;">
            <div class="flex h-full">
                <!-- Conversations Sidebar -->
                <div class="w-1/3 border-r border-gray-200">
                    <!-- Header -->
                    <div class="p-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-comments mr-2"></i> Messages
                            <?php if($unreadCount > 0): ?>
                                <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    <?= $unreadCount ?>
                                </span>
                            <?php endif; ?>
                        </h2>
                    </div>
                    
                    <!-- Conversations List -->
                    <div class="overflow-y-auto h-full">
                        <?php if(!empty($conversations)): ?>
                            <?php foreach($conversations as $conversation): ?>
                                <a href="/messages/conversation/<?= $conversation->friend_id ?>" 
                                   class="block hover:bg-gray-50 transition-colors">
                                    <div class="p-4 border-b border-gray-100 flex items-center">
                                        <div class="relative">
                                            <img src="<?= $conversation->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" 
                                                 alt="<?= $conversation->first_name ?>" 
                                                 class="w-12 h-12 rounded-full object-cover">
                                            <?php if($conversation->unread_count > 0): ?>
                                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                                    <?= $conversation->unread_count ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800 truncate">
                                                <?= $conversation->first_name . ' ' . $conversation->last_name ?>
                                            </div>
                                            <div class="text-sm text-gray-600 truncate">
                                                <?= $conversation->last_message ?>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <?= timeSince($conversation->last_message_time) ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="p-8 text-center text-gray-500">
                                <i class="fas fa-comments fa-3x mb-4"></i>
                                <p class="mb-2">No conversations yet</p>
                                <p class="text-sm">Start chatting with your friends!</p>
                                <a href="/friends" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                    <i class="fas fa-user-friends mr-2"></i> View Friends
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Main Content Area -->
                <div class="flex-1 flex items-center justify-center bg-gray-50">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-comment-dots fa-4x mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Select a conversation</h3>
                        <p>Choose a friend from the sidebar to start messaging</p>
                    </div>
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
