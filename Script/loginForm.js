/*
This Script has functionality for the login/registration modals and input validation for login/registration.
Script needs to wait until all DOMs objects are loaded in.
 */
$(document).ready(function() {
// Get the modal
    var loginModal = document.getElementById('id01');
    var registerModal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == loginModal) {
            loginModal.style.display = "none";
        } else if (event.target == registerModal) {
            registerModal.style.display = "none";
        }
    }

/*
    var password = document.getElementsByName('regPsw')[0],
        confirm_password = document.getElementsByName('regConfirmPsw')[0];

    function validatePassword() {
        if (password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity(''); // Must have this or the popup will permanently block
        }
        if (password.value.length < 8) {
            password.setCustomValidity("Passwords must be atleast 8 characters long. That's all I ask for okay?");
        } else {
            password.setCustomValidity(''); // Must have this or the popup will permanently block
        }
    }

    password.oninput = validatePassword;
    confirm_password.oninput = validatePassword;
*/


    $("#registerForm").submit(function(e){
        if ($('[name=regPsw]').val() != $('[name=regConfirmPsw]').val()) {
            //$('[name=regConfirmPsw]').get(0).setCustomValidity("Passwords Don't Match");
            alert("Passwords don't match");
            e.preventDefault(e);
        } else {
            //$('[name=regConfirmPsw]').get(0).setCustomValidity('');   // setCustomValidity has issues in chrome
        }
    });
});
