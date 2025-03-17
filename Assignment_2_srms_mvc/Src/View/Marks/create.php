<?php
    session_start();
    include '../../../Msg/message.php';
    include '../../Model/exam.php';
    include '../../Model/marks.php';
    include '../../Model/user.php';
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
                        <h4>Add Marks
                            <div>
                                <form action="../../Controller/marks.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../../Controller/marks.php" method="post">

                            <div class="mb-3">
                                <label for="student_id">Student:</label>
                                <br>
                                <select name='student_id' id='student_id' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select Student</option>
                                    <?php
                                        $result = show_instructor_list(3);
                                        if (mysqli_num_rows($result) > 0) {
                                            foreach ($result as $data) {                                           
                                    ?>                                            
                                                <option value="<?php echo $data['user_id'];?>"><?php echo $data['username'];?></option>                                            
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['student_idErrMsg']) ? $_SESSION['student_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="exam_id">Exam Semester:</label>
                                <br>
                                <select name='exam_id' id='exam_id' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select exm given samester</option>
                                    <?php
                                        $examTypes = [1 => "Mid", 2 => "Quiz", 3 => "Viva", 4 => "Final"];
                                        $result = examModel::show_List();
                                        if (mysqli_num_rows($result) > 0) {
                                            foreach ($result as $data) {          
                                    ?>
                                                <option value="<?php echo $data['exam_id'];?>">
                                                    <?php echo $data['semester'] . ' - ' . $examTypes[$data['exam_type']]; ?>
                                                </option>                                            
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['exam_idErrMsg']) ? $_SESSION['exam_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="course_id">Course:</label>
                                <br>
                                <select name='course_id' id='course_id' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select the Course</option>
                                    <?php
                                        $result = MarksModel::exam_course();
                                        if (mysqli_num_rows($result) > 0) {
                                            foreach ($result as $data) {                                         
                                    ?>                                            
                                                <option value="<?php echo $data['course_id'];?>"><?php echo $data['name'] . " - " . $data['semester'];?></option>                                            
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_idErrMsg']) ? $_SESSION['course_idErrMsg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="marks">Marks:</label>
                                <input type="text" id="marks" name="marks" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['marksErrMsg']) ? $_SESSION['marksErrMsg'] : ""; ?></p>
                            </div>                            
                            <div class="mb-3">
                                <label for="semester">Semester:</label>
                                <select name="semester" id="semester" class="form-select" aria-label="Default select example">                                    
                                    <option value="" disabled selected>Select the semester</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Fall">Fall</option>
                                    <option value="Spring">Spring</option>
                                </select>
                            </div>
                            <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['semesterErrMsg']) ? $_SESSION['semesterErrMsg'] : ""; ?></p>
                            </div>
                            <br>
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