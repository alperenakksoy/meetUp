<?=loadWelcomePartial('headWl'); ?>

<body class="min-h-screen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <main class="flex items-center justify-center px-4" style="min-height: calc(100vh - 140px); margin-top: 70px;">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Simple Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back</h1>
                    <p class="text-gray-600">Please sign in to your account</p>
                </div>

                <!-- Login Form -->
                <form action="/login" method="POST" class="space-y-6">
                    <?=loadPartial('errors',['errors' => $errors ?? []])?>
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2">
                            <span class="text-gray-600">Remember me</span>
                        </label>
                        <a href="/forgot-password" class="text-primary hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-secondary text-white font-medium py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200"
                    >
                        Sign In
                    </button>

                    <!-- Register Link -->
                    <div class="text-center pt-4 border-t border-gray-200">
                        <p class="text-gray-600">
                            Don't have an account? 
                            <a href="/register" class="text-primary font-medium hover:underline">
                                Create one
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?=loadWelcomePartial('footerWl'); ?>
</body>
</html>