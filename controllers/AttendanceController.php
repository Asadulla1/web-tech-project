<?php
require_once('../model/Attendance.php');
session_start();

$attendanceModel = new AttendanceModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'mark_attendance') {
	$attendanceModel->markAttendanceByUserId($_SESSION['user_id']);
	return "sucess";
}

?>
