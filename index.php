<?php
session_start();

include_once('includes/functions.php');

$errMsg = '';
$granted = false;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (validateInfo($username, $password) !== false) {
        $granted = false;
    } else {
        $granted = true;
        $_SESSION["granted"] = true;
        $_SESSION["user"] = $_POST['username'];
    }
    if (!isGranted()) {
        $errMsg = 'Access Denied';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <script src="js/script.js"></script>
</head>

<body>

    
    <main>
        <?php if (!isGranted()) : ?>
            <div style="text-align: center;"><h2 style="color: red;"><?php echo $errMsg; ?></h2></div>


            <form action="" method="post">
                <h2 class="welcome">Login To Nook's Cranny</h2>
                <div class="login-form">
                    <label for="name" class="form-label">| Username:</label>
                    <input class="form-field" type="text" name="username" placeholder="username">
                    <label for="name" class="form-label">| Password:</label>
                    <input class="form-field" id="form-pass" type="password" name="password" placeholder="password">
                </div>
                <input type="submit" class="form-button" name="submit" value="Login">
                <a href="/create-account.php" class="have-account"><span class="have-account">Don't Have an Account?</span></a>
            </form>
        <?php else : ?>
            <?php include_once('includes/nav.php'); ?>
            <div class="welcome-container">
                <h2 class="welcome">Welcome To Nook's Cranny!</h2>
                <a href="catalog.php"><img src="img/bell-bag.png" class="image"></a>
                <div class="text">Click the Bells to Start Shopping!</div>
            </div>

        <?php endif; ?>
    </main>
</body>

</html>