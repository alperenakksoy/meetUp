<?php
loadPartial('scripts');
// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('header') ?>
 <!-- Main Content -->
 <div class="container max-w-3xl mx-auto px-5 mt-20">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="font-volkhov text-4xl text-[#2c3e50]">Create New Event</h1>
        </div>

        <!-- Create Event Form -->
        <form class="bg-white rounded-lg shadow p-8 mb-8" action="process_event.php" method="POST" enctype="multipart/form-data">
            <!-- Basic Information Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Basic Information</h3>
                <div class="mb-5">
                    <label for="event_title" class="block mb-2 font-medium">Event Title *</label>
                    <input type="text" id="event_title" name="event_title" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                </div>

                <div class="flex gap-4 mb-5">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_date" class="block mb-2 font-medium">Date *</label>
                            <input type="date" id="event_date" name="event_date" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_time" class="block mb-2 font-medium">Time *</label>
                            <input type="time" id="event_time" name="event_time" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 mb-5">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_end_date" class="block mb-2 font-medium">End Date</label>
                            <input type="date" id="event_end_date" name="event_end_date" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base">
                            <span class="block text-sm text-gray-600 mt-1">Optional for multi-day events</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_end_time" class="block mb-2 font-medium">End Time</label>
                            <input type="time" id="event_end_time" name="event_end_time" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base">
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="event_category" class="block mb-2 font-medium">Category *</label>
                    <select id="event_category" name="event_category" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
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

                <div class="mb-5">
                    <label for="event_capacity" class="block mb-2 font-medium">Capacity</label>
                    <input type="number" id="event_capacity" name="event_capacity" min="1" max="999" class="w-24 py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base">
                    <span class="block text-sm text-gray-600 mt-1">Maximum number of attendees (leave blank for unlimited)</span>
                </div>
            </div>

            <!-- Location Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Location</h3>
                <div class="mb-5">
                    <label for="event_location_name" class="block mb-2 font-medium">Venue/Location Name *</label>
                    <input type="text" id="event_location_name" name="event_location_name" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                </div>

                <div class="mb-5">
                    <label for="event_location_address" class="block mb-2 font-medium">Address *</label>
                    <input type="text" id="event_location_address" name="event_location_address" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                </div>

                <div class="flex gap-4 mb-5">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_city" class="block mb-2 font-medium">City *</label>
                            <input type="text" id="event_city" name="event_city" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_country" class="block mb-2 font-medium">Country *</label>
                            <input type="text" id="event_country" name="event_country" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="event_location_details" class="block mb-2 font-medium">Location Details</label>
                    <textarea id="event_location_details" name="event_location_details" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base min-h-[120px] resize-y" placeholder="Provide additional details that will help attendees find the venue (e.g., 'The café is on the second floor' or 'Look for the blue door')"></textarea>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Description</h3>
                <div class="mb-5">
                    <label for="event_description" class="block mb-2 font-medium">Event Description *</label>
                    <textarea id="event_description" name="event_description" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base min-h-[120px] resize-y" required placeholder="Tell potential attendees about your event. What will happen? What should they expect? Why should they join?"></textarea>
                </div>

                <div class="mb-5">
                    <label class="block mb-2 font-medium">Tags</label>
                    <div class="tag-input-container flex flex-wrap gap-2.5 mb-2.5">
                        <div class="bg-gray-100 py-1 px-2.5 rounded-full text-sm flex items-center">Coffee <button type="button" class="ml-1 text-gray-600">×</button></div>
                        <div class="bg-gray-100 py-1 px-2.5 rounded-full text-sm flex items-center">Networking <button type="button" class="ml-1 text-gray-600">×</button></div>
                    </div>
                    <div class="flex gap-2.5">
                        <input type="text" id="tag_input" class="flex-1 py-2 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-sm" placeholder="Add a tag">
                        <button type="button" id="add_tag" class="bg-[#f5a623] text-white py-2 px-4 rounded font-medium cursor-pointer transition-colors hover:bg-[#e5941d]">Add</button>
                    </div>
                    <span class="block text-sm text-gray-600 mt-1">Tags help your event get discovered</span>
                </div>
            </div>

            <!-- Image Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Event Image</h3>
                <div class="mb-5">
                    <label for="event_image" class="block mb-2 font-medium">Upload Cover Image</label>
                    <input type="file" id="event_image" name="event_image" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" accept="image/*">
                    <span class="block text-sm text-gray-600 mt-1">Recommended size: 1200×600 pixels. Max file size: 5MB</span>
                    <div class="form-image-preview mt-4 border border-dashed border-gray-300 rounded p-4 text-center">
                        <div class="placeholder-image w-full h-[200px] bg-gray-100 flex items-center justify-center text-gray-600 rounded">
                            <i class="fas fa-image text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Settings</h3>
                <div class="mb-5">
                    <label class="block mb-2 font-medium">Visibility</label>
                    <div class="flex flex-col gap-2.5">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="event_visibility" value="public" checked class="mr-2.5">
                            Public (Anyone can find and join)
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="event_visibility" value="friends" class="mr-2.5">
                            Friends Only (Only visible to your friends)
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="event_visibility" value="private" class="mr-2.5">
                            Private (By invitation only)
                        </label>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label class="block mb-2 font-medium">Approval Settings</label>
                    <div class="flex flex-col gap-2.5">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="require_approval" value="1" class="mr-2.5">
                            Require approval for attendees
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-between pt-4 border-t border-gray-100">
                <button type="button" class="bg-white text-gray-700 border border-gray-300 py-3 px-6 rounded font-medium hover:bg-gray-100">Save as Draft</button>
                <button type="submit" class="bg-[#f5a623] text-white py-3 px-6 rounded font-medium hover:bg-[#e5941d]">Create Event</button>
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
                    tag.className = 'bg-gray-100 py-1 px-2.5 rounded-full text-sm flex items-center';
                    tag.innerHTML = `${tagText} <button type="button" class="ml-1 text-gray-600">×</button>`;
                    
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
            document.querySelectorAll('.tag-input-container button').forEach(btn => {
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
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Event Image Preview" class="max-w-full max-h-[200px] rounded">`;
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
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
    <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>
