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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Public/CSS/toggle.css">
  </head>
  <body>
    <div class="mt-4 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User List
                            <a href="../Views/dashboard.php" class="btn btn-outline-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-striped mx-auto text-center">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Registration Number</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                    foreach ($result as $user) {
                                ?>
                                        <tr>
                                            <td><?php echo $user['username']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td>
                                                <?php
                                                    $data = $user['user_type'];
                                                    switch($data) {
                                                        case 1:
                                                            echo "Admin";
                                                            break;
                                                        case 2:
                                                            echo "Instructor";
                                                            break;
                                                        case 3:
                                                            echo "Student";
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $user['registration_number']; ?></td>
                                            <td><?php echo $user['phone_number']; ?></td>
                                            <td>
                                                <div class="form-group d-flex">
                                                    <div class="p-1">
                                                        <form action="../Controllers/UserController.php" method="post">
                                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                            <div class="form-group d-flex">
                                                                <div class="p-1">   
                                                                        <?php
                                                                            if ($user['status'] == 1) {
                                                                                $status_change = $ACTIVE;
                                                                            } elseif ($user['status'] == 0) {
                                                                                $status_change = $INACTIVE;
                                                                            }
                                                                        ?>    
                                                                    <input type="hidden" name="status_change" value="<?php echo $status_change; ?>">
                                                                    <button type="submit" name="toggle_status" class="btn btn-warning" style="height: 32px; display: flex; justify-content: center; align-items: center;">
                                                                        <?php 
                                                                            $status_change == $INACTIVE;
                                                                            if ($user['status'] == 1) {
                                                                                $status_change = $ACTIVE;
                                                                            } elseif ($user['status'] == 0) {
                                                                                $status_change = $INACTIVE;
                                                                            }
                                                                        echo ($status_change == $ACTIVE) ? 'Inactive' : 'Active'; ?>
                                                                    </button>
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="submit" name="editCall" class="btn btn-success btn-sm">Edit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="p-1">
                                                        <form action="../Controllers/UserController.php" method="post">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                <tr></tr>
                            </tbody>           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../../Public/JS/toggle.js"></script>
  </body>
</html>
