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
  <?=loadPartial('errors',['errors' => $errors ?? []])?>
        <!--Page Header -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="font-volkhov text-4xl text-[#2c3e50]">Create New Event</h1>
        </div>

        <!-- Create Event Form -->
        <form class="bg-white rounded-lg shadow p-8 mb-8" action="/events" method="POST" enctype="multipart/form-data">
            <!-- Basic Information Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Basic Information</h3>
                <div class="mb-5">
                    <label for="event_title" class="block mb-2 font-medium">Event Title *</label>
                    <input type="text" id="event_title" name="event_title" value="<?=$listing['event_title'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base">
                </div>

                <div class="flex gap-4 mb-5">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_date" class="block mb-2 font-medium">Date *</label>
                            <input type="date" id="event_date" name="event_date" value="<?=$listing['event_date'] ?? '' ?>"class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_time" class="block mb-2 font-medium">Time *</label>
                            <input type="time" id="event_time" name="event_time"value="<?=$listing['event_time'] ?? '' ?>"  class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 mb-5">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_end_date" class="block mb-2 font-medium">End Date</label>
                            <input type="date" id="event_end_date" name="event_end_date"value="<?=$listing['event_end_date'] ?? '' ?>"  class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base">
                            <span class="block text-sm text-gray-600 mt-1">Optional for multi-day events</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_end_time" class="block mb-2 font-medium">End Time</label>
                            <input type="time" id="event_end_time" name="event_end_time" value="<?=$listing['event_time'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base">
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="event_category" class="block mb-2 font-medium">Category *</label>
                    <select id="event_category" name="event_category" value="<?=$listing['event_category'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
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

                <!-- Added Limit Attendees Field -->
                <div class="mb-5">
                    <label for="event_max_attendees" class="block mb-2 font-medium">Maximum Attendees</label>
                    <input type="number" id="event_max_attendees" name="event_max_attendees" min="1" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" placeholder="Leave blank for unlimited">
                    <span class="block text-sm text-gray-600 mt-1"value="<?=$listing['event_max_attendees']?? '' ?>">Optional - Set a limit for how many people can attend</span>
                </div>
            </div>

            <!-- Location Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Location</h3>
                <div class="mb-5">
                    <label for="event_location_name" class="block mb-2 font-medium">Venue/Location Name *</label>
                    <input type="text" id="event_location_name" name="event_location_name" value="<?=$listing['event_location_name'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                </div>

                <div class="mb-5">
                    <label for="event_location_address" class="block mb-2 font-medium">Address *</label>
                    <input type="text" id="event_location_address" name="event_location_address"value="<?=$listing['event_location_address'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                </div>

                <div class="flex gap-4 mb-5">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_city" class="block mb-2 font-medium">City *</label>
                            <input type="text" id="event_city" name="event_city" value="<?=$listing['event_city'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="event_country" class="block mb-2 font-medium">Country *</label>
                            <input type="text" id="event_country" name="event_country" value="<?=$listing['event_country']?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" required>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="event_location_details" class="block mb-2 font-medium">Location Details</label>
                    <textarea id="event_location_details" name="event_location_details" value="<?=$listing['event_location_details']?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base min-h-[120px] resize-y" placeholder="Provide additional details that will help attendees find the venue (e.g., 'The café is on the second floor' or 'Look for the blue door')"></textarea>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Description</h3>
                <div class="mb-5">
                    <label for="event_description" class="block mb-2 font-medium">Event Description *</label>
                    <textarea id="event_description" name="event_description" value="<?=$listing['event_description'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base min-h-[120px] resize-y" required placeholder="Tell potential attendees about your event. What will happen? What should they expect? Why should they join?"></textarea>
                </div>
            </div>

            <!-- Image Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4 pb-2.5 border-b border-gray-100 text-[#2c3e50]">Event Image</h3>
                <div class="mb-5">
                    <label for="event_image" class="block mb-2 font-medium">Upload Cover Image</label>
                    <input type="file" id="event_image" name="event_image" value="<?=$listing['event_image'] ?? '' ?>" class="w-full py-2.5 px-4 border border-gray-300 rounded focus:border-[#f5a623] focus:outline-none text-base" accept="image/*">
                    <span class="block text-sm text-gray-600 mt-1">Recommended size: 1200×600 pixels. Max file size: 5MB</span>
                    <div class="form-image-preview mt-4 border border-dashed border-gray-300 rounded p-4 text-center">
                        <div class="placeholder-image w-full h-[200px] bg-gray-100 flex items-center justify-center text-gray-600 rounded">
                            <i class="fas fa-image text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Actions -->
            <div class="flex justify-between pt-4 border-t border-gray-100">
            <a href="/events" class="bg-white text-gray-900 border border-gray-300 py-5 px-10 rounded font-medium hover:bg-gray-100 inline-block text-center">Go Back</a>
            <button type="submit" class="bg-[#f5a623] text-white py-3 px-6 rounded font-medium hover:bg-[#e5941d]">Create Event</button>
            </div>
        </form>
    </div>

    <script>
    // Image preview functionality
    const imageInput = document.getElementById('event_image');
    const imagePreview = document.querySelector('.form-image-preview');

    imageInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-[200px] object-cover rounded" />`;
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

    <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>