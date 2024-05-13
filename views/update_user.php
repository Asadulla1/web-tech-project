<?php
   session_start();
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/update_user.css">
    <title>Edit User Information</title>

</head>

<body>

    
    <div id="profile-header">
        <a href="../views/index.php">Home</a>
        <div class="header-text">Update User Profile</div>
        <a href="../controllers/logout.php">Logout</a>
    </div>
    <!-- <div id="error-message" style="color: red;"></div> -->
    <div class="body">
        <form id="user-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $userDetails['username']; ?>" disabled><br>
         
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $userDetails['email']; ?>"><br>
            <span id="email-error" class="error"></span><br>

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>"><br>
            <span id="name-error" class="error"></span><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value="<?php echo $userDetails['password']; ?>"><br>
            <span id="pass-error" class="error"></span><br>

            <label for="phone_number">Phone Number:</label><br>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $userDetails['phone_number']; ?>"><br>
            <span id="phone_number-error" class="error"></span><br>

            <label for="address">Address:</label><br>
            <textarea id="address" name="address"><?php echo $userDetails['address']; ?></textarea><br>
            <span id="address-error" class="error"></span><br>

            <input type="submit" value="Update">
        </form>
    </div>
    <script src="../JS/validate_user.js"></script>
</body>

</html>