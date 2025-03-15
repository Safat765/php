<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    function dbConnection(){
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
    function loginModel($username, $password){
        $con = dbConnection();
        $sql = "SELECT * FROM `users` WHERE `username` = ? AND `password` = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $user_id = $row['user_id'];
            $username = $row['username'];
            $email = $row['email'];
            $password = $row['password'];
            $user_type = $row['user_type'];
            $status = $row['status'];
            $registration_number = $row['registration_number'];
            $phone_number = $row['phone_number'];
            $created_at = $row['created_at'];
            $updated_at = $row['updated_at'];

            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['status'] = $status;
            $_SESSION['registration_number'] = $registration_number;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['created_at'] = $created_at;
            $_SESSION['updated_at'] = $updated_at;

            return true;
        } else {
            return false;
        }
    }
    function UserExistOrNot($username, $registration_number){
        $con = dbConnection();
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
    function addUser($username, $email, $password, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at){
        $con = dbConnection();
        $updated_at = NULL;
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `user_type`, `status`, `registration_number`, `phone_number`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssiissss", $username, $email, $password, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at);

        $stmt->execute();
        $result = $stmt->get_result();
        
        $stmt->close();
        $con->close();
    }
    function showAll(){
        $con = dbConnection();
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
    function showUpdateUserDate($id) {
        $con = dbConnection();
        $sql = "SELECT * FROM `users` WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        
        return $stmt->get_result();
    } 
    function updateUser($user_id, $email, $password, $status, $phone_number, $updated_at){
        $con = dbConnection();
        $sql = "UPDATE `users` SET `email`= ?,`password`= ?,`status`= ?,`phone_number`= ?,`updated_at`= ? WHERE `user_id` = $user_id";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssiss", $email, $password, $status, $phone_number, $updated_at);

        $stmt->execute();
        $result = $stmt->get_result();
        
        $stmt->close();
        $con->close();   
    }
    function remove($uID){
        $con = dbConnection();
        $sql = "DELETE FROM `users` WHERE `user_id` = $uID";
        $result = mysqli_query($con, $sql);

        return $result;
    }
    
    function show_instructor_list($id){
        $con = dbConnection();
        $sql = "SELECT * FROM `users` WHERE `user_type` = $id";
        $result = mysqli_query($con, $sql);
        
        return $result;
    }


    
?>