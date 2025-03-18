<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }    
    if (!function_exists('dbConnection')) {
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
    }

    // Depertment

    function checkDepertmentModel($department_name){        
        $con = dbConnection();
        $sql = "SELECT * FROM `department` WHERE `name` = '$department_name'";
        $result = mysqli_query($con, $sql);

        return $result->num_rows;
    }

    function createDepartmentModel($department_name, $created_by){
        $con = dbConnection();
        $sql = "INSERT INTO `department`(`name`, `created_by`) VALUES ('$department_name','$created_by')";
        $result = mysqli_query($con, $sql);
    }

    function showFullDepartmentList() {
        $con = dbConnection();
        $sql = "SELECT * FROM `department`";
        $result = mysqli_query($con, $sql);
        
        return $result;
    }

    function deleteDepartment($dID){
        $con = dbConnection();
        $sql = "DELETE FROM `department` WHERE `department_id` = $dID";

        if (mysqli_query($con, $sql)){
            header('Location: ../View/Department/departmentIndex.php');
            exit;
        }else{
            echo "Deparment not found";
            exit;
        }
    }
    function updateDepartmentInfo($dID){
        $con = dbConnection();
        $sql = "SELECT * FROM `department` WHERE `department_id` = $dID";
        $result = mysqli_query($con, $sql);
        
        return $result;
    }
    function update($dID, $department_name, $created_by){
        $con = dbConnection();
        $sql = "UPDATE `department` SET `name`='$department_name',`created_by`='$created_by' WHERE `department_id` = $dID";
        $result = mysqli_query($con, $sql);
    }    
    function showDepartementList(){
        $con = dbConnection();
        $sql = "SELECT * FROM `department`";
        $result = mysqli_query($con, $sql);

        return $result;
    }


?>