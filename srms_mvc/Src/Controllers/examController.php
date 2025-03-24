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
        public function create($ID, $examTitle, $departmentID, $semester, $credit, $examType, $marks, $instructorID, $createdBy) 
        {
            $ID = sanitize($ID);
            $examTitle = sanitize($examTitle);
            $departmentID = sanitize($departmentID);
            $semester = sanitize($semester);
            $credit = sanitize($credit);
            $examType = sanitize($examType);
            $marks = sanitize($marks);
            $createdBy = sanitize($createdBy);
            $instructorID = sanitize($instructorID);
            $isValid = true;
            $examExist = null;

            if (empty($ID)) {
                $_SESSION['course_id_error_msg'] = "Course required!";
                $isValid = false;
            } else {
                $_SESSION['course_id_error_msg'] = "";
            }

            if (empty($examTitle)) {
                $_SESSION['exam_title_error_msg'] = "Exam title required!";
                $isValid = false;
            } else {
                $_SESSION['exam_title_error_msg'] = "";
            }

            if (empty($departmentID)) {
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

            if (empty($examType)) {
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
            
            if (empty($createdBy)) {
                $_SESSION['created_by_error_msg'] = "Created by required!";
                $isValid = false;
            } else {
                $_SESSION['created_by_error_msg'] = "";
            }           
            
            if (empty($instructorID)) {
                $_SESSION['instructor_id_error_msg'] = "Instructor id required!";
                $isValid = false;
            } else {
                $_SESSION['instructor_id_error_msg'] = "";
            }

            $objExam = new ExamModel();

            if ($isValid === true) {
                $examExist = $objExam->checkExam($ID, $semester, $examType);                
                
                if ($examExist == 0) {
                    $objExam->create($ID, $examTitle, $departmentID, $semester, $credit, $examType, $marks, $instructorID, $createdBy);
                    $_SESSION['create_dep_msg'] = "Exam added successfully";
                    $this->showIndex();
                } else {
                    $_SESSION['create_dep_msg'] = " This Exam already exists on $semester semester and $examType type";
                    $this->showIndex();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showCreatePage();
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

        public function editCall($ID) 
        {            
            $objExam = new ExamModel();
            $result = $objExam->showUpdateUserDate($ID);
            $result1 = $objExam->showFieldsName();

            if (mysqli_num_rows($result) > 0) {
                
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Exam/edit.php';
                }
            } else {
                echo "<h3> No data found </h3>";
            }
        }

        public function updateExam($ID1, $examTitle, $credit, $examType, $marks) 
        {
            $ID = sanitize($ID1);
            $examTitle = sanitize($examTitle);
            $credit = sanitize($credit);
            $examType = sanitize($examType);
            $marks = sanitize($marks);
            $isValid = true;
            $examExist = null;

            if (empty($examTitle)) {
                $_SESSION['exam_title_error_msg'] = "Exam title required!";
                $isValid = false;
            } else {
                $_SESSION['exam_title_error_msg'] = "";
            }

            if (empty($credit)) {
                $_SESSION['credit_error_msg'] = "Credit required!";
                $isValid = false;
            } else {
                $_SESSION['credit_error_msg'] = "";
            }

            if (empty($examType)) {
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

            $model = new ExamModel();
            
            if ($isValid === true) {
                
                if ($examExist == 0) {
                    $model->update($ID,  $examTitle, $credit, $examType, $marks);
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

        public function deleteExam($ID) 
        {
            $model = new ExamModel();
            $ID = sanitize($ID);
            $model->delete($ID);
            $_SESSION['create_dep_msg'] = "Exam deleted successfully";
            $this->showIndex();
        }

        public function showCreatePage()
        {
            $courseModel = new CourseModel();
            $objDepartment = new DepartmentModel();
            $objUser = new UserModel();
            $result = $courseModel->showList();
            $result1 = $objDepartment->showFullList();
            $result2 = $objUser->showInstructorList(2);

            if (mysqli_num_rows($result) > 0) {
               
                if (mysqli_num_rows($result1) > 0) {
                    
                    if (mysqli_num_rows($result2) > 0) {
                        include '../Views/Exam/create.php';
                    }
                }
            }
        }

        public function showIndex()
        {
            $objExam = new ExamModel();
            $depModel = new DepartmentModel();
            $result = $objExam->showList();
            $result1 = $objExam->showCourseName();
            $result2 = $depModel->showFullList();
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
            $createdBy = $_SESSION['user_id'];
            $ID = isset($_POST['course_id']) ? $_POST['course_id'] : null;            
            $examTitle = isset($_POST['exam_title']) ? $_POST['exam_title'] : null;            
            $departmentID = isset($_POST['department_id']) ? $_POST['department_id'] : null;            
            $semester = isset($_POST['semester']) ? $_POST['semester'] : null;            
            $credit = isset($_POST['credit']) ? $_POST['credit'] : null;            
            $examType = isset($_POST['exam_type']) ? $_POST['exam_type'] : null;            
            $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
            $instructorID = isset($_POST['instructor_id']) ? $_POST['instructor_id'] : null;

            $objExam->create($ID, $examTitle, $departmentID, $semester, $credit, $examType, $marks, $instructorID, $createdBy);
        }

        if (isset($_POST['backToDashboard'])) {
            $objExam->backToDashboard();
        }

        if (isset($_POST['editCall'])) {
            $ID = $_POST['exam_id'];
            $objExam->editCall($ID);
        }

        if (isset($_POST['createExam'])) {
            $objExam->showCreatePage();
        }

        if (isset($_POST['_method'])) {
            
            if ($_POST['_method'] === "PUT") {
                $ID = $_POST['exam_id'];
                $examTitle = $_POST['exam_title'];
                $credit = $_POST['credit'];
                $examType = $_POST['exam_type'];
                $marks = $_POST['marks'];
                $objExam->updateExam($ID, $examTitle, $credit, $examType, $marks);
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