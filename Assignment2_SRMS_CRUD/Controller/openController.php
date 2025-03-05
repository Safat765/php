<?php
    //$startURL = "http://localhost/dashboard/1_Office/Assignment2_SRMS_CRUD/View/loginView.php";

    abstract class launch{
        function startURL($startURL){
            header("Location: ../Assignment2_SRMS_CRUD/View/loginView.php");
            exit;
        }
    }
    
?>