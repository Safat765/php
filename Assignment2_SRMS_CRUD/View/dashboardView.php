<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>
    <link rel="stylesheet" href="dashboardCSS.css">
</head>
<body>
    <h2 class="welcome">Welcome "<?php echo $_SESSION['userName'];?>" to <?php  echo $_SESSION['userType'];?> dashboard of Student Result Management System</h2>
    <a href="../Controller/logoutController.php" class="logout-btn"><button>Logout</button></a>
    <div class="crud">        
        <a href="../View/addNewUserView.php"><button>Add User</button></a>
        <br><br>
        <a href="../View/viewAllUserView.php"><button>View All</button></a>
        <br><br>
    </div>

</body>
</html>