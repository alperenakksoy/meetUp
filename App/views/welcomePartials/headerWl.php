<?php
/**
 * Common header partial for SocialLoop pages
 * 
 * @param string $currentPage The current active page (optional)
 */

// Default logo path
$logoPath = '../homepage/homeImg/logo.png';

// Define navigation links
$navLinks = [
    'Home' => '/App/navigations/welcomePage.php',
    'About Us' => '/App/navigations/aboutUs.php',
    'Support Us' => '/App/navigations/supportUs.php',
    'Safety' => '/App/navigations/Safety/safety.php',
    'How It Works' => '/App/navigations/howitworks.php',
];

// Define languages
$languages = ['English', 'Turkish', 'Spanish', 'Arabic', 'French', 'Italian', 'German'];
?>

<!-- Header -->
<header class="bg-white py-2.5 px-5 border-b border-gray-200 w-full flex items-center fixed top-0 left-0 z-10 shadow-sm transition-transform duration-300 transform">
    <div class="flex w-full justify-between items-center">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-cover bg-center bg-no-repeat rounded-full mr-5" style="background-image: url('<?php echo $logoPath; ?>')"></div>
            <nav>
                <ul class="flex gap-5">
                    <?php foreach ($navLinks as $name => $link): ?>
                        <li>
                            <a href="<?php echo $link; ?>" 
                               class="no-underline text-black text-base font-medium py-2.5 px-2.5 transition-all duration-300 hover:text-primary
                               <?php echo isset($currentPage) && $currentPage === $name ? 'text-primary' : ''; ?>">
                                <?php echo $name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            <select class="py-1.5 px-2.5 mr-8 border border-gray-200 rounded">
                <?php foreach ($languages as $language): ?>
                    <option><?php echo $language; ?></option>
                <?php endforeach; ?>
            </select>
            <a href="/login">
                <button class="py-1.5 px-4 rounded cursor-pointer font-bold transition-all duration-300 border border-black bg-white text-black hover:bg-primary hover:text-white hover:border-primary">Log in</button>
            </a>
            <a href="/register">
                <button class="py-1.5 px-4 rounded cursor-pointer font-bold transition-all duration-300 bg-black text-white hover:bg-primary">Sign Up</button>
            </a>
        </div>
    </div>
</header>
