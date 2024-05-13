<?php
session_start();

$products = $_SESSION['products'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/view_review.css">
    <title>My Ecommerce Store</title>

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

        <section id="productFeedback" class="section-header">
            <h2><a href="../controllers/view_review_controller.php">Product Reviews</a></h2>
        </section>

        <section id="previous-orders" class="section-header">
            <h2><a href="../controllers/view_previous_orders_controller.php">Previous Orders</a></h2>
        </section>

        <section id="loyalty-programs" class="section-header">
            <h2><a href="../controllers/view_loyalty_controller.php">Loyalty Points</a></h2>
        </section>

        <div class="flex-container">

            <div id="product-feedback" class="section-header">
                <h2>Product Reviews & Questions</h2>

                <div id="error"></div>
                <form id="review-form" novalidate>
                    <textarea id="review-text" placeholder="Write your review here..."></textarea>
                    <select id="product-id">
                        <?php foreach ($products as $product) : ?>
                            <option value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="rating">Rating:</label>
                    <select id="rating" name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <input type="hidden" value=<?php echo $_SESSION['user_id'] ?> id="user_id" />
                    <button type="submit">Submit Review</button>

                </form>
                <div id="reviews-container">
                </div>
            </div>
        </div>

    </main>
    <script src="../JS/view_review.js"></script>
</body>




</html>