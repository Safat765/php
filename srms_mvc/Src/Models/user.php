<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    class UserModel
    {        
        const STATUS_INACTIVE = 0;
        const STATUS_ACTIVE = 1;
        const USER_TYPE_ADMIN = 1;
        const USER_TYPE_INSTRUCTOR = 2;
        const USER_TYPE_STUDENT = 3;
        public function dbConnection()
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "assignment_srms";
            $con = mysqli_connect($servername, $username, $password, $database);
            
            if (!$con) {
                die("Error detected ". mysqli_connect_error(). "<br>");
            }

            return $con;
        }        

        public function login($username, $password)
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `users` WHERE `username` = ? AND `password` = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
        }

        public function getPassword($username)
        {
            $con = $this->dbConnection();
            $sql = "SELECT `password` FROM `users` WHERE `username` = '$username'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            return $row['password'];
        }

        public function UserExistOrNot($username, $registration_number)
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `users` WHERE username = ? AND registration_number = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("si", $username, $registration_number);
            $stmt->execute();
            $result = $stmt->get_result();     

            if ($result->num_rows == 1){
                $row = $result->fetch_assoc();

                return $row['user_id'];
            } else {            
                return false;
            }
        }

        public function addUser($username, $email, $password, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at)
        {
            $con = $this->dbConnection();
            $updated_at = NULL;
            $sql = "INSERT INTO `users`(`username`, `email`, `password`, `user_type`, `status`, `registration_number`, `phone_number`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssiissss", $username, $email, $password, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at);
            $stmt->execute();
            $result = $stmt->get_result();            
            $stmt->close();
            $con->close();
        }

        public function showAll()
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `users`";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result; 
            } else {
                return null;  
            }
        }   
        
        public function showUpdateUserDate($id) 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `users` WHERE user_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();            

            return $stmt->get_result();
        } 

        public function updateUser($user_id, $email, $password, $phone_number, $updated_at)
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `users` SET `email`= '$email',`password`= '$password',`phone_number`= '$phone_number',`updated_at`= '$updated_at' WHERE `user_id` = $user_id";
            $result = mysqli_query($con, $sql);

            return $result; 
        }

        public function update($status, $user_id) 
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `users` SET `status`= ? WHERE `user_id` = $user_id";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $status);
            $stmt->execute();
            $result = $stmt->get_result();            
            $stmt->close();
            $con->close();
        }

        public function remove($uID)
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `users` WHERE `user_id` = $uID";
            $result = mysqli_query($con, $sql);

            return $result;
        }      

        public function showInstructorList($id)
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `users` WHERE `user_type` = $id";
            $result = mysqli_query($con, $sql);     

            return $result;
        } 

        public function getUserID($username)
        {
            $con = $this->dbConnection();
            $sql = "SELECT `user_id` FROM `users` WHERE `username` = '$username'";
            $result = mysqli_query($con, $sql); 

            return $result;
        }

        public function checkPassword($userID)
        {
            $con = $this->dbConnection();
            $sql = "SELECT `password` FROM `users` WHERE `user_id` = $userID";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            return $row['password'];
        }
        
        public function updatePassword($userID, $password)
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `users` SET `password`= '$password' WHERE `user_id` = $userID";
            $result = mysqli_query($con, $sql);
            
            return $result;
        }
    }    
?>