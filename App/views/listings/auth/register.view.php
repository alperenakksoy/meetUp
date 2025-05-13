<?=loadWelcomePartial('headWl'); ?>

<body class="bg-lightbg min-h-screen flex flex-col items-center pt-20">
    <!-- Header -->
    <?=loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <div class="bg-white rounded-lg w-full max-w-md mt-auto mb-10 py-5 shadow-md">
    <form method="POST" action="/register">
    <h1 class="mt-2.5 text-3xl text-center font-sans">Register</h1>

    <?=loadPartial('errors',['errors' => $errors ?? []])?>

    <div class="flex w-[90%] h-12 my-8 mx-5 justify-between">
        <input type="text" name="first_name" placeholder="First Name" value="<?=$user['first_name'] ?? '' ?>"  class="w-[45%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
        <input type="text" name="last_name" placeholder="Last Name" value="<?=$user['last_name'] ?? '' ?>"  class="w-[45%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
    </div>
    <div class="w-[90%] h-12 my-8 mx-5">
        <input type="email" name="email" placeholder="Email" class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
    </div>
    <div class="w-[90%] h-12 my-8 mx-5">
        <input type="password" name="password" placeholder="Password"  class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
    </div>
    <div class="w-[90%] h-12 my-8 mx-5">
        <input type="password" name="confirm_password" placeholder="Confirm Password"  class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
    </div>

    <div class="flex w-[90%] h-12 my-8 mx-5 justify-between gap-2.5">
        <input type="date" name="date_of_birth" value="<?=$user['date_of_birth'] ?? '' ?>" class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black">
        <select name="gender"  class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black appearance-none cursor-pointer">
            <option value="" value="<?=$user['gender'] ?? '' ?>"disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <button type="submit" id="loginBtn" class="w-96 h-[45px] border-none outline-none rounded-3xl cursor-pointer text-base font-semibold bg-secondary text-white hover:bg-gray-700 mx-auto block"> Join </button>

    <div class="login-link p-2.5 text-center">
        <p>Have an Account? <a href="/login" class="text-black no-underline font-semibold hover:underline"> Login</a></p>
    </div>
</form>
    </div>
        <!--Footer -->
        <?=loadWelcomePartial('footerWl'); ?>

    <script>
      
    </script>
</body>
</html>