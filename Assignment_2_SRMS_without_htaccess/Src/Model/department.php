<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    class department
    {
        function dbConnection()
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
        function checkDepertmentModel($department_name)
        {        
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `department` WHERE `name` = '$department_name'";
            $result = mysqli_query($con, $sql);

            return $result->num_rows;
        }

        function createDepartmentModel($department_name, $created_by)
        {
            $con = $this->dbConnection();
            $sql = "INSERT INTO `department`(`name`, `created_by`) VALUES ('$department_name','$created_by')";
            $result = mysqli_query($con, $sql);
        }

        function showFullDepartmentList() 
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `department`";
            $result = mysqli_query($con, $sql);
            
            return $result;
        }

        function deleteDepartment($dID)
        {
            $con = $this->dbConnection();
            $sql = "DELETE FROM `department` WHERE `department_id` = $dID";
            $result = mysqli_query($con, $sql);
        }
        function updateDepartmentInfo($dID)
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `department` WHERE `department_id` = $dID";
            $result = mysqli_query($con, $sql);
            
            return $result;
        }
        function update($dID, $department_name, $created_by)
        {
            $con = $this->dbConnection();
            $sql = "UPDATE `department` SET `name`='$department_name',`created_by`='$created_by' WHERE `department_id` = $dID";
            $result = mysqli_query($con, $sql);
        }    
        function showDepartementList()
        {
            $con = $this->dbConnection();
            $sql = "SELECT * FROM `department`";
            $result = mysqli_query($con, $sql);

            return $result;
        }
    }


?>