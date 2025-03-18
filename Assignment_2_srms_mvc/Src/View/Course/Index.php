<?php
    session_start();
    include '../navbar.php';
    include '../../../Msg/message.php';
    include '../../Model/course.php';
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
                        <h4>Course List
                            <a href="../dashboardView.php" class="btn btn-outline-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-striped mx-auto text-center">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Credit</th>
                                    <th>Created By</th>
                                    <?php 
                                        if ($_SESSION['user_type'] == 1) {
                                    ?>
                                    <th>Action</th>
                                    <?php
                                        }
                                    ?> 
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                    $result = CourseModel::show_List();

                                    if (mysqli_num_rows($result) > 0) {
                                        foreach ($result as $data) {
                                            ?>
                                            <tr>
                                                <td><?php echo $data['course_id'] ?></td>
                                                <td><?php echo $data['name'] ?></td>
                                                <td><?php echo $data['status'] ?></td>
                                                <td><?php echo $data['credit'] ?></td>
                                                <td><?php echo $data['created_by'] ?></td>
                                                <?php 
                                                    if ($_SESSION['user_type'] == 1) {
                                                ?>
                                                <td>
                                                    <div>
                                                        <form action="../../Controller/course.php" method="post">
                                                            <input type="hidden" name="course_id" value="<?php echo $data['course_id']; ?>">
                                                            <button type="submit" name="edit_Call" class="btn btn-success btn-sm">Edit</button>

                                                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>                                          
                                                <?php
                                                    }
                                                ?> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No users found.</td></tr>";
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