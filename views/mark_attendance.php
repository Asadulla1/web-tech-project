<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}


$userinfo = $_SESSION['userinfo'];

$attendance = $_SESSION['attendance'];

$isMarked = $_SESSION['isMarked'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/employee_utilities.css">
    <title>Employee Dashboard</title>
	<style>
		.mark-attendance-btn {
        padding: 10px 20px;
        background-color: #f9a054;
		margin-top: 1%;
		margin-left: 40%;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .mark-attendance-btn:hover {
        background-color: #e2a622;
    }
#title {
	font-size: 2em;
	padding: 10px;
	margin-left: 39%;
}
	</style>
</head>
<body>

    <div class="sidebar">
		<a href="../controllers/employee_dashboard_controller.php"><h1>Employee Dashboard</h1></a>
		<a href="../controllers/update_user.php"><h2>Update Profile</h2></a>
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
		<a href="../controllers/employee_bonus_controller.php"><h2>Employee Bonus</h2></a>
		<a href="../controllers/salary_sheet_controller.php"><h2>Salary Sheet</h2></a>
		<a href="../controllers/employee_notification_controller.php"><h2>Notification</h2></a>
		<a href="../controllers/logout.php"><h2>logout</h2></a>
    </div>
    <div class="container">
		<h1 id="profile">User Profile</h1>
		<table>
			<tr>
				<th>User ID</th>
				<th>Username</th>
				<th>Password</th>
				<th>Role</th>
				<th>Email</th>
				<th>Name</th>
				<th>Phone Number</th>
				<th>Address</th>
			</tr>
			<tr>
				<td><?= $userinfo['user_id'] ?></td>
				<td><?= $userinfo['username'] ?></td>
				<td><?= $userinfo['password'] ?></td>
				<td><?= $userinfo['role'] ?></td>
				<td><?= $userinfo['email'] ?></td>
				<td><?= $userinfo['name'] ?></td>
				<td><?= $userinfo['phone_number'] ?></td>
				<td><?= $userinfo['address'] ?></td>
			</tr>
		</table>
		<h3 id="title">Attendance</h3>
		<?php
			if ($isMarked) {
				?>
				<button class="mark-attendance-btn">Marked</button>
			<?php
				
			} else {
			?>
				<button id="mark" class="mark-attendance-btn">Mark Attendance</button>
		<?php
			}
		?>
    </div>
	<script src="../JS/marked_attandance.js"></script>
</body>


</html>
