<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>    
</head>
<body>
    <div>
        <form action="../Controller/addNewUserController.php" method="post">            
            <div>
                <input type="text" id="userName" name="userName" placeholder="Username">
                <br>
                <span><?php  echo isset($_SESSION['userNameErrMsg']) ? $_SESSION['userNameErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div>
                <input type="text" id="email" name="email" placeholder="Email">
                <br>
                <span><?php  echo isset($_SESSION['emailErrMsg']) ? $_SESSION['emailErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div>
                <input type="text" id="password" name="password" placeholder="Password">
                <br>
                <span><?php  echo isset($_SESSION['passwordErrMsg']) ? $_SESSION['passwordErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div>
                <select name="userType" id="userType">
                    <option value="" disabled selected>Select the user type</option>
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                </select>
                <br>
                <span><?php  echo isset($_SESSION['userTypeErrMsg']) ? $_SESSION['userTypeErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div>                
                <select name="status" id="status">
                    <option value="" disabled selected>Select the status</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                </select>
                <br>
                <span><?php  echo isset($_SESSION['statusErrMsg']) ? $_SESSION['statusErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div>
                <input type="text" id="registrationNumber" name="registrationNumber" placeholder="registrationNumber">
                <br>
                <span><?php  echo isset($_SESSION['registrationNumberErrMsg']) ? $_SESSION['registrationNumberErrMsg'] : ""; ?></span>
            </div>
            <br>
            <div>
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder="phoneNumber">
                <br>
                <span><?php  echo isset($_SESSION['phoneNumberErrMsg']) ? $_SESSION['phoneNumberErrMsg'] : ""; ?></span>
            </div>
            <br>
            <button type="submit" name="add">Add</button>
            <button><a href="../View/dashboardView.php">Cancel</a></button>
        </form>
        <p>
        <?php  echo isset($_SESSION['errMsg']) ? $_SESSION['errMsg'] : ""; ?>
        </p>
    </div>    
</body>
</html>