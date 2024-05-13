<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/update_user.css">
    <title>Edit User Information</title>

</head>

<body>

    <?php
    // Assume $userDetails is an associative array containing user information retrieved from the database
    $userDetails = array(
        'username' => $_SESSION['userinfo']['username'],
        'password' => $_SESSION['userinfo']['password'],
        'role' => $_SESSION['userinfo']['role'],
        'email' => $_SESSION['userinfo']['email'],
        'name' => $_SESSION['userinfo']['name'],
        'phone_number' => $_SESSION['userinfo']['phone_number'],
        'address' => $_SESSION['userinfo']['address']
    );
    ?>
    <div id="profile-header">
        <a href="../views/index.php">Home</a>
        <div class="header-text">Update User Profile</div>
        <a href="../controllers/logout.php">Logout</a>
    </div>
    <div id="error-message" style="color: red;"></div>
    <div class="body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="<?php echo $userDetails['username']; ?>" disabled><br>

            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" value="<?php echo $userDetails['password']; ?>"><br>

            <label for="role">Role:</label><br>
            <select id="role" name="role" disabled>
                <option value="admin" <?php if ($userDetails['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                <option value="employee" <?php if ($userDetails['role'] === 'employee') echo 'selected'; ?>>Employee</option>
                <option value="customer" <?php if ($userDetails['role'] === 'customer') echo 'selected'; ?>>Customer</option>
                <option value="delivery Man" <?php if ($userDetails['role'] === 'delivery Man') echo 'selected'; ?>>Delivery Man</option>
            </select><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $userDetails['email']; ?>"><br>

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>"><br>

            <label for="phone_number">Phone Number:</label><br>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $userDetails['phone_number']; ?>"><br>

            <label for="address">Address:</label><br>
            <textarea id="address" name="address"><?php echo $userDetails['address']; ?></textarea><br>

            <input type="submit" value="Update" onclick="return validateForm()">
        </form>
    </div>
</body>

</html>