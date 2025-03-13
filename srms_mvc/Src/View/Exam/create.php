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
                        <h4>Add Exam
                            <div>
                                <form action="../../Controller/examController.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="../../Controller/examController.php" method="post">
                            
                            <div class="mb-3">
                                <label for="course_id">Course ID:</label>
                                <input type="text" id="course_id" name="course_id" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_idErrMsg']) ? $_SESSION['course_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="exam_title">Title:</label>
                                <input type="text" id="exam_title" name="exam_title" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['exam_titleErrMsg']) ? $_SESSION['exam_titleErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="department_id">Department ID:</label>
                                <input type="text" id="department_id" name="department_id" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['department_idErrMsg']) ? $_SESSION['department_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="semester">Semester:</label>
                                <input type="text" id="semester" name="semester" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['semesterErrMsg']) ? $_SESSION['semesterErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="credit">Credit:</label>
                                <input type="text" id="credit" name="credit" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['creditErrMsg']) ? $_SESSION['creditErrMsg'] : ""; ?></p>
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
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['exam_typeErrMsg']) ? $_SESSION['exam_typeErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="marks">Marks:</label>
                                <input type="text" id="marks" name="marks" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['marksErrMsg']) ? $_SESSION['marksErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="instructor_id">Instructor ID:</label>
                                <input type="text" id="instructor_id" name="instructor_id" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['instructor_idErrMsg']) ? $_SESSION['instructor_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="course_created_by">Created By:</label>
                                <input type="text" id="course_created_by" name="course_created_by" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_created_byErrMsg']) ? $_SESSION['course_created_byErrMsg'] : ""; ?></p>
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