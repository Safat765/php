<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    function dbConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "srms";

        $con = mysqli_connect($servername, $username, $password, $database);

        if (!$con){
            die("Error detected ". mysqli_connect_error(). "<br>");
        }
        
        return $con;
    }
    function loginCondition($userName, $password){
        $con = dbConnection();
        $sql = "SELECT * FROM `user` WHERE userName = ? AND password = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $userName, $password);

        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $userID = $row['userID'];
            $userName = $row['userName'];
            $email = $row['email'];
            $password = $row['password'];
            $userType = $row['userType'];
            $status = $row['status'];
            $registrationNumber = $row['registrationNumber'];
            $phoneNumber = $row['phoneNumber'];
            $Created_At = $row['Created_At'];
            $Updated_At = $row['Updated_At'];

            $_SESSION['userID'] = $userID;
            $_SESSION['userName'] = $userName;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['userType'] = $userType;
            $_SESSION['status'] = $status;
            $_SESSION['registrationNumber'] = $registrationNumber;
            $_SESSION['phoneNumber'] = $phoneNumber;
            $_SESSION['Created_At'] = $Created_At;
            $_SESSION['Updated_At'] = $Updated_At;

            return true;
        } else {
            return false;
        }
    }
    function checkUserExistOrNot($userName, $registrationNumber){
        $con = dbConnection();
        $sql = "SELECT * FROM `user` WHERE userName = ? AND registrationNumber = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $userName, $registrationNumber);

        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows == 1){
            $row = $result->fetch_assoc();

            return $row['userID'];
        } else {            
            return false;
        }


    }
    function addNewUser($userName, $password, $email, $userType, $status, $registrationNumber, $phoneNumber, $Created_At, $Updated_At){
        $con = dbConnection();
        // date_default_timezone_set('Asia/Dhaka');
        // $Created_At = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `user`(`userName`, `email`, `password`, `userType`, `status`, `registrationNumber`, `phoneNumber`, `Created_At`, `Updated_At`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssisss", $userName, $password, $email, $userType, $status, $registrationNumber, $phoneNumber, $Created_At, $Updated_At);

        $stmt->execute();
        $result = $stmt->get_result();
        
        $stmt->close();
        $con->close();
    }
    function viewAll(){
        $con = dbConnection();
        $sql = "SELECT * FROM `user`";
        $stmt = $con->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()){

        }
    }
?>