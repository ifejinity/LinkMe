$(document).ready(function () {
    // show button group proceed
    $("#btnAdd").click(function () { 
        $(this).addClass("hidden");
        $("#addContact").addClass("flex").removeClass("hidden");
    });
     // hide button group proceed
    $("#hideAddContact").click(function () { 
        $("#addContact").addClass("hidden").removeClass("flex");
        $("#btnAdd").removeClass("hidden");
    });
    // show add contact modal
    $("#showAddModal").click(function () { 
        $("#addModal").removeClass("hidden").addClass("flex");
    });
    // hide add contact modal
    $("#hideAddModal").click(function () { 
        $("#addModal").removeClass("flex").addClass("hidden");
    });
});