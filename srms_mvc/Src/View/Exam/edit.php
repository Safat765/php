<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include '../../../Msg/message.php';
    include '../../Model/exam.php';
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
                        $result = showUpdateUserDate($_SESSION['exam_id']);

                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $data) {
                                    ?>
                                        <form action="../../Controller/courseController.php" method="post">

                                            <div class="mb-3">
                                            <input type="hidden" id="exam_id" name="exam_id" value="<?php echo $data['exam_id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="course_id">Course ID:</label>
                                                <input type="text" id="course_id" name="course_id" class="form-control" value="<?php echo $data['course_id']?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exam_title">Title:</label>
                                                <input type="text" id="exam_title" name="exam_title" class="form-control" value="<?php echo $data['exam_title']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="department_id">Department ID:</label>
                                                <input type="text" id="department_id" name="department_id" class="form-control" value="<?php echo $data['department_id']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="semester">Semester:</label>
                                                <input type="text" id="semester" name="semester"  class="form-control" value="<?php echo $data['semester']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="credit">Credit:</label>
                                                <input type="text" id="credit" name="credit" class="form-control"value="<?php echo $data['credit']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exam_type">Exam Type:</label>
                                                <select name="exam_type" id="exam_type" class="form-select" aria-label="Default select example">
                                                    <option value="" disabled selected>Select the exam type</option>
                                                    <option value="1">Mid</option>
                                                    <option value="2">Quiz</option>
                                                    <option value="3">Viva</option>
                                                    <option value="4">Final</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="marks">Marks:</label>
                                                <input type="text" id="marks" name="marks" class="form-control"value="<?php echo $data['marks']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="instructor_id">Instructor ID:</label>
                                                <input type="text" id="instructor_id" name="instructor_id" class="form-control" value="<?php echo $data['instructor_id']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="course_created_by">Created By:</label>
                                                <input type="text" id="course_created_by" name="course_created_by" class="form-control" value="<?php echo $data['course_created_by']?>">
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