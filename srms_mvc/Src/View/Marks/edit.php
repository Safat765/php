<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User add
                            <a href="userIndex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        $result = showUpdateUserDate($_SESSION['course_id']);

                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $data) {
                                    ?>
                                        <form action="../../Controller/courseController.php" method="post">

                                            <div class="mb-3">
                                                <input type="hidden" id="marks_id" name="marks_id" value="<?php echo $data['marks_id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_id">Student ID:</label>
                                                <input type="text" id="student_id" name="student_id" class="form-control" value="<?php echo $data['student_id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exam_id">Exam ID:</label>
                                                <input type="text" id="exam_id" name="exam_id" class="form-control" value="<?php echo $data['exam_id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="course_id">Course ID:</label>
                                                <input type="text" id="course_id" name="course_id" class="form-control" value="<?php echo $data['course_id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="marks">Marks:</label>
                                                <input type="text" id="marks" name="marks" class="form-control" value="<?php echo $data['marks']; ?>">
                                            </div>
                                                <label for="semester">Semester:</label>
                                                <input type="text" id="semester" name="semester" class="form-control" value="<?php echo $data['semester']; ?>">
                                            </div>
                                                <label for="gpa">GPA:</label>
                                                <input type="text" id="gpa" name="gpa" class="form-control" value="<?php echo $data['gpa']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" name="confirmUpdate" class="btn btn-primary">Confirm Edit</button>
                                            </div>

                                        </form>
                                    <?php
                                }
                            } else {
                                echo "<h3> No id found </h3>";
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