<?php
session_start();

$errorMessage = isset($_SESSION['error_login']) ? $_SESSION['error_login'] : null;

?>
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
  <h1>Login</h1>
  <?php if (isset($errorMessage)) : ?>
    <p id="error-message" style="color: red;"><?php echo $errorMessage; ?></p>
  <?php endif; ?>
  <form action="../controllers/login_controller.php" method="post" novalidate>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>">
    <span id="username-error" style="color: red;"></span><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <span id="password-error" style="color: red;"></span><br>

    <button type="submit">Login</button> 
    <div class="reg_fg_login">
    <a href="register.php">Register</a> <br>
    <a id="fg_pass" href="forget_password.php">Forgot password</a>
    </div>
  </form>
</body>

</html>