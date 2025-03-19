<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    ob_start();
    
    // include '../../Src/View/navbar.php';
    require '../Model/result.php';
    require '../Model/course.php';
    require '../../Data/cleanData.php';

    class result
    {
        public function createCGPA($student_id){
            $isValid = true;
            $student_id = sanitize($student_id);

            if (empty($student_id)) {
                $_SESSION['student_id_error_msg'] = "student is required";
                $isValid = false;
            } else {
                $_SESSION['student_id_error_msg'] = "";
            }
            $model = new resultModel();

            $num_rows = $model->checkStudentID($student_id);

            if ($isValid === true) {
                if ($num_rows == 0) {  

                    $cgpa = $model->getAvgMarks($student_id);
                    $model->createCGPA($student_id, $cgpa);
                    $_SESSION['create_dep_msg'] = "CGPA created successfully";
                    $this->showCreateResult();
                    // header ('Location: ../View/Result/create.php');
                    // exit(0);
                } else{
                    $_SESSION['create_dep_msg'] = "CGPA already assigned";
                    $this->showCreateResult();
                    // header ('Location: ../View/Result/create.php');
                    // exit(0);
                }
            } else {                
                $_SESSION['create_dep_msg'] = "Fill up the field first";
                $this->showCreateResult();
                // header ('Location: ../View/Result/create.php');
                // exit(0);
            }
        }
        public static function back_TO_dashboard() 
        {
            if (isset($_SESSION['student_id_error_msg'])) {
                unset($_SESSION['student_id_error_msg']);
                header('Location: ../View/dashboardView.php');
                exit(0);
            } else {                
                unset($_SESSION['student_id_error_msg']);
                header ('Location: ../View/dashboardView.php');
                exit(0);
            }
        }
        
        public function deleteResult($result_id) 
        {
            $model = new resultModel();
            $id = sanitize($result_id);
            $result = $model->delete($id);
            if ($result) {
                $_SESSION['create_dep_msg'] = "Result deleted successfully";
                $this->showAllResult();
                // header('Location: ../View/Result/Index.php');
            } else {
                $_SESSION['create_dep_msg'] = "Result not deleted";
                $this->showAllResult();
                // header('Location: ../View/Result/Index.php');
            }
        }
        public function showCreateResult() 
        {
            $model = new resultModel();
            $result = $model->show_students();
            if (mysqli_num_rows($result) > 0) {
                include '../View/Result/create.php';
            }
        }
        public function showAllResult()
        {
            $model = new resultModel();
            $result = $model->showResultList();
            $result1 = $model->showUsernameRegNumber();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../View/Result/Index.php';
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
        }
        public function viewSingleStudentResult($student_id)
        {
            $model = new resultModel();
            $result = $model->showSingleStudentResult($student_id);
            $result1 = $model->showCourseNameExamTitle();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../View/Result/singleResult.php';
                }
            } else {
                echo "<tr><td colspan='5'>No users found.</td></tr>";
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $obj = new result();
        if (isset($_POST['create']) && !empty($_POST['student_id'])) {
            $student_id = $_POST['student_id'];
            $obj->createCGPA($student_id);
        }
        if (isset($_POST['back_dashboard'])) {
            $obj->back_TO_dashboard();
        }
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "DELETE") {
                $obj->deleteResult($_POST['result_id']);
            }
        }
        if (isset($_POST['backToIndexFromSingleResult'])) {
            $obj->showAllResult();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
        $obj = new result();
        if (isset($_GET['createResult'])) {
            $obj->showCreateResult();
        }
        if (isset($_GET['viewAllResult'])) {
            $obj->showAllResult();
        }
        if (isset($_GET['viewSingleStudentResult'])) {
            $obj->viewSingleStudentResult($_GET['student_id']);
        }
    }

?>