<?php loadWelcomePartial('headerWl') ?>

<main style="margin-top: 70px; padding: 4rem 0;">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 2rem;">
        <section style="text-align: center; color: white; margin-bottom: 4rem;">
            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1.5rem;">Frequently Asked Questions</h1>
            <p style="font-size: 1.3rem; opacity: 0.9; max-width: 800px; margin: 0 auto;">
                Find answers to common questions about SocialLoop. Can't find what you're looking for? 
                <a href="/contact" style="color: #f39c12; text-decoration: none; font-weight: 600;">Contact us</a> for more help.
            </p>
        </section>

        <!-- Search Box -->
        <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; padding: 1.5rem; margin-bottom: 3rem;">
            <div style="position: relative;">
                <i class="fas fa-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #999; font-size: 1.1rem;"></i>
                <input type="text" id="faqSearch" placeholder="Search frequently asked questions..." 
                       style="width: 100%; padding: 1rem 1rem 1rem 3rem; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
            </div>
        </div>

        <!-- FAQ Categories -->
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 3rem; justify-content: center;">
            <button class="category-btn active" data-category="all" 
                    style="padding: 0.75rem 1.5rem; border: none; border-radius: 25px; background: linear-gradient(135deg, #f39c12, #e74c3c); color: white; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                All Questions
            </button>
            <button class="category-btn" data-category="getting-started" 
                    style="padding: 0.75rem 1.5rem; border: 2px solid #f39c12; border-radius: 25px; background: transparent; color: #f39c12; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                Getting Started
            </button>
            <button class="category-btn" data-category="events" 
                    style="padding: 0.75rem 1.5rem; border: 2px solid #f39c12; border-radius: 25px; background: transparent; color: #f39c12; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                Events
            </button>
            <button class="category-btn" data-category="account" 
                    style="padding: 0.75rem 1.5rem; border: 2px solid #f39c12; border-radius: 25px; background: transparent; color: #f39c12; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                Account & Profile
            </button>
            <button class="category-btn" data-category="safety" 
                    style="padding: 0.75rem 1.5rem; border: 2px solid #f39c12; border-radius: 25px; background: transparent; color: #f39c12; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                Safety
            </button>
            <button class="category-btn" data-category="technical" 
                    style="padding: 0.75rem 1.5rem; border: 2px solid #f39c12; border-radius: 25px; background: transparent; color: #f39c12; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                Technical
            </button>
        </div>

        <!-- FAQ Items -->
        <div class="faq-container">
            
            <!-- Getting Started -->
            <div class="faq-item" data-category="getting-started" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>How do I create a SocialLoop account?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>Creating an account is simple and free:</p>
                        <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Click "Sign Up" in the top navigation</li>
                            <li>Fill in your basic information (name, email, password)</li>
                            <li>Verify your email address</li>
                            <li>Complete your profile with interests and location</li>
                            <li>Start discovering events in your area!</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="getting-started" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>Is SocialLoop free to use?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>Yes! SocialLoop is completely free to use. You can:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Create an account and profile</li>
                            <li>Browse and join events</li>
                            <li>Create your own events</li>
                            <li>Connect with other users</li>
                            <li>Send messages and make friends</li>
                        </ul>
                        <p style="margin-top: 1rem;">We may introduce premium features in the future, but the core functionality will always remain free.</p>
                    </div>
                </div>
            </div>

            <!-- Events -->
            <div class="faq-item" data-category="events" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>How do I find events near me?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>Finding events is easy with our search and filter options:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li><strong>Location filter:</strong> Set your city or use current location</li>
                            <li><strong>Category filter:</strong> Choose from coffee, cultural, sports, language exchange, etc.</li>
                            <li><strong>Date filter:</strong> Find events happening today, this weekend, or specific dates</li>
                            <li><strong>Search bar:</strong> Search by keywords or event names</li>
                            <li><strong>Recommendations:</strong> Our algorithm suggests events based on your interests</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="events" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>How do I create my own event?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>Creating an event is straightforward:</p>
                        <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Click "Create Event" from your dashboard</li>
                            <li>Fill in event details (title, description, date, time, location)</li>
                            <li>Choose a category and set attendance limits if needed</li>
                            <li>Upload a cover image (optional)</li>
                            <li>Set whether approval is required for attendees</li>
                            <li>Publish your event and start inviting people!</li>
                        </ol>
                        <p style="margin-top: 1rem;"><strong>Tip:</strong> Be specific in your description to attract the right attendees.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="events" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>Can I cancel my attendance at an event?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>Yes, you can cancel your attendance anytime before the event starts:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Go to the event page</li>
                            <li>Click "Leave Event" or "Cancel Attendance"</li>
                            <li>Confirm your cancellation</li>
                        </ul>
                        <p style="margin-top: 1rem;">We encourage giving as much notice as possible to help the host plan accordingly. Some hosts may have specific cancellation policies.</p>
                    </div>
                </div>
            </div>

            <!-- Account & Profile -->
            <div class="faq-item" data-category="account" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>How do I update my profile information?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>You can update your profile anytime:</p>
                        <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Go to your profile page</li>
                            <li>Click "Edit Profile"</li>
                            <li>Update any information you'd like to change</li>
                            <li>Add interests, languages, and social media links</li>
                            <li>Save your changes</li>
                        </ol>
                        <p style="margin-top: 1rem;">A complete profile helps others find and connect with you based on shared interests.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="account" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>How do I reset my password?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>To reset your password:</p>
                        <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Go to the login page</li>
                            <li>Click "Forgot Password?"</li>
                            <li>Enter your email address</li>
                            <li>Check your email for a reset link</li>
                            <li>Follow the link to create a new password</li>
                        </ol>
                        <p style="margin-top: 1rem;">If you don't receive the email within a few minutes, check your spam folder or contact support.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="account" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>Can I deactivate or delete my account?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>Yes, you have control over your account:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li><strong>Deactivation:</strong> Temporarily disable your account (can be reactivated)</li>
                            <li><strong>Deletion:</strong> Permanently delete your account and all associated data</li>
                        </ul>
                        <p style="margin-top: 1rem;">To deactivate or delete your account, go to Settings > Account > Deactivate/Delete Account. 
                        Please note that account deletion is irreversible and will remove all your data, events, and connections.</p>
                    </div>
                </div>
            </div>

            <!-- Safety -->
            <div class="faq-item" data-category="safety" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>How do I report inappropriate behavior or content?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>We take safety seriously. To report issues:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Click the "Report" button on any event, user profile, or message</li>
                            <li>Select the reason for reporting (harassment, inappropriate content, etc.)</li>
                            <li>Provide additional details if necessary</li>
                            <li>Submit the report</li>
                        </ul>
                        <p style="margin-top: 1rem;">Our moderation team reviews all reports within 24 hours. For urgent safety concerns, 
                        contact us directly at <a href="mailto:safety@socialloop.com" style="color: #f39c12;">safety@socialloop.com</a>.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="safety" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>What safety measures are in place?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>SocialLoop implements multiple safety measures:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li><strong>User verification:</strong> Email verification required for all accounts</li>
                            <li><strong>Profile moderation:</strong> Automated and manual review of profiles</li>
                            <li><strong>Event monitoring:</strong> Events are reviewed for compliance with guidelines</li>
                            <li><strong>Reporting system:</strong> Easy-to-use reporting tools</li>
                            <li><strong>Blocking features:</strong> Block users who make you uncomfortable</li>
                            <li><strong>Privacy controls:</strong> Control who can see your information</li>
                        </ul>
                        <p style="margin-top: 1rem;">Always meet in public places for first meetings and trust your instincts.</p>
                    </div>
                </div>
            </div>

            <!-- Technical -->
            <div class="faq-item" data-category="technical" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>Why am I not receiving email notifications?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>If you're not receiving email notifications, try these steps:</p>
                        <ol style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Check your spam/junk folder</li>
                            <li>Add no-reply@socialloop.com to your contacts</li>
                            <li>Check your notification settings in your profile</li>
                            <li>Verify your email address is correct in your account settings</li>
                            <li>Contact support if the issue persists</li>
                        </ol>
                        <p style="margin-top: 1rem;">You can customize which notifications you receive in your account settings.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="technical" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>Is there a mobile app for SocialLoop?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>Currently, SocialLoop is optimized as a progressive web app (PWA) that works great on mobile devices:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Access the website on your mobile browser</li>
                            <li>Add it to your home screen for app-like experience</li>
                            <li>Receive push notifications</li>
                            <li>Works offline for basic features</li>
                        </ul>
                        <p style="margin-top: 1rem;">We're working on native mobile apps for iOS and Android, which will be available soon!</p>
                    </div>
                </div>
            </div>

            <div class="faq-item" data-category="getting-started" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-question" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #2c3e50; font-size: 1.1rem; transition: background 0.3s ease;">
                    <span>What types of events can I find on SocialLoop?</span>
                    <i class="fas fa-chevron-down faq-icon" style="color: #f39c12; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <div style="padding: 0 1.5rem 1.5rem; color: #666; line-height: 1.7;">
                        <p>SocialLoop hosts a wide variety of events for different interests:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li><strong>Coffee & Drinks:</strong> Casual meetups, coffee tastings, happy hours</li>
                            <li><strong>Cultural:</strong> Museum visits, art galleries, cultural festivals</li>
                            <li><strong>Sports & Outdoor:</strong> Hiking, cycling, yoga, team sports</li>
                            <li><strong>Language Exchange:</strong> Practice languages with native speakers</li>
                            <li><strong>Food & Dining:</strong> Cooking classes, food tours, restaurant visits</li>
                            <li><strong>Art & Music:</strong> Concerts, art workshops, creative sessions</li>
                            <li><strong>Technology:</strong> Tech talks, coding workshops, startup meetups</li>
                        </ul>
                        <p style="margin-top: 1rem;">New categories are added based on community interest!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Still Have Questions? -->
        <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 3rem; text-align: center; margin-top: 3rem;">
            <h2 style="font-size: 2rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Still have questions?</h2>
            <p style="color: #666; line-height: 1.7; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                Can't find the answer you're looking for? Our support team is here to help. 
                Reach out to us and we'll get back to you as soon as possible.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="/contact" style="background: linear-gradient(135deg, #f39c12, #e74c3c); color: white; padding: 1rem 2rem; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                    <i class="fas fa-envelope mr-2"></i>Contact Support
                </a>
                <a href="mailto:help@socialloop.com" style="background: transparent; color: #2c3e50; border: 2px solid #2c3e50; padding: 1rem 2rem; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                    <i class="fas fa-paper-plane mr-2"></i>Email Us
                </a>
            </div>
        </div>
    </div>
