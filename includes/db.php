<?php
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        define('HOST', '');
        define('USER', '');
        define('PASS', '');
        define('DB', '');
    } else {
        define('HOST', '');
        define('USER', '');
        define('PASS', '');
        define('DB', '');
    }

    function connectDB() {
        $conn = new mysqli(HOST, USER, PASS, DB);
        return $conn;
    }

?>
