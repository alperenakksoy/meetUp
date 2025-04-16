<?php require_once __DIR__ . '/../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>s
  <style>
    /* Custom styles that are hard to replicate with Tailwind */
    .header-hide {
      transform: translateY(-100%);
    }
    
    .date-input::-webkit-calendar-picker-indicator {
      cursor: pointer;
      padding: 5px;
      filter: invert(0.4);
    }
    
    .select-custom {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 15px center;
      background-size: 16px;
    }
    
    .close-btn::before,
    .close-btn::after {
      content: '';
      position: absolute;
      width: 20px;
      height: 2px;
      background-color: #333;
      top: 50%;
      left: 50%;
    }
    
    .close-btn::before {
      transform: translate(-50%, -50%) rotate(45deg);
    }
    
    .close-btn::after {
      transform: translate(-50%, -50%) rotate(-45deg);
    }
  </style>
</head>
<body class="font-sans text-gray-700 leading-relaxed">

<?=loadWelcomePartial('headerWl'); ?>

  <!-- Hero Section -->
  <section class="flex justify-between items-center py-16 px-8 mt-10 bg-amber-50">
    <div class="max-w-lg px-8">
      <h1 class="text-xl text-secondary font-medium mb-4">Meet, Share, and Create Moments Together!</h1>
      <h2 class="text-4xl font-volkhov font-bold leading-tight mb-4">Travel, Connect, and Create New Adventures with <span class="text-secondary font-semibold">SocialLoop</span></h2>
      <p class="text-gray-600 mb-8">
        Are you a solo traveler or someone who loves connecting through shared activities? 
        Our platform makes it simple!
      </p>
      <button class="secondSign bg-primary text-white py-3 px-6 rounded shadow-md hover:bg-primary-dark transition-colors">Sign Up</button>
    </div>
    <div class="w-1/2 flex justify-center">
      <img src="../../public/images/homeImg/People-Talking-Clipart-PNG.png" class="max-w-full h-auto">
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-12 px-4 bg-light text-center">
    <h2 class="text-3xl text-dark font-bold mb-8">What Can You Do?</h2>
    <div class="flex flex-wrap justify-center gap-8">
      <div class="bg-white rounded-xl shadow-md p-5 w-60 transition-all duration-300 hover:shadow-lg hover:-translate-y-2">
        <img src="../../public/images/homeImg/create.png" alt="Create Events Icon" class="w-16 h-16 mx-auto mb-4">
        <h3 class="text-xl text-dark font-semibold mb-2">Create Events</h3>
        <p class="text-gray-500 text-sm">Plan your perfect meetup by setting the date, time, location, and activity.</p>
      </div>
      <div class="bg-white rounded-xl shadow-md p-5 w-60 transition-all duration-300 hover:shadow-lg hover:-translate-y-2">
        <img src="../../public/images/homeImg/event.png" alt="Join Events Icon" class="w-16 h-16 mx-auto mb-4">
        <h3 class="text-xl text-dark font-semibold mb-2">Join Events</h3>
        <p class="text-gray-500 text-sm">Browse and join exciting events hosted by other users.</p>
      </div>
      <div class="bg-white rounded-xl shadow-md p-5 w-60 transition-all duration-300 hover:shadow-lg hover:-translate-y-2">
        <img src="../../public/images/homeImg/make-friends.png" alt="Make New Friends Icon" class="w-16 h-16 mx-auto mb-4">
        <h3 class="text-xl text-dark font-semibold mb-2">Make New Friends</h3>
        <p class="text-gray-500 text-sm">Send friend requests and connect with people who share your interests.</p>
      </div>
      <div class="bg-white rounded-xl shadow-md p-5 w-60 transition-all duration-300 hover:shadow-lg hover:-translate-y-2">
        <img src="../../public/images/homeImg/chat.png" alt="Chat and Collaborate Icon" class="w-16 h-16 mx-auto mb-4">
        <h3 class="text-xl text-dark font-semibold mb-2">Chat and Collaborate</h3>
        <p class="text-gray-500 text-sm">Coordinate event details and start conversations with other participants.</p>
      </div>
    </div>
  </section>

  <!-- Events Section -->
  <section class="py-16 px-4 bg-gray-100 text-center">
    <h2 class="text-3xl text-gray-800 font-bold mb-12">Upcoming Events</h2>
    <div class="flex flex-wrap justify-center gap-8">
      <!-- Event Card 1 -->
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-md w-80 transition-all duration-300 hover:shadow-xl hover:scale-105">
        <img src="../../public/images/homeImg/hagia-sophia.jpg" alt="Event 1 Image" class="w-full h-48 object-cover">
        <div class="p-4 text-left relative">
          <div class="text-lg font-semibold mb-4">Explore Hagia Sophia</div>
          <a href="../registerScreen/registerIndex.html">
            <button class="join-btn absolute top-4 right-4 bg-primary text-white px-4 py-2 rounded shadow-md hover:bg-primary-dark transition-colors">Join</button>
          </a>
          <div class="text-gray-500 mt-6">Dec 28, 2024 - 3:00 PM</div>
        </div>
      </div>

      <!-- Event Card 2 -->
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-md w-80 transition-all duration-300 hover:shadow-xl hover:scale-105">
        <img src="../../public/images/homeImg/piknik.webp" alt="Event 2 Image" class="w-full h-48 object-cover">
        <div class="p-4 text-left relative">
          <div class="text-lg font-semibold mb-4">Picnic in the Maçka Park</div>
          <a href="../registerScreen/registerIndex.html">
            <button class="join-btn absolute top-4 right-4 bg-primary text-white px-4 py-2 rounded shadow-md hover:bg-primary-dark transition-colors">Join</button>
          </a>
          <div class="text-gray-500 mt-6">Jan 5, 2025 - 12:00 PM</div>
        </div>
      </div>

      <!-- Event Card 3 -->
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-md w-80 transition-all duration-300 hover:shadow-xl hover:scale-105">
        <img src="../../public/images/homeImg/pub.jpg" alt="Event 3 Image" class="w-full h-48 object-cover">
        <div class="p-4 text-left relative">
          <div class="text-lg font-semibold mb-4">Pub Crawl - Alsancak</div>
          <a href="../registerScreen/registerIndex.html">
            <button class="join-btn absolute top-4 right-4 bg-primary text-white px-4 py-2 rounded shadow-md hover:bg-primary-dark transition-colors">Join</button>
          </a>
          <div class="text-gray-500 mt-6">Jan 10, 2025 - 8:00 PM</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Login Popup -->
  <div class="popup-overlay fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm hidden justify-center items-center z-50 opacity-0 transition-opacity" id="loginPopup">
    <div class="bg-white bg-opacity-95 w-full max-w-md p-8 rounded-3xl shadow-2xl relative transform scale-90 opacity-0 transition-all">
      <button class="close-btn absolute top-5 right-5 w-8 h-8 flex items-center justify-center hover:bg-red-400 hover:bg-opacity-80 transition-colors duration-200 rounded-full" aria-label="Close login popup"></button>
      <form action="" class="space-y-6">
        <h1 class="text-2xl text-center font-bold text-gray-800">Welcome Back</h1>
        <div class="space-y-6">
          <div>
            <input type="email" placeholder="Enter your email" required class="w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition">
          </div>
          <div>
            <input type="password" placeholder="Enter your password" required class="w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition">
          </div>
        </div>
        <div class="flex justify-between items-center text-sm text-gray-600">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" class="w-4 h-4 accent-primary-dark">
            <span>Remember me</span>
          </label>
          <a href="#" class="text-gray-800 font-medium hover:text-primary-dark transition-colors">Forgot password?</a>
        </div>
        <button type="submit" id="loginBtn" class="w-full py-4 bg-black text-white rounded-xl text-base font-semibold hover:bg-primary-dark transform hover:-translate-y-0.5 transition-all shadow-md hover:shadow-lg">Login</button>
        <div class="text-center text-sm text-gray-600 register-link">
          <p>Don't have an account? <a href="registerScreen/registerIndex.html" class="text-gray-800 font-semibold hover:text-primary-dark transition-colors">Register now</a></p>
        </div>
      </form>
    </div>
  </div>

  <!-- Register Popup -->
  <div class="popup-overlay fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm hidden justify-center items-center z-50 opacity-0 transition-opacity" id="registerPopup">
    <div class="bg-white bg-opacity-95 w-full max-w-md p-8 rounded-3xl shadow-2xl relative transform scale-90 opacity-0 transition-all overflow-y-auto max-h-[90vh]">
      <button class="close-btn absolute top-5 right-5 w-8 h-8 flex items-center justify-center hover:bg-red-400 hover:bg-opacity-80 transition-colors duration-200 rounded-full" aria-label="Close registration popup"></button>
      <form action="" class="space-y-5">
        <h1 class="text-2xl text-center font-bold text-gray-800">Create Account</h1>
        
        <div>
          <input type="text" placeholder="First Name" required class="w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition">
        </div>
        
        <div>
          <input type="text" placeholder="Last Name" required class="w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition">
        </div>
        
        <div>
          <input type="email" placeholder="Email" required class="w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition">
        </div>
        
        <div>
          <input type="password" placeholder="Password" required class="w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition">
        </div>
        
        <div>
          <input type="password" placeholder="Confirm Password" required class="w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition">
        </div>
        
        <div class="relative">
          <input type="date" required class="date-input w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition cursor-pointer">
          <label class="date-label hidden"></label>
        </div>
        
        <div>
          <select required class="select-custom w-full py-4 px-5 bg-white bg-opacity-90 border-2 border-gray-200 rounded-xl text-base focus:border-primary-dark focus:ring focus:ring-primary-dark focus:ring-opacity-20 outline-none transition cursor-pointer appearance-none">
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
            <option value="prefer-not">Prefer not to say</option>
          </select>
        </div>
  
        <button type="submit" id="registerBtn" class="w-full py-4 bg-black text-white rounded-xl text-base font-semibold hover:bg-primary-dark transform hover:-translate-y-0.5 transition-all shadow-md hover:shadow-lg">Create Account</button>
        
        <div class="text-center text-sm text-gray-600 login-link">
          <p>Already have an account? <a href="#" id="switchToLogin" class="text-gray-800 font-semibold hover:text-primary-dark transition-colors">Login</a></p>
        </div>
      </form>
    </div>
  </div>

  <!-- Hangout Section -->
  <section class="py-16 px-4 bg-white">
    <h2 class="text-3xl text-center font-bold text-indigo-900 mb-8">Hang Out</h2>
    <div class="flex flex-wrap justify-between mx-auto">
      <div class="w-full md:w-5/12 pl-12 pr-4">
        <h3 class="text-gray-500 font-bold mb-2">Easy and Fast</h3>
        <h1 class="text-4xl font-bold leading-snug text-indigo-900 mb-8">Meet New People Anytime!</h1>
        
        <div class="flex mb-6">
          <div class="w-12 h-12 rounded-xl bg-yellow-300 flex-shrink-0 mr-4"></div>
          <div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">Instant Connections</h4>
            <p class="text-gray-600">No waiting—create or join a Hangout instantly to meet people nearby and start your next adventure.</p>
          </div>
        </div>
        
        <div class="flex mb-6">
          <div class="w-12 h-12 rounded-xl bg-orange-300 flex-shrink-0 mr-4"></div>
          <div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">Spontaneous Fun</h4>
            <p class="text-gray-600">Perfect for unplanned meetups, whether it's a coffee break, a quick walk, or exploring the city together.</p>
          </div>
        </div>
        
        <div class="flex">
          <div class="w-12 h-12 rounded-xl bg-blue-300 flex-shrink-0 mr-4"></div>
          <div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">Expand Your Circle</h4>
            <p class="text-gray-600">Meet like-minded locals or travelers and build lasting friendships in real time.</p>
          </div>
        </div>
      </div>
      
      <div class="w-full md:w-6/12 flex justify-center items-center mt-8 md:mt-0">
        <div class="max-w-md bg-white border border-gray-100 rounded-2xl shadow-lg overflow-hidden transition-all hover:shadow-xl">
          <img src="../../public/images/homeImg/coffee.jpg" alt="Coffee hangout" class="w-full h-64 object-cover">
          <div class="p-4">
            <h4 class="text-2xl font-bold text-indigo-900 mb-2">Grab a Coffee</h4>
            <p class="flex justify-between text-gray-500 mb-4">
              <span>16 minutes ago</span>
              <span class="px-20"></span>
              <span>2.5km away</span>
            </p>
            <div class="flex justify-between items-center text-gray-400 pt-4 border-t border-gray-100">
              <span>24 people going</span>
              <span>Kadıköy/Istanbul</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="max-w-5xl mx-auto py-12 px-4">
    <h5 class="text-sm text-gray-500 uppercase tracking-widest mb-2">REFERENCES</h5>
    <h2 class="text-4xl font-bold text-gray-800 leading-tight mb-10">Building Trust Through Experiences</h2>
    
    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 flex flex-col md:flex-row items-start gap-5 mb-5">
      <div class="flex-shrink-0">
        <img src="../../public/images/homeImg/person.avif" alt="User Profile Picture" class="w-16 h-16 rounded-full border-3 border-red-500 object-cover"/>
      </div>
      <div>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
          Had a great time with Jennifer exploring the Blue Mosque. She was
          friendly and fun, and we enjoyed delicious kebab at a restaurant
          afterward. Would join her again!
        </p>
        <strong class="block text-gray-800 mb-1">Mireia Puig</strong>
        <span class="text-sm text-gray-500">Barcelona, Spain</span>
      </div>
    </div>
    
    <div class="flex justify-start gap-3 mt-5">
      <span class="w-2.5 h-2.5 bg-gray-800 rounded-full"></span>
      <span class="w-2.5 h-2.5 bg-gray-300 rounded-full"></span>
      <span class="w-2.5 h-2.5 bg-gray-300 rounded-full"></span>
    </div>
  </section>

  <!-- Subscribe Section -->
  <section class="max-w-5xl mx-auto bg-gray-50 rounded-2xl p-10 my-10 relative overflow-hidden">
    <div class="relative z-10">
      <h2 class="text-2xl md:text-3xl text-gray-700 font-bold mb-8 max-w-2xl mx-auto text-center">
        Subscribe to get information, latest news and other interesting offers about SocialLoop
      </h2>
      <div class="flex flex-col md:flex-row gap-4 max-w-xl mx-auto">
        <div class="relative flex-grow">
          <input
            type="email"
            placeholder="Your email"
            aria-label="Enter your email"
            class="w-full px-10 py-3 border border-gray-200 rounded-lg"
          />
          <span class="absolute left-3 top-1/2 transform -translate-y-1/2">📧</span>
        </div>
        <button class="bg-gradient-to-r from-orange-400 to-orange-500 text-white py-3 px-5 rounded-lg hover:from-orange-500 hover:to-orange-400 transition-all">Subscribe</button>
      </div>
    </div>
    <!-- Background circles -->
    <div class="hidden md:block absolute top-1/5 left-1/10 w-96 h-96 bg-gradient-radial from-transparent to-purple-100 opacity-30 rounded-full"></div>
    <div class="hidden md:block absolute bottom-1/5 right-1/10 w-96 h-96 bg-gradient-radial from-transparent to-purple-100 opacity-20 rounded-full"></div>
  </section>

  <!-- Footer -->
      <?=loadWelcomePartial('footerWl'); ?>


  <script>
    // Header scroll behavior
    let lastScroll = 0;
    let isScrollingDown = false;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        const header = document.querySelector('header');
        const scrollThreshold = 100;
        
        if (currentScroll <= 0) {
            header.classList.remove('header-hide');
            return;
        }
    
        if (currentScroll > scrollThreshold) {
            if (currentScroll > lastScroll && !isScrollingDown) {
                // Scrolling down
                header.classList.add('header-hide');
                isScrollingDown = true;
            } else if (currentScroll < lastScroll && isScrollingDown) {
                // Scrolling up
                header.classList.remove('header-hide');
                isScrollingDown = false;
            }
        }
        lastScroll = currentScroll;
    });

    // Popup functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Get all necessary elements
      const joinButtons = document.querySelectorAll('.join-btn');
      const secondSignButton = document.querySelector('.secondSign');
      const loginPopup = document.getElementById('loginPopup');
      const registerPopup = document.getElementById('registerPopup');
      const registerNowLink = document.querySelector('.register-link a');
      const loginLink = document.querySelector('#switchToLogin');
      const closeButtons = document.querySelectorAll('.close-btn');
      
      // Add login button functionality
      const loginBtn = document.querySelector('.login-btn');
      if (loginBtn) {
        loginBtn.addEventListener('click', function(e) {
          e.preventDefault();
          showPopup(loginPopup);
        });
      }
      
      // Add sign-up button functionality
      const signBtn = document.querySelector('.signup-btn');
      if (signBtn) {
        signBtn.addEventListener('click', function(e) {
          e.preventDefault();
          showPopup(registerPopup);
        });
      }
      
      // Add second sign button functionality
      if (secondSignButton) {
        secondSignButton.addEventListener('click', function(e) {
          e.preventDefault();
          showPopup(registerPopup);
        });
      }
    
      // Show login popup when join button is clicked
      joinButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          showPopup(loginPopup);
        });
      });
    
      // Show register popup when "Register now" is clicked
      if (registerNowLink) {
        registerNowLink.addEventListener('click', function(e) {
          e.preventDefault();
          hidePopup(loginPopup);
          setTimeout(() => {
            showPopup(registerPopup);
          }, 300); // Small delay for smooth transition
        });
      }
    
      // Show login popup when "Already have an account?" is clicked
      if (loginLink) {
        loginLink.addEventListener('click', function(e) {
          e.preventDefault();
          hidePopup(registerPopup);
          setTimeout(() => {
            showPopup(loginPopup);
          }, 300); // Small delay for smooth transition
        });
      }
    
      // Close popup when clicking close button
      closeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
          hidePopup(loginPopup);
          hidePopup(registerPopup);
        });
      });
    
      // Close popup when clicking outside
      [loginPopup, registerPopup].forEach(popup => {
        popup.addEventListener('click', function(e) {
          if (e.target === popup) {
            hidePopup(popup);
          }
        });
      });
    
      // Close popups when pressing Escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          hidePopup(loginPopup);
          hidePopup(registerPopup);
        }
      });
    
      // Form validation for register form
      const registerForm = registerPopup.querySelector('form');
      registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const password = registerForm.querySelectorAll('input[type="password"]')[0];
        const confirmPassword = registerForm.querySelectorAll('input[type="password"]')[1];
        
        if (password.value !== confirmPassword.value) {
          alert('Passwords do not match!');
          return;
        }
        // Add your registration logic here
      });
      
      // Helper functions for showing/hiding popups
      function showPopup(popup) {
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        // Trigger animation
        setTimeout(() => {
          popup.classList.add('opacity-100');
          popup.querySelector('.bg-white').classList.remove('scale-90', 'opacity-0');
          popup.querySelector('.bg-white').classList.add('scale-100', 'opacity-100');
        }, 10);
      }
      
      function hidePopup(popup) {
        popup.classList.remove('opacity-100');
        popup.querySelector('.bg-white').classList.remove('scale-100', 'opacity-100');
        popup.querySelector('.bg-white').classList.add('scale-90', 'opacity-0');
        // Wait for animation to finish before hiding
        setTimeout(() => {
          popup.classList.remove('flex');
          popup.classList.add('hidden');
        }, 300);
      }