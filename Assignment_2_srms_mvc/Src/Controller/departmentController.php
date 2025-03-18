<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/department.php';
    require '../../Data/cleanData.php';

    class departmentController{

        static function departmentCreate($department_name){
            $department_name = sanitize($department_name);
            $created_by = $_SESSION['username'];
            createDepartmentModel($department_name, $created_by);
        }
        function checkDepertment($department_name){
            $isValid = true;        
            $userExist = null;

            $d_name = $department_name;        

            if (empty($d_name)){
                $_SESSION['dep_name_error_msg'] = "Department Name required!";
                $isValid = false;
            }
            else{
                $_SESSION['dep_name_error_msg'] = "";
            }

            if ($isValid === true){ 

                $result = checkDepertmentModel($department_name);
                if ($result == 0) {
                    self::departmentCreate($department_name);
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
        function editViewCall(){
            header ('Location: ../View/Department/edit.php');
            exit(0);
        }
        function updateDepertment($department_name, $created_by){
            $result = checkDepertmentModel($department_name);
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
        function backToDashboard(){
            if (isset($_SESSION['dep_name_error_msg'])) {
                
                unset($_SESSION['dep_name_error_msg']);

                header ('Location: ../View/dashboardView.php');
                exit;
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
    }



    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $obj = new departmentController();

        if (isset($_POST['create'])) {
            $obj->checkDepertment($_POST['dep_name']);
        }
        if (isset($_POST['edit_Call'])) {
            $_SESSION['department_id'] = $_POST['department_id'];
            $obj->editViewCall();
        }
        if (isset($_POST['edit'])) {
            $obj->updateDepertment($_POST['dep_name'], $_POST['dep_created_by']);
        }
        if (isset($_POST['delete'])) {
            deleteDepartment($_POST['department_id']);
        }
        if (isset($_POST['back_dashboard'])) {
            $obj->backToDashboard();
        }
    } else{
        echo "File is not working in post";
        exit;
    }


?>