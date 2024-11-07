
//for matching the password for correction
function validateForm() {
    const password = document.getElementById('password').value;
    const repeatPassword = document.getElementById('repeat-password').value;

    if (password !== repeatPassword) {
        alert('Passwords do not match!');
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}