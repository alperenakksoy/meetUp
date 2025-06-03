<?php loadWelcomePartial('headerWl') ?>

<main style="margin-top: 70px; padding: 4rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        <section style="text-align: center; color: white; margin-bottom: 4rem;">
            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1.5rem;">Contact Us</h1>
            <p style="font-size: 1.3rem; opacity: 0.9; max-width: 800px; margin: 0 auto;">
                We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>
        </section>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 10px; margin-bottom: 2rem; text-align: center;">
                <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                <?= $_SESSION['success_message'] ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 3rem; align-items: start;">
            
            <!-- Contact Form -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem;">
                <h2 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1.5rem;">Send us a Message</h2>
                
                <form action="/contact" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    
                    <div>
                        <label for="name" style="display: block; font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Name *</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;" 
                               required>
                        <?php if (isset($errors['name'])): ?>
                            <div style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.5rem;">
                                <i class="fas fa-exclamation-circle"></i> <?= $errors['name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="email" style="display: block; font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Email *</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" 
                               style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;" 
                               required>
                        <?php if (isset($errors['email'])): ?>
                            <div style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.5rem;">
                                <i class="fas fa-exclamation-circle"></i> <?= $errors['email'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="subject" style="display: block; font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Subject</label>
                        <select id="subject" name="subject" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                            <option value="general">General Inquiry</option>
                            <option value="support">Technical Support</option>
                            <option value="feedback">Feedback</option>
                            <option value="business">Business Partnership</option>
                            <option value="bug">Bug Report</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" style="display: block; font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Message *</label>
                        <textarea id="message" name="message" rows="6" 
                                  style="width: 100%; padding: 0.75rem; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease; resize: vertical;" 
                                  placeholder="Tell us how we can help you..."
                                  required><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                        <?php if (isset($errors['message'])): ?>
                            <div style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.5rem;">
                                <i class="fas fa-exclamation-circle"></i> <?= $errors['message'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" 
                            style="background: linear-gradient(135deg, #f39c12, #e74c3c); color: white; padding: 1rem 2rem; border: none; border-radius: 25px; font-weight: 600; font-size: 1.1rem; cursor: pointer; transition: all 0.3s ease;">
                        <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 2.5rem;">
                <h2 style="font-size: 1.8rem; font-weight: 600; color: #2c3e50; margin-bottom: 1.5rem;">Get in Touch</h2>
                
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Email Us</h3>
                            <p style="color: #666; line-height: 1.6;">
                                <a href="mailto:hello@socialloop.com" style="color: #f39c12; text-decoration: none;">hello@socialloop.com</a><br>
                                <a href="mailto:support@socialloop.com" style="color: #f39c12; text-decoration: none;">support@socialloop.com</a>
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #27ae60, #229954); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Call Us</h3>
                            <p style="color: #666; line-height: 1.6;">
                                +90 (530) 123 45 67<br>
                                Mon-Fri 09:00-18:00
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Visit Us</h3>
                            <p style="color: #666; line-height: 1.6;">
                                Halaskargazi Caddesi No:145<br>
                                Bozkurt Mahallesi, Şişli<br>
                                34360 İstanbul, Türkiye
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #9b59b6, #8e44ad); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; color: #2c3e50; margin-bottom: 0.5rem;">Follow Us</h3>
                            <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                                <a href="#" style="color: #3498db; font-size: 1.5rem; transition: color 0.3s ease;" title="Facebook">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="#" style="color: #1da1f2; font-size: 1.5rem; transition: color 0.3s ease;" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" style="color: #0077b5; font-size: 1.5rem; transition: color 0.3s ease;" title="LinkedIn">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="#" style="color: #e4405f; font-size: 1.5rem; transition: color 0.3s ease;" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e1e5e9;">
                    <h3 style="font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">Frequently Asked Questions</h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <details style="background: #f8f9fa; padding: 1rem; border-radius: 10px; cursor: pointer;">
                            <summary style="font-weight: 600; color: #2c3e50;">How do I create an event?</summary>
                            <p style="color: #666; margin-top: 0.5rem; line-height: 1.6;">
                                Simply sign up, click "Create Event" and fill out the event details. Our easy-to-use form will guide you through the process.
                            </p>
                        </details>
                        <details style="background: #f8f9fa; padding: 1rem; border-radius: 10px; cursor: pointer;">
                            <summary style="font-weight: 600; color: #2c3e50;">Is SocialLoop free to use?</summary>
                            <p style="color: #666; margin-top: 0.5rem; line-height: 1.6;">
                                Yes! Creating an account, browsing events, and joining events is completely free.
                            </p>
                        </details>
                        <details style="background: #f8f9fa; padding: 1rem; border-radius: 10px; cursor: pointer;">
                            <summary style="font-weight: 600; color: #2c3e50;">How do I report inappropriate content?</summary>
                            <p style="color: #666; margin-top: 0.5rem; line-height: 1.6;">
                                You can report any inappropriate content or behavior using the report button on events or user profiles.
                            </p>
                        </details>
                    </div>
                </div>
            </div>
        </div>

        <!-- Response Time Notice -->
        <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px; padding: 2rem; margin-top: 3rem; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1rem;">
                <i class="fas fa-clock" style="color: #f39c12; font-size: 1.5rem;"></i>
                <h3 style="font-size: 1.3rem; font-weight: 600; color: #2c3e50;">Response Time</h3>
            </div>
            <p style="color: #666; line-height: 1.6;">
                We typically respond to all inquiries within 24 hours. For urgent technical issues, 
                please email <a href="mailto:support@socialloop.com" style="color: #f39c12; text-decoration: none;">support@socialloop.com</a> 
                with "URGENT" in the subject line.
            </p>
        </div>
    </div>
</main>

<style>
    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #f39c12 !important;
        box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4);
    }

    details[open] summary {
        margin-bottom: 0.5rem;
    }

    details summary::-webkit-details-marker {
        display: none;
    }

    details summary::before {
        content: '▶';
        margin-right: 0.5rem;
        transition: transform 0.3s ease;
    }

    details[open] summary::before {
        transform: rotate(90deg);
    }
</style>

<?php loadWelcomePartial('footerWl') ?>