<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } 
    // include '../View/navbar.php';
    include '../View/sideBar.php';
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
                        <h4>Result List
                            <a href="../View/dashboardView.php" class="btn btn-outline-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-striped mx-auto text-center">
                            <thead>
                                <tr>
                                    <th>Result ID</th>
                                    <th>Student Name</th>
                                    <th>Registration number</th>
                                    <th>Final CGPA</th>
                                    <?php 
                                        if ($_SESSION['user_id'] == 1) {
                                    ?>
                                    <th>Action</th>
                                    <?php
                                        }
                                    ?>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                    // $result = resultModel::show_List();

                                    // if (mysqli_num_rows($result) > 0) {
                                        foreach ($result as $data) {
                                            if (($_SESSION['user_id'] == $data['student_id']) || $_SESSION['user_type'] == 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $data['results_id'] ?></td>
                                                    <?php                                                    
                                                        foreach ($result1 as $data1) {
                                                            if ($data['student_id'] === $data1['user_id']) {
                                                    ?>
                                                                <td><?php echo $data1['username'] ?></td>
                                                                <td><?php echo $data1['registration_number'] ?></td>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                <td><?php echo $data['final_cgpa'] ?></td>
                                                <?php 
                                                    // if ($_SESSION['user_id'] == 1) {
                                                ?>
                                                <td>
                                                    <div class="form-group d-flex justify-content-center">
                                                        <?php
                                                            if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 3) {
                                                        ?>
                                                            <div class="p-1">
                                                                <form action="../Controller/result.php" method="get">                                                             
                                                                    <input type="hidden" name="student_id" value="<?php echo $data['student_id']; ?>">
                                                                    <button type="submit" name="viewSingleStudentResult" class="btn btn-primary btn-sm">View</button>
                                                                </form>
                                                            </div>
                                                        <?php
                                                            }
                                                            if ($_SESSION['user_type'] == 1) {
                                                        ?>
                                                        <div class="p-1">
                                                            <form action="../Controller/result.php" method="post">
                                                                <input type="hidden" name="_method" value="DELETE">                                                                
                                                                <input type="hidden" name="result_id" value="<?php echo $data['results_id']; ?>">
                                                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                        }
                                                    // }
                                                ?>
                                            </tr>
                                            <?php
                                            }
                                        }
                                    // } else {
                                    //     echo "<tr><td colspan='4'>No users found.</td></tr>";
                                    // }
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