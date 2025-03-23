<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Models/exam.php';
    require '../Models/user.php';
    require '../Models/department.php';
    require '../Models/course.php';
    require '../../Data/cleanData.php';

    class ExamComtroller 
    {
        public function createExam($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by) 
        {
            $course_id = sanitize($course_id);
            $exam_title = sanitize($exam_title);
            $department_id = sanitize($department_id);
            $semester = sanitize($semester);
            $credit = sanitize($credit);
            $exam_type = sanitize($exam_type);
            $marks = sanitize($marks);
            $instructor_id = sanitize($instructor_id);
            $created_by = sanitize($created_by);
            $isValid = true;
            $exam_Exist = null;

            if (empty($course_id)) {
                $_SESSION['course_id_error_msg'] = "Course required!";
                $isValid = false;
            } else {
                $_SESSION['course_id_error_msg'] = "";
            }

            if (empty($exam_title)) {
                $_SESSION['exam_title_error_msg'] = "Exam title required!";
                $isValid = false;
            } else {
                $_SESSION['exam_title_error_msg'] = "";
            }

            if (empty($department_id)) {
                $_SESSION['department_id_error_msg'] = "Department required!";
                $isValid = false;
            } else {
                $_SESSION['department_id_error_msg'] = "";
            }

            if (empty($semester)) {
                $_SESSION['semester_error_msg'] = "Semester required!";
                $isValid = false;
            } else {
                $_SESSION['semester_error_msg'] = "";
            }

            if (empty($credit)) {
                $_SESSION['credit_error_msg'] = "Credit required!";
                $isValid = false;
            } else {
                $_SESSION['credit_error_msg'] = "";
            }

            if (empty($exam_type)) {
                $_SESSION['exam_type_error_msg'] = "Exam type required!";
                $isValid = false;
            } else {
                $_SESSION['exam_type_error_msg'] = "";
            }
            
            if (empty($marks)) {
                $_SESSION['marks_error_msg'] = "Marks required!";
                $isValid = false;
            } else {
                $_SESSION['marks_error_msg'] = "";
            }            
            
            if (empty($instructor_id)) {
                $_SESSION['instructor_id_error_msg'] = "instructor required!";
                $isValid = false;
            } else {
                $_SESSION['instructor_id_error_msg'] = "";
            }            
            
            if (empty($created_by)) {
                $_SESSION['created_by_error_msg'] = "created_by required!";
                $isValid = false;
            } else {
                $_SESSION['created_by_error_msg'] = "";
            }

            $objExam = new examModel();

            if ($isValid === true) {
                $exam_Exist = $objExam->checkExam($course_id, $semester, $exam_type);
                if ($exam_Exist == 0) {
                    $objExam->createExam($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by);
                    $_SESSION['create_dep_msg'] = "Exam added successfully";
                    $this->showIndex();
                } else {
                    $_SESSION['create_dep_msg'] = " This Exam already exists on $semester semester and $exam_type type";
                    $this->showIndex();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showIndex();
            }
        }        
        public function backToDashboard()
        {
            if (isset($_SESSION['course_id_error_msg']) && isset($_SESSION['exam_title_error_msg']) && isset($_SESSION['department_id_error_msg']) && isset($_SESSION['semester_error_msg']) && isset($_SESSION['credit_error_msg']) && isset($_SESSION['exam_type_error_msg']) && isset($_SESSION['marks_error_msg']) && isset($_SESSION['instructor_id_error_msg']) && isset($_SESSION['created_by_error_msg'])) {
                unset($_SESSION['course_id_error_msg']);
                unset($_SESSION['exam_title_error_msg']);
                unset($_SESSION['department_id_error_msg']);
                unset($_SESSION['semester_error_msg']);
                unset($_SESSION['credit_error_msg']);
                unset($_SESSION['exam_type_error_msg']);
                unset($_SESSION['marks_error_msg']);
                unset($_SESSION['instructor_id_error_msg']);
                unset($_SESSION['created_by_error_msg']);    
                header ('Location: ../Views/dashboard.php');
                exit;
            } else {
                unset($_SESSION['course_id_error_msg']);
                unset($_SESSION['exam_title_error_msg']);
                unset($_SESSION['department_id_error_msg']);
                unset($_SESSION['semester_error_msg']);
                unset($_SESSION['credit_error_msg']);
                unset($_SESSION['exam_type_error_msg']);
                unset($_SESSION['marks_error_msg']);
                unset($_SESSION['instructor_id_error_msg']);
                unset($_SESSION['created_by_error_msg']);         
                header ('Location: ../Views/dashboard.php');
                exit;
            }
        }
        public function editCall($exam_id) 
        {            
            $objExam = new examModel();
            $result = $objExam->showUpdateUserDate($exam_id);
            $result1 = $objExam->showFieldsName();

            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Exam/edit.php';
                }
            } else {
                echo "<h3> No data found </h3>";
            }
        }
        public function updateExam($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id) 
        {
            $exam_id = sanitize($exam_id);
            $course_id = sanitize($course_id);
            $exam_title = sanitize($exam_title);
            $department_id = sanitize($department_id);
            $semester = sanitize($semester);
            $credit = sanitize($credit);
            $exam_type = sanitize($exam_type);
            $marks = sanitize($marks);
            $instructor_id = sanitize($instructor_id);
            $isValid = true;
            $exam_Exist = null;

            if (empty($course_id)) {
                $_SESSION['course_id_error_msg'] = "Course required!";
                $isValid = false;
            } else {
                $_SESSION['course_id_error_msg'] = "";
            }

            if (empty($exam_title)) {
                $_SESSION['exam_title_error_msg'] = "Exam title required!";
                $isValid = false;
            } else {
                $_SESSION['exam_title_error_msg'] = "";
            }

            if (empty($department_id)) {
                $_SESSION['department_id_error_msg'] = "Department required!";
                $isValid = false;
            } else {
                $_SESSION['department_id_error_msg'] = "";
            }

            if (empty($semester)) {
                $_SESSION['semester_error_msg'] = "Semester required!";
                $isValid = false;
            } else {
                $_SESSION['semester_error_msg'] = "";
            }

            if (empty($credit)) {
                $_SESSION['credit_error_msg'] = "Credit required!";
                $isValid = false;
            } else {
                $_SESSION['credit_error_msg'] = "";
            }

            if (empty($exam_type)) {
                $_SESSION['exam_type_error_msg'] = "Exam type required!";
                $isValid = false;
            } else {
                $_SESSION['exam_type_error_msg'] = "";
            }
            
            if (empty($marks)) {
                $_SESSION['marks_error_msg'] = "Marks required!";
                $isValid = false;
            } else {
                $_SESSION['marks_error_msg'] = "";
            }            
            
            if (empty($instructor_id)) {
                $_SESSION['instructor_id_error_msg'] = "instructor required!";
                $isValid = false;
            } else {
                $_SESSION['instructor_id_error_msg'] = "";
            }

            if (empty($created_by)) {
                $_SESSION['created_by_error_msg'] = "created_by required!";
                $isValid = false;
            } else {
                $_SESSION['created_by_error_msg'] = "";
            }

            $model = new examModel();
            
            if ($isValid === true) {
                if ($exam_Exist == 0) {
                    $model->updateExam($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id);
                    $_SESSION['create_dep_msg'] = "Exam edited successfully";
                    $this->showIndex();
                } else {
                    $_SESSION['create_dep_msg'] = " Failed to update the exam";
                    $this->showIndex();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showIndex();
            }
        }
        public function deleteExam($exam_id) 
        {
            $model = new examModel();
            $exam_id = sanitize($exam_id);
            $model->deleteExam($exam_id);
            $_SESSION['create_dep_msg'] = "Exam deleted successfully";
            $this->showIndex();
        }
        public function showCreatePage()
        {
            $courseModel = new CourseModel();
            $objDepartment = new department();
            $objUser = new user();
            $result = $courseModel->showList();
            $result1 = $objDepartment->showDepartementList();
            $result3 = $objUser->showInstructorList(2);
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    if (mysqli_num_rows($result3) > 0) {
                        include '../Views/Exam/create.php';
                    }
                }
            }
        }
        public function showIndex()
        {
            $objExam = new examModel();
            $depModel = new department();
            $result = $objExam->showList();
            $result1 = $objExam->showCourseName();
            $result2 = $depModel->showFullDepartmentList();
            $result3 = $objExam->showUserName();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    if (mysqli_num_rows($result2) > 0) {
                        if (mysqli_num_rows($result3) > 0) {
                            include '../Views/Exam/Index.php';
                        }
                    }
                }
            } else {
                echo "<tr><td colspan='10'>No data availabe.</td></tr>";
            }
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $objExam = new ExamComtroller();

        if (isset($_POST['create'])) {
            $course_id = $_POST['course_id'];
            $exam_title = $_POST['exam_title'];
            $department_id = $_POST['department_id'];
            $semester = $_POST['semester'];
            $credit = $_POST['credit'];
            $exam_type = $_POST['exam_type'];
            $marks = $_POST['marks'];
            $instructor_id = $_POST['instructor_id'];
            $created_by = $_SESSION['user_id'];
            $objExam->createExam($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by);
        }

        if (isset($_POST['backToDashboard'])) {
            $objExam->backToDashboard();
        }

        if (isset($_POST['editCall'])) {
            $exam_id = $_POST['exam_id'];
            $objExam->editCall($exam_id);
        }

        if (isset($_POST['createExam'])) {
            $objExam->showCreatePage();
        }

        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {$exam_id = $_POST['exam_id'];
                $course_id = $_POST['course_id'];
                $exam_title = $_POST['exam_title'];
                $department_id = $_POST['department_id'];
                $semester = $_POST['semester'];
                $credit = $_POST['credit'];
                $exam_type = $_POST['exam_type'];
                $marks = $_POST['marks'];
                $instructor_id = $_POST['instructor_id'];
                $objExam->updateExam($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id);
            }
            if ($_POST['_method'] === "DELETE") {
                $objExam->deleteExam($_POST['exam_id']);
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {  
              
        $objExam = new ExamComtroller();

        if (isset($_GET['viewAllExam'])) {
            $objExam->showIndex();
        }

        if (isset($_GET['back'])) {
            $objExam->showIndex();
        }
    }
?>