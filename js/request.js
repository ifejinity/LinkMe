$(document).ready(function () {
    // request class
    class Request {
        // log in function
        logInUser() {
            var formData = $("#formSignIn").serialize();
            $.ajax({
                type: "post",
                url: "../Controllers/UserControllers.php",
                data: formData,
                success: function (response) {
                    if(response.trim() == "success") {
                        $("#signIn").html("Logging in <span class='loading loading-dots loading-xs'></span>")
                        Toastify({
                            text: response,
                            className: 'info',
                            style: {
                            background: '#22c55e',
                            }
                        }).showToast();
                        setTimeout(() => {
                            window.location.href = "../views/contacts.php";
                        }, 1000);
                    } else {
                        Toastify({
                            text: response,
                            className: 'info',
                            style: {
                            background: '#ef4444',
                            }
                        }).showToast();
                    }
                }
            });
        }
        // register function
        register() {
            var formData = $("#formRegistration").serialize();
            $.ajax({
                type: "post",
                url: "../Controllers/UserControllers.php",
                data: formData,
                success: function (response) {
                    // return value from php
                    let data = JSON.parse(response);
                    let status = data[0];
                    // show error message
                    $("#errorMessageFullname").html(data[1].fullname);
                    $("#errorMessageUsername").html(data[1].username);
                    $("#errorMessagePassword").html(data[1].password);
                    if(status == "success") {
                        // show create user display
                        $("#createUserDisplay").addClass("flex").removeClass("hidden");
                        setTimeout(() => {
                            // reset value
                            $('#fullname').val("");
                            $('#username').val("");
                            $('#password').val("");
                            $('#passwordConfirm').val("");
                            Toastify({
                                text: 'Registration success!',
                                className: 'info',
                                style: {
                                background: '#22c55e',
                                }
                            }).showToast();
                            // hide create user display
                            $("#createUserDisplay").addClass("hidden").removeClass("flex");
                        }, 2000);
                    } else {
                        Toastify({
                            text: 'Registration failed!',
                            className: 'info',
                            style: {
                            background: '#ef4444',
                            }
                        }).showToast();
                    }
                }
            });
        }
        // create contacts
        createContact() {
            var formData = $("#addContactForm").serialize();
            $.ajax({
                type: "post",
                url: "../Controllers/ContactsControllers.php",
                data: formData,
                success: function (response) {
                    // return response from php
                    let data = JSON.parse(response);
                    let contactData = data[2];
                    let status = data[0];
                    // show error messages
                    $("#errorMessageFullname").html(data[1].fullname);
                    $("#errorMessageContactNumber").html(data[1].contactNumber);
                    $("#errorMessageEmailAddress").html(data[1].emailAddress);
                    $("#errorMessageAddress").html(data[1].address);
                    // check status
                    if(status == "Contact Added!") {
                        // hide add modal
                        $("#addModal").removeClass("flex").addClass("hidden");
                        // hide add contact btn
                        $("#addContact").removeClass("flex").addClass("hidden");
                        $("#creating").removeClass("hidden").addClass("flex");
                        setTimeout(() => {
                            // appending data from response
                            $("#dataTable").html("");
                            for(let x = 0; x < contactData.length; x++) {
                                $("#dataTable").append(`
                                    <tr>
                                        <td>${contactData[x].fullname}</td>
                                        <td><a href="tel:${contactData[x].contactNumber}" class="text-third hover:underline flex gap-1"><i class="bi bi-telephone-outbound"></i></i>${contactData[x].contactNumber}</a></td>
                                        <td><a href="mailto:${contactData[x].emailAddress}" class="text-third hover:underline flex gap-1"><i class="bi bi-envelope-at"></i>${contactData[x].emailAddress}</a></td>
                                        <td>${contactData[x].address}</td>
                                        <td>
                                            <form action="" method="post" class="flex gap-2 md:flex-row flex-col">
                                                <div class="tooltip tooltip-left" data-tip="Edit">
                                                    <button type="submit" value="${contactData[x].contactId}" name="edit" class="btn bg-blue-400 hover:bg-blue-500"><i class="bi bi-pencil-square text-[20px]"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                `);
                            }
                            // hide display no data if have return data
                            $("#noDataDisplay").addClass("hidden");
                            // reset the value of inputs
                            $('#fullname').val("");
                            $('#address').val("");
                            $('#contactNumber').val("");
                            $('#emailAddress').val("");
                            // hide add modal and return the addcontact button
                            $("#addModal").addClass("hidden").removeClass("flex");
                            $("#addContact").addClass("hidden").removeClass("flex");
                            $("#btnAdd").removeClass("hidden");
                            // pop up toast
                            Toastify({
                                text: status,
                                className: 'info',
                                style: {
                                background: '#22c55e',
                                }
                            }).showToast();
                            // show add contact btn
                        $("#creating").removeClass("flex").addClass("hidden");
                        }, 2000);
                    } else {
                        // pop up toast
                        Toastify({
                            text: status,
                            className: 'info',
                            style: {
                            background: '#ef4444',
                            }
                        }).showToast();
                    }
                }
            });
        }
        // edit contacts
        editContact() {
            var formData = $("#editForm").serialize();
            $.ajax({
                type: "post",
                url: "../Controllers/ContactsControllers.php",
                data: formData,
                success: function (response) {
                    // return value from php
                    let data = JSON.parse(response);
                    let status = data[0];
                    // show error message
                    $("#errorMessageFullname").html(data[1].fullname);
                    $("#errorMessageContactNumber").html(data[1].contactNumber);
                    $("#errorMessageEmailAddress").html(data[1].emailAddress);
                    $("#errorMessageAddress").html(data[1].address);
                    if(status == "success") {
                         // show edit display
                        $("#editDisplay").addClass("flex").removeClass("hidden");
                        setTimeout(() => {
                            Toastify({
                                text: 'Contact updated!',
                                className: 'info',
                                style: {
                                background: '#22c55e',
                                }
                            }).showToast();
                            // hide edit display
                            $("#editDisplay").addClass("hidden").removeClass("flex");
                        }, 2000);
                    } else {
                        Toastify({
                            text: 'Update failed!',
                            className: 'info',
                            style: {
                            background: '#ef4444',
                            }
                        }).showToast();
                    }
                }
            });
        }
        // delete contact
        deleteContact() {
            var formData = $("#deleteForm").serialize();
            $.ajax({
                type: "post",
                url: "../Controllers/ContactsControllers.php",
                data: formData,
                success: function (response) {
                    if(response.trim() == "success") {
                        $("#deleteDisplay").removeClass("hidden").addClass("flex");
                        setTimeout(() => {
                            $("#deleteDisplay").removeClass("flex").addClass("hidden");
                            Toastify({
                                text: 'Contact deleted!',
                                className: 'info',
                                style: {
                                background: '#22c55e',
                                }
                            }).showToast();
                            setTimeout(() => {
                                    window.location.href = "./contacts.php";
                            }, 1000);
                        }, 2000);
                    } else {
                        Toastify({
                            text: 'Deletion failed!',
                            className: 'info',
                            style: {
                            background: '#ef4444',
                            }
                        }).showToast();
                    }
                }
            });
        }
        // search contact
        searchContact() {
            var formData = $("#searchForm").serialize();
            $.ajax({
                type: "post",
                url: "../Controllers/ContactsControllers.php",
                data: formData,
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#dataTable").html("");
                    for(let x = 0; x < data.length; x++) {
                        $("#dataTable").append(`
                            <tr>
                                <td>${data[x].fullname}</td>
                                <td><a href="tel:${data[x].contactNumber}" class="text-third hover:underline flex gap-1"><i class="bi bi-telephone-outbound"></i></i>${data[x].contactNumber}</a></td>
                                <td><a href="mailto:${data[x].emailAddress}" class="text-third hover:underline flex gap-1"><i class="bi bi-envelope-at"></i>${data[x].emailAddress}</a></td>
                                <td>${data[x].address}</td>
                                <td>
                                    <form action="" method="post" class="flex gap-2 md:flex-row flex-col">
                                        <div class="tooltip tooltip-left" data-tip="Edit">
                                            <button type="submit" value="${data[x].contactId}" name="edit" class="btn bg-blue-400 hover:bg-blue-500"><i class="bi bi-pencil-square text-[20px]"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        `);
                    }
                }
            });
        }
    }
    // create request object
    const request = new Request();
    // sign in
    $("#signIn").click(function (e) { 
        e.preventDefault();
        request.logInUser();
    });
    // sign up
    $("#signUp").click(function (e) {
        e.preventDefault();
        request.register();
    });
    // add contacts
    $("#addContactBtn").click(function (e) { 
        e.preventDefault();
        request.createContact();
    });
    // edit contact
    $("#save").click(function (e) {
        e.preventDefault();
        request.editContact();
    });
    // delete oontact
    $("#delete").click(function (e) { 
        e.preventDefault();
        request.deleteContact();
    });
    // search contact
    $("#search").on("input", function (e) { 
        e.preventDefault();
        request.searchContact();
    });
    // reset search
    $("#resetSearch").click(function (e) { 
        e.preventDefault();
        $("#search").val("");
        request.searchContact();
    });
});
