<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    class resultModel{
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
        public function getAvgMarks($student_id){
            $con = self::dbConnection();
            $sql = "SELECT AVG(`gpa`) as avg_gpa FROM `marks` WHERE `student_id` = $student_id";
            $result = mysqli_query($con, $sql); 
            $data = mysqli_fetch_array($result);
            return $data['avg_gpa'];
        }
        public function checkStudentID($student_id){
            $con = self::dbConnection();
            $sql = "SELECT * FROM `results` WHERE `student_id` = $student_id";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            return $count;
        }
        public function createCGPA($student_id, $avg_CGPA){
            $con = self::dbConnection();
            $sql = "INSERT INTO `results`(`student_id`, `final_cgpa`) VALUES ('$student_id', '$avg_CGPA')";
            $result = mysqli_query($con, $sql);
        }
        public function showResultList(){
            $con = self::dbConnection();
            $sql = "SELECT * FROM `results`";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function show_students() {
            $con = self::dbConnection();
            $sql = "SELECT DISTINCT m.student_id, u.username
                    FROM `marks` m
                    JOIN `users` u ON m.student_id = u.user_id;";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function delete($result_id) {
            $con = self::dbConnection();
            $sql = "DELETE FROM `results` WHERE `results_id` = $result_id";
            $result = mysqli_query($con, $sql);
            
            return $result;
        }
    }

?>