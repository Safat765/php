<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    class ExamModel
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

        public function showList() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `exam`";
            $result = mysqli_query($con, $sql);
            
            return $result;
        }

        public function checkExam($course_id, $semester, $exam_type) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `exam` WHERE `course_id` = '$course_id' AND `semester` = '$semester' AND `exam_type` = '$exam_type'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            
            return $num;
        }

        public function create($course_id, $exam_title, $department_id, $semester, $credit, $exam_type, $marks, $instructor_id, $created_by) 
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

        public function update($exam_id, $exam_title, $credit, $exam_type, $marks) 
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `exam` SET `exam_title`='$exam_title',`credit`='$credit',`exam_type`='$exam_type',`marks`='$marks' WHERE `exam_id`= '$exam_id'";
            $result = mysqli_query($con, $sql);
            
            return $result;
        }   

        public function delete($exam_id) 
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

        public function showFieldsName()
        {
            $con = $this->dbConnection();
            $sql = "SELECT course.course_id, course.name AS course_name, department.department_id, department.name AS department_name, users.user_id, users.username
                    FROM `exam`
                    JOIN users ON exam.instructor_id = users.user_id
                    JOIN course ON exam.course_id = course.course_id
                    JOIN department ON exam.department_id = department.department_id";
            $result = mysqli_query($con, $sql);

            return $result;
        }
    }
?>