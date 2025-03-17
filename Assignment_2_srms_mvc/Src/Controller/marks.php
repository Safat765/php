<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/marks.php';
    require '../../Data/cleanData.php';
    require '../Model/user.php';
    require '../Model/course.php';

    class MarksController {
        public static function gpa($marks) {
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
        public static function create_marks($student_id, $exam_id, $course_id, $marks, $semester) {
            $student_id = sanitize($student_id);
            $exam_id = sanitize($exam_id);
            $course_id = sanitize($course_id);
            $marks = sanitize($marks);
            $semester = sanitize($semester);
            $gpa = self::gpa($marks);
            $isValid = true;
            $marks_Exist = null;
            

            if (empty($student_id)) {
                $_SESSION['student_idErrMsg'] = "Student is required";
                $isValid = false;
            } else {
                $_SESSION['student_idErrMsg'] = "";
            }

            if (empty($exam_id)) {
                $_SESSION['exam_idErrMsg'] = "Exam Semester is required";
                $isValid = false;
            } else {
                $_SESSION['exam_idErrMsg'] = "";
            }

            if (empty($course_id)) {
                $_SESSION['course_idErrMsg'] = "Course is required";
                $isValid = false;
            } else {
                $_SESSION['course_idErrMsg'] = "";
            }

            if (empty($marks)) {
                $_SESSION['marksErrMsg'] = "Marks is required";
                $isValid = false;
            } else {
                $_SESSION['marksErrMsg'] = "";
            }

            if (empty($semester)) {
                $_SESSION['semesterErrMsg'] = "semester is required";
                $isValid = false;
            } else {
                $_SESSION['semesterErrMsg'] = "";
            }

            if (empty($gpa)) {
                $_SESSION['gpaErrMsg'] = "gpa is required";
                $isValid = false;
            } else {
                $_SESSION['gpaErrMsg'] = "";
            }

            if ($isValid === true) {
                $marks_Exist = MarksModel::check_marks_exist($student_id, $exam_id, $course_id);
                if ($marks_Exist == 0) {
                    $result = MarksModel::create($student_id, $exam_id, $course_id, $marks, $semester, $gpa);
                    if ($result) {
                        $_SESSION['create_dep_msg'] = "Marks added successfully";
                        header('Location: ../View/Marks/create.php');
                    } else {
                        $_SESSION['create_dep_msg'] = "Marks already exist";
                        header('Location: ../View/Marks/create.php');
                    }

                } else {
                    $_SESSION['create_dep_msg'] = " Fill up the field first";
                    header('Location: ../View/Marks/create.php');
                }
            }
        }
        public static function back_TO_dashboard() {
            if (isset($_SESSION['student_idErrMsg']) && isset($_SESSION['exam_idErrMsg']) && isset($_SESSION['course_idErrMsg']) && isset($_SESSION['marksErrMsg']) && isset($_SESSION['semesterErrMsg']) && isset($_SESSION['gpaErrMsg'])) {

                unset($_SESSION['student_idErrMsg']);
                unset($_SESSION['exam_idErrMsg']);
                unset($_SESSION['course_idErrMsg']);
                unset($_SESSION['marksErrMsg']);
                unset($_SESSION['semesterErrMsg']);
                unset($_SESSION['gpaErrMsg']);

                header('Location: ../View/dashboardView.php');
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit(0);
            }
        }
        public static function delete_marks($marks_id) {
            $marks_id = sanitize($marks_id);
            $result = MarksModel::delete($marks_id);
            if ($result) {
                $_SESSION['create_dep_msg'] = "Marks deleted successfully";
                header('Location: ../View/Exam/Index.php');
            } else {
                $_SESSION['create_dep_msg'] = "Marks not deleted";
                header('Location: ../View/Exam/Index.php');
            }
        }
        public static function edit_Call($marks_id) {
            $result = MarksModel::showUpdateUserDate($marks_id);
            $result1 = show_instructor_list(3);
            $result2 = CourseModel::show_List();
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
        public static function update_marks($marks_id, $student_id, $exam_id, $course_id, $marks, $semester){
            $marks_id = sanitize($marks_id);
            $student_id = sanitize($student_id);
            $exam_id = sanitize($exam_id);
            $course_id = sanitize($course_id);
            $marks = sanitize($marks);
            $semester = sanitize($semester);
            $gpa = self::gpa($marks);

            $result = MarksModel::update($marks_id, $student_id, $exam_id, $course_id, $marks, $semester, $gpa);
            if ($result) {
                $_SESSION['create_dep_msg'] = "Marks added successfully";
                header('Location: ../View/Marks/Index.php');
                exit(0);
            } else {
                $_SESSION['create_dep_msg'] = "Marks already exist";
                header('Location: ../View/Marks/Index.php');
                exit(0);
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create'])) {
            $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
            $exam_id = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
            $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
            $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
            $semester = isset($_POST['semester']) ? $_POST['semester'] : null;

            MarksController::create_marks($student_id, $exam_id, $course_id, $marks, $semester);
        }
        if (isset($_POST['back_dashboard'])) {
            MarksController::back_TO_dashboard();
        }
        if (isset($_POST['delete'])){
            MarksController::delete_marks($_POST['marks_id']);
        }
        if (isset($_POST['edit_Call'])) {
            $marks_id = $_POST['marks_id'];
            MarksController::edit_Call($marks_id);
        }
        if (isset($_POST['confirmUpdate'])) {
            $marks_id = isset($_POST['marks_id']) ? $_POST['marks_id'] : null;
            $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
            $exam_id = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
            $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
            $marks = isset($_POST['marks']) ? $_POST['marks'] : null;
            $semester = isset($_POST['semester']) ? $_POST['semester'] : null;

            MarksController::update_marks($marks_id, $student_id, $exam_id, $course_id, $marks, $semester);
        }
    } else {
        echo "Post not working";
    }


?>