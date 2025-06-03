<?php
// Set page variables
$pageTitle = 'Report an Issue - SocialLoop';
$activePage = 'report';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body class="bg-gray-50 pt-20">
    <?php loadPartial('navbar') ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6 max-w-4xl">
        
        <!-- Page Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 font-volkhov">Report an Issue</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Help us maintain a safe and welcoming community by reporting inappropriate behavior, 
                content violations, or technical issues.
            </p>
        </div>

        <!-- Success Message -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-700 font-medium">
                            <?= $_SESSION['success_message'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <!-- Error Messages -->
        <?php if (!empty($errors)): ?>
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-red-700 font-medium mb-2">Please fix the following errors:</h3>
                        <ul class="text-red-700 list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Report Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800">Submit a Report</h2>
                        <p class="text-sm text-gray-600 mt-1">All reports are reviewed by our moderation team within 24 hours.</p>
                    </div>
                    
                    <form action="/report" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                        
                        <!-- Report Type -->
                        <div>
                            <label for="report_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Report Type *
                            </label>
                            <select id="report_type" name="report_type" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">Select report type</option>
                                
                                <optgroup label="User-Related Issues">
                                    <option value="harassment" <?= (isset($old['report_type']) && $old['report_type'] == 'harassment') ? 'selected' : '' ?>>
                                        Harassment or Bullying
                                    </option>
                                    <option value="inappropriate_behavior" <?= (isset($old['report_type']) && $old['report_type'] == 'inappropriate_behavior') ? 'selected' : '' ?>>
                                        Inappropriate Behavior
                                    </option>
                                    <option value="fake_profile" <?= (isset($old['report_type']) && $old['report_type'] == 'fake_profile') ? 'selected' : '' ?>>
                                        Fake Profile
                                    </option>
                                    <option value="spam_user" <?= (isset($old['report_type']) && $old['report_type'] == 'spam_user') ? 'selected' : '' ?>>
                                        Spam or Promotional Content
                                    </option>
                                </optgroup>
                                
                                <optgroup label="Event-Related Issues">
                                    <option value="inappropriate_event" <?= (isset($old['report_type']) && $old['report_type'] == 'inappropriate_event') ? 'selected' : '' ?>>
                                        Inappropriate Event Content
                                    </option>
                                    <option value="misleading_event" <?= (isset($old['report_type']) && $old['report_type'] == 'misleading_event') ? 'selected' : '' ?>>
                                        Misleading Event Information
                                    </option>
                                    <option value="dangerous_event" <?= (isset($old['report_type']) && $old['report_type'] == 'dangerous_event') ? 'selected' : '' ?>>
                                        Potentially Dangerous Event
                                    </option>
                                    <option value="spam_event" <?= (isset($old['report_type']) && $old['report_type'] == 'spam_event') ? 'selected' : '' ?>>
                                        Spam Event
                                    </option>
                                </optgroup>
                                
                                <optgroup label="Content Issues">
                                    <option value="hate_speech" <?= (isset($old['report_type']) && $old['report_type'] == 'hate_speech') ? 'selected' : '' ?>>
                                        Hate Speech
                                    </option>
                                    <option value="inappropriate_content" <?= (isset($old['report_type']) && $old['report_type'] == 'inappropriate_content') ? 'selected' : '' ?>>
                                        Inappropriate Images/Content
                                    </option>
                                    <option value="copyright" <?= (isset($old['report_type']) && $old['report_type'] == 'copyright') ? 'selected' : '' ?>>
                                        Copyright Violation
                                    </option>
                                </optgroup>
                                
                                <optgroup label="Technical Issues">
                                    <option value="bug" <?= (isset($old['report_type']) && $old['report_type'] == 'bug') ? 'selected' : '' ?>>
                                        Website Bug
                                    </option>
                                    <option value="performance" <?= (isset($old['report_type']) && $old['report_type'] == 'performance') ? 'selected' : '' ?>>
                                        Performance Issue
                                    </option>
                                    <option value="security" <?= (isset($old['report_type']) && $old['report_type'] == 'security') ? 'selected' : '' ?>>
                                        Security Concern
                                    </option>
                                </optgroup>
                                
                                <option value="other" <?= (isset($old['report_type']) && $old['report_type'] == 'other') ? 'selected' : '' ?>>
                                    Other
                                </option>
                            </select>
                        </div>

                        <!-- Subject/What are you reporting -->
                        <div>
                            <label for="reported_content" class="block text-sm font-medium text-gray-700 mb-2">
                                What are you reporting? *
                            </label>
                            <select id="reported_content" name="reported_content" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">Select what you're reporting</option>
                                <option value="user" <?= (isset($old['reported_content']) && $old['reported_content'] == 'user') ? 'selected' : '' ?>>
                                    A User Profile
                                </option>
                                <option value="event" <?= (isset($old['reported_content']) && $old['reported_content'] == 'event') ? 'selected' : '' ?>>
                                    An Event
                                </option>
                                <option value="message" <?= (isset($old['reported_content']) && $old['reported_content'] == 'message') ? 'selected' : '' ?>>
                                    A Message/Comment
                                </option>
                                <option value="website" <?= (isset($old['reported_content']) && $old['reported_content'] == 'website') ? 'selected' : '' ?>>
                                    Website Issue
                                </option>
                                <option value="general" <?= (isset($old['reported_content']) && $old['reported_content'] == 'general') ? 'selected' : '' ?>>
                                    General Issue
                                </option>
                            </select>
                        </div>

                        <!-- URL or Reference -->
                        <div>
                            <label for="reference_url" class="block text-sm font-medium text-gray-700 mb-2">
                                URL or Reference
                                <span class="text-gray-500 font-normal">(optional)</span>
                            </label>
                            <input type="url" id="reference_url" name="reference_url" 
                                   value="<?= htmlspecialchars($old['reference_url'] ?? '') ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   placeholder="https://socialloop.com/events/123 or user profile link">
                            <p class="mt-1 text-sm text-gray-500">
                                If reporting a specific user, event, or page, please provide the URL or link.
                            </p>
                        </div>

                        <!-- Priority Level -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                                Priority Level *
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="priority" value="low" 
                                           <?= (isset($old['priority']) && $old['priority'] == 'low') ? 'checked' : '' ?>
                                           class="mr-3 text-orange-500 focus:ring-orange-500">
                                    <div>
                                        <div class="font-medium text-gray-800">Low</div>
                                        <div class="text-sm text-gray-600">Non-urgent issue</div>
                                    </div>
                                </label>
                                
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="priority" value="medium" 
                                           <?= (isset($old['priority']) && $old['priority'] == 'medium') ? 'checked' : 'checked' ?>
                                           class="mr-3 text-orange-500 focus:ring-orange-500">
                                    <div>
                                        <div class="font-medium text-gray-800">Medium</div>
                                        <div class="text-sm text-gray-600">Moderately urgent</div>
                                    </div>
                                </label>
                                
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="priority" value="high" 
                                           <?= (isset($old['priority']) && $old['priority'] == 'high') ? 'checked' : '' ?>
                                           class="mr-3 text-orange-500 focus:ring-orange-500">
                                    <div>
                                        <div class="font-medium text-gray-800">High</div>
                                        <div class="text-sm text-gray-600">Urgent/Safety issue</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Detailed Description *
                            </label>
                            <textarea id="description" name="description" rows="6" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none"
                                      placeholder="Please provide as much detail as possible about the issue. Include what happened, when it occurred, and any other relevant information that would help us understand and resolve the issue."
                                      maxlength="2000"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                            <div class="flex justify-between mt-1">
                                <p class="text-sm text-gray-500">Be specific and provide context to help us investigate effectively.</p>
                                <span class="text-sm text-gray-400" id="descriptionCounter">0/2000</span>
                            </div>
                        </div>

                        <!-- Evidence Upload -->
                        <div>
                            <label for="evidence" class="block text-sm font-medium text-gray-700 mb-2">
                                Evidence (Screenshots, etc.)
                                <span class="text-gray-500 font-normal">(optional)</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                                <input type="file" id="evidence" name="evidence[]" multiple accept="image/*,.pdf,.doc,.docx"
                                       class="hidden" onchange="handleFileUpload(this)">
                                <div id="upload-area" onclick="document.getElementById('evidence').click()" class="cursor-pointer">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600 font-medium">Click to upload files</p>
                                    <p class="text-sm text-gray-500 mt-1">Screenshots, documents (max 5 files, 10MB each)</p>
                                </div>
                                <div id="file-list" class="mt-4 space-y-2"></div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Email *
                                </label>
                                <input type="email" id="contact_email" name="contact_email" required
                                       value="<?= htmlspecialchars($old['contact_email'] ?? ($_SESSION['user']['email'] ?? '')) ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="contact_preference" class="block text-sm font-medium text-gray-700 mb-2">
                                    Contact Preference
                                </label>
                                <select id="contact_preference" name="contact_preference"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                    <option value="email" <?= (isset($old['contact_preference']) && $old['contact_preference'] == 'email') ? 'selected' : 'selected' ?>>
                                        Email updates
                                    </option>
                                    <option value="none" <?= (isset($old['contact_preference']) && $old['contact_preference'] == 'none') ? 'selected' : '' ?>>
                                        No updates needed
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Anonymous Option -->
                        <div class="flex items-start">
                            <input type="checkbox" id="anonymous" name="anonymous" value="1"
                                   <?= (isset($old['anonymous']) && $old['anonymous']) ? 'checked' : '' ?>
                                   class="mt-1 mr-3 text-orange-500 focus:ring-orange-500">
                            <div>
                                <label for="anonymous" class="text-sm font-medium text-gray-700 cursor-pointer">
                                    Submit this report anonymously
                                </label>
                                <p class="text-sm text-gray-500 mt-1">
                                    Your identity will be hidden from the reported user, but we may still contact you for clarification.
                                </p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit" 
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-flag mr-2"></i>
                                Submit Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Information -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- What Happens Next -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        What Happens Next?
                    </h3>
                    <div class="space-y-4 text-sm text-gray-600">
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5 flex-shrink-0">1</div>
                            <p>Your report is received and assigned a unique ticket number.</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5 flex-shrink-0">2</div>
                            <p>Our moderation team reviews your report within 24 hours.</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5 flex-shrink-0">3</div>
                            <p>We investigate and take appropriate action if needed.</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5 flex-shrink-0">4</div>
                            <p>You receive an email update about the resolution (if requested).</p>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-red-800 mb-3 flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                        Emergency?
                    </h3>
                    <p class="text-sm text-red-700 mb-4">
                        If you're in immediate danger or experiencing a medical emergency, 
                        please contact local emergency services immediately.
                    </p>
                    <div class="space-y-2 text-sm">
                        <p><strong>Emergency:</strong> 911 (US) / 112 (EU)</p>
                        <p><strong>Crisis Hotline:</strong> 988 (US)</p>
                    </div>
                </div>

                <!-- Community Guidelines -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-book text-green-500 mr-2"></i>
                        Community Guidelines
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Familiarize yourself with our community standards to help maintain a positive environment.
                    </p>
                    <a href="/community-guidelines" class="text-orange-500 hover:text-orange-600 text-sm font-medium inline-flex items-center">
                        Read Guidelines
                        <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                    </a>
                </div>

                <!-- Contact Support -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-headset text-purple-500 mr-2"></i>
                        Need Help?
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        For non-urgent questions or technical support, you can also contact us directly.
                    </p>
                    <a href="/contact" class="text-orange-500 hover:text-orange-600 text-sm font-medium inline-flex items-center">
                        Contact Support
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php loadPartial('footer') ?>

    <script>
        // Character counter for description
        document.addEventListener('DOMContentLoaded', function() {
            const descriptionTextarea = document.getElementById('description');
            const descriptionCounter = document.getElementById('descriptionCounter');
            
            if (descriptionTextarea && descriptionCounter) {
                function updateCounter() {
                    const length = descriptionTextarea.value.length;
                    descriptionCounter.textContent = `${length}/2000`;
                    descriptionCounter.className = length > 1800 ? 'text-sm text-red-500' : 'text-sm text-gray-400';
                }
                
                descriptionTextarea.addEventListener('input', updateCounter);
                updateCounter(); // Initial count
            }
        });

        // File upload handling
        function handleFileUpload(input) {
            const fileList = document.getElementById('file-list');
            const files = Array.from(input.files);
            
            fileList.innerHTML = '';
            
            files.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 rounded border';
                
                const fileInfo = document.createElement('div');
                fileInfo.className = 'flex items-center';
                fileInfo.innerHTML = `
                    <i class="fas fa-file text-gray-400 mr-2"></i>
                    <span class="text-sm text-gray-700">${file.name}</span>
                    <span class="text-xs text-gray-500 ml-2">(${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
                `;
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'text-red-500 hover:text-red-700 text-sm';
                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                removeBtn.onclick = () => {
                    fileItem.remove();
                    // Remove file from input (this is tricky with HTML file inputs)
                    const dt = new DataTransfer();
                    const updatedFiles = Array.from(input.files).filter((_, i) => i !== index);
                    updatedFiles.forEach(f => dt.items.add(f));
                    input.files = dt.files;
                };
                
                fileItem.appendChild(fileInfo);
                fileItem.appendChild(removeBtn);
                fileList.appendChild(fileItem);
            });
        }

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const reportType = document.getElementById('report_type').value;
            const reportedContent = document.getElementById('reported_content').value;
            const description = document.getElementById('description').value;
            const email = document.getElementById('contact_email').value;
            
            if (!reportType || !reportedContent || !description.trim() || !email) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return;
            }
            
            if (description.length < 20) {
                e.preventDefault();
                alert('Please provide a more detailed description (at least 20 characters).');
                return;
            }
        });
    </script>
</body>
</html>