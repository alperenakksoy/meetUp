<?php loadWelcomePartial('headerWl') ?>

<main style="margin-top: 70px; padding: 4rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        <section style="text-align: center; color: white; margin-bottom: 4rem;">
            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1.5rem;">Platform Features</h1>
            <p style="font-size: 1.3rem; opacity: 0.9; max-width: 800px; margin: 0 auto;">
                Everything you need to connect, discover, and participate in amazing events
            </p>
        </section>

        <!-- Main Features Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
            
            <!-- Event Discovery -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem; text-align: center; transition: transform 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem;">
                    <i class="fas fa-search"></i>
                </div>
                <h3 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Smart Event Discovery</h3>
                <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                    Our intelligent algorithm suggests events based on your interests, location, and past activities. 
                    Never miss out on events you'd love to attend.
                </p>
                <ul style="text-align: left; color: #555; line-height: 1.8;">
                    <li style="margin-bottom: 0.5rem;">• Personalized recommendations</li>
                    <li style="margin-bottom: 0.5rem;">• Location-based filtering</li>
                    <li style="margin-bottom: 0.5rem;">• Category-based search</li>
                    <li style="margin-bottom: 0.5rem;">• Save events for later</li>
                </ul>
            </div>

            <!-- Event Creation -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem; text-align: center; transition: transform 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #f39c12, #e67e22); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem;">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <h3 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Easy Event Creation</h3>
                <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                    Create and manage events with our intuitive tools. Set up everything from casual meetups 
                    to organized activities in just a few clicks.
                </p>
                <ul style="text-align: left; color: #555; line-height: 1.8;">
                    <li style="margin-bottom: 0.5rem;">• Drag-and-drop event builder</li>
                    <li style="margin-bottom: 0.5rem;">• Attendance management</li>
                    <li style="margin-bottom: 0.5rem;">• Photo and media uploads</li>
                    <li style="margin-bottom: 0.5rem;">• Event analytics</li>
                </ul>
            </div>

            <!-- Social Features -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem; text-align: center; transition: transform 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem;">
                    <i class="fas fa-users"></i>
                </div>
                <h3 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Social Networking</h3>
                <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                    Build meaningful connections with people who share your interests. 
                    Chat, follow, and stay connected with your new friends.
                </p>
                <ul style="text-align: left; color: #555; line-height: 1.8;">
                    <li style="margin-bottom: 0.5rem;">• Friend system</li>
                    <li style="margin-bottom: 0.5rem;">• Private messaging</li>
                    <li style="margin-bottom: 0.5rem;">• User profiles</li>
                    <li style="margin-bottom: 0.5rem;">• Activity feeds</li>
                </ul>
            </div>

            <!-- Safety & Trust -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem; text-align: center; transition: transform 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #27ae60, #229954); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Safety & Trust</h3>
                <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                    Your safety is our priority. We have robust verification systems and 
                    community guidelines to ensure a positive experience for everyone.
                </p>
                <ul style="text-align: left; color: #555; line-height: 1.8;">
                    <li style="margin-bottom: 0.5rem;">• User verification</li>
                    <li style="margin-bottom: 0.5rem;">• Event moderation</li>
                    <li style="margin-bottom: 0.5rem;">• Reporting system</li>
                    <li style="margin-bottom: 0.5rem;">• Community guidelines</li>
                </ul>
            </div>

            <!-- Mobile App -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem; text-align: center; transition: transform 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #9b59b6, #8e44ad); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem;">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Mobile Experience</h3>
                <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                    Access SocialLoop anywhere with our responsive web app. 
                    Get real-time notifications and stay connected on the go.
                </p>
                <ul style="text-align: left; color: #555; line-height: 1.8;">
                    <li style="margin-bottom: 0.5rem;">• Responsive design</li>
                    <li style="margin-bottom: 0.5rem;">• Push notifications</li>
                    <li style="margin-bottom: 0.5rem;">• Offline capabilities</li>
                    <li style="margin-bottom: 0.5rem;">• GPS integration</li>
                </ul>
            </div>

            <!-- Analytics -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem; text-align: center; transition: transform 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #34495e, #2c3e50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Event Analytics</h3>
                <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                    Track your event performance with detailed analytics. 
                    Understand your audience and improve future events.
                </p>
                <ul style="text-align: left; color: #555; line-height: 1.8;">
                    <li style="margin-bottom: 0.5rem;">• Attendance tracking</li>
                    <li style="margin-bottom: 0.5rem;">• Engagement metrics</li>
                    <li style="margin-bottom: 0.5rem;">• User demographics</li>
                    <li style="margin-bottom: 0.5rem;">• Performance insights</li>
                </ul>
            </div>
        </div>

        <!-- Call to Action -->
        <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 3rem; text-align: center;">
            <h2 style="font-size: 2.5rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Ready to Get Started?</h2>
            <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                Join thousands of users who are already connecting through SocialLoop. 
                Start discovering events and making new friends today!
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="/register" style="background: linear-gradient(135deg, #f39c12, #e74c3c); color: white; padding: 1rem 2rem; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; font-size: 1.1rem;">
                    Join SocialLoop
                </a>
                <a href="/events" style="background: transparent; color: #2c3e50; border: 2px solid #2c3e50; padding: 1rem 2rem; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; font-size: 1.1rem;">
                    Browse Events
                </a>
            </div>
        </div>
    </div>
</main>

<?php loadWelcomePartial('footerWl') ?>