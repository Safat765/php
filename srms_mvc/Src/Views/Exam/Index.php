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
                        <h4>Exam List
                            <a href="../Views/dashboard.php" class="btn btn-outline-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped mx-auto text-center">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Title</th>
                                    <th>Department ID</th>
                                    <th>Semester</th>
                                    <th>Credit</th>
                                    <th>Exam Type</th>
                                    <th>Marks</th>
                                    <th>Instructor ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                    foreach ($result as $data) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php                                                        
                                                    foreach ($result1 as $data1) {
                                                        if ($data['course_id'] == $data1['course_id']) {
                                                            echo $data1['name'];
                                                        }
                                                    }
                                                ?>                                                
                                            </td>
                                            <td><?php echo $data['exam_title'] ?></td>
                                            <td>
                                                <?php
                                                    foreach ($result2 as $data2) {
                                                        if ($data['department_id'] == $data2['department_id']) {
                                                            echo $data2['name'];
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $sem = $data['semester'];
                                                    switch($sem) {
                                                        case 1:
                                                            echo "1st Year 1st Semester";
                                                            break;
                                                        case 2:
                                                            echo "1st Year 2nd Semester";
                                                            break;
                                                        case 3:
                                                            echo "1st Year 3rd Semester";
                                                            break;
                                                        case 4:
                                                            echo "2nd Year 1st Semester";
                                                            break;
                                                        case 5:
                                                            echo "2nd Year 2nd Semester";
                                                            break;
                                                        case 6:
                                                            echo "2nd Year 3rd Semester";
                                                            break;
                                                        case 7:
                                                            echo "3rd Year 1st Semester";
                                                            break;
                                                        case 8:
                                                            echo "3rd Year 2nd Semester";
                                                            break;
                                                        case 9:
                                                            echo "3rd Year 3rd Semester";
                                                            break;
                                                        case 10:
                                                            echo "4th Year 1st Semester";
                                                            break;
                                                        case 11:
                                                            echo "4th Year 2nd Semester";
                                                            break;
                                                        case 12:
                                                            echo "4th Year 3rd Semester";
                                                            break;                                    
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $data['credit'] ?></td>
                                            <td>
                                                <?php
                                                    if ($data['exam_type'] == 1) {
                                                        echo "Mid";
                                                    } elseif ($data['exam_type'] == 2) {
                                                        echo "Quiz";
                                                    } elseif ($data['exam_type'] == 3) {
                                                        echo "Viva";
                                                    } else {
                                                        echo "Final";
                                                    }
                                                    ?>
                                            </td>
                                            <td><?php echo $data['marks'] ?></td>
                                            <td>
                                                <?php
                                                    foreach ($result3 as $data3) {
                                                        if ($data['instructor_id'] == $data3['user_id']) {
                                                            echo $data3['username'];
                                                        }
                                                    } 
                                                ?>
                                            </td>
                                            <td>
                                                <div class="form-group d-flex">
                                                    <div class="p-1">
                                                        <form action="../Controllers/examController.php" method="post">
                                                            <input type="hidden" name="exam_id" value="<?php echo $data['exam_id']; ?>">
                                                            <button type="submit" name="editCall" class="btn btn-success btn-sm">Edit</button>
                                                        </form>
                                                    </div>
                                                    <div class="p-1">
                                                        <form action="../Controllers/examController.php" method="post">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="exam_id" value="<?php echo $data['exam_id']; ?>">
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
  </body>
</html>
