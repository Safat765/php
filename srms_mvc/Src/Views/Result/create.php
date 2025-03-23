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
                        <h4>Add Result
                            <div>
                                <form action="../Controllers/resultControllers.php" method="post">
                                    <button type="submit" name="back_dashboard" class="btn btn-danger float-end">BACK</button>
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="../Controllers/resultControllers.php" method="post">
                            <div class="mb-3">
                                <label for="student_id">Student ID:</label>
                                <br>
                                <select name='student_id' id='student_id' class='form-select' aria-label='Default select example'>
                                    <option value='' disabled selected>Select the Student</option>
                                    <?php
                                        foreach ($result as $data) {                                    
                                    ?>                                            
                                            <option value="<?php echo $data['student_id'];?>"><?php echo $data['username'];?></option>                                            
                                    <?php
                                        }
                                    ?>
                                </select>
                                <br>
                                <p style="color: red; font-weight: bold;"><?php  echo isset($_SESSION['student_id_error_msg']) ? $_SESSION['student_id_error_msg'] : ""; ?></p>
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
