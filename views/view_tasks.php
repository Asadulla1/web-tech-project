<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$tasks = [];
$orders = [];
$mens = [];
$employees = [];

$tasks = $_SESSION['tasks'];

$orders = $_SESSION['orders'];

$mens = $_SESSION['mens'];

$employees = $_SESSION['employees'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/view_task.css">
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
		<h1 class="profile">Tasks</h1>
		<table id="tasks-table">
            <tr>
                <th>Task ID</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php foreach ($tasks as $task): ?>
                <tr data-task-id="<?= $task['task_id'] ?>">
                    <td><?= $task['task_id'] ?></td>
                    <td><?= $task['task_description'] ?></td>
                    <td><?= $task['due_date'] ?></td>
                    <td class="editable" data-field="status">
                        <select>
                            <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                        </select>
                    </td>
                    <td><?= $task['username'] ?></td>
                    <td><?= $task['role'] ?></td>
                    <td><button class="save-btn">Save Changes</button></td>
                </tr>
            <?php endforeach; ?>
        </table>

		<h1 class="profile">Create Task</h1>
		<form id="task-form" action="../controllers/AdminController.php" method="post" novalidate>
			<label for="task-description">Task Description:</label><br>
			<textarea id="task-description" name="task_description" rows="4" cols="50"></textarea><br><br>
			<p id="description-error" class="error-message"></p><br>

			<label for="assigned-to">Assign To:</label><br>
			<select id="assigned-to" name="assigned_to">
				<?php foreach ($employees as $employee): ?>
					<option value="<?= $employee['user_id'] ?>"><?= $employee['username'] ?></option>
				<?php endforeach; ?>
			</select><br><br>
			<p id="assigned-to-error" class="error-message"></p><br>
			<input type="hidden" name="action" value="new_task">
			<button type="submit">Create Task</button>
		</form>
		<h1 class="profile">Set Delivery</h1>
		<form id="delivery-form" action="../controllers/AdminController.php" method="post" onvalidate>
			<label for="order-id">Select Order:</label>
			<select id="order-id" name="order_id">
				<?php foreach ($orders as $order): ?>
				<option value="<?= $order['order_id'] ?>"><?= $order['name']?></option>
				<?php endforeach; ?>
			</select>
			<p id="order-id-error" class="error-message"></p>

			<label for="delivery-man">Select Delivery Man:</label>
			<select id="delivery-man" name="delivery_man_id">
				<?php foreach ($mens as $man): ?>
					<option value="<?= $man['user_id'] ?>"><?= $man['username'] ?></option>
				<?php endforeach; ?>
			</select>
			<p id="delivery-man-error" class="error-message"></p>

			<input type="hidden" name="action" value="set_delivery">
			<button type="submit">Set</button>
		</form>
    </div>
<script src="../JS/view_task.js"></script>
</body>
<style>
	
</style>
</html>
