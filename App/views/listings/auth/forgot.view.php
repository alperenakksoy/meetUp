<?php
// forgot.view.php - Simplified Forgot Password View
?>
<?=loadWelcomePartial('headWl'); ?>

<body class="min-h-screen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <main class="flex items-center justify-center px-4" style="min-height: calc(100vh - 140px); margin-top: 70px;">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Simple Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Forgot Password?</h1>
                    <p class="text-gray-600">Enter your email to reset your password</p>
                </div>

                <!-- Forgot Password Form -->
                <form id="resetForm" class="space-y-6">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input 
                            type="email" 
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-secondary text-white font-medium py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200"
                    >
                        Send Reset Link
                    </button>

                    <!-- Success Message -->
                    <div class="success-message hidden mt-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-center">
                        Check your email for password reset instructions!
                    </div>
                    
                    <!-- Error Message -->
                    <div class="error-message hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-center">
                        Sorry, we couldn't find an account with that email address.
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center pt-4 border-t border-gray-200">
                        <p class="text-gray-600">
                            Remember your password? 
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
    <?=loadWelcomePartial('footerWl'); ?>

    <script>
        // Simple form submission handler
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const successMessage = document.querySelector('.success-message');
            const errorMessage = document.querySelector('.error-message');
            
            // Hide any existing messages
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
            
            // Simulate API call
            setTimeout(() => {
                // For demo - show success message
                successMessage.classList.remove('hidden');
                this.reset();
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                }, 5000);
            }, 1000);
        });
    </script>
</body>
</html>

<?php
// newpass.view.php - Simplified New Password View  
?>
<?=loadWelcomePartial('headWl'); ?>

<body class="min-h-screen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <main class="flex items-center justify-center px-4" style="min-height: calc(100vh - 140px); margin-top: 70px;">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Simple Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Reset Password</h1>
                    <p class="text-gray-600">Enter your new password</p>
                </div>

                <!-- New Password Form -->
                <form action="/reset-password" method="POST" class="space-y-6">
                    <!-- New Password Field -->
                    <div>
                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input 
                            type="password" 
                            id="newPassword"
                            name="newPassword"
                            placeholder="Enter new password"
                            required
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <!-- Password Requirements -->
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 mb-2">Password must contain:</p>
                        <ul class="text-xs text-gray-600 space-y-1">
                            <li>• At least 8 characters</li>
                            <li>• One uppercase letter (A-Z)</li>
                            <li>• One lowercase letter (a-z)</li>
                            <li>• One number (0-9)</li>
                            <li>• One special character (!@#$%^&*)</li>
                        </ul>
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input 
                            type="password" 
                            id="confirmPassword"
                            name="confirmPassword"
                            placeholder="Confirm new password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-secondary text-white font-medium py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200"
                    >
                        Reset Password
                    </button>

                    <!-- Back to Login -->
                    <div class="text-center pt-4 border-t border-gray-200">
                        <p class="text-gray-600">
                            Remember your password? 
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
    <?=loadWelcomePartial('footerWl'); ?>

    <script>
        // Password validation
        document.addEventListener('DOMContentLoaded', function() {
            const newPassword = document.getElementById('newPassword');
            const confirmPassword = document.getElementById('confirmPassword');
            const form = document.querySelector('form');
            
            // Check password match on form submit
            form.addEventListener('submit', function(e) {
                if (newPassword.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert('Passwords do not match. Please try again.');
                    confirmPassword.focus();
                    return false;
                }
                
                if (newPassword.value.length < 8) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long.');
                    newPassword.focus();
                    return false;
                }
            });
            
            // Real-time password match validation
            confirmPassword.addEventListener('input', function() {
                if (this.value && newPassword.value !== this.value) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#d1d5db';
                }
            });
        });
    </script>
</body>
</html>