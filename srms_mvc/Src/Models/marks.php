<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class MarksModel
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
            $sql = "SELECT * FROM `marks`";
            $result = mysqli_query($con, $sql);            
            
            return $result;
        }

        public function checkMarksExist($student_id, $exam_id, $course_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `marks` WHERE `student_id` = '$student_id' AND `exam_id` = '$exam_id' AND `course_id` = '$course_id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);            
            
            return $row;
        }

        public function create($student_id, $exam_id, $course_id, $marks, $semester, $assigned_to, $gpa) 
        {
            $con = $this->dbConnection();
            $sql = "INSERT INTO `marks`(`student_id`, `exam_id`, `course_id`, `marks`, `semester`, `assigned_to`, `gpa`) VALUES ('$student_id', '$exam_id', '$course_id', '$marks', '$semester', '$assigned_to', '$gpa')";
            $result = mysqli_query($con, $sql);            
            
            return $result;
        }

        public function delete($marks_id) 
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `marks` WHERE `marks_id` = '$marks_id'";
            $result = mysqli_query($con, $sql);            
            
            return $result;
        }
        
        public function showUpdateUserDate($marks_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `marks` WHERE `marks_id` = '$marks_id'";
            $result = mysqli_query($con, $sql);            
            
            return $result;
        }

        public function update($marks_id, $student_id, $course_id, $marks, $semester, $gpa) 
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `marks` SET `student_id`= $student_id,`course_id`= $course_id,`marks`='$marks',`semester`='$semester',`gpa`='$gpa' WHERE `marks_id`='$marks_id'";
            $result = mysqli_query($con, $sql);            
            
            return $result;
        }

        public function examCourse()
        {
            $con = $this->dbConnection();
            $sql = "SELECT c.course_id, c.name, e.semester, c.assigned_to, e.exam_title
                    FROM `course` c
                    JOIN `exam` e ON c.course_id = e.course_id";
            $result = mysqli_query($con, $sql);            
            
            return $result;
        }

        public function deleteResult($student_id) 
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `results` WHERE `student_id` = $student_id";
            $result = mysqli_query($con, $sql);            
        
            return $result;
        }
        
        public function showAllSemester() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT DISTINCT `semester` FROM exam";
            $result = mysqli_query($con, $sql);            
        
            return $result;
        }
        
        public function showMarksListAllName()
        {
            $con = $this->dbConnection();
            $sql = "SELECT users.user_id, users.username, exam.exam_id, exam.exam_title, course.course_id, course.name
                    FROM `marks`
                    JOIN users ON marks.student_id = users.user_id
                    JOIN exam ON marks.exam_id = exam.exam_id
                    JOIN course ON marks.course_id = course.course_id";
            $result = mysqli_query($con, $sql);            
        
            return $result;
        }
    }
?>