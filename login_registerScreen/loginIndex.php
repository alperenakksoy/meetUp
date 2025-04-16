<?php require_once __DIR__ . '/../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>
<body class="bg-lightbg min-h-screen flex flex-col items-center pt-20">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <div class="bg-white rounded-lg w-full max-w-md mt-auto mb-20 py-5 shadow-md ">
        <form action="" class="px-5">
            <h1 class="mt-2.5 text-3xl text-center">Login</h1>
            <div class="w-[90%] h-12 mx-5 my-8">
                <input 
                    type="email" 
                    placeholder="Email" 
                    required
                    class="w-full h-full bg-transparent border border-gray-600 outline-none rounded-3xl px-5 placeholder-black"
                >
            </div>
            <div class="w-[90%] h-12 mx-5 my-8">
                <input 
                    type="password" 
                    placeholder="Password" 
                    required
                    class="w-full h-full bg-transparent border border-gray-600 outline-none rounded-3xl px-5 placeholder-black"
                >
            </div>
            <div class="flex text-sm justify-between mx-2.5 mb-4 mt-[-15px]">
                <label class="flex items-center">
                    <input type="checkbox" class="mr-0.5">
                    Remember me
                </label>
                <a href="../login_registerScreen/forgotpassword/forgot.php" class="text-black no-underline hover:underline">Forgot password?</a>
            </div>

            <button type="submit" id="loginBtn" class="w-full h-[45px] border-none outline-none rounded-3xl cursor-pointer text-base font-semibold">Login</button>

            <div class="register-link py-2.5 text-center">
                <p>Don't have an account? <a href="../login_registerScreen/registerIndex.php" class="text-black no-underline font-semibold hover:underline"> Register</a></p>
            </div>
        </form>
    </div>

    <!--Footer -->
    <?=loadWelcomePartial('footerWl'); ?>
    <script>

        // Button styling
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('loginBtn');
            loginBtn.classList.add('bg-secondary', 'text-white', 'hover:bg-gray-500');
        });
    </script>
</body>
</html>