<?php 
session_start();
session_destroy();
    echo '<h2 class="welcome">Come Again!</h2>';
    header('refresh:2; url=index.php');
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" >
        <link rel="stylesheet" href="css/home.css" type="text/css" >

        <script src="js/script.js"></script>
    </head>

    <body>
        <main>
        </main> 
    </body>
</html>