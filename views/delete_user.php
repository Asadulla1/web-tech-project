<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$users = [];

$users = $_SESSION['users'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/admin_utilites.css">
	<link rel="stylesheet" href="../styles/delete_user.css">
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
		<h1 id="heading">Users</h1>
		<table>
			<tr>
				<th>User ID</th>
				<th>Name</th>
				<th>Username</th>
				<th>Password</th>
				<th>Role</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Address</th>
			</tr>
			<?php foreach ($users as $user): ?>
			<tr>
				<td><?= $user['user_id'] ?></td>
				<td><?= $user['name'] ?></td>
				<td><?= $user['username'] ?></td>
				<td><?= $user['password'] ?></td>
				<td><?= $user['role'] ?></td>
				<td><?= $user['email'] ?></td>
				<td><?= $user['phone_number'] ?></td>
				<td><?= $user['address'] ?></td>
				<td><button class="delete-btn" data-user-id="<?= $user['user_id'] ?>">Delete</button></td>
			</tr>
			<?php endforeach; ?>
		</table> 
    </div>
	<script src="../JS/delete_user.js"></script>
</body>
<style>

</style>
</html>
