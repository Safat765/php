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
                            <h4>Edit Department
                                <form action="../Controllers/departmentController.php" method="get">
                                    <button class="btn btn-danger float-end" name="backFromEdit">BACK</button>
                                </form>
                            </h4>
                        </div>
                        <div class="card-body">
                        <?php
                            foreach ($result as $data) {
                        ?>
                                <form action="../Controllers/departmentController.php" method="post">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="mb-3">
                                        <input type="hidden" id="department_id" name="department_id" value="<?php echo $data['department_id']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dept_name">Department Name:</label>
                                        <input type="text" id="dept_name" name="dept_name" class="form-control" value="<?php echo $data['name']?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dept_created_by">Created By:</label>
                                        <input type="text" id="dept_created_by" name="dept_created_by" class="form-control" value="Admin" readonly>
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
