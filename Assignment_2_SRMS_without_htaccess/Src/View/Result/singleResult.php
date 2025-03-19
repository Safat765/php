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
                        <h4>Semester-wise Result
                            <div>
                                <form action="../Controller/result.php" method="post">
                                    <button type="submit" name="backToIndexFromSingleResult" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                            <!-- <a href="../View/Result/Index.php" class="btn btn-outline-danger float-end">BACK</a> -->
                        </h4>
                    </div>
                    <div class="card-body table-responsive">

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