<?php require_once __DIR__ . '/../../../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>

<body class="font-sans text-gray-800 bg-lightbg">
 <!-- Header -->
 <?=loadWelcomePartial('headerWl'); ?>
    
    <!-- Report Section -->
    <section class="py-20 bg-lightbg min-h-[calc(100vh-60px)] mt-[60px]">
        <div class="max-w-2xl mx-auto px-5">
            <div class="bg-white rounded-xl shadow-lg p-10">
                <div class="mb-5">
                    <a href="safety.php">
                        <button class="py-2.5 px-5 bg-gray-200 hover:bg-primary hover:text-white transition-colors duration-300 rounded">Go Back</button>
                    </a>
                </div>
                <div class="text-center mb-10">
                    <h1 class="text-2xl md:text-4xl text-[#2c2c54] mb-4 font-volkhov font-bold">Report a User</h1>
                    <p class="text-gray-600 text-lg">Help us maintain a safe community by reporting inappropriate behavior</p>
                </div>

                <form class="max-w-xl mx-auto">
                    <div class="mb-6">
                        <label for="reported-username" class="block mb-2 text-[#2c2c54] font-medium">Username of Reported User*</label>
                        <input 
                            type="text" 
                            id="reported-username" 
                            required 
                            placeholder="Enter username"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg text-base text-gray-800 transition-all focus:outline-none focus:border-primary"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="report-type" class="block mb-2 text-[#2c2c54] font-medium">Type of Report*</label>
                        <select 
                            id="report-type" 
                            required
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg text-base text-gray-800 transition-all focus:outline-none focus:border-primary"
                        >
                            <option value="">Select a reason</option>
                            <option value="harassment">Harassment or Bullying</option>
                            <option value="inappropriate">Inappropriate Behavior</option>
                            <option value="fake">Fake Profile</option>
                            <option value="spam">Spam or Scam</option>
                            <option value="hate">Hate Speech</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="event-date" class="block mb-2 text-[#2c2c54] font-medium">Date of Incident*</label>
                        <input 
                            type="date" 
                            id="event-date" 
                            required
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg text-base text-gray-800 transition-all focus:outline-none focus:border-primary"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="event-location" class="block mb-2 text-[#2c2c54] font-medium">Event or Chat where it happened*</label>
                        <input 
                            type="text" 
                            id="event-location" 
                            required 
                            placeholder="Event name or chat"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg text-base text-gray-800 transition-all focus:outline-none focus:border-primary"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-[#2c2c54] font-medium">Detailed Description*</label>
                        <textarea 
                            id="description" 
                            required 
                            placeholder="Please provide specific details about what happened"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg text-base text-gray-800 transition-all focus:outline-none focus:border-primary h-[150px] resize-y"
                        ></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="evidence" class="block mb-2 text-[#2c2c54] font-medium">Evidence (Optional)</label>
                        <input 
                            type="file" 
                            id="evidence" 
                            accept="image/*"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg text-base text-gray-800 transition-all focus:outline-none focus:border-primary"
                        >
                        <small class="block mt-1 text-gray-600 text-sm">You can upload screenshots or other relevant images</small>
                    </div>

                    <div class="mb-6 flex items-center gap-2.5">
                        <input 
                            type="checkbox" 
                            id="terms" 
                            required
                            class="w-4 h-4"
                        >
                        <label for="terms" class="text-base text-gray-700">I confirm this report is truthful and accurate</label>
                    </div>

                    <div class="mb-6">
                        <button 
                            type="submit" 
                            class="w-full py-4 bg-primary text-white border-none rounded-lg text-lg font-semibold cursor-pointer transition-all duration-300 hover:bg-[#e5941d]"
                        >Submit Report</button>
                    </div>

                    <p class="text-center text-gray-600 text-sm leading-relaxed">
                        Our team will review your report and take appropriate action within 24 hours.
                        For immediate assistance, please contact emergency services.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <?=loadWelcomePartial('footerWl'); ?>

</body>
</html>