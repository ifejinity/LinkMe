<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkMe | Edit</title>
    <!-- cdns -->
    <?php 
        include "./components/__cdn.php";
        include "./components/__tailwindConfig.php";
    ?>
</head>
<body class="min-h-screen w-full bg-secondary flex items-center flex-col gap-5 py-10 font-[outfit] text-fourth relative px-[5%]">
    <!-- Controllers -->
    <?php
        include "../Controllers/ContactsControllers.php";
        $contact = $_SESSION["contact"];
        $protected->savedContactData($conn, $user);
    ?>
    <!-- deleting -->
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="deleteDisplay">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="../assets/bin.gif" alt="" srcset="">
            <p class="w-fit self-end">Deleting contact <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
    <!-- edit -->
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="editDisplay">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="../assets/edit.gif" alt="" srcset="">
            <p class="w-fit self-end">Updating contact <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
    <!-- header -->
    <?php include "./components/__header.php" ?>
    <!-- breadcrumbs -->
    <div class="text-sm breadcrumbs h-fit mt-[50px] w-full max-w-[1440px]">
        <ul>
            <li>
            <a href="./contacts.php">
                <i class="bi bi-house mr-1"></i>
                Home
            </a>
            </li> 
            <li>
                <i class="bi bi-pencil-square mr-1"></i>
                Edit Contact
            </li>
            <li>
                <div class="badge bg-fourth text-primary"> <i class="bi bi-person mr-1"></i><?php echo $contact["fullname"] ?></div>
            </li>
        </ul>
    </div>
    <!-- edit form -->
    <div class="w-full min-h-[70vh] items-center flex justify-center">
        <form class="w-full max-w-[500px] shadow-md bg-primary p-5 rounded-lg h-fit" id="editForm">
            <h3 class="font-bold text-[24px]">Edit Contact</h3>
            <div class="mt-5 flex flex-col">
                <input type="hidden" name="save">
                <input type="text" name="fullname" placeholder="Fullname" class="input input-bordered w-full" value="<?php echo $contact["fullname"] ?>"/>
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageFullname"></span>
                <input type="number" name="contactNumber" placeholder="Contact number" class="input input-bordered w-full" value="<?php echo $contact["contact_number"] ?>"/>
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageContactNumber"></span>
                <input type="text" name="emailAddress" placeholder="Email address" class="input input-bordered w-full" value="<?php echo $contact["email_address"] ?>"/>
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageEmailAddress"></span>
                <textarea type="text" name="address" placeholder="Address" class="textarea textarea-bordered w-full resize-none text-base"><?php echo $contact["address"] ?></textarea>
                <input type="hidden" name="contactId" value="<?php echo $contact["contact_id"] ?>">
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageAddress"></span>
                <div class="dropdown dropdown-end self-end" id="editBtn">
                    <label tabindex="0" class="btn m-1 bg-fourth text-primary hover:bg-fourth/90">Save</label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <button type="submit" id="save">Proceed</button>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
    <!-- delete contact -->
    <div class="tooltip tooltip-left fixed bottom-[24px] right-[24px]" data-tip="Delete this contact">
        <div class="dropdown dropdown-top dropdown-end ">
            <label tabindex="0" class="btn m-1 btn-error text-[20px] shadow-md"><i class="bi bi-trash3"></i></label>
            <form  tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52" id="deleteForm">
                <input type="hidden" name="delete" value="<?php echo $contact["contact_id"] ?>">
                <li><button type="submit" id="delete">Proceed</button></li>
            </form>
        </div>
    </div>
    <!-- toastify js -->
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>
    <!-- request -->
    <script src="../js/request.js"></script>
</body>
</html>