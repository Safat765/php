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
            $sql = "SELECT marks.marks_id, marks.student_id, marks.exam_id, marks.course_id, marks.marks, marks.semester, marks.gpa, exam.exam_id, exam.instructor_id, users.username
                    FROM marks
                    JOIN exam ON exam.exam_id = marks.exam_id
                    JOIN users ON exam.instructor_id = users.user_id";
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

        public function create($student_id, $exam_id, $course_id, $marks, $semester, $gpa) 
        {
            $con = $this->dbConnection();
            $sql = "INSERT INTO `marks`(`student_id`, `exam_id`, `course_id`, `marks`, `semester`, `gpa`) VALUES ('$student_id', '$exam_id', '$course_id', '$marks', '$semester', '$gpa')";
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
            $sql = "SELECT DISTINCT exam.instructor_id, course.course_id, course.name, course.status, course.credit, course.created_by, exam.course_id, exam.exam_title, users.user_id, users.username
                    FROM `exam`
                    JOIN course ON exam.course_id = course.course_id
                    JOIN users ON users.user_id = exam.instructor_id";
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