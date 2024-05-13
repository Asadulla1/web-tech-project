<?php
session_start();

$errorMessage = isset($_SESSION['error_register']) ? $_SESSION['error_register'] : null;

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles/register.css">
  <title>Register</title>
</head>
<body>
  <h1>Register</h1>
  <?php if (isset($errorMessage)): ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
  <?php endif; ?>
  <form id="registrationForm" action="../controllers/register_controller.php" method="post" novalidate>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" ><br>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" ><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" ><br>

    <label for="role">Role:</label>
    <select name="role" id="role" >
      <option value="">Select Role</option>
      <option value="customer">Customer</option>
      <option value="employee">Employee</option>
      <option value="delivery Man">Delivery Man</option>
    </select><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" ><br>

    <label for="phone_number">Phone Number:</label>
    <input type="tel" name="phone_number" id="phone_number" ><br>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address" ><br>

    <button type="submit">Register</button>
  </form>
</body>
<script src="../JS/register.js"></script>
</html>
