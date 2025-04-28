<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('header') ?>
    
    <!-- Main Content -->
<div class="container max-w-6xl mx-auto px-5 mt-20">
    <!-- Breadcrumbs -->
    <div class="flex gap-1 text-sm text-gray-600 my-3">
        <a href="events.php" class="text-[#f5a623] hover:underline">Events</a>
        <span class="separator">&gt;</span>
        <a href="event_management.php" class="text-[#f5a623] hover:underline">Event Management</a>
        <span class="separator">&gt;</span>
        <a href="event_details.php?id=1" class="text-[#f5a623] hover:underline">Bosphorus Sunset Cruise</a>
        <span class="separator">&gt;</span>
        <span>Reviews</span>
    </div>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="font-volkhov text-4xl text-[#2c3e50]">Event Reviews</h1>
        <a href="event_details.php?id=1" class="bg-white text-gray-700 border border-gray-300 py-2.5 px-4 rounded no-underline hover:bg-gray-100 flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to Event
        </a>
    </div>

    <!-- Reviews Container -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Reviews Content -->
        <div class="md:col-span-2">
            <!-- Event Overview -->
            <div class="bg-white rounded-lg shadow p-5 flex gap-5 mb-5">
                <img src="/api/placeholder/150/100" alt="Event" class="w-[150px] h-[100px] object-cover rounded">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold mb-2">Bosphorus Sunset Cruise</h2>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                        <span><i class="far fa-calendar mr-1"></i> Mar 18, 2025</span>
                        <span><i class="far fa-clock mr-1"></i> 17:30 - 20:30</span>
                        <span><i class="fas fa-map-marker-alt mr-1"></i> Eminönü, Istanbul</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-[70px] h-[70px] bg-[#f5a623] text-white rounded-full flex items-center justify-center text-2xl font-bold mr-5">4.8</div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-600 mb-2">Rated 4.8 out of 5 based on 12 reviews</div>
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-20 flex items-center text-sm"><i class="fas fa-star text-[#f5a623] mr-1"></i> 5</div>
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-[#f5a623] h-full w-[80%]"></div>
                                    </div>
                                    <div class="w-7 text-sm text-gray-600 text-right">10</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-20 flex items-center text-sm"><i class="fas fa-star text-[#f5a623] mr-1"></i> 4</div>
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-[#f5a623] h-full w-[16%]"></div>
                                    </div>
                                    <div class="w-7 text-sm text-gray-600 text-right">2</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-20 flex items-center text-sm"><i class="fas fa-star text-[#f5a623] mr-1"></i> 3</div>
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-[#f5a623] h-full w-0"></div>
                                    </div>
                                    <div class="w-7 text-sm text-gray-600 text-right">0</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-20 flex items-center text-sm"><i class="fas fa-star text-[#f5a623] mr-1"></i> 2</div>
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-[#f5a623] h-full w-0"></div>
                                    </div>
                                    <div class="w-7 text-sm text-gray-600 text-right">0</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-20 flex items-center text-sm"><i class="fas fa-star text-[#f5a623] mr-1"></i> 1</div>
                                    <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-[#f5a623] h-full w-0"></div>
                                    </div>
                                    <div class="w-7 text-sm text-gray-600 text-right">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="flex justify-between items-center p-5 border-b border-gray-200">
                    <h2 class="text-xl font-semibold">Reviews (12)</h2>
                    <div class="flex items-center gap-2 text-sm">
                        <span>Sort by:</span>
                        <select class="border border-gray-300 rounded py-1 px-2">
                            <option value="recent">Most Recent</option>
                            <option value="helpful">Most Helpful</option>
                            <option value="highest">Highest Rating</option>
                            <option value="lowest">Lowest Rating</option>
                        </select>
                    </div>
                </div>

                <div class="divide-y divide-gray-200">
                    <!-- Review 1 -->
                    <div class="p-5">
                        <div class="flex gap-4 mb-4">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Reviewer" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-semibold">Emma Johnson</div>
                                <div class="flex justify-between items-center">
                                    <div class="flex text-[#f5a623]">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="text-sm text-gray-600 ml-3">Mar 19, 2025</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 space-y-3">
                            <p>This was an absolutely incredible experience! The sunset views of Istanbul from the Bosphorus were breathtaking. Our host Ahmet was knowledgeable and friendly, pointing out historical landmarks and sharing interesting stories about the city. The traditional Turkish refreshments served on board were delicious too.</p>
                            <p>I especially appreciated how Ahmet made sure everyone felt included and comfortable, even though we were all strangers at the start. By the end of the cruise, we were exchanging contact details and planning to meet up again!</p>
                        </div>
                        <div class="flex gap-2 mb-4">
                            <img src="/api/placeholder/100/100" alt="Review Photo" class="w-24 h-24 object-cover rounded cursor-pointer hover:opacity-90 transition-opacity" onclick="openModal(this.src)">
                            <img src="/api/placeholder/100/100" alt="Review Photo" class="w-24 h-24 object-cover rounded cursor-pointer hover:opacity-90 transition-opacity" onclick="openModal(this.src)">
                            <img src="/api/placeholder/100/100" alt="Review Photo" class="w-24 h-24 object-cover rounded cursor-pointer hover:opacity-90 transition-opacity" onclick="openModal(this.src)">
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-600 mb-4">
                            <div class="flex gap-4">
                                <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                    <i class="far fa-thumbs-up"></i>
                                    <span>Helpful (8)</span>
                                </div>
                                <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                    <i class="far fa-comment"></i>
                                    <span>Reply</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                <i class="fas fa-flag"></i>
                                <span>Report</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="flex justify-between items-center mb-2">
                                <span class="inline-block bg-[#3498db] text-white text-xs font-semibold px-2 py-1 rounded">Host</span>
                                <span class="text-sm text-gray-600">Responded on Mar 20, 2025</span>
                            </div>
                            <p>Thank you so much for your kind words, Emma! I'm thrilled that you enjoyed the sunset cruise and the refreshments. It was a pleasure hosting you and the rest of the group. Looking forward to seeing you at future events!</p>
                        </div>
                    </div>

                    <!-- Review 2 -->
                    <div class="p-5">
                        <div class="flex gap-4 mb-4">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Reviewer" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-semibold">David Wilson</div>
                                <div class="flex justify-between items-center">
                                    <div class="flex text-[#f5a623]">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="text-sm text-gray-600 ml-3">Mar 19, 2025</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 space-y-3">
                            <p>As a photography enthusiast, this cruise offered some of the best photo opportunities I've had in Istanbul. The golden hour light on the cityscape was perfect, and Ahmet knew exactly where to position the boat for the best shots of Hagia Sophia and the Blue Mosque.</p>
                            <p>Beyond the views, I really appreciated the small group size which allowed for genuine conversations. Made some great connections with fellow travelers and locals alike. Highly recommended!</p>
                        </div>
                        <div class="flex gap-2 mb-4">
                            <img src="/api/placeholder/100/100" alt="Review Photo" class="w-24 h-24 object-cover rounded cursor-pointer hover:opacity-90 transition-opacity" onclick="openModal(this.src)">
                            <img src="/api/placeholder/100/100" alt="Review Photo" class="w-24 h-24 object-cover rounded cursor-pointer hover:opacity-90 transition-opacity" onclick="openModal(this.src)">
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-600 mb-4">
                            <div class="flex gap-4">
                                <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                    <i class="far fa-thumbs-up"></i>
                                    <span>Helpful (5)</span>
                                </div>
                                <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                    <i class="far fa-comment"></i>
                                    <span>Reply</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                <i class="fas fa-flag"></i>
                                <span>Report</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="flex justify-between items-center mb-2">
                                <span class="inline-block bg-[#3498db] text-white text-xs font-semibold px-2 py-1 rounded">Host</span>
                                <span class="text-sm text-gray-600">Responded on Mar 20, 2025</span>
                            </div>
                            <p>Thank you for your review, David! I'm so glad you got some great photos during our cruise. Your shots of the sunset over the Bosphorus Bridge were amazing! Hope to see you at another event soon.</p>
                        </div>
                    </div>

                    <!-- Review 3 -->
                    <div class="p-5">
                        <div class="flex gap-4 mb-4">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Reviewer" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-semibold">Olivia Martinez</div>
                                <div class="flex justify-between items-center">
                                    <div class="flex text-[#f5a623]">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <div class="text-sm text-gray-600 ml-3">Mar 18, 2025</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 space-y-3">
                            <p>The cruise was beautiful and Ahmet is a fantastic host. Very knowledgeable about Istanbul's history and architecture. The only reason I'm giving 4 stars instead of 5 is that it was a bit chilly on the water and I wish I had known to bring a warmer jacket. That said, Ahmet did offer blankets which was thoughtful.</p>
                            <p>The Turkish tea and baklava served were delicious and a perfect way to end the evening. Would definitely recommend this experience, just remember to dress warmly if you're going in the evening!</p>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-600 mb-4">
                            <div class="flex gap-4">
                                <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                    <i class="far fa-thumbs-up"></i>
                                    <span>Helpful (3)</span>
                                </div>
                                <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                    <i class="far fa-comment"></i>
                                    <span>Reply</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                <i class="fas fa-flag"></i>
                                <span>Report</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="flex justify-between items-center mb-2">
                                <span class="inline-block bg-[#3498db] text-white text-xs font-semibold px-2 py-1 rounded">Host</span>
                                <span class="text-sm text-gray-600">Responded on Mar 19, 2025</span>
                            </div>
                            <p>Thank you for your feedback, Olivia! You're absolutely right about the evening chill on the water, and I appreciate the suggestion. I'll make sure to include a note about bringing warm clothing in the event description for future cruises. I'm glad you enjoyed the tea and baklava despite the cooler temperatures!</p>
                        </div>
                    </div>

                    <!-- More reviews would go here -->
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-5">
            <!-- Add Review -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Write a Review</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block mb-2 font-medium text-sm">Your Rating</label>
                        <div class="flex gap-1 text-xl">
                            <i class="far fa-star cursor-pointer hover:text-[#f5a623]" data-rating="1"></i>
                            <i class="far fa-star cursor-pointer hover:text-[#f5a623]" data-rating="2"></i>
                            <i class="far fa-star cursor-pointer hover:text-[#f5a623]" data-rating="3"></i>
                            <i class="far fa-star cursor-pointer hover:text-[#f5a623]" data-rating="4"></i>
                            <i class="far fa-star cursor-pointer hover:text-[#f5a623]" data-rating="5"></i>
                        </div>
                    </div>
                    <textarea class="w-full p-3 border border-gray-300 rounded resize-y min-h-[120px] focus:outline-none focus:border-[#f5a623]" placeholder="Share your experience... What did you like? What could be improved?"></textarea>
                    <div>
                        <label class="block mb-2 font-medium text-sm">Add Photos (Optional)</label>
                        <div class="bg-gray-100 border border-dashed border-gray-300 p-3 rounded flex flex-col items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors">
                            <i class="fas fa-camera mb-1"></i>
                            <span>Upload Photos</span>
                            <input type="file" id="photo-input" class="hidden" multiple accept="image/*">
                        </div>
                        <div class="photo-preview flex flex-wrap gap-2 mt-2">
                            <!-- Preview images will be added here dynamically -->
                        </div>
                    </div>
                    <button class="w-full bg-[#f5a623] text-white py-3 rounded font-medium hover:bg-[#e5941d] transition-colors">Submit Review</button>
                </div>
            </div>

            <!-- Review Stats -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Event Highlights</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-[#f5a623] mr-4">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-lg">18/25</div>
                            <div class="text-sm text-gray-600">Attendance Rate</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-[#f5a623] mr-4">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-lg">8</div>
                            <div class="text-sm text-gray-600">New Connections Made</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-[#f5a623] mr-4">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-lg">12</div>
                            <div class="text-sm text-gray-600">Reviews Received</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Mentions -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Most Mentioned</h3>
                <div class="flex flex-wrap gap-2">
                    <div class="bg-gray-100 py-2 px-4 rounded-full text-sm flex items-center">
                        <i class="fas fa-thumbs-up text-[#f5a623] mr-1"></i> Amazing views
                    </div>
                    <div class="bg-gray-100 py-2 px-4 rounded-full text-sm flex items-center">
                        <i class="fas fa-thumbs-up text-[#f5a623] mr-1"></i> Friendly host
                    </div>
                    <div class="bg-gray-100 py-2 px-4 rounded-full text-sm flex items-center">
                        <i class="fas fa-thumbs-up text-[#f5a623] mr-1"></i> Delicious food
                    </div>
                    <div class="bg-gray-100 py-2 px-4 rounded-full text-sm flex items-center">
                        <i class="fas fa-thumbs-up text-[#f5a623] mr-1"></i> Great photos
                    </div>
                    <div class="bg-gray-100 py-2 px-4 rounded-full text-sm flex items-center">
                        <i class="fas fa-thumbs-down text-[#e74c3c] mr-1"></i> Cold at night
                    </div>
                </div>
            </div>

            <!-- Similar Events -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-100">Similar Events</h3>
                <div class="space-y-4">
                    <div class="flex gap-2.5">
                        <img src="/api/placeholder/60/60" alt="Event" class="w-15 h-15 object-cover rounded">
                        <div>
                            <div class="font-semibold mb-1">Evening Boat Tour & Dinner Cruise</div>
                            <div class="text-sm text-gray-600">Apr 15, 2025 • Eminönü</div>
                        </div>
                    </div>
                    <div class="flex gap-2.5">
                        <img src="/api/placeholder/60/60" alt="Event" class="w-15 h-15 object-cover rounded">
                        <div>
                            <div class="font-semibold mb-1">Photography Walk: Golden Hour in Istanbul</div>
                            <div class="text-sm text-gray-600">Apr 10, 2025 • Sultanahmet</div>
                        </div>
                    </div>
                    <div class="flex gap-2.5">
                        <img src="/api/placeholder/60/60" alt="Event" class="w-15 h-15 object-cover rounded">
                        <div>
                            <div class="font-semibold mb-1">Sunset Rooftop Social</div>
                            <div class="text-sm text-gray-600">Apr 18, 2025 • Beyoğlu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Photo Modal -->
<div class="fixed inset-0 bg-black/80 z-50 hidden justify-center items-center" id="photoModal">
    <div class="relative bg-white rounded-lg max-w-4xl max-h-[90vh] w-auto">
        <span class="absolute top-2 right-3 text-3xl text-white cursor-pointer z-10" onclick="closeModal()">&times;</span>
        <img id="modalImage" src="" alt="Full size photo" class="max-w-full max-h-[90vh] rounded-lg">
    </div>
</div>

<script>
 
</script>
    <script>
        // Star Rating Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating i');
            let selectedRating = 0;
            
            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const rating = this.getAttribute('data-rating');
                    
                    // Reset all stars
                    stars.forEach(s => {
                        s.className = 'far fa-star';
                    });
                    
                    // Fill stars up to the hovered one
                    for (let i = 0; i < rating; i++) {
                        stars[i].className = 'fas fa-star';
                    }
                });
                
                star.addEventListener('mouseout', function() {
                    // Reset stars when not hovering
                    stars.forEach(s => {
                        s.className = 'far fa-star';
                    });
                    
                    // Keep selected rating filled
                    for (let i = 0; i < selectedRating; i++) {
                        stars[i].className = 'fas fa-star';
                    }
                });
                
                star.addEventListener('click', function() {
                    selectedRating = this.getAttribute('data-rating');
                    
                    // Update selected stars
                    stars.forEach(s => {
                        s.className = 'far fa-star';
                    });
                    
                    for (let i = 0; i < selectedRating; i++) {
                        stars[i].className = 'fas fa-star';
                        stars[i].classList.add('active');
                    }
                });
            });
        });

        // Photo Upload
        document.addEventListener('DOMContentLoaded', function() {
            const uploadBtn = document.querySelector('.upload-btn');
            const photoInput = document.getElementById('photo-input');
            const photoPreview = document.querySelector('.photo-preview');
            
            uploadBtn.addEventListener('click', function() {
                photoInput.click();
            });
            
            photoInput.addEventListener('change', function() {
                const files = this.files;
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <div class="remove-photo">&times;</div>
                        `;
                        
                        photoPreview.appendChild(previewItem);
                        
                        // Add remove functionality
                        previewItem.querySelector('.remove-photo').addEventListener('click', function() {
                            previewItem.remove();
                        });
                    };
                    
                    reader.readAsDataURL(file);
                }
            });
        });

        // Form Submission
        document.querySelector('.submit-review').addEventListener('click', function() {
            const rating = document.querySelectorAll('.star-rating i.active').length;
            const reviewText = document.querySelector('.review-textarea').value.trim();
            
            if (rating === 0) {
                alert('Please select a rating');
                return;
            }
            
            if (reviewText === '') {
                alert('Please write a review');
                return;
            }
            
            // Simulate form submission
            alert('Thank you for your review! It will be posted after moderation.');
            
            // Reset form
            document.querySelector('.review-textarea').value = '';
            document.querySelectorAll('.star-rating i').forEach(star => {
                star.className = 'far fa-star';
                star.classList.remove('active');
            });
            document.querySelector('.photo-preview').innerHTML = '';
        });

        // Photo Modal
        function openModal(src) {
        const modal = document.getElementById('photoModal');
        const modalImg = document.getElementById('modalImage');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modalImg.src = src;
    }
    
    function closeModal() {
        const modal = document.getElementById('photoModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

        // Helpful button functionality
        document.querySelectorAll('.review-action').forEach(action => {
            if (action.querySelector('.fa-thumbs-up')) {
                action.addEventListener('click', function() {
                    const helpfulText = this.querySelector('span');
                    const currentCount = parseInt(helpfulText.textContent.match(/\d+/)[0]);
                    
                    if (this.classList.contains('active')) {
                        helpfulText.textContent = `Helpful (${currentCount - 1})`;
                        this.classList.remove('active');
                    } else {
                        helpfulText.textContent = `Helpful (${currentCount + 1})`;
                        this.classList.add('active');
                    }
                });
            }
        });
    </script>
    <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>
