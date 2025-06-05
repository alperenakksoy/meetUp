<?php
// App/views/listings/hangouts/index.view.php

// Set page variables
$pageTitle = 'Hangouts';
$activePage = 'hangouts';
$isLoggedIn = true;
?>
<?php loadPartial('head') ?>

<body>
<?php loadPartial('navbar') ?>

<!-- Main Content -->
<div class="container mx-auto px-4 py-6 max-w-7xl mt-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Hangouts</h1>
            <p class="text-gray-600">Quick & spontaneous meetups happening now</p>
        </div>
        <button id="createHangoutBtn" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition duration-200">
            <i class="fas fa-plus mr-2"></i> Quick Hangout
        </button>
        
    </div>

    <!-- Quick Filters -->
    <div class="flex space-x-2 mb-6 overflow-x-auto pb-2">
        <button class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium cursor-pointer hover:bg-orange-600 filter-btn active" data-filter="all">
            All Hangouts
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="coffee">
            ☕ Coffee
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="food">
            🍕 Food
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="walk">
            🚶 Walk
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="drink">
            🍺 Drinks
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium cursor-pointer filter-btn" data-filter="active">
            Starting Soon
        </button>
    </div>

    <!-- Hangouts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="hangoutsContainer">
        <!-- Sample Hangout Cards -->
        <div class="hangout-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 p-4" data-category="coffee">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Host" class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <h3 class="font-semibold text-gray-800">Coffee at Starbucks</h3>
                        <p class="text-sm text-gray-600">Emma Johnson</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">☕ Coffee</span>
            </div>
            
            <p class="text-gray-700 text-sm mb-3">Quick coffee break at Starbucks Taksim. Let's chat about travel stories!</p>
            
            <div class="flex items-center text-sm text-gray-600 mb-3">
                <i class="fas fa-clock mr-2 text-orange-500"></i>
                <span class="mr-4">In 30 minutes</span>
                <i class="fas fa-map-marker-alt mr-2 text-orange-500"></i>
                <span>Taksim, Istanbul</span>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex -space-x-2">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Going" class="w-6 h-6 rounded-full border-2 border-white">
                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Going" class="w-6 h-6 rounded-full border-2 border-white">
                    </div>
                    <span class="text-sm text-gray-500 ml-2">2 going</span>
                </div>
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                    Join
                </button>
            </div>
        </div>

        <div class="hangout-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 p-4" data-category="food">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Host" class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <h3 class="font-semibold text-gray-800">Lunch at Karakoy</h3>
                        <p class="text-sm text-gray-600">Alex Thompson</p>
                    </div>
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">🍕 Food</span>
            </div>
            
            <p class="text-gray-700 text-sm mb-3">Trying a new Turkish restaurant. Looking for foodie companions!</p>
            
            <div class="flex items-center text-sm text-gray-600 mb-3">
                <i class="fas fa-clock mr-2 text-orange-500"></i>
                <span class="mr-4">In 1 hour</span>
                <i class="fas fa-map-marker-alt mr-2 text-orange-500"></i>
                <span>Karakoy, Istanbul</span>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex -space-x-2">
                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Going" class="w-6 h-6 rounded-full border-2 border-white">
                    </div>
                    <span class="text-sm text-gray-500 ml-2">1 going</span>
                </div>
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium">
                    Join
                </button>
            </div>
        </div>

        <div class="hangout-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 p-4" data-category="walk">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Host" class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <h3 class="font-semibold text-gray-800">Galata Bridge Walk</h3>
                        <p class="text-sm text-gray-600">Sofia Martinez</p>
                    </div>
                </div>
                <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">🚶 Walk</span>
            </div>
            
            <p class="text-gray-700 text-sm mb-3">Sunset walk across Galata Bridge. Great for photos!</p>
            
            <div class="flex items-center text-sm text-gray-600 mb-3">
                <i class="fas fa-clock mr-2 text-orange-500"></i>
                <span class="mr-4">Starting now</span>
                <i class="fas fa-map-marker-alt mr-2 text-orange-500"></i>
                <span>Galata Bridge</span>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex -space-x-2">
                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Going" class="w-6 h-6 rounded-full border-2 border-white">
                        <img src="https://randomuser.me/api/portraits/women/76.jpg" alt="Going" class="w-6 h-6 rounded-full border-2 border-white">
                        <img src="https://randomuser.me/api/portraits/men/82.jpg" alt="Going" class="w-6 h-6 rounded-full border-2 border-white">
                    </div>
                    <span class="text-sm text-gray-500 ml-2">3 going</span>
                </div>
                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm font-medium">
                    <i class="fas fa-running mr-1"></i> Live
                </button>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="hidden text-center py-12">
        <div class="text-gray-400 mb-4">
            <i class="fas fa-calendar-times fa-4x"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">No hangouts found</h3>
        <p class="text-gray-500 mb-4">Be the first to create a spontaneous hangout!</p>
        <button id="createFirstHangout" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Create First Hangout
        </button>
    </div>
</div>

