// script.js
function validateForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (email.trim() === "" || password.trim() === "") {
        alert("Please fill in all fields.");
        return false;
    }

    return true;
}

function validateRegister() {
    var email = document.getElementById("reg-email").value;
    var password = document.getElementById("reg-password").value;
    var confirmPassword = document.getElementById("reg-confirm-password").value;

    if (email.trim() === "" || password.trim() === "" || confirmPassword.trim() === "") {
        alert("Please fill in all fields.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return false;
    }

    return true;
}
