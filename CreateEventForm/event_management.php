<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Event Management</title>
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

        /* Dashboard Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Card Styles */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .card-body {
            padding: 20px;
        }

        /* Tab Navigation */
        .tab-navigation {
            display: flex;
            border-bottom: 1px solid #eee;
        }

        .tab-item {
            padding: 12px 20px;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            font-weight: 500;
            color: #555;
            transition: all 0.3s ease;
        }

        .tab-item.active {
            color: #f5a623;
            border-bottom-color: #f5a623;
        }

        .tab-item:hover {
            color: #f5a623;
        }

        .tab-content {
            display: none;
            padding: 20px;
        }

        .tab-content.active {
            display: block;
        }

        /* Event List */
        .event-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .event-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
            transition: all 0.3s ease;
        }

        .event-item:hover {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .event-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .event-details {
            flex: 1;
        }

        .event-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
        }

        .event-meta i {
            margin-right: 5px;
        }

        .event-stats {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .event-stat {
            font-size: 0.9rem;
            color: #333;
        }

        .event-stat i {
            margin-right: 5px;
            color: #f5a623;
        }

        /* Actions menu */
        .event-actions {
            display: flex;
            gap: 10px;
        }

        .event-action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
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

        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Attendee List */
        .attendee-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .attendee-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .attendee-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .attendee-details {
            flex: 1;
        }

        .attendee-name {
            font-weight: 500;
            margin-bottom: 3px;
        }

        .attendee-meta {
            font-size: 0.85rem;
            color: #666;
        }

        .attendee-actions {
            display: flex;
            gap: 10px;
        }

        .attendee-action {
            color: #555;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 5px;
            cursor: pointer;
        }

        .attendee-action:hover {
            color: #f5a623;
        }

        /* Event Analytics */
        .analytics-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .analytic-item {
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .analytic-value {
            font-size: 1.8rem;
            font-weight: 600;
            color: #f5a623;
            margin-bottom: 5px;
        }

        .analytic-label {
            font-size: 0.9rem;
            color: #666;
        }

        .chart-container {
            height: 250px;
            background-color: #f0f0f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            margin-bottom: 20px;
        }

        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .stat-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .stat-card-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #f5a623;
            margin-bottom: 5px;
        }

        .stat-card-label {
            font-size: 0.85rem;
            color: #666;
        }

        /* Recent Activity */
        .activity-list {
            display: flex;
            flex-direction: column;
        }

        .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-content {
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #666;
        }

        /* Upcoming Events */
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

        /* Responsive Styles */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .analytics-box {
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

        /* Attendee Request Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 20;
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .modal-close {
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Search Input */
        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            padding-left: 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
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
                        <li><a href="events.php" class="active">Events</a></li>
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
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Event Management</h1>
            <a href="create_event.php" class="event-action-btn btn-primary">
                <i class="fas fa-plus"></i> Create New Event
            </a>
        </div>

        <!-- Dashboard Layout -->
        <div class="dashboard-grid">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Events Management Card -->
                <div class="card">
                    <div class="tab-navigation">
                        <div class="tab-item active" data-tab="upcoming">Upcoming Events</div>
                        <div class="tab-item" data-tab="past">Past Events</div>
                        <div class="tab-item" data-tab="draft">Drafts</div>
                        <div class="tab-item" data-tab="cancelled">Cancelled</div>
                    </div>

                    <!-- Tab Content: Upcoming Events -->
                    <div class="tab-content active" id="upcoming-content">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Search your events...">
                        </div>

                        <div class="event-list">
                            <!-- Event 1 -->
                            <div class="event-item">
                                <img src="/api/placeholder/100/100" alt="Event Image" class="event-image">
                                <div class="event-details">
                                    <div class="event-title">Coffee & Cultural Exchange</div>
                                    <div class="event-meta">
                                        <span><i class="far fa-calendar"></i> Apr 5, 2025</span>
                                        <span><i class="far fa-clock"></i> 15:00 - 17:00</span>
                                        <span><i class="fas fa-map-marker-alt"></i> Kadıköy, Istanbul</span>
                                    </div>
                                    <div class="event-stats">
                                        <div class="event-stat">
                                            <i class="fas fa-users"></i> 7/12 Attendees
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-user-plus"></i> 3 Pending Requests
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-eye"></i> 156 Views
                                        </div>
                                    </div>
                                </div>
                                <div class="event-actions">
                                    <a href="#" class="event-action-btn btn-secondary" onclick="openAttendeeModal()">
                                        <i class="fas fa-user-check"></i> Requests
                                    </a>
                                    <a href="event_details.php?id=1" class="event-action-btn btn-secondary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="edit_event.php?id=1" class="event-action-btn btn-secondary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="event-action-btn btn-danger">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>

                            <!-- Event 2 -->
                            <div class="event-item">
                                <img src="CreateEventForm/event_image.webp" alt="Event Image" class="event-image">
                                <div class="event-details">
                                    <div class="event-title">Hiking Belgrad Forest</div>
                                    <div class="event-meta">
                                        <span><i class="far fa-calendar"></i> Apr 8, 2025</span>
                                        <span><i class="far fa-clock"></i> 09:00 - 14:00</span>
                                        <span><i class="fas fa-map-marker-alt"></i> Belgrad Forest, Istanbul</span>
                                    </div>
                                    <div class="event-stats">
                                        <div class="event-stat">
                                            <i class="fas fa-users"></i> 8/15 Attendees
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-user-plus"></i> 2 Pending Requests
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-eye"></i> 124 Views
                                        </div>
                                    </div>
                                </div>
                                <div class="event-actions">
                                    <a href="#" class="event-action-btn btn-secondary" onclick="openAttendeeModal()">
                                        <i class="fas fa-user-check"></i> Requests
                                    </a>
                                    <a href="event_details.php?id=2" class="event-action-btn btn-secondary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="edit_event.php?id=2" class="event-action-btn btn-secondary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="event-action-btn btn-danger">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>

                            <!-- Event 3 -->
                            <div class="event-item">
                                <img src="/api/placeholder/100/100" alt="Event Image" class="event-image">
                                <div class="event-details">
                                    <div class="event-title">Historical Istanbul Tour</div>
                                    <div class="event-meta">
                                        <span><i class="far fa-calendar"></i> Apr 10, 2025</span>
                                        <span><i class="far fa-clock"></i> 10:00 - 15:00</span>
                                        <span><i class="fas fa-map-marker-alt"></i> Sultanahmet, Istanbul</span>
                                    </div>
                                    <div class="event-stats">
                                        <div class="event-stat">
                                            <i class="fas fa-users"></i> 12/20 Attendees
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-user-plus"></i> 5 Pending Requests
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-eye"></i> 198 Views
                                        </div>
                                    </div>
                                </div>
                                <div class="event-actions">
                                    <a href="#" class="event-action-btn btn-secondary" onclick="openAttendeeModal()">
                                        <i class="fas fa-user-check"></i> Requests
                                    </a>
                                    <a href="event_details.php?id=3" class="event-action-btn btn-secondary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="edit_event.php?id=3" class="event-action-btn btn-secondary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="event-action-btn btn-danger">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Past Events -->
                    <div class="tab-content" id="past-content">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Search past events...">
                        </div>

                        <div class="event-list">
                            <!-- Past Event 1 -->
                            <div class="event-item">
                                <img src="/api/placeholder/100/100" alt="Event Image" class="event-image">
                                <div class="event-details">
                                    <div class="event-title">Bosphorus Sunset Cruise</div>
                                    <div class="event-meta">
                                        <span><i class="far fa-calendar"></i> Mar 18, 2025</span>
                                        <span><i class="far fa-clock"></i> 17:30 - 20:30</span>
                                        <span><i class="fas fa-map-marker-alt"></i> Eminönü, Istanbul</span>
                                    </div>
                                    <div class="event-stats">
                                        <div class="event-stat">
                                            <i class="fas fa-users"></i> 18/25 Attended
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-comment"></i> 12 Reviews
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-star"></i> 4.8/5 Rating
                                        </div>
                                    </div>
                                </div>
                                <div class="event-actions">
                                    <a href="event_reviews.php?id=4" class="event-action-btn btn-secondary">
                                        <i class="fas fa-star"></i> Reviews
                                    </a>
                                    <a href="event_details.php?id=4" class="event-action-btn btn-secondary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="#" class="event-action-btn btn-secondary">
                                        <i class="fas fa-copy"></i> Recreate
                                    </a>
                                </div>
                            </div>

                            <!-- Past Event 2 -->
                            <div class="event-item">
                                <img src="/api/placeholder/100/100" alt="Event Image" class="event-image">
                                <div class="event-details">
                                    <div class="event-title">Language Exchange Meetup</div>
                                    <div class="event-meta">
                                        <span><i class="far fa-calendar"></i> Mar 5, 2025</span>
                                        <span><i class="far fa-clock"></i> 19:00 - 22:00</span>
                                        <span><i class="fas fa-map-marker-alt"></i> Şişli, Istanbul</span>
                                    </div>
                                    <div class="event-stats">
                                        <div class="event-stat">
                                            <i class="fas fa-users"></i> 14/20 Attended
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-comment"></i> 8 Reviews
                                        </div>
                                        <div class="event-stat">
                                            <i class="fas fa-star"></i> 4.5/5 Rating
                                        </div>
                                    </div>
                                </div>
                                <div class="event-actions">
                                    <a href="event_reviews.php?id=5" class="event-action-btn btn-secondary">
                                        <i class="fas fa-star"></i> Reviews
                                    </a>
                                    <a href="event_details.php?id=5" class="event-action-btn btn-secondary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="#" class="event-action-btn btn-secondary">
                                        <i class="fas fa-copy"></i> Recreate
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Drafts -->
                    <div class="tab-content" id="draft-content">
                        <div class="event-list">
                            <!-- Draft Event 1 -->
                            <div class="event-item">
                                <img src="/api/placeholder/100/100" alt="Event Image" class="event-image">
                                <div class="event-details">
                                    <div class="event-title">Rooftop Jazz Night (Draft)</div>
                                    <div class="event-meta">
                                        <span><i class="far fa-calendar"></i> Not set</span>
                                        <span><i class="far fa-clock"></i> Not set</span>
                                        <span><i class="fas fa-map-marker-alt"></i> Beyoğlu, Istanbul</span>
                                    </div>
                                    <div class="event-meta">
                                        <span><i class="far fa-edit"></i> Last edited on Apr 1, 2025</span>
                                    </div>
                                </div>
                                <div class="event-actions">
                                    <a href="edit_event.php?id=6" class="event-action-btn btn-secondary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="event-action-btn btn-primary">
                                        <i class="fas fa-check"></i> Publish
                                    </a>
                                    <a href="#" class="event-action-btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Cancelled -->
                    <div class="tab-content" id="cancelled-content">
                        <div class="event-list">
                            <!-- Cancelled Event 1 -->
                            <div class="event-item">
                                <img src="/api/placeholder/100/100" alt="Event Image" class="event-image">
                                <div class="event-details">
                                    <div class="event-title">Picnic in Maçka Park (Cancelled)</div>
                                    <div class="event-meta">
                                        <span><i class="far fa-calendar"></i> Apr 2, 2025</span>
                                        <span><i class="far fa-clock"></i> 12:00 - 16:00</span>
                                        <span><i class="fas fa-map-marker-alt"></i> Maçka Park, Istanbul</span>
                                    </div>
                                    <div class="event-meta">
                                        <span><i class="fas fa-ban"></i> Cancelled on Mar 30, 2025 due to weather</span>
                                    </div>
                                    <div class="event-stats">
                                        <div class="event-stat">
                                            <i class="fas fa-users"></i> 10 Registered (Notified)
                                        </div>
                                    </div>
                                </div>
                                <div class="event-actions">
                                    <a href="#" class="event-action-btn btn-secondary">
                                        <i class="fas fa-copy"></i> Recreate
                                    </a>
                                    <a href="#" class="event-action-btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendees Management -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Attendee Management</h2>
                        <select id="event-selector" class="event-action-btn btn-secondary">
                            <option value="1">Coffee & Cultural Exchange</option>
                            <option value="2">Hiking Belgrad Forest</option>
                            <option value="3">Historical Istanbul Tour</option>
                        </select>
                    </div>
                    <div class="card-body attendee-list">
                        <!-- Attendee 1 -->
                        <div class="attendee-item">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Attendee" class="attendee-avatar">
                            <div class="attendee-details">
                                <div class="attendee-name">Emma Johnson</div>
                                <div class="attendee-meta">Joined Apr 1, 2025 • First-time attendee</div>
                            </div>
                            <div class="attendee-actions">
                                <a href="profile.php?id=101" class="attendee-action">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <a href="#" class="attendee-action">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                                <a href="#" class="attendee-action" style="color: #e74c3c;">
                                    <i class="fas fa-user-times"></i> Remove
                                </a>
                            </div>
                        </div>

                        <!-- Attendee 2 -->
                        <div class="attendee-item">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Attendee" class="attendee-avatar">
                            <div class="attendee-details">
                                <div class="attendee-name">David Wilson</div>
                                <div class="attendee-meta">Joined Mar 30, 2025 • Attended 3 of your events</div>
                            </div>
                            <div class="attendee-actions">
                                <a href="profile.php?id=102" class="attendee-action">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <a href="#" class="attendee-action">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                                <a href="#" class="attendee-action" style="color: #e74c3c;">
                                    <i class="fas fa-user-times"></i> Remove
                                </a>
                            </div>
                        </div>

                        <!-- Attendee 3 -->
                        <div class="attendee-item">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Attendee" class="attendee-avatar">
                            <div class="attendee-details">
                                <div class="attendee-name">Olivia Martinez</div>
                                <div class="attendee-meta">Joined Apr 2, 2025 • Attended 1 of your events</div>
                            </div>
                            <div class="attendee-actions">
                                <a href="profile.php?id=103" class="attendee-action">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <a href="#" class="attendee-action">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                                <a href="#" class="attendee-action" style="color: #e74c3c;">
                                    <i class="fas fa-user-times"></i> Remove
                                </a>
                            </div>
                        </div>

                        <!-- More attendees... -->
                        <div class="attendee-item">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Attendee" class="attendee-avatar">
                            <div class="attendee-details">
                                <div class="attendee-name">Michael Brown</div>
                                <div class="attendee-meta">Joined Mar 29, 2025 • Attended 2 of your events</div>
                            </div>
                            <div class="attendee-actions">
                                <a href="profile.php?id=104" class="attendee-action">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <a href="#" class="attendee-action">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                                <a href="#" class="attendee-action" style="color: #e74c3c;">
                                    <i class="fas fa-user-times"></i> Remove
                                </a>
                            </div>
                        </div>

                        <div class="attendee-item">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Attendee" class="attendee-avatar">
                            <div class="attendee-details">
                                <div class="attendee-name">Sophie Chen</div>
                                <div class="attendee-meta">Joined Apr 1, 2025 • First-time attendee</div>
                            </div>
                            <div class="attendee-actions">
                                <a href="profile.php?id=105" class="attendee-action">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <a href="#" class="attendee-action">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                                <a href="#" class="attendee-action" style="color: #e74c3c;">
                                    <i class="fas fa-user-times"></i> Remove
                                </a>
                            </div>
                        </div>

                        <div class="attendee-item">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Attendee" class="attendee-avatar">
                            <div class="attendee-details">
                                <div class="attendee-name">James Taylor</div>
                                <div class="attendee-meta">Joined Mar 28, 2025 • Attended 4 of your events</div>
                            </div>
                            <div class="attendee-actions">
                                <a href="profile.php?id=106" class="attendee-action">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <a href="#" class="attendee-action">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                                <a href="#" class="attendee-action" style="color: #e74c3c;">
                                    <i class="fas fa-user-times"></i> Remove
                                </a>
                            </div>
                        </div>

                        <div class="attendee-item">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Attendee" class="attendee-avatar">
                            <div class="attendee-details">
                                <div class="attendee-name">Isabella Johnson</div>
                                <div class="attendee-meta">Joined Apr 2, 2025 • First-time attendee</div>
                            </div>
                            <div class="attendee-actions">
                                <a href="profile.php?id=107" class="attendee-action">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <a href="#" class="attendee-action">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                                <a href="#" class="attendee-action" style="color: #e74c3c;">
                                    <i class="fas fa-user-times"></i> Remove
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Analytics -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Event Analytics</h2>
                        <select id="event-analytics-selector" class="event-action-btn btn-secondary">
                            <option value="1">Coffee & Cultural Exchange</option>
                            <option value="2">Hiking Belgrad Forest</option>
                            <option value="3">Historical Istanbul Tour</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="analytics-box">
                            <div class="analytic-item">
                                <div class="analytic-value">156</div>
                                <div class="analytic-label">Page Views</div>
                            </div>
                            <div class="analytic-item">
                                <div class="analytic-value">32</div>
                                <div class="analytic-label">Interested Clicks</div>
                            </div>
                            <div class="analytic-item">
                                <div class="analytic-value">7</div>
                                <div class="analytic-label">Confirmed Attendees</div>
                            </div>
                            <div class="analytic-item">
                                <div class="analytic-value">3</div>
                                <div class="analytic-label">Pending Requests</div>
                            </div>
                        </div>

                        <div class="chart-container">
                            <div>
                                <i class="fas fa-chart-line fa-3x"></i>
                                <p>View Traffic Chart</p>
                            </div>
                        </div>

                        <div class="chart-container">
                            <div>
                                <i class="fas fa-chart-pie fa-3x"></i>
                                <p>Attendee Demographics</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Quick Stats -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Quick Stats</h2>
                    </div>
                    <div class="card-body">
                        <div class="quick-stats">
                            <div class="stat-card">
                                <div class="stat-card-value">24</div>
                                <div class="stat-card-label">Total Events</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-value">356</div>
                                <div class="stat-card-label">Total Attendees</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-value">4.7</div>
                                <div class="stat-card-label">Average Rating</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-value">3</div>
                                <div class="stat-card-label">Upcoming Events</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Activity</h2>
                    </div>
                    <div class="card-body">
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-content">
                                    <strong>Emma Johnson</strong> joined your "Coffee & Cultural Exchange" event.
                                </div>
                                <div class="activity-time">30 minutes ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-content">
                                    <strong>David Wilson</strong> requested to join your "Hiking Belgrad Forest" event.
                                </div>
                                <div class="activity-time">1 hour ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-content">
                                    <strong>Sophie Chen</strong> left a comment on your "Historical Istanbul Tour" event.
                                </div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-content">
                                    <strong>Michael Brown</strong> left a 5-star review for your "Bosphorus Sunset Cruise" event.
                                </div>
                                <div class="activity-time">1 day ago</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-content">
                                    <strong>Olivia Martinez</strong> shared your "Coffee & Cultural Exchange" event.
                                </div>
                                <div class="activity-time">1 day ago</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Your Upcoming Events</h2>
                    </div>
                    <div class="card-body">
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
                                    <div class="date-day">8</div>
                                </div>
                                <div class="upcoming-event-details">
                                    <div class="upcoming-event-title">Hiking Belgrad Forest</div>
                                    <div class="upcoming-event-meta">09:00 • Belgrad Forest, Istanbul</div>
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
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Quick Links</h2>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <a href="create_event.php" class="event-action-btn btn-primary" style="text-align: center;">
                                <i class="fas fa-plus"></i> Create Event
                            </a>
                            <a href="messages.php" class="event-action-btn btn-secondary" style="text-align: center;">
                                <i class="fas fa-envelope"></i> Messages
                            </a>
                            <a href="notifications.php" class="event-action-btn btn-secondary" style="text-align: center;">
                                <i class="fas fa-bell"></i> Notifications
                            </a>
                            <a href="help.php" class="event-action-btn btn-secondary" style="text-align: center;">
                                <i class="fas fa-question-circle"></i> Help & Resources
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendee Request Modal -->
    <div class="modal" id="attendeeRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Pending Join Requests (3)</h3>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Request 1 -->
                <div class="attendee-item">
                    <img src="https://randomuser.me/api/portraits/men/82.jpg" alt="Requestor" class="attendee-avatar">
                    <div class="attendee-details">
                        <div class="attendee-name">Alex Thompson</div>
                        <div class="attendee-meta">Requested Apr 2, 2025 • First-time attendee</div>
                        <div class="attendee-meta" style="margin-top: 5px;">
                            <i class="fas fa-comment"></i> "I'm excited to join this cultural exchange! I've been in Istanbul for just a month."
                        </div>
                    </div>
                </div>

                <!-- Request 2 -->
                <div class="attendee-item">
                    <img src="https://randomuser.me/api/portraits/women/76.jpg" alt="Requestor" class="attendee-avatar">
                    <div class="attendee-details">
                        <div class="attendee-name">Sophia Klein</div>
                        <div class="attendee-meta">Requested Apr 1, 2025 • Attended 1 of your events</div>
                        <div class="attendee-meta" style="margin-top: 5px;">
                            <i class="fas fa-comment"></i> "Really enjoyed your last event, would love to join this one too!"
                        </div>
                    </div>
                </div>

                <!-- Request 3 -->
                <div class="attendee-item">
                    <img src="https://randomuser.me/api/portraits/men/91.jpg" alt="Requestor" class="attendee-avatar">
                    <div class="attendee-details">
                        <div class="attendee-name">Carlos Rodriguez</div>
                        <div class="attendee-meta">Requested Apr 3, 2025 • First-time attendee</div>
                        <div class="attendee-meta" style="margin-top: 5px;">
                            <i class="fas fa-comment"></i> "I'd like to practice my Turkish and meet new people!"
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="event-action-btn btn-secondary" onclick="closeAttendeeModal()">Close</button>
                <button class="event-action-btn btn-primary">Approve All</button>
            </div>
        </div>
    </div>

    <script>
        // Tab Navigation
        document.addEventListener('DOMContentLoaded', function() {
            const tabItems = document.querySelectorAll('.tab-item');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabItems.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabItems.forEach(item => {
                        item.classList.remove('active');
                    });
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Show corresponding tab content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(`${tabId}-content`).classList.add('active');
                });
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

        // Attendee request modal
        function openAttendeeModal() {
            document.getElementById('attendeeRequestModal').classList.add('show');
        }
        
        function closeAttendeeModal() {
            document.getElementById('attendeeRequestModal').classList.remove('show');
        }
        
        // Close modal when clicking the X
        document.querySelector('.modal-close').addEventListener('click', closeAttendeeModal);
        
        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('attendeeRequestModal');
            if (event.target === modal) {
                closeAttendeeModal();
            }
        });

        // Event selector change handler
        document.getElementById('event-selector').addEventListener('change', function() {
            // In a real application, this would fetch and update the attendee list
            console.log('Selected event ID:', this.value);
        });

        // Analytics selector change handler
        document.getElementById('event-analytics-selector').addEventListener('change', function() {
            // In a real application, this would fetch and update the analytics data
            console.log('Selected event for analytics:', this.value);
        });

        // Search functionality for events
        document.querySelectorAll('.search-input').forEach(input => {
            input.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                const tabContent = this.closest('.tab-content');
                const eventItems = tabContent.querySelectorAll('.event-item');
                
                eventItems.forEach(item => {
                    const title = item.querySelector('.event-title').textContent.toLowerCase();
                    const meta = item.querySelector('.event-meta').textContent.toLowerCase();
                    
                    if (title.includes(query) || meta.includes(query)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>