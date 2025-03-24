<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../Models/course.php';
    require '../../Data/cleanData.php';

    class CourseController
    {
        public function create($courseName, $status1, $courseCredit, $assignedToInstructur, $createdBy1)
        {
            $name = sanitize($courseName);
            $assignedTo = sanitize($assignedToInstructur);
            $credit = sanitize($courseCredit);
            $createdBy = $createdBy1;
            $status = $status1;
            $isValid = true;        
            $courseExist = null;

            if (empty($name)) {
                $_SESSION['course_name_error_msg'] = "Course Name required!";
                $isValid = false;
            } else {
                $_SESSION['course_name_error_msg'] = "";
            }

            if (empty($assignedTo)) {
                $_SESSION['assigned_to_error_msg'] = "Assigned to required!";
                $isValid = false;
            } else {
                $_SESSION['assigned_to_error_msg'] = "";
            }

            if (empty($credit)) {
                $_SESSION['course_credit_error_msg'] = "Course credit required!";
                $isValid = false;
            } else {
                $_SESSION['course_credit_error_msg'] = "";
            }

            $objCourse = new CourseModel();

            if ($isValid === true) {            
                $courseExist = $objCourse->checkCourse($name);

                if ($courseExist == 0) {
                    $objCourse->createCourse($name, $status, $credit, $assignedTo, $createdBy);
                    $_SESSION['create_dep_msg'] = "Course added successfully";
                    $this->showAll();
                } else {
                    $_SESSION['create_dep_msg'] = " This Course already exists";
                    $this->showAll();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showCreatePage();
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

        public function editCall($id)
        {
            $objCourse = new CourseModel();
            $result = $objCourse->showUpdateCourseDate($id);
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

        public function update($id, $name, $credit, $cAssignedTo)
        {
            $ID = sanitize($id);
            $Name = sanitize($name);
            $assignedTo = sanitize($cAssignedTo);
            $credit = sanitize($credit);

            $objCourse = new CourseModel(); 
            $objCourse->update($ID, $Name, $credit, $assignedTo);
            $_SESSION['create_dep_msg'] = "Course edited Successfully";
            $this->showAll();       
        }

        public function showCreatePage()
        {
            $objCourse = new CourseModel();
            $result = $objCourse->assignedTo();

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Course/create.php';
            }
        }

        public function showAll()
        {            
            $objCourse = new CourseModel();
            $result = $objCourse->showList();

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Course/Index.php';
            } else {
                echo "<tr><td colspan='5'>No users found.</td></tr>";
            }
        }

        public function delete($id)
        {
            $objCourse = new CourseModel();
            $objCourse->delete($id);
            $_SESSION['create_dep_msg'] =" ". $id . " number course Deleted Successfully";
            $this->showAll();
        }

    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $obj = new CourseController();

        if (isset($_POST['create'])) {
            $created_by = $_SESSION['user_id'];
            $status = 1;
            $assignedTo = isset($_POST['assigned_to']) ? $_POST['assigned_to'] : null;
            $obj->create($_POST['course_name'], $status, $_POST['course_credit'], $assignedTo, $created_by);            
        }

        if (isset($_POST['back_dashboard'])) {
            $obj->backToDashboard();
        }

        if (isset($_POST['editCall'])) {
            $obj->editCall($_POST['course_id']);
        }

        if (isset($_POST['_method'])) {
            
            if ($_POST['_method'] === "PUT") {
                $obj->update($_POST['course_id'], $_POST['name'], $_POST['credit'], $_POST['assigned_to']);
            }
            
            elseif ($_POST['_method'] === "DELETE") {
                $obj->delete($_POST['course_id']);
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {

        $obj = new CourseController();
        
        if (isset($_GET['viewAllCourse'])) {
            $obj->showAll();
        }
        
        if (isset($_GET['createCourse'])) {
            $obj->showCreatePage();
        }
        
        if (isset($_GET['backToIndexFromEdit'])) {
            $obj->showAll();
        }
    }
?>

