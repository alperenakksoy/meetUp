<?php
// messages/index.view.php - Fixed version

// Set page variables
$pageTitle = 'Messages';
$activePage = 'message';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>

<div class="container mx-auto px-4 py-8" style="margin-top: 80px;">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden" style="height: calc(100vh - 160px); min-height: 500px;">
            <div class="flex h-full">
                <!-- Conversations Sidebar -->
                <div class="w-1/3 border-r border-gray-200">
                    <!-- Header -->
                    <div class="p-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-comments mr-2"></i> Messages
                            <?php if(isset($unreadCount) && $unreadCount > 0): ?>
                                <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">
                                    <?= $unreadCount ?>
                                </span>
                            <?php endif; ?>
                        </h2>
                    </div>
                    
                    <!-- Conversations List -->
                    <div class="overflow-y-auto h-full">
                        <?php if(!empty($conversations)): ?>
                            <?php foreach($conversations as $conversation): ?>
                                <!-- FIXED: Added conversation-link class and proper data attributes -->
                                <a href="/messages/conversation/<?= $conversation->friend_id ?>" 
                                   class="conversation-link block hover:bg-gray-50 transition-colors border-b border-gray-100"
                                   data-friend-id="<?= $conversation->friend_id ?>"
                                   data-friend-name="<?= htmlspecialchars($conversation->first_name . ' ' . $conversation->last_name) ?>">
                                    <div class="p-4 flex items-center">
                                        <div class="relative">
                                            <img src="<?= $conversation->profile_picture ?: ('https://ui-avatars.com/api/?name=' . urlencode($conversation->first_name . '+' . $conversation->last_name) . '&size=48&background=f97316&color=fff&rounded=true') ?>" 
                                                 alt="<?= htmlspecialchars($conversation->first_name . ' ' . $conversation->last_name) ?>" 
                                                 class="w-12 h-12 rounded-full object-cover">
                                            <?php if(isset($conversation->unread_count) && $conversation->unread_count > 0): ?>
                                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                                    <?= $conversation->unread_count ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800 truncate">
                                                <?= htmlspecialchars($conversation->first_name . ' ' . $conversation->last_name) ?>
                                            </div>
                                            <div class="text-sm text-gray-600 truncate">
                                                <?= htmlspecialchars($conversation->last_message ?? 'No messages yet') ?>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <?= isset($conversation->last_message_time) ? timeSince($conversation->last_message_time) : '' ?>
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
                                <a href="/users/friends/<?=$userId?>" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
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
document.addEventListener('DOMContentLoaded', function() {
    console.log('Messages page loaded');
    
    // Get all conversation links - FIXED: Now properly finds elements
    const conversationLinks = document.querySelectorAll('.conversation-link');
    console.log('Found conversation links:', conversationLinks.length);
    
    // Add click handlers for visual feedback
    conversationLinks.forEach((link, index) => {
        console.log(`Link ${index} href:`, link.href);
        console.log(`Link ${index} friend ID:`, link.dataset.friendId);
        
        // Add click event for debugging and visual feedback
        link.addEventListener('click', function(e) {
            console.log('Conversation link clicked:', this.href);
            console.log('Friend ID:', this.dataset.friendId);
            console.log('Friend Name:', this.dataset.friendName);
            
            // Remove active class from all links
            conversationLinks.forEach(l => l.classList.remove('bg-orange-50', 'border-r-4', 'border-orange-500'));
            
            // Add active class to clicked link
            this.classList.add('bg-orange-50', 'border-r-4', 'border-orange-500');
            
            // Optional: Show loading state
            const messageArea = document.querySelector('.flex-1.flex.items-center.justify-center');
            if (messageArea) {
                messageArea.innerHTML = `
                    <div class="text-center text-gray-500">
                        <i class="fas fa-spinner fa-spin fa-3x mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Loading conversation...</h3>
                        <p>Opening chat with ${this.dataset.friendName}</p>
                    </div>
                `;
            }
            
            // Don't prevent default - let the link navigate naturally
            // The page will redirect to the conversation
        });
    });
    
    // Debug: Check if any links exist
    if (conversationLinks.length === 0) {
        console.log('No conversation links found. Check if conversations data is being passed correctly.');
        console.log('Available conversations:', <?= json_encode($conversations ?? []) ?>);
    }
});
</script>

<?= loadPartial('scripts'); ?>
<?= loadPartial('footer'); ?>
</body>
</html>