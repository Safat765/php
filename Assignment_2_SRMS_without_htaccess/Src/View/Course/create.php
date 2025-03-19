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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Course
                            <div>
                                <form action="../Controller/course.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="../Controller/course.php" method="post">
                            
                            <div class="mb-3">
                                <label for="course_name">Name:</label>
                                <input type="text" id="course_name" name="course_name" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_name_error_msg']) ? $_SESSION['course_name_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="course_credit">Credit:</label>
                                <input type="text" id="course_credit" name="course_credit" class="form-control">
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['course_credit_error_msg']) ? $_SESSION['course_credit_error_msg'] : ""; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="assigned_to">Assigned To: </label>
                                <br>
                                <select name="assigned_to" id="assigned_to" class="form-select" aria-label="Default select example">
                                    <option value="" disabled selected>Select the course status</option>
                                    <?php
                                        foreach ($result as $data) {                                           
                                    ?> 
                                        <option value="<?php echo $data['username'];?>"><?php echo $data['username'];?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['assigned_to_error_msg']) ? $_SESSION['assigned_to_error_msg'] : ""; ?></p>
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