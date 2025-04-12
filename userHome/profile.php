<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Profile</title>
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
            background-color: #f5f8fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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

        /* Profile Section */
        .profile-section {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        /* Sidebar */
        .profile-sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .profile-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Profile Info */
        .profile-info {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 4px solid #f5f5f5;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
            font-family: 'Volkhov', serif;
            color: #2c3e50;
        }

        .profile-location {
            color: #666;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .profile-location i {
            margin-right: 5px;
            color: #f5a623;
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            margin: 15px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-weight: bold;
            font-size: 1.2rem;
            color: #f5a623;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #666;
        }

        .profile-actions {
            margin-top: 15px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background-color: #f5a623;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e5941d;
        }

        .btn-outline {
            border: 1px solid #f5a623;
            color: #f5a623;
            background-color: transparent;
        }

        .btn-outline:hover {
            background-color: #f5a623;
            color: white;
        }

        .edit-profile-btn {
            width: 100%;
        }

        /* User Details */
        .user-details {
            margin-top: 20px;
        }

        .detail-section {
            margin-bottom: 15px;
        }

        .detail-section h3 {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #2c3e50;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
            font-family: 'Volkhov', serif;
        }

        .detail-item {
            display: flex;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .detail-item i {
            width: 25px;
            color: #f5a623;
        }

        .interests-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .interest-tag {
            background-color: #f5f5f5;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .interest-tag:hover {
            background-color: #f5a623;
            color: white;
        }

        /* Content Boxes */
        .content-box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        .content-header h2 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            font-family: 'Volkhov', serif;
        }

        .content-header h2 i {
            color: #f5a623;
            margin-right: 8px;
        }

        .view-all {
            color: #f5a623;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .view-all:hover {
            color: #e5941d;
            text-decoration: underline;
        }

        /* Events Section */
        .events-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .event-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .event-image {
            height: 150px;
            width: 100%;
            object-fit: cover;
        }

        .event-details {
            padding: 15px;
        }

        .event-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .event-date, .event-location {
            font-size: 0.9rem;
            color: #666;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .event-date i, .event-location i {
            margin-right: 8px;
            color: #f5a623;
            width: 16px;
            text-align: center;
        }

        .event-participants {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }

        .participant-avatars {
            display: flex;
        }

        .participant-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            margin-left: -8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .participant-avatar:first-child {
            margin-left: 0;
        }

        .participant-count {
            font-size: 0.8rem;
            color: #666;
            margin-left: 10px;
        }

        /* Friends Section */
        .friends-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .friend-item {
            text-align: center;
            transition: transform 0.3s ease;
        }

        .friend-item:hover {
            transform: translateY(-3px);
        }

        .friend-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f5f5f5;
            margin-bottom: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .friend-name {
            font-size: 0.8rem;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Messages Section */
        .message-list {
            padding: 0;
        }

        .message-item {
            display: flex;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s ease;
        }

        .message-item:last-child {
            border-bottom: none;
        }

        .message-item:hover {
            background-color: #f9f9f9;
        }

        .message-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #f5f5f5;
        }

        .message-content {
            flex: 1;
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            align-items: center;
        }

        .message-sender {
            font-weight: 600;
            color: #2c3e50;
        }

        .message-time {
            font-size: 0.8rem;
            color: #888;
        }

        .message-preview {
            font-size: 0.9rem;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread {
            background-color: rgba(245, 166, 35, 0.05);
        }

        .unread .message-preview {
            font-weight: 500;
            color: #333;
        }

        .message-status {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #f5a623;
            border-radius: 50%;
            margin-right: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                position: static;
                margin-bottom: 20px;
            }

            .events-list {
                grid-template-columns: 1fr;
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
                        <li><a href="messages.php">Messages</a></li>
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
        <div class="profile-section">
            <!-- Left Sidebar - Profile Information -->
            <div class="profile-sidebar">
                <div class="profile-info">
                    <div class="profile-photo-container">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="profile-photo">
                    </div>
                    <h1 class="profile-name">Ahmet Alperen Aksoy</h1>
                    <div class="profile-location">
                        <i class="fas fa-map-marker-alt"></i>
                        Istanbul, Turkey
                    </div>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">24</div>
                            <div class="stat-label">Events</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">156</div>
                            <div class="stat-label">Friends</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">42</div>
                            <div class="stat-label">References</div>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <a href="edit_profile.php" class="btn btn-primary edit-profile-btn">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>

                <!-- User Details -->
                <div class="user-details">
                    <div class="detail-section">
                        <h3>Personal Information</h3>
                        <div class="detail-item">
                            <i class="fas fa-user"></i>
                            <span>27 years old</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-briefcase"></i>
                            <span>Software Engineer</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span>Member since January 2023</span>
                        </div>
                    </div>

                    <div class="detail-section">
                        <h3>About Me</h3>
                        <p>Software engineering graduate passionate about travel, technology, and bringing people together. Created SocialLoop as my B.Sc. thesis project to help travelers connect with locals through shared experiences.</p>
                    </div>

                    <div class="detail-section">
                        <h3>Interests</h3>
                        <div class="interests-list">
                            <span class="interest-tag">Travel</span>
                            <span class="interest-tag">Photography</span>
                            <span class="interest-tag">Hiking</span>
                            <span class="interest-tag">Coffee</span>
                            <span class="interest-tag">Technology</span>
                            <span class="interest-tag">Languages</span>
                            <span class="interest-tag">Culture</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="profile-main">
                <!-- Events Section -->
                <div class="content-box">
                    <div class="content-header">
                        <h2><i class="fas fa-calendar-alt"></i> My Events</h2>
                        <a href="events.php" class="view-all">View All</a>
                    </div>
                    <div class="events-list">
                        <!-- Event 1 -->
                        <div class="event-card">
                            <img src="/api/placeholder/400/150" alt="Event Image" class="event-image">
                            <div class="event-details">
                                <h3 class="event-title">Coffee & Cultural Exchange</h3>
                                <div class="event-date">
                                    <i class="far fa-calendar"></i>
                                    April 5, 2025 • 15:00
                                </div>
                                <div class="event-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Kadıköy, Istanbul
                                </div>
                                <div class="event-participants">
                                    <div class="participant-avatars">
                                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Participant" class="participant-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Participant" class="participant-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Participant" class="participant-avatar">
                                    </div>
                                    <span class="participant-count">+4 going</span>
                                </div>
                            </div>
                        </div>

                        <!-- Event 2 -->
                        <div class="event-card">
                            <img src="/api/placeholder/400/150" alt="Event Image" class="event-image">
                            <div class="event-details">
                                <h3 class="event-title">Hiking Belgrad Forest</h3>
                                <div class="event-date">
                                    <i class="far fa-calendar"></i>
                                    April 8, 2025 • 09:00
                                </div>
                                <div class="event-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Belgrad Forest, Istanbul
                                </div>
                                <div class="event-participants">
                                    <div class="participant-avatars">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Participant" class="participant-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Participant" class="participant-avatar">
                                    </div>
                                    <span class="participant-count">+6 going</span>
                                </div>
                            </div>
                        </div>

                        <!-- Event 3 -->
                        <div class="event-card">
                            <img src="/api/placeholder/400/150" alt="Event Image" class="event-image">
                            <div class="event-details">
                                <h3 class="event-title">Historical Istanbul Tour</h3>
                                <div class="event-date">
                                    <i class="far fa-calendar"></i>
                                    April 10, 2025 • 10:00
                                </div>
                                <div class="event-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Sultanahmet, Istanbul
                                </div>
                                <div class="event-participants">
                                    <div class="participant-avatars">
                                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Participant" class="participant-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Participant" class="participant-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Participant" class="participant-avatar">
                                    </div>
                                    <span class="participant-count">+8 going</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Friends Section -->
                <div class="content-box">
                    <div class="content-header">
                        <h2><i class="fas fa-users"></i> Friends</h2>
                        <a href="friends.php" class="view-all">View All</a>
                    </div>
                    <div class="friends-grid">
                        <!-- Friend 1 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">Emma</div>
                        </div>
                        <!-- Friend 2 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">David</div>
                        </div>
                        <!-- Friend 3 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">Sophie</div>
                        </div>
                        <!-- Friend 4 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">Michael</div>
                        </div>
                        <!-- Friend 5 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">Olivia</div>
                        </div>
                        <!-- Friend 6 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">James</div>
                        </div>
                        <!-- Friend 7 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">Isabella</div>
                        </div>
                        <!-- Friend 8 -->
                        <div class="friend-item">
                            <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Friend" class="friend-avatar">
                            <div class="friend-name">Alexander</div>
                        </div>
                    </div>
                </div>

                <!-- Messages Section -->
                <div class="content-box">
                    <div class="content-header">
                        <h2><i class="fas fa-envelope"></i> Messages</h2>
                        <a href="messages.php" class="view-all">View All</a>
                    </div>
                    <div class="message-list">
                        <!-- Message 1 - Unread -->
                        <div class="message-item unread">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Contact" class="message-avatar">
                            <div class="message-content">
                                <div class="message-header">
                                    <span class="message-sender">Emma Johnson</span>
                                    <span class="message-time">10:30 AM</span>
                                </div>
                                <div class="message-preview">
                                    <span class="message-status"></span>
                                    Hey Ahmet! I'm excited about the coffee meetup tomorrow. Is it still at Kadıköy?
                                </div>
                            </div>
                        </div>

                        <!-- Message 2 - Unread -->
                        <div class="message-item unread">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Contact" class="message-avatar">
                            <div class="message-content">
                                <div class="message-header">
                                    <span class="message-sender">David Wilson</span>
                                    <span class="message-time">Yesterday</span>
                                </div>
                                <div class="message-preview">
                                    <span class="message-status"></span>
                                    I found this amazing hidden spot in Balat that would be perfect for a photo walk event!
                                </div>
                            </div>
                        </div>

                        <!-- Message 3 -->
                        <div class="message-item">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Contact" class="message-avatar">
                            <div class="message-content">
                                <div class="message-header">
                                    <span class="message-sender">Olivia Martinez</span>
                                    <span class="message-time">2 days ago</span>
                                </div>
                                <div class="message-preview">
                                    Thanks for showing me around Istanbul last week! I had such a great time exploring...
                                </div>
                            </div>
                        </div>

                        <!-- Message 4 -->
                        <div class="message-item">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Contact" class="message-avatar">
                            <div class="message-content">
                                <div class="message-header">
                                    <span class="message-sender">Michael Brown</span>
                                    <span class="message-time">3 days ago</span>
                                </div>
                                <div class="message-preview">
                                    Hey! Are you going to join the hiking trip this weekend? We need to confirm the numbers.
                                </div>
                            </div>
                        </div>
                    </div>
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
        
        // Add click events to cards for navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Make event cards clickable to navigate to event details
            const eventCards = document.querySelectorAll('.event-card');
            eventCards.forEach(card => {
                card.addEventListener('click', function() {
                    const eventTitle = this.querySelector('.event-title').textContent;
                    // In a real app, this would use an event ID instead of title
                    window.location.href = `event_details.php?title=${encodeURIComponent(eventTitle)}`;
                });
            });
            
            // Make friend items clickable to navigate to friend profiles
            const friendItems = document.querySelectorAll('.friend-item');
            friendItems.forEach(item => {
                item.addEventListener('click', function() {
                    const friendName = this.querySelector('.friend-name').textContent;
                    // In a real app, this would use a user ID instead of name
                    window.location.href = `profile.php?name=${encodeURIComponent(friendName)}`;
                });
            });
            
            // Make message items clickable to open conversation
            const messageItems = document.querySelectorAll('.message-item');
            messageItems.forEach(item => {
                item.addEventListener('click', function() {
                    const senderName = this.querySelector('.message-sender').textContent;
                    // In a real app, this would use a conversation ID
                    window.location.href = `messages.php?conversation=${encodeURIComponent(senderName)}`;
                });
            });
        });
    </script>
</body>
</html>