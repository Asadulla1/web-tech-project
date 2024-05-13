<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}


$absent = $_SESSION['absent'];

$completed_tasks = $_SESSION['completed_tasks'];

$salary = $_SESSION['salary'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/employee_utilities.css">
    <title>Employee Dashboard</title>
	<style>
	
	body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .title {
            text-align: center;
            color: #333;
        }
        .info {
            margin-bottom: 10px;
        }
        .info label {
            font-weight: bold;
            color: #555;
        }
        .info span {
            color: #333;
        }
        .total {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
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
        <h1 class="title">Salary Sheet</h1>
        <div class="info">
            <label>Absent:</label>
            <span><?= $absent ?></span>
        </div>
        <div class="info">
            <label>Completed Tasks:</label>
            <span><?= $completed_tasks ?></span>
        </div>
        <div class="info">
            <label>Salary:</label>
            <span>$<?= number_format($salary, 2) ?></span>
        </div>
        <div class="info">
            <label>Deductions (Absent):</label>
            <span>$<?= number_format($absent * 30, 2) ?></span>
        </div>
        <div class="info">
            <label>Additions (Completed Tasks):</label>
            <span>$<?= number_format($completed_tasks * 50, 2) ?></span>
        </div>
        <div class="total">
            Total Amount: $<?= number_format($salary + ($completed_tasks * 50) - ($absent * 30), 2) ?>
        </div>
    </div>
</body>

</html>
