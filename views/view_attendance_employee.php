<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee') {
	header('Location: login.php');
	exit();
}

$attendances = [];

$attendances = $_SESSION['attendances'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/employee_utilities.css">
	<title>Employee Dashboard</title>
</head>

<body>

	<div class="sidebar">
		<a href="../controllers/employee_dashboard_controller.php">
			<h1>Employee Dashboard</h1>
		</a>
		<a href="../controllers/update_user.php">
			<h2>Update Profile</h2>
		</a>
		<h2>Attendance Management</h2>
		<ul>
			<li><a href="../controllers/mark_attendance_controller.php">Mark attendance</a></li>
			<li><a href="../controllers/view_attendance_employee_controller.php">View attendance</a></li>
		</ul>

		<h2>Task Management</h2>
		<ul>
			<li><a href="../controllers/report_task_controller.php">report task</a></li>
			<li><a href="#"></a></li>
		</ul>
		<a href="../controllers/employee_bonus_controller.php">
			<h2>Employee Bonus</h2>
		</a>
		<a href="../controllers/salary_sheet_controller.php">
			<h2>Salary Sheet</h2>
		</a>
		<a href="../controllers/employee_notification_controller.php">
			<h2>Notification</h2>
		</a>
		<a href="../controllers/logout.php">
			<h2>logout</h2>
		</a>
	</div>
	<div class="container">
		<h1 id="profile">Attendance History</h1>
		<table>
			<tr>
				<th>Username</th>
				<th>Date</th>
				<th>Status</th>
			</tr>
			<?php foreach ($attendances as $attendance) : ?>
				<tr>
					<td><?php echo $_SESSION['username'] ?></td>
					<td><?= $attendance['date'] ?></td>
					<td><?= $attendance['status'] ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</body>

</html>