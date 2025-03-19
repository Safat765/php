<?php
    session_start();
    include '../../Msg/message.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>
    <link rel="stylesheet" href="../../Public/CSS/loginCSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="tittle">
        <h1>Student Result Management System</h1>
        <h2>Login</h2>
    </div>
    <div class="login-pnl">
        <form action="../Controller/userController.php" method="post">            
            <div class="username">
                <input type="text" id="username" name="username" placeholder="Username">
                <br>
                <span class="error-pnl"><?php  echo isset($_SESSION['username_error_msg']) ? $_SESSION['username_error_msg'] : ""; ?></span>
            </div>
            <br>
            <div class="password">
                <input type="password" id="password" name="password" placeholder="Password">
                <br>
                <span class="error-pnl"><?php  echo isset($_SESSION['password_error_msg']) ? $_SESSION['password_error_msg'] : ""; ?></span>
            </div>
            <br>
            <div class="submit-div">
                <button type="submit" name="login" class="submit-btn">Submit</button>               
            </div>
        </form>
        <br><br>
        <p class="error-pnl">
        <?php  echo isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : ""; ?>
        </p>
    </div>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>