</main>
<?=loadWelcomePartial('footerWl'); ?>

<style>
/* General Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #3498db;
    color: #333;
    line-height: 1.6;
}

/* FAQ Container */
.faq-container {
    max-width: 1000px;
    margin: 0 auto;
}

/* FAQ Item */
.faq-item {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    margin-bottom: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.faq-item:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

/* FAQ Question */
.faq-question {
    padding: 1.5rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.1rem;
    transition: background 0.3s ease;
}

.faq-question:hover {
    background-color: rgba(243, 156, 18, 0.1);
}

/* FAQ Answer */
.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-answer.show {
    max-height: 500px; /* Adjust based on your content */
}

/* FAQ Icon */
.faq-icon {
    color: #f39c12;
    transition: transform 0.3s ease;
}

.faq-icon.rotate {
    transform: rotate(180deg);
}

/* Category Buttons */
.category-btn {
    padding: 0.75rem 1.5rem;
    border: 2px solid #f39c12;
    border-radius: 25px;
    background: transparent;
    color: #f39c12;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.category-btn:hover {
    background: rgba(243, 156, 18, 0.1);
    transform: translateY(-2px);
}

.category-btn.active {
    background: linear-gradient(135deg, #f39c12, #e74c3c);
    color: white;
    border: none;
    box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
}

/* Search Box */
#faqSearch {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e1e5e9;
    border-radius: 10px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

#faqSearch:focus {
    outline: none;
    border-color: #f39c12;
    box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    main {
        padding: 2rem 0;
    }
    
    h1 {
        font-size: 2.2rem !important;
    }
    
    .category-btn {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .faq-question {
        padding: 1rem;
        font-size: 1rem;
    }
}

/* Animation for FAQ items */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.faq-item {
    animation: fadeIn 0.3s ease forwards;
}

/* Delay animations for a staggered effect */
.faq-item:nth-child(1) { animation-delay: 0.1s; }
.faq-item:nth-child(2) { animation-delay: 0.2s; }
.faq-item:nth-child(3) { animation-delay: 0.3s; }
.faq-item:nth-child(4) { animation-delay: 0.4s; }
.faq-item:nth-child(5) { animation-delay: 0.5s; }
.faq-item:nth-child(6) { animation-delay: 0.6s; }
.faq-item:nth-child(7) { animation-delay: 0.7s; }
.faq-item:nth-child(8) { animation-delay: 0.8s; }
.faq-item:nth-child(9) { animation-delay: 0.9s; }
.faq-item:nth-child(10) { animation-delay: 1.0s; }
.faq-item:nth-child(11) { animation-delay: 1.1s; }
.faq-item:nth-child(12) { animation-delay: 1.2s; }
</style>

<script>
// JavaScript to handle FAQ functionality
document.addEventListener('DOMContentLoaded', function() {
    // FAQ toggle functionality
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const icon = question.querySelector('.faq-icon');
            
            // Toggle the answer
            answer.classList.toggle('show');
            
            // Rotate the icon
            icon.classList.toggle('rotate');
            
            // Close other open FAQs if needed
            // faqQuestions.forEach(otherQuestion => {
            //     if (otherQuestion !== question) {
            //         otherQuestion.nextElementSibling.classList.remove('show');
            //         otherQuestion.querySelector('.faq-icon').classList.remove('rotate');
            //     }
            // });
        });
    });
    
    // Category filter functionality
    const categoryButtons = document.querySelectorAll('.category-btn');
    const faqItems = document.querySelectorAll('.faq-item');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Filter FAQ items
            const category = button.dataset.category;
            faqItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Search functionality
    const faqSearch = document.getElementById('faqSearch');
faqSearch.addEventListener('input', () => {
    const searchTerm = faqSearch.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item'); // Ensure this is correctly defined
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
            // Expand answer if match is found in answer
            if (answer.includes(searchTerm)) {
                item.querySelector('.faq-answer').classList.add('show');
                item.querySelector('.faq-icon').classList.add('rotate');
            }
        } else {
            item.style.display = 'none';
        }
    });
});

});
</script>