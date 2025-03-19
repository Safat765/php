<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // include '../View/navbar.php';
    include '../View/sideBar.php';
    include_once '../.././Msg/message.php';
    include_once '../Controller/marks.php'
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
                            <form action="../Controller/marks.php" method="get">
                                <button class="btn btn-danger float-end" name="backFromEdit">BACK</button>
                            </form>
                            <!-- <a href="../view/Marks/Index.php" class="btn btn-danger float-end">BACK</a> -->
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                                foreach ($result as $data) {
                                    ?>
                                        <form action="../Controller/marks.php" method="post">
                                        <input type="hidden" name="_method" value="PUT">

                                            <div class="mb-3">
                                                <input type="hidden" id="marks_id" name="marks_id" value="<?php echo $data['marks_id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_id">Student ID:</label>
                                                <br>                                                 
                                                <select name='student_id' id='student_id' class='form-select' aria-label='Default select example'>
                                                    <?php
                                                            foreach ($result1 as $data1) { 
                                                    ?>                                            
                                                                <option value="<?php echo $data1['user_id']; ?>" <?php echo ($data1['user_id'] == $data['student_id']) ? 'selected' : ''; ?>>
                                                                    <?php echo $data1['username']; ?>
                                                                </option>
                                                    <?php
                                                            }
                                                    ?>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exam_id">Exam ID:</label>
                                                <input type="text" id="exam_id" name="exam_id" class="form-control" value="<?php echo $data['exam_id']; ?>" readonly>
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
                                                    <option value="summer" <?php echo ($data['semester'] === "summer") ? 'selected' : ''; ?>>Summer</option>
                                                    <option value="fall" <?php echo ($data['semester'] === "fall") ? 'selected' : ''; ?>>Fall</option>
                                                    <option value="spring" <?php echo ($data['semester'] === "spring") ? 'selected' : ''; ?>>Spring</option>
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