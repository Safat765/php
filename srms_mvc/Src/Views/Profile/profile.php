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
</head>
  <body>
  <div class="mt-5 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Logged Profile
                            <a href="../Views/dashboard.php" class="btn btn-outline-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped mx-auto text-center">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Registration Number</th>
                                    <th>department</th>
                                    <th>session</th>
                                    <th>User ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                    foreach ($result as $data) {
                                ?>
                                        <tr>
                                            <td><?php echo $data['first_name'] ?></td>
                                            <td><?php echo $data['middle_name'] ?></td>
                                            <td><?php echo $data['last_name'] ?></td>
                                            <td><?php echo $data['registration_number'] ?></td>
                                            <td><?php echo $data['department'] ?></td>
                                            <td><?php echo $data['session'] ?></td>
                                            <td><?php echo $data['user_id'] ?></td>
                                            <td>
                                                <div>
                                                    <form action="../Controllers/profileController.php" method="post">
                                                        <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                                                        <button type="submit" name="editCall" class="btn btn-success btn-sm">Edit</button>
                                                    </form>
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
  </body>
</html>
