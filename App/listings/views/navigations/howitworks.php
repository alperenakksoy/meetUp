<?php require_once __DIR__ . '/../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>
<body class="font-sans text-gray-800">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Hero Section -->
    <section class="bg-primary h-[50vh] flex items-center justify-center text-center text-white mt-[60px]">
        <div class="max-w-2xl px-5">
            <h1 class="text-4xl md:text-5xl mb-5 font-volkhov font-bold">How SocialLoop Works</h1>
            <p class="text-xl opacity-90">Your Guide to Making Meaningful Connections</p>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-5">
            <div class="mb-16 flex flex-col gap-16">
                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row gap-10 p-10 bg-white rounded-2xl shadow-lg">
                    <div class="text-6xl font-volkhov font-bold text-primary min-w-[80px] flex items-center justify-center">1</div>
                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Create Your Profile</h2>
                        <p class="text-lg text-gray-600 mb-8">Sign up and create your profile with your interests, photos, and a bio. Verify your account to build trust in the community.</p>
                        <div class="flex flex-wrap gap-8">
                            <div class="flex items-center gap-3">
                                <img src="../navigations/howItWorksImg/profileIcon.png" alt="Profile icon" class="w-6 h-6 object-contain">
                                <span class="text-gray-700">Add your interests</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <img src="../navigations/howItWorksImg/verify.png" alt="Verify icon" class="w-6 h-6 object-contain">
                                <span class="text-gray-700">Verify your account</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <img src="../navigations/howItWorksImg/bio.png" alt="Bio icon" class="w-6 h-6 object-contain">
                                <span class="text-gray-700">Write your bio</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row gap-10 p-10 bg-white rounded-2xl shadow-lg">
                    <div class="text-6xl font-volkhov font-bold text-primary min-w-[80px] flex items-center justify-center">2</div>
                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Create or Join Events</h2>
                        <p class="text-lg text-gray-600 mb-8">Host your own events or join existing ones. From coffee meetups to city explorations, find activities that interest you.</p>
                        <div class="flex flex-wrap gap-4">
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-gray-700">☕ Coffee</span>
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-gray-700">🍺 Drinks</span>
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-gray-700">🏛️ Museums</span>
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-gray-700">🚶 Walking</span>
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-gray-700">⚽ Sports</span>
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-gray-700">🍽️ Dining</span>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row gap-10 p-10 bg-white rounded-2xl shadow-lg">
                    <div class="text-6xl font-volkhov font-bold text-primary min-w-[80px] flex items-center justify-center">3</div>
                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Connect & Chat</h2>
                        <p class="text-lg text-gray-600 mb-8">Request to join events or approve join requests for your events. Chat with participants and share contact details safely.</p>
                        <div class="flex gap-10">
                            <div class="flex items-center gap-3">
                                <img src="../navigations/howItWorksImg/chatt.png" alt="Chat icon" class="w-6 h-6 object-contain">
                                <span class="text-gray-700">Group Chat</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <img src="../navigations/howItWorksImg/social.png" alt="Social icon" class="w-6 h-6 object-contain">
                                <span class="text-gray-700">Social Links</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col md:flex-row gap-10 p-10 bg-white rounded-2xl shadow-lg">
                    <div class="text-6xl font-volkhov font-bold text-primary min-w-[80px] flex items-center justify-center">4</div>
                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Meet & Review</h2>
                        <p class="text-lg text-gray-600 mb-8">Meet in person and enjoy the event! Afterward, leave reviews and comments about your experience and make lasting connections.</p>
                        <div class="bg-gray-50 p-5 rounded-lg">
                            <div class="text-primary text-xl mb-2">⭐⭐⭐⭐⭐</div>
                            <p class="italic text-gray-600">"Great experience! Made new friends and explored the city together!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Safety Tips -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-6xl mx-auto px-5">
            <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-12 font-bold text-center">Safety First</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl text-center shadow-md">
                    <img src="../navigations/howItWorksImg/location.png" alt="Public place icon" class="w-8 h-8 object-contain mx-auto mb-5">
                    <h3 class="text-xl font-bold text-[#2c2c54] mb-4">Meet in Public Places</h3>
                    <p class="text-gray-600">Always meet in well-lit, public locations with plenty of people around.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl text-center shadow-md">
                    <img src="../navigations/howItWorksImg/share.png" alt="Share icon" class="w-8 h-8 object-contain mx-auto mb-5">
                    <h3 class="text-xl font-bold text-[#2c2c54] mb-4">Share Your Plans</h3>
                    <p class="text-gray-600">Let friends or family know about your meetup plans and location.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl text-center shadow-md">
                    <img src="../navigations/howItWorksImg/reportIcon.png" alt="Report icon" class="w-8 h-8 object-contain mx-auto mb-5">
                    <h3 class="text-xl font-bold text-[#2c2c54] mb-4">Report Concerns</h3>
                    <p class="text-gray-600">Use our reporting system if you encounter any suspicious behavior.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white text-center">
        <div class="max-w-6xl mx-auto px-5">
            <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-5 font-bold">Ready to Start Your Journey?</h2>
            <p class="text-lg text-gray-600 mb-8">Join our community and start making meaningful connections today!</p>
            <div class="flex flex-wrap gap-6 justify-center">
                <button class="py-4 px-8 bg-primary text-white text-lg font-bold rounded-lg hover:bg-[#d88619] transition-colors duration-300">Create Account</button>
                <button class="py-4 px-8 bg-transparent text-primary border-2 border-primary text-lg font-bold rounded-lg hover:bg-primary hover:text-white transition-colors duration-300">Browse Events</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?=loadWelcomePartial('footerWl'); ?>

</body>
</html>