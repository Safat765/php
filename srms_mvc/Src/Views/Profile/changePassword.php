<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    include '../Views/sideBar.php';
    include '../../Msg/message.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Result Management System</title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Change Password
                            <div>
                                <form action="../Controllers/profileController.php" method="post">
                                    <button type="submit" name="backFromChangePassword" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../Controllers/profileController.php" method="POST">
                            <input type="hidden" name="_putMethod" value="PUT">
                            <div class="mb-3">
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="oldPassword">Current Password</label><span style="color: red; font-weight: bold;"> *</span>
                                <input type="password" id="oldPassword" name="oldPassword"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['oldPassword_error_msg']) ? $_SESSION['oldPassword_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword">New Password</label><span style="color: red; font-weight: bold;"> *</span>
                                <input type="password" id="newPassword" name="newPassword"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['newPassword_error_msg']) ? $_SESSION['newPassword_error_msg'] : ""; ?></p>
                            </div> 
                            <div class="mb-3">
                                <label for="confirmPassword">Confirm Password:</label><span style="color: red; font-weight: bold;"> *</span>
                                <input type="password" id="confirmPassword" name="confirmPassword"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['confirmPassword_error_msg']) ? $_SESSION['confirmPassword_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="myCheckbox" value="0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="myCheckbox">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        <b style="color: red;"> Stay login ?</b>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <button type="submit" name="confirm" class="btn btn-primary">Confirm Password</button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
