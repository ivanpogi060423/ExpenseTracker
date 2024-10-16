<?php
    include 'connect.php';

    if (isset($_GET['edit'])) {
        $categoryId = $_GET['edit'];
        $sql = "SELECT * FROM tblExpenseCategory WHERE categoryId = '$categoryId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $entryDate = $row['entryDate'];
        $categoryName = $row['categoryName'];
        $amount = $row['amount'];
        $description = $row['description'];
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $categoryId = $_POST['categoryId'];
        $categoryName = $_POST['categoryName'];
        $amount = $_POST['amount'];
        $description = $_POST['description'] ? $_POST['description'] : null;

        $sql = "UPDATE tblExpenseCategory 
                SET categoryName = '$categoryName', amount = '$amount', description = '$description'  
                WHERE categoryId = '$categoryId'";
        $conn->query($sql);

        header("Location: expense.php");

        if (isset($_POST['cancel'])) {
            header("Location: expense.php");
            exit();
        }
    }  
?>
