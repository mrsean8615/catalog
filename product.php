<?php
session_start();
include 'includes/functions.php';

if (isset($_POST['add-cart'])) {
    addToCart();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/product.css" type="text/css">
    <link rel="stylesheet" href="css/cart.css" type="text/css">


    <script src="js/script.js"></script>
</head>

<body>
    <main>

        <?php if (!isset($_POST['add-cart'])) : ?>

            <?php
            if (isset($_POST['product-details'])) {
                showProduct();
            }
            ?>

        <?php else : ?>
            <div class="empty-cart" id="added">
                <h3>The product has been added to you cart.</h3>
                <a href="catalog.php"><button type='button' class="cart-emptyBtn" value="View Catalog">Continue Shopping!</button></a>
                <a href="cart.php"><button type='button' class="cart-emptyBtn" value="View Catalog">Go to Cart</button></a>
            </div>




        <?php endif; ?>
    </main>
</body>

</html>