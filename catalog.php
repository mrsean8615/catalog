<?php
session_start();
include 'includes/functions.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/catalog.css" type="text/css">
    <script src="js/script.js"></script>
</head>
<?php include_once('includes/nav.php'); ?>

<body>
    <main>
        <div class="grid">
            <?php showCatalog(); ?>
        </div>


    </main>
</body>

</html>