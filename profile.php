<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Profile</title>
    <style>
        /* Global Styles */
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --background-color: #f5f8fa;
            --text-color: #333;
            --light-gray: #ecf0f1;
            --border-color: #e1e8ed;
            --success-color: #2ecc71;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 8px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
        }

        .nav-menu li {
            margin-left: 20px;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover, .nav-menu a.active {
            background-color: var(--primary-color);
            color: white;
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

        .profile-sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: sticky;
            top: 90px;
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
            border-bottom: 1px solid var(--border-color);
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 4px solid var(--light-gray);
        }

        .profile-name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-location {
            color: #777;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .profile-location i {
            margin-right: 5px;
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
            font-size: 18px;
        }

        .stat-label {
            font-size: 12px;
            color: #777;
        }

        .profile-actions {
            margin-top: 15px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-outline {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background-color: transparent;
        }

        .btn-outline:hover {
            background-color: var(--light-gray);
        }

        .edit-profile-btn {
            width: 100%;
            margin-top: 10px;
        }

        /* User Details */
        .user-details {
            margin-top: 20px;
        }

        .detail-section {
            margin-bottom: 15px;
        }

        .detail-section h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }

        .detail-item {
            display: flex;
            margin-bottom: 8px;
        }

        .detail-item i {
            width: 25px;
            color: var(--primary-color);
        }

        .interests-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 5px;
        }

        .interest-tag {
            background-color: var(--light-gray);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* Content Boxes */
        .content-box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .content-header h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
        }

        /* Events Section */
        .events-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .event-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-image {
            height: 150px;
            width: 100%;
            object-fit: cover;
        }

        .event-details {
            padding: 12px;
        }

        .event-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .event-date, .event-location {
            font-size: 13px;
            color: #777;
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .event-date i, .event-location i {
            margin-right: 5px;
            font-size: 14px;
        }

        .event-participants {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .participant-avatars {
            display: flex;
        }

        .participant-avatar {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            margin-left: -8px;
        }

        .participant-avatar:first-child {
            margin-left: 0;
        }

        .participant-count {
            font-size: 12px;
            color: #777;
            margin-left: 8px;
        }

        /* Friends Section */
        .friends-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
            gap: 10px;
        }

        .friend-item {
            text-align: center;
        }

        .friend-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .friend-name {
            font-size: 12px;
            margin-top: 5px;
            color: var(--text-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Messages Section */
        .message-list {
            display: flex;
            flex-direction: column;
        }

        .message-item {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .message-item:last-child {
            border-bottom: none;
        }

        .message-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .message-content {
            flex: 1;
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .message-sender {
            font-weight: 600;
        }

        .message-time {
            font-size: 12px;
            color: #777;
        }

        .message-preview {
            font-size: 14px;
            color: #555;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .unread .message-preview {
            font-weight: 500;
            color: var(--text-color);
        }

        .message-status {
            width: 10px;
            height: 10px;
            background-color: var(--primary-color);
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
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header Navigation -->
    <header>
        <div class="header-container">
            <a href="index.php" class="logo">
                <i class="fas fa-globe"></i>
                SocialLoop
            </a>
            <ul class="nav-menu">
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="friends.php"><i class="fas fa-users"></i> Friends</a></li>
            </ul>
            <div class="user-menu">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture">
                <div class="notification-badge">3</div>
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
        // This is where you would add JavaScript for interactivity
        // For example, to toggle edit mode or handle real-time notifications
        
        // PHP integration points would include:
        // 1. Fetching user profile data
        // 2. Loading friends list
        // 3. Getting recent messages
        // 4. Loading upcoming events
        
        // Example of how you might connect this to PHP (not functional in this HTML-only preview)
        /*
        document.addEventListener('DOMContentLoaded', function() {
            // These would be AJAX requests in a real implementation
            // fetchUserProfile();
            // fetchFriends();
            // fetchMessages();
            // fetchEvents();
        });
        */
    </script>
</body>
</html>