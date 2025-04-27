<footer class="footer">
    <div class="footer-container">
        <div class="footer-section logo-section">
            <h2>SocialLoop</h2>
            <p>Connects people for spontaneous hangouts and real-time socializing.</p>
        </div>
        <div class="footer-section">
            <h3>Company</h3>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Support Us</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <ul>
                <li><a href="#">Help/FAQ</a></li>
                <li><a href="#">Emergency</a></li>
                <li><a href="#">Safety</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>More</h3>
            <ul>
                <li><a href="#">Report</a></li>
                <li><a href="#">Tips for Socializing</a></li>
                <li><a href="#">Advices for Improve</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>All rights reserved @socialloop.co</p>
    </div>
</footer>

<style>
    .footer {
        background-color: #333;
        color: #fff;
        padding: 40px 0 0;
        margin-top: 40px;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        padding: 0 20px;
    }

    .footer-section h2, .footer-section h3 {
        color: #f5a623;
        margin-bottom: 20px;
        font-family: 'Volkhov', serif;
    }

    .footer-section ul {
        list-style: none;
    }

    .footer-section ul li {
        margin-bottom: 10px;
    }

    .footer-section ul li a {
        color: #ccc;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-section ul li a:hover {
        color: #f5a623;
    }

    .footer-bottom {
        text-align: center;
        padding: 20px 0;
        margin-top: 40px;
        border-top: 1px solid #444;
    }

    @media (max-width: 768px) {
        .footer-container {
            grid-template-columns: 1fr;
            text-align: center;
        }
    }
</style>