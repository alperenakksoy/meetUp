<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            padding-top: 80px; /* Accommodate fixed header */
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        header {
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            width: 100%;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out;
        }

        header.hide {
            transform: translateY(-100%);
        }

        .header-container {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 40px;
            height: 40px;
            background-image: url('../homepage/homeImg/logo.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 50%;
            margin-right: 20px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #000;
            font-size: 16px;
            font-weight: 500;
            padding: 10px 10px;
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            color: #e5941d;
        }

        nav ul li a.active {
            font-weight: bold;
            color: #e5941d;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-right select {
            padding: 5px 10px;
            margin-right: 30px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .user-menu {
            position: relative;
            display: flex;
            align-items: center;
        }

        .user-menu img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid #f5a623;
        }

        .notification-badge {
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -5px;
            right: -5px;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title {
            font-family: 'Volkhov', serif;
            font-size: 2.5rem;
            color: #2c3e50;
        }

        /* Button Styles */
        .btn {
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e5941d;
        }

        /* Messages Layout */
        .messages-container {
            display: flex;
            flex: 1;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .conversations-list {
            width: 350px;
            border-right: 1px solid #ddd;
            overflow-y: auto;
            max-height: calc(100vh - 150px);
        }

        .message-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Search Box */
        .search-box {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 20px;
            border: 1px solid #ddd;
            background-color: #f5f5f5;
            font-size: 14px;
        }

        .search-input::placeholder {
            color: #888;
        }

        /* Conversation Items */
        .conversation-item {
            display: flex;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .conversation-item:hover {
            background-color: #f5f5f5;
        }

        .conversation-item.active {
            background-color: rgba(245, 166, 35, 0.1);
            border-left: 3px solid #f5a623;
        }

        .conversation-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #f5a623;
        }

        .conversation-content {
            flex: 1;
            min-width: 0; /* Needed for text-overflow to work */
        }

        .conversation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .conversation-name {
            font-weight: 600;
            font-size: 15px;
        }

        .conversation-time {
            font-size: 12px;
            color: #888;
        }

        .conversation-preview {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
            color: #666;
        }

        .unread .conversation-name {
            font-weight: 700;
        }

        .unread .conversation-preview {
            font-weight: 600;
            color: #333;
        }

        .unread-badge {
            background-color: #f5a623;
            color: white;
            font-size: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
        }

        /* Chat Header */
        .chat-header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .chat-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #f5a623;
        }

        .chat-user-info {
            flex: 1;
        }

        .chat-username {
            font-weight: 600;
            font-size: 16px;
        }

        .user-status {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: #666;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-online {
            background-color: #2ecc71;
        }

        .chat-actions {
            display: flex;
            gap: 15px;
        }

        .chat-action-btn {
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .chat-action-btn:hover {
            color: #f5a623;
        }

        /* Messages */
        .chat-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            max-height: calc(100vh - 280px);
            display: flex;
            flex-direction: column;
        }

        .message-bubble {
            max-width: 75%;
            padding: 10px 15px;
            border-radius: 18px;
            margin-bottom: 10px;
            position: relative;
            word-wrap: break-word;
        }

        .message-incoming {
            align-self: flex-start;
            background-color: #f5f5f5;
            border-bottom-left-radius: 5px;
        }

        .message-outgoing {
            align-self: flex-end;
            background-color: #f5a623;
            color: white;
            border-bottom-right-radius: 5px;
        }

        .message-time {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 5px;
            text-align: right;
        }

        .message-status {
            margin-left: 5px;
            font-size: 12px;
        }

        .message-date-divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #888;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background-color: #ddd;
        }

        .divider-text {
            padding: 0 15px;
            font-size: 12px;
        }

        /* Message Input */
        .message-input-container {
            padding: 15px;
            border-top: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .message-input {
            flex: 1;
            padding: 10px 15px;
            border-radius: 20px;
            border: 1px solid #ddd;
            background-color: #f5f5f5;
            resize: none;
            max-height: 100px;
            min-height: 42px;
        }

        .input-actions {
            display: flex;
            gap: 15px;
            padding: 0 15px;
        }

        .input-action-btn {
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .input-action-btn:hover {
            color: #f5a623;
        }

        .send-btn {
            background-color: #f5a623;
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
        }

        .send-btn:hover {
            background-color: #e5941d;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .messages-container {
                flex-direction: column;
                height: auto;
            }

            .conversations-list {
                width: 100%;
                max-height: none;
                border-right: none;
                border-bottom: 1px solid #ddd;
            }

            .message-area {
                height: 500px;
            }

            .chat-messages {
                max-height: 350px;
            }
            
            .header-container {
                flex-direction: column;
                gap: 15px;
            }
            
            nav ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .header-right {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header>
        <div class="header-container">
            <div class="header-left">
                <div class="logo"></div>
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="events.php">Events</a></li>
                        <li><a href="messages.php" class="active">Messages</a></li>
                        <li><a href="friends.php">Friends</a></li>
                        <li><a href="aboutUs.php">About Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <select>
                    <option>English</option>
                    <option>Turkish</option>
                    <option>Spanish</option>
                    <option>Arabic</option>
                    <option>French</option>
                </select>
                <div class="user-menu">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture">
                    <div class="notification-badge">3</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Messages</h1>
        </div>

        <!-- Messages Layout -->
        <div class="messages-container">
            <!-- Conversations List -->
            <div class="conversations-list">
                <!-- Search Box -->
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Search messages...">
                </div>

                <!-- Conversation Items -->
                <div class="conversation-item unread active">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Emma Johnson</span>
                            <span class="conversation-time">10:30 AM</span>
                        </div>
                        <div class="conversation-preview">
                            Hey Ahmet! I'm excited about the coffee meetup tomorrow. Is it still at Kadıköy?
                        </div>
                    </div>
                    <div class="unread-badge">2</div>
                </div>

                <div class="conversation-item unread">
                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Contact" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">David Wilson</span>
                            <span class="conversation-time">Yesterday</span>
                        </div>
                        <div class="conversation-preview">
                            I found this amazing hidden spot in Balat that would be perfect for a photo walk event!
                        </div>
                    </div>
                    <div class="unread-badge">1</div>
                </div>

                <div class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Contact" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Olivia Martinez</span>
                            <span class="conversation-time">2 days ago</span>
                        </div>
                        <div class="conversation-preview">
                            Thanks for showing me around Istanbul last week! I had such a great time exploring the city with you.
                        </div>
                    </div>
                </div>

                <div class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Contact" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Michael Brown</span>
                            <span class="conversation-time">3 days ago</span>
                        </div>
                        <div class="conversation-preview">
                            Hey! Are you going to join the hiking trip this weekend? We need to confirm the numbers.
                        </div>
                    </div>
                </div>

                <div class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Contact" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Sophie Chen</span>
                            <span class="conversation-time">5 days ago</span>
                        </div>
                        <div class="conversation-preview">
                            The language exchange was so much fun! We should organize another one soon.
                        </div>
                    </div>
                </div>

                <div class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Contact" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">James Taylor</span>
                            <span class="conversation-time">1 week ago</span>
                        </div>
                        <div class="conversation-preview">
                            Do you know any good cafes near Taksim where I can work remotely?
                        </div>
                    </div>
                </div>

                <div class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Contact" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Isabella Johnson</span>
                            <span class="conversation-time">2 weeks ago</span>
                        </div>
                        <div class="conversation-preview">
                            I just moved to Istanbul! Looking forward to joining some of your events.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Area -->
            <div class="message-area">
                <!-- Chat Header -->
                <div class="chat-header">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="chat-avatar">
                    <div class="chat-user-info">
                        <div class="chat-username">Emma Johnson</div>
                        <div class="user-status">
                            <div class="status-indicator status-online"></div>
                            <span>Online</span>
                        </div>
                    </div>
                    <div class="chat-actions">
                        <div class="chat-action-btn">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="chat-action-btn">
                            <i class="fas fa-video"></i>
                        </div>
                        <div class="chat-action-btn">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                </div>

                <!-- Chat Messages -->
                <div class="chat-messages">
                    <div class="message-date-divider">
                        <div class="divider-line"></div>
                        <div class="divider-text">Yesterday</div>
                        <div class="divider-line"></div>
                    </div>

                    <div class="message-bubble message-incoming">
                        <div class="message-content">
                            Hi Ahmet! I saw you're hosting a coffee meetup this weekend. Is there still space to join?
                        </div>
                        <div class="message-time">4:30 PM</div>
                    </div>

                    <div class="message-bubble message-outgoing">
                        <div class="message-content">
                            Hey Emma! Yes, we still have spots available. Would love to have you join us!
                        </div>
                        <div class="message-time">4:35 PM</div>
                    </div>

                    <div class="message-bubble message-incoming">
                        <div class="message-content">
                            That's great! What time does it start, and where exactly in Kadıköy are you meeting?
                        </div>
                        <div class="message-time">4:38 PM</div>
                    </div>

                    <div class="message-bubble message-outgoing">
                        <div class="message-content">
                            We're meeting at 3:00 PM at Mandabatmaz Coffee. It's a small, hidden gem with amazing Turkish coffee. I can send you the exact location if that helps!
                        </div>
                        <div class="message-time">4:42 PM</div>
                    </div>

                    <div class="message-bubble message-incoming">
                        <div class="message-content">
                            Perfect! I'd appreciate the location. I've been wanting to try authentic Turkish coffee since I arrived.
                        </div>
                        <div class="message-time">4:45 PM</div>
                    </div>

                    <div class="message-date-divider">
                        <div class="divider-line"></div>
                        <div class="divider-text">Today</div>
                        <div class="divider-line"></div>
                    </div>

                    <div class="message-bubble message-incoming">
                        <div class="message-content">
                            Hey Ahmet! I'm excited about the coffee meetup tomorrow. Is it still at Kadıköy? How many people will be there?
                        </div>
                        <div class="message-time">10:30 AM</div>
                    </div>

                    <div class="message-bubble message-incoming">
                        <div class="message-content">
                            Also, is it okay if I bring a friend who's visiting from Spain? She'd love to meet locals too!
                        </div>
                        <div class="message-time">10:31 AM</div>
                    </div>
                </div>

                <!-- Message Input -->
                <div class="message-input-container">
                    <div class="input-actions">
                        <div class="input-action-btn">
                            <i class="far fa-image"></i>
                        </div>
                        <div class="input-action-btn">
                            <i class="far fa-smile"></i>
                        </div>
                    </div>
                    <textarea class="message-input" placeholder="Type a message..."></textarea>
                    <button class="send-btn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Scroll behavior for header
        let lastScroll = 0;
        let isScrollingDown = false;
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            const header = document.querySelector('header');
            const scrollThreshold = 100;
            
            if (currentScroll <= 0) {
                header.classList.remove('hide');
                return;
            }
        
            if (currentScroll > scrollThreshold) {
                if (currentScroll > lastScroll && !isScrollingDown) {
                    header.classList.add('hide');
                    isScrollingDown = true;
                } else if (currentScroll < lastScroll && isScrollingDown) {
                    header.classList.remove('hide');
                    isScrollingDown = false;
                }
            }
            lastScroll = currentScroll;
        });

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
</body>
</html>