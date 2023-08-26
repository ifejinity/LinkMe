<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkMe | Home</title>
    <!-- cdns -->
    <?php 
        include "./components/__cdn.php";
        include "./components/__tailwindConfig.php";
    ?>
</head>
<body class="min-h-screen w-full bg-secondary flex flex-col items-center px-[5%] gap-5 py-10 font-[outfit] text-fourth">
    <!-- Controllers -->
    <?php
        include "../Controllers/ContactsControllers.php";
        $protected->guest();
    ?>
    <!-- header -->
    <?php include "./components/__header.php" ?>
    <!-- breadcrumbs -->
    <div class="text-sm breadcrumbs h-fit mt-[50px] w-full max-w-[1440px]">
        <ul>
            <li>
                <i class="bi bi-house mr-1"></i>
                Home
            </li> 
            <li>
                
            </li>
        </ul>
    </div>
    <!-- creating -->
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="creating">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="../assets/save.gif" alt="" srcset="">
            <p class="w-fit self-end">Creating contact <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
    <!-- modal add contact -->
    <div class="bg-black/30 w-full top-0 min-h-screen fixed z-[3] hidden justify-center items-center" id="addModal">
        <form class="modal-box text-base" id="addContactForm">
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" id="hideAddModal">✕</button>
            <h3 class="font-bold text-[24px]">Add Contact</h3>
            <div class="mt-5 flex flex-col">
                <input type="hidden" name="addContact">
                <input type="text" name="fullname" placeholder="Fullname" class="input input-bordered w-full" id="fullname"/>
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageFullname"></span>
                <input type="number" name="contactNumber" placeholder="Contact number" class="input input-bordered w-full" id="contactNumber"/>
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageContactNumber"></span>
                <input type="text" name="emailAddress" placeholder="Email address" class="input input-bordered w-full" id="emailAddress"/>
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageEmailAddress"></span>
                <textarea type="text" name="address" placeholder="Address" class="textarea textarea-bordered w-full resize-none text-base" id="address"></textarea>
                <span class="text-red-500 text-[14px] mb-2 mt-1" id="errorMessageAddress"></span>
                <div class="gap-1 w-fit self-end hidden" id="addContact">
                    <div class="tooltip" data-tip="Proceed">
                        <button type="submit" id="addContactBtn" class="btn text-[20px] bg-green-100 hover:bg-green-400"><i class="bi bi-check2"></i></button>
                    </div>
                    <div class="tooltip" data-tip="Cancel">
                        <button type="button" class="btn text-[20px] bg-red-100 hover:bg-red-400" id="hideAddContact"><i class="bi bi-x-lg"></i></button>
                    </div>
                </div>
                <button type="button" class="btn bg-fourth hover:bg-fourth/90 text-primary w-fit self-end" id="btnAdd">Add</button>
            </div>
        </form>
    </div>
    <!-- contact list -->
    <div class="w-full p-5 bg-primary rounded-md shadow-md max-w-[1440px] relative min-h-[79vh]">
        <div class="mb-5 w-full grid justify-items-end">
            <!-- search -->
            <form class="form-control w-full max-w-[500px]" id="searchForm">
                <div class="input-group">
                    <input type="text" id="search" name="fullname" placeholder="Search…" class="input input-bordered w-full" />
                    <input type="hidden" name="search"/>
                    <button type="submit" id="resetSearch" class="btn bg-fourth text-primary hover:bg-fourth/90 text-[20px]"><i class="bi bi-arrow-counterclockwise"></i></button>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead class="bg-fourth text-primary">
                    <tr class="text-base">
                        <th>Name</th>
                        <th>Contact number</th>
                        <th>Email address</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["fullname"] ?></td>
                            <td><a href="tel: <?php echo $row["contact_number"] ?>" class="text-third hover:underline flex gap-1"><i class="bi bi-telephone-outbound"></i></i><?php echo " " . $row["contact_number"] ?></a></td>
                            <td><a href="mailto:<?php echo $row["email_address"] ?>" class="text-third hover:underline flex gap-1"><i class="bi bi-envelope-at"></i><?php echo " " . $row["email_address"] ?></a></td>
                            <td><?php echo $row["address"] ?></td>
                            <td>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="flex gap-2 md:flex-row flex-col">
                                    <div class="tooltip tooltip-left" data-tip="Edit">
                                        <button type="submit" value="<?php echo $row["contact_id"] ?>" name="edit" class="btn bg-blue-400 hover:bg-blue-500"><i class="bi bi-pencil-square text-[20px]"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if($result->num_rows < 1) { ?>
            <div class="w-full flex justify-center items-center" id="noDataDisplay">
                <h1 class="text-[40px] font-[600] text-third text-center">NO DATA</h1>
            </div>
        <?php } ?>
    </div>
    <!-- btn show modal add contact -->
    <button type="button" class="btn bg-fourth hover:bg-fourth/90 text-primary fixed bottom-[24px] right-[24px] shadow-md" id="showAddModal">Add Contact</button>
    <!-- toastify js -->
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>
    <!-- js -->
    <script src="../js/contacts.js"></script>
    <!-- request -->
    <script src="../js/request.js"></script>
</body>
</html>