<?php require_once __DIR__ . '/../helpers.php'; ?>
<?=loadWelcomePartial('headWl'); ?>

<body class="bg-lightbg min-h-screen flex flex-col items-center pt-20">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <div class="bg-white rounded-lg w-full max-w-md mt-auto mb-10 py-5 shadow-md">
        <form action="">
            <h1 class="mt-2.5 text-3xl text-center font-sans">Register</h1>

            <div class="flex w-[90%] h-12 my-8 mx-5 justify-between">
                <input type="text" placeholder="First Name" required id="fname" class="w-[45%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
                <input type="text" placeholder="Last Name" required id="lname" class="w-[45%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            </div>
            <div class="w-[90%] h-12 my-8 mx-5">
                <input type="email" placeholder="Email" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            </div>
            <div class="w-[90%] h-12 my-8 mx-5">
                <input type="password" placeholder="Password" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            </div>
            <div class="w-[90%] h-12 my-8 mx-5">
                <input type="password" placeholder="Confirm Password" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            </div>

            <div class="flex w-[90%] h-12 my-8 mx-5 justify-between gap-2.5">
                <input type="date" required class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black">
                <select required class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black appearance-none cursor-pointer">
                    <option value="" disabled selected>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>

            <button type="submit" id="loginBtn" class="w-96 h-[45px] border-none outline-none rounded-3xl cursor-pointer text-base font-semibold bg-secondary text-white hover:bg-gray-700 mx-auto block"> Join </button>

            <div class="login-link p-2.5 text-center">
                <p>Have an Account? <a href="../login_registerScreen/loginIndex.php" class="text-black no-underline font-semibold hover:underline"> Login</a></p>
            </div>
        </form>
    </div>
        <!--Footer -->
        <?=loadWelcomePartial('footerWl'); ?>

    <script>
      
    </script>
</body>
</html>