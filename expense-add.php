<?php 
    include 'connect.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $entryDate = date('Y-m-d'); 
        $categoryName = $_POST['categoryName'];
        $amount = $_POST['amount'];
        $description = $_POST['description'] ? $_POST['description'] : null; 

        $sql = "INSERT INTO tblExpenseCategory (entryDate, categoryName, amount, description) 
                VALUES ('$entryDate', '$categoryName', '$amount', '$description')";
        $conn->query($sql);

        header("Location: expense.php");
    }
?>
