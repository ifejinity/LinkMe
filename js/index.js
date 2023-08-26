$(document).ready(function () {
    // show register form
    $("#registerHere").click(function () { 
        sessionStorage.mode = "register";
        checkMode();
    });
    //show sign in form
    $("#signInHere").click(function () { 
        sessionStorage.mode = "signin";
        checkMode();
    });
    // check mode function
    function checkMode() {
        if(sessionStorage.mode == null || sessionStorage.mode == "register"){
            $("#formRegistration").addClass("flex").removeClass("hidden");
            $("#formSignIn").addClass("hidden").removeClass("flex");
        } else {
            $("#formSignIn").addClass("flex").removeClass("hidden");
            $("#formRegistration").addClass("hidden").removeClass("flex");
        }
    }
    // run checkmode on reload
    checkMode();
});