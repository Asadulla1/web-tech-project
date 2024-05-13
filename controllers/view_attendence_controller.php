<?php
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AdminController.php');
$admin = new AdminController();

$attendances = $admin->getAttendanceForAdmin();

$_SESSION['attendances'] = $attendances;

header('Location: ../views/view_attendence.php');
exit();

?>
