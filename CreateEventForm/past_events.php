<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Past Events Archive</title>
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

        /* Button Styles */
        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
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

        /* Archive Container */
        .archive-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 20px;
        }

        /* Sidebar Filters */
        .filters-sidebar {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: fit-content;
        }

        .filter-section {
            margin-bottom: 25px;
        }

        .filter-section:last-child {
            margin-bottom: 0;
        }

        .filter-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .filter-select, .filter-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .filter-date-range {
            display: flex;
            gap: 10px;
        }

        .filter-date-range input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .checkbox-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .checkbox-item input {
            margin-right: 10px;
        }

        .tag-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag-filter {
            background-color: #f0f0f0;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tag-filter:hover, .tag-filter.active {
            background-color: #f5a623;
            color: white;
        }

        .filter-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .filter-btn {
            flex: 1;
            padding: 8px 0;
            text-align: center;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .apply-btn {
            background-color: #f5a623;
            color: white;
            border: none;
            margin-right: 5px;
        }

        .apply-btn:hover {
            background-color: #e5941d;
        }

        .reset-btn {
            background-color: transparent;
            color: #333;
            border: 1px solid #ddd;
            margin-left: 5px;
        }

        .reset-btn:hover {
            background-color: #f5f5f5;
        }

        /* Events Content */
        .events-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Search and Sort Bar */
        .search-sort-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
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

        .sort-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sort-by-label {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sort-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .view-switcher {
            display: flex;
            gap: 5px;
        }

        .view-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-btn.active, .view-btn:hover {
            background-color: #f5a623;
            color: white;
            border-color: #f5a623;
        }

        /* Events Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .event-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .event-image {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .event-details {
            padding: 15px;
        }

        .event-date-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
        }

        .event-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .event-meta i {
            width: 20px;
            text-align: center;
            margin-right: 5px;
            color: #f5a623;
        }

        .event-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .event-stat {
            display: flex;
            align-items: center;
        }

        .event-stat i {
            margin-right: 5px;
            color: #f5a623;
        }

        /* Events List View */
        .events-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .event-list-item {
            display: flex;
            gap: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-list-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .event-list-image {
            width: 200px;
            height: 150px;
            object-fit: cover;
        }

        .event-list-details {
            flex: 1;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .event-list-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .event-list-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .event-list-meta i {
            margin-right: 5px;
            color: #f5a623;
        }

        .event-list-stats {
            display: flex;
            gap: 20px;
            margin-top: auto;
            font-size: 0.9rem;
        }

        .event-list-stat {
            display: flex;
            align-items: center;
        }

        .event-list-stat i {
            margin-right: 5px;
            color: #f5a623;
        }

        .event-list-actions {
            display: flex;
            gap: 10px;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .event-action-btn {
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .event-action-btn i {
            margin-right: 5px;
        }

        /* Event Badge */
        .event-badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 0.75rem;
            border-radius: 3px;
            color: white;
            margin-right: 5px;
        }

        .badge-hosted {
            background-color: #3498db;
        }

        .badge-attended {
            background-color: #2ecc71;
        }

        /* Rating Stars */
        .rating-stars {
            color: #f5a623;
            font-size: 0.9rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 5px;
        }

        .pagination-item {
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-item:hover {
            background-color: #f5f5f5;
        }

        .pagination-item.active {
            background-color: #f5a623;
            color: white;
            border-color: #f5a623;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 50px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .no-results-icon {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-results-text {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .archive-container {
                grid-template-columns: 1fr;
            }
            
            .event-list-item {
                flex-direction: column;
            }
            
            .event-list-image {
                width: 100%;
                height: 180px;
            }
            
            .search-sort-bar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .search-box {
                width: 100%;
                max-width: none;
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
            <h1 class="page-title">Past Events Archive</h1>
            <a href="event_management.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Management
            </a>
        </div>

        <!-- Archive Container -->
        <div class="archive-container">
            <!-- Filters Sidebar -->
            <div class="filters-sidebar">
                <div class="filter-section">
                    <h3 class="filter-title">Filters</h3>
                    <div class="filter-group">
                        <label class="filter-label">My Role</label>
                        <select class="filter-select">
                            <option value="all">All Events</option>
                            <option value="hosted">Events I Hosted</option>
                            <option value="attended">Events I Attended</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Date Range</label>
                        <div class="filter-date-range">
                            <input type="date" placeholder="From">
                            <input type="date" placeholder="To">
                        </div>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Location</label>
                        <select class="filter-select">
                            <option value="">All Locations</option>
                            <option value="istanbul">Istanbul</option>
                            <option value="ankara">Ankara</option>
                            <option value="izmir">Izmir</option>
                            <option value="antalya">Antalya</option>
                        </select>
                    </div>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Categories</h3>
                    <div class="checkbox-list">
                        <label class="checkbox-item">
                            <input type="checkbox" value="coffee"> Coffee & Drinks
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="cultural"> Cultural
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="outdoor"> Sports & Outdoor
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="language"> Language Exchange
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="food"> Food & Dining
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="art"> Art & Music
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="tech"> Technology
                        </label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Rating</h3>
                    <div class="checkbox-list">
                        <label class="checkbox-item">
                            <input type="checkbox" value="5"> ★★★★★ (5 Stars)
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="4"> ★★★★☆ (4 Stars)
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="3"> ★★★☆☆ (3 Stars)
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="2"> ★★☆☆☆ (2 Stars)
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" value="1"> ★☆☆☆☆ (1 Star)
                        </label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Popular Tags</h3>
                    <div class="tag-list">
                        <div class="tag-filter">Coffee</div>
                        <div class="tag-filter">Cultural</div>
                        <div class="tag-filter">Hiking</div>
                        <div class="tag-filter">Language</div>
                        <div class="tag-filter">Food</div>
                        <div class="tag-filter">Music</div>
                        <div class="tag-filter">Networking</div>
                        <div class="tag-filter">Outdoor</div>
                        <div class="tag-filter">Travel</div>
                    </div>
                </div>

                <div class="filter-actions">
                    <button class="filter-btn apply-btn">Apply Filters</button>
                    <button class="filter-btn reset-btn">Reset</button>
                </div>
            </div>

            <!-- Events Content -->
            <div class="events-content">
                <!-- Search and Sort Bar -->
                <div class="search-sort-bar">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search events by title, location, etc.">
                    </div>
                    <div class="sort-controls">
                        <span class="sort-by-label">Sort by:</span>
                        <select class="sort-select">
                            <option value="date_desc">Date (Newest)</option>
                            <option value="date_asc">Date (Oldest)</option>
                            <option value="rating_desc">Rating (Highest)</option>
                            <option value="attendees_desc">Attendees (Most)</option>
                            <option value="title_asc">Title (A-Z)</option>
                        </select>
                        <div class="view-switcher">
                            <button class="view-btn" id="grid-view-btn" title="Grid View">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="view-btn active" id="list-view-btn" title="List View">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Events List View (Default) -->
                <div class="events-list" id="events-list-view">
                    <!-- Event 1 -->
                    <div class="event-list-item">
                        <img src="/api/placeholder/200/150" alt="Event" class="event-list-image">
                        <div class="event-list-details">
                            <div>
                                <span class="event-badge badge-hosted">Hosted</span>
                                <h3 class="event-list-title">Bosphorus Sunset Cruise</h3>
                            </div>
                            <div class="event-list-meta">
                                <span><i class="far fa-calendar"></i> Mar 18, 2025</span>
                                <span><i class="far fa-clock"></i> 17:30 - 20:30</span>
                                <span><i class="fas fa-map-marker-alt"></i> Eminönü, Istanbul</span>
                            </div>
                            <div class="event-list-stats">
                                <div class="event-list-stat">
                                    <i class="fas fa-users"></i> 18/25 Attended
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-comment"></i> 12 Reviews
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-star"></i> 4.8/5 Rating
                                </div>
                            </div>
                        </div>
                        <div class="event-list-actions">
                            <a href="event_details.php?id=1" class="event-action-btn btn-secondary">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="event_reviews.php?id=1" class="event-action-btn btn-secondary">
                                <i class="fas fa-star"></i> Reviews
                            </a>
                            <a href="#" class="event-action-btn btn-secondary">
                                <i class="fas fa-copy"></i> Recreate
                            </a>
                        </div>
                    </div>

                    <!-- Event 2 -->
                    <div class="event-list-item">
                        <img src="/api/placeholder/200/150" alt="Event" class="event-list-image">
                        <div class="event-list-details">
                            <div>
                                <span class="event-badge badge-attended">Attended</span>
                                <h3 class="event-list-title">Language Exchange Meetup</h3>
                            </div>
                            <div class="event-list-meta">
                                <span><i class="far fa-calendar"></i> Mar 5, 2025</span>
                                <span><i class="far fa-clock"></i> 19:00 - 22:00</span>
                                <span><i class="fas fa-map-marker-alt"></i> Şişli, Istanbul</span>
                            </div>
                            <div class="event-list-stats">
                                <div class="event-list-stat">
                                    <i class="fas fa-users"></i> 14/20 Attended
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-user"></i> Hosted by Sophia Klein
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-star"></i> 4.5/5 Rating
                                </div>
                            </div>
                        </div>
                        <div class="event-list-actions">
                            <a href="event_details.php?id=2" class="event-action-btn btn-secondary">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="#" class="event-action-btn btn-secondary">
                                <i class="fas fa-star"></i> Rate Event
                            </a>
                            <a href="#" class="event-action-btn btn-secondary">
                                <i class="fas fa-envelope"></i> Contact Host
                            </a>
                        </div>
                    </div>

                    <!-- Event 3 -->
                    <div class="event-list-item">
                        <img src="/api/placeholder/200/150" alt="Event" class="event-list-image">
                        <div class="event-list-details">
                            <div>
                                <span class="event-badge badge-hosted">Hosted</span>
                                <h3 class="event-list-title">Turkish Cooking Workshop</h3>
                            </div>
                            <div class="event-list-meta">
                                <span><i class="far fa-calendar"></i> Feb 20, 2025</span>
                                <span><i class="far fa-clock"></i> 18:00 - 21:00</span>
                                <span><i class="fas fa-map-marker-alt"></i> Beşiktaş, Istanbul</span>
                            </div>
                            <div class="event-list-stats">
                                <div class="event-list-stat">
                                    <i class="fas fa-users"></i> 10/12 Attended
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-comment"></i> 8 Reviews
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-star"></i> 4.9/5 Rating
                                </div>
                            </div>
                        </div>
                        <div class="event-list-actions">
                            <a href="event_details.php?id=3" class="event-action-btn btn-secondary">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="event_reviews.php?id=3" class="event-action-btn btn-secondary">
                                <i class="fas fa-star"></i> Reviews
                            </a>
                            <a href="#" class="event-action-btn btn-secondary">
                                <i class="fas fa-copy"></i> Recreate
                            </a>
                        </div>
                    </div>

                    <!-- Event 4 -->
                    <div class="event-list-item">
                        <img src="/api/placeholder/200/150" alt="Event" class="event-list-image">
                        <div class="event-list-details">
                            <div>
                                <span class="event-badge badge-attended">Attended</span>
                                <h3 class="event-list-title">Historical Tour of Sultanahmet</h3>
                            </div>
                            <div class="event-list-meta">
                                <span><i class="far fa-calendar"></i> Feb 15, 2025</span>
                                <span><i class="far fa-clock"></i> 10:00 - 14:00</span>
                                <span><i class="fas fa-map-marker-alt"></i> Sultanahmet, Istanbul</span>
                            </div>
                            <div class="event-list-stats">
                                <div class="event-list-stat">
                                    <i class="fas fa-users"></i> 12/15 Attended
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-user"></i> Hosted by Mehmet Yılmaz
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-star"></i> 4.7/5 Rating
                                </div>
                            </div>
                        </div>
                        <div class="event-list-actions">
                            <a href="event_details.php?id=4" class="event-action-btn btn-secondary">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="#" class="event-action-btn btn-secondary">
                                <i class="fas fa-star"></i> Rate Event
                            </a>
                            <a href="#" class="event-action-btn btn-secondary">
                                <i class="fas fa-envelope"></i> Contact Host
                            </a>
                        </div>
                    </div>

                    <!-- Event 5 -->
                    <div class="event-list-item">
                        <img src="/api/placeholder/200/150" alt="Event" class="event-list-image">
                        <div class="event-list-details">
                            <div>
                                <span class="event-badge badge-hosted">Hosted</span>
                                <h3 class="event-list-title">Photography Walk in Balat</h3>
                            </div>
                            <div class="event-list-meta">
                                <span><i class="far fa-calendar"></i> Feb 8, 2025</span>
                                <span><i class="far fa-clock"></i> 14:00 - 17:00</span>
                                <span><i class="fas fa-map-marker-alt"></i> Balat, Istanbul</span>
                            </div>
                            <div class="event-list-stats">
                                <div class="event-list-stat">
                                    <i class="fas fa-users"></i> 8/10 Attended
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-comment"></i> 6 Reviews
                                </div>
                                <div class="event-list-stat">
                                    <i class="fas fa-star"></i> 4.6/5 Rating
                                </div>
                            </div>
                        </div>
                        <div class="event-list-actions">
                            <a href="event_details.php?id=5" class="event-action-btn btn-secondary">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="event_reviews.php?id=5" class="event-action-btn btn-secondary">
                                <i class="fas fa-star"></i> Reviews
                            </a>
                            <a href="#" class="event-action-btn btn-secondary">
                                <i class="fas fa-copy"></i> Recreate
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Events Grid View (Hidden by Default) -->
                <div class="events-grid" id="events-grid-view" style="display: none;">
                    <!-- Event 1 -->
                    <div class="event-card">
                        <img src="/api/placeholder/300/160" alt="Event" class="event-image">
                        <div class="event-details">
                            <span class="event-badge badge-hosted">Hosted</span>
                            <h3 class="event-title">Bosphorus Sunset Cruise</h3>
                            <div class="event-meta">
                                <div><i class="far fa-calendar"></i> Mar 18, 2025</div>
                                <div><i class="far fa-clock"></i> 17:30 - 20:30</div>
                                <div><i class="fas fa-map-marker-alt"></i> Eminönü, Istanbul</div>
                            </div>
                            <div class="event-stats">
                                <div class="event-stat">
                                    <i class="fas fa-users"></i> 18/25
                                </div>
                                <div class="event-stat">
                                    <i class="fas fa-star"></i> 4.8/5
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event 2 -->
                    <div class="event-card">
                        <img src="/api/placeholder/300/160" alt="Event" class="event-image">
                        <div class="event-details">
                            <span class="event-badge badge-attended">Attended</span>
                            <h3 class="event-title">Language Exchange Meetup</h3>
                            <div class="event-meta">
                                <div><i class="far fa-calendar"></i> Mar 5, 2025</div>
                                <div><i class="far fa-clock"></i> 19:00 - 22:00</div>
                                <div><i class="fas fa-map-marker-alt"></i> Şişli, Istanbul</div>
                            </div>
                            <div class="event-stats">
                                <div class="event-stat">
                                    <i class="fas fa-users"></i> 14/20
                                </div>
                                <div class="event-stat">
                                    <i class="fas fa-star"></i> 4.5/5
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event 3 -->
                    <div class="event-card">
                        <img src="/api/placeholder/300/160" alt="Event" class="event-image">
                        <div class="event-details">
                            <span class="event-badge badge-hosted">Hosted</span>
                            <h3 class="event-title">Turkish Cooking Workshop</h3>
                            <div class="event-meta">
                                <div><i class="far fa-calendar"></i> Feb 20, 2025</div>
                                <div><i class="far fa-clock"></i> 18:00 - 21:00</div>
                                <div><i class="fas fa-map-marker-alt"></i> Beşiktaş, Istanbul</div>
                            </div>
                            <div class="event-stats">
                                <div class="event-stat">
                                    <i class="fas fa-users"></i> 10/12
                                </div>
                                <div class="event-stat">
                                    <i class="fas fa-star"></i> 4.9/5
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event 4 -->
                    <div class="event-card">
                        <img src="/api/placeholder/300/160" alt="Event" class="event-image">
                        <div class="event-details">
                            <span class="event-badge badge-attended">Attended</span>
                            <h3 class="event-title">Historical Tour of Sultanahmet</h3>
                            <div class="event-meta">
                                <div><i class="far fa-calendar"></i> Feb 15, 2025</div>
                                <div><i class="far fa-clock"></i> 10:00 - 14:00</div>
                                <div><i class="fas fa-map-marker-alt"></i> Sultanahmet, Istanbul</div>
                            </div>
                            <div class="event-stats">
                                <div class="event-stat">
                                    <i class="fas fa-users"></i> 12/15
                                </div>
                                <div class="event-stat">
                                    <i class="fas fa-star"></i> 4.7/5
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event 5 -->
                    <div class="event-card">
                        <img src="/api/placeholder/300/160" alt="Event" class="event-image">
                        <div class="event-details">
                            <span class="event-badge badge-hosted">Hosted</span>
                            <h3 class="event-title">Photography Walk in Balat</h3>
                            <div class="event-meta">
                                <div><i class="far fa-calendar"></i> Feb 8, 2025</div>
                                <div><i class="far fa-clock"></i> 14:00 - 17:00</div>
                                <div><i class="fas fa-map-marker-alt"></i> Balat, Istanbul</div>
                            </div>
                            <div class="event-stats">
                                <div class="event-stat">
                                    <i class="fas fa-users"></i> 8/10
                                </div>
                                <div class="event-stat">
                                    <i class="fas fa-star"></i> 4.6/5
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event 6 -->
                    <div class="event-card">
                        <img src="/api/placeholder/300/160" alt="Event" class="event-image">
                        <div class="event-details">
                            <span class="event-badge badge-attended">Attended</span>
                            <h3 class="event-title">Coffee Tasting Workshop</h3>
                            <div class="event-meta">
                                <div><i class="far fa-calendar"></i> Feb 1, 2025</div>
                                <div><i class="far fa-clock"></i> 15:00 - 17:00</div>
                                <div><i class="fas fa-map-marker-alt"></i> Kadıköy, Istanbul</div>
                            </div>
                            <div class="event-stats">
                                <div class="event-stat">
                                    <i class="fas fa-users"></i> 10/12
                                </div>
                                <div class="event-stat">
                                    <i class="fas fa-star"></i> 4.8/5
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-item">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="pagination-item active">1</div>
                    <div class="pagination-item">2</div>
                    <div class="pagination-item">3</div>
                    <div class="pagination-item">4</div>
                    <div class="pagination-item">5</div>
                    <div class="pagination-item">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // View Switcher
        document.addEventListener('DOMContentLoaded', function() {
            const gridViewBtn = document.getElementById('grid-view-btn');
            const listViewBtn = document.getElementById('list-view-btn');
            const gridView = document.getElementById('events-grid-view');
            const listView = document.getElementById('events-list-view');
            
            gridViewBtn.addEventListener('click', function() {
                gridView.style.display = 'grid';
                listView.style.display = 'none';
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
            });
            
            listViewBtn.addEventListener('click', function() {
                gridView.style.display = 'none';
                listView.style.display = 'flex';
                gridViewBtn.classList.remove('active');
                listViewBtn.classList.add('active');
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

        // Tag filters
        const tagFilters = document.querySelectorAll('.tag-filter');
        tagFilters.forEach(tag => {
            tag.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const listItems = document.querySelectorAll('.event-list-item');
            const gridItems = document.querySelectorAll('.event-card');
            
            // Filter list view items
            listItems.forEach(item => {
                const title = item.querySelector('.event-list-title').textContent.toLowerCase();
                const meta = item.querySelector('.event-list-meta').textContent.toLowerCase();
                
                if (title.includes(query) || meta.includes(query)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Filter grid view items
            gridItems.forEach(item => {
                const title = item.querySelector('.event-title').textContent.toLowerCase();
                const meta = item.querySelector('.event-meta').textContent.toLowerCase();
                
                if (title.includes(query) || meta.includes(query)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Apply filters (simplified for demo)
        document.querySelector('.apply-btn').addEventListener('click', function() {
            alert('Filters would be applied here. This would trigger an AJAX request to fetch filtered events in a real implementation.');
        });
        
        // Reset filters
        document.querySelector('.reset-btn').addEventListener('click', function() {
            // Reset checkboxes
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Reset selects
            document.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0;
            });
            
            // Reset date inputs
            document.querySelectorAll('input[type="date"]').forEach(date => {
                date.value = '';
            });
            
            // Reset tag filters
            document.querySelectorAll('.tag-filter.active').forEach(tag => {
                tag.classList.remove('active');
            });
            
            // In a real implementation, this would also trigger a reset of the displayed events
            alert('Filters have been reset. This would trigger an AJAX request to fetch all events in a real implementation.');
        });

        // Pagination (simplified for demo)
        document.querySelectorAll('.pagination-item').forEach(item => {
            item.addEventListener('click', function() {
                if (!this.classList.contains('active') && !this.querySelector('i')) {
                    document.querySelector('.pagination-item.active').classList.remove('active');
                    this.classList.add('active');
                    
                    // In a real implementation, this would load the corresponding page of events
                    alert(`Page ${this.textContent} would be loaded in a real implementation.`);
                }
            });
        });

        // Event card click to view details
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('click', function() {
                const title = this.querySelector('.event-title').textContent;
                window.location.href = `event_details.php?title=${encodeURIComponent(title)}`;
            });
        });
    </script>
</body>
</html>