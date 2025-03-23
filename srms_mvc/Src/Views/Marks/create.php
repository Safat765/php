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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Marks
                            <div>
                                <form action="../Controllers/marksController.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../Controllers/marksController.php" method="post">
                            <div class="mb-3">
                                <label for="student_id">Student:</label>
                                <br>
                                <select name='student_id' id='student_id' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select Student</option>
                                    <?php
                                        foreach ($result as $data) {                                           
                                    ?>                                            
                                            <option value="<?php echo $data['user_id'];?>"><?php echo $data['username'] . " - " . $data['registration_number'];?></option>                                            
                                    <?php
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['student_id_error_msg']) ? $_SESSION['student_id_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="exam_id">Exam Semester:</label>
                                <br>
                                <select name='exam_id' id='exam_id' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select exm given samester</option>
                                    <?php
                                        $examTypes = [1 => "Mid", 2 => "Quiz", 3 => "Viva", 4 => "Final"];
                                            foreach ($result2 as $data) {                                    ?>
                                                <option value="<?php echo $data['exam_id'];?>">
                                                    <?php
                                                        $sem = $data['semester'];
                                                        switch($sem) {
                                                            case 1:
                                                                echo "1st Year 1st Semester" . " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 2:
                                                                echo "1st Year 2nd Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 3:
                                                                echo "1st Year 3rd Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 4:
                                                                echo "2nd Year 1st Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 5:
                                                                echo "2nd Year 2nd Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 6:
                                                                echo "2nd Year 3rd Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 7:
                                                                echo "3rd Year 1st Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 8:
                                                                echo "3rd Year 2nd Semester". $examTypes[$data['exam_type']];
                                                                break;
                                                            case 9:
                                                                echo "3rd Year 3rd Semester". " - " . $examTypes[$data['exam_type']];;
                                                                break;
                                                            case 10:
                                                                echo "4th Year 1st Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 11:
                                                                echo "4th Year 2nd Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;
                                                            case 12:
                                                                echo "4th Year 3rd Semester". " - " . $examTypes[$data['exam_type']];
                                                                break;                                    
                                                        }
                                                    ?>
                                                </option>                                            
                                    <?php
                                            }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['exam_id_error_msg']) ? $_SESSION['exam_id_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="course_id">Course:</label>
                                <br>
                                <select name='course_id' id='course_id' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select the Course</option>
                                    <?php
                                        foreach ($result3 as $data) {
                                            if (($_SESSION['username'] === $data['assigned_to']) || $_SESSION['user_type'] == 1) {
                                    ?>                                      
                                            <option value="<?php echo $data['course_id'];?>"><?php echo $data['name'];?></option>                                            
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_id_error_msg']) ? $_SESSION['course_id_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="marks">Marks:</label>
                                <input type="text" id="marks" name="marks" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['marks_error_msg']) ? $_SESSION['marks_error_msg'] : ""; ?></p>
                            </div>                            
                            <div class="mb-3">
                                <label for="semester">Semester:</label>
                                <br>
                                <select name='semester' id='semester' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select the Course</option>
                                    <?php
                                        foreach ($result4 as $data) {
                                    ?>                                            
                                            <option value="<?php echo $data['semester'];?>"><?php 
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
                                                                                            ?></option>                                            
                                    <?php
                                            }
                                    ?>
                                </select>
                            </div>
                            <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['semester_error_msg']) ? $_SESSION['semester_error_msg'] : ""; ?></p>
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
