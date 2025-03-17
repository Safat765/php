<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/department.php';
    require '../../Data/cleanData.php';

    function department_Create_cntrl($department_name){
        $department_name = sanitize($department_name);
        $created_by = $_SESSION['username'];
        create_Department_Model($department_name, $created_by);
    }
    function check_depertment($department_name){
        $isValid = true;        
        $userExist = null;

        $d_name = $department_name;        

        if (empty($d_name)){
            $_SESSION['dep_nameErrMsg'] = "Department Name required!";
            $isValid = false;
        }
        else{
            $_SESSION['dep_nameErrMsg'] = "";
        }

        if ($isValid === true){ 

            $result = check_depertment_model($department_name);
            if ($result == 0) {
                department_Create_cntrl($department_name);
                $_SESSION['create_dep_msg'] = " Depertment Created Successfully";
                header ('Location: ../View/Department/create.php');
                exit(0);
            } else {            
                $_SESSION['create_dep_msg'] = " This Depertment has already been Created before";
                header ('Location: ../View/Department/create.php');
                exit(0);
            }
        } else {
            $_SESSION['create_dep_msg'] = " Fill up the field first";
            header ('Location: ../View/Department/create.php');
            exit;
        }
    }
    function editView_Call(){
        header ('Location: ../View/Department/edit.php');
        exit(0);
    }
    function update_depertment($department_name, $created_by){
        $result = check_depertment_model($department_name);
        if ($result == 0) {     
            $dID = $_SESSION['department_id'];       
            update($dID, $department_name, $created_by);
            unset($_SESSION['department_id']);
            $_SESSION['create_dep_msg'] = "Edited Successfully";
            header ('Location: ../View/Department/Index.php');
            exit(0);
        } else {            
            $_SESSION['create_dep_msg'] = "This Depertment has already exist";
            header ('Location: ../View/Department/edit.php');
            exit(0);
        }
        
    }
    function back_TO_dashboard(){
        if (isset($_SESSION['dep_nameErrMsg'])) {
            
            unset($_SESSION['dep_nameErrMsg']);

            header ('Location: ../View/dashboardView.php');
            exit;
        } else {            
            header ('Location: ../View/dashboardView.php');
            exit;
        }
    }



    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['create'])) {
            check_depertment($_POST['dep_name']);
        }
        if (isset($_POST['edit_Call'])) {
            $_SESSION['department_id'] = $_POST['department_id'];
            editView_Call();
        }
        if (isset($_POST['edit'])) {
            update_depertment($_POST['dep_name'], $_POST['dep_created_by']);
        }
        if (isset($_POST['delete'])) {
            delete_dep($_POST['department_id']);
        }
        if (isset($_POST['back_dashboard'])) {
            back_TO_dashboard();
        }
    } else{
        echo "File is not working in post";
        exit;
    }


?>