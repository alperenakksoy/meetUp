<?php

// Set page variables

use Framework\Session;

$pageTitle = 'Dashboard';
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
                        </h2>
                    </div>
                    
                    <!-- Conversations List -->
                    <div class="overflow-y-auto h-full">
                        <?php foreach($conversations as $conversation): ?>
                            <a href="/messages/conversation/<?= $conversation->friend_id ?>" 
                               class="block hover:bg-gray-50 transition-colors <?= $conversation->friend_id == $currentFriendId ? 'bg-orange-50 border-r-4 border-orange-500' : '' ?>">
                                <div class="p-4 border-b border-gray-100 flex items-center">
                                    <div class="relative">
                                        <img src="<?= $conversation->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" 
                                             alt="<?= $conversation->first_name ?>" 
                                             class="w-12 h-12 rounded-full object-cover">
                                        <?php if($conversation->unread_count > 0 && $conversation->friend_id != $currentFriendId): ?>
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
                    </div>
                </div>

            
                
                <!-- Chat Area -->
                <div class="flex-1 flex flex-col">
                    <!-- Chat Header -->
                    <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center">
                        <img src="<?= $friend->profile_picture ?? '/uploads/profiles/default_profile.png' ?>" 
                             alt="<?= $friend->first_name ?>" 
                             class="w-10 h-10 rounded-full object-cover mr-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">
                                <?= $friend->first_name . ' ' . $friend->last_name ?>
                            </h3>
                            <p class="text-sm text-gray-600">
                                <?= $friend->city ? $friend->city . ', ' . $friend->country : 'Location not specified' ?>
                            </p>
                        </div>
                        <div class="ml-auto">
                            <a href="/users/profile/<?= $friend->user_id ?>" 
                               class="text-gray-600 hover:text-orange-600 transition-colors">
                                <i class="fas fa-user"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Messages Container -->
                    <div id="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4">
                        <?php if(!empty($messages)): ?>
                            <?php foreach($messages as $message): ?>
                                <div class="message flex <?= $message->sender_id == Session::get('user_id') ? 'justify-end' : 'justify-start' ?>" 
                                     data-message-id="<?= $message->message_id ?>">
                                    <div class="max-w-xs lg:max-w-md">
                                        <?php if($message->sender_id != Session::get('user_id')): ?>
                                            <div class="flex items-start">
                                                <img src="<?= $message->sender_picture ?? '/uploads/profiles/default_profile.png' ?>" 
                                                     alt="<?= $message->sender_name ?>" 
                                                     class="w-8 h-8 rounded-full object-cover mr-2">
                                                <div>
                                                    <div class="bg-gray-200 rounded-lg px-4 py-2">
                                                        <p class="text-gray-800"><?= nl2br(htmlspecialchars($message->message_content)) ?></p>
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        <?= date('M j, Y g:i A', strtotime($message->created_at)) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="text-right">
                                                <div class="bg-orange-500 text-white rounded-lg px-4 py-2 inline-block">
                                                    <p><?= nl2br(htmlspecialchars($message->message_content)) ?></p>
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <?= date('M j, Y g:i A', strtotime($message->created_at)) ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center text-gray-500 py-8">
                                <i class="fas fa-comment-dots fa-3x mb-4"></i>
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Message Input -->
                    <div class="p-4 border-t border-gray-200 bg-gray-50">
                        <form id="messageForm" class="flex gap-2">
                            <input type="hidden" id="receiverId" value="<?= $friend->user_id ?>">
                            <input type="text" 
                                   id="messageInput" 
                                   placeholder="Type your message..." 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   maxlength="1000"
                                   required>
                            <button type="submit" 
                                    class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition-colors flex items-center">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const messagesContainer = document.getElementById('messagesContainer');
    const receiverId = document.getElementById('receiverId').value;
    let lastMessageId = 0;
    
    // Get last message ID for polling
    const messages = document.querySelectorAll('.message');
    if (messages.length > 0) {
        lastMessageId = messages[messages.length - 1].dataset.messageId;
    }
    
    // Auto-scroll to bottom
    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    // Initial scroll to bottom
    scrollToBottom();
    
    // Send message
    messageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        if (!message) return;
        
        // Disable form while sending
        const submitBtn = messageForm.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        fetch('/messages/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear input
                messageInput.value = '';
                
                // Add message to UI immediately
                addMessageToUI({
                    message_id: data.message_id,
                    sender_id: <?= Session::get('user_id') ?>,
                    message_content: message,
                    created_at: data.timestamp
                });
                
                lastMessageId = data.message_id;
                scrollToBottom();
            } else {
                alert('Failed to send message: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to send message');
        })
        .finally(() => {
            // Re-enable form
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
            messageInput.focus();
        });
    });
    
    // Add message to UI
    function addMessageToUI(message) {
        const isOwn = message.sender_id == <?= Session::get('user_id') ?>;
        const messageDiv = document.createElement('div');
        messageDiv.className = `message flex ${isOwn ? 'justify-end' : 'justify-start'}`;
        messageDiv.dataset.messageId = message.message_id;
        
        const timestamp = new Date(message.created_at).toLocaleString();
        
        messageDiv.innerHTML = `
            <div class="max-w-xs lg:max-w-md">
                ${isOwn ? `
                    <div class="text-right">
                        <div class="bg-orange-500 text-white rounded-lg px-4 py-2 inline-block">
                            <p>${message.message_content.replace(/\n/g, '<br>')}</p>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            ${timestamp}
                        </div>
                    </div>
                ` : `
                    <div class="flex items-start">
                        <img src="${message.sender_picture || '/uploads/profiles/default_profile.png'}" 
                             alt="${message.sender_name}" 
                             class="w-8 h-8 rounded-full object-cover mr-2">
                        <div>
                            <div class="bg-gray-200 rounded-lg px-4 py-2">
                                <p class="text-gray-800">${message.message_content.replace(/\n/g, '<br>')}</p>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                ${timestamp}
                            </div>
                        </div>
                    </div>
                `}
            </div>
        `;
        
        messagesContainer.appendChild(messageDiv);
    }
    
    // Poll for new messages every 3 seconds
    setInterval(function() {
        fetch(`/messages/get-new/${receiverId}/${lastMessageId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.messages.length > 0) {
                    data.messages.forEach(message => {
                        addMessageToUI(message);
                        lastMessageId = Math.max(lastMessageId, message.message_id);
                    });
                    scrollToBottom();
                }
            })
            .catch(error => console.error('Error polling messages:', error));
    }, 3000);
    
    // Focus on message input
    messageInput.focus();
    
    // Handle Enter key to send message
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            messageForm.dispatchEvent(new Event('submit'));
        }
    });
});
</script>

<?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>

</html>