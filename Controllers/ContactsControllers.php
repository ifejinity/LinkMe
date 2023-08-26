<?php
    session_start();
    include "../php/errorReporting.php";
    include "../models/protectRoutes.php";
    include "../models/Connection.php";
    include "../models/Person.php";
    include "../models/Users.php";
    include "../models/Contacts.php";
    include "../models/validation.php";

    $conn = new Connection();
    $user = new Users($conn);
    $contacts = new Contacts($conn);
    $validate = new Validation();
    $protected = new ProtectRoutes();
    $protected->guest();

    // log out
    if(isset($_POST["logout"])) {
        $user->logoutUser();
    }
    // create contacts
    if(isset($_POST["addContact"])) {
        // set contact information
        $contacts->setFullname($_POST["fullname"]);
        $contacts->setContactNumber($_POST["contactNumber"]);
        $contacts->setEmailAddress($_POST["emailAddress"]);
        $contacts->setAddress($_POST["address"]);
        // get users id
        $user->setUsername($_SESSION["username"]);
        // validate contact information
        $validate->validateFullname($contacts);
        $validate->validateAddress($contacts);
        $validate->validateEmail($contacts);
        $validate->validateContactNumber($contacts);
        // create contact
        $contacts->createContacts($user, $validate);
    }
    // delete contacts
    if(isset($_POST["delete"])) {
        $contacts->setContactId($_POST["delete"]);
        $contacts->deleteContacts();
    }
    // Show all contacts
    if(!isset($_POST["search"])) {
        // set username
        $user->setUsername($_SESSION["username"]);
        // get all contacts of where users_id is equal to user users_id
        $result = $contacts->getAllContacts($user);
    }
    // search contacts name
    if(isset($_POST["search"])) {
        // set username
        $user->setUsername($_SESSION["username"]);
        // set contacts fullname
        $contacts->setFullname($_POST["fullname"]);
        // get contacts by fullname
        $contacts->searchContacts($user);
    }
    // get edit contact
    if(isset($_POST["edit"])) {
        $contacts->setContactId($_POST["edit"]);
        $_SESSION["contact"] = $contacts->getContactData();
        header("location: ./edit.php");
    }
    // save changes to contact
    if(isset($_POST["save"])) {
        // set contact information
        $contacts->setContactId($_POST["contactId"]);
        $contacts->setFullname($_POST["fullname"]);
        $contacts->setContactNumber($_POST["contactNumber"]);
        $contacts->setEmailAddress($_POST["emailAddress"]);
        $contacts->setAddress($_POST["address"]);
        // validate contact information
        $validate->validateFullname($contacts);
        $validate->validateContactNumber($contacts);
        $validate->validateEmail($contacts);
        $validate->validateAddress($contacts);
        // save changes
        $contacts->saveEdit($validate);
    }
?>
