<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Event Details</title>
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

        /* Event Details Layout */
        .event-details-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .event-main {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .event-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Event Header */
        .event-header {
            position: relative;
        }

        .event-cover {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .event-header-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 20px;
            color: white;
        }

        .event-category-badge {
            display: inline-block;
            background-color: #f5a623;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .event-title {
            font-size: 2rem;
            margin-bottom: 10px;
            font-family: 'Volkhov', serif;
        }

        .event-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
        }

        .event-meta i {
            margin-right: 5px;
        }

        /* Event Content */
        .event-content {
            padding: 25px;
        }

        .event-description {
            margin-bottom: 25px;
        }

        .event-description h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .event-description p {
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .event-details-list {
            margin-top: 20px;
        }

        .event-detail-item {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .event-detail-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(245, 166, 35, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f5a623;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .event-detail-content {
            flex: 1;
        }

        .event-detail-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .event-location-map {
            height: 200px;
            background-color: #f0f0f0;
            margin: 20px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }

        /* Sidebar Components */
        .sidebar-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .sidebar-card h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            color: #2c3e50;
        }

        /* Host Information */
        .host-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .host-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #f5a623;
        }

        .host-details {
            flex: 1;
        }

        .host-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .host-meta {
            font-size: 0.85rem;
            color: #666;
        }

        .host-meta i {
            margin-right: 5px;
        }

        .view-profile-btn {
            display: block;
            text-align: center;
            padding: 8px;
            border: 1px solid #f5a623;
            border-radius: 5px;
            color: #f5a623;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .view-profile-btn:hover {
            background-color: #f5a623;
            color: white;
        }

        /* Attendees */
        .attendees-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 15px;
        }

        .attendee-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        .view-all-attendees {
            display: block;
            text-align: center;
            padding: 8px;
            background-color: #f5f5f5;
            border-radius: 5px;
            color: #333;
            text-decoration: none;
        }

        /* Join Section */
        .join-section {
            text-align: center;
        }

        .attendees-count {
            display: block;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #666;
        }

        .progress-container {
            height: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #f5a623;
            width: 60%; /* This would be dynamically set based on attendees/capacity */
        }

        .join-btn {
            display: block;
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .join-btn:hover {
            background-color: #e5941d;
        }

        /* Event Comments */
        .event-comments {
            padding: 25px;
            border-top: 1px solid #eee;
        }

        .comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .comments-header h3 {
            font-size: 1.2rem;
            color: #2c3e50;
        }

        .comment-form {
            display: flex;
            margin-bottom: 20px;
        }

        .comment-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }

        .comment-submit {
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 0 15px;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }

        .comment-submit:hover {
            background-color: #e5941d;
        }

        .comment-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .comment-item {
            display: flex;
            gap: 15px;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment-content {
            flex: 1;
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 8px;
        }

        .comment-author {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .comment-text {
            margin-bottom: 10px;
        }

        .comment-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: #666;
        }

        .comment-actions {
            display: flex;
            gap: 15px;
        }

        .comment-action {
            color: #666;
            text-decoration: none;
            cursor: pointer;
        }

        .comment-action:hover {
            color: #f5a623;
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

        .btn-outline {
            border: 1px solid #f5a623;
            color: #f5a623;
            background-color: transparent;
        }

        .btn-outline:hover {
            background-color: #f5a623;
            color: white;
        }

        /* Tags */
        .event-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 25px;
        }

        .event-tag {
            background-color: #f0f0f0;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #333;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .event-details-container {
                grid-template-columns: 1fr;
            }
            
            .event-cover {
                src: 'CreateEventForm/event_image.webp';
                height: 200px;
            }
            
            .event-title {
                font-size: 1.8rem;
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
        <div class="event-details-container">
            <!-- Event Main Section -->
            <div class="event-main">
                <!-- Event Header with Cover Image -->
                <div class="event-header">
                    <img src="CreateEventForm/event_image.webp" alt="Event Cover Image" class="event-cover">
                    <div class="event-header-overlay">
                        <span class="event-category-badge">Coffee & Cultural</span>
                        <h1 class="event-title">Coffee & Cultural Exchange</h1>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> April 5, 2025</span>
                            <span><i class="far fa-clock"></i> 15:00 - 17:00</span>
                            <span><i class="fas fa-map-marker-alt"></i> Kadıköy, Istanbul</span>
                        </div>
                    </div>
                </div>

                <!-- Event Content -->
                <div class="event-content">
                    <div class="event-description">
                        <h3>About This Event</h3>
                        <p>Join us for an afternoon of coffee and conversation! Share your travel stories, learn about Turkish culture, and make new friends in a cozy atmosphere.</p>
                        
                        <p>This event is perfect for:</p>
                        <ul>
                            <li>Travelers looking to meet locals</li>
                            <li>Expats wanting to share experiences</li>
                            <li>Language enthusiasts practicing Turkish or English</li>
                            <li>Coffee lovers interested in traditional Turkish coffee</li>
                        </ul>

                        <p>We'll meet at Mandabatmaz Coffee, one of Istanbul's hidden gems known for its authentic Turkish coffee prepared in the traditional way. The venue offers a relaxed environment perfect for conversations.</p>

                        <p>Feel free to bring photos of your travels or home country to share. This is an inclusive event where everyone is welcome!</p>
                    </div>

                    <div class="event-details-list">
                        <div class="event-detail-item">
                            <div class="event-detail-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="event-detail-content">
                                <div class="event-detail-title">Date and Time</div>
                                <p>Tuesday, April 5, 2025 <br> 3:00 PM - 5:00 PM (GMT+3)</p>
                            </div>
                        </div>

                        <div class="event-detail-item">
                            <div class="event-detail-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="event-detail-content">
                                <div class="event-detail-title">Location</div>
                                <p>Mandabatmaz Coffee<br>
                                Olivia Geçidi No: 1, Beyoğlu<br>
                                Kadıköy, Istanbul, Turkey</p>
                            </div>
                        </div>

                        <div class="event-location-map">
                            <i class="fas fa-map fa-3x"></i>
                            <p>Interactive Map Would Display Here</p>
                        </div>

                        <div class="event-detail-item">
                            <div class="event-detail-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="event-detail-content">
                                <div class="event-detail-title">Additional Information</div>
                                <p>The café is on the second floor of the building. Look for the wooden door with a small coffee cup sign. We'll have a 'SocialLoop' sign on our table.</p>
                            </div>
                        </div>
                    </div>

                    <div class="event-tags">
                        <span class="event-tag">Coffee</span>
                        <span class="event-tag">Cultural</span>
                        <span class="event-tag">Networking</span>
                        <span class="event-tag">Language Exchange</span>
                        <span class="event-tag">Expat</span>
                    </div>
                </div>

                <!-- Event Comments -->
                <div class="event-comments">
                    <div class="comments-header">
                        <h3>Comments and Questions (8)</h3>
                    </div>

                    <form class="comment-form">
                        <textarea class="comment-input" placeholder="Ask a question or leave a comment..."></textarea>
                        <button type="submit" class="comment-submit">Post</button>
                    </form>

                    <div class="comment-list">
                        <!-- Comment 1 -->
                        <div class="comment-item">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="User" class="comment-avatar">
                            <div class="comment-content">
                                <div class="comment-author">Emma Johnson</div>
                                <div class="comment-text">
                                    This sounds great! Will there be vegetarian food options available?
                                </div>
                                <div class="comment-meta">
                                    <span>2 days ago</span>
                                    <div class="comment-actions">
                                        <a href="#" class="comment-action">Reply</a>
                                        <a href="#" class="comment-action">Like</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comment 2 with Reply -->
                        <div class="comment-item">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="comment-avatar">
                            <div class="comment-content">
                                <div class="comment-author">Ahmet Alperen Aksoy (Host)</div>
                                <div class="comment-text">
                                    Hi Emma! This is primarily a coffee gathering, but the café does offer some small pastries that include vegetarian options. Let me know if you have any other questions!
                                </div>
                                <div class="comment-meta">
                                    <span>1 day ago</span>
                                    <div class="comment-actions">
                                        <a href="#" class="comment-action">Like</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comment 3 -->
                        <div class="comment-item">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="User" class="comment-avatar">
                            <div class="comment-content">
                                <div class="comment-author">David Wilson</div>
                                <div class="comment-text">
                                    Is this suitable for someone who doesn't speak Turkish at all?
                                </div>
                                <div class="comment-meta">
                                    <span>12 hours ago</span>
                                    <div class="comment-actions">
                                        <a href="#" class="comment-action">Reply</a>
                                        <a href="#" class="comment-action">Like</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Sidebar -->
            <div class="event-sidebar">
                <!-- Join Event Card -->
                <div class="sidebar-card join-section">
                    <span class="attendees-count">
                        <strong>7</strong> people going · <strong>5</strong> spots left
                    </span>
                    <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <button class="join-btn">Join Event</button>
                </div>

                <!-- Host Information -->
                <div class="sidebar-card">
                    <h3>Host</h3>
                    <div class="host-info">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Host" class="host-avatar">
                        <div class="host-details">
                            <div class="host-name">Ahmet Alperen Aksoy</div>
                            <div class="host-meta">
                                <div><i class="fas fa-map-marker-alt"></i> Istanbul, Turkey</div>
                                <div><i class="fas fa-calendar-check"></i> 24 events hosted</div>
                            </div>
                        </div>
                    </div>
                    <a href="profile.php?id=123" class="view-profile-btn">View Profile</a>
                </div>

                <!-- Attendees -->
                <div class="sidebar-card">
                    <h3>Attendees (7)</h3>
                    <div class="attendees-preview">
                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Attendee" class="attendee-avatar">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Attendee" class="attendee-avatar">
                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Attendee" class="attendee-avatar">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Attendee" class="attendee-avatar">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Attendee" class="attendee-avatar">
                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Attendee" class="attendee-avatar">
                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Attendee" class="attendee-avatar">
                    </div>
                    <a href="#" class="view-all-attendees">View All Attendees</a>
                </div>

                <!-- Share & Save -->
                <div class="sidebar-card">
                    <h3>Share & Save</h3>
                    <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                        <a href="#" class="btn btn-outline" style="flex: 1; text-align: center; padding: 8px;">
                            <i class="fas fa-share-alt"></i> Share
                        </a>
                        <a href="#" class="btn btn-outline" style="flex: 1; text-align: center; padding: 8px;">
                            <i class="far fa-bookmark"></i> Save
                        </a>
                    </div>
                    <a href="#" class="btn btn-outline" style="width: 100%; text-align: center; display: block; padding: 8px;">
                        <i class="fas fa-exclamation-circle"></i> Report Event
                    </a>
                </div>

                <!-- Similar Events -->
                <div class="sidebar-card">
                    <h3>Similar Events</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="display: flex; gap: 10px;">
                            <img src="/api/placeholder/60/60" alt="Event" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            <div>
                                <div style="font-weight: 600; margin-bottom: 5px;">Language Exchange Meetup</div>
                                <div style="font-size: 0.85rem; color: #666;">Apr 15, 2025 • Şişli</div>
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <img src="/api/placeholder/60/60" alt="Event" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            <div>
                                <div style="font-weight: 600; margin-bottom: 5px;">Discover Turkish Coffee</div>
                                <div style="font-size: 0.85rem; color: #666;">Apr 10, 2025 • Beşiktaş</div>
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <img src="/api/placeholder/60/60" alt="Event" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            <div>
                                <div style="font-weight: 600; margin-bottom: 5px;">Expat Networking Brunch</div>
                                <div style="font-size: 0.85rem; color: #666;">Apr 18, 2025 • Taksim</div>
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

        // Join Event functionality
        document.querySelector('.join-btn').addEventListener('click', function() {
            if (this.textContent === 'Join Event') {
                this.textContent = 'Leave Event';
                this.style.backgroundColor = '#e74c3c';
                
                // Update attendees count
                const countElement = document.querySelector('.attendees-count');
                const currentCount = parseInt(countElement.querySelector('strong').textContent);
                countElement.innerHTML = `<strong>${currentCount + 1}</strong> people going · <strong>${12 - (currentCount + 1)}</strong> spots left`;
                
                // Update progress bar
                const progressBar = document.querySelector('.progress-bar');
                const newWidth = ((currentCount + 1) / 12) * 100;
                progressBar.style.width = `${newWidth}%`;
                
                // Add user to attendees (this would typically be an AJAX call)
                const attendeesPreview = document.querySelector('.attendees-preview');
                const currentUserAvatar = document.querySelector('.user-menu img').src;
                
                // Create a new image element for the current user
                const newAttendee = document.createElement('img');
                newAttendee.src = currentUserAvatar;
                newAttendee.alt = 'You';
                newAttendee.className = 'attendee-avatar';
                
                // Add it to the attendees preview
                attendeesPreview.appendChild(newAttendee);
            } else {
                this.textContent = 'Join Event';
                this.style.backgroundColor = '#f5a623';
                
                // Update attendees count
                const countElement = document.querySelector('.attendees-count');
                const currentCount = parseInt(countElement.querySelector('strong').textContent);
                countElement.innerHTML = `<strong>${currentCount - 1}</strong> people going · <strong>${12 - (currentCount - 1)}</strong> spots left`;
                
                // Update progress bar
                const progressBar = document.querySelector('.progress-bar');
                const newWidth = ((currentCount - 1) / 12) * 100;
                progressBar.style.width = `${newWidth}%`;
                
                // Remove the last added attendee
                const attendeesPreview = document.querySelector('.attendees-preview');
                attendeesPreview.removeChild(attendeesPreview.lastChild);
            }
        });

        // Comment form submission
        document.querySelector('.comment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const commentInput = this.querySelector('.comment-input');
            const commentText = commentInput.value.trim();
            
            if (commentText) {
                // Create a new comment element
                const commentList = document.querySelector('.comment-list');
                const currentUserAvatar = document.querySelector('.user-menu img').src;
                
                const newComment = document.createElement('div');
                newComment.className = 'comment-item';
                newComment.innerHTML = `
                    <img src="${currentUserAvatar}" alt="You" class="comment-avatar">
                    <div class="comment-content">
                        <div class="comment-author">You</div>
                        <div class="comment-text">
                            ${commentText}
                        </div>
                        <div class="comment-meta">
                            <span>Just now</span>
                            <div class="comment-actions">
                                <a href="#" class="comment-action">Delete</a>
                                <a href="#" class="comment-action">Edit</a>
                            </div>
                        </div>
                    </div>
                `;
                
                // Add the new comment to the top of the list
                commentList.insertBefore(newComment, commentList.firstChild);
                
                // Clear the input
                commentInput.value = '';
                
                // Update the comment count
                const commentsHeader = document.querySelector('.comments-header h3');
                const currentCount = parseInt(commentsHeader.textContent.match(/\d+/)[0]);
                commentsHeader.textContent = `Comments and Questions (${currentCount + 1})`;
            }
        });
    </script>
</body>
</html>