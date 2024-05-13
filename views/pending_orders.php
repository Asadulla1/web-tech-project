<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: login.php');
	exit();
}

$orders = $_SESSION['orders'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/pending_orders.css">
    <title>Delivery Dashboard</title>
</head>
<body>
    <div class="sidebar">

        <a href="../controllers/delivery_dashboard_controller.php"><h1>Delivery Dashboard</h1></a>
		<a href="../controllers/update_user.php"><h2>Update Profile</h2></a>
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
        <a href="../controllers/customer_review_controller.php"><h2>Customer Reviews</h2></a>
        <a href="../controllers/promotional_notify_controller.php"><h2>Promotional Notifications</h2></a>
        <a href="../controllers/logout.php"><h2>Logout</h2></a>
    </div>
    <div class="container">
		<h1 id="profile">Order Details</h1>
		<table>
			<tr>
				<th>customer</th>
				<th>phone_number</th>
				<th>address</th>
				<th>product</th>
				<th>price</th>
			</tr>
			<?php foreach ($orders as $order): ?>
			<tr>
				<td><?= $order['name'] ?></td>
				<td><?= $order['phone_number'] ?></td>
				<td><?= $order['address'] ?></td>
				<td><?= $order['product_name'] ?></td>
				<td><?= $order['price'] ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
    </div>
</body>
<style>
	
</style>
</html>
