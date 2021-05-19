< !--
    I certify that this submission is my own original work.
    Joe Nobile
    R01730447
    Music Database
    user_validation.js
    Javascript user validation file, used during registration.
-->

function validate(form) {
        fail = validateUsername(form.username.value)
        fail += validateEmail(form.email.value)
        fail += validatePassword(form.password.value)
        fail += validateConfirmPassword(form.password.value, form.confirm_password.value)
        if (fail === "") return true
        else { alert(fail); return false } 
    }

/*
function validateForename(field) {
    return (field === "") ? "No Forename was entered.\n" : "" 
}
*/

function validateUsername(field) {
    if (field === "") {
        return "No Username was entered.\n"
    }
    else if (field.length < 5) {
        return "Username must be at least 5 characters.\n"
    }
    else if (/[^a-zA-Z0-9_-]/.test(field)) {
        return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
    }
    return ""
}

function validatePassword(field) {
    if (field === "") {
        return "No Password was entered.\n"
    }
    else if (field.length < 6) {
        return "Passwords must be at least 6 characters.\n"
    }
    else if (! /[a-z]/.test(field) ||
        ! /[A-Z]/.test(field) ||
        ! /[0-9]/.test(field)) {
        return "Passwords require at least one lower case letter, one upper case letter, and one number.\n"
    }
    return ""
}

function validateConfirmPassword(field1, field2) {
    if (field2 === "") {
        return "You need to confirm your password.\n"
    }
    // Referenced: https://stackoverflow.com/questions/12058081/comparing-two-input-fields when
    // finding out how to compare two fields
    else if (document.getElementById('field1').value !== document.getElementById('field2').value) {
        return "Password and confirmed password do not match.\n"
    }
    return ""
}

function validateEmail(field) {
    if (field === "") {
        return "No Email was entered.\n"
    }
    else if (!((field.indexOf(".") > 0) &&
        (field.indexOf("@") > 0)) ||
        /[^a-zA-Z0-9.@_-]/.test(field)) {
        return "The Email address is invalid.\n"
    }
    return ""
}