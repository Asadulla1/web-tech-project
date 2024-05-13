<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../model/Notification.php');

$Notification = new NotificationModel();

$userId = $_COOKIE['user_id'];

$notifications = $Notification->findAllNotificationsByUserId($userId);

$_SESSION['notifications'] = $notifications;

header('Location: ../views/employee_notification.php');
exit();
?>
