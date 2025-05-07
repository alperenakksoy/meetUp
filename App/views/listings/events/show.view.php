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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Event Main Section -->
        <div class="md:col-span-2 bg-white rounded-lg shadow overflow-hidden">
            <!-- Event Header with Cover Image -->
            <div class="relative">
                <img src="CreateEventForm/event_image.webp" alt="Event Cover Image" class="w-full h-[300px] object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-5 text-white">
                    <span class="inline-block bg-[#f5a623] text-white px-3 py-1 rounded-full text-sm mb-2.5">Coffee & Cultural</span>
                    <h1 class="text-3xl font-bold mb-2.5"><?= $event->title ?></h1>
                    <div class="flex flex-wrap gap-4 text-sm">
                        <span><i class="far fa-calendar mr-1"></i><?= reDate($event->event_date); ?></span>
                        <span><i class="far fa-clock mr-1"></i><?= reTime($event->start_time);?> : 
                        <?= reTime($event->end_time);?></span>
                        <span><i class="fas fa-map-marker-alt mr-1"></i> <?= $event->location_address ?>, <?= $event->city ?> / <?= $event->country?></span>
                    </div>
                    
                </div>
            </div>

            <!-- Event Content -->
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-4">About This Event</h3>
                    <p class="mb-4"><?= $event->description ?></p>
                </div>


                <div class="flex flex-wrap gap-2.5 mt-6">
                    <span class="bg-gray-100 py-1 px-3 rounded-full text-sm">Coffee</span>
                    <span class="bg-gray-100 py-1 px-3 rounded-full text-sm">Cultural</span>
                    <span class="bg-gray-100 py-1 px-3 rounded-full text-sm">Networking</span>
                    <span class="bg-gray-100 py-1 px-3 rounded-full text-sm">Language Exchange</span>
                    <span class="bg-gray-100 py-1 px-3 rounded-full text-sm">Expat</span>
                </div>
            </div>

            <!-- Event Comments -->
            <div class="p-6 border-t border-gray-200">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-semibold">Comments and Questions (8)</h3>
                </div>

                <form class="flex gap-4 mb-6">
                    <textarea class="flex-1 p-3 border border-gray-300 rounded resize-y focus:outline-none focus:border-[#f5a623]" rows="2" placeholder="Ask a question or leave a comment..."></textarea>
                    <button type="submit" class="bg-[#f5a623] text-white px-4 py-2 rounded font-medium hover:bg-[#e5941d]">Post</button>
                </form>

                <div class="space-y-5">
                    <!-- Comment 1 -->
                    <div class="flex gap-4">
                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="User" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex-1 bg-gray-100 p-4 rounded-lg">
                            <div class="font-semibold mb-1">Emma Johnson</div>
                            <div class="mb-2">
                                This sounds great! Will there be vegetarian food options available?
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>2 days ago</span>
                                <div class="flex gap-4">
                                    <a href="#" class="hover:text-[#f5a623]">Reply</a>
                                    <a href="#" class="hover:text-[#f5a623]">Like</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment 2 with Reply -->
                    <div class="flex gap-4">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex-1 bg-gray-100 p-4 rounded-lg">
                            <div class="font-semibold mb-1">Ahmet Alperen Aksoy (Host)</div>
                            <div class="mb-2">
                                Hi Emma! This is primarily a coffee gathering, but the café does offer some small pastries that include vegetarian options. Let me know if you have any other questions!
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>1 day ago</span>
                                <div class="flex gap-4">
                                    <a href="#" class="hover:text-[#f5a623]">Like</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment 3 -->
                    <div class="flex gap-4">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="User" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex-1 bg-gray-100 p-4 rounded-lg">
                            <div class="font-semibold mb-1">David Wilson</div>
                            <div class="mb-2">
                                Is this suitable for someone who doesn't speak Turkish at all?
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>12 hours ago</span>
                                <div class="flex gap-4">
                                    <a href="#" class="hover:text-[#f5a623]">Reply</a>
                                    <a href="#" class="hover:text-[#f5a623]">Like</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Sidebar -->
        <div class="space-y-5">
            <!-- Join Event Card -->
            <div class="bg-white p-5 rounded-lg shadow text-center">
                <span class="block mb-3">
                    <strong>7</strong> people going · <strong>5</strong> spots left
                </span>
                <div class="h-2.5 bg-gray-200 rounded-full mb-3 overflow-hidden">
                    <div class="bg-[#f5a623] h-full w-[60%]"></div>
                </div>
                <button class="w-full bg-[#f5a623] text-white py-3 px-5 rounded font-medium hover:bg-[#e5941d]">Join Event</button>
            </div>

            <!-- Host Information -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-100">Host</h3>
                <div class="flex items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Host" class="w-15 h-15 rounded-full object-cover border-4 border-[#f5a623] mr-4">
                    <div>
                        <div class="font-semibold mb-1">Ahmet Alperen Aksoy</div>
                        <div class="text-sm text-gray-600">
                            <div class="mb-1"><i class="fas fa-map-marker-alt mr-2 text-[#f5a623]"></i> Istanbul, Turkey</div>
                            <div><i class="fas fa-calendar-check mr-2 text-[#f5a623]"></i> 24 events hosted</div>
                        </div>
                    </div>
                </div>
                <a href="profile.php?id=123" class="block text-center py-2 border border-[#f5a623] text-[#f5a623] rounded hover:bg-[#f5a623] hover:text-white transition-colors">View Profile</a>
            </div>

            <!-- Attendees -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-100">Attendees (7)</h3>
                <div class="flex flex-wrap mb-4">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Attendee" class="w-11 h-11 rounded-full object-cover border-2 border-white -ml-2 first:ml-0">
                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Attendee" class="w-11 h-11 rounded-full object-cover border-2 border-white -ml-2">
                    <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Attendee" class="w-11 h-11 rounded-full object-cover border-2 border-white -ml-2">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Attendee" class="w-11 h-11 rounded-full object-cover border-2 border-white -ml-2">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Attendee" class="w-11 h-11 rounded-full object-cover border-2 border-white -ml-2">
                    <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Attendee" class="w-11 h-11 rounded-full object-cover border-2 border-white -ml-2">
                    <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Attendee" class="w-11 h-11 rounded-full object-cover border-2 border-white -ml-2">
                </div>
                <a href="#" class="block text-center py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200">View All Attendees</a>
            </div>

    <!-- Share & Save -->
