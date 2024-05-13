<?php
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AdminController.php');

$adminController = new AdminController();

$users = [];

$users = $adminController->fetchAllUsers();

$_SESSION['users'] = $users;

header('Location: ../views/edit_user.php');
exit();

?>
