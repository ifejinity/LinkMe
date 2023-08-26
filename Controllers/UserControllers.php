<?php
    session_start();
    include "../php/errorReporting.php";
    include "../models/Connection.php";
    include "../models/Person.php";
    include "../models/Users.php";
    include "../models/validation.php";
    include "../models/protectRoutes.php";

    $conn = new Connection();
    $user = new Users($conn);
    $validate = new Validation();
    $protected = new ProtectRoutes();
    $protected->user();

    // registration 
    if(isset($_POST["signUp"])) {
        // set user information
        $user->setUsername($_POST["username"]);
        $user->setFullName($_POST["fullname"]);
        $user->setPassword($_POST["password"]);
        $user->setPasswordConfirmation($_POST["passwordConfirm"]);
        // validate user information
        $validate->validateUsername($user);
        $validate->validateFullname($user);
        $validate->validatePassword($user);
        $validate->uniqueUsername($user);
        // create user
        $user->createUser($validate);
    }
    // sign in
    if (isset($_POST["signIn"])) {
        $user->setUsername($_POST["username"]);
        $user->setPassword($_POST["password"]);
        $user->loginUser();
    }
?>