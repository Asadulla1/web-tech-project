function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;
    var name = document.getElementById('name').value;
    var phoneNumber = document.getElementById('phone_number').value;
    var address = document.getElementById('address').value;

    var errorMessage = document.getElementById('error-message');
    errorMessage.innerHTML = '';

    if (!username || !password || !email || !name || !phoneNumber || !address) {
        errorMessage.innerHTML = "All fields are required";
        return false;
    }

    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        errorMessage.innerHTML = "Invalid email address";
        return false;
    }



    return true;
}