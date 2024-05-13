<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$products = $_SESSION['products'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/admin_utilites.css">
    <title>Admin Dashboard</title>
</head>
<body>

    <div class="sidebar">

        <a href="../controllers/admin_dashboard_controller.php"><h1>Admin Dashboard</h1><a/>
        <h2>Product Management</h2>
        <ul>
            <li><a href="add_product.php">Add Product</a></li>
			<li><a href="../controllers/delete_product_controller.php">Delete Product</a></li>
            <li><a href="../controllers/edit_product_controller.php">Edit Product</a></li>
            <li><a href="../controllers/view_products_controller.php">View Products</a></li>
        </ul>

		<h2>User Management</h2>
        <ul>
            <li><a href="add_user.php">Add User</a></li>
            <li><a href="../controllers/delete_user_controller.php">Delete User</a></li>
            <li><a href="../controllers/edit_user_controller.php">Edit User</a></li>
            <li><a href="../controllers/view_users_controller.php">View Users</a></li>
        </ul>
		<h2>Work Management</h2>
        <ul>
            <li><a href="../controllers/view_tasks_controller.php">tasks</a></li>
            <li><a href="../controllers/view_attendence_controller.php">attendance</a></li>
        </ul>
		<a href="calculator.php"><h2>Calculator</h2></a>
		<a href="../controllers/view_orders_controller.php"><h2>Orders</h2></a>
		<a href="../controllers/review_admin_controller.php"><h2>Reviews</h2></a>
		<a href="../controllers/logout.php"><h2>Logout</h2></a>
    </div>
    <div class="container">
		<h1 id="heading">Products</h1>
		<table id="product-table">
			<tr>
				<th>Product ID</th>
				<th>Name</th>
				<th>Total Amount</th>
				<th>Discount Percentage</th>
				<th>Order Status</th>
				<th>Action</th>
			</tr>

			<?php foreach ($products as $product): ?>
				<tr data-product-id="<?= $product['product_id'] ?>">
					<td><?= $product['product_id'] ?></td>
					<td class="editable" data-field="name"><?= $product['product_name'] ?></td>
					<td class="editable" data-field="total_amount" id="total_amount"><?= $product['total_amount'] ?></td>
					<td class="editable" data-field="discount_percentage" contenteditable="true"><?= $product['discount_percentage'] ?></td>
					<td class="editable" data-field="order_status"><?= $product['order_status'] ?></td>
					<td><button class="save-btn" data-product-id="<?= $product['product_id'] ?>">Edit</button></td>
				</tr>
			<?php endforeach; ?>
    	</table> 
	</div>
	<script src="../JS/view_orders.js"></script>
</body>

</html>
