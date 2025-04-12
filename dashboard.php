<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Dashboard</title>
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
            cursor: pointer;
        }

        .user-menu img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
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

        .notification-icon, .message-icon {
            position: relative;
            font-size: 18px;
            color: #555;
            margin-right: 20px;
            cursor: pointer;
        }

        /* Dashboard Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 280px 1fr 300px;
            gap: 20px;
        }

        /* User Profile Sidebar */
        .profile-sidebar {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-cover {
            height: 80px;
            background-color: #f5a623;
            position: relative;
        }

        .profile-info {
            padding: 60px 20px 20px;
            text-align: center;
            position: relative;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 10px 0 5px;
        }

        .profile-location {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-location i {
            margin-right: 5px;
            color: #f5a623;
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            margin: 15px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #666;
        }

        .profile-links {
            margin-top: 15px;
        }

        .profile-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-bottom: 1px solid #eee;
            color: #333;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .profile-link:hover {
            background-color: #f9f9f9;
            color: #f5a623;
        }

        .profile-link:last-child {
            border-bottom: none;
        }

        .profile-link i {
            margin-right: 12px;
            width: 20px;
            color: #666;
        }

        .create-event-btn {
            display: block;
            margin-top: 15px;
            padding: 12px;
            background-color: #f5a623;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create-event-btn:hover {
            background-color: #e5941d;
        }

        /* Feed Section */
        .feed-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Welcome Bar */
        .welcome-bar {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-message {
            font-size: 1.2rem;
            font-weight: 500;
        }

        .welcome-message strong {
            color: #f5a623;
        }

        .welcome-actions {
            display: flex;
            gap: 10px;
        }

        .welcome-btn {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .welcome-btn:hover {
            background-color: #f5a623;
            color: white;
            border-color: #f5a623;
        }

        .welcome-btn i {
            margin-right: 8px;
        }

        /* Event Card */
        .event-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .event-header {
            position: relative;
        }

        .event-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-date-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .event-category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #f5a623;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .event-body {
            padding: 20px;
        }

        .event-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #666;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
        }

        .event-meta-item i {
            width: 20px;
            margin-right: 5px;
            color: #f5a623;
        }

        .event-description {
            margin-bottom: 15px;
            font-size: 0.95rem;
            line-height: 1.5;
            color: #444;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .event-attendees {
            display: flex;
            align-items: center;
        }

        .attendee-avatars {
            display: flex;
        }

        .attendee-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            margin-left: -8px;
        }

        .attendee-avatar:first-child {
            margin-left: 0;
        }

        .attendee-count {
            margin-left: 8px;
            font-size: 0.85rem;
            color: #666;
        }

        .event-actions {
            display: flex;
            gap: 10px;
        }

        .event-action-btn {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #f5a623;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e5941d;
        }

        .btn-secondary {
            background-color: #fff;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #f5f5f5;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .section-link {
            color: #f5a623;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .section-link:hover {
            text-decoration: underline;
        }

        /* Activity Feed */
        .activity-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 15px;
        }

        .activity-header {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }

        .activity-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .activity-content {
            flex: 1;
        }

        .activity-user {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #666;
        }

        .activity-text {
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .activity-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .activity-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #666;
        }

        .activity-actions {
            display: flex;
            gap: 15px;
        }

        .activity-action {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .activity-action:hover {
            color: #f5a623;
        }

        /* Right Sidebar */
        .right-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .sidebar-card h3 {
            font-size: 1.1rem;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            color: #2c3e50;
        }

        /* Upcoming Events Widget */
        .upcoming-event {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .upcoming-event:last-child {
            border-bottom: none;
        }

        .upcoming-event-date {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 50px;
            margin-right: 15px;
        }

        .date-month {
            font-size: 0.8rem;
            font-weight: 600;
            color: #f5a623;
        }

        .date-day {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .upcoming-event-details {
            flex: 1;
        }

        .upcoming-event-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .upcoming-event-meta {
            font-size: 0.85rem;
            color: #666;
        }

        /* Friend Suggestions */
        .friend-suggestion {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .friend-suggestion:last-child {
            border-bottom: none;
        }

        .friend-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .friend-info {
            flex: 1;
        }

        .friend-name {
            font-weight: 500;
            margin-bottom: 3px;
        }

        .friend-meta {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 8px;
        }

        .add-friend-btn {
            padding: 5px 15px;
            background-color: #f5a623;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-friend-btn:hover {
            background-color: #e5941d;
        }

        /* Trends Widget */
        .trend-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .trend-item:last-child {
            border-bottom: none;
        }

        .trend-name {
            font-weight: 500;
        }

        .trend-count {
            font-size: 0.85rem;
            color: #666;
        }

        /* Weather Widget */
        .weather-widget {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: #f5f8fa;
            border-radius: 8px;
        }

        .weather-icon {
            font-size: 2.5rem;
            margin-right: 15px;
            color: #f5a623;
        }

        .weather-info {
            flex: 1;
        }

        .weather-temp {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .weather-location {
            font-size: 0.9rem;
            color: #666;
        }

        .weather-forecast {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .forecast-day {
            text-align: center;
        }

        .forecast-day-name {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 5px;
        }

        .forecast-icon {
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: #f5a623;
        }

        .forecast-temp {
            font-size: 0.85rem;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: 280px 1fr;
            }
            
            .right-sidebar {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-sidebar {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {
            .welcome-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .welcome-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .event-footer {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
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

        /* User Dropdown Menu */
        .user-dropdown {
            position: absolute;
            top: 45px;
            right: 0;
            width: 200px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            display: none;
            z-index: 100;
        }

        .user-dropdown.show {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f5f5f5;
        }

        .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            color: #666;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #eee;
            margin: 8px 0;
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
                        <li><a href="dashboard.php" class="active">Home</a></li>
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
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                    <div class="notification-badge">3</div>
                </div>
                <div class="message-icon">
                    <i class="fas fa-envelope"></i>
                    <div class="notification-badge">2</div>
                </div>
                <div class="user-menu" id="userMenu">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture">
                    <div class="user-dropdown" id="userDropdown">
                        <a href="profile.php" class="dropdown-item">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                        <a href="settings.php" class="dropdown-item">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <a href="event_management.php" class="dropdown-item">
                            <i class="fas fa-calendar-alt"></i> My Events
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="help.php" class="dropdown-item">
                            <i class="fas fa-question-circle"></i> Help Center
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="dashboard-grid">
            <!-- Left Sidebar - User Profile -->
            <div class="profile-sidebar">
                <div class="profile-cover"></div>
                <div class="profile-info">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" class="profile-avatar">
                    <h2 class="profile-name">Ahmet Alperen Aksoy</h2>
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
                            <div class="stat-value">4.8</div>
                            <div class="stat-label">Rating</div>
                        </div>
                    </div>
                    <a href="create_event.php" class="create-event-btn">
                        <i class="fas fa-plus"></i> Create New Event
                    </a>
                </div>
                <div class="profile-links">
                    <a href="userHome/profile.php" class="profile-link">
                        <i class="fas fa-user"></i> View My Profile
                    </a>
                    <a href="saved_events.php" class="profile-link">
                        <i class="fas fa-bookmark"></i> Saved Events
                    </a>
                    <a href="past_events.php" class="profile-link">
                        <i class="fas fa-history"></i> Past Events
                    </a>
                    <a href="notifications.php" class="profile-link">
                        <i class="fas fa-bell"></i> Notifications
                        <span style="margin-left: auto; background-color: #f5a623; color: white; padding: 2px 6px; border-radius: 10px; font-size: 0.8rem;">3</span>
                    </a>
                    <a href="settings.php" class="profile-link">
                        <i class="fas fa-cog"></i> Account Settings
                    </a>
                </div>
            </div>

            <!-- Middle Column - Feed -->
            <div class="feed-section">
                <!-- Welcome Bar -->
                <div class="welcome-bar">
                    <div class="welcome-message">
                        Welcome back, <strong>Ahmet</strong>! What's your plan for today?
                    </div>
                    <div class="welcome-actions">
                        <div class="welcome-btn">
                            <i class="fas fa-search"></i> Find Events
                        </div>
                        <div class="welcome-btn">
                            <i class="fas fa-user-plus"></i> Find Friends
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div>
                    <div class="section-header">
                        <h2 class="section-title">Your Upcoming Events</h2>
                        <a href="events.php" class="section-link">View All</a>
                    </div>

                    <div class="event-card">
                        <div class="event-header">
                            <img src="/api/placeholder/600/200" alt="Event Image" class="event-image">
                            <div class="event-date-badge">Apr 5, 2025 • 15:00</div>
                            <div class="event-category-badge">Coffee & Cultural</div>
                        </div>
                        <div class="event-body">
                            <h3 class="event-title">Coffee & Cultural Exchange</h3>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Mandabatmaz Coffee, Kadıköy, Istanbul</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>Hosted by You</span>
                                </div>
                            </div>
                            <p class="event-description">
                                Join us for an afternoon of coffee and conversation! Share your travel stories, learn about Turkish culture, and make new friends in a cozy atmosphere.
                            </p>
                            <div class="event-footer">
                                <div class="event-attendees">
                                    <div class="attendee-avatars">
                                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Attendee" class="attendee-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Attendee" class="attendee-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Attendee" class="attendee-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Attendee" class="attendee-avatar">
                                    </div>
                                    <span class="attendee-count">+3 going</span>
                                </div>
                                <div class="event-actions">
                                    <a href="event_management.php?id=1" class="event-action-btn btn-secondary">
                                        <i class="fas fa-cog"></i> Manage
                                    </a>
                                    <a href="event_details.php?id=1" class="event-action-btn btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommended Events -->
                <div>
                    <div class="section-header">
                        <h2 class="section-title">Recommended For You</h2>
                        <a href="events.php?filter=recommended" class="section-link">View All</a>
                    </div>

                    <div class="event-card">
                        <div class="event-header">
                            <img src="/api/placeholder/600/200" alt="Event Image" class="event-image">
                            <div class="event-date-badge">Apr 8, 2025 • 19:00</div>
                            <div class="event-category-badge">Language Exchange</div>
                        </div>
                        <div class="event-body">
                            <h3 class="event-title">International Language Meetup</h3>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Multilingual Café, Şişli, Istanbul</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>Hosted by Sophia Klein</span>
                                </div>
                            </div>
                            <p class="event-description">
                                Practice languages while meeting new people! English, Turkish, Spanish, French, and more. All levels welcome. Structured activities and free conversation time.
                            </p>
                            <div class="event-footer">
                                <div class="event-attendees">
                                    <div class="attendee-avatars">
                                        <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Attendee" class="attendee-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/76.jpg" alt="Attendee" class="attendee-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/91.jpg" alt="Attendee" class="attendee-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Attendee" class="attendee-avatar">
                                    </div>
                                    <span class="attendee-count">+12 going</span>
                                </div>
                                <div class="event-actions">
                                    <a href="#" class="event-action-btn btn-secondary">
                                        <i class="far fa-bookmark"></i> Save
                                    </a>
                                    <a href="event_details.php?id=2" class="event-action-btn btn-primary">
                                        <i class="fas fa-check-circle"></i> Join
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Friend Activity -->
                <div>
                    <div class="section-header">
                        <h2 class="section-title">Friend Activity</h2>
                    </div>

                    <div class="activity-item">
                        <div class="activity-header">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="User" class="activity-avatar">
                            <div class="activity-content">
                                <div class="activity-user">Emma Johnson</div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                        </div>
                        <div class="activity-text">
                            Just signed up for the "Photography Walk in Balat" event. Anyone else going? The historic district has amazing photo opportunities! 📸
                        </div>
                        <img src="/api/placeholder/600/300" alt="Activity Image" class="activity-image">
                        <div class="activity-footer">
                            <div class="activity-actions">
                                <div class="activity-action">
                                    <i class="far fa-heart"></i>
                                    <span>12</span>
                                </div>
                                <div class="activity-action">
                                    <i class="far fa-comment"></i>
                                    <span>4</span>
                                </div>
                                <div class="activity-action">
                                    <i class="far fa-share-square"></i>
                                    <span>Share</span>
                                </div>
                            </div>
                            <a href="event_details.php?id=3" class="activity-action">
                                <i class="fas fa-external-link-alt"></i>
                                <span>View Event</span>
                            </a>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-header">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="User" class="activity-avatar">
                            <div class="activity-content">
                                <div class="activity-user">David Wilson</div>
                                <div class="activity-time">Yesterday</div>
                            </div>
                        </div>
                        <div class="activity-text">
                            Had an amazing time at the "Bosphorus Sunset Cruise" yesterday! The views were incredible and I met some fantastic people. Thanks to @Ahmet for organizing!
                        </div>
                        <div class="activity-footer">
                            <div class="activity-actions">
                                <div class="activity-action">
                                    <i class="far fa-heart"></i>
                                    <span>24</span>
                                </div>
                                <div class="activity-action">
                                    <i class="far fa-comment"></i>
                                    <span>7</span>
                                </div>
                                <div class="activity-action">
                                    <i class="far fa-share-square"></i>
                                    <span>Share</span>
                                </div>
                            </div>
                            <a href="event_reviews.php?id=1" class="activity-action">
                                <i class="fas fa-external-link-alt"></i>
                                <span>View Reviews</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="right-sidebar">
                <!-- Today's Weather -->
                <div class="sidebar-card">
                    <h3>Today's Weather</h3>
                    <div class="weather-widget">
                        <div class="weather-icon">
                            <i class="fas fa-sun"></i>
                        </div>
                        <div class="weather-info">
                            <div class="weather-temp">24°C</div>
                            <div class="weather-location">Istanbul, Turkey</div>
                        </div>
                    </div>
                    <div class="weather-forecast">
                        <div class="forecast-day">
                            <div class="forecast-day-name">Thu</div>
                            <div class="forecast-icon">
                                <i class="fas fa-cloud-sun"></i>
                            </div>
                            <div class="forecast-temp">22°C</div>
                        </div>
                        <div class="forecast-day">
                            <div class="forecast-day-name">Fri</div>
                            <div class="forecast-icon">
                                <i class="fas fa-sun"></i>
                            </div>
                            <div class="forecast-temp">25°C</div>
                        </div>
                        <div class="forecast-day">
                            <div class="forecast-day-name">Sat</div>
                            <div class="forecast-icon">
                                <i class="fas fa-sun"></i>
                            </div>
                            <div class="forecast-temp">26°C</div>
                        </div>
                        <div class="forecast-day">
                            <div class="forecast-day-name">Sun</div>
                            <div class="forecast-icon">
                                <i class="fas fa-cloud"></i>
                            </div>
                            <div class="forecast-temp">23°C</div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="sidebar-card">
                    <h3>You're Attending</h3>
                    <div class="upcoming-events">
                        <div class="upcoming-event">
                            <div class="upcoming-event-date">
                                <div class="date-month">APR</div>
                                <div class="date-day">5</div>
                            </div>
                            <div class="upcoming-event-details">
                                <div class="upcoming-event-title">Coffee & Cultural Exchange</div>
                                <div class="upcoming-event-meta">15:00 • Kadıköy, Istanbul</div>
                            </div>
                        </div>
                        <div class="upcoming-event">
                            <div class="upcoming-event-date">
                                <div class="date-month">APR</div>
                                <div class="date-day">10</div>
                            </div>
                            <div class="upcoming-event-details">
                                <div class="upcoming-event-title">Historical Istanbul Tour</div>
                                <div class="upcoming-event-meta">10:00 • Sultanahmet, Istanbul</div>
                            </div>
                        </div>
                        <div class="upcoming-event">
                            <div class="upcoming-event-date">
                                <div class="date-month">APR</div>
                                <div class="date-day">15</div>
                            </div>
                            <div class="upcoming-event-details">
                                <div class="upcoming-event-title">Turkish Cooking Workshop</div>
                                <div class="upcoming-event-meta">18:00 • Beşiktaş, Istanbul</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Friend Suggestions -->
                <div class="sidebar-card">
                    <h3>People You May Know</h3>
                    <div class="friend-suggestions">
                        <div class="friend-suggestion">
                            <img src="https://randomuser.me/api/portraits/men/82.jpg" alt="Suggested Friend" class="friend-avatar">
                            <div class="friend-info">
                                <div class="friend-name">Alex Thompson</div>
                                <div class="friend-meta">Photographer from London</div>
                                <button class="add-friend-btn">+ Add Friend</button>
                            </div>
                        </div>
                        <div class="friend-suggestion">
                            <img src="https://randomuser.me/api/portraits/women/76.jpg" alt="Suggested Friend" class="friend-avatar">
                            <div class="friend-info">
                                <div class="friend-name">Sophia Klein</div>
                                <div class="friend-meta">Language teacher • 3 mutual friends</div>
                                <button class="add-friend-btn">+ Add Friend</button>
                            </div>
                        </div>
                        <div class="friend-suggestion">
                            <img src="https://randomuser.me/api/portraits/men/91.jpg" alt="Suggested Friend" class="friend-avatar">
                            <div class="friend-info">
                                <div class="friend-name">Carlos Rodriguez</div>
                                <div class="friend-meta">Travel blogger • 2 mutual friends</div>
                                <button class="add-friend-btn">+ Add Friend</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trending Topics -->
                <div class="sidebar-card">
                    <h3>Trending in Istanbul</h3>
                    <div class="trends">
                        <div class="trend-item">
                            <div class="trend-name">Coffee Tasting</div>
                            <div class="trend-count">24 events</div>
                        </div>
                        <div class="trend-item">
                            <div class="trend-name">Boat Tours</div>
                            <div class="trend-count">18 events</div>
                        </div>
                        <div class="trend-item">
                            <div class="trend-name">Photography</div>
                            <div class="trend-count">15 events</div>
                        </div>
                        <div class="trend-item">
                            <div class="trend-name">Language Exchange</div>
                            <div class="trend-count">12 events</div>
                        </div>
                        <div class="trend-item">
                            <div class="trend-name">Hiking</div>
                            <div class="trend-count">9 events</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // User Dropdown Menu
        document.addEventListener('DOMContentLoaded', function() {
            const userMenu = document.getElementById('userMenu');
            const userDropdown = document.getElementById('userDropdown');
            
            userMenu.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent click from immediately bubbling to document
                userDropdown.classList.toggle('show');
            });
            
            // Close dropdown when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (userDropdown.classList.contains('show') && !userMenu.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
            });
        });

        // Like functionality for activity posts
        document.querySelectorAll('.activity-action .fa-heart').forEach(heart => {
            heart.addEventListener('click', function() {
                const likeCount = this.parentElement.querySelector('span');
                if (this.classList.contains('far')) { // Not liked yet
                    this.classList.remove('far');
                    this.classList.add('fas');
                    this.style.color = '#e74c3c';
                    likeCount.textContent = parseInt(likeCount.textContent) + 1;
                } else { // Already liked
                    this.classList.remove('fas');
                    this.classList.add('far');
                    this.style.color = '';
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                }
            });
        });

        // Friend request buttons
        document.querySelectorAll('.add-friend-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.textContent === '+ Add Friend') {
                    this.textContent = 'Request Sent';
                    this.style.backgroundColor = '#27ae60';
                } else {
                    this.textContent = '+ Add Friend';
                    this.style.backgroundColor = '#f5a623';
                }
            });
        });

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
    </script>
</body>
</html>