<?php require_once __DIR__ . '/../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>

<body class="bg-lightbg min-h-screen flex flex-col pt-20">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <div class="bg-white rounded-2xl w-full max-w-md mx-auto p-10 shadow-lg mb-10">
        <form action="/reset-password" method="POST">
            <h1 class="mb-2.5 text-2xl text-center text-gray-800 font-bold">Enter New Password</h1>
            <p class="text-center text-gray-600 mb-8 text-sm">Create a strong password for your account</p>
            
            <div class="mb-6">
                <label for="newPassword" class="block mb-2 text-gray-800 font-medium text-sm">New Password</label>
                <div class="relative flex items-center">
                    <input 
                        type="password" 
                        id="newPassword" 
                        name="newPassword"
                        placeholder="Enter your new password"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}"
                        required
                        class="w-full h-12 bg-gray-100 border border-gray-300 rounded-lg px-4 text-base transition duration-300 focus:border-primary focus:outline-none focus:shadow-outline-primary"
                    >
                    <button type="button" class="absolute right-2.5 bg-transparent border-none cursor-pointer p-1.5 flex items-center justify-center" aria-label="Show password">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-gray-500 hover:fill-gray-700 transition-colors duration-300">
                            <path d="M12 4.5c-5 0-9.3 3-11 7.5 1.7 4.5 6 7.5 11 7.5s9.3-3 11-7.5c-1.7-4.5-6-7.5-11-7.5zm0 12.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"/>
                        </svg>
                    </button>
                </div>
                <div class="mt-3 p-3 bg-gray-100 rounded-lg text-xs">
                    <p class="text-gray-600 mb-2 font-medium">Password must contain:</p>
                    <ul class="list-none pl-2">
                        <li class="text-gray-600 mb-1 flex items-center gap-2 before:content-['•'] before:text-gray-400">At least 8 characters</li>
                        <li class="text-gray-600 mb-1 flex items-center gap-2 before:content-['•'] before:text-gray-400">One uppercase letter</li>
                        <li class="text-gray-600 mb-1 flex items-center gap-2 before:content-['•'] before:text-gray-400">One lowercase letter</li>
                        <li class="text-gray-600 mb-1 flex items-center gap-2 before:content-['•'] before:text-gray-400">One number</li>
                        <li class="text-gray-600 mb-1 flex items-center gap-2 before:content-['•'] before:text-gray-400">One special character (!@#$%^&*)</li>
                    </ul>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="confirmPassword" class="block mb-2 text-gray-800 font-medium text-sm">Confirm Password</label>
                <div class="relative flex items-center">
                    <input 
                        type="password" 
                        id="confirmPassword" 
                        name="confirmPassword"
                        placeholder="Confirm your password"
                        required
                        class="w-full h-12 bg-gray-100 border border-gray-300 rounded-lg px-4 text-base transition duration-300 focus:border-primary focus:outline-none focus:shadow-outline-primary"
                    >
                    <button type="button" class="absolute right-2.5 bg-transparent border-none cursor-pointer p-1.5 flex items-center justify-center" aria-label="Show password">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-gray-500 hover:fill-gray-700 transition-colors duration-300">
                            <path d="M12 4.5c-5 0-9.3 3-11 7.5 1.7 4.5 6 7.5 11 7.5s9.3-3 11-7.5c-1.7-4.5-6-7.5-11-7.5zm0 12.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full h-12 bg-gray-800 border-none rounded-lg text-white text-base font-semibold cursor-pointer transition-all duration-300 mt-2.5 hover:bg-primary hover:transform hover:-translate-y-0.5 active:translate-y-0">Reset Password</button>

            <div class="text-center mt-5 text-sm text-gray-600">
                <p>Remember your password? <a href="/../login_registerScreen/loginIndex.php" class="text-primary no-underline font-semibold transition-colors duration-300 hover:text-gray-800 hover:underline">Sign in</a></p>
            </div>
        </form>
    </div>
          <!--Footer -->
    <?=loadWelcomePartial('footerWl'); ?>

    <script>
        // Show/hide password functionality
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordButtons = document.querySelectorAll('.absolute.right-2\\.5');
            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    // Toggle eye icon (optional enhancement)
                    // const eyeIcon = this.querySelector('svg path');
                    // if (type === 'text') {
                    //     eyeIcon.setAttribute('d', 'M12 7c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8c-1.7 0-3-1.3-3-3s1.3-3 3-3 3 1.3 3 3-1.3 3-3 3z M23 12c-1.7-4.5-6-7.5-11-7.5S2.7 7.5 1 12c1.7 4.5 6 7.5 11 7.5s9.3-3 11-7.5z');
                    // } else {
                    //     eyeIcon.setAttribute('d', 'M12 4.5c-5 0-9.3 3-11 7.5 1.7 4.5 6 7.5 11 7.5s9.3-3 11-7.5c-1.7-4.5-6-7.5-11-7.5zm0 12.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z');
                    // }
                });
            });
        });
  
    </script>
</body>
</html>