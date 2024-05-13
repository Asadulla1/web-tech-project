document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('passwordResetForm');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var emailInput = document.getElementById('email');
      var emailError = document.getElementById('emailError');
      var emailValue = emailInput.value.trim();

      // Reset previous error messages
      emailError.textContent = '';

      // Check if email is empty
      if (emailValue === '') {
        event.preventDefault(); // Prevent form submission
        emailError.textContent = 'Email is required';
        return;
      }

      event.target.submit();
    });
  });