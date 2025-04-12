<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialLoop - Create Event</title>
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
            max-width: 800px;
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

        /* Form Styles */
        .create-event-form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .form-section h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group .info-text {
            display: block;
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #f5a623;
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-col {
            flex: 1;
        }

        .capacity-input {
            width: 100px;
        }

        .tag-input-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            background-color: #f0f0f0;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .tag button {
            background: none;
            border: none;
            margin-left: 5px;
            cursor: pointer;
            font-size: 0.8rem;
            color: #666;
        }

        .tag-input {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .tag-input input {
            flex: 1;
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .tag-input button {
            background-color: #f5a623;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkbox-group {
            margin-top: 15px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .checkbox-label input {
            margin-right: 10px;
        }

        .form-image-preview {
            margin-top: 15px;
            border: 1px dashed #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
        }

        .placeholder-image {
            width: 100%;
            height: 200px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            border-radius: 5px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            border: none;
        }

        .btn-primary {
            background-color: #f5a623;
            color: white;
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

        /* Responsive Styles */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 20px;
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
            <h1 class="page-title">Create New Event</h1>
        </div>

        <!-- Create Event Form -->
        <form class="create-event-form" action="process_event.php" method="POST" enctype="multipart/form-data">
            <!-- Basic Information Section -->
            <div class="form-section">
                <h3>Basic Information</h3>
                <div class="form-group">
                    <label for="event_title">Event Title *</label>
                    <input type="text" id="event_title" name="event_title" class="form-control" required>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="event_date">Date *</label>
                            <input type="date" id="event_date" name="event_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="event_time">Time *</label>
                            <input type="time" id="event_time" name="event_time" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="event_end_date">End Date</label>
                            <input type="date" id="event_end_date" name="event_end_date" class="form-control">
                            <span class="info-text">Optional for multi-day events</span>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="event_end_time">End Time</label>
                            <input type="time" id="event_end_time" name="event_end_time" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="event_category">Category *</label>
                    <select id="event_category" name="event_category" class="form-control" required>
                        <option value="">Select a category</option>
                        <option value="coffee">Coffee & Drinks</option>
                        <option value="cultural">Cultural</option>
                        <option value="sports">Sports & Outdoor</option>
                        <option value="language">Language Exchange</option>
                        <option value="food">Food & Dining</option>
                        <option value="art">Art & Music</option>
                        <option value="tech">Technology</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="event_capacity">Capacity</label>
                    <input type="number" id="event_capacity" name="event_capacity" min="1" max="999" class="form-control capacity-input">
                    <span class="info-text">Maximum number of attendees (leave blank for unlimited)</span>
                </div>
            </div>

            <!-- Location Section -->
            <div class="form-section">
                <h3>Location</h3>
                <div class="form-group">
                    <label for="event_location_name">Venue/Location Name *</label>
                    <input type="text" id="event_location_name" name="event_location_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="event_location_address">Address *</label>
                    <input type="text" id="event_location_address" name="event_location_address" class="form-control" required>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="event_city">City *</label>
                            <input type="text" id="event_city" name="event_city" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="event_country">Country *</label>
                            <input type="text" id="event_country" name="event_country" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="event_location_details">Location Details</label>
                    <textarea id="event_location_details" name="event_location_details" class="form-control" placeholder="Provide additional details that will help attendees find the venue (e.g., 'The café is on the second floor' or 'Look for the blue door')"></textarea>
                </div>
            </div>

            <!-- Description Section -->
            <div class="form-section">
                <h3>Description</h3>
                <div class="form-group">
                    <label for="event_description">Event Description *</label>
                    <textarea id="event_description" name="event_description" class="form-control" required placeholder="Tell potential attendees about your event. What will happen? What should they expect? Why should they join?"></textarea>
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <div class="tag-input-container">
                        <div class="tag">Coffee <button type="button">×</button></div>
                        <div class="tag">Networking <button type="button">×</button></div>
                    </div>
                    <div class="tag-input">
                        <input type="text" id="tag_input" class="form-control" placeholder="Add a tag">
                        <button type="button" id="add_tag" class="btn-primary">Add</button>
                    </div>
                    <span class="info-text">Tags help your event get discovered</span>
                </div>
            </div>

            <!-- Image Section -->
            <div class="form-section">
                <h3>Event Image</h3>
                <div class="form-group">
                    <label for="event_image">Upload Cover Image</label>
                    <input type="file" id="event_image" name="event_image" class="form-control" accept="image/*">
                    <span class="info-text">Recommended size: 1200×600 pixels. Max file size: 5MB</span>
                    <div class="form-image-preview">
                        <div class="placeholder-image">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="form-section">
                <h3>Settings</h3>
                <div class="form-group">
                    <label>Visibility</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="radio" name="event_visibility" value="public" checked>
                            Public (Anyone can find and join)
                        </label>
                        <label class="checkbox-label">
                            <input type="radio" name="event_visibility" value="friends">
                            Friends Only (Only visible to your friends)
                        </label>
                        <label class="checkbox-label">
                            <input type="radio" name="event_visibility" value="private">
                            Private (By invitation only)
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Approval Settings</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="require_approval" value="1">
                            Require approval for attendees
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-secondary">Save as Draft</button>
                <button type="submit" class="btn btn-primary">Create Event</button>
            </div>
        </form>
    </div>

    <script>
        // Script for tag input functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tagInput = document.getElementById('tag_input');
            const addTagBtn = document.getElementById('add_tag');
            const tagContainer = document.querySelector('.tag-input-container');
            
            // Add tag function
            const addTag = () => {
                const tagText = tagInput.value.trim();
                if (tagText) {
                    // Create tag element
                    const tag = document.createElement('div');
                    tag.className = 'tag';
                    tag.innerHTML = `${tagText} <button type="button">×</button>`;
                    
                    // Add delete functionality
                    const deleteBtn = tag.querySelector('button');
                    deleteBtn.addEventListener('click', function() {
                        tag.remove();
                    });
                    
                    // Add to container and clear input
                    tagContainer.appendChild(tag);
                    tagInput.value = '';
                    tagInput.focus();
                }
            };
            
            // Add event listeners
            addTagBtn.addEventListener('click', addTag);
            tagInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addTag();
                }
            });
            
            // Initialize existing tag deletion
            document.querySelectorAll('.tag button').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
            
            // Image preview functionality
            const imageInput = document.getElementById('event_image');
            const imagePreview = document.querySelector('.form-image-preview');
            
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Event Image Preview" style="max-width: 100%; max-height: 200px; border-radius: 5px;">`;
                    };
                    
                    reader.readAsDataURL(this.files[0]);
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

        // Form validation
        const form = document.querySelector('.create-event-form');
        form.addEventListener('submit', function(e) {
            const required = form.querySelectorAll('[required]');
            let valid = true;
            
            required.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.style.borderColor = '#e74c3c';
                } else {
                    field.style.borderColor = '#ddd';
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    </script>
</body>
</html>