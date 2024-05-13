<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../model/Notification.php');

$Notification = new NotificationModel();

$userId = $_COOKIE['user_id'];

$notifications = $Notification->findAllNotificationsByUserId($userId);

$_SESSION['notifications'] = $notifications;

header('Location: ../views/promotional_notify.php');
exit();
?>
