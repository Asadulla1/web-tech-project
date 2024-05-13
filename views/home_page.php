<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: login.php');
	exit();
}

$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/customer_utilities.css">
    <title>My Ecommerce Store</title>
</head>
<body>

    <header>
        <h1>Great Buy</h1>
        <nav>
            <ul>
                <li><a href="../controllers/home_page_controller.php">Home</a></li>
                <li><a href="../controllers/update_user.php">Update Profile</a></li>
                <li><a href="../controller/update_user.php">About</a></li>
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

		<?php foreach ($products as $product): ?>
			<section class="product">
				<h2><?= $product['name'] ?></h2>
				<p>Description: <?= $product['description'] ?></p>
				<p class="price">Price: $<?= $product['price'] ?></p>
				<p>Category: <?= $product['category'] ?></p>
				<p class="stock-quantity">Stock Quantity: <?= $product['stock_quantity'] ?></p>

				<form action="#" method="post">
					<input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <input type="hidden" name="username" value="<?php echo $_SESSION["username"]; ?>" id="username">
					<button type="submit" name="add_to_cart">Add to Cart</button>
				</form>
			</section>
		<?php endforeach; ?>
    </main>

    <footer>
        <p>&copy; 2024 Great Buy. All rights reserved.</p>
    </footer>

</body>

<script src="../JS/home_page.js">
  
</script>

</html>