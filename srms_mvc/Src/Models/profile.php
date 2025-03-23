<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    class profileModel
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
        public function showDepList() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT `name` FROM `department`";
            $result = mysqli_query($con, $sql);            
            return $result;
        }
        public function showUser() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT `user_id`, `username`, `registration_number`, `user_type` FROM `users`";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        
        public function fatchRegNum($user_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT `registration_number` FROM `users` WHERE `user_id` = $user_id";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row['registration_number'];            
        }
        public function checkUser($user_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `profile` WHERE `user_id` = $user_id";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) == 0){
                return true;
            } else {
                return false;
            }
        }
        public function checkUserType($user_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT `user_type` FROM `users` WHERE `user_id` = $user_id";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            return $row['user_type'];  
        }
        public function creatProfile($firstname, $middlename, $lastname, $department, $session, $user_id) 
        {
            $con = $this->dbConnection();   

            if (isset($user_id)){
                $registration_number = $this->fatchRegNum($user_id);
            } else {
                $registration_number = '';
            }
            $sql = "INSERT INTO `profile`(`first_name`, `middle_name`, `last_name`, `registration_number`, `department`, `session`, `user_id`) VALUES ('$firstname','$middlename','$lastname','$registration_number', '$department','$session','$user_id')";
            $result = mysqli_query($con, $sql);
        }
        public function showList() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `profile`";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function updateProfile($first_name, $middle_name, $last_name, $user_id)
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `profile` SET `first_name`='$first_name',`middle_name`='$middle_name',`last_name`='$last_name' WHERE `user_id`='$user_id'";
            $result = mysqli_query($con, $sql);
        }
        public function showUpdateUserDate($user_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `profile` WHERE `user_id` = $user_id";
            $result = mysqli_query($con, $sql);
            return $result;
        }
        public function delete($user_id) 
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `profile` WHERE `user_id` = '$user_id'";
            $result = mysqli_query($con, $sql);    
            return $result;
        }
        public function showListProfile($user_id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `profile` WHERE `user_id` = $user_id";
            $result = mysqli_query($con, $sql);
            return $result;
        }
    }
?>