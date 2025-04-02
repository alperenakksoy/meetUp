<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Events</title>
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

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
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

        /* Tabs */
        .tabs {
            display: flex;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .tab {
            flex: 1;
            padding: 12px 0;
            text-align: center;
            cursor: pointer;
            font-weight: 500;
            color: #555;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab:hover:not(.active) {
            background-color: var(--light-gray);
        }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        .filter-options {
            display: flex;
            gap: 10px;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-button {
            background-color: var(--light-gray);
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .filter-button i {
            margin-right: 5px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: var(--light-gray);
            border-radius: 4px;
            padding: 8px 12px;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
            width: 200px;
        }

        .search-box i {
            color: #777;
            margin-right: 5px;
        }

        /* Events Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .event-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }

        .event-details {
            padding: 15px;
        }

        .event-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .event-meta {
            margin-bottom: 12px;
        }

        .event-host {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .host-avatar {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
        }

        .host-name {
            font-size: 14px;
            color: #555;
        }

        .event-date, .event-location {
            font-size: 14px;
            color: #777;
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .event-date i, .event-location i {
            margin-right: 5px;
            font-size: 14px;
            width: 16px;
        }

        .event-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 12px;
            line-height: 1.4;
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
        }

        .event-participants {
            display: flex;
            align-items: center;
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

        .event-actions button {
            background-color: var(--light-gray);
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .event-actions button:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination-item {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-item.active {
            background-color: var(--primary-color);
            color: white;
        }

        .pagination-item:hover:not(.active) {
            background-color: var(--light-gray);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .filter-options {
                flex-wrap: wrap;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .search-box {
                width: 100%;
                margin-top: 10px;
            }

            .search-box input {
                width: 100%;
            }

            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
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
                <li><a href="events.php" class="active"><i class="fas fa-calendar-alt"></i> Events</a></li>
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
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Events</h1>
            <a href="create_event.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Event
            </a>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab active">All Events</div>
            <div class="tab">My Events</div>
            <div class="tab">Participating</div>
            <div class="tab">Past Events</div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="filter-options">
                <div class="filter-dropdown">
                    <button class="filter-button">
                        <i class="fas fa-map-marker-alt"></i> Location
                    </button>
                </div>
                <div class="filter-dropdown">
                    <button class="filter-button">
                        <i class="fas fa-calendar"></i> Date
                    </button>
                </div>
                <div class="filter-dropdown">
                    <button class="filter-button">
                        <i class="fas fa-tag"></i> Category
                    </button>
                </div>
            </div>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search events...">
            </div>
        </div>

        <!-- Events Grid -->
        <div class="events-grid">
            <!-- Event 1 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <h3 class="event-title">Coffee & Cultural Exchange</h3>
                    <div class="event-meta">
                        <div class="event-host">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Host" class="host-avatar">
                            <span class="host-name">Hosted by Ahmet</span>
                        </div>
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            April 5, 2025 • 15:00
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Kadıköy, Istanbul
                        </div>
                    </div>
                    <div class="event-description">
                        Join me for coffee and conversation! Let's share stories about our cultures, travel experiences, and more. Perfect for travelers and locals who want to connect.
                    </div>
                    <div class="event-footer">
                        <div class="event-participants">
                            <div class="participant-avatars">
                                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Participant" class="participant-avatar">
                            </div>
                            <span class="participant-count">+4 going</span>
                        </div>
                        <div class="event-actions">
                            <button>Join</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event 2 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <h3 class="event-title">Hiking Belgrad Forest</h3>
                    <div class="event-meta">
                        <div class="event-host">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Host" class="host-avatar">
                            <span class="host-name">Hosted by Olivia</span>
                        </div>
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            April 8, 2025 • 09:00
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Belgrad Forest, Istanbul
                        </div>
                    </div>
                    <div class="event-description">
                        Let's explore the beautiful Belgrad Forest together! A moderate hike suitable for all fitness levels. We'll enjoy nature, take photos, and have a picnic lunch.
                    </div>
                    <div class="event-footer">
                        <div class="event-participants">
                            <div class="participant-avatars">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Participant" class="participant-avatar">
                            </div>
                            <span class="participant-count">+6 going</span>
                        </div>
                        <div class="event-actions">
                            <button>Join</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event 3 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <h3 class="event-title">Historical Istanbul Tour</h3>
                    <div class="event-meta">
                        <div class="event-host">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Host" class="host-avatar">
                            <span class="host-name">Hosted by David</span>
                        </div>
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            April 10, 2025 • 10:00
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Sultanahmet, Istanbul
                        </div>
                    </div>
                    <div class="event-description">
                        Explore the historical peninsula of Istanbul with a local history enthusiast! We'll visit Hagia Sophia, Blue Mosque, Topkapi Palace, and more.
                    </div>
                    <div class="event-footer">
                        <div class="event-participants">
                            <div class="participant-avatars">
                                <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Participant" class="participant-avatar">
                            </div>
                            <span class="participant-count">+8 going</span>
                        </div>
                        <div class="event-actions">
                            <button>Join</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event 4 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <h3 class="event-title">Photography Walk in Balat</h3>
                    <div class="event-meta">
                        <div class="event-host">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Host" class="host-avatar">
                            <span class="host-name">Hosted by Emma</span>
                        </div>
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            April 12, 2025 • 14:00
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Balat, Istanbul
                        </div>
                    </div>
                    <div class="event-description">
                        Let's capture the colorful houses and unique atmosphere of Balat! All photography levels welcome - bring your camera or smartphone.
                    </div>
                    <div class="event-footer">
                        <div class="event-participants">
                            <div class="participant-avatars">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Participant" class="participant-avatar">
                            </div>
                            <span class="participant-count">+3 going</span>
                        </div>
                        <div class="event-actions">
                            <button>Join</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event 5 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <h3 class="event-title">Turkish Cooking Class</h3>
                    <div class="event-meta">
                        <div class="event-host">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Host" class="host-avatar">
                            <span class="host-name">Hosted by Sophie</span>
                        </div>
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            April 15, 2025 • 18:00
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Beşiktaş, Istanbul
                        </div>
                    </div>
                    <div class="event-description">
                        Learn how to cook authentic Turkish dishes in a friendly environment! We'll prepare a full meal together, then enjoy it with Turkish tea.
                    </div>
                    <div class="event-footer">
                        <div class="event-participants">
                            <div class="participant-avatars">
                                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Participant" class="participant-avatar">
                            </div>
                            <span class="participant-count">+4 going</span>
                        </div>
                        <div class="event-actions">
                            <button>Join</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event 6 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <h3 class="event-title">Language Exchange Meetup</h3>
                    <div class="event-meta">
                        <div class="event-host">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Host" class="host-avatar">
                            <span class="host-name">Hosted by James</span>
                        </div>
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            April 18, 2025 • 19:00
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Taksim, Istanbul
                        </div>
                    </div>
                    <div class="event-description">
                        Practice Turkish, English, or any other language in a relaxed cafe setting. All language levels welcome! Let's help each other learn.
                    </div>
                    <div class="event-footer">
                        <div class="event-participants">
                            <div class="participant-avatars">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Participant" class="participant-avatar">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Participant" class="participant-avatar">
                            </div>
                            <span class="participant-count">+12 going</span>
                        </div>
                        <div class="event-actions">
                            <button>Join</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <div class="pagination-item"><i class="fas fa-chevron-left"></i></div>
            <div class="pagination-item active">1</div>
            <div class="pagination-item">2</div>
            <div class="pagination-item">3</div>
            <div class="pagination-item">...</div>
            <div class="pagination-item">8</div>
            <div class="pagination-item"><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>

    <script>
        // This would be connected to PHP for dynamic content
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    // In a real implementation, this would trigger loading different events
                });
            });

            // Filter buttons would open dropdowns
            // Join buttons would trigger event joining via AJAX
        });
    </script>
</body>
</html>