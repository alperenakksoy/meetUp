<?= loadPartial('head')?>
<?= loadPartial('navbar')?>

<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md overflow-hidden mt-20">
        <div class="p-6">
            <div class="flex flex-col items-center">
                <div class="text-6xl font-bold text-orange-500 mb-4">404</div>
                <h1 class="text-2xl font-semibold text-gray-800 mb-3">Page Not Found</h1>
                <p class="text-gray-600 text-center mb-6">
                    Oops! The page you're looking for doesn't exist or has been moved.
                </p>
                
                <div class="space-y-3 w-full">
                    <a href="/" class="block w-full py-2 px-4 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-center transition-colors">
                        Back to Home
                    </a>
                    <a href="/events" class="block w-full py-2 px-4 border border-orange-500 text-orange-500 hover:bg-orange-50 rounded-lg text-center transition-colors">
                        Browse Events
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50 p-6 border-t border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Popular Pages</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="/events/create" class="flex items-center text-gray-700 hover:text-orange-500">
                    <i class="fas fa-plus-circle mr-2 text-orange-500"></i>
                    <span>Create Event</span>
                </a>
                <a href="/friends" class="flex items-center text-gray-700 hover:text-orange-500">
                    <i class="fas fa-user-friends mr-2 text-orange-500"></i>
                    <span>Find Friends</span>
                </a>
                <a href="/messages" class="flex items-center text-gray-700 hover:text-orange-500">
                    <i class="fas fa-envelope mr-2 text-orange-500"></i>
                    <span>Messages</span>
                </a>
                <a href="/profile" class="flex items-center text-gray-700 hover:text-orange-500">
                    <i class="fas fa-user mr-2 text-orange-500"></i>
                    <span>My Profile</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?= loadPartial('footer')?>