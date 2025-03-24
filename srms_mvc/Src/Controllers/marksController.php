<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Models/marks.php';
    require '../../Data/cleanData.php';
    require '../Models/user.php';
    require '../Models/course.php';
    require '../Models/exam.php';
    require '../Models/result.php';

    class MarksController 
    {
        public static function gpa($marks) 
        {
            if ($marks >=90 && $marks <= 100) {
                $gpa = 4.00;
            } elseif ($marks >= 85 && $marks <= 89) {
                $gpa = 3.75;
            } elseif ($marks >= 80 && $marks <= 84) {
                $gpa = 3.50;
            } elseif ($marks >= 75 && $marks <= 79) {
                $gpa = 3.25;
            } elseif ($marks >= 70 && $marks <= 74) {
                $gpa = 3.00;
            } elseif ($marks >= 65 && $marks <= 69) {
                $gpa = 2.75;
            } elseif ($marks >= 60 && $marks <= 64) {
                $gpa = 2.50;
            } elseif ($marks >= 55 && $marks <= 59) {
                $gpa = 2.25;
            } elseif ($marks < 50) {
                $gpa = 0.00;
            }
            return $gpa;
        }
        public function create($studentId, $examId, $courseId, $marks, $semester) 
        {
            $studentId = sanitize($studentId);
            $examId = sanitize($examId);
            $courseId = sanitize($courseId);
            $marks = sanitize($marks);
            $semester = sanitize($semester);
            $gpa = self::gpa($marks);
            $assignedTo = $_SESSION['username'];
            $isValid = true;
            $marksExist = null;

            if (empty($studentId)) {
                $_SESSION['student_id_error_msg'] = "Student is required";
                $isValid = false;
            } else {
                $_SESSION['student_id_error_msg'] = "";
            }

            if (empty($examId)) {
                $_SESSION['exam_id_error_msg'] = "Exam Semester is required";
                $isValid = false;
            } else {
                $_SESSION['exam_id_error_msg'] = "";
            }

            if (empty($courseId)) {
                $_SESSION['course_id_error_msg'] = "Course is required";
                $isValid = false;
            } else {
                $_SESSION['course_id_error_msg'] = "";
            }

            if (empty($marks)) {
                $_SESSION['marks_error_msg'] = "Marks is required";
                $isValid = false;
            } else {
                $_SESSION['marks_error_msg'] = "";
            }

            if (empty($semester)) {
                $_SESSION['semester_error_msg'] = "semester is required";
                $isValid = false;
            } else {
                $_SESSION['semester_error_msg'] = "";
            }

            if (empty($gpa)) {
                $_SESSION['gpa_error_msg'] = "gpa is required";
                $isValid = false;
            } else {
                $_SESSION['gpa_error_msg'] = "";
            }

            $model = new MarksModel();
            $objResult = new ResultModel();

            if ($isValid === true) {
                $marksExist = $model->checkMarksExist($studentId, $examId, $courseId);
                
                if ($marksExist == 0) {
                    $result = $model->create($studentId, $examId, $courseId, $marks, $semester, $assignedTo, $gpa);
                    $cgpa = $objResult->getAvgMarks($studentId);
                    $objResult->createCGPA($studentId, $cgpa);
                    
                    if ($result) {
                        $_SESSION['create_dep_msg'] = "Marks added successfully";
                        $this->showAll();
                    } else {
                        $_SESSION['create_dep_msg'] = "Marks added to fail";
                        $this->showAll();
                    }
                } else {
                    $_SESSION['create_dep_msg'] = "Marks already exist";
                    $this->showAll();
                }
            }
        }
        public function backToDashboard() 
        {
            if (isset($_SESSION['student_id_error_msg']) && isset($_SESSION['exam_id_error_msg']) && isset($_SESSION['course_id_error_msg']) && isset($_SESSION['marks_error_msg']) && isset($_SESSION['semester_error_msg']) && isset($_SESSION['gpa_error_msg'])) {
                unset($_SESSION['student_id_error_msg']);
                unset($_SESSION['exam_id_error_msg']);
                unset($_SESSION['course_id_error_msg']);
                unset($_SESSION['marks_error_msg']);
                unset($_SESSION['semester_error_msg']);
                unset($_SESSION['gpa_error_msg']);
                header('Location: ../Views/dashboard.php');
            } else {   
                unset($_SESSION['student_id_error_msg']);
                unset($_SESSION['exam_id_error_msg']);
                unset($_SESSION['course_id_error_msg']);
                unset($_SESSION['marks_error_msg']);
                unset($_SESSION['semester_error_msg']);
                unset($_SESSION['gpa_error_msg']);         
                header ('Location: ../Views/dashboard.php');
                exit(0);
            }
        }
        public function delete($marksId, $studentId) 
        {
            $marksId = sanitize($marksId);
            $studentId = sanitize($studentId);
            $objMarks = new MarksModel();
            $result = $objMarks->delete($marksId);

            if ($result) {
                $objMarks->deleteResult($studentId);
                $_SESSION['create_dep_msg'] = "Marks deleted successfully";
                $this->showAll();
            } else {
                $_SESSION['create_dep_msg'] = "Marks not deleted";
                $this->showAll();
            }
        }
        public function showEdit($marksId) 
        {
            $objMarks = new MarksModel();
            $objCourse = new CourseModel();
            $objUser = new UserModel();

            $result = $objMarks->showUpdateUserDate($marksId);
            $result1 = $objUser->showInstructorList(3);
            $result2 = $objCourse->showList();
            $result3 = $objMarks->showMarksListAllName();

            if (mysqli_num_rows($result) > 0) {
                
                if (mysqli_num_rows($result1) > 0) {
                    
                    if (mysqli_num_rows($result2) > 0) {
                        
                        if (mysqli_num_rows($result3) > 0) {
                            include '../Views/Marks/edit.php';
                        }
                    }
                }
            }
        }
        public function update($marksId, $studentId, $courseId, $marks, $semester)
        {
            $model = new MarksModel();

            $marksId = sanitize($marksId);
            $studentId = sanitize($studentId);
            $courseId = sanitize($courseId);
            $marks = sanitize($marks);
            $semester = sanitize($semester);
            $gpa = self::gpa($marks);
            $result = $model->update($marksId, $studentId, $courseId, $marks, $semester, $gpa);
            
            if ($result) {
                $_SESSION['create_dep_msg'] = "Marks updated successfully";
                $this->showAll();
            } else {
                $_SESSION['create_dep_msg'] = "Marks already exist";
                $this->showAll();
            }
        }
        public function showAll()
        {
            $objMarks = new MarksModel();
            $result = $objMarks->showList();
            $result1 = $objMarks->showMarksListAllName();

            if (mysqli_num_rows($result) > 0) {
                
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Marks/Index.php';
                }
            } else {
                echo "<tr><td colspan='8'>No users found.</td></tr>";
            }
        }
        public function showCreatePage()
        {
            $objUser = new UserModel();
            $objExam = new ExamModel();
            $objMarks = new MarksModel();
            $result = $objUser->showInstructorList(3);
            $result2 = $objExam->showList();
            $result3 = $objMarks->examCourse();
            $result4 = $objMarks->showAllSemester();

            if (mysqli_num_rows($result) > 0) {
               
                if (mysqli_num_rows($result2) > 0) {
                    
                    if (mysqli_num_rows($result3) > 0) {
                    
                        if (mysqli_num_rows($result4) > 0) {
                            include '../Views/Marks/create.php';
                        }
                    }
                }
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $objMarks = new MarksController();

        if (isset($_POST['create'])) {
            $studentId = isset($_POST['student_id']) ? $_POST['student_id'] : null;
            $examId = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
            $courseId = isset($_POST['course_id']) ? $_POST['course_id'] : null;
            $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
            $semester = isset($_POST['semester']) ? $_POST['semester'] : null;

            $objMarks->create($studentId, $examId, $courseId, $marks, $semester);
        }

        if (isset($_POST['back_dashboard'])) {
            $objMarks->backToDashboard();
        }
        
        if (isset($_POST['editCall'])) {
            $objMarks->showEdit($_POST['marks_id']);
        }

        if (isset($_POST['_method'])) {
            
            if ($_POST['_method'] === "PUT") {
                $marksId = isset($_POST['marks_id']) ? $_POST['marks_id'] : null;
                $studentId = isset($_POST['student_id']) ? $_POST['student_id'] : null;
                $examId = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
                $courseId = isset($_POST['course_id']) ? $_POST['course_id'] : null;
                $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
                $semester = isset($_POST['semester']) ? $_POST['semester'] : null;

                $objMarks->update($marksId, $studentId, $courseId, $marks, $semester);
            }

            elseif ($_POST['_method'] === "DELETE") {
                $objMarks->delete($_POST['marks_id'], $_POST['student_id']);
            }
        }
        
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {

        $objMarks = new MarksController();

        if (isset($_GET['viewAllMarks'])) {
            $objMarks->showAll();
        }

        if (isset($_GET['backFromEdit'])) {
            $objMarks->showAll();
        }

        if (isset($_GET['createMarks'])) {
            $objMarks->showCreatePage();
        }
    }
?>