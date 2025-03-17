<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/result.php';
    require '../Model/course.php';
    require '../../Data/cleanData.php';

    class result{
        public static function CGPA($student_id){
            $isValid = true;
            $student_id = sanitize($student_id);

            if (empty($student_id)) {
                $_SESSION['student_idErrMsg'] = "student is required";
                $isValid = false;
            } else {
                $_SESSION['student_idErrMsg'] = "";
            }

            $num_rows = resultModel::check_student_id($student_id);

            if ($isValid === true) {
                if ($num_rows == 0){  

                    $cgpa = resultModel::get_avg_marks($student_id);

                    resultModel::create_cgpa($student_id, $cgpa);
                    $_SESSION['create_dep_msg'] = "CGPA created successfully";
                    header ('Location: ../View/Result/create.php');
                    exit(0);
                } else{
                    $_SESSION['create_dep_msg'] = "CGPA already assigned";
                    header ('Location: ../View/Result/create.php');
                    exit(0);
                }
            } else {                
                $_SESSION['create_dep_msg'] = "Fill up the field first";
                header ('Location: ../View/Result/create.php');
                exit(0);
            }
        }
        public static function back_TO_dashboard() {
            if (isset($_SESSION['student_idErrMsg'])) {

                unset($_SESSION['student_idErrMsg']);

                header('Location: ../View/dashboardView.php');
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit(0);
            }
        }
        
        public static function delete_result($result_id) {
            $marks_id = sanitize($result_id);
            $result = resultModel::delete($result_id);
            if ($result) {
                $_SESSION['create_dep_msg'] = "Result deleted successfully";
                header('Location: ../View/Result/Index.php');
            } else {
                $_SESSION['create_dep_msg'] = "Result not deleted";
                header('Location: ../View/Result/Index.php');
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['create']) && !empty($_POST['student_id'])){
            $student_id = $_POST['student_id'];
            result::CGPA($student_id);
        }
        if (isset($_POST['back_dashboard'])){
            result::back_TO_dashboard();
        }
        if (isset($_POST['delete'])) {
            result::delete_result($_POST['result_id']);
        }
    }
    else {
        echo "Post method not working";
    }

?>