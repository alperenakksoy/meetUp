<?php require_once __DIR__ . '/../../../../helpers.php';?>

<?= loadPartial('head')?>
<?= loadPartial('header')?>

<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4 ">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md overflow-hidden mt-20">
        <div class="p-6">
            <div class="flex flex-col items-center">
                <div class="text-6xl font-bold text-red-500 mb-4">403</div>
                <h1 class="text-2xl font-semibold text-gray-800 mb-3">Access Forbidden</h1>
                <p class="text-gray-600 text-center mb-6">
                    Sorry, you don't have permission to access this page or resource.
                </p>
                
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-lock text-red-500 text-xl"></i>
                </div>
                
                <div class="space-y-3 w-full">
                    <a href="/" class="block w-full py-2 px-4 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-center transition-colors">
                        Back to Home
                    </a>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="/login" class="block w-full py-2 px-4 border border-orange-500 text-orange-500 hover:bg-orange-50 rounded-lg text-center transition-colors">
                        Log In
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50 p-6 border-t border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">What might have happened?</h2>
            <ul class="list-disc pl-5 text-gray-600 space-y-2">
                <li>You might need to log in to access this page</li>
                <li>You don't have sufficient permissions for this resource</li>
                <li>The content is restricted to specific users</li>
                <li>Your session may have expired</li>
            </ul>
            
            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Need assistance?</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>If you believe this is an error, please contact our support team or <a href="/support" class="font-medium underline hover:text-blue-600">submit a help request</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= loadPartial('/../partials/footer')?>