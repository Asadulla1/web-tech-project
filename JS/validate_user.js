document
  .getElementById("user-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    clearErrors();

    let isValid = true;

    const email = document.getElementById("email").value.trim();
    if (email === "" || !isValidEmail(email)) {
      isValid = false;
      document.getElementById("email-error").textContent =
        "Valid email is required";
      document.getElementById("email-error").style.color = "red";
    }

    const name = document.getElementById("name").value.trim();
    if (name === "") {
      isValid = false;
      document.getElementById("name-error").textContent = "Name is required";
      document.getElementById("name-error").style.color = "red";
    }

    const phone_number = document.getElementById("phone_number").value.trim();
    if (phone_number === "" || !isValidPhoneNumber(phone_number)) {
      isValid = false;
      document.getElementById("phone_number-error").textContent =
        "Valid phone number is required";
      document.getElementById("phone_number-error").style.color = "red";
    }

    const address = document.getElementById("address").value.trim();
    if (address === "") {
      isValid = false;
      document.getElementById("address-error").textContent =
        "Address is required";
      document.getElementById("address-error").style.color = "red";
    }

    const password = document.getElementById("password").value.trim();
    if (password === "" || !isPasswordValid(password)) {
      isValid = false;
      document.getElementById("pass-error").textContent =
        "Must include at least 6 characters including one digit and one special character";
      document.getElementById("pass-error").style.color = "red";
    }

    if (isValid) {
      event.target.submit();
    }
  });

function clearErrors() {
  const errorElements = document.querySelectorAll(".error");
  errorElements.forEach(function (element) {
    element.textContent = "";
    element.style.color = ""; // Reset color to default
  });
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhoneNumber(phone_number) {
  const phoneRegex = /^\d{11}$/;
  return phoneRegex.test(phone_number);
}

function isPasswordValid(password) {
  const passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{}|;':",.<>?]).{6,}$/;
  return passwordRegex.test(password);
}
