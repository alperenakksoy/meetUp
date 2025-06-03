<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    /* Header Styles */
    .header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .header.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 70px;
    }

    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.5rem;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .logo-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #f39c12, #e74c3c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        color: white;
        font-size: 1.2rem;
    }

    .nav-menu {
        display: flex;
        list-style: none;
        gap: 2rem;
        align-items: center;
    }

    .nav-link {
        text-decoration: none;
        color: #2c3e50;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        padding: 0.5rem 0;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, #f39c12, #e74c3c);
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link:hover {
        color: #f39c12;
    }

    .nav-buttons {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .btn-outline {
        background: transparent;
        color: #2c3e50;
        border: 2px solid #2c3e50;
    }

    .btn-outline:hover {
        background: #2c3e50;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #f39c12, #e74c3c);
        color: white;
        border: 2px solid transparent;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #e67e22, #c0392b);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4);
    }

    /* Mobile Menu Toggle */
    .mobile-toggle {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 0.5rem;
        background: none;
        border: none;
    }

    .mobile-toggle span {
        width: 25px;
        height: 3px;
        background: #2c3e50;
        margin: 3px 0;
        transition: 0.3s;
        border-radius: 2px;
    }

    .mobile-toggle.active span:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 6px);
    }

    .mobile-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-toggle.active span:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -6px);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .nav-container {
            padding: 0 1rem;
        }

        .nav-menu {
            position: fixed;
            top: 70px;
            left: -100%;
            width: 100%;
            height: calc(100vh - 70px);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 2rem;
            transition: left 0.3s ease;
            gap: 1rem;
        }

        .nav-menu.active {
            left: 0;
        }

        .nav-buttons {
            flex-direction: column;
            width: 100%;
            padding: 0 2rem;
            gap: 1rem;
        }

        .nav-buttons .btn {
            width: 100%;
            text-align: center;
        }

        .mobile-toggle {
            display: flex;
        }
    }
</style>

<!-- Header Navigation -->
<header class="header" id="header">
    <nav class="nav-container">
        <a href="/" class="logo">
            <div class="logo-icon">
                <i class="fas fa-users"></i>
            </div>
            SocialLoop
        </a>

        <ul class="nav-menu" id="navMenu">
            <li><a href="/home" class="nav-link">Home</a></li>
            <li><a href="/about" class="nav-link">About</a></li>
            <li><a href="/features" class="nav-link">Features</a></li>
            <li><a href="/contact" class="nav-link">Contact</a></li>
            
            <div class="nav-buttons">
                <a href="/login" class="btn btn-outline">Login</a>
                <a href="/register" class="btn btn-primary">Sign Up</a>
            </div>
        </ul>

        <button class="mobile-toggle" id="mobileToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobileToggle').addEventListener('click', function() {
        this.classList.toggle('active');
        document.getElementById('navMenu').classList.toggle('active');
    });

    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Close mobile menu when clicking on a link
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('navMenu').classList.remove('active');
            document.getElementById('mobileToggle').classList.remove('active');
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>