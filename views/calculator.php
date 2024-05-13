<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AuthenticationController.php');
$authController = new AuthenticationController();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/admin_utilites.css">
	<link rel="stylesheet" href="../styles/calculator.css">
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
		<div class="expense-calculator">
		<h2 id="profile">Expense Calculator</h2>
		<form id="expense-form" novalidate>
			<label for="category1">Salary:</label>
			<input type="number" id="salary" name="salary" placeholder="Enter expense for salary"><br>

			<label for="category2">Bonus:</label>
			<input type="number" id="bonus" name="bonus" placeholder="Enter expense for bonus"><br>

			<label for="category2">Maintainance:</label>
			<input type="number" id="maintainance" name="maintainance" placeholder="Enter expense for maintainance"><br>

			<label for="category2">Tax:</label>
			<input type="number" id="tax" name="tax" placeholder="Enter expense for tax"><br>

			<button type="button" id="calculate-btn">Calculate Total Expense</button>
		</form>
		<p id="total-expense">Total Expense: $<span id="total-amount">0.00</span></p>
		</div>
    </div>
	<script src="../JS/calculator.js"></script>
</body>

</html>
