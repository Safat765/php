<?php
    function dbConnection($dbName){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "$dbName";

        $con = mysqli_connect($servername, $username, $password, $database);

        if (!$con){
            die("Error detected ". mysqli_connect_error(). "<br>");
        }
        
        return $con;
    }
?>