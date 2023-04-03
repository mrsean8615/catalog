<?php
include_once('includes/functions.php');
$repeatUsrmsg = '';
$granted = false;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    if (repeatUsername($username) !== false) {
        $repeatUsrmsg = 'This Username is already Taken';
        $granted = false;
    } else {
        insertData();
        $granted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" href="css/cart.css" type="text/css">


    <script defer src="js/script.js"></script>
</head>

<body>
    <main>
        <?php if (!$granted) : ?>
            <form action="" method="post">

                <h2>Create an Account:</h2>
                <div class="login-form">
                    <label for="name" class="form-label">| Username:</label>
                    <input class="form-field" type="text" name="username" id="username" placeholder="Username"><span class="uimsg" id="uimsg3"><?php echo $repeatUsrmsg; ?></span>
                    <label for="name" class="form-label">| Password:</label>
                    <input class="form-field" id="form-pass" type="password" name="password" placeholder="Password"><span class="uimsg" id="uimsg"></span>
                    <label for="name" class="form-label">| Verify Password:</label>
                    <input id="form-vpass" class="form-field" type="password" name="password" placeholder="Verify Password"><span class="uimsg" id="uimsg2"></span>

                </div>
                <input type="submit" class="create-form-button" name="submit" value="Create Account" id="left" disabled>
                <input type="reset" class="create-form-button" name="reset" value="Reset" id="right">
                <a href="index.php" class="have-account"><span class="have-account">Already Have an Account?</span></a>
            </form>
        <?php else : ?>
            <div class="empty-cart" id="added">
                <h3>Your account has been added.</h3>
                <a href="index.php"><button type='button' class="cart-emptyBtn">Login</button></a>
            </div>


        <?php endif; ?>
    </main>
</body>

</html>

<!-- INSERT INTO `product` (`name`, `description`, `image`, `price`, `advice`) VALUES
('name', 'description', 'image', 'price','advice'); -->