<div class="bg-white p-5 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-100">Share & Save</h3>
    <div class="flex gap-2.5 mb-4">
        <a href="#" class="flex-1 flex items-center justify-center gap-2 border border-[#f5a623] text-[#f5a623] py-2 px-4 rounded hover:bg-[#f5a623] hover:text-white transition-colors">
            <i class="fas fa-share-alt"></i> Share
        </a>
        <a href="#" class="flex-1 flex items-center justify-center gap-2 border border-[#f5a623] text-[#f5a623] py-2 px-4 rounded hover:bg-[#f5a623] hover:text-white transition-colors">
            <i class="far fa-bookmark"></i> Save
        </a>
    </div>
    
    <!-- Delete Form -->
    <form method="POST" class="mb-4">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded flex items-center justify-center gap-2">
            <i class="fas fa-trash-alt"></i> Delete Event
        </button>
    </form>
    <!-- End Delete Form -->
    
    <a href="#" class="block text-center border border-[#f5a623] text-[#f5a623] py-2 px-4 rounded hover:bg-[#f5a623] hover:text-white transition-colors">
        <i class="fas fa-exclamation-circle mr-1"></i> Report Event
    </a>
</div>

            <!-- Similar Events -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-100">Similar Events</h3>
                <div class="space-y-4">
                    <div class="flex gap-2.5">
                        <img src="/api/placeholder/60/60" alt="Event" class="w-15 h-15 object-cover rounded">
                        <div>
                            <div class="font-semibold mb-1">Language Exchange Meetup</div>
                            <div class="text-sm text-gray-600">Apr 15, 2025 • Şişli</div>
                        </div>
                    </div>
                    <div class="flex gap-2.5">
                        <img src="/api/placeholder/60/60" alt="Event" class="w-15 h-15 object-cover rounded">
                        <div>
                            <div class="font-semibold mb-1">Discover Turkish Coffee</div>
                            <div class="text-sm text-gray-600">Apr 10, 2025 • Beşiktaş</div>
                        </div>
                    </div>
                    <div class="flex gap-2.5">
                        <img src="/api/placeholder/60/60" alt="Event" class="w-15 h-15 object-cover rounded">
                        <div>
                            <div class="font-semibold mb-1">Expat Networking Brunch</div>
                            <div class="text-sm text-gray-600">Apr 18, 2025 • Taksim</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        // Join Event functionality
        document.querySelector('.join-btn').addEventListener('click', function() {
            if (this.textContent === 'Join Event') {
                this.textContent = 'Leave Event';
                this.style.backgroundColor = '#e74c3c';
                
                // Update attendees count
                const countElement = document.querySelector('.attendees-count');
                const currentCount = parseInt(countElement.querySelector('strong').textContent);
                countElement.innerHTML = `<strong>${currentCount + 1}</strong> people going · <strong>${12 - (currentCount + 1)}</strong> spots left`;
                
                // Update progress bar
                const progressBar = document.querySelector('.progress-bar');
                const newWidth = ((currentCount + 1) / 12) * 100;
                progressBar.style.width = `${newWidth}%`;
                
                // Add user to attendees (this would typically be an AJAX call)
                const attendeesPreview = document.querySelector('.attendees-preview');
                const currentUserAvatar = document.querySelector('.user-menu img').src;
                
                // Create a new image element for the current user
                const newAttendee = document.createElement('img');
                newAttendee.src = currentUserAvatar;
                newAttendee.alt = 'You';
                newAttendee.className = 'attendee-avatar';
                
                // Add it to the attendees preview
                attendeesPreview.appendChild(newAttendee);
            } else {
                this.textContent = 'Join Event';
                this.style.backgroundColor = '#f5a623';
                
                // Update attendees count
                const countElement = document.querySelector('.attendees-count');
                const currentCount = parseInt(countElement.querySelector('strong').textContent);
                countElement.innerHTML = `<strong>${currentCount - 1}</strong> people going · <strong>${12 - (currentCount - 1)}</strong> spots left`;
                
                // Update progress bar
                const progressBar = document.querySelector('.progress-bar');
                const newWidth = ((currentCount - 1) / 12) * 100;
                progressBar.style.width = `${newWidth}%`;
                
                // Remove the last added attendee
                const attendeesPreview = document.querySelector('.attendees-preview');
                attendeesPreview.removeChild(attendeesPreview.lastChild);
            }
        });

        // Comment form submission
        document.querySelector('.comment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const commentInput = this.querySelector('.comment-input');
            const commentText = commentInput.value.trim();
            
            if (commentText) {
                // Create a new comment element
                const commentList = document.querySelector('.comment-list');
                const currentUserAvatar = document.querySelector('.user-menu img').src;
                
                const newComment = document.createElement('div');
                newComment.className = 'comment-item';
                newComment.innerHTML = `
                    <img src="${currentUserAvatar}" alt="You" class="comment-avatar">
                    <div class="comment-content">
                        <div class="comment-author">You</div>
                        <div class="comment-text">
                            ${commentText}
                        </div>
                        <div class="comment-meta">
                            <span>Just now</span>
                            <div class="comment-actions">
                                <a href="#" class="comment-action">Delete</a>
                                <a href="#" class="comment-action">Edit</a>
                            </div>
                        </div>
                    </div>
                `;
                
                // Add the new comment to the top of the list
                commentList.insertBefore(newComment, commentList.firstChild);
                
                // Clear the input
                commentInput.value = '';
                
                // Update the comment count
                const commentsHeader = document.querySelector('.comments-header h3');
                const currentCount = parseInt(commentsHeader.textContent.match(/\d+/)[0]);
                commentsHeader.textContent = `Comments and Questions (${currentCount + 1})`;
            }
        });
    </script>
      <?=loadPartial('scripts'); ?>
    <?=loadPartial(name: 'footer'); ?>
</body>
</html>
