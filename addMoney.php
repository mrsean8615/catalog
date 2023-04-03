<?php
session_start();
include 'includes/functions.php';

if (isset($_POST['bell-submit'])) {
    if (empty($_POST['bell-value'])) {
        $emptymsg = "It's ok to enter a little bit of bells";
    } else {
        if (tooMuchBells() !== false) {
            $bellmsg = "Now that's far too many bells!";
        } else {
            addBells();
            updateBells();
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" href="css/product.css" type="text/css">

    <script src="js/script.js"></script>
</head>
<?php include_once('includes/nav.php'); ?>

<body>
    <span class="current-balance">Current Balance: <?php echo number_format($_SESSION['raw-balance']); ?><img class="current-balance-img" src="img/bell-bag.png"></span>
    <main>
        <form action="" method="post">
            <h3 class="welcome" id="bell-title">Black Market Bell Generator<img class="bell-title-img" src="img/bell-bag.png"></h3> 
            <div class="bell-gen-con">
                <p class="bell-des">Enter Amount</p>
                <input name="bell-value" class="form-field" placeholder="0" id="bell-gen" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
                <input type="submit" name="bell-submit" class="form-button" id="add-bell-button" value="Add Bells">
            </div>
        </form>
    </main>
</body>

</html>