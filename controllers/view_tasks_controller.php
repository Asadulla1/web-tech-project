<?php
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AdminController.php');

$admin = new AdminController();

$tasks = $admin->getTasksForAdmin();

$orders = $admin->getPendingOrders();

$mens = $admin->getDeliveryMen();

$employees = $admin->getAllEmployees();

$_SESSION['tasks'] = $tasks;

$_SESSION['orders'] = $orders;

$_SESSION['mens'] = $mens;

$_SESSION['employees'] = $employees;

header('Location: ../views/view_tasks.php');
exit();

?>
