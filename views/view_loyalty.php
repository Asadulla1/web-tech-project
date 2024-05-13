<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: login.php');
	exit();
}

$loyaltyInfo = [];

$loyaltyInfo = $_SESSION['loyaltyInfo'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ecommerce Store</title>
    <link rel="stylesheet" href="../styles/view_loyalty.css">
</head>
<body>
    <header>
        <h1>Great Buy</h1>
        <nav>
            <ul>
                <li><a href="../controllers/home_page_controller.php">Home</a></li>
                <li><a href="../controllers/update_user.php">Update Profile</a></li>
                <li><a href="../controllers/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
	<main>
        <div class="loyalty-info">
            <div class="username">User: <?= $_SESSION['username'] ?></div>
            <?php foreach ($loyaltyInfo as $loyal): ?>
                <div><strong>Loyalty points:</strong> <?= $loyal['loyalty_points']?></div>
                <div><strong>Discount percentage:</strong> <?= $loyal['discount_percentage']?>%</div>
                <div><strong>Expiration date:</strong> <?= $loyal['expiration_date']?></div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>
