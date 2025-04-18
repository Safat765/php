<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include '../View/navbar.php';
    include_once '../.././Msg/message.php';
    // include '../../Model/profile.php';
    include_once '../Controller/profile.php'
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
                        <h4>Edit Profile
                            <form action="../Controller/profile.php" method="get">
                                <button class="btn btn-danger float-end" name="back">BACK</button>
                            </form>
                            <!-- <a href="../View/Profile/Index.php" class="btn btn-danger float-end">BACK</a> -->
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        foreach ($result as $data) {
                            ?>
                                <form action="../Controller/profile.php" method="post">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="mb-3">
                                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $data['user_id']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $data['first_name']; ?>">                                            </div>
                                    <div class="mb-3">
                                        <label for="middle_name">Middle Name:</label>
                                        <input type="text" id="middle_name" name="middle_name" class="form-control" value="<?php echo $data['middle_name']; ?>">                                            </div>
                                    <div class="mb-3">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $data['last_name']; ?>">                                            </div>                                            
                                    <div class="mb-3">
                                        <label for="department">Department:</label>
                                        <select name='department' id='department' class='form-select' aria-label='Default select example' disabled>
                                            <option value='' disabled selected>Select the Department</option>
                                            <?php
                                                foreach ($result1 as $data1) {                                           
                                            ?>                                            
                                                    <option value="<?php echo $data1['name'];?>" <?php echo ($data1['name'] == $data['department']) ? 'selected' : ''; ?>>
                                                        <?php echo $data1['name']; ?>
                                                    </option>      
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                            <button type="submit" name="confirmUpdate" class="btn btn-primary">Confirm Edit</button>
                                        <!-- <button type="submit" name="confirmUpdate" class="btn btn-primary">Confirm Edit</button> -->
                                    </div>
                                </form>
                            <?php
                        }
                    ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>