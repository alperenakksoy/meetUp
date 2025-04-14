<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Friends</title>
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
                        <li><a href="events.php">Events</a></li>
                        <li><a href="messages.php">Messages</a></li>
                        <li><a href="friends.php" class="active">Friends</a></li>
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
            <h1 class="page-title">Friends</h1>
            <a href="#" class="btn btn-secondary">
                <i class="fas fa-user-plus"></i> Find Friends
            </a>
        </div>

        <!-- Search and Filters -->
        <div class="friends-controls">
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search friends...">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="filter-group">
                <div class="filter-item">
                    <select class="filter-select">
                        <option value="">All Locations</option>
                        <option value="istanbul">Istanbul</option>
                        <option value="ankara">Ankara</option>
                        <option value="izmir">Izmir</option>
                        <option value="international">International</option>
                    </select>
                </div>
                <div class="filter-item">
                    <select class="filter-select">
                        <option value="">All Interests</option>
                        <option value="travel">Travel</option>
                        <option value="photography">Photography</option>
                        <option value="food">Food</option>
                        <option value="sports">Sports</option>
                        <option value="culture">Culture</option>
                    </select>
                </div>
                <div class="filter-item">
                    <select class="filter-select">
                        <option value="">Sort By</option>
                        <option value="recent">Recently Added</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="mutual">Mutual Friends</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="friends-tabs">
            <div class="tab-item active">All Friends</div>
            <div class="tab-item">Recently Added</div>
            <div class="tab-item">Birthday This Month</div>
            <div class="tab-item">Requests <span class="tab-badge">3</span></div>
            <div class="tab-item">Suggestions</div>
        </div>

        <!-- Friend Requests Section -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">Friend Requests</h2>
                <a href="#" class="view-all">See All</a>
            </div>

            <div class="friend-request">
                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Friend" class="request-avatar">
                <div class="request-info">
                    <div class="request-name">Thomas Anderson</div>
                    <div class="request-mutual">
                        <i class="fas fa-user-friends"></i> 3 mutual friends
                    </div>
                    <div class="request-time">2 days ago</div>
                </div>
                <div class="request-actions">
                    <button class="btn btn-success">
                        <i class="fas fa-check"></i> Accept
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-times"></i> Decline
                    </button>
                </div>
            </div>

            <div class="friend-request">
                <img src="https://randomuser.me/api/portraits/women/70.jpg" alt="Friend" class="request-avatar">
                <div class="request-info">
                    <div class="request-name">Maria Garcia</div>
                    <div class="request-mutual">
                        <i class="fas fa-user-friends"></i> 5 mutual friends
                    </div>
                    <div class="request-time">4 days ago</div>
                </div>
                <div class="request-actions">
                    <button class="btn btn-success">
                        <i class="fas fa-check"></i> Accept
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-times"></i> Decline
                    </button>
                </div>
            </div>

            <div class="friend-request">
                <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Friend" class="request-avatar">
                <div class="request-info">
                    <div class="request-name">John Walker</div>
                    <div class="request-mutual">
                        <i class="fas fa-user-friends"></i> 2 mutual friends
                    </div>
                    <div class="request-time">1 week ago</div>
                </div>
                <div class="request-actions">
                    <button class="btn btn-success">
                        <i class="fas fa-check"></i> Accept
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-times"></i> Decline
                    </button>
                </div>
            </div>
        </div>

        <!-- All Friends Section -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">All Friends (156)</h2>
            </div>

            <div class="friends-grid">
                <!-- Friend 1 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">Emma Johnson</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>London, UK</span>
                        </div>
                        <div class="friend-info">Travel enthusiast, Photography lover</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>2 mutual friends</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Friend 2 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">David Wilson</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Berlin, Germany</span>
                        </div>
                        <div class="friend-info">Hiking, Photography, Cultural exploration</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>3 mutual friends</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Friend 3 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">Sophie Chen</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Tokyo, Japan</span>
                        </div>
                        <div class="friend-info">Food lover, Cultural experiences</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>1 mutual friend</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Friend 4 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">Michael Brown</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Istanbul, Turkey</span>
                        </div>
                        <div class="friend-info">Hiking, Outdoor activities</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>3 mutual friends</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Friend 5 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">Olivia Martinez</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Barcelona, Spain</span>
                        </div>
                        <div class="friend-info">Art, Museums, Culture</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>2 mutual friends</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Friend 6 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">James Taylor</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Amsterdam, Netherlands</span>
                        </div>
                        <div class="friend-info">Cycling, Coffee, Digital nomad</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>4 mutual friends</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Friend 7 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">Isabella Johnson</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Rome, Italy</span>
                        </div>
                        <div class="friend-info">History, Architecture, Food</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>1 mutual friend</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Friend 8 -->
                <div class="friend-card">
                    <div class="friend-card-header">
                        <div class="friend-cover"></div>
                        <div class="friend-avatar-container">
                            <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Friend" class="friend-avatar">
                        </div>
                    </div>
                    <div class="friend-card-body">
                        <h3 class="friend-name">Alexander Kim</h3>
                        <div class="friend-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Seoul, South Korea</span>
                        </div>
                        <div class="friend-info">Technology, Street food, Photography</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Mutual Friend" class="mutual-avatar">
                                <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Mutual Friend" class="mutual-avatar">
                            </div>
                            <span>2 mutual friends</span>
                        </div>
                        <div class="friend-actions">
                            <button class="btn btn-outline friend-action-btn">Message</button>
                            <button class="btn btn-primary friend-action-btn">Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suggestions Section -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">People You May Know</h2>
            </div>

            <div class="suggestion-list">
                <!-- Suggestion 1 -->
                <div class="suggestion-item">
                    <img src="https://randomuser.me/api/portraits/women/85.jpg" alt="Suggestion" class="suggestion-avatar">
                    <div class="suggestion-info">
                        <div class="suggestion-name">Laura Williams</div>
                        <div class="suggestion-details">Photographer from London</div>
                        <div class="suggestion-reason">
                            <i class="fas fa-user-friends"></i>
                            <span>Friends with Emma Johnson and 2 others</span>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add
                    </button>
                </div>

                <!-- Suggestion 2 -->
                <div class="suggestion-item">
                    <img src="https://randomuser.me/api/portraits/men/92.jpg" alt="Suggestion" class="suggestion-avatar">
                    <div class="suggestion-info">
                        <div class="suggestion-name">Daniel Lee</div>
                        <div class="suggestion-details">Travel blogger from Vancouver</div>
                        <div class="suggestion-reason">
                            <i class="fas fa-user-friends"></i>
                            <span>Friends with Michael Brown and 3 others</span>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add
                    </button>
                </div>

                <!-- Suggestion 3 -->
                <div class="suggestion-item">
                    <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Suggestion" class="suggestion-avatar">
                    <div class="suggestion-info">
                        <div class="suggestion-name">Sofia Rodriguez</div>
                        <div class="suggestion-details">Language teacher from Madrid</div>
                        <div class="suggestion-reason">
                            <i class="fas fa-user-friends"></i>
                            <span>Friends with Olivia Martinez</span>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add
                    </button>
                </div>

                <!-- Suggestion 4 -->
                <div class="suggestion-item">
                    <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Suggestion" class="suggestion-avatar">
                    <div class="suggestion-info">
                        <div class="suggestion-name">Ahmed Hassan</div>
                        <div class="suggestion-details">Tour guide from Cairo</div>
                        <div class="suggestion-reason">
                            <i class="fas fa-user-friends"></i>
                            <span>Friends with James Taylor and 1 other</span>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add
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

        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-item');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
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
            display: inline-block;
            text-decoration: none;
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

        .btn-success {
            background-color: #2ecc71;
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
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

        /* Search and Filters */
        .friends-controls {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .search-box {
            position: relative;
            margin-bottom: 15px;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
            background-color: #f5f5f5;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-item {
            flex: 1;
            min-width: 150px;
        }

        .filter-select {
            width: 100%;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        /* Tabs */
        .friends-tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tab-item {
            padding: 10px 20px;
            cursor: pointer;
            position: relative;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .tab-item:hover {
            color: #f5a623;
        }

        .tab-item.active {
            color: #f5a623;
        }

        .tab-item.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #f5a623;
        }

        .tab-badge {
            background-color: #e74c3c;
            color: white;
            border-radius: 10px;
            padding: 0 6px;
            font-size: 12px;
            margin-left: 5px;
        }

        /* Friends Grid */
        .content-section {
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .view-all {
            color: #f5a623;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .view-all:hover {
            color: #e5941d;
        }

        .friends-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .friend-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .friend-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .friend-card-header {
            position: relative;
        }

        .friend-cover {
            height: 80px;
            width: 100%;
            object-fit: cover;
            background-color: #f5a623;
        }

        .friend-avatar-container {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
        }

        .friend-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
        }

        .friend-card-body {
            padding: 50px 15px 15px;
            text-align: center;
        }

        .friend-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .friend-location {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .friend-location i {
            margin-right: 5px;
            font-size: 12px;
            color: #f5a623;
        }

        .friend-info {
            margin-bottom: 15px;
            font-size: 14px;
            color: #555;
        }

        .mutual-friends {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
        }

        .mutual-avatars {
            display: flex;
            margin-right: 5px;
        }

        .mutual-avatar {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid white;
            margin-left: -5px;
        }

        .friend-actions {
            display: flex;
            gap: 10px;
        }

        .friend-action-btn {
            flex: 1;
            padding: 6px 0;
            font-size: 13px;
            border-radius: 4px;
        }

        /* Friend Requests */
        .friend-request {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .friend-request:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .request-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 3px solid #f5a623;
        }

        .request-info {
            flex: 1;
        }

        .request-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .request-mutual {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }

        .request-time {
            font-size: 12px;
            color: #888;
        }

        .request-actions {
            display: flex;
            gap: 10px;
        }

        /* Suggestions */
        .suggestion-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }

        .suggestion-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .suggestion-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .suggestion-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #f5a623;
        }

        .suggestion-info {
            flex: 1;
        }

        .suggestion-name {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .suggestion-details {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }

        .suggestion-reason {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: #888;
        }

        .suggestion-reason i {
            margin-right: 5px;
            font-size: 12px;
            color: #f5a623;
        }

        .suggestion-actions {
            display: flex;
            gap: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .friends-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .suggestion-list {
                grid-template-columns: 1fr;
            }

            .filter-group {
                flex-direction: column;
            }

            .request-actions {
                flex-direction: column;
            }

            .friend-request {
                flex-direction: column;
                text-align: center;
            }

            .request-avatar {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .request-actions {
                margin-top: 10px;
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