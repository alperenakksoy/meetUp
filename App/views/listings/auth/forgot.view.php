<?=loadWelcomePartial('headWl'); ?>

<body class="bg-lightbg min-h-screen flex flex-col pt-20">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <div class="bg-white rounded-2xl w-full max-w-md mx-auto p-10 shadow-lg mb-10">
        <form id="resetForm">
            <h1 class="mb-6 text-2xl text-center text-gray-800 font-bold">Forgot Your Password?</h1>
            <p class="text-center text-gray-600 mb-8 text-sm leading-normal">Enter your email address and we'll send you instructions to reset your password.</p>
            
            <div class="mb-6">
                <label for="email" class="block mb-2 text-gray-800 font-medium text-sm">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    placeholder="Enter your email" 
                    required
                    class="w-full h-12 bg-gray-100 border border-gray-300 rounded-lg px-4 text-base transition duration-300 focus:border-primary focus:outline-none focus:shadow-outline-primary"
                >
            </div>

            <button type="submit" class="w-full h-12 bg-gray-800 border-none rounded-lg text-white text-base font-semibold cursor-pointer transition-all duration-300 hover:bg-primary">Send Reset Link</button>
            
            <div class="success-message hidden mt-5 text-center text-green-600 bg-green-100 p-2.5 rounded-lg">
                Check your email for password reset instructions!
            </div>
            
            <div class="error-message hidden mt-5 text-center text-red-600 bg-red-100 p-2.5 rounded-lg">
                Sorry, we couldn't find an account with that email address.
            </div>

            <div class="text-center mt-5 text-sm text-gray-600">
                <p>Remember your password? <a href="/../login_registerScreen/loginIndex.php" class="text-primary no-underline font-semibold transition-colors duration-300 hover:text-gray-800 hover:underline">Sign in</a></p>
            </div>
        </form>
    </div>

      <!--Footer -->
      <?=loadWelcomePartial('footerWl'); ?>

    <script>
        // Form submission handler
        document.addEventListener('DOMContentLoaded', function() {
            const resetForm = document.getElementById('resetForm');
            const successMessage = document.querySelector('.success-message');
            const errorMessage = document.querySelector('.error-message');
            
            resetForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = document.getElementById('email').value;
                
                // Here you would typically make an API call to your backend
                // For demo purposes, we'll just show success message
                
                // Simulate API call with timeout
                setTimeout(() => {
                    // Show success message (for demo purposes)
                    successMessage.classList.remove('hidden');
                    errorMessage.classList.add('hidden');
                    
                    // Clear form
                    resetForm.reset();
                    
                    // Hide success message after 5 seconds
                    setTimeout(() => {
                        successMessage.classList.add('hidden');
                    }, 5000);
                }, 1000);
            });
        });
        
    </script>
</body>
</html>