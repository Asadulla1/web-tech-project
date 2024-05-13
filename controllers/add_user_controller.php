<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate each form field
    $username = $_POST["username"];
    if (empty($username)) {
        $errors["username"] = "Username is required";
    }

    $password = $_POST["password"];
    if (empty($password)) {
        $errors["password"] = "Password is required";
    }

    $role = $_POST["role"];
    if (empty($role)) {
        $errors["role"] = "Role is required";
    }

    $email = $_POST["email"];
    if (empty($email)) {
        $errors["email"] = "Email is required";
    }

    $name = $_POST["name"];

    $phone_number = $_POST["phone_number"];

    $address = $_POST["address"];

    // If there are no validation errors, proceed to add the user
	require_once('../controllers/AdminController.php');

    if (empty($errors)) {
        $admin = new AdminController();
        $admin->addUser($name, $username, $password, $role, $email, $phone_number, $address);
        exit();
    }
}
?>
