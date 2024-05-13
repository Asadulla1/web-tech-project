<?php
session_start();

$errorMessage = isset($_SESSION['error_email']) ? $_SESSION['error_email'] : null;


?>
<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
	<link rel="stylesheet" href="../styles/forget_password.css">
</head>
<body>
    <h1>Forget Password</h1>
	<?php if (isset($errorMessage)): ?>
		<p class="error-message" style="color: red;"><?php echo $errorMessage; ?></p>
	<?php endif; ?>
	<form id="passwordResetForm" action="../controllers/forget_password_controller.php" method="post" novalidate>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email"><br>
		<span id="emailError" style="color: red;"></span><br>
		<button type="submit">Reset Password</button>
	</form>
	<script src="../JS/forget_password.js"></script>
</body>


</html>
