<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles/reset_password.css">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
	<?php if (isset($errorMessage)): ?>
		<p class="error-message" style="color: red;"><?php echo $errorMessage; ?></p>
	<?php endif; ?>
	<form id="resetPasswordForm" action="../controllers/reset_password_controller.php" method="post" novalidate>
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>
		<span id="usernameError" style="color: red;"></span><br>
		<label for="new_password">New Password:</label>
		<input type="password" name="new_password" id="new_password"><br>
		<span id="passwordError" style="color: red;"></span><br>
		<button type="submit">Reset Password</button>
	</form>
  <script src="../JS/reset_password.js"></script>
</body>
</html>
