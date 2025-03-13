<?php
    session_start();
    include '../../../Msg/message.php';
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
                        <h4>Add User
                            <div>
                                <form action="../../Controller/userController.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="../../Controller/userController.php" method="POST">            
                            <div class="mb-3">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['usernameErrMsg1']) ? $_SESSION['usernameErrMsg1'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['emailErrMsg']) ? $_SESSION['emailErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password:</label>
                                <input type="text" id="password" name="password"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['passwordErrMsg1']) ? $_SESSION['passwordErrMsg1'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="user_type">User Type:</label>
                                <select name="user_type" id="user_type" class="form-select" aria-label="Default select example">
                                    <option value="" disabled selected>Select the user type</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Instructor</option>
                                    <option value="3">Student</option>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['user_typeErrMsg']) ? $_SESSION['user_typeErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">   
                                <label for="status">Status:</label>             
                                <select name="status" id="status" class="form-select" aria-label="Default select example">
                                    <option value="" disabled selected>Select the status</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="active">Active</option>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['statusErrMsg']) ? $_SESSION['statusErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="registration_number">Registration Number:</label>
                                <input type="text" id="registration_number" name="registration_number"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['registration_numberErrMsg']) ? $_SESSION['registration_numberErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" id="phone_number" name="phone_number"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['phone_numberErrMsg']) ? $_SESSION['phone_numberErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="createUser" class="btn btn-primary">Create</button>
                            </div>
                            
                        </form>
                        <p class="error-pnl">
                        <?php  echo isset($_SESSION['errMsg1']) ? $_SESSION['errMsg1'] : ""; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>