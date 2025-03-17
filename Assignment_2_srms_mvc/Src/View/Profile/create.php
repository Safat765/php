<?php
    session_start();
    include '../../../Msg/message.php';
    include '../../Model/profile.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Profile
                            <div>
                                <form action="../../Controller/profile.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../../Controller/profile.php" method="post">
                            
                            <div class="mb-3">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['first_nameErrMsg']) ? $_SESSION['first_nameErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="middle_name">Middle Name:</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['middle_nameErrMsg']) ? $_SESSION['middle_nameErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="last_name">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['last_nameErrMsg']) ? $_SESSION['last_nameErrMsg'] : ""; ?></p>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="department">Department:</label>
                                <br>
                                <select name='department' id='department' class='form-select' aria-label='Default select example'>
                                    <option value='' selected>Select Department</option>
                                    <?php
                                        $result = profileModel::show_dep_list();
                                        if (mysqli_num_rows($result) > 0) {
                                            foreach ($result as $data) {                                           
                                    ?>                                            
                                                <option value="<?php echo $data['name'];?>"><?php echo $data['name'];?></option>                                            
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['departmentErrMsg']) ? $_SESSION['departmentErrMsg'] : ""; ?></p>
                            </div>
                                <?php
                                        // $result = profileModel::show_user();
                                        // if (mysqli_num_rows($result) > 0) {
                                        //     foreach ($result as $data1) {
                                        //         if ($_SESSION['user_id'] == $data1['user_id'] && $data1['user_type'] == 3) {
                                    ?>
                                                <div class="mb-3">
                                                    <label for="session">Session:</label>
                                                    <input type="text" id="session" name="session" class="form-control">
                                                    <br>
                                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['sessionErrMsg']) ? $_SESSION['sessionErrMsg'] : ""; ?></p>
                                                </div>
                                    <?php
                                        //         }
                                        //     }
                                        // }
                                    ?>
                            <div class="mb-3">
                                <label for="user_id">User Name:</label>
                                <br><br>
                                <select name='user_id' id='user_id' class='form-select' aria-label='Default select example'>
                                    <option value='' selected>Select the user</option>
                                    <?php
                                        $userType = [1 => "Admin", 2 => "Instructor", 3 => "Student"];
                                        $result = profileModel::show_user();
                                        if (mysqli_num_rows($result) > 0) {
                                            foreach ($result as $data) {                                         
                                    ?>                                            
                                                <option value="<?php echo $data['user_id'];?>"><?php echo $data['username'] . " - " . $userType[$data['user_type']];?></option>                                            
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['user_idErrMsg']) ? $_SESSION['user_idErrMsg'] : ""; ?></p>
                            </div>
                            <br>
                            <div class="mb-3">
                                <button type="submit" name="create" class="btn btn-primary">CREATE</button>
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