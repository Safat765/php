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
                $_SESSION['course_idErrMsg'] = "Course required!";
                $isValid = false;
            } else {
                $_SESSION['course_idErrMsg'] = "";
            }

            if (empty($exam_title)) {
                $_SESSION['exam_titleErrMsg'] = "Exam title required!";
                $isValid = false;
            } else {
                $_SESSION['exam_titleErrMsg'] = "";
            }

            if (empty($department_id)) {
                $_SESSION['department_idErrMsg'] = "Department required!";
                $isValid = false;
            } else {
                $_SESSION['department_idErrMsg'] = "";
            }

            if (empty($semester)) {
                $_SESSION['semesterErrMsg'] = "Semester required!";
                $isValid = false;
            } else {
                $_SESSION['semesterErrMsg'] = "";
            }

            if (empty($credit)) {
                $_SESSION['creditErrMsg'] = "Credit required!";
                $isValid = false;
            } else {
                $_SESSION['creditErrMsg'] = "";
            }

            if (empty($exam_type)) {
                $_SESSION['exam_typeErrMsg'] = "Exam type required!";
                $isValid = false;
            } else {
                $_SESSION['exam_typeErrMsg'] = "";
            }
            
            if (empty($marks)) {
                $_SESSION['marksErrMsg'] = "Marks required!";
                $isValid = false;
            } else {
                $_SESSION['marksErrMsg'] = "";
            }            
            
            if (empty($instructor_id)) {
                $_SESSION['instructor_idErrMsg'] = "instructor required!";
                $isValid = false;
            } else {
                $_SESSION['instructor_idErrMsg'] = "";
            }            
            
            if (empty($created_by)) {
                $_SESSION['created_byErrMsg'] = "created_by required!";
                $isValid = false;
            } else {
                $_SESSION['created_byErrMsg'] = "";
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
            if (isset($_SESSION['course_idErrMsg']) && isset($_SESSION['exam_titleErrMsg']) && isset($_SESSION['department_idErrMsg']) && isset($_SESSION['semesterErrMsg']) && isset($_SESSION['creditErrMsg']) && isset($_SESSION['exam_typeErrMsg']) && isset($_SESSION['marksErrMsg']) && isset($_SESSION['instructor_idErrMsg']) && isset($_SESSION['created_byErrMsg'])) {

                unset($_SESSION['course_idErrMsg']);
                unset($_SESSION['exam_titleErrMsg']);
                unset($_SESSION['department_idErrMsg']);
                unset($_SESSION['semesterErrMsg']);
                unset($_SESSION['creditErrMsg']);
                unset($_SESSION['exam_typeErrMsg']);
                unset($_SESSION['marksErrMsg']);
                unset($_SESSION['instructor_idErrMsg']);
                unset($_SESSION['created_byErrMsg']);
    
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        public static function edit_Call($exam_id) {
            $_SESSION['exam_id'] = $exam_id;
            header ('Location: ../View/Exam/edit.php');
            exit;
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
                $_SESSION['course_idErrMsg'] = "Course required!";
                $isValid = false;
            } else {
                $_SESSION['course_idErrMsg'] = "";
            }

            if (empty($exam_title)) {
                $_SESSION['exam_titleErrMsg'] = "Exam title required!";
                $isValid = false;
            } else {
                $_SESSION['exam_titleErrMsg'] = "";
            }

            if (empty($department_id)) {
                $_SESSION['department_idErrMsg'] = "Department required!";
                $isValid = false;
            } else {
                $_SESSION['department_idErrMsg'] = "";
            }

            if (empty($semester)) {
                $_SESSION['semesterErrMsg'] = "Semester required!";
                $isValid = false;
            } else {
                $_SESSION['semesterErrMsg'] = "";
            }

            if (empty($credit)) {
                $_SESSION['creditErrMsg'] = "Credit required!";
                $isValid = false;
            } else {
                $_SESSION['creditErrMsg'] = "";
            }

            if (empty($exam_type)) {
                $_SESSION['exam_typeErrMsg'] = "Exam type required!";
                $isValid = false;
            } else {
                $_SESSION['exam_typeErrMsg'] = "";
            }
            
            if (empty($marks)) {
                $_SESSION['marksErrMsg'] = "Marks required!";
                $isValid = false;
            } else {
                $_SESSION['marksErrMsg'] = "";
            }            
            
            if (empty($instructor_id)) {
                $_SESSION['instructor_idErrMsg'] = "instructor required!";
                $isValid = false;
            } else {
                $_SESSION['instructor_idErrMsg'] = "";
            }
            if (empty($created_by)) {
                $_SESSION['created_byErrMsg'] = "created_by required!";
                $isValid = false;
            } else {
                $_SESSION['created_byErrMsg'] = "";
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