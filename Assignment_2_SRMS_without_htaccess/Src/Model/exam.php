<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    class examModel
    {
        public function dbConnection()
        {
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
        public function show_List() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `exam`";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function check_exam($course_id, $semester, $exam_type) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `exam` WHERE `course_id` = '$course_id' AND `semester` = '$semester' AND `exam_type` = '$exam_type'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            return $num;
        }
        public function create_exam_model($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by) 
        {
            $con = $this->dbConnection();
            $sql = "INSERT INTO `exam`(`course_id`, `exam_title`, `department_id`, `semester`, `credit`, `exam_type`, `marks`, `instructor_id`, `created_by`) VALUES ('$course_id', '$exam_title', '$department_id', '$semester', '$credit', '$exam_type', '$marks', '$instructor_id', '$created_by')";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function showUpdateUserDate($exam_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `exam` WHERE `exam_id` = '$exam_id'";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function update_exam_model($exam_id, $course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $created_by, $instructor_id) 
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `exam` SET `course_id`='$course_id',`exam_title`='$exam_title',`department_id`='$department_id',`semester`='$semester',`credit`='$credit',`exam_type`='$exam_type',`marks`='$marks',`instructor_id`='$instructor_id',`created_by`='$created_by' WHERE `exam_id`= '$exam_id'";
            $result = mysqli_query($con, $sql);
            return $result;
        }     
        public function delete_exam_model($exam_id) 
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `exam` WHERE `exam_id` = '$exam_id'";
            $result = mysqli_query($con, $sql);
            return $result;
        } 
        public function showCourseName()
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `course`";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function showUserName()
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `users`";
            $result = mysqli_query($con, $sql);
            return $result;
        }
    }
?>