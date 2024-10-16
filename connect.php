<?php
    $servername = "127.0.0.1:3308";
    $username = "root";
    $password = "";
    $database = "expense_tracker";

    $conn = new mysqli($servername, $username, $password, $database);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>