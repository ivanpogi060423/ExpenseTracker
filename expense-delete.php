<?php
    include 'connect.php';

    if (isset($_POST['categoryId'])) {
        $categoryId = $_POST['categoryId'];

        $sql = "DELETE FROM tblExpenseCategory WHERE categoryId = '$categoryId'";
        $conn->query($sql);

        header("Location: expense.php");
    }
?>
