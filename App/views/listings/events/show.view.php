<a?php

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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Event Main Section -->
        <div class="md:col-span-2 bg-white rounded-lg shadow overflow-hidden">
            <!-- Event Header with Cover Image -->
            <div class="relative">
    <img src="<?= getEventImage($event) ?>" 
         alt="<?= htmlspecialchars($event->title) ?>" 
         class="w-full h-[300px] object-cover">
    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-5 text-white">
        <span class="inline-block <?= getCategoryColor($event->category) ?> text-white px-3 py-1 rounded-full text-sm mb-2.5 flex items-center gap-1 w-fit">
            <i class="<?= getCategoryIcon($event->category) ?>"></i>
            <?= ucfirst($event->category ?? 'Event') ?>
        </span>
        <h1 class="text-3xl font-bold mb-2.5"><?= $event->title ?></h1>
        <div class="flex flex-wrap gap-4 text-sm">
            <span><i class="far fa-calendar mr-1"></i><?= reDate($event->event_date); ?></span>
            <span><i class="far fa-clock mr-1"></i><?= reTime($event->start_time);?> - 
            <?= reTime($event->end_time);?></span>
            <span><i class="fas fa-map-marker-alt mr-1"></i> <?= htmlspecialchars($event->location_address) ?>, <?= htmlspecialchars($event->city) ?> / <?= htmlspecialchars($event->country)?></span>
        </div>
    </div>
</div>
            <?=loadPartial('message')?>


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
                    <h3 class="text-xl font-semibold">Comments and Questions (<?=count($eventComments) ?? 0 ?>)</h3>
                </div>

                <form class="flex gap-4 mb-6">
                    <textarea class="flex-1 p-3 border border-gray-300 rounded resize-y focus:outline-none focus:border-[#f5a623]" rows="2" placeholder="Ask a question or leave a comment..."></textarea>
                    <button type="submit" class="bg-[#f5a623] text-white px-4 py-2 rounded font-medium hover:bg-[#e5941d]">Post</button>
                </form>

                <div class="space-y-5">
                    <!-- Comment 1 -->
                    <?php foreach($eventComments as $comment):?> 
                    <div class="flex gap-4">
                        <img src="<?=$comment->profile_picture ?? 'default.png'?>" alt="User" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex-1 bg-gray-100 p-4 rounded-lg">
                            <div class="font-semibold mb-1"><?="{$comment->first_name} {$comment->last_name}"?></div>
                            <div class="mb-2">
                                <?=$comment->content?>
                        </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span><?=timeSince($comment->created_at)?></span>
                                <div class="flex gap-4">
                                    <a href="#" class="hover:text-[#f5a623]">Reply</a>
                                    <a href="#" class="hover:text-[#f5a623]">Like</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>

    
                </div>
            </div>
        </div>
        <!-- Event Sidebar -->
        <div class="space-y-5">
            <!-- Join Event Card -->
            <div class="bg-white p-5 rounded-lg shadow text-center">
                <span class="block mb-3">
                   
                    <?php if(count($attendees) == 0):?>
                    <?php $indicator='No one attending at the moment'?>
                    <?php elseif(count($attendees)== 1 && $attendees[0]->user_id == $user->user_id):?>
                    <?php $indicator='Currently only you attending'?>
                    <?php elseif(count($attendees)== 1 && $attendees[0]->user_id  != $user->user_id):?>
                        <?php $indicator='1 person attending'?>
                    <?php else:?>
                        <?php $indicator=count($attendees).' people are attending.'?>
                    <?php endif;?>
                   <?= $indicator ?> · <strong><?= $event->max_attendees - count($attendees);?></strong> spots left
                </span>
                <div class="h-2.5 bg-gray-200 rounded-full mb-3 overflow-hidden">
                    <div class="bg-[#f5a623] h-full w-[<?=count($attendees)*10?>%]"></div>
                </div>
                <?php $attendeesID = array_column($attendees,'user_id');?>
                <?php if(in_array($user->user_id,$attendeesID)):?>
                    <button data-event-id="<?= $event->event_id ?>" data-action="leave" class="w-full bg-[#ef4444] text-white py-3 px-5 rounded font-medium hover:bg-[#dc2626] transition-colors join-btn">Leave The Event</button>         
                    <?php else:?>
                        <button data-event-id="<?= $event->event_id ?>" data-action="join" class="w-full bg-[#145314] text-white py-3 px-5 rounded font-medium hover:bg-[#1e6e1e] join-btn">Join The Event</button>   
                        <?php endif;?>
            </div>

            <!-- Host Information -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-100">Host</h3>
                <div class="flex items-center mb-4">
                <img src="<?=$host->profile_picture?>" alt="Host" class="w-20 h-20 rounded-full object-cover border-4 border-[#f5a623] mr-4">
                    <div>
                        <div class="font-semibold mb-1"><?="{$event->first_name} {$event->last_name}"?></div>
                        <div class="text-sm text-gray-600">
                            <div class="mb-1"><i class="fas fa-map-marker-alt mr-2 text-[#f5a623]"></i><?="{$host->city}, {$host->country}"?></div>
                            <?php if(count($event->hostedEvents) == 0):?>
                                <?php $indicator='This user has not hosted an event yet.'?>
                            <?php elseif(count($event->hostedEvents) == 1):?>
                                <?php $indicator='1 event hosted,'?>
                            <?php else:?>
                                <?php $indicator = count($event->hostedEvents).' events hosted,'?>                               
                            <div><i class="fas fa-calendar-check mr-2 text-[#f5a623]"></i><?=$indicator?></div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <a href="/users/profile/<?=$host->user_id?>" class="block text-center py-2 border border-[#f5a623] text-[#f5a623] rounded hover:bg-[#f5a623] hover:text-white transition-colors">View Profile</a>
            </div>

  <!-- Attendees -->
