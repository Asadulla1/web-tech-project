function validateForm(event) {
    event.preventDefault();

    var usernameInput = document.getElementById('username');
    var passwordInput = document.getElementById('password');

    var usernameValue = usernameInput.value.trim();
    var passwordValue = passwordInput.value.trim();

    var usernameError = document.getElementById('username-error');
    var passwordError = document.getElementById('password-error');

    usernameError.textContent = '';
    passwordError.textContent = '';

    if (usernameValue === '') {
      usernameError.textContent = 'Please enter a username';
      usernameInput.focus(); 
      return false; 
    }

    // Check if password is empty
    if (passwordValue === '') {
      passwordError.textContent = 'Please enter a password';
      passwordInput.focus(); 
      return false; 
    }


    event.target.submit();
  }


  document.querySelector('form').addEventListener('submit', validateForm);