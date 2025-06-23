<?php

// Set page variables
$pageTitle = 'Dashboard';
$activePage = 'events';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>
    
    <!-- Main Content -->
<div class="container max-w-6xl mx-auto px-5 mt-20">
    <!-- Breadcrumbs -->
    <div class="flex gap-1 text-sm text-gray-600 my-3">
        <a href="events.php" class="text-[#f5a623] hover:underline">Events</a>
        <span class="separator">&gt;</span>
        <a href="event_management.php" class="text-[#f5a623] hover:underline">Event Management</a>
        <span class="separator">&gt;</span>
        <a href="event_details.php?id=1" class="text-[#f5a623] hover:underline"><?= $event->title ?></a>
        <span class="separator">&gt;</span>
        <span>Reviews</span>
    </div>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-5">
        <h1 class="font-volkhov text-4xl text-[#2c3e50]">Event Reviews</h1>
        <a href="/events/past" class="bg-white text-gray-700 border border-gray-300 py-2.5 px-4 rounded no-underline hover:bg-gray-100 flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to Past Events
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

                    <h2 class="text-xl font-semibold mb-2"><?= $event->title ?></h2>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                        <span><i class="far fa-calendar mr-1"></i><?= reDate($event->event_date) ?></span>
                        <span><i class="far fa-clock mr-1"></i> <?= reTime($event->start_time) ?> - <?= reTime($event->end_time) ?></span>
                        <span><i class="fas fa-map-marker-alt mr-1"></i><?= $event->location_name ?>, <?= $event->city?>/<?= $event->country ?></span>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-[70px] h-[70px] bg-[#f5a623] text-white rounded-full flex items-center justify-center text-2xl font-bold mr-5"><?=number_format($averageRating, 1)?></div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-600 mb-2">Rated <?=number_format($averageRating, 1)?> out of 5 based on <?=$totalReviews?> reviews</div>
                            <div class="space-y-1">
                    <?php for($i = 5; $i >= 1; $i--): ?>
                        <div class="flex items-center gap-2">
                            <div class="w-20 flex items-center text-sm"><i class="fas fa-star text-[#f5a623] mr-1"></i> <?= $i ?></div>
                            <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div class="bg-[#f5a623] h-full" style="width: <?= $totalReviews > 0 ? ($ratingCounts[$i] / $totalReviews) * 100 : 0 ?>%"></div>
                            </div>
                            <div class="w-7 text-sm text-gray-600 text-right"><?= $ratingCounts[$i] ?></div>
                        </div>
                    <?php endfor; ?>

                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="flex justify-between items-center p-5 border-b border-gray-200">
                    <h2 class="text-xl font-semibold">Reviews (<?=$totalReviews?>)</h2>
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

            <?php if($totalReviews>0):?>
                <?php foreach($reviews as $review):?>
                    <!-- Review 1 -->
                    <div class="p-5">
                        <div class="flex gap-4 mb-4">
                            <img src="<?=getUserProfilePictureReviewer($review)?>" alt="Reviewer" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-semibold"><?=$review->reviewer_first_name?> <?=$review->reviewer_last_name?></div>
                                <div class="flex justify-between items-center">
                                    <div class="flex text-[#f5a623]">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $review->rating): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    </div>
                                    <div class="text-sm text-gray-600 ml-3"><?=reDate($review->created_at)?></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 space-y-3">
                            <p><?=$review->content?></p>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-600 mb-4">
                            <div class="flex gap-4">
                                <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                    <i class="far fa-thumbs-up"></i>
                                    <span>Helpful</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 cursor-pointer hover:text-[#f5a623]">
                                <i class="fas fa-flag"></i>
                                <span>Report</span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <?php else: ?>
            <div class="p-5 text-center text-gray-500">
                <p>No reviews yet for this event.</p>
            </div>
        <?php endif; ?>
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
                    <button class="w-full bg-[#f5a623] text-white py-3 rounded font-medium hover:bg-[#e5941d] transition-colors">Submit Review</button>
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
