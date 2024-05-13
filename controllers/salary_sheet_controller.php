<?php

session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}

require_once('../model/Attendance.php');
require_once('../model/Task.php');
require_once('../model/Salary.php');

$attendance = new AttendanceModel();
$task = new TaskModel();
$salaryModel = new SalaryModel();

$userId = $_SESSION['user_id'];

$absent = $attendance->getNumberOfAbsenceByUserId($userId);

$completed_tasks = count($task->getCompletedTasksByUserId($userId));

$salary_amount = $salaryModel->findSalaryById($userId);

$_SESSION['salary'] = $salary_amount;

$_SESSION['absent'] = $absent;

$_SESSION['completed_tasks'] = $completed_tasks;

header('Location: ../views/salary_sheet.php');
exit();
?>
