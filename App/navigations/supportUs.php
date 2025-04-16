<?php require_once __DIR__ . '/../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>
<body class="font-sans text-gray-800">

 <!-- Header -->
 <?=loadWelcomePartial('headerWl'); ?>
   
    <!-- Hero Section -->
    <section class="bg-primary h-[50vh] flex items-center justify-center text-center text-white mt-[60px]">
        <div class="max-w-2xl px-5">
            <h1 class="text-4xl md:text-5xl mb-5 font-volkhov font-bold">Support Us</h1>
            <p class="text-xl opacity-90">Your help makes our mission possible</p>
        </div>
    </section>

    <!-- Contribution Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-5">
            <div class="text-center">
                <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-8 font-bold">Ways to Contribute</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">SocialLoop thrives thanks to the support of our amazing community. Here's how you can help:</p>
                
                <ul class="list-none max-w-2xl mx-auto mt-10">
                    <li class="text-lg text-gray-600 mb-5">💡 <strong class="font-semibold">Donate:</strong> Help us keep our platform running smoothly.</li>
                    <li class="text-lg text-gray-600 mb-5">📢 <strong class="font-semibold">Spread the Word:</strong> Share SocialLoop with your friends and family.</li>
                    <li class="text-lg text-gray-600 mb-5">🤝 <strong class="font-semibold">Volunteer:</strong> Join us in organizing events and moderating discussions.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="py-10 bg-primary text-white text-center">
        <div class="max-w-6xl mx-auto px-5">
            <h2 class="text-2xl md:text-4xl mb-5 font-bold">Make a Difference Today</h2>
            <a href="#" class="inline-block py-4 px-8 bg-white text-primary text-lg font-bold rounded-lg transition-all duration-300 hover:bg-gray-100">Contribute Now</a>
        </div>
    </section>

    <!-- Footer -->
    <?=loadWelcomePartial('footerWl'); ?>
</body>
</html>