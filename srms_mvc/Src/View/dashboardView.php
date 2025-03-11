<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-0.5">
    <div class="container-fluid">
        <h2><a class="navbar-brand" href="../View/dashboardView.php">SRMS</a></h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    User
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li>
                        <form action='../View/User/userCreate.php' method='post'>
                            <button type='submit' name='addUser' class="btn btn-dark dropdown-item">Add User</button>
                        </form>
                    </li>
                    <li>
                        <form action='../Controller/adminController.php' method='post'>
                            <button type='submit' name='viewAll' class="btn btn-dark dropdown-item">View All User</button>
                        </form>
                    </li>
                </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="#">Add Department</a></li>
                    <li><a class="dropdown-item" href="#">View All Department</a></li>
                </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Department
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="../View/Department/departmentCreate.php">Add Department</a></li>
                    <li><a class="dropdown-item" href="../View/Department/departmentIndex.php">View All Department</a></li>
                </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Course
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="#">Add Department</a></li>
                    <li><a class="dropdown-item" href="#">View All Department</a></li>
                </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Exam
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="#">Add Department</a></li>
                    <li><a class="dropdown-item" href="#">View All Department</a></li>
                </ul>
                </li>
            </ul><ul class="navbar-nav">
                <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Marks
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="#">Add Department</a></li>
                    <li><a class="dropdown-item" href="#">View All Department</a></li>
                </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Result
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="#">Add Department</a></li>
                    <li><a class="dropdown-item" href="#">View All Department</a></li>
                </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li >
                    <div>
                        <form action="../Controller/userController.php" method="post">
                            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    <br>    
    <h4 class="welcome">Welcome "<?php echo $_SESSION['username'];?>" to <?php  echo $_SESSION['user_type'];?> dashboard of Student Result Management System</h2>
    <br>

    <!-- <div class="logout-btn">
        <form action="../Controller/userController.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div> -->
    <?php
        if ($_SESSION['user_type'] === 1) {
            echo "Welcome Admin : " . $_SESSION['username'] . "<br>";

        //     echo "<div class='crud'>        
        //         <div>
        //             <form action='../View/addNewUserView.php' method='post'>
        //                 <button type='submit' name='addUser'>Add User</button>
        //             </form>
        //         </div>
        //         <br><br>
        //         <div>
        //             <form action='../Controller/adminController.php' method='post'>
        //                 <button type='submit' name='viewAll'>View All</button>
        //             </form>
        //         </div>
        //     </div>";
        //     echo "<br>";
        // } elseif ($_SESSION['user_type'] === 2) {
        //     echo "Welcome Student : " . $_SESSION['username'] . "<br>";
        // } else {
        //     echo "Welcome Instructor : " . $_SESSION['username'] . "<br>";
        }


    ?>
    <!-- <div class="crud">        
        <div>
            <form action="../view/viewPHP/addNewUserView.php" method="post">
                <button type="submit" name="addUser">Add User</button>
            </form>
        </div>
        <br><br>
        <div>
            <form action="../view/viewPHP/addNewUserView.php" method="post">
                <button type="submit" name="viewAll">View All</button>
            </form>
        </div>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>