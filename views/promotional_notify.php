<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man') {
	header('Location: login.php');
	exit();
}

$notifications = [];

$notifications = isset($_SESSION['notifications']) ? $_SESSION['notifications'] : null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/delivery_utilities.css">
	<title>Delivery Dashboard</title>
	<style>
		.notification {
			background-color: #f0f0f0;
			border-radius: 5px;
			padding: 10px;
			margin-bottom: 10px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		}

		.notification p {
			margin: 0;
			font-size: 16px;
			color: #333;
		}
	</style>
</head>

<body>
	<div class="sidebar">

		<a href="../controllers/delivery_dashboard_controller.php">
			<h1>Delivery Dashboard</h1>
		</a>
		<a href="../controllers/update_user.php">
			<h2>Update Profile</h2>
		</a>
		<h2>Order Details</h2>
		<ul>
			<li><a href="../controllers/pending_orders_controller.php">pending orders</a></li>
		</ul>

		<h2>Earning Tracker</h2>
		<ul>
			<li><a href="../controllers/updated_payroll_controller.php">updated payroll</a></li>
		</ul>
		<h2>Delivery Management</h2>
		<ul>
			<li><a href="../controllers/report_delivery_controller.php">report delivery</a></li>
		</ul>
		<a href="../controllers/customer_review_controller.php">
			<h2>Customer Reviews</h2>
		</a>
		<a href="../controllers/promotional_notify_controller.php">
			<h2>Promotional Notifications</h2>
		</a>
		<a href="../controllers/logout.php">
			<h2>Logout</h2>
		</a>
	</div>

	<div class="container">
		<h1 id="profile">Promotional Notifications</h1>
		<?php foreach ($notifications as $notify) : ?>
			<div class="notification">
				<p><?= $notify['message'] ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</body>


</html>