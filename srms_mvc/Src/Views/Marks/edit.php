<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include '../Views/sideBar.php';
    include_once '../.././Msg/message.php';
    include_once '../Controllers/marksController.php'
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
                        <h4>Edit Marks
                            <form action="../Controllers/marksController.php" method="get">
                                <button class="btn btn-danger float-end" name="backFromEdit">BACK</button>
                            </form>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        foreach ($result as $data) {
                    ?>
                            <form action="../Controllers/marksController.php" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <input type="hidden" id="marks_id" name="marks_id" value="<?php echo $data['marks_id']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="student_id">Student Name & Reg. number:</label>
                                    <br>                                                 
                                    <select name='student_id' id='student_id' class='form-select' aria-label='Default select example'>
                                    <?php
                                        foreach ($result1 as $data1) { 
                                    ?>                                            
                                            <option value="<?php echo $data1['user_id']; ?>" <?php echo ($data1['user_id'] == $data['student_id']) ? 'selected' : ''; ?>>
                                                <?php echo $data1['username'] . " - " . $data1['registration_number']; ?>
                                            </option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                    <br>
                                </div>
                                <div class="mb-3">
                                    <label for="exam_id">Exam Tilte:</label>
                                        <input type="text" id="exam_id" name="exam_id" class="form-control" value="<?php 
                                                                                                                        foreach ($result3 as $data3) {
                                                                                                                            if ($data3['exam_id'] == $data['exam_id']) {
                                                                                                                                echo $data3['exam_title'];
                                                                                                                                break;
                                                                                                                            }
                                                                                                                        }
                                                                                                                    ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="course_id">Course ID:</label>
                                    <br>
                                    <select name='course_id' id='course_id' class='form-select' aria-label='Default select example'>
                                        <option value='' disabled selected>Select the Course</option>
                                            <?php
                                                foreach ($result2 as $data2) {                                           
                                            ?>                                            
                                                    <option value="<?php echo $data2['course_id']; ?>" <?php echo ($data2['course_id'] == $data['course_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $data2['name']; ?>
                                                    </option>      
                                            <?php
                                                }
                                            ?>
                                    </select>
                                    <br>
                                </div>
                                <div class="mb-3">
                                    <label for="marks">Marks:</label>
                                    <input type="text" id="marks" name="marks" class="form-control" value="<?php echo $data['marks']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="semester">Semester:</label>
                                        <select name="semester" id="semester" class="form-select" aria-label="Default select example">                                    
                                            <option value="" disabled selected>Select the semester</option>
                                            <option value="1" <?php echo ($data['semester'] === "1") ? 'selected' : ''; ?>>1st Year 1st Semester</option>
                                            <option value="2" <?php echo ($data['semester'] === "2") ? 'selected' : ''; ?>>1st Year 2nd Semester</option>
                                            <option value="3" <?php echo ($data['semester'] === "3") ? 'selected' : ''; ?>>1st Year 3rd Semester</option>
                                            <option value="4" <?php echo ($data['semester'] === "4") ? 'selected' : ''; ?>>2nd Year 1st Semester</option>
                                            <option value="5" <?php echo ($data['semester'] === "5") ? 'selected' : ''; ?>>2nd Year 2nd Semester</option>
                                            <option value="6" <?php echo ($data['semester'] === "6") ? 'selected' : ''; ?>>2nd Year 3rd Semester</option>
                                            <option value="7" <?php echo ($data['semester'] === "7") ? 'selected' : ''; ?>>3rd Year 1st Semester</option>
                                            <option value="8" <?php echo ($data['semester'] === "8") ? 'selected' : ''; ?>>3rd Year 2nd Semester</option>
                                            <option value="9" <?php echo ($data['semester'] === "9") ? 'selected' : ''; ?>>3rd Year 3rd Semester</option>
                                            <option value="10" <?php echo ($data['semester'] === "10") ? 'selected' : ''; ?>>4th Year 1st Semester</option>
                                            <option value="11" <?php echo ($data['semester'] === "11") ? 'selected' : ''; ?>>4th Year 2nd Semester</option>
                                            <option value="12" <?php echo ($data['semester'] === "12") ? 'selected' : ''; ?>>4th Year 3rd Semester</option>
                                        </select>
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
