<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    class examModel {
        public static function dbConnection(){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "assignment_srms";
    
            $con = mysqli_connect($servername, $username, $password, $database);
    
            if (!$con){
                die("Error detected ". mysqli_connect_error(). "<br>");
            }
    
            return $con;
        }
        public static function show_List() {
            $con = self::dbConnection();
            $sql = "SELECT * FROM `exam`";
            $result = mysqli_query($con, $sql);
            
            return $result;
        }
        public static function check_exam($course_id, $semester, $exam_type) {
            $con = self::dbConnection();
            $sql = "SELECT * FROM `exam` WHERE `course_id` = '$course_id' AND `semester` = '$semester' AND `exam_type` = '$exam_type'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
    
            return $num;
        }
        public static function create_exam_model($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by) {
            $con = self::dbConnection();
            $sql = "INSERT INTO `exam`(`course_id`, `exam_title`, `department_id`, `semester`, `credit`, `exam_type`, `marks`, `instructor_id`, `created_by`) VALUES ('$course_id', '$exam_title', '$department_id', '$semester', '$credit', '$exam_type', '$marks', '$instructor_id', '$created_by')";
            $result = mysqli_query($con, $sql);
    
            return $result;
        }
        public static function showUpdateUserDate($exam_id) {
            $con = self::dbConnection();
            $sql = "SELECT * FROM `exam` WHERE `exam_id` = '$exam_id'";
            $result = mysqli_query($con, $sql);
    
            return $result;
        }
        public static function update_exam_model($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $created_by, $instructor_id) {
            $con = self::dbConnection();
            $sql = "UPDATE `exam` SET `course_id`='$course_id',`exam_title`='$exam_title',`department_id`='$department_id',`semester`='$semester',`credit`='$credit',`exam_type`='$exam_type',`marks`='$marks',`instructor_id`='$instructor_id',`created_by`='$created_by' WHERE `exam_id`= '$exam_id'";
            $result = mysqli_query($con, $sql);
    
            return $result;
        }     
        public static function delete_exam_model($exam_id) {
            $con = self::dbConnection();
            $sql = "DELETE FROM `exam` WHERE `exam_id` = '$exam_id'";
            $result = mysqli_query($con, $sql);
    
            return $result;
        }  
    }
?>