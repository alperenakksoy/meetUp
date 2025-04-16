<?php require_once __DIR__ . '/../../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>

<body class="font-sans text-gray-800 bg-white">
   <!-- Header -->
 <?=loadWelcomePartial('headerWl'); ?>
    
    <!-- Hero Section -->
    <section class="bg-primary h-[50vh] flex items-center justify-center text-center text-white mt-[60px]">
        <div class="safety-hero-content">
            <h1 class="text-4xl mb-5 font-volkhov font-bold">Your Safety is Our Priority</h1>
            <p class="text-xl opacity-90">Guidelines and tools to ensure a secure experience</p>
        </div>
    </section>

    <!-- Safety Guidelines Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-5">
            <div class="text-center">
                <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-8 font-bold">Safety Guidelines</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">We are committed to fostering a safe and respectful community. Please follow these guidelines:</p>
                <ul class="list-none mt-8">
                    <li class="text-lg text-gray-600 mb-5">✔️ Respect others' boundaries and privacy.</li>
                    <li class="text-lg text-gray-600 mb-5">✔️ Report suspicious or inappropriate behavior immediately.</li>
                    <li class="text-lg text-gray-600 mb-5">✔️ Avoid sharing sensitive personal information.</li>
                    <li class="text-lg text-gray-600 mb-5">✔️ Meet in public places for initial hangouts.</li>
                    <li class="text-lg text-gray-600 mb-5">✔️ Trust your instincts and prioritize your comfort.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Reporting Section -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-6xl mx-auto px-5 text-center">
            <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-5 font-bold">Report an Issue</h2>
            <p class="text-lg text-gray-600 max-w-xl mx-auto mb-8">If you encounter a problem, let us know so we can take immediate action.</p>
            <a href="report.php" class="inline-block px-8 py-4 bg-primary text-white text-lg font-bold rounded-lg transition-colors duration-300 hover:bg-[#e5941d]">Report Now</a>
        </div>
    </section>

    <!-- Footer  -->
    <?=loadWelcomePartial('footerWl'); ?>

    <!-- Login Popup -->
    <div class="fixed top-0 left-0 w-full h-full bg-black/70 backdrop-blur-md hidden justify-center items-center z-[1000] opacity-0 transition-opacity duration-300 ease-in-out" id="loginPopup">
        <div class="bg-white/95 w-[420px] p-10 rounded-2xl shadow-2xl transform scale-90 opacity-0 transition-all duration-300 cubic-bezier ease-[0.68,-0.55,0.265,1.55] relative">
            <button class="absolute top-5 right-5 w-8 h-8 bg-transparent border-none cursor-pointer transition-transform duration-300 hover:bg-red-100/80" aria-label="Close login popup"></button>
            <form action="">
                <h1 class="text-gray-800 text-2xl font-bold text-center mb-8">Welcome Back</h1>
                <div class="relative mb-6">
                    <input type="email" placeholder="Enter your email" required class="w-full py-4 px-5 bg-white/90 border-2 border-gray-200 rounded-xl text-base text-gray-800 transition-all duration-300 focus:border-primary focus:shadow-[0_0_0_3px_rgba(229,148,29,0.2)]">
                </div>
                <div class="relative mb-6">
                    <input type="password" placeholder="Enter your password" required class="w-full py-4 px-5 bg-white/90 border-2 border-gray-200 rounded-xl text-base text-gray-800 transition-all duration-300 focus:border-primary focus:shadow-[0_0_0_3px_rgba(229,148,29,0.2)]">
                </div>
                <div class="flex justify-between items-center mb-5 text-sm text-gray-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 accent-primary">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="text-gray-800 no-underline font-medium transition-colors duration-300 hover:text-primary">Forgot password?</a>
                </div>
                <button type="submit" id="loginBtn" class="w-full py-4 bg-black text-white border-none rounded-xl text-base font-semibold cursor-pointer transition-all duration-300 hover:bg-primary hover:transform hover:-translate-y-0.5 hover:shadow-lg">Login</button>
                <div class="text-center mt-6 text-sm text-gray-600">
                    <p>Don't have an account? <a href="#" class="text-gray-800 font-semibold no-underline transition-colors duration-300 hover:text-primary">Register now</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>

        // Report button functionality
        document.addEventListener('DOMContentLoaded', () => {
            const reportButton = document.querySelector('a[href="report.php"]');
            const loginPopup = document.getElementById('loginPopup');
            
            // Show popup function
            const showPopup = (popup) => {
                popup.classList.remove('hidden');
                popup.classList.add('flex');
                setTimeout(() => {
                    popup.classList.add('opacity-100');
                    popup.querySelector('.bg-white\\/95').classList.remove('scale-90', 'opacity-0');
                }, 10);
            };
            
            // Hide popup function
            const hidePopup = (popup) => {
                popup.classList.remove('opacity-100');
                popup.querySelector('.bg-white\\/95').classList.add('scale-90', 'opacity-0');
                setTimeout(() => {
                    popup.classList.add('hidden');
                    popup.classList.remove('flex');
                }, 300);
            };
            
            // Only add event if reportButton exists (to prevent errors)
            if (reportButton) {
                reportButton.addEventListener('click', (e) => {
                    // If you want the popup instead of navigation, uncomment below
                    // e.preventDefault();
                    // showPopup(loginPopup);
                });
            }
            
            // Close button for login popup
            const closeButtons = document.querySelectorAll('button[aria-label="Close login popup"]');
            closeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    hidePopup(loginPopup);
                });
            });
            
            // Close popup when clicking outside
            loginPopup.addEventListener('click', (e) => {
                if (e.target === loginPopup) {
                    hidePopup(loginPopup);
                }
            });
        });
    </script>
</body>
</html>