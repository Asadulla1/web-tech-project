<?php
	session_start();
	// if (empty($_SESSION['user_id'])) {
	// 	header('Location: login.php');
	// 	exit();
	// }
	
	$role = $_SESSION['role'];
	switch ($role) {
		case "admin":
			header('Location: ../controllers/admin_dashboard_controller.php');
			break;
		case "employee":
			header('Location: ../controllers/employee_dashboard_controller.php');
			break;
		case "delivery Man":
			header('Location: ../controllers/delivery_dashboard_controller.php');
			break;
		case "customer":
			header('Location: ../controllers/home_page_controller.php');
			break;
		default:
			header('Location: login.php');
	}
	
	exit();
?>
