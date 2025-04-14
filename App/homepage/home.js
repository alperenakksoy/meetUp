const loginBtn = document.querySelector('.login-btn');
const signBtn = document.querySelector('.signup-btn');

// Add this JavaScript to handle the popup functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get all join buttons
    const joinButtons = document.querySelectorAll('.join-btn');
    const loginPopup = document.getElementById('loginPopup');
  
    // Add click event to all join buttons
    joinButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        loginPopup.classList.add('active');
      });
    });
  
    // Close popup when clicking outside
    loginPopup.addEventListener('click', function(e) {
      if (e.target === loginPopup) {
        loginPopup.classList.remove('active');
      }
    });
  
    // Optional: Close popup when pressing Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && loginPopup.classList.contains('active')) {
        loginPopup.classList.remove('active');
      }
    });
  });


  document.addEventListener('DOMContentLoaded', function() {
    // Get all necessary elements
    const joinButtons = document.querySelectorAll('.join-btn');
    const loginPopup = document.getElementById('loginPopup');
    const registerPopup = document.getElementById('registerPopup');
    const registerNowLink = document.querySelector('.register-link a');
    const loginLink = document.querySelector('.login-link a');
  
    // Show login popup when join button is clicked
    joinButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        loginPopup.classList.add('active');
      });
    });
  
    // Show register popup when "Register now" is clicked
    registerNowLink.addEventListener('click', function(e) {
      e.preventDefault();
      loginPopup.classList.remove('active');
      setTimeout(() => {
        registerPopup.classList.add('active');
      }, 300); // Small delay for smooth transition
    });
  
    // Show login popup when "Already have an account?" is clicked
    loginLink.addEventListener('click', function(e) {
      e.preventDefault();
      registerPopup.classList.remove('active');
      setTimeout(() => {
        loginPopup.classList.add('active');
      }, 300); // Small delay for smooth transition
    });
  
    // Close popup when clicking outside
    [loginPopup, registerPopup].forEach(popup => {
      popup.addEventListener('click', function(e) {
        if (e.target === popup) {
          popup.classList.remove('active');
        }
      });
    });
  
    // Close button functionality
    document.querySelectorAll('.close-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        loginPopup.classList.remove('active');
        registerPopup.classList.remove('active');
      });
    });
  
    // Close popups when pressing Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        loginPopup.classList.remove('active');
        registerPopup.classList.remove('active');
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
  });

  // Scroll down and dissappear the header.
  let lastScroll = 0;
  let isScrollingDown = false;
  
  window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;
      const header = document.querySelector('header');
      const scrollThreshold = 100; // Adjust this value as needed
      
      if (currentScroll <= 0) {
          header.classList.remove('hide');
          return;
      }
  
      if (currentScroll > scrollThreshold) { // Only start hiding after threshold
          if (currentScroll > lastScroll && !isScrollingDown) {
              // Scrolling down
              header.classList.add('hide');
              isScrollingDown = true;
          } else if (currentScroll < lastScroll && isScrollingDown) {
              // Scrolling up
              header.classList.remove('hide');
              isScrollingDown = false;
          }
      }
      lastScroll = currentScroll;
  });