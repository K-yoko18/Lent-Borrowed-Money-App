function checkPasswords() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false; // This will prevent the form from being submitted
    }

    return true; // This will allow the form to submit
}
