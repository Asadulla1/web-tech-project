<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer') {
    header('Location: login.php');
    exit();
}


$products = [];

$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ecommerce Store</title>
    <link rel="stylesheet" href="../styles/customer_utilities.css">
    <link rel="stylesheet" href="../styles/view_cart.css">
</head>

<body>

    <header>
        <h1>Great Buy</h1>
        <nav>
            <ul>
                <li><a href="../controllers/home_page_controller.php">Home</a></li>
                <li><a href="../controllers/update_user.php">Update Profile</a></li>
                <li><a href="#">About</a></li>
                <li><a href="../controllers/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="filter-sort">
            <h2>Filter and Sort</h2>
            <form id="price-filter-form">
                <label for="min-price">Min Price:</label>
                <input type="number" id="min-price" name="min-price" min="0"><br>
                <label for="max-price">Max Price:</label>
                <input type="number" id="max-price" name="max-price" min="0">
                <button type="submit">Filter</button>
            </form>
        </section>
        <section id="product-search">
            <h2>Product Search</h2>

            <form id="search-form" action="#" method="GET">
                <input type="text" id="search-input" name="search" placeholder="Search products...">
                <button type="submit">Search</button>
            </form>
        </section>

        <section id="shopping-cart" class="section-header">
            <h2><a href="../controllers/view_cart_controller.php">Shopping Cart</a></h2>
        </section>


        <section id="product-feedback" class="section-header">
            <h2><a href="../controllers/view_review_controller.php">Product Reviews</a></h2>
        </section>

        <section id="previous-orders" class="section-header">
            <h2><a href="../controllers/view_previous_orders_controller.php">Previous Orders</a></h2>
        </section>

        <section id="loyalty-programs" class="section-header">
            <h2><a href="../controllers/view_loyalty_controller.php">Loyalty Points</a></h2>
        </section>

        <h2 id="actual-header">Shopping Cart</h2>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['order_id'] ?></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['order_date'] ?></td>
                        <td><?= $product['status'] ?></td>
                        <td><?= $product['total_amount'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 Great Buy. All rights reserved.</p>
    </footer>

</body>



</html>