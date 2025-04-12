<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Event Reviews</title>
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

        .breadcrumbs {
            display: flex;
            gap: 5px;
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
        }

        .breadcrumbs a {
            color: #f5a623;
            text-decoration: none;
        }

        .breadcrumbs a:hover {
            text-decoration: underline;
        }

        .breadcrumbs .separator {
            color: #999;
        }

        /* Reviews Container */
        .reviews-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        /* Reviews List */
        .reviews-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Event Overview Box */
        .event-overview {
            display: flex;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            gap: 20px;
        }

        .event-image {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
        }

        .event-info {
            flex: 1;
        }

        .event-name {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .event-meta i {
            margin-right: 5px;
            color: #f5a623;
        }

        /* Rating Box */
        .rating-overview {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .rating-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5a623;
            color: white;
            font-size: 1.6rem;
            font-weight: bold;
        }

        .rating-details {
            flex: 1;
        }

        .rating-text {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
        }

        .rating-bars {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .rating-bar {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .rating-star {
            width: 80px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }

        .rating-star i {
            color: #f5a623;
            margin-right: 3px;
        }

        .rating-progress {
            flex: 1;
            height: 6px;
            background-color: #eee;
            border-radius: 3px;
            overflow: hidden;
        }

        .rating-bar-fill {
            height: 100%;
            background-color: #f5a623;
        }

        .rating-count {
            width: 30px;
            font-size: 0.85rem;
            color: #666;
            text-align: right;
        }

        /* Reviews List */
        .reviews-list-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .reviews-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reviews-header h2 {
            font-size: 1.2rem;
            color: #2c3e50;
        }

        .sort-by {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .sort-by select {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .reviews-list {
            display: flex;
            flex-direction: column;
        }

        .review-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .reviewer-info {
            flex: 1;
        }

        .reviewer-name {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .review-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .review-stars {
            color: #f5a623;
        }

        .review-date {
            font-size: 0.85rem;
            color: #666;
        }

        .review-content {
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .review-photos {
            display: flex;
            gap: 10px;
            margin: 15px 0;
        }

        .review-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .review-photo:hover {
            transform: scale(1.05);
        }

        .review-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #666;
        }

        .review-footer-left {
            display: flex;
            gap: 15px;
        }

        .review-action {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .review-action:hover {
            color: #f5a623;
        }

        /* Host Response */
        .host-response {
            margin-top: 15px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .host-response-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .host-badge {
            display: inline-block;
            padding: 3px 8px;
            background-color: #3498db;
            color: white;
            border-radius: 3px;
            font-size: 0.75rem;
        }

        .host-response-date {
            font-size: 0.85rem;
            color: #666;
        }

        /* Sidebar */
        .reviews-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-card {
            background-color: #fff;
            border-radius: 8px;
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

        /* Add Review Box */
        .add-review-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .rating-input {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .rating-label {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .star-rating {
            display: flex;
            gap: 5px;
        }

        .star-rating i {
            font-size: 1.5rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .star-rating i:hover, .star-rating i.active {
            color: #f5a623;
        }

        .review-textarea {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
            font-size: 0.9rem;
        }

        .review-textarea:focus {
            border-color: #f5a623;
            outline: none;
        }

        .photo-upload {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .upload-btn {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border: 1px dashed #ddd;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-btn:hover {
            background-color: #eee;
        }

        .upload-btn i {
            color: #666;
        }

        .photo-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-item {
            position: relative;
            width: 80px;
            height: 80px;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .remove-photo {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            cursor: pointer;
        }

        .submit-review {
            padding: 12px;
            background-color: #f5a623;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-review:hover {
            background-color: #e5941d;
        }

        /* Review Stats */
        .review-stats {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .stat-item {
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #f5a623;
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #666;
        }

        /* Similar Events */
        .similar-events {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .similar-event {
            display: flex;
            gap: 10px;
        }

        .similar-event-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .similar-event-info {
            flex: 1;
        }

        .similar-event-title {
            font-weight: 500;
            margin-bottom: 3px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .similar-event-meta {
            font-size: 0.85rem;
            color: #666;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .modal-content img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 5px;
        }

        .close-modal {
            position: absolute;
            top: -30px;
            right: 0;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .reviews-container {
                grid-template-columns: 1fr;
            }

            .event-overview {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .event-image {
                width: 100%;
                max-height: 150px;
            }

            .rating-overview {
                flex-direction: column;
            }

            .review-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
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
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <a href="events.php">Events</a>
            <span class="separator">></span>
            <a href="event_management.php">Event Management</a>
            <span class="separator">></span>
            <a href="event_details.php?id=1">Bosphorus Sunset Cruise</a>
            <span class="separator">></span>
            <span>Reviews</span>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Event Reviews</h1>
            <a href="event_details.php?id=1" class="btn-secondary" style="text-decoration: none; padding: 10px 15px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; color: #333;">
                <i class="fas fa-arrow-left"></i> Back to Event
            </a>
        </div>

        <!-- Reviews Container -->
        <div class="reviews-container">
            <!-- Reviews Content -->
            <div class="reviews-content">
                <!-- Event Overview -->
                <div class="event-overview">
                    <img src="/api/placeholder/150/100" alt="Event" class="event-image">
                    <div class="event-info">
                        <h2 class="event-name">Bosphorus Sunset Cruise</h2>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> Mar 18, 2025</span>
                            <span><i class="far fa-clock"></i> 17:30 - 20:30</span>
                            <span><i class="fas fa-map-marker-alt"></i> Eminönü, Istanbul</span>
                        </div>
                        <div class="rating-overview">
                            <div class="rating-circle">4.8</div>
                            <div class="rating-details">
                                <div class="rating-text">Rated 4.8 out of 5 based on 12 reviews</div>
                                <div class="rating-bars">
                                    <div class="rating-bar">
                                        <div class="rating-star"><i class="fas fa-star"></i> 5</div>
                                        <div class="rating-progress">
                                            <div class="rating-bar-fill" style="width: 80%;"></div>
                                        </div>
                                        <div class="rating-count">10</div>
                                    </div>
                                    <div class="rating-bar">
                                        <div class="rating-star"><i class="fas fa-star"></i> 4</div>
                                        <div class="rating-progress">
                                            <div class="rating-bar-fill" style="width: 16%;"></div>
                                        </div>
                                        <div class="rating-count">2</div>
                                    </div>
                                    <div class="rating-bar">
                                        <div class="rating-star"><i class="fas fa-star"></i> 3</div>
                                        <div class="rating-progress">
                                            <div class="rating-bar-fill" style="width: 0%;"></div>
                                        </div>
                                        <div class="rating-count">0</div>
                                    </div>
                                    <div class="rating-bar">
                                        <div class="rating-star"><i class="fas fa-star"></i> 2</div>
                                        <div class="rating-progress">
                                            <div class="rating-bar-fill" style="width: 0%;"></div>
                                        </div>
                                        <div class="rating-count">0</div>
                                    </div>
                                    <div class="rating-bar">
                                        <div class="rating-star"><i class="fas fa-star"></i> 1</div>
                                        <div class="rating-progress">
                                            <div class="rating-bar-fill" style="width: 0%;"></div>
                                        </div>
                                        <div class="rating-count">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews List -->
                <div class="reviews-list-container">
                    <div class="reviews-header">
                        <h2>Reviews (12)</h2>
                        <div class="sort-by">
                            <span>Sort by:</span>
                            <select>
                                <option value="recent">Most Recent</option>
                                <option value="helpful">Most Helpful</option>
                                <option value="highest">Highest Rating</option>
                                <option value="lowest">Lowest Rating</option>
                            </select>
                        </div>
                    </div>

                    <div class="reviews-list">
                        <!-- Review 1 -->
                        <div class="review-item">
                            <div class="review-header">
                                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Reviewer" class="reviewer-avatar">
                                <div class="reviewer-info">
                                    <div class="reviewer-name">Emma Johnson</div>
                                    <div class="review-rating">
                                        <div class="review-stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="review-date">Mar 19, 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>This was an absolutely incredible experience! The sunset views of Istanbul from the Bosphorus were breathtaking. Our host Ahmet was knowledgeable and friendly, pointing out historical landmarks and sharing interesting stories about the city. The traditional Turkish refreshments served on board were delicious too.</p>
                                <p>I especially appreciated how Ahmet made sure everyone felt included and comfortable, even though we were all strangers at the start. By the end of the cruise, we were exchanging contact details and planning to meet up again!</p>
                            </div>
                            <div class="review-photos">
                                <img src="/api/placeholder/100/100" alt="Review Photo" class="review-photo" onclick="openModal(this.src)">
                                <img src="/api/placeholder/100/100" alt="Review Photo" class="review-photo" onclick="openModal(this.src)">
                                <img src="/api/placeholder/100/100" alt="Review Photo" class="review-photo" onclick="openModal(this.src)">
                            </div>
                            <div class="review-footer">
                                <div class="review-footer-left">
                                    <div class="review-action">
                                        <i class="far fa-thumbs-up"></i>
                                        <span>Helpful (8)</span>
                                    </div>
                                    <div class="review-action">
                                        <i class="far fa-comment"></i>
                                        <span>Reply</span>
                                    </div>
                                </div>
                                <div class="review-action">
                                    <i class="fas fa-flag"></i>
                                    <span>Report</span>
                                </div>
                            </div>
                            <div class="host-response">
                                <div class="host-response-header">
                                    <span class="host-badge">Host</span>
                                    <span class="host-response-date">Responded on Mar 20, 2025</span>
                                </div>
                                <p>Thank you so much for your kind words, Emma! I'm thrilled that you enjoyed the sunset cruise and the refreshments. It was a pleasure hosting you and the rest of the group. Looking forward to seeing you at future events!</p>
                            </div>
                        </div>

                        <!-- Review 2 -->
                        <div class="review-item">
                            <div class="review-header">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Reviewer" class="reviewer-avatar">
                                <div class="reviewer-info">
                                    <div class="reviewer-name">David Wilson</div>
                                    <div class="review-rating">
                                        <div class="review-stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="review-date">Mar 19, 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>As a photography enthusiast, this cruise offered some of the best photo opportunities I've had in Istanbul. The golden hour light on the cityscape was perfect, and Ahmet knew exactly where to position the boat for the best shots of Hagia Sophia and the Blue Mosque.</p>
                                <p>Beyond the views, I really appreciated the small group size which allowed for genuine conversations. Made some great connections with fellow travelers and locals alike. Highly recommended!</p>
                            </div>
                            <div class="review-photos">
                                <img src="/api/placeholder/100/100" alt="Review Photo" class="review-photo" onclick="openModal(this.src)">
                                <img src="/api/placeholder/100/100" alt="Review Photo" class="review-photo" onclick="openModal(this.src)">
                            </div>
                            <div class="review-footer">
                                <div class="review-footer-left">
                                    <div class="review-action">
                                        <i class="far fa-thumbs-up"></i>
                                        <span>Helpful (5)</span>
                                    </div>
                                    <div class="review-action">
                                        <i class="far fa-comment"></i>
                                        <span>Reply</span>
                                    </div>
                                </div>
                                <div class="review-action">
                                    <i class="fas fa-flag"></i>
                                    <span>Report</span>
                                </div>
                            </div>
                            <div class="host-response">
                                <div class="host-response-header">
                                    <span class="host-badge">Host</span>
                                    <span class="host-response-date">Responded on Mar 20, 2025</span>
                                </div>
                                <p>Thank you for your review, David! I'm so glad you got some great photos during our cruise. Your shots of the sunset over the Bosphorus Bridge were amazing! Hope to see you at another event soon.</p>
                            </div>
                        </div>

                        <!-- Review 3 -->
                        <div class="review-item">
                            <div class="review-header">
                                <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Reviewer" class="reviewer-avatar">
                                <div class="reviewer-info">
                                    <div class="reviewer-name">Olivia Martinez</div>
                                    <div class="review-rating">
                                        <div class="review-stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <div class="review-date">Mar 18, 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>The cruise was beautiful and Ahmet is a fantastic host. Very knowledgeable about Istanbul's history and architecture. The only reason I'm giving 4 stars instead of 5 is that it was a bit chilly on the water and I wish I had known to bring a warmer jacket. That said, Ahmet did offer blankets which was thoughtful.</p>
                                <p>The Turkish tea and baklava served were delicious and a perfect way to end the evening. Would definitely recommend this experience, just remember to dress warmly if you're going in the evening!</p>
                            </div>
                            <div class="review-footer">
                                <div class="review-footer-left">
                                    <div class="review-action">
                                        <i class="far fa-thumbs-up"></i>
                                        <span>Helpful (3)</span>
                                    </div>
                                    <div class="review-action">
                                        <i class="far fa-comment"></i>
                                        <span>Reply</span>
                                    </div>
                                </div>
                                <div class="review-action">
                                    <i class="fas fa-flag"></i>
                                    <span>Report</span>
                                </div>
                            </div>
                            <div class="host-response">
                                <div class="host-response-header">
                                    <span class="host-badge">Host</span>
                                    <span class="host-response-date">Responded on Mar 19, 2025</span>
                                </div>
                                <p>Thank you for your feedback, Olivia! You're absolutely right about the evening chill on the water, and I appreciate the suggestion. I'll make sure to include a note about bringing warm clothing in the event description for future cruises. I'm glad you enjoyed the tea and baklava despite the cooler temperatures!</p>
                            </div>
                        </div>

                        <!-- More reviews would go here -->
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="reviews-sidebar">
                <!-- Add Review -->
                <div class="sidebar-card">
                    <h3>Write a Review</h3>
                    <div class="add-review-form">
                        <div class="rating-input">
                            <label class="rating-label">Your Rating</label>
                            <div class="star-rating">
                                <i class="far fa-star" data-rating="1"></i>
                                <i class="far fa-star" data-rating="2"></i>
                                <i class="far fa-star" data-rating="3"></i>
                                <i class="far fa-star" data-rating="4"></i>
                                <i class="far fa-star" data-rating="5"></i>
                            </div>
                        </div>
                        <textarea class="review-textarea" placeholder="Share your experience... What did you like? What could be improved?"></textarea>
                        <div class="photo-upload">
                            <label class="rating-label">Add Photos (Optional)</label>
                            <div class="upload-btn">
                                <i class="fas fa-camera"></i>
                                <span>Upload Photos</span>
                                <input type="file" id="photo-input" style="display: none;" multiple accept="image/*">
                            </div>
                            <div class="photo-preview">
                                <!-- Preview images will be added here dynamically -->
                            </div>
                        </div>
                        <button class="submit-review">Submit Review</button>
                    </div>
                </div>

                <!-- Review Stats -->
                <div class="sidebar-card">
                    <h3>Event Highlights</h3>
                    <div class="review-stats">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">18/25</div>
                                <div class="stat-label">Attendance Rate</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">8</div>
                                <div class="stat-label">New Connections Made</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">12</div>
                                <div class="stat-label">Reviews Received</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Mentions -->
                <div class="sidebar-card">
                    <h3>Most Mentioned</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <div style="background-color: #f5f5f5; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-thumbs-up" style="color: #f5a623; margin-right: 5px;"></i> Amazing views
                        </div>
                        <div style="background-color: #f5f5f5; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-thumbs-up" style="color: #f5a623; margin-right: 5px;"></i> Friendly host
                        </div>
                        <div style="background-color: #f5f5f5; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-thumbs-up" style="color: #f5a623; margin-right: 5px;"></i> Delicious food
                        </div>
                        <div style="background-color: #f5f5f5; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-thumbs-up" style="color: #f5a623; margin-right: 5px;"></i> Great photos
                        </div>
                        <div style="background-color: #f5f5f5; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-thumbs-down" style="color: #e74c3c; margin-right: 5px;"></i> Cold at night
                        </div>
                    </div>
                </div>

                <!-- Similar Events -->
                <div class="sidebar-card">
                    <h3>Similar Events</h3>
                    <div class="similar-events">
                        <div class="similar-event">
                            <img src="/api/placeholder/60/60" alt="Event" class="similar-event-image">
                            <div class="similar-event-info">
                                <div class="similar-event-title">Evening Boat Tour & Dinner Cruise</div>
                                <div class="similar-event-meta">Apr 15, 2025 • Eminönü</div>
                            </div>
                        </div>
                        <div class="similar-event">
                            <img src="/api/placeholder/60/60" alt="Event" class="similar-event-image">
                            <div class="similar-event-info">
                                <div class="similar-event-title">Photography Walk: Golden Hour in Istanbul</div>
                                <div class="similar-event-meta">Apr 10, 2025 • Sultanahmet</div>
                            </div>
                        </div>
                        <div class="similar-event">
                            <img src="/api/placeholder/60/60" alt="Event" class="similar-event-image">
                            <div class="similar-event-info">
                                <div class="similar-event-title">Sunset Rooftop Social</div>
                                <div class="similar-event-meta">Apr 18, 2025 • Beyoğlu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Modal -->
    <div class="modal" id="photoModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Full size photo">
        </div>
    </div>

    <script>
        // Star Rating Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating i');
            let selectedRating = 0;
            
            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const rating = this.getAttribute('data-rating');
                    
                    // Reset all stars
                    stars.forEach(s => {
                        s.className = 'far fa-star';
                    });
                    
                    // Fill stars up to the hovered one
                    for (let i = 0; i < rating; i++) {
                        stars[i].className = 'fas fa-star';
                    }
                });
                
                star.addEventListener('mouseout', function() {
                    // Reset stars when not hovering
                    stars.forEach(s => {
                        s.className = 'far fa-star';
                    });
                    
                    // Keep selected rating filled
                    for (let i = 0; i < selectedRating; i++) {
                        stars[i].className = 'fas fa-star';
                    }
                });
                
                star.addEventListener('click', function() {
                    selectedRating = this.getAttribute('data-rating');
                    
                    // Update selected stars
                    stars.forEach(s => {
                        s.className = 'far fa-star';
                    });
                    
                    for (let i = 0; i < selectedRating; i++) {
                        stars[i].className = 'fas fa-star';
                        stars[i].classList.add('active');
                    }
                });
            });
        });

        // Photo Upload
        document.addEventListener('DOMContentLoaded', function() {
            const uploadBtn = document.querySelector('.upload-btn');
            const photoInput = document.getElementById('photo-input');
            const photoPreview = document.querySelector('.photo-preview');
            
            uploadBtn.addEventListener('click', function() {
                photoInput.click();
            });
            
            photoInput.addEventListener('change', function() {
                const files = this.files;
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <div class="remove-photo">&times;</div>
                        `;
                        
                        photoPreview.appendChild(previewItem);
                        
                        // Add remove functionality
                        previewItem.querySelector('.remove-photo').addEventListener('click', function() {
                            previewItem.remove();
                        });
                    };
                    
                    reader.readAsDataURL(file);
                }
            });
        });

        // Form Submission
        document.querySelector('.submit-review').addEventListener('click', function() {
            const rating = document.querySelectorAll('.star-rating i.active').length;
            const reviewText = document.querySelector('.review-textarea').value.trim();
            
            if (rating === 0) {
                alert('Please select a rating');
                return;
            }
            
            if (reviewText === '') {
                alert('Please write a review');
                return;
            }
            
            // Simulate form submission
            alert('Thank you for your review! It will be posted after moderation.');
            
            // Reset form
            document.querySelector('.review-textarea').value = '';
            document.querySelectorAll('.star-rating i').forEach(star => {
                star.className = 'far fa-star';
                star.classList.remove('active');
            });
            document.querySelector('.photo-preview').innerHTML = '';
        });

        // Photo Modal
        function openModal(imgSrc) {
            const modal = document.getElementById('photoModal');
            const modalImg = document.getElementById('modalImage');
            modal.classList.add('show');
            modalImg.src = imgSrc;
        }
        
        function closeModal() {
            document.getElementById('photoModal').classList.remove('show');
        }

        // Helpful button functionality
        document.querySelectorAll('.review-action').forEach(action => {
            if (action.querySelector('.fa-thumbs-up')) {
                action.addEventListener('click', function() {
                    const helpfulText = this.querySelector('span');
                    const currentCount = parseInt(helpfulText.textContent.match(/\d+/)[0]);
                    
                    if (this.classList.contains('active')) {
                        helpfulText.textContent = `Helpful (${currentCount - 1})`;
                        this.classList.remove('active');
                    } else {
                        helpfulText.textContent = `Helpful (${currentCount + 1})`;
                        this.classList.add('active');
                    }
                });
            }
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