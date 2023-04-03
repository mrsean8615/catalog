<?php
session_start();
include 'includes/functions.php';


if (isset($_POST['update'])) {
    for ($x = 0; $x < sizeof($_SESSION['qty']); $x++) {
        $_SESSION['qty'][$x] = $_POST['qty' . $x . ''];
    }
}
if (isset($_POST['order'])) {
    if (checkFunds() === true) {
        header('location: ?&broke=true');
    } else {
        removeFunds();
        updateBells();
    }
}
if (isset($_GET['broke'])) {
    if ($_GET['broke'] == 'true') {
        echo "
        <div class='nook-advice'>
        <div class='box'>
            <div class='advice'>
                <p style='font-size: 23px;'>You're a little too broke to afford that. Have you tried the super secret bell generator?</p>
            </div>
        </div>
        <div class='right-point'></div>

        <img src='img/tom-nook-creep.png' class='nook'>
    </div>
        ";
    }
}


if (isset($_SESSION['price'])) {
    $cartStatus = false;
} else $cartStatus = true;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/catalog.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" href="css/product.css" type="text/css">

    <link rel="stylesheet" href="css/cart.css" type="text/css">

    <script src="js/script.js"></script>
</head>

<body>
    <?php include_once('includes/nav.php'); ?>
    <main>
        <?php if (!$cartStatus) : ?>
            <?php if (!isset($_POST['order'])) : ?>
                <?php $total = 0; ?>
                <form action="" method="post" class="cart-container">
                    <?php for ($x = 0; $x < sizeof($_SESSION['productID']); $x++) { ?>
                        <div class="prod-cart-container">
                            <?php echo "<img class='cart-img' src='img/" . $_SESSION['image'][$x] . "' >"; ?>
                            <div class="prod-info-container">
                                <h3><?php echo $_SESSION['name'][$x]; ?></h3>
                                <p class="cart-product-price">PRICE: <?php echo number_format($_SESSION['price'][$x]); ?> <img class="bell-price" src="img/bell-bag.png"></p>
                                <input name="qty<?php echo $x; ?>" type="number" id="cartQty" min="1" class="qty-field" value="<?php echo $_SESSION['qty'][$x]; ?>" required>
                                <span class="fieldQty">QTY:</span>
                                <p class="product-total">TOTAL PRICE: <?php $sessQ = $_SESSION['qty'][$x] * $_SESSION['price'][$x]; echo number_format($sessQ); ?> <img class="bell-price" src="img/bell-bag.png"></p>
                                <?php $total += $_SESSION['qty'][$x] * $_SESSION['price'][$x];
                                $_SESSION['total'] = $total;
                                ?>
                            </div>
                        </div>

                    <?php  }

                    ?>
                    <h3 class="cart-title">CART TOTAL: <?php echo number_format($total); ?> <img class="bell-price" src="img/bell-bag.png"></h3>
                    <div class="place-order">
                        <input type="submit" name="order" value="Place Order" class="orderBtn">
                        <input type='submit' value="update" name="update" class="orderBtn">
                    </div>
                </form>


            <?php else : ?>
                <?php $total = 0; ?>
                <h3 class="welcome">Thanks for Buying!</h3>
                <form action="" method="post" class="cart-container">
                    <h3 class="welcome">Order Summary:</h3>

                    <?php for ($x = 0; $x < sizeof($_SESSION['productID']); $x++) { ?>
                        <div class="prod-cart-container" id="order-sum">
                            <?php echo "<img class='cart-img' src='img/" . $_SESSION['image'][$x] . "' >"; ?>
                            <div class="prod-info-container">
                                <h3><?php echo $_SESSION['name'][$x]; ?></h3>
                                <p class="cart-product-price">PRICE: <?php echo number_format($_SESSION['price'][$x]); ?> <img class="bell-price" src="img/bell-bag.png"></p>
                                <span class="fieldQty">QTY: <?php echo $_SESSION['qty'][$x] ?></span>
                                <p class="product-total">TOTAL PRICE: <?php $sessQ = $_SESSION['qty'][$x] * $_SESSION['price'][$x]; echo number_format($sessQ); ?> <img class="bell-price" src="img/bell-bag.png"></p>
                                <?php $total += $_SESSION['qty'][$x] * $_SESSION['price'][$x];
                                $_SESSION['total'] = $total;
                                ?>
                            </div>
                        </div>

                    <?php  }

                    ?>
                    <h3 class="welcome">ORDER TOTAL: <?php echo number_format($total); ?> <img class="bell-price" src="img/bell-bag.png"></h3>
                    <div class="place-order" id="order-sumBtn">
                        <a href="catalog.php"><button type='button' value="View Catalog" class="orderBtn">View Catalog</button></a>
                        <a href="logout.php"><button type='button' value="Logout" class="orderBtn">Logout</button></a>
                    </div>

                    <?php
                    if (checkFunds() === true) {
                    } else {
                        clearCart();
                    };
                    ?>
                </form>
            <?php endif; ?>

            </form>
        <?php else : ?>
            <div class="empty-cart">
            <h3 id="cart-empty">Your Cart is empty</h3>

                <a href="catalog.php"><button type='button' class="cart-emptyBtn" value="View Catalog">Start Shopping!</button></a>
            </div>
        <?php endif; ?>


    </main>
</body>

</html>