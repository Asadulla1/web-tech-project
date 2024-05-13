document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('registrationForm');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var name = document.getElementById('name');
      var username = document.getElementById('username');
      var password = document.getElementById('password');
      var role = document.getElementById('role');
      var email = document.getElementById('email');
      var phone_number = document.getElementById('phone_number');
      var address = document.getElementById('address');
  
      var isValid = true;
  
      var errorMessages = document.querySelectorAll('.error-message');
      errorMessages.forEach(function(errorMessage) {
        errorMessage.textContent = '';
      });
  
      if (name.value.trim() === '') {
        showError(name, 'Name is required');
        isValid = false;
        return;
      }
  
      if (username.value.trim() === '') {
        showError(username, 'Username is required');
        isValid = false;
        return;
      }
  
      // Password must contain at least one lowercase letter, one uppercase letter, one special character, and be at least 8 characters long
      var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/;
      // Email validation regex
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
      if (!passwordRegex.test(password.value)) {
        showError(password, 'Password must contain at least one lowercase letter, one uppercase letter, one special character, and be at least 8 characters long');
        isValid = false;
        return;
      }
  
      if (role.value === '') {
        showError(role, 'Please select a role');
        isValid = false;
        return;
      }
  
      if (!emailRegex.test(email.value)) {
        showError(email, 'Try with a valid email');
        isValid = false;
        return;
      }
  
      if (email.value.trim() === '') {
        showError(email, 'Email is required');
        isValid = false;
        return;
      }
  
      if (phone_number.value.trim() === '') {
        showError(phone_number, 'Phone Number is required');
        isValid = false;
        return;
      }
  
      if (address.value.trim() === '') {
        showError(address, 'Address is required');
        isValid = false;
        return;
      }
  
      if (isValid) {
        form.submit();
      }
    });
  
      function showError(input, message) {
          var parent = input.parentElement;
          var errorMessage = parent.querySelector('.error-message');
  
          if (!errorMessage) {
              errorMessage = document.createElement('span');
              errorMessage.className = 'error-message';
              parent.appendChild(errorMessage);
          }
  
          errorMessage.textContent = message;
      }
  });