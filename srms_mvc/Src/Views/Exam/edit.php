<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include '../Views/sideBar.php';
    include_once '../../Msg/message.php';
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
                        <h4>Exam edit 
                            <form action="../Controllers/examController.php" method="get">
                                <button class="btn btn-danger float-end" name="back">BACK</button>
                            </form> 
                         </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        foreach ($result as $data) {
                    ?>
                            <form action="../Controllers/examController.php" method="post">
                            <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <input type="hidden" id="exam_id" name="exam_id" value="<?php echo $data['exam_id']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="course_id">Course ID:</label>
                                    <input type="text" id="course_id" name="course_id" class="form-control" value="<?php 
                                                                                                                        foreach ($result1 as $data1) {
                                                                                                                            if ($data['course_id'] == $data1['course_id']) {
                                                                                                                                echo $data1['course_name'];
                                                                                                                                break;
                                                                                                                            }
                                                                                                                        }
                                                                                                                    ?>" readonly>
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_idErrMsg']) ? $_SESSION['course_idErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="exam_title">Title:</label>
                                    <input type="text" id="exam_title" name="exam_title" class="form-control" value="<?php echo $data['exam_title']?>">
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['exam_titleErrMsg']) ? $_SESSION['exam_titleErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="department_id">Department ID:</label>
                                    <input type="text" id="department_id" name="department_id" class="form-control" value="<?php 
                                                                                                                                foreach ($result1 as $data1) {
                                                                                                                                    if ($data['department_id'] == $data1['department_id']) {
                                                                                                                                        echo $data1['department_name'];
                                                                                                                                        break;
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            ?>">
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['department_idErrMsg']) ? $_SESSION['department_idErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="semester">Semester:</label>
                                    <input type="text" id="semester" name="semester"  class="form-control" value="<?php 
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
                                                                                                                    ?>" readonly>
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['semesterErrMsg']) ? $_SESSION['semesterErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="credit">Credit:</label>
                                    <input type="text" id="credit" name="credit" class="form-control"value="<?php echo $data['credit']?>">
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['creditErrMsg']) ? $_SESSION['creditErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="exam_type">Exam Type:</label>
                                    <select name="exam_type" id="exam_type" class="form-select" aria-label="Default select example">
                                        <option value="1" <?php echo ($data['exam_type'] == 1) ? 'selected' : ''; ?>>Mid</option>
                                        <option value="2" <?php echo ($data['exam_type'] == 2) ? 'selected' : ''; ?>>Quiz</option>
                                        <option value="3" <?php echo ($data['exam_type'] == 3) ? 'selected' : ''; ?>>Viva</option>
                                        <option value="4" <?php echo ($data['exam_type'] == 4) ? 'selected' : ''; ?>>Final</option>
                                    </select>
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['exam_typeErrMsg']) ? $_SESSION['exam_typeErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="marks">Marks:</label>
                                    <input type="text" id="marks" name="marks" class="form-control"value="<?php echo $data['marks']?>">
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['marksErrMsg']) ? $_SESSION['marksErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="instructor_id">Instructor:</label>
                                    <input type="text" id="instructor_id" name="instructor_id" class="form-control" value="<?php 
                                                                                                                                foreach ($result1 as $data1) {
                                                                                                                                    if ($data['instructor_id'] == $data1['user_id']) {
                                                                                                                                        echo $data1['username'];
                                                                                                                                        break;
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            ?>" readonly>
                                    <br>
                                    <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['instructor_idErrMsg']) ? $_SESSION['instructor_idErrMsg'] : ""; ?></p>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="confirmUpdate" class="btn btn-primary">Confirm Edit</button>
                                </div>
                            </form>
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
