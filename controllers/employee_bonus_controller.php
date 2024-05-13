<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/EmployeeController.php');

$employee = new EmployeeController();

$taskNum = $employee->findNumberOfCompletedTask($_SESSION['user_id']);

$_SESSION['taskNum'] = $taskNum;

header('Location: ../views/employee_bonus.php');
exit();

?>
