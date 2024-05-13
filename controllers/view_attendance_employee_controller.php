<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: ../views/login.php');
	exit();
}
require_once('../controllers/AuthenticationController.php');

require_once('../model/Attendance.php');

$model = new AttendanceModel();


$attendances = [];

$attendances = $model->getAttendanceHistoryByUserId($_SESSION['user_id']);

$_SESSION['attendances'] = $attendances;

header('Location: ../views/view_attendance_employee.php');
exit();

?>
