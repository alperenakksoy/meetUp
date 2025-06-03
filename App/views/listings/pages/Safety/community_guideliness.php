<?php require_once __DIR__ . '/../../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>

<body class="font-sans text-gray-800 bg-white">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>
    
    <!-- Hero Section -->
    <section class="bg-primary h-[50vh] flex items-center justify-center text-center text-white mt-[60px]">
        <div class="max-w-2xl px-5">
            <h1 class="text-4xl md:text-5xl mb-5 font-volkhov font-bold">Community Guidelines</h1>
            <p class="text-xl opacity-90">Building a safe and inclusive community together</p>
        </div>
    </section>

    <!-- Guidelines Content Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-5">
            <div class="prose prose-lg max-w-none">
                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Our Core Values</h2>
                
                <p class="text-lg text-gray-600 mb-4">At SocialLoop, we believe in:</p>
                
                <ul class="list-none pl-0 space-y-3 mb-8">
                    <li class="flex items-start">
                        <div class="bg-orange-100 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <strong class="text-gray-800">Authentic Connections:</strong> Building genuine relationships through shared experiences
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-orange-100 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <strong class="text-gray-800">Cultural Exchange:</strong> Learning from different perspectives and backgrounds
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-orange-100 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <strong class="text-gray-800">Inclusivity:</strong> Welcoming everyone regardless of nationality, background, or identity
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-orange-100 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <strong class="text-gray-800">Safety:</strong> Prioritizing the well-being of all community members
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-orange-100 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <strong class="text-gray-800">Respect:</strong> Treating each other with courtesy and consideration
                        </div>
                    </li>
                </ul>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">General Conduct</h2>
                
                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-green-50 p-6 rounded-lg">
                        <h3 class="text-xl text-green-800 mb-4 font-semibold">Do:</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Be respectful and courteous in all interactions</li>
                            <li>Communicate openly and honestly</li>
                            <li>Respect others' privacy and personal boundaries</li>
                            <li>Be punctual for events you've committed to attend</li>
                            <li>Provide accurate information in your profile and events</li>
                        </ul>
                    </div>
                    
                    <div class="bg-red-50 p-6 rounded-lg">
                        <h3 class="text-xl text-red-800 mb-4 font-semibold">Don't:</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Engage in harassment, discrimination, or hateful speech</li>
                            <li>Share personal information of others without consent</li>
                            <li>Create fake profiles or misrepresent yourself</li>
                            <li>Spam the platform with commercial solicitations</li>
                            <li>Use the platform for dating or romantic pursuits</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Event Creation and Participation</h2>

                <div class="mb-8">
                    <h3 class="text-xl text-[#2c2c54] mb-4 font-semibold">For Event Hosts:</h3>
                    <ul class="list-disc pl-5 space-y-2 mb-6">
                        <li>Provide clear, accurate details about your event (location, time, activity)</li>
                        <li>Set appropriate expectations about the event</li>
                        <li>Communicate any costs or expenses upfront</li>
                        <li>Be responsive to questions from potential attendees</li>
                        <li>Honor your commitment to host the event as described</li>
                    </ul>

                    <h3 class="text-xl text-[#2c2c54] mb-4 font-semibold">For Event Attendees:</h3>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>RSVP only to events you genuinely plan to attend</li>
                        <li>Notify hosts promptly if you need to cancel</li>
                        <li>Respect the host's guidelines and event description</li>
                        <li>Arrive on time and prepared for the activity</li>
                        <li>Contribute positively to the event atmosphere</li>
                    </ul>
                </div>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Safety Guidelines</h2>

                <div class="bg-blue-50 p-6 rounded-lg mb-8">
                    <h3 class="text-xl text-blue-800 mb-4 font-semibold">Meeting in Person:</h3>
                    <ul class="list-disc pl-5 space-y-2 mb-6">
                        <li>Always meet in public places for initial events</li>
                        <li>Inform a friend or family member about your plans</li>
                        <li>Trust your instincts – if something feels wrong, leave</li>
                        <li>Avoid sharing sensitive personal details too quickly</li>
                        <li>Report any concerning behavior immediately</li>
                    </ul>

                    <h3 class="text-xl text-blue-800 mb-4 font-semibold">Online Communication:</h3>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Keep conversations within the platform initially</li>
                        <li>Be cautious about clicking on external links</li>
                        <li>Protect your personal and financial information</li>
                        <li>Report suspicious messages or scam attempts</li>
                        <li>Communicate respectfully, even in disagreements</li>
                    </ul>
                </div>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Photo and Content Policies</h2>

                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-xl text-[#2c2c54] mb-4 font-semibold">Acceptable Content:</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Photos of public places and events</li>
                            <li>Group photos where all individuals have consented</li>
                            <li>Travel and activity-related content</li>
                            <li>Cultural and educational information</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-xl text-[#2c2c54] mb-4 font-semibold">Prohibited Content:</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Explicit or adult content</li>
                            <li>Violent, graphic, or disturbing imagery</li>
                            <li>Content promoting illegal activities</li>
                            <li>Copyrighted material without permission</li>
                            <li>Misinformation or deliberately false content</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Reference and Review System</h2>
                
                <ul class="list-disc pl-5 space-y-2 mb-8">
                    <li>Provide honest, constructive feedback about your experiences</li>
                    <li>Focus on specific behaviors and events in your reviews</li>
                    <li>Avoid personal attacks or generalizations</li>
                    <li>Report suspicious or fraudulent reviews</li>
                    <li>Accept constructive feedback gracefully</li>
                </ul>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Reporting and Moderation</h2>
                
                <p class="text-lg text-gray-600 mb-4">If you encounter content or behavior that violates these guidelines:</p>
                
                <ol class="list-decimal pl-5 space-y-2 mb-8">
                    <li>Use the reporting feature within the platform</li>
                    <li>Provide specific details about the violation</li>
                    <li>Include evidence if available (screenshots, messages)</li>
                    <li>Do not engage with or escalate problematic interactions</li>
                    <li>Allow our moderation team time to investigate</li>
                </ol>
                
                <p class="text-lg text-gray-600 mb-8">Our moderation team reviews all reports within 24 hours and takes appropriate action based on the severity and context of the violation.</p>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Consequences for Violations</h2>
                
                <p class="text-lg text-gray-600 mb-4">Depending on the severity and frequency of violations, consequences may include:</p>
                
                <ul class="list-disc pl-5 space-y-2 mb-8">
                    <li>Educational warnings</li>
                    <li>Temporary restrictions or suspensions</li>
                    <li>Event posting limitations</li>
                    <li>Account termination</li>
                    <li>Legal action for serious violations</li>
                </ul>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Changes to Guidelines</h2>
                
                <p class="text-lg text-gray-600 mb-8">These guidelines may be updated periodically to address emerging community needs. We will notify users of significant changes via email and platform announcements.</p>

                <h2 class="text-2xl md:text-3xl text-[#2c2c54] mb-6 font-bold">Contact Us</h2>
                
                <p class="text-lg text-gray-600 mb-4">If you have questions about these guidelines or need to report an issue requiring immediate attention:</p>
                
                <ul class="list-disc pl-5 space-y-2 mb-8">
                    <li>Email: <a href="mailto:safety@socialloop.com" class="text-primary hover:underline">safety@socialloop.com</a></li>
                    <li>Emergency Assistance: Use the "Report Urgent Issue" button in the Safety Center</li>
                    <li>General Feedback: <a href="mailto:feedback@socialloop.com" class="text-primary hover:underline">feedback@socialloop.com</a></li>
                </ul>
                
                <div class="bg-gray-100 p-6 rounded-lg mb-8">
                    <p class="text-lg text-gray-800 font-medium">By participating in the SocialLoop community, you agree to follow these guidelines and help us maintain a positive environment for everyone. Thank you for being part of our global community of travelers and locals!</p>
                </div>
                
                <p class="text-sm text-gray-500 italic">Last Updated: April 17, 2025</p>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="py-10 bg-primary text-white text-center">
        <div class="max-w-2xl mx-auto px-5">
            <h2 class="text-2xl md:text-3xl mb-5 font-bold">Ready to Build Meaningful Connections?</h2>
            <p class="text-lg opacity-90 mb-8">Join our community of travelers and locals today!</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/login_registerScreen/registerIndex.php" class="bg-white text-primary px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition-colors">Sign Up Now</a>
                <a href="/App/navigations/Safety/safety.php" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white/10 transition-colors">Learn About Safety</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?=loadWelcomePartial('footerWl'); ?>

    <script>
        // This script adds smooth scrolling to the guidelines sections
        document.addEventListener('DOMContentLoaded', function() {
            // Get all heading elements within the guidelines
            const headings = document.querySelectorAll('.prose h2');
            
            // Create a table of contents (optional enhancement)
            // const tocContainer = document.getElementById('toc');
            // if (tocContainer) {
            //     const tocList = document.createElement('ul');
            //     tocList.className = 'space-y-2';
            //     
            //     headings.forEach(heading => {
            //         const listItem = document.createElement('li');
            //         const link = document.createElement('a');
            //         
            //         // Create an ID from the heading text
            //         const headingId = heading.textContent.toLowerCase().replace(/\s+/g, '-');
            //         heading.id = headingId;
            //         
            //         link.href = `#${headingId}`;
            //         link.textContent = heading.textContent;
            //         link.className = 'hover:text-primary transition-colors';
            //         
            //         listItem.appendChild(link);
            //         tocList.appendChild(listItem);
            //     });
            //     
            //     tocContainer.appendChild(tocList);
            // }
            
            // Highlight current section on scroll
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                
                headings.forEach(heading => {
                    const section = heading.parentElement;
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    
                    if (scrollPosition >= sectionTop - 100 && 
                        scrollPosition < sectionTop + sectionHeight - 100) {
                        // You could add visual indication of current section here
                    }
                });
            });
        });
    </script>
</body>
</html>