<!-- Quick Create Hangout Modal -->
<div id="createHangoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Quick Hangout</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        
        <form id="quickHangoutForm" class="p-4 space-y-4">
            <!-- Quick Activity Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">What do you want to do?</label>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="coffee">
                        <div class="text-center">
                            <div class="text-2xl mb-1">☕</div>
                            <div class="text-sm font-medium">Coffee</div>
                        </div>
                    </button>
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="food">
                        <div class="text-center">
                            <div class="text-2xl mb-1">🍕</div>
                            <div class="text-sm font-medium">Food</div>
                        </div>
                    </button>
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="walk">
                        <div class="text-center">
                            <div class="text-2xl mb-1">🚶</div>
                            <div class="text-sm font-medium">Walk</div>
                        </div>
                    </button>
                    <button type="button" class="activity-btn p-3 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors" data-activity="drink">
                        <div class="text-center">
                            <div class="text-2xl mb-1">🍺</div>
                            <div class="text-sm font-medium">Drinks</div>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="selectedActivity" name="activity" required>
            </div>

            <!-- Quick Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Quick description</label>
                <input type="text" id="description" name="description" 
                       placeholder="e.g., Coffee at Starbucks Taksim" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" 
                       required maxlength="100">
            </div>

            <!-- When -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">When?</label>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" class="when-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors text-sm" data-when="now">
                        Now
                    </button>
                    <button type="button" class="when-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors text-sm" data-when="30min">
                        30 min
                    </button>
                    <button type="button" class="when-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors text-sm" data-when="1hour">
                        1 hour
                    </button>
                </div>
                <input type="hidden" id="selectedWhen" name="when" required>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Where?</label>
                <input type="text" id="location" name="location" 
                       placeholder="e.g., Taksim Square, Istanbul" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" 
                       required>
            </div>

            <!-- Max People (Optional) -->
            <div>
                <label for="maxPeople" class="block text-sm font-medium text-gray-700 mb-1">Max people (optional)</label>
                <select id="maxPeople" name="max_people" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">No limit</option>
                    <option value="2">2 people</option>
                    <option value="3">3 people</option>
                    <option value="4">4 people</option>
                    <option value="5">5 people</option>
                    <option value="6">6 people</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                <i class="fas fa-rocket mr-2"></i> Create Hangout
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal controls
    const createBtn = document.getElementById('createHangoutBtn');
    const createFirstBtn = document.getElementById('createFirstHangout');
    const modal = document.getElementById('createHangoutModal');
    const closeModal = document.getElementById('closeModal');

    // Show modal
    [createBtn, createFirstBtn].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        }
    });

    // Hide modal
    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    // Close modal when clicking outside
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    // Activity selection
    const activityBtns = document.querySelectorAll('.activity-btn');
    const selectedActivityInput = document.getElementById('selectedActivity');

    activityBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            activityBtns.forEach(b => {
                b.classList.remove('border-orange-500', 'bg-orange-50');
                b.classList.add('border-gray-300');
            });
            
            // Add active class to clicked button
            btn.classList.remove('border-gray-300');
            btn.classList.add('border-orange-500', 'bg-orange-50');
            
            // Set selected value
            selectedActivityInput.value = btn.dataset.activity;
        });
    });

    // When selection
    const whenBtns = document.querySelectorAll('.when-btn');
    const selectedWhenInput = document.getElementById('selectedWhen');

    whenBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            whenBtns.forEach(b => {
                b.classList.remove('border-orange-500', 'bg-orange-50');
                b.classList.add('border-gray-300');
            });
            
            // Add active class to clicked button
            btn.classList.remove('border-gray-300');
            btn.classList.add('border-orange-500', 'bg-orange-50');
            
            // Set selected value
            selectedWhenInput.value = btn.dataset.when;
        });
    });

    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const hangoutCards = document.querySelectorAll('.hangout-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            
            // Update active filter button
            filterBtns.forEach(b => {
                b.classList.remove('bg-orange-500', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-800');
            });
            btn.classList.remove('bg-gray-200', 'text-gray-800');
            btn.classList.add('bg-orange-500', 'text-white');
            
            // Filter cards
            let visibleCount = 0;
            hangoutCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show/hide empty state
            const emptyState = document.getElementById('emptyState');
            const container = document.getElementById('hangoutsContainer');
            if (visibleCount === 0) {
                container.style.display = 'none';
                emptyState.classList.remove('hidden');
            } else {
                container.style.display = 'grid';
                emptyState.classList.add('hidden');
            }
        });
    });

    // Form submission
    const form = document.getElementById('quickHangoutForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Basic validation
        if (!selectedActivityInput.value) {
            alert('Please select an activity type');
            return;
        }
        
        if (!selectedWhenInput.value) {
            alert('Please select when this hangout will happen');
            return;
        }
        
        // Show success message (replace with actual form submission)
        alert('Hangout created successfully! 🎉');
        
        // Close modal and reset form
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        form.reset();
        
        // Reset button states
        activityBtns.forEach(btn => {
            btn.classList.remove('border-orange-500', 'bg-orange-50');
            btn.classList.add('border-gray-300');
        });
        whenBtns.forEach(btn => {
            btn.classList.remove('border-orange-500', 'bg-orange-50');
            btn.classList.add('border-gray-300');
        });
    });

    // Join hangout functionality
    document.addEventListener('click', (e) => {
        if (e.target.matches('.bg-orange-500[class*="px-3"]') || e.target.closest('.bg-orange-500[class*="px-3"]')) {
            const btn = e.target.closest('button');
            if (btn && btn.textContent.trim() === 'Join') {
                btn.textContent = 'Joined';
                btn.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                btn.classList.add('bg-green-500', 'hover:bg-green-600');
                
                // Update attendee count
                const countSpan = btn.closest('.hangout-card').querySelector('.text-sm.text-gray-500');
                const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                countSpan.textContent = `${currentCount + 1} going`;
            }
        }
    });
});
</script>

<?= loadPartial('scripts'); ?>
<?= loadPartial('footer'); ?>
</body>
</html>