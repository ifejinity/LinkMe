<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkMe</title>
    <?php 
        include "./components/__cdn.php";
        include "./components/__tailwindConfig.php";
    ?>
</head>
<body class="min-h-screen w-full bg-secondary flex justify-center items-center px-[5%] py-10 font-[outfit] text-fourth">
    <!-- Controllers -->
    <?php
        include "../Controllers/UserControllers.php";
        $protected->user();
    ?>
    <!-- create user -->
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="createUserDisplay">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="../assets/add-user.gif" alt="" srcset="">
            <p class="w-fit self-end">Creating user <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
    <h1 class="fixed font-[600] text-[20vw] z-[1] top-0 text-fourth/70">LinkMe</h1>
    <!-- registration form -->
    <form class="bg-primary w-full max-w-[500px] h-fit rounded-lg shadow-lg p-5 flex-col z-[2] hidden" id="formRegistration">
        <h1 class="text-[24px] font-bold">Register</h1>
        <p class="mb-3">Sign in your Account <button type="button" class="text-third underline" id="signInHere">here</button></p>
        <input type="hidden" name="signUp"/>
        <input type="text" placeholder="Fullname" name="fullname" class="input input-bordered w-full" id="fullname"/>
        <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageFullname"></span>
        <input type="text" placeholder="Username" name="username" class="input input-bordered w-full" id="username"/>
        <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageUsername"></span>
        <input type="password" placeholder="Password" name="password" class="input input-bordered w-full" id="password"/>
        <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessagePassword"></span>
        <input type="password" placeholder="Confirm Password" name="passwordConfirm" class="input input-bordered w-full" id="passwordConfirm"/>
        <button type="submit" name="signUp" id="signUp" class="btn bg-fourth hover:bg-fourth/90 text-primary mt-3">Sign up</button>
    </form>
    <!-- sign in form -->
    <form class="bg-primary w-full max-w-[500px] h-fit rounded-lg shadow-lg p-5 flex-col z-[2] hidden" id="formSignIn">
        <h1 class="text-[24px] font-bold">Sign in</h1>
        <p class="mb-3">Create an Account <button type="button" class="text-third underline" id="registerHere">here</button></p>
        <input type="hidden" name="signIn"/>
        <input type="text" placeholder="Username" name="username" class="input input-bordered w-full mb-3"/>
        <input type="password" placeholder="Password" name="password" class="input input-bordered w-full"/>
        <button type="submit" id="signIn" class="btn bg-fourth hover:bg-fourth/90 text-primary mt-3">Sign in</button>
    </form>
    <!-- js -->
    <script src="../js/index.js"></script>
    <!-- toastify js -->
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>
    <!-- request -->
    <script src="../js/request.js"></script>
</body>
</html>