<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/marks.php';
    require '../../Data/cleanData.php';
    require '../Model/user.php';
    require '../Model/course.php';
    require '../Model/exam.php';

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
            if ($isValid === true) {
                $marks_Exist = $model->check_marks_exist($student_id, $exam_id, $course_id);
                if ($marks_Exist == 0) {
                    $result = $model->create($student_id, $exam_id, $course_id, $marks, $semester, $gpa);
                    if ($result) {
                        $_SESSION['create_dep_msg'] = "Marks added successfully";
                        $this->showAllMarks();
                        // header('Location: ../View/Marks/create.php');
                    } else {
                        $_SESSION['create_dep_msg'] = "Marks already exist";
                        $this->showAllMarks();
                        // header('Location: ../View/Marks/create.php');
                    }

                } else {
                    $_SESSION['create_dep_msg'] = " Fill up the field first";
                    $this->showAllMarks();
                    // header('Location: ../View/Marks/create.php');
                }
            }
        }
        public static function back_TO_dashboard() 
        {
            if (isset($_SESSION['student_id_error_msg']) && isset($_SESSION['exam_id_error_msg']) && isset($_SESSION['course_id_error_msg']) && isset($_SESSION['marks_error_msg']) && isset($_SESSION['semester_error_msg']) && isset($_SESSION['gpa_error_msg'])) {
                unset($_SESSION['student_id_error_msg']);
                unset($_SESSION['exam_id_error_msg']);
                unset($_SESSION['course_id_error_msg']);
                unset($_SESSION['marks_error_msg']);
                unset($_SESSION['semester_error_msg']);
                unset($_SESSION['gpa_error_msg']);
                header('Location: ../View/dashboardView.php');
            } else {   
                unset($_SESSION['student_id_error_msg']);
                unset($_SESSION['exam_id_error_msg']);
                unset($_SESSION['course_id_error_msg']);
                unset($_SESSION['marks_error_msg']);
                unset($_SESSION['semester_error_msg']);
                unset($_SESSION['gpa_error_msg']);         
                header ('Location: ../View/dashboardView.php');
                exit(0);
            }
        }
        public function deleteMarks($marks_id, $student_id) 
        {
            $marks_id = sanitize($marks_id);
            $student_id = sanitize($student_id);
            $model = new MarksModel();
            $result = $model->delete($marks_id);
            if ($result) {
                $model->deleteResult($student_id);
                $_SESSION['create_dep_msg'] = "Marks deleted successfully";
                $this->showAllMarks();
                // header('Location: ../View/Exam/Index.php');
            } else {
                $_SESSION['create_dep_msg'] = "Marks not deleted";
                $this->showAllMarks();
                // header('Location: ../View/Exam/Index.php');
            }
        }
        public function showEditMarks($marks_id) 
        {
            $model = new MarksModel();
            $courseModel = new CourseModel();
            $result = $model->showUpdateUserDate($marks_id);
            $result1 = show_instructor_list(3);
            $result2 = $courseModel->show_List();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    if (mysqli_num_rows($result2) > 0) {
                        include '../View/Marks/edit.php';
                    }
                }
            }
            // header ('Location: ../View/Marks/edit.php');
            // exit(0);
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
                // header('Location: ../View/Marks/Index.php');
                // exit(0);
            } else {
                $_SESSION['create_dep_msg'] = "Marks already exist";
                $this->showAllMarks();
                // header('Location: ../View/Marks/Index.php');
                // exit(0);
            }
        }
        public function showAllMarks()
        {
            $model = new MarksModel();
            $result = $model->show_List();
            if (mysqli_num_rows($result) > 0) {
                include '../View/Marks/Index.php';
            } else {
                echo "<tr><td colspan='8'>No users found.</td></tr>";
            }
        }
        public function showCreatePage()
        {
            $user = new user();
            $exam = new examModel();
            $marks = new MarksModel();
            $result = $user->show_instructor_list(3);
            $result2 = $exam->show_List();
            $result3 = $marks->exam_course();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result2) > 0) {
                    if (mysqli_num_rows($result3) > 0) {
                        include '../View/Marks/create.php';
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
            MarksController::back_TO_dashboard();
        }
        // if (isset($_POST['delete'])){
        //     MarksController::delete_marks($_POST['marks_id']);
        // }
        // if (isset($_POST['edit_Call'])) {
        //     $marks_id = $_POST['marks_id'];
        //     MarksController::edit_Call($marks_id);
        // }
        // if (isset($_POST['confirmUpdate'])) {
        //     $marks_id = isset($_POST['marks_id']) ? $_POST['marks_id'] : null;
        //     $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
        //     $exam_id = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
        //     $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
        //     $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
        //     $semester = isset($_POST['semester']) ? $_POST['semester'] : null;

        //     MarksController::update_marks($marks_id, $student_id, $exam_id, $course_id, $marks, $semester);
        // }
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
        // if (isset($_GET['showLoggedProfile'])) {
        //     $obj->showLoggedProfile($_SESSION['user_id']);
        // }
    }


?>