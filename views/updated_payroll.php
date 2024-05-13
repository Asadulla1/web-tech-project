<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: login.php');
	exit();
}

$delivNum = $_SESSION['delivNum'];
$earningsPerDelivery = 30;
$totalEarnings = $delivNum * $earningsPerDelivery;

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
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile {
            text-align: center;
            color: #333;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info p {
            margin: 0;
            font-size: 16px;
            color: #555;
        }
        .bonus {
            font-size: 24px;
            color: #007bff;
        }
	</style>
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
        <h1 class="profile">Today's Earnings</h1>
        <div class="info">
            <p>Total Delivery:</p>
            <p><?= $delivNum ?></p>
        </div>
        <div class="info">
            <p>Earnings per Delivery:</p>
            <p>$<?= $earningsPerDelivery ?></p>
        </div>
        <div>
            <p>Total Earnings:</p>
            <p class="bonus">$<?= $totalEarnings ?></p>
        </div>
    </div>
</body>
</html>
