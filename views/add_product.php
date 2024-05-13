<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../Styles/admin_utilites.css">
    <title>Admin Dashboard</title>
</head>
<body>

    <div class="sidebar">

        <a href="../controllers/admin_dashboard_controller.php"><h1>Admin Dashboard</h1><a>
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
		<h1 id="heading">Add New Product</h1>
		<form id="product-form" action="../controllers/add_product_controller.php" method="post" novalidate>
			<label for="name">Name:</label><br>
			<input type="text" id="name" name="name" value=""><br>
			<p id="name-error" class="error"></p>

			<label for="description">Description:</label><br>
			<textarea id="description" name="description" rows="4" cols="50"></textarea><br>
			<p id="description-error" class="error"></p>

			<label for="price">Price:</label><br>
			<input type="number" id="price" name="price" min="0" step="0.01" value=""><br>
			<p id="price-error" class="error"></p>

			<label for="category">Category:</label><br>
			<input type="text" id="category" name="category" value=""><br>
			<p id="category-error" class="error"></p>

			<label for="stock_quantity">Stock Quantity:</label><br>
			<input type="number" id="stock_quantity" name="stock_quantity" min="0" value=""><br>
			<p id="stock_quantity-error" class="error"></p>

			<button type="submit">Add Product</button>
		</form>
	</div>
	<script src="../JS/add_product.js"></script>
</body>
</html>
