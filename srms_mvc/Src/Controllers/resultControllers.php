<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    ob_start();
    
    require '../Models/result.php';
    require '../Models/course.php';
    require '../../Data/cleanData.php';

    class result
    {
        public static function backToDashboard() 
        {
            if (isset($_SESSION['student_id_error_msg'])) {
                unset($_SESSION['student_id_error_msg']);
                unset($_SESSION['create_dep_msg']);
                header('Location: ../Views/dashboard.php');
                exit(0);
            } else {                
                unset($_SESSION['student_id_error_msg']);
                unset($_SESSION['create_dep_msg']);
                header ('Location: ../Views/dashboard.php');
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
            } else {
                $_SESSION['create_dep_msg'] = "Result not deleted";
                $this->showAllResult();
            }
        }
        public function showCreateResult() 
        {
            $objResult = new resultModel();
            $result = $objResult->showStudents();

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Result/create.php';
            }
        }
        public function showAllResult()
        {
            $objResult = new resultModel();
            $result = $objResult->showResultList();
            $result1 = $objResult->showUsernameRegNumber();

            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Result/Index.php';
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
        }
        public function viewDropDownResult($student_id)
        {
            $objResult = new resultModel();
            $result0 = $objResult->showDropDownResult($student_id);
            $result = $objResult->showSingleStudentResult($student_id);
            $result1 = $objResult->showCourseNameExamTitle();
            
            if (mysqli_num_rows($result0) > 0) {
                if (mysqli_num_rows($result) > 0) {
                    if (mysqli_num_rows($result1) > 0) {
                        include '../Views/Result/dropDownResult.php';
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $objResult = new result();

        if (isset($_POST['back_dashboard'])) {
            $objResult->backToDashboard();
        }

        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "DELETE") {
                $objResult->deleteResult($_POST['result_id']);
            }
        }

        if (isset($_POST['backToIndexFromSingleResult'])) {
            $objResult->showAllResult();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {

        $objResult = new result();

        if (isset($_GET['createResult'])) {
            $objResult->showCreateResult();
        }

        if (isset($_GET['viewAllResult'])) {
            $objResult->showAllResult();
        }

        if (isset($_GET['viewSingleStudentResult'])) {
            $objResult->viewDropDownResult($_GET['student_id']);
        }
    }

?>