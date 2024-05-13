<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man') {
	header('location: ../views/login.php');
	exit();
}

$delivs = $_SESSION['delivs'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/delivery_utilities.css">
	<title>Delivery Dashboard</title>
	<style>
		.container {
			max-width: 800px;
			margin: 5% auto;
			padding: 20px;
			background-color: #f9f9f9;
			border: 1px solid #ddd;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		#profile {
			margin-top: 0;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
			text-align: left;
		}

		th {
			background-color: #f2f2f2;
			font-weight: bold;
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
		<h1 id="profile">Shipping Deliveries</h1>
		<table>
			<tr>
				<th>Delivery ID</th>
				<th>Product Name</th>
				<th>Status</th>
			</tr>
			<?php foreach ($delivs as $deliv) : ?>
				<tr>
					<td><?= $deliv['delivery_id'] ?></td>
					<td><?= $deliv['product_name'] ?></td>
					<td class="editable" data-field="status">
						<select>
							<option value="shipped" <?= $deliv['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
							<option value="delivered" <?= $deliv['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
						</select>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<script src="../JS/report_delivery.js"></script>
</body>


</html>