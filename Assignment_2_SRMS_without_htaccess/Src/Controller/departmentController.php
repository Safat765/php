<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/department.php';
    require '../../Data/cleanData.php';

    class departmentController
    {
        function departmentCreate($dep_name)
        {
            $department_name = sanitize($dep_name);
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

            $created_by = $_SESSION['user_id'];
            $model = new department();

            if ($isValid === true){ 
                $result = $model->checkDepertmentModel($department_name);
                if ($result == 0) {
                    $model->createDepartmentModel($department_name, $created_by);
                    $_SESSION['create_dep_msg'] = " Depertment Created Successfully";
                    $this->showAllDepartment();
                    // header ('Location: ../View/Department/create.php');
                    // exit(0);
                } else {            
                    $_SESSION['create_dep_msg'] = " This Depertment has already been Created before";
                    $this->showAllDepartment();
                    // header ('Location: ../View/Department/create.php');
                    // exit(0);
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showAllDepartment();
                // header ('Location: ../View/Department/create.php');
                // exit;
            }
        }
        function updateDepertment($dep_id, $department_name, $created_by)
        {            
            $model = new department();
            // $result = $model->checkDepertmentModel($department_name);
            // if ($result == 0) {    
                $model->update($dep_id, $department_name, $created_by);
                $_SESSION['create_dep_msg'] = "Edited Successfully";
                $this->showAllDepartment();
                // header ('Location: ../View/Department/Index.php');
                // exit(0);
            // } else {            
            //     $_SESSION['create_dep_msg'] = "This Depertment has already exist";
            //     $this->showAllDepartment();
            //     // header ('Location: ../View/Department/edit.php');
            //     // exit(0);
            // }
            
        }
        function backToDashboard()
        {
            if (isset($_SESSION['dep_name_error_msg'])) {                
                unset($_SESSION['dep_name_error_msg']);
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {            
                unset($_SESSION['dep_name_error_msg']);
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        public function showCreatePage()
        {
            include '../View/Department/create.php';
        }
        public function showAllDepartment() 
        {
            $model = new department();
            $result = $model->showFullDepartmentList();
            if (mysqli_num_rows($result) > 0) {
                include '../View/Department/Index.php';
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
        }
        public function delete($dep_id)
        {
            $departmentID = sanitize($dep_id);
            $obj = new department();
            $obj->deleteDepartment($departmentID);
            $this->showAllDepartment();
            $_SESSION['create_dep_msg'] =" ". $departmentID . " number department Deleted Successfully";
        }
        function editViewCall($department_id)
        {
            $model = new department();
            $result = $model->updateDepartmentInfo($department_id);
            if (mysqli_num_rows($result) > 0) {
                include '../View/Department/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
            // header ('Location: ../View/Department/edit.php');
            // exit(0);
        }
    }



    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $obj = new departmentController();
        if (isset($_POST['createDepartment'])) {
            $obj->showCreatePage();
        }
        if (isset($_POST['create'])) {
            $obj->departmentCreate($_POST['dep_name']);
        }
        if (isset($_POST['editCall'])) {
            $obj->editViewCall($_POST['department_id']);
        }
        // if (isset($_POST['edit'])) {
        //     $obj->updateDepertment($_POST['dep_name'], $_POST['dep_created_by']);
        // }
        if (isset($_POST['back_dashboard'])) {
            $obj->backToDashboard();
        }
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $obj->updateDepertment($_POST['department_id'], $_POST['dep_name'], $_POST['dep_created_by']);
            }
            elseif ($_POST['_method'] === "DELETE") {
                $obj->delete($_POST['department_id']);
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === "GET") {        
        $obj = new departmentController();
        if (isset($_GET['viewAllDepartment'])) {
            $obj->showAllDepartment();
        }
        if (isset($_GET['backFromEdit'])) {
            $obj->showAllDepartment();
        }
    }


?>