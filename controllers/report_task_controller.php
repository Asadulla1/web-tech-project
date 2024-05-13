<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/EmployeeController.php');

$employee = new EmployeeController();

$tasks = $employee->getTasksByUserId($_SESSION['user_id']);

$_SESSION['tasks'] = $tasks;

header('Location: ../views/report_task.php');
exit();

?>
