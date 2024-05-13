<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$reviews = $_SESSION['reviews'];
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
		<h1 id="heading">Feedback</h1>
		<table id="feedback-table">
			<tr>
				<th>Product</th>
				<th>Username</th>
				<th>Rating</th>
				<th>Comment</th>
				<th>Date</th>
				
			</tr>
			<?php foreach ($reviews as $review): ?>
				<tr data-feedback-id="<?= $review['feedback_id'] ?>">
					<td><?= $review['product_name'] ?></td>
					<td><?= $review['username'] ?></td>
					<td class="editable" data-field="rating"><?= $review['rating'] ?></td>
					<td class="editable" data-field="comment"><?= $review['comment'] ?></td>
					<td><?= $review['date'] ?></td>
					
				</tr>
			<?php endforeach; ?>
		</table>
    </div>
	
</body>

</style>
</html>
