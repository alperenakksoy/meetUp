<?php require_once __DIR__ . '/../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>

<body class="font-sans text-gray-800">
<?=loadWelcomePartial('headerWl'); ?>

    <!-- Hero Section -->
    <section class="bg-primary h-[50vh] flex items-center justify-center text-center text-white mt-[60px]">
        <div class="max-w-2xl px-5">
            <h1 class="text-4xl md:text-5xl mb-5 font-volkhov font-bold">Our Story</h1>
            <p class="text-xl opacity-90">Building Connections, Creating Memories</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-5">
            <div class="text-center">
                <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-8 font-bold">Our Mission</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">SocialLoop was born from a simple idea: making it easier for people to connect in real life. We believe that the best experiences come from genuine human connections and shared adventures.</p>
                
                <div class="flex flex-col md:flex-row justify-center gap-16 mt-12">
                    <div class="text-center">
                        <h3 class="text-3xl md:text-4xl text-primary font-bold mb-2">50K+</h3>
                        <p class="text-gray-600">Active Users</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl md:text-4xl text-primary font-bold mb-2">100+</h3>
                        <p class="text-gray-600">Cities</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl md:text-4xl text-primary font-bold mb-2">10K+</h3>
                        <p class="text-gray-600">Events Created</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-6xl mx-auto px-5">
            <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-12 font-bold text-center">Our Values</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                <div class="bg-white p-8 rounded-2xl text-center shadow-md hover:transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-[#FFD666] rounded-full flex items-center justify-center mx-auto mb-5">
                        <img src="../navigations/aboutUsImg/safetyFirsty.png" alt="Safety icon" class="w-12 h-12 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#2c2c54] mb-4">Safety First</h3>
                    <p class="text-gray-600 leading-relaxed">We prioritize user safety through verification systems and community guidelines.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl text-center shadow-md hover:transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-[#FF8666] rounded-full flex items-center justify-center mx-auto mb-5">
                        <img src="../navigations/aboutUsImg/communityIcon.png" alt="Community icon" class="w-12 h-12 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#2c2c54] mb-4">Community-Driven</h3>
                    <p class="text-gray-600 leading-relaxed">Our platform thrives on the diverse perspectives and experiences of our users.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl text-center shadow-md hover:transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-[#66B8FF] rounded-full flex items-center justify-center mx-auto mb-5">
                        <img src="../navigations/aboutUsImg/Innovationicon.png" alt="Innovation icon" class="w-12 h-12 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#2c2c54] mb-4">Innovation</h3>
                    <p class="text-gray-600 leading-relaxed">We continuously evolve our platform to enhance user experience and connection.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-5">
            <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-12 font-bold text-center">Meet Our Team</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-10 justify-items-center">
                <div class="text-center">
                    <img src="../navigations/aboutUsImg/founder.jpg" alt="Team member" class="w-48 h-48 rounded-full mx-auto mb-5 object-cover">
                    <h3 class="text-xl font-bold text-[#2c2c54] mb-2">Ahmet Alperen Aksoy</h3>
                    <p class="text-gray-600">Founder & CEO</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-gray-100">
        <div class="max-w-6xl mx-auto px-5">
            <h2 class="text-2xl md:text-4xl text-[#2c2c54] mb-12 font-bold text-center">Get in Touch</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-[#2c2c54] mb-4">We'd love to hear from you</h3>
                    <p class="text-lg text-gray-600 mb-8">Have questions or suggestions? Reach out to us!</p>
                    <div class="space-y-3">
                        <p class="text-lg text-gray-700">📧 contact@socialloop.com</p>
                        <p class="text-lg text-gray-700">📍 Istanbul, Turkey</p>
                    </div>
                </div>
                
                <form class="space-y-4">
                    <input type="text" placeholder="Your Name" required class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <input type="email" placeholder="Your Email" required class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <textarea placeholder="Your Message" required class="w-full p-4 border border-gray-300 rounded-lg h-40 resize-y focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                    <button type="submit" class="py-4 px-8 bg-primary text-white font-semibold rounded-lg hover:bg-[#d88619] transition-colors duration-300">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <?=loadWelcomePartial('footerWl'); ?>
</body>
</html>