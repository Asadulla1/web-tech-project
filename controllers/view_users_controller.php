
<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$users = [];

$users = $authController->getAllUsers();

$_SESSION['users'] = $users;

header('Location: ../views/view_users.php');
exit();

?>
