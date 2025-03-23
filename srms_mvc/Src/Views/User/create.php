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
                        <h4>Add User
                            <div>
                                <form action="../Controllers/UserController.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../Controllers/UserController.php" method="POST">            
                            <div class="mb-3">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['username_error_msg1']) ? $_SESSION['username_error_msg1'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['email_error_msg']) ? $_SESSION['email_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password:</label>
                                <input type="text" id="password" name="password"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['password_error_msg1']) ? $_SESSION['password_error_msg1'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="user_type">User Type:</label>
                                <select name="user_type" id="user_type" class="form-select" aria-label="Default select example">
                                    <option value="" disabled selected>Select the user type</option>
                                    <option value=<?php echo $admin;?> >Admin</option>
                                    <option value=<?php echo $instructor;?> >Instructor</option>
                                    <option value=<?php echo $student;?> >Student</option>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['user_type_error_msg']) ? $_SESSION['user_type_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="registration_number">Registration Number:</label>
                                <input type="text" id="registration_number" name="registration_number"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['registration_number_error_msg']) ? $_SESSION['registration_number_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" id="phone_number" name="phone_number"  class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['phone_number_error_msg']) ? $_SESSION['phone_number_error_msg'] : ""; ?></p>
                            </div>

                            <div class="mb-3">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['first_name_error_msg']) ? $_SESSION['first_name_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="middle_name">Middle Name:</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['middle_name_error_msg']) ? $_SESSION['middle_name_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="last_name">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['last_name_error_msg']) ? $_SESSION['last_name_error_msg'] : ""; ?></p>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="department">Department:</label>
                                <br>
                                <select name='department' id='department' class='form-select' aria-label='Default select example'>
                                    <option value='' selected>Select Department</option>
                                    <?php
                                        foreach ($result as $data) {                                           
                                    ?>                                            
                                            <option value="<?php echo $data['name'];?>"><?php echo $data['name'];?></option>                                            
                                    <?php
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['department_error_msg']) ? $_SESSION['department_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="session">Session:</label>
                                <input type="text" id="session" name="session" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['session_error_msg']) ? $_SESSION['session_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create" class="btn btn-primary">Create</button>
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
