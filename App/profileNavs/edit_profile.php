<?php
require  '../../helpers.php';

// Set page variables
$pageTitle = 'Edit Profile';
$activePage = 'profile';
$isLoggedIn = true;

// In a real application, you would fetch the user's data from the database
// For now, we'll use hardcoded data as a placeholder
$user = [
    'id' => 1,
    'first_name' => 'Ahmet Alperen',
    'last_name' => 'Aksoy',
    'email' => 'ahmet.aksoy@example.com',
    'location' => 'Istanbul, Turkey',
    'age' => 27,
    'occupation' => 'Software Engineer',
    'joined_date' => 'January 2023',
    'bio' => 'Software engineering graduate passionate about travel, technology, and bringing people together. Created SocialLoop as my B.Sc. thesis project to help travelers connect with locals through shared experiences.',
    'interests' => ['Travel', 'Photography', 'Hiking', 'Coffee', 'Technology', 'Languages', 'Culture'],
    'profile_image' => 'https://randomuser.me/api/portraits/men/32.jpg'
];
?>

<?php loadPartial('head') ?>

<body class="bg-gray-50 pt-20">

    <!-- Main Content -->
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Page Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800 font-volkhov">Edit Profile</h1>
                <a href="/../App/userHome/profile.php" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Profile
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <form action="process_profile_update.php" method="POST" enctype="multipart/form-data" class="p-6">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    
                    <!-- Profile Photo Section -->
                    <div class="mb-8 flex flex-col items-center">
                        <h2 class="w-full text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Profile Photo</h2>
                        <div class="relative mb-4">
                            <img src="<?php echo $user['profile_image']; ?>" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-gray-100 mx-auto">
                            <button type="button" class="absolute bottom-0 right-0 bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 shadow-md" id="changePhotoBtn">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <input type="file" name="profile_image" id="profileImageInput" class="hidden" accept="image/*">
                        <div class="text-sm text-gray-500">Click the camera icon to change your profile photo</div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Personal Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input 
                                    type="text" 
                                    id="first_name" 
                                    name="first_name" 
                                    value="<?php echo $user['first_name']; ?>" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    required
                                >
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input 
                                    type="text" 
                                    id="last_name" 
                                    name="last_name" 
                                    value="<?php echo $user['last_name']; ?>" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    required
                                >
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="<?php echo $user['email']; ?>" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    required
                                >
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                <input 
                                    type="text" 
                                    id="location" 
                                    name="location" 
                                    value="<?php echo $user['location']; ?>" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                            </div>

                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                                <input 
                                    type="number" 
                                    id="age" 
                                    name="age" 
                                    value="<?php echo $user['age']; ?>" 
                                    min="18" 
                                    max="120" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                            </div>

                            <div>
                                <label for="occupation" class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                                <input 
                                    type="text" 
                                    id="occupation" 
                                    name="occupation" 
                                    value="<?php echo $user['occupation']; ?>" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- About Me Section -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">About Me</h2>
                        
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea 
                                id="bio" 
                                name="bio" 
                                rows="4" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none"
                            ><?php echo $user['bio']; ?></textarea>
                            <p class="text-sm text-gray-500 mt-1">Brief description about yourself that will be displayed on your profile.</p>
                        </div>
                    </div>

                    <!-- Interests Section -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Interests</h2>
                        
                        <div>
                            <div class="mb-2">
                                <div class="flex flex-wrap gap-2" id="interestsContainer">
                                    <?php foreach ($user['interests'] as $interest): ?>
                                    <div class="bg-orange-100 flex items-center px-3 py-1 rounded-full text-sm">
                                        <span><?php echo $interest; ?></span>
                                        <button type="button" class="ml-2 text-gray-500 hover:text-gray-700 remove-interest">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="flex gap-2 mt-4">
                                <input 
                                    type="text" 
                                    id="newInterest" 
                                    placeholder="Add a new interest" 
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                                <button 
                                    type="button" 
                                    id="addInterestBtn" 
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors"
                                >
                                    Add
                                </button>
                            </div>
                            <input type="hidden" name="interests" id="interestsInput" value="<?php echo implode(',', $user['interests']); ?>">
                            <p class="text-sm text-gray-500 mt-1">Add your interests to connect with like-minded people.</p>
                        </div>
                    </div>

                    <!-- Account Settings Section (Password Change) -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Change Password</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input 
                                    type="password" 
                                    id="current_password" 
                                    name="current_password" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                            </div>

                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input 
                                        type="password" 
                                        id="new_password" 
                                        name="new_password" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    >
                                </div>

                                <div>
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input 
                                        type="password" 
                                        id="confirm_password" 
                                        name="confirm_password" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    >
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 md:col-span-2">Leave password fields empty if you don't want to change it.</p>
                        </div>
                    </div>

                    <!-- Privacy Settings Section -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Privacy Settings</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="profile_public" 
                                    name="privacy_settings[profile_public]" 
                                    value="1" 
                                    checked 
                                    class="h-4 w-4 text-orange-500 focus:ring-orange-500 rounded"
                                >
                                <label for="profile_public" class="ml-2 block text-sm text-gray-700">Make my profile public</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="show_email" 
                                    name="privacy_settings[show_email]" 
                                    value="1" 
                                    class="h-4 w-4 text-orange-500 focus:ring-orange-500 rounded"
                                >
                                <label for="show_email" class="ml-2 block text-sm text-gray-700">Show my email to other users</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="show_age" 
                                    name="privacy_settings[show_age]" 
                                    value="1" 
                                    checked 
                                    class="h-4 w-4 text-orange-500 focus:ring-orange-500 rounded"
                                >
                                <label for="show_age" class="ml-2 block text-sm text-gray-700">Show my age on my profile</label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-between border-t border-gray-100 pt-6">
                        <a href="/../App/userHome/profile.php" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-6 rounded-lg transition-colors">
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-lg transition-colors"
                        >
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?=loadPartial(name: 'footer'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profile Image Upload
            const changePhotoBtn = document.getElementById('changePhotoBtn');
            const profileImageInput = document.getElementById('profileImageInput');

            changePhotoBtn.addEventListener('click', function() {
                profileImageInput.click();
            });

            profileImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        document.querySelector('img[alt="Profile Picture"]').src = e.target.result;
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Interests Management
            const interestsContainer = document.getElementById('interestsContainer');
            const newInterestInput = document.getElementById('newInterest');
            const addInterestBtn = document.getElementById('addInterestBtn');
            const interestsInput = document.getElementById('interestsInput');

            // Function to update the hidden input with all interests
            function updateInterestsInput() {
                const interests = [];
                interestsContainer.querySelectorAll('div.bg-orange-100 span').forEach(span => {
                    interests.push(span.textContent.trim());
                });
                interestsInput.value = interests.join(',');
            }

            // Add a new interest
            addInterestBtn.addEventListener('click', function() {
                const interest = newInterestInput.value.trim();
                
                if (interest) {
                    // Create the interest element
                    const interestElement = document.createElement('div');
                    interestElement.className = 'bg-orange-100 flex items-center px-3 py-1 rounded-full text-sm';
                    interestElement.innerHTML = `
                        <span>${interest}</span>
                        <button type="button" class="ml-2 text-gray-500 hover:text-gray-700 remove-interest">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    
                    // Add to container
                    interestsContainer.appendChild(interestElement);
                    
                    // Clear input
                    newInterestInput.value = '';
                    
                    // Update hidden input
                    updateInterestsInput();
                }
            });

            // Allow adding interest with Enter key
            newInterestInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addInterestBtn.click();
                }
            });

            // Remove interest when clicking the remove button
            interestsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-interest') || e.target.parentElement.classList.contains('remove-interest')) {
                    // Find the interest element to remove
                    const interestElement = e.target.closest('div.bg-orange-100');
                    
                    // Remove it
                    if (interestElement) {
                        interestElement.remove();
                        
                        // Update hidden input
                        updateInterestsInput();
                    }
                }
            });

            // Password Validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = document.getElementById('confirm_password').value;
                
                if (newPassword || confirmPassword) {
                    if (newPassword !== confirmPassword) {
                        e.preventDefault();
                        alert('New password and confirmation do not match.');
                    }
                }
            });
        });
    </script>
</body>
</html>