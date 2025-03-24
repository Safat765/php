<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    class ResultModel
    {
        public function dbConnection(){
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
        
        public function createCGPA($student_id, $avg_CGPA)
        {
            $con = $this->dbConnection();
            $sql = "INSERT INTO `results`(`student_id`, `final_cgpa`) VALUES ('$student_id', '$avg_CGPA')";
            $result = mysqli_query($con, $sql);
        }
        
        public function showResultList()
        {
            $con = $this->dbConnection();
            $sql = "SELECT marks.student_id, AVG(marks.gpa) AS final_cgpa, users.user_id, users.username, users.registration_number
                    FROM marks
                    JOIN users ON marks.student_id = users.user_id
                    GROUP BY marks.student_id, users.user_id, users.username, users.registration_number";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }
        
        public function showStudents() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT DISTINCT m.student_id, u.username
                    FROM `marks` m
                    JOIN `users` u ON m.student_id = u.user_id;";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }
        
        public function delete($result_id) 
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `results` WHERE `results_id` = $result_id";
            $result = mysqli_query($con, $sql);            
        
            return $result;
        }
        
        public function showUsernameRegNumber()
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `users`";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }
        
        public function showSingleStudentResult($student_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `marks` WHERE `student_id` = $student_id";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }
        
        public function showCourseNameExamTitle()
        {
            $con = $this->dbConnection();
            $sql = "SELECT course.course_id, course.name, exam.exam_id, exam.exam_title
                    FROM `exam`
                    JOIN `course` ON course.course_id = exam.course_id";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }
        
        public function showDropDownResult($student_id)
        {
            $con = $this->dbConnection();
            $sql = "SELECT DISTINCT `semester` FROM marks WHERE `student_id` = $student_id";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }

        public function checkStudent($ID)
        {
            $con = $this->dbConnection();
            $sql = "SELECT `student_id` FROM `results` WHERE `student_id`= $ID";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }

        public function update($ID, $CGPA)
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `results` SET `final_cgpa`='$CGPA' WHERE `student_id`='$ID'";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }

        public function showResult()
        {
            $con = $this->dbConnection();
            $sql = "SELECT results.results_id, results.student_id, results.final_cgpa, users.user_id, users.username, users.registration_number
                    FROM results
                    JOIN users ON results.student_id = users.user_id";
            $result = mysqli_query($con, $sql);
        
            return $result;
        }
    }
?>