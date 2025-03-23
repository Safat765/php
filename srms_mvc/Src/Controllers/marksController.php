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
        public function create_marks($student_id, $exam_id, $course_id, $marks, $semester) 
        {
            $student_id = sanitize($student_id);
            $exam_id = sanitize($exam_id);
            $course_id = sanitize($course_id);
            $marks = sanitize($marks);
            $semester = sanitize($semester);
            $gpa = self::gpa($marks);
            $isValid = true;
            $marks_Exist = null;            

            if (empty($student_id)) {
                $_SESSION['student_id_error_msg'] = "Student is required";
                $isValid = false;
            } else {
                $_SESSION['student_id_error_msg'] = "";
            }

            if (empty($exam_id)) {
                $_SESSION['exam_id_error_msg'] = "Exam Semester is required";
                $isValid = false;
            } else {
                $_SESSION['exam_id_error_msg'] = "";
            }

            if (empty($course_id)) {
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
            $objResult = new resultModel();

            if ($isValid === true) {
                $marks_Exist = $model->checkMarksExist($student_id, $exam_id, $course_id);
                if ($marks_Exist == 0) {
                    $result = $model->create($student_id, $exam_id, $course_id, $marks, $semester, $gpa);
                    $cgpa = $objResult->getAvgMarks($student_id);
                    $objResult->createCGPA($student_id, $cgpa);
                    if ($result) {
                        $_SESSION['create_dep_msg'] = "Marks added successfully";
                        $this->showAllMarks();
                    } else {
                        $_SESSION['create_dep_msg'] = "Marks added to fail";
                        $this->showAllMarks();
                    }
                } else {
                    $_SESSION['create_dep_msg'] = "Marks already exist";
                    $this->showAllMarks();
                }
            }
        }
        public static function backToDashboard() 
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
        public function deleteMarks($marks_id, $student_id) 
        {
            $marks_id = sanitize($marks_id);
            $student_id = sanitize($student_id);
            $objMarks = new MarksModel();
            $result = $objMarks->delete($marks_id);

            if ($result) {
                $objMarks->deleteResult($student_id);
                $_SESSION['create_dep_msg'] = "Marks deleted successfully";
                $this->showAllMarks();
            } else {
                $_SESSION['create_dep_msg'] = "Marks not deleted";
                $this->showAllMarks();
            }
        }
        public function showEditMarks($marks_id) 
        {
            $objMarks = new MarksModel();
            $objCourse = new CourseModel();
            $objUser = new user();
            $result = $objMarks->showUpdateUserDate($marks_id);
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
        public function updateMarks($marks_id, $student_id, $exam_id, $course_id, $marks, $semester)
        {
            $model = new MarksModel();
            $marks_id = sanitize($marks_id);
            $student_id = sanitize($student_id);
            $exam_id = sanitize($exam_id);
            $course_id = sanitize($course_id);
            $marks = sanitize($marks);
            $semester = sanitize($semester);
            $gpa = self::gpa($marks);
            $result = $model->update($marks_id, $student_id, $exam_id, $course_id, $marks, $semester, $gpa);
            
            if ($result) {
                $_SESSION['create_dep_msg'] = "Marks updated successfully";
                $this->showAllMarks();
            } else {
                $_SESSION['create_dep_msg'] = "Marks already exist";
                $this->showAllMarks();
            }
        }
        public function showAllMarks()
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
            $objUser = new user();
            $objExam = new examModel();
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

        $obj = new MarksController();

        if (isset($_POST['create'])) {
            $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
            $exam_id = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
            $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
            $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
            $semester = isset($_POST['semester']) ? $_POST['semester'] : null;

            $obj->create_marks($student_id, $exam_id, $course_id, $marks, $semester);
        }

        if (isset($_POST['back_dashboard'])) {
            MarksController::backToDashboard();
        }
        
        if (isset($_POST['editCall'])) {
            $obj->showEditMarks($_POST['marks_id']);
        }

        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $marks_id = isset($_POST['marks_id']) ? $_POST['marks_id'] : null;
                $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
                $exam_id = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
                $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
                $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
                $semester = isset($_POST['semester']) ? $_POST['semester'] : null;

                $obj->updateMarks($marks_id, $student_id, $exam_id, $course_id, $marks, $semester);
            }

            elseif ($_POST['_method'] === "DELETE") {
                $obj->deleteMarks($_POST['marks_id'], $_POST['student_id']);
            }
        }
        
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {

        $obj = new MarksController();

        if (isset($_GET['viewAllMarks'])) {
            $obj->showAllMarks();
        }

        if (isset($_GET['backFromEdit'])) {
            $obj->showAllMarks();
        }

        if (isset($_GET['createMarks'])) {
            $obj->showCreatePage();
        }
    }
?>