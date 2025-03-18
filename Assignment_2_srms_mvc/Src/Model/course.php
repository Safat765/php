<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    class CourseModel {
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

        public static function checkCourse($course_name)
        {        
            $con = self::dbConnection();
            $sql = "SELECT * FROM `course` WHERE `name` = '$course_name'";
            $result = mysqli_query($con, $sql);
    
            return $result->num_rows;
        }

        public static function createCourseModel($course_name, $course_status, $course_credit, $created_by){
            $con = self::dbConnection();
            $sql = "INSERT INTO `course`(`name`, `status`, `credit`, `created_by`) VALUES ('$course_name', $course_status, $course_credit, '$created_by')";
            $result = mysqli_query($con, $sql);
        }
        public static function show_List(){
            $con = self::dbConnection();
            $sql = "SELECT * FROM `course`";
            $result = mysqli_query($con, $sql);
    
            return $result;
        }        
        public static function delete($c_ID){
            $con = self::dbConnection();
            $sql = "DELETE FROM `course` WHERE `course_id` = $c_ID";

            if (mysqli_query($con, $sql)){
                header('Location: ../View/Course/Index.php');
                exit;
            }else{
                echo "Deparment not found";
                exit;
            }
        }
        public static function showUpdateCourseDate($c_ID){
            $con = self::dbConnection();
            $sql = "SELECT * FROM `course` WHERE `course_id` = $c_ID";
            $result = mysqli_query($con, $sql);
    
            return $result;
        }
        public static function updateCourse($c_ID, $c_status, $c_credit, $c_created_by){
            $con = self::dbConnection();
            $sql = "UPDATE `course` SET `status`='$c_status',`credit`='$c_credit',`created_by`='$c_created_by' WHERE `course_id` = $c_ID";
            $result = mysqli_query($con, $sql);
        }
        public static function update($dID, $cStatus, $cCredit, $cCreatedBy){
            $con = self::dbConnection();
            $sql = "UPDATE `course` SET `status`='$cStatus',`credit`='$cCredit',`created_by`='$cCreatedBy' WHERE `course_id` = $dID";
            $result = mysqli_query($con, $sql);
        }
    }
?>