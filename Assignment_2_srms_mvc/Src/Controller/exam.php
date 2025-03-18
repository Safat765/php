<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/exam.php';
    require '../../Data/cleanData.php';

    class ExamComtroller {
        public static function create_exam($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by) {
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

            if ($isValid === true) {
                $exam_Exist = examModel::check_exam($course_id, $semester, $exam_type);
                if ($exam_Exist == 0) {
                    examModel::create_exam_model($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by);
                    $_SESSION['create_dep_msg'] = "Exam added successfully";
                    header ('Location: ../View/Exam/create.php');
                    exit(0);
                } else {
                    $_SESSION['create_dep_msg'] = " This Exam already exists on $semester semester and $exam_type type";
                    header ('Location: ../View/Exam/create.php');
                    exit(0);
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                header ('Location: ../View/Exam/create.php');
                exit(0);
            }

        }        
        public static function back_TO_dashboard(){
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
    
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        public static function edit_Call($exam_id) {
            $result = examModel::showUpdateUserDate($exam_id);
            if (mysqli_num_rows($result) > 0) {
                include '../View/Exam/edit.php';
            } else {
                echo "<h3> No data found </h3>";
            }

            // $_SESSION['exam_id'] = $exam_id;
            // header ('Location: ../View/Exam/edit.php');
            // exit;
        }
        public static function update_exam($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by) {
            $exam_id = sanitize($exam_id);
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

            if ($isValid === true) {
                if ($exam_Exist == 0) {
                    examModel::update_exam_model($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $created_by, $instructor_id);
                    $_SESSION['create_dep_msg'] = "Exam edited successfully";
                    header ('Location: ../View/Exam/Index.php');
                    exit(0);
                } else {
                    $_SESSION['create_dep_msg'] = " Failed to update the exam";
                    header ('Location: ../View/Exam/edit.php');
                    exit(0);
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                header ('Location: ../View/Exam/edit.php');
                exit(0);
            }
        }
        public static function delete_exam($exam_id) {
            $exam_id = sanitize($exam_id);
            examModel::delete_exam_model($exam_id);
            $_SESSION['create_dep_msg'] = "Exam deleted successfully";
            header ('Location: ../View/Exam/Index.php');
            exit(0);
        }

    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['create'])) {
            $course_id = $_POST['course_id'];
            $exam_title = $_POST['exam_title'];
            $department_id = $_POST['department_id'];
            $semester = $_POST['semester'];
            $credit = $_POST['credit'];
            $exam_type = $_POST['exam_type'];
            $marks = $_POST['marks'];
            $instructor_id = $_POST['instructor_id'];
            $created_by = $_POST['course_created_by'];
            ExamComtroller::create_exam($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by);
        }
        if (isset($_POST['back_TO_dashboard'])) {
            ExamComtroller::back_TO_dashboard();
        }
        if (isset($_POST['edit_Call'])) {
            $exam_id = $_POST['exam_id'];
            ExamComtroller::edit_Call($exam_id);
        }
        if (isset($_POST['confirmUpdate'])) {
            $exam_id = $_POST['exam_id'];
            $course_id = $_POST['course_id'];
            $exam_title = $_POST['exam_title'];
            $department_id = $_POST['department_id'];
            $semester = $_POST['semester'];
            $credit = $_POST['credit'];
            $exam_type = $_POST['exam_type'];
            $marks = $_POST['marks'];
            $instructor_id = $_POST['instructor_id'];
            $created_by = $_POST['course_created_by'];
            ExamComtroller::update_exam($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by);
        }
        if (isset($_POST['delete'])) {
            ExamComtroller::delete_exam($_POST['exam_id']);
        }
    } else {
        echo "Post not working";
    }

?>