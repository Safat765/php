<?php
    session_start();
    include '../../../Msg/message.php';
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
                        <h4>Add Course
                            <div>
                                <form action="../../Controller/marksController.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="../../Controller/marksController.php" method="post">
                            
                            <div class="mb-3">
                                <label for="student_id">Student ID:</label>
                                <input type="text" id="student_id" name="student_id" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['student_idErrMsg']) ? $_SESSION['student_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="exam_id">Exam ID:</label>
                                <input type="text" id="exam_id" name="exam_id" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['exam_idErrMsg']) ? $_SESSION['exam_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="course_id">Course ID:</label>
                                <input type="text" id="course_id" name="course_id" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_idErrMsg']) ? $_SESSION['course_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="marks">Marks:</label>
                                <input type="text" id="marks" name="marks" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['marksErrMsg']) ? $_SESSION['marksErrMsg'] : ""; ?></p>
                            </div>
                                <label for="semester">Semester:</label>
                                <input type="text" id="marks" name="semester" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['semesterErrMsg']) ? $_SESSION['semesterErrMsg'] : ""; ?></p>
                            </div>
                                <label for="gpa">GPA:</label>
                                <input type="text" id="gpa" name="gpa" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['gpaErrMsg']) ? $_SESSION['gpaErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create" class="btn btn-primary">CREATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>