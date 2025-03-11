<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>
    <link rel="stylesheet" href="../../Public/CSS/loginCSS.css">
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
                <span><?php  echo isset($_SESSION['usernameErrMsg']) ? $_SESSION['usernameErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div class="password">
                <input type="password" id="password" name="password" placeholder="Password">
                <br>
                <span><?php  echo isset($_SESSION['passwordErrMsg']) ? $_SESSION['passwordErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div class="submit-div">
                <button type="submit" name="login" class="submit-btn">Submit</button>               
            </div>
        </form>
        <br><br>
        <p class="error-pnl">
        <?php  echo isset($_SESSION['errMsg']) ? $_SESSION['errMsg'] : ""; ?>
        </p>
    </div>
</body>
</html>