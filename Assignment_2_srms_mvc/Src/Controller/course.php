<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require '../Model/course.php';
    require '../../Data/cleanData.php';

    class Course
    {
        public function createCourse($course_name, $course_status, $course_credit, $created_by){
            $course_name = sanitize($course_name);
            $course_status = sanitize($course_status);
            $course_credit = sanitize($course_credit);
            $course_created_by = $created_by;

            $isValid = true;        
            $course_Exist = null;

            if (empty($course_name)) {
                $_SESSION['course_name_error_msg'] = "Course Name required!";
                $isValid = false;
            } else{
                $_SESSION['course_name_error_msg'] = "";
            }

            if (empty($course_status)) {
                $_SESSION['course_status_error_msg'] = "Course status required!";
                $isValid = false;
            }
            else{
                $_SESSION['course_status_error_msg'] = "";
            }

            if (empty($course_credit)){
                $_SESSION['course_credit_error_msg'] = "Course credit required!";
                $isValid = false;
            }
            else{
                $_SESSION['course_credit_error_msg'] = "";
            }

            if ($isValid === true){            
                $course_Exist = CourseModel::checkCourse($course_name);
                if ($course_Exist == 0) {
                    CourseModel::createCourseModel($course_name, $course_status, $course_credit, $course_created_by);
                    $_SESSION['create_dep_msg'] = "Course added successfully";
                    header ('Location: ../View/Course/create.php');
                    exit(0);
                } else {
                    $_SESSION['create_dep_msg'] = " This Course already exists";
                    header ('Location: ../View/Course/create.php');
                    exit(0);
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                header ('Location: ../View/Course/create.php');
                exit(0);
            }
        }
        public function backToDashboard(){
            if (isset($_SESSION['course_name_error_msg']) && isset($_SESSION['course_status_error_msg']) && isset($_SESSION['course_credit_error_msg'])) {
                
                unset($_SESSION['course_name_error_msg']);
                unset($_SESSION['course_status_error_msg']);
                unset($_SESSION['course_credit_error_msg']);
    
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        public function editCall($course_id){
            $result = CourseModel::showUpdateCourseDate($course_id);
            if (mysqli_num_rows($result) > 0) {
                include '../View/Course/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
            // header ('Location: ../View/Course/edit.php');
            // exit(0);
        }
        public function updateCourse($cID, $cName, $cStatus, $cCredit, $cCreatedBy){
            $_SESSION['course_id'] = $cID;
            $cCreatedBy = $_SESSION['username']; 
            echo $cID . " " . $cName . " " . $cStatus . " " . $cCredit . " " . $cCreatedBy;
            CourseModel::update($cID, $cStatus, $cCredit, $cCreatedBy);
            $_SESSION['create_dep_msg'] = "Course edited Successfully";
            header ('Location: ../View/Course/Index.php');
            exit(0);          
        }

    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $obj = new Course();

        if (isset($_POST['create'])) {
            $created_by = $_SESSION['username'];
            $obj->createCourse($_POST['course_name'], $_POST['course_status'], $_POST['course_credit'], $created_by);            
        }
        if (isset($_POST['back_dashboard'])) {
            $obj->backToDashboard();
        }
        if (isset($_POST['edit_Call'])) {
            $obj->editCall($_POST['course_id']);
        }
        if (isset($_POST['delete'])) {
            $course_id = $_POST['course_id'];
            CourseModel::delete($course_id);
            header ('Location: ../View/Course/index.php');
            exit(0);
        }
        if (isset($_POST['confirmUpdate'])) {
            $obj->updateCourse($_POST['course_id'], $_POST['name'], $_POST['status'], $_POST['credit'], $_POST['created_by']);
            exit(0);
        }
    } else {
        $_SESSION['create_dep_msg'] = " Post methor in not working on Course";
        header ('Location: ../View/dashboardView.php');
        unset($_SESSION['create_dep_msg']);
        exit(0);
    }

?>

