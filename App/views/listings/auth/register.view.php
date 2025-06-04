<?= loadWelcomePartial('headWl'); ?>

<body class="min-h-screen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <!-- Header -->
    <?= loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <main class="flex items-center justify-center px-4 py-8" style="min-height: calc(100vh - 140px); margin-top: 70px;">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Simple Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Create Account</h1>
                    <p class="text-gray-600">Join SocialLoop and start connecting</p>
                </div>

                <!-- Register Form -->
                <form method="POST" action="/register" class="space-y-6">
                    <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>
                    <?= loadPartial('message') ?>

                    <!-- Name Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input 
                                type="text" 
                                id="first_name"
                                name="first_name" 
                                placeholder="First Name" 
                                value="<?= $user['first_name'] ?? '' ?>" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            >
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input 
                                type="text" 
                                id="last_name"
                                name="last_name" 
                                placeholder="Last Name" 
                                value="<?= $user['last_name'] ?? '' ?>" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            >
                        </div>
                    </div>
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            placeholder="Enter your email" 
                            value="<?= $user['email'] ?? '' ?>" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>
                    
                    <!-- Password Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                placeholder="Password" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            >
                            <p class="text-xs text-gray-500 mt-1">At least 6 characters</p>
                        </div>
                        
                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input 
                                type="password" 
                                id="confirm_password"
                                name="confirm_password" 
                                placeholder="Confirm Password" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            >
                        </div>
                    </div>
                    
                    <!-- Location Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <select 
                                id="country" 
                                name="country" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            >
                                <option value="" disabled selected>Select Country</option>
                                <!-- Countries will be populated via JS -->
                            </select>
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                            <div id="cityContainer">
                                <select 
                                    id="city" 
                                    name="city" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    disabled
                                >
                                    <option value="" disabled selected>Select City</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Date of Birth & Gender -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input 
                                type="date" 
                                id="date_of_birth"
                                name="date_of_birth" 
                                value="<?= $user['date_of_birth'] ?? '' ?>" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            >
                        </div>
                        
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select 
                                id="gender"
                                name="gender" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            >
                                <option value="" disabled <?= empty($user['gender']) ? 'selected' : '' ?>>Select Gender</option>
                                <option value="Male" <?= isset($user['gender']) && $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= isset($user['gender']) && $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= isset($user['gender']) && $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                                <option value="Prefer not to say" <?= isset($user['gender']) && $user['gender'] == 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
                            </select>
                        </div>
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="flex items-start space-x-3">
                        <input 
                            type="checkbox" 
                            id="terms" 
                            name="terms" 
                            required 
                            class="mt-1 h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                        >
                        <label for="terms" class="text-sm text-gray-700">
                            I agree to the 
                            <a href="#" class="text-primary hover:underline">Terms of Service</a> 
                            and 
                            <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-secondary text-white font-medium py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200"
                    >
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <div class="text-center pt-4 border-t border-gray-200">
                        <p class="text-gray-600">
                            Already have an account? 
                            <a href="/login" class="text-primary font-medium hover:underline">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?= loadWelcomePartial('footerWl'); ?>

    <script>
        // Simple country and city handling
        const countrySelect = document.getElementById('country');
        const cityContainer = document.getElementById('cityContainer');

        function switchToCityInput(prefilledValue = '') {
            cityContainer.innerHTML = `
                <input type="text" id="city" name="city" placeholder="Enter your city" value="${prefilledValue}" 
                required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            `;
        }

        // Load common countries
        function loadCountries() {
            const commonCountries = [
                'Turkey', 'United States', 'United Kingdom', 'Germany', 'France', 
                'Italy', 'Spain', 'Canada', 'Australia', 'Japan', 'Netherlands',
                'Sweden', 'Norway', 'Denmark', 'Switzerland', 'Austria', 'Belgium'
            ].sort();

            commonCountries.forEach(country => {
                const option = document.createElement('option');
                option.value = country;
                option.textContent = country;
                countrySelect.appendChild(option);
            });

            const previousCountry = "<?= $user['country'] ?? '' ?>";
            if (previousCountry) {
                countrySelect.value = previousCountry;
                switchToCityInput("<?= $user['city'] ?? '' ?>");
            }
        }

        loadCountries();

        // When country is selected, switch to city input
        countrySelect.addEventListener('change', function() {
            if (this.value) {
                switchToCityInput("<?= $user['city'] ?? '' ?>");
            }
        });
    </script>
</body>
</html>