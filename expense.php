<?php
    include 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="nav">  
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
    </div> 

    <div id="mySidenav" class="sidenav">
        <h1>MENU</h1>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul>
            <li><a href="dashboard.html"><i class="fas fa-tv"></i>Dashboard</a></li>
            <li><a href="account.html"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="expense.html"><i class="fas fa-money-bill-wave"></i>Expense</a></li>
            <li><a href="report.html"><i class="fas fa-line-chart"></i>Report</a></li>
            <li><a href="about.html"><i class="fas fa-users"></i>About Us</a></li>
        </ul>
    </div>

    <header class="head">
        <h2 class="expense">Expense</h2>
        <h2>
            <a class="account" href="Account.html"><i class="fas fa-user"></i>Account</a>
        </h2>
    </header>

    <div class="expense-add">
        <button onclick="PopUp()">Add Expense</button>
    </div>

    <section class= "table">
        <table>
            <colgroup>
                <col>
                <col>
                <col>
                <col>
                <col>
            </colgroup>
            <tr>
                <th>ID</th>
                <th>Date Created</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
    
            <?php
                $sql = "SELECT * FROM tblExpenseCategory";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['categoryId']}</td>
                            <td>{$row['entryDate']}</td>
                            <td>{$row['categoryName']}</td>
                            <td>{$row['amount']}</td>
                            <td>{$row['description']}</td>
                            <td>
                                <a href=''>Edit</a>
                                <form action='expense-delete.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='categoryId' value='" . $row['categoryId'] . "'>
                                    <input type='submit' name='delete' value='Delete'>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
            ?>     
        </table>
    </section>

    <div class="background" id="background"></div>

    <div class="add-expense" id="add-expense">
        <h2>ADD NEW EXPENSE</h2>
        <form action="expense-add.php" method="post" >
            <label for="categoryName">Category Name:</label>
            <input type="text" id="categoryName" name="categoryName" required><br>
    
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required><br>
    
            <label for="description">Description:</label>
            <input type="text" id="description" name="description"><br>
    
            <button type="submit">Submit</button>
            <button class="close" onclick="Close()">CANCEL</button>
        </form>
    </div>

    <?php
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
    ?>

    <script>
        function PopUp() {
            document.getElementById("add-expense").style.display = "block";
            document.getElementById("background").style.display = "block";
        }

        function Close() {
            document.getElementById("add-expense").style.display = "none";
            document.getElementById("background").style.display = "none";
        }

        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>
</html> 
