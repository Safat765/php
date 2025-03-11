<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>


<!DOCTYPE html>
<html lang="en">
<body>
    
<div>
    <form action="../../Controller/adminController.php" method="post">            
        <div>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['u_id']; ?>">
        </div>
        <br>
        <div>
            <input type="text" id="username" name="username" value="<?php echo $_SESSION['u_username']; ?>" placeholder="Username">
        </div>
        <br>
        <div>
            <input type="text" id="email" name="email" value="<?php echo $_SESSION['u_email']; ?>" placeholder="Email">
        </div>
        <br>
        <div>
            <input type="text" id="password" name="password" value="<?php echo $_SESSION['u_password']; ?>" placeholder="Password">
        </div>
        <br>
        <div>
            <input type="hidden" id="user_type" name="user_type" value="<?php echo $_SESSION['u_user_type']; ?>">
        </div>
        <br>
        <div>
            <input type="text" id="status" name="status" value="<?php echo $_SESSION['u_status']; ?>" placeholder="Status">
        </div>
        <br>
        <div>
            <input type="hidden" id="registration_number" name="registration_number" value="<?php echo $_SESSION['u_registration_number']; ?>">
        </div>
        <br>
        <div>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $_SESSION['u_phone_number']; ?>" placeholder="Phone Number">
        </div>
        <br>
        <button type="submit" name="confirmUpdate">Confirm Update</button>
        <button><a href="../../View/dashboardView.php">Cancel</a></button>
    </form>
    <br><br>    
    <p class="error-pnl">
        <?php  echo isset($_SESSION['errMsg']) ? $_SESSION['errMsg'] : ""; ?>
    </p>
</div>
</body>
</html>