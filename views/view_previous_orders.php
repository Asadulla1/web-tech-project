<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: login.php');
	exit();
}

$orders = [];

$orders = $_SESSION['orders'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ecommerce Store</title>
    <link rel="stylesheet" href="../styles/view_previous_orders.css">
</head>
<body>
    <header>
        <h1>Great Buy</h1>
        <nav>
            <ul>
                <li><a href="../controllers/home_page_controller.php">Home</a></li>
                <li><a href="../controllers/update_user.php">Update Profile</a></li>
                <li><a href="../controllers/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
		<table>
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Product Name</th>
					<th>Order Date</th>
					<th>Status</th>
					<th>Total Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($orders as $order): ?>
					<tr>
						<td><?= $order['order_id'] ?></td>
						<td><?= $order['product_name'] ?></td>
						<td><?= $order['order_date'] ?></td>
						<td><?= $order['status'] ?></td>
						<td><?= $order['total_amount'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
    </main>


</body>

</html>
