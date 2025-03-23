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
                        <h4>Semester-wise Result
                            <div>
                                <form action="../Controllers/resultControllers.php" method="post">
                                    <button type="submit" name="backToIndexFromSingleResult" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <br>                     
                    <?php
                        foreach ($result0 as $data0) {
                    ?>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $data['semester'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php 
                                $sem = $data0['semester'];
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
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $data['semester'] ?>">
                                <table class="table table-bordered table-striped mx-auto text-center">
                                    <thead>
                                        <tr>
                                            <th>Course ID</th>
                                            <th>Exam ID</th>
                                            <th>Marks</th>
                                            <th>Semester</th>
                                            <th>GPA</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <?php
                                            foreach ($result as $data) {
                                                
                                                if ($data0['semester'] === $data['semester']) {
                                        ?>
                                                <tr>
                                                    <td><?php
                                                        foreach ($result1 as $data1) {
                                                           
                                                            if ($data1['course_id'] === $data['course_id']) {
                                                                echo $data1['name'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td><?php
                                                        foreach ($result1 as $data1) {
                                                           
                                                            if ($data1['exam_id'] === $data['exam_id']) {
                                                                echo $data1['exam_title'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td><?php echo $data['marks'] ?></td>
                                                    <td><?php echo $data['semester'] ?></td>
                                                    <td><?php echo $data['gpa'] ?></td>
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
                        <br><br><br><br><br><br>
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
