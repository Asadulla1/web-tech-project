document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('resetPasswordForm');
    form.addEventListener('submit', function(event) {
      var newPasswordInput = document.getElementById('new_password');
      var usernameInput = document.getElementById('username');

      var usernameError = document.getElementById('usernameError');
      var passwordError = document.getElementById('passwordError');

      var newPasswordValue = newPasswordInput.value.trim();
      var usernameValue = usernameInput.value.trim();

      passwordError.textContent = '';
      usernameError.textContent = '';

      if (usernameValue === '') {
        event.preventDefault(); 
        usernameError.textContent = 'username is required';
        return;
      }

      if (newPasswordValue === '') {
        event.preventDefault(); 
        passwordError.textContent = 'New password is required';
        return;
      }
    });
  });