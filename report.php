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
        <h2 class="report">Report</h2>
        <h2>
            <a class="account" href="Account.html"><i class="fas fa-user"></i>Account</a>
        </h2>
    </header>

    <form action="" method="post">
        <label for="dateStart">Date Start</label>
        <input type="date" id="dateStart" name="dateStart" value="<?php echo isset($_POST['dateStart']) ? $_POST['dateStart'] : ''; ?>"> 
        
        <label for="dateEnd">Date End</label> 
        <input type="date" id="dateEnd" name="dateEnd" value="<?php echo isset($_POST['dateEnd']) ? $_POST['dateEnd'] : ''; ?>">
        
        <input type="submit" name="filter" value="Filter">
    </form>
    
    <h1>Expense Report</h1>
    <section class="table">
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
            </tr>

            <?php
                $sql = "SELECT * FROM tblExpenseCategory";

                if (isset($_POST['filter'])) {
                    $dateStart = $_POST['dateStart'];
                    $dateEnd = $_POST['dateEnd'];

                    if(!empty($dateStart) && !empty($dateEnd)){
                        $sql .= " WHERE entryDate BETWEEN '$dateStart' AND '$dateEnd'";
                    } elseif (!empty($dateStart)) {
                        $sql .= " WHERE entryDate >= '$dateStart'";
                    } elseif (!empty($dateEnd)) {
                        $sql .= " WHERE entryDate <= '$dateEnd'";
                    }
                }

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['categoryId']}</td>
                            <td>{$row['entryDate']}</td>
                            <td>{$row['categoryName']}</td>
                            <td>{$row['amount']}</td>
                            <td>{$row['description']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
            ?>
        </table>
    </section>

    <script>
    function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    }
    </script>
   
</body>
</html> 