<div class="bg-white p-5 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-100">
        Attendees (<?= count($attendees) ?>)
    </h3>

    <!-- Avatar group - Initially show only first 6 -->
    <div class="flex flex-wrap mb-4" id="attendees-preview">
        <?php 
        $displayLimit = 6;
        $attendeesToShow = array_slice($attendees, 0, $displayLimit);
        ?>
        
        <?php foreach ($attendeesToShow as $attendee): ?>
            <div class="relative group -ml-2 first:ml-0 attendee-item">
                <a href="/users/profile/<?=$attendee->user_id?>">
                    <img src="<?= getUserProfilePicture($attendee) ?>" alt="Attendee"
                         class="w-11 h-11 rounded-full object-cover border-2 border-white transition-all duration-200 group-hover:ring-2 group-hover:ring-blue-400">
                </a>
                
                <!-- Name tooltip -->
                <div class="absolute z-10 hidden group-hover:block bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded-md shadow-lg whitespace-nowrap">
                    <?= ucwords(strtolower($attendee->first_name)) ?>
                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-800 rotate-45"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Hidden attendees that will be shown when expanded -->
    <?php if(count($attendees) > $displayLimit): ?>
        <div class="hidden" id="all-attendees">
            <div class="grid grid-cols-1 gap-3 mb-4">
                <?php foreach ($attendees as $attendee): ?>
                    <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded">
                        <a href="/users/profile/<?=$attendee->user_id?>">
                            <img src="<?= getUserProfilePicture($attendee) ?>" alt="<?= $attendee->first_name ?>"
                                 class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        </a>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900">
                                <?= ucwords(strtolower($attendee->first_name . ' ' . $attendee->last_name)) ?>
                            </div>
                            <?php if(isset($attendee->city) && isset($attendee->country)): ?>
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <?= $attendee->city ?>, <?= $attendee->country ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if($attendee->user_id == $user->user_id): ?>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">You</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Toggle Button -->
    <?php if(count($attendees) > $displayLimit): ?>
        <button id="toggle-attendees" 
                class="block w-full text-center py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors">
            <span id="toggle-text">View All Attendees</span>
            <i id="toggle-icon" class="fas fa-chevron-down ml-1"></i>
        </button>
    <?php endif; ?>
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
    <?php if($isOwner):?>
    <!-- Delete Form -->
    <form method="POST" class="mb-4">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded flex items-center justify-center gap-2">
            <i class="fas fa-trash-alt"></i> Delete Event
        </button>
    </form>

    <!-- End Delete Form -->

     <!-- Edit Form -->
     <a href="/events/edit/<?=$event->event_id?>" class="block text-center bg-blue-500 border text-white py-2 px-4 mb-4 rounded hover:bg-blue-600 hover:text-white transition-colors">
     Edit Event </a>
    <!-- End Edit Form -->
     <?php endif;?>
    
    <a href="#" class="block text-center border border-[#f5a623] text-[#f5a623] py-2 px-4 rounded hover:bg-[#f5a623] hover:text-white transition-colors">
        <i class="fas fa-exclamation-circle mr-1"></i> Report Event
    </a>
</div>

            <!-- Similar Events -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-100">Similar Events</h3>
                <div class="space-y-4">

                <div class="flex gap-2.5">
    <img 
        src="https://www.santuon.com/content/images/2022/06/1656313913219.png" 
        alt="Event" 
        class="w-16 h-16 object-cover rounded"
    >
    <div>
        <div class="font-semibold mb-1">Language Exchange Meetup</div>
        <div class="text-sm text-gray-600">Apr 15, 2025 • Şişli</div>
    </div>
</div>

<div class="flex gap-2.5 items-center">  <!-- Added items-center for better vertical alignment -->
    <img 
        src="https://www.yourcoffeebreak.co.uk/wp-content/uploads/Turkish-coffee-cezve-600x600.webp" 
        alt="Event" 
        class="w-16 h-16 object-cover rounded"  
    >
    <div>
        <div class="font-semibold mb-1">Discover Turkish Coffee</div>
        <div class="text-sm text-gray-600">Apr 10, 2025 • Beşiktaş</div>
    </div>
</div>

<div class="flex gap-2.5 items-center">  <!-- Added items-center for better vertical alignment -->
    <img 
        src="https://ikmagazin.com/wp-content/uploads/2024/12/expat-nedir.png" 
        alt="Event" 
        class="w-16 h-16 object-cover rounded"  
    >
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
        document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-attendees');
    const allAttendeesDiv = document.getElementById('all-attendees');
    const attendeesPreview = document.getElementById('attendees-preview');
    const toggleText = document.getElementById('toggle-text');
    const toggleIcon = document.getElementById('toggle-icon');
    
    if (toggleButton) {
        let isExpanded = false;
        
        toggleButton.addEventListener('click', function() {
            if (!isExpanded) {
                // Show all attendees
                attendeesPreview.style.display = 'none';
                allAttendeesDiv.classList.remove('hidden');
                toggleText.textContent = 'Show Less';
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
                isExpanded = true;
            } else {
                // Show preview only
                attendeesPreview.style.display = 'flex';
                allAttendeesDiv.classList.add('hidden');
                toggleText.textContent = 'View All Attendees';
                toggleIcon.classList.remove('fa-chevron-up');
                toggleIcon.classList.add('fa-chevron-down');
                isExpanded = false;
            }
        });
    }
});
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
