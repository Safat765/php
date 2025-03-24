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
  <div class="mt-1 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Marks List
                            <a href="../Views/dashboard.php" class="btn btn-outline-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped mx-auto text-center">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Exam Title</th>
                                    <th>Course Name</th>
                                    <th>Marks</th>
                                    <th>Semester</th>
                                    <th>GPA</th>
                                    <?php 
                                        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2) {
                                    ?>
                                    <th>Action</th>
                                    <?php
                                        }
                                    ?>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                    foreach ($result as $data) {
                                        if (($_SESSION['user_id'] == $data['student_id']) || $_SESSION['user_type'] == 1 || $_SESSION['username'] == $data['username']) {
                                ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                        foreach ($result1 as $data1) {
                                                            if ($data['student_id'] == $data1['user_id']) {
                                                                echo $data1['username'];
                                                                break;
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        foreach ($result1 as $data1) {
                                                            if ($data['exam_id'] == $data1['exam_id']) {
                                                                echo $data1['exam_title'];
                                                                break;
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        foreach ($result1 as $data1) {
                                                            if ($data['course_id'] == $data1['course_id']) {
                                                                echo $data1['name'];
                                                                break;
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $data['marks'] ?></td>
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
                                                <td><?php echo $data['gpa'] ?></td>
                                                <?php 
                                                    if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2) {
                                                ?>
                                                <td>
                                                    <div class="form-group d-flex">
                                                    <?php 
                                                        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2) {
                                                            if ($_SESSION['user_type'] == 2) {
                                                    ?>
                                                        <div class="p-1">
                                                            <form action="../Controllers/marksController.php" method="post">
                                                                <input type="hidden" name="marks_id" value="<?php echo $data['marks_id']; ?>">
                                                                <button type="submit" name="editCall" class="btn btn-success btn-sm">Edit</button>
                                                            </form>
                                                        </div>
                                                    <?php
                                                            }
                                                            if ($_SESSION['user_type'] == 1) {
                                                    ?>
                                                            <div class="p-1">
                                                                <form action="../Controllers/marksController.php" method="post">
                                                                    <input type="hidden" name="marks_id" value="<?php echo $data['marks_id']; ?>">
                                                                    <button type="submit" name="editCall" class="btn btn-primary btn-sm">View</button>
                                                                </form>
                                                            </div>
                                                    <?php
                                                            }
                                                    ?>
                                                        <div class="p-1">
                                                            <form action="../Controllers/marksController.php" method="post">
                                                                <input type="hidden" name="_method" value="PUT">
                                                                <input type="hidden" name="marks_id" value="<?php echo $data['marks_id']; ?>">
                                                                <input type="hidden" name="student_id" value="<?php echo $data['student_id']; ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </tr>
                                            <?php
                                        }
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
