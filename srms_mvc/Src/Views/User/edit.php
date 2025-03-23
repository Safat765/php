<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    include '../Views/sideBar.php';
    include_once '../.././Msg/message.php';
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
                        <h4>Add User
                            <form action="../Controllers/UserController.php" method="get">
                                <button class="btn btn-danger float-end" name="backToIndexFromEdit">BACK</button>
                            </form>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        foreach ($result as $data) {
                    ?>
                            <form action="../Controllers/UserController.php" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $data['user_id']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username">Username:</label>
                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $data['username']?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $data['email']?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password:</label>
                                    <input type="text" id="password" name="password" class="form-control" value="<?php echo $data['password']?>">
                                </div>
                                <div class="mb-3">
                                    <label for="user_type">User Type:</label>
                                    <input type="text" id="user_type" name="user_type" class="form-control" value="<?php echo $data['user_type'] == 1 ? 'Admin' : ($data['user_type'] == 2 ? 'Instructore' : 'Student'); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="registration_number">Registration Number:</label>
                                    <input type="text" id="registration_number" name="registration_number" class="form-control" value="<?php echo $data['registration_number']?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?php echo $data['phone_number']?>">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="confirmUpdate" class="btn btn-primary">Confirm Edit</button>
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

