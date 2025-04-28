<?php
/**
 * Common footer partial for SocialLoop pages
 */

// Define footer links
$companyLinks = [
    'About Us' => '#',
    'Careers' => '#',
    'Support Us' => '#'
];

$contactLinks = [
    'Help/FAQ' => '#',
    'Emergency' => '#',
    'Safety' => '#'
];

$moreLinks = [
    'Report' => '#',
    'Tips for Socializing' => '#',
    'Advices for Improve' => '#'
];
?>

<!-- Footer -->
<footer class="bg-gray-100 text-[#2b2d42] py-10 px-5 font-sans text-center">
    <div class="flex flex-wrap justify-between gap-5 max-w-6xl mx-auto">
        <div class="flex-1 min-w-[200px]">
            <h2 class="text-2xl font-bold mb-2">SocialLoop</h2>
            <p class="text-sm">Connects people for spontaneous hangouts and real-time socializing.</p>
        </div>
        
        <div class="flex-1 min-w-[200px]">
            <h3 class="text-lg mb-4">Company</h3>
            <ul class="list-none p-0">
                <?php foreach ($companyLinks as $name => $link): ?>
                    <li class="mb-2.5">
                        <a href="<?php echo $link; ?>" class="no-underline text-[#2b2d42] hover:text-primary transition-colors">
                            <?php echo $name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="flex-1 min-w-[200px]">
            <h3 class="text-lg mb-4">Contact</h3>
            <ul class="list-none p-0">
                <?php foreach ($contactLinks as $name => $link): ?>
                    <li class="mb-2.5">
                        <a href="<?php echo $link; ?>" class="no-underline text-[#2b2d42] hover:text-primary transition-colors">
                            <?php echo $name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="flex-1 min-w-[200px]">
            <h3 class="text-lg mb-4">More</h3>
            <ul class="list-none p-0">
                <?php foreach ($moreLinks as $name => $link): ?>
                    <li class="mb-2.5">
                        <a href="<?php echo $link; ?>" class="no-underline text-[#2b2d42] hover:text-primary transition-colors">
                            <?php echo $name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="mt-5 text-sm text-gray-400">
        <p>All rights reserved @socialloop.co</p>
    </div>
</footer>
