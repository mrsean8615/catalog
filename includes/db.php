<?php
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '8615');
        define('DB', 'ecom');
    } else {
        define('HOST', 'mysqlcluster21');
        define('USER', 'ecomadmin');
        define('PASS', 'Pikachu23343!');
        define('DB', 'ecom');
    }

    function connectDB() {
        $conn = new mysqli(HOST, USER, PASS, DB);
        return $conn;
    }

?>
