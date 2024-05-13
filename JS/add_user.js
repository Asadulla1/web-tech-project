document.addEventListener('DOMContentLoaded', function() {
    let form = document.getElementById('myForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if (validateForm()) {
            form.submit();
        }
    });

    function validateForm() {
        let usernameInput = document.getElementById('username');
        let passwordInput = document.getElementById('password');
        let roleInput = document.getElementById('role');
        let emailInput = document.getElementById('email');

        let usernameValue = usernameInput.value.trim();
        let passwordValue = passwordInput.value.trim();
        let roleValue = roleInput.value;
        let emailValue = emailInput.value.trim();

        if (usernameValue === '') {
            document.getElementById('usernameError').textContent = 'Please enter a username.';
            return false;
        } else {
            document.getElementById('usernameError').textContent = '';
        }

        if (passwordValue === '') {
            document.getElementById('passwordError').textContent = 'Please enter a password.';
            return false;
        } else {
            document.getElementById('passwordError').textContent = '';
        }

        if (roleValue === '') {
            document.getElementById('roleError').textContent = 'Please select a role.';
            return false;
        } else {
            document.getElementById('roleError').textContent = '';
        }

        if (emailValue === '') {
            document.getElementById('emailError').textContent = 'Please enter an email address.';
            return false;
        } else {
            document.getElementById('emailError').textContent = '';
        }

        return true;
    }
});