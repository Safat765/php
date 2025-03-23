<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../Models/course.php';
    require '../../Data/cleanData.php';

    class Course
    {
        public function createCourse($course_name, $status, $course_credit, $assigned_to_instructur, $created_by)
        {
            $course_name = sanitize($course_name);
            $assigned_to = sanitize($assigned_to_instructur);
            $course_credit = sanitize($course_credit);
            $course_created_by = $created_by;
            $course_status = $status;
            $isValid = true;        
            $course_Exist = null;

            if (empty($course_name)) {
                $_SESSION['course_name_error_msg'] = "Course Name required!";
                $isValid = false;
            } else {
                $_SESSION['course_name_error_msg'] = "";
            }

            if (empty($assigned_to)) {
                $_SESSION['assigned_to_error_msg'] = "Course status required!";
                $isValid = false;
            } else {
                $_SESSION['assigned_to_error_msg'] = "";
            }

            if (empty($course_credit)) {
                $_SESSION['course_credit_error_msg'] = "Course credit required!";
                $isValid = false;
            } else {
                $_SESSION['course_credit_error_msg'] = "";
            }

            $objCourse = new CourseModel();

            if ($isValid === true) {            
                $course_Exist = $objCourse->checkCourse($course_name);

                if ($course_Exist == 0) {
                    $objCourse->createCourseModel($course_name, $course_status, $course_credit, $assigned_to, $course_created_by);
                    $_SESSION['create_dep_msg'] = "Course added successfully";
                    $this->showAllCourse();
                } else {
                    $_SESSION['create_dep_msg'] = " This Course already exists";
                    $this->showAllCourse();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showAllCourse();
            }
        }
        public function backToDashboard()
        {
            if (isset($_SESSION['course_name_error_msg']) && isset($_SESSION['assigned_to_error_msg']) && isset($_SESSION['course_credit_error_msg'])) {
                unset($_SESSION['course_name_error_msg']);
                unset($_SESSION['assigned_to_error_msg']);
                unset($_SESSION['course_credit_error_msg']);    
                header ('Location: ../Views/dashboard.php');
                exit;
            } else {    
                unset($_SESSION['course_name_error_msg']);
                unset($_SESSION['assigned_to_error_msg']);
                unset($_SESSION['course_credit_error_msg']);        
                header ('Location: ../Views/dashboard.php');
                exit;
            }
        }
        public function editCall($course_id)
        {
            $objCourse = new CourseModel();
            $result = $objCourse->showUpdateCourseDate($course_id);
            $result1 = $objCourse->assignedTo();

            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Course/edit.php';
                }  else {
                    echo "<h3> No id found </h3>";
                }
            } else {
                echo "<h3> No id found </h3>";
            }
        }
        public function updateCourse($cID, $cName, $cCredit, $cassigned_to)
        {
            $course_id = sanitize($cID);
            $course_name = sanitize($cName);
            $assigned_to = sanitize($cassigned_to);
            $credit = sanitize($cCredit);
            $objCourse = new CourseModel(); 
            $objCourse->update($course_id, $course_name, $credit, $assigned_to);
            $_SESSION['create_dep_msg'] = "Course edited Successfully";
            $this->showAllCourse();       
        }
        public function showCreatePage()
        {
            $objCourse = new CourseModel();
            $result = $objCourse->assignedTo();

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Course/create.php';
            }
        }
        public function showAllCourse()
        {            
            $objCourse = new CourseModel();
            $result = $objCourse->showList();

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Course/Index.php';
            } else {
                echo "<tr><td colspan='5'>No users found.</td></tr>";
            }
        }
        public function deleteCourse($course_id)
        {
            $objCourse = new CourseModel();
            $objCourse->delete($course_id);
            $_SESSION['create_dep_msg'] =" ". $course_id . " number course Deleted Successfully";
            $this->showAllCourse();
        }

    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $obj = new Course();

        if (isset($_POST['create'])) {
            $created_by = $_SESSION['user_id'];
            $status = 1;
            $obj->createCourse($_POST['course_name'], $status, $_POST['course_credit'], $_POST['assigned_to'], $created_by);            
        }

        if (isset($_POST['back_dashboard'])) {
            $obj->backToDashboard();
        }

        if (isset($_POST['editCall'])) {
            $obj->editCall($_POST['course_id']);
        }

        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $obj->updateCourse($_POST['course_id'], $_POST['name'], $_POST['credit'], $_POST['assigned_to']);
            }
            elseif ($_POST['_method'] === "DELETE") {
                $obj->deleteCourse($_POST['course_id']);
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {

        $obj = new Course();
        
        if (isset($_GET['viewAllCourse'])) {
            $obj->showAllCourse();
        }
        
        if (isset($_GET['createCourse'])) {
            $obj->showCreatePage();
        }
        
        if (isset($_GET['backToIndexFromEdit'])) {
            $obj->showAllCourse();
        }
    }

?>

