<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
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
            <h1 class="page-title">Events</h1>
            <a href="create_event.php" class="btn btn-secondary">
                <i class="fas fa-plus"></i> Create New Event
            </a>
        </div>

        <!-- Event Categories -->
        <div class="event-categories">
            <div class="category-pill active">All Events</div>
            <div class="category-pill">My Events</div>
            <div class="category-pill">Attending</div>
            <div class="category-pill">Saved</div>
            <div class="category-pill">Past Events</div>
        </div>

        <!-- Filters -->
        <div class="events-filter">
            <div class="filter-group">
                <div class="filter-item">
                    <label for="location">Location</label>
                    <select id="location">
                        <option value="">Any Location</option>
                        <option value="istanbul">Istanbul</option>
                        <option value="ankara">Ankara</option>
                        <option value="izmir">Izmir</option>
                        <option value="antalya">Antalya</option>
                    </select>
                </div>
                <div class="filter-item">
                    <label for="date">Date</label>
                    <input type="date" id="date">
                </div>
                <div class="filter-item">
                    <label for="category">Category</label>
                    <select id="category">
                        <option value="">All Categories</option>
                        <option value="coffee">Coffee & Drinks</option>
                        <option value="cultural">Cultural</option>
                        <option value="sports">Sports & Outdoor</option>
                        <option value="language">Language Exchange</option>
                        <option value="food">Food & Dining</option>
                        <option value="art">Art & Music</option>
                        <option value="tech">Technology</option>
                    </select>
                </div>
            </div>
            <div class="filter-tags">
                <div class="filter-tag active">Popular</div>
                <div class="filter-tag">This Week</div>
                <div class="filter-tag">Weekends</div>
                <div class="filter-tag">Free</div>
                <div class="filter-tag">Morning</div>
                <div class="filter-tag">Evening</div>
                <div class="filter-tag">Beginner Friendly</div>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="events-grid">
            <!-- Event Card 1 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <div class="event-host">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Host" class="host-avatar">
                        <span class="host-name">Ahmet Alperen Aksoy</span>
                    </div>
                    <h3 class="event-title">Coffee & Cultural Exchange</h3>
                    <div class="event-info">
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            <span>April 5, 2025 • 15:00 - 17:00</span>
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Mandabatmaz Coffee, Kadıköy, Istanbul</span>
                        </div>
                        <div class="event-attendees">
                            <i class="fas fa-users"></i>
                            <span>7 people attending</span>
                        </div>
                    </div>
                    <p class="event-description">
                        Join us for an afternoon of coffee and conversation! Share your travel stories, learn about Turkish culture, and make new friends in a cozy atmosphere.
                    </p>
                    <div class="event-footer">
                        <div class="event-tags">
                            <span class="event-tag">Coffee</span>
                            <span class="event-tag">Cultural</span>
                        </div>
                        <div class="event-actions">
                            <button class="join-btn">
                                <i class="fas fa-check-circle"></i> Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Card 2 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <div class="event-host">
                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Host" class="host-avatar">
                        <span class="host-name">Olivia Martinez</span>
                    </div>
                    <h3 class="event-title">Hiking Belgrad Forest</h3>
                    <div class="event-info">
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            <span>April 8, 2025 • 09:00 - 14:00</span>
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Belgrad Forest, Istanbul</span>
                        </div>
                        <div class="event-attendees">
                            <i class="fas fa-users"></i>
                            <span>12 people attending</span>
                        </div>
                    </div>
                    <p class="event-description">
                        Explore the beautiful Belgrad Forest with a group of nature lovers! We'll hike for about 8 km at a moderate pace, with plenty of stops for photos and rest.
                    </p>
                    <div class="event-footer">
                        <div class="event-tags">
                            <span class="event-tag">Outdoor</span>
                            <span class="event-tag">Hiking</span>
                        </div>
                        <div class="event-actions">
                            <button class="join-btn">
                                <i class="fas fa-check-circle"></i> Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Card 3 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <div class="event-host">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Host" class="host-avatar">
                        <span class="host-name">David Wilson</span>
                    </div>
                    <h3 class="event-title">Historical Istanbul Tour</h3>
                    <div class="event-info">
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            <span>April 10, 2025 • 10:00 - 15:00</span>
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Sultanahmet Square, Istanbul</span>
                        </div>
                        <div class="event-attendees">
                            <i class="fas fa-users"></i>
                            <span>15 people attending</span>
                        </div>
                    </div>
                    <p class="event-description">
                        Discover the rich history of Istanbul's old city. We'll visit Hagia Sophia, Blue Mosque, Topkapi Palace, and more. Suitable for history enthusiasts and first-time visitors.
                    </p>
                    <div class="event-footer">
                        <div class="event-tags">
                            <span class="event-tag">Cultural</span>
                            <span class="event-tag">History</span>
                        </div>
                        <div class="event-actions">
                            <button class="join-btn">
                                <i class="fas fa-check-circle"></i> Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Card 4 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <div class="event-host">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Host" class="host-avatar">
                        <span class="host-name">Sophie Chen</span>
                    </div>
                    <h3 class="event-title">Turkish Cooking Workshop</h3>
                    <div class="event-info">
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            <span>April 12, 2025 • 18:00 - 21:00</span>
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Community Kitchen, Beşiktaş, Istanbul</span>
                        </div>
                        <div class="event-attendees">
                            <i class="fas fa-users"></i>
                            <span>8 people attending</span>
                        </div>
                    </div>
                    <p class="event-description">
                        Learn to prepare traditional Turkish dishes with a local chef! We'll make mezze, main courses, and baklava. No prior cooking experience required.
                    </p>
                    <div class="event-footer">
                        <div class="event-tags">
                            <span class="event-tag">Food</span>
                            <span class="event-tag">Cooking</span>
                        </div>
                        <div class="event-actions">
                            <button class="join-btn">
                                <i class="fas fa-check-circle"></i> Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Card 5 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <div class="event-host">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Host" class="host-avatar">
                        <span class="host-name">Michael Brown</span>
                    </div>
                    <h3 class="event-title">Language Exchange Meetup</h3>
                    <div class="event-info">
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            <span>April 15, 2025 • 19:00 - 22:00</span>
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Multilingual Cafe, Şişli, Istanbul</span>
                        </div>
                        <div class="event-attendees">
                            <i class="fas fa-users"></i>
                            <span>20 people attending</span>
                        </div>
                    </div>
                    <p class="event-description">
                        Practice languages while meeting new people! English, Turkish, Spanish, French, and more. All levels welcome. Structured activities and free conversation time.
                    </p>
                    <div class="event-footer">
                        <div class="event-tags">
                            <span class="event-tag">Language</span>
                            <span class="event-tag">Social</span>
                        </div>
                        <div class="event-actions">
                            <button class="join-btn">
                                <i class="fas fa-check-circle"></i> Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Card 6 -->
            <div class="event-card">
                <img src="/api/placeholder/400/180" alt="Event Image" class="event-image">
                <div class="event-details">
                    <div class="event-host">
                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Host" class="host-avatar">
                        <span class="host-name">Isabella Johnson</span>
                    </div>
                    <h3 class="event-title">Bosphorus Sunset Cruise</h3>
                    <div class="event-info">
                        <div class="event-date">
                            <i class="far fa-calendar"></i>
                            <span>April 18, 2025 • 17:30 - 20:30</span>
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Eminönü Pier, Istanbul</span>
                        </div>
                        <div class="event-attendees">
                            <i class="fas fa-users"></i>
                            <span>25 people attending</span>
                        </div>
                    </div>
                    <p class="event-description">
                        Experience Istanbul from the water! Join our group for a beautiful sunset cruise along the Bosphorus with drinks, snacks, and amazing photo opportunities.
                    </p>
                    <div class="event-footer">
                        <div class="event-tags">
                            <span class="event-tag">Sightseeing</span>
                            <span class="event-tag">Social</span>
                        </div>
                        <div class="event-actions">
                            <button class="join-btn">
                                <i class="fas fa-check-circle"></i> Join
                            </button>
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

        // Join button popup functionality
        document.addEventListener('DOMContentLoaded', function() {
            const joinButtons = document.querySelectorAll('.join-btn');
            const loginPopup = document.getElementById('loginPopup');
            
            joinButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    loginPopup.classList.add('active');
                });
            });
            
            loginPopup.addEventListener('click', function(e) {
                if (e.target === loginPopup) {
                    loginPopup.classList.remove('active');
                }
            });
            
            document.querySelectorAll('.close-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    loginPopup.classList.remove('active');
                });
            });
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && loginPopup.classList.contains('active')) {
                    loginPopup.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>

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
        }

        h1, h2, h3 {
            font-weight: bold;
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
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #f5a623;
        }

        .btn-primary:hover {
            background-color: #e5941d;
        }

        .btn-secondary {
            background-color: #000;
            color: #fff;
        }

        .btn-secondary:hover {
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

        /* Event Filters */
        .events-filter {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .filter-item {
            flex: 1;
        }

        .filter-item label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .filter-item select, 
        .filter-item input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .filter-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .filter-tag {
            padding: 6px 12px;
            background-color: #f5f5f5;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-tag:hover, .filter-tag.active {
            background-color: #f5a623;
            color: white;
        }

        /* Event categories */
        .event-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .category-pill {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-pill.active {
            background-color: #f5a623;
            color: white;
            border-color: #f5a623;
        }

        .category-pill:hover {
            background-color: #f5f5f5;
        }

        .category-pill.active:hover {
            background-color: #e5941d;
        }

        /* Event Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .event-card {
            flex: 1;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all 0.3s ease;
        }

        .event-card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            transform: scale(1.05);
            transition: 0.2s;
        }

        .event-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .event-details {
            padding: 16px;
        }

        .event-host {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .host-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 2px solid #f5a623;
        }

        .host-name {
            font-weight: 500;
        }

        .event-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .event-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 12px;
        }

        .event-date, .event-location, .event-attendees {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #555;
        }

        .event-date i, .event-location i, .event-attendees i {
            width: 20px;
            color: #f5a623;
        }

        .event-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .event-tags {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .event-tag {
            font-size: 12px;
            padding: 3px 8px;
            background-color: #f5f5f5;
            border-radius: 20px;
        }

        .event-actions {
            display: flex;
            gap: 10px;
        }

        .event-action-btn {
            background-color: transparent;
            border: none;
            color: #555;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .join-btn {
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .join-btn:hover {
            background-color: #e5941d;
        }

        .event-action-btn i {
            margin-right: 5px;
        }

        .event-action-btn:hover {
            color: #f5a623;
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
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: white;
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

        /* Responsive styles */
        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: 1fr;
            }

            .filter-group {
                flex-direction: column;
                gap: 10px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
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