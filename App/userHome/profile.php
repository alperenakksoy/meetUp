<?php
require_once __DIR__ . '/../../helpers.php';

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('header') ?>
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
    <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>
