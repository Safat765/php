<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include '../../../Msg/message.php';
    include '../../Model/course.php';
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
                        <h4>Course edit
                            <a href="Index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        $result = CourseModel::showUpdateCourseDate($_SESSION['course_id']);

                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $data) {
                                    ?>
                                        <form action="../../Controller/course.php" method="post">

                                            <div class="mb-3">
                                            <input type="hidden" id="course_id" name="course_id" value="<?php echo $data['course_id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name">Name:</label>
                                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $data['name']?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status">Status:</label>
                                                <input type="text" id="status" name="status" class="form-control" value="<?php echo $data['status']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="credit">Credit:</label>
                                                <input type="text" id="credit" name="credit" class="form-control" value="<?php echo $data['credit']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="created_by">Created By:</label>
                                                <input type="text" id="created_by" name="created_by" class="form-control" value="<?php echo $data['created_by']?>">
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