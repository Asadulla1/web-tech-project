<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}
require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$userinfo = $authController->fetchUserInfo($_SESSION['username']);


require_once('../model/Attendance.php');

$attendance = new AttendanceModel();

$isMarked = $attendance->isMarkedToday($_SESSION['user_id']);

$_SESSION['userinfo'] = $userinfo;
$_SESSION['attendance'] = $attendance;
$_SESSION['isMarked'] = $isMarked;

header('Location: ../views/mark_attendance.php');
exit();

?>
