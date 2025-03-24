<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class CourseModel
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
        
        public function checkCourse($course_name)
        {        
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `course` WHERE `name` = '$course_name'";
            $result = mysqli_query($con, $sql);    
            
            return $result->num_rows;
        }

        public function createCourse($course_name, $course_status, $course_credit, $created_by)
        {
            $con = $this->dbConnection();
            $sql = "INSERT INTO `course`(`name`, `status`, `credit`, `created_by`) VALUES ('$course_name',$course_status,$course_credit,'$created_by')";
            $result = mysqli_query($con, $sql);
        }

        public function showList()
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `course`";
            $result = mysqli_query($con, $sql);    
            
            return $result;
        }  

        public function delete($c_ID)
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `course` WHERE `course_id` = $c_ID";
            $result = mysqli_query($con, $sql);
        }

        public function showUpdateCourseDate($c_ID)
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `course` WHERE `course_id` = $c_ID";
            $result = mysqli_query($con, $sql);    
            
            return $result;
        }

        public function update($course_id, $course_name, $credit)
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `course` SET `name`='$course_name', `credit`='$credit' WHERE `course_id` = '$course_id'";
            $result = mysqli_query($con, $sql);
        }

        public function assignedTo() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT `username` FROM `users` WHERE `user_type` = 2";
            $result = mysqli_query($con, $sql);    
            
            return $result;
        }

        public function assignedToInstructor($courseID)
        {
            $con = $this->dbConnection();
            $sql = "SELECT DISTINCT course.assigned_to, course.course_id, users.user_id
                    FROM course
                    JOIN users ON course.assigned_to = users.username
                    WHERE course.course_id = $courseID";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            
            return $row['user_id'];  
        }
        
        public function assignedCourse($instructorID)
        {
            $con = $this->dbConnection();
            $sql = "SELECT DISTINCT exam.course_id, course.name, exam.instructor_id, course.credit, course.status
                    FROM `exam`
                    JOIN course ON course.course_id = exam.course_id
                    WHERE exam.instructor_id = $instructorID";
            $result = mysqli_query($con, $sql);    
            
            return $result;
        }
    }
?>