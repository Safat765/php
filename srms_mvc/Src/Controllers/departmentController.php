<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Models/department.php';
    require '../../Data/cleanData.php';

    class departmentController
    {
        function departmentCreate($dep_name)
        {
            $department_name = sanitize($dep_name);
            $isValid = true;
            $d_name = $department_name;

            if (empty($d_name)){
                $_SESSION['dep_name_error_msg'] = "Department Name required!";
                $isValid = false;
            }
            else{
                $_SESSION['dep_name_error_msg'] = "";
            }

            $created_by = $_SESSION['user_id'];
            $objDepartment = new department();

            if ($isValid === true){ 
                $result = $objDepartment->checkDepertmentModel($department_name);
                if ($result == 0) {
                    $objDepartment->createDepartmentModel($department_name, $created_by);
                    $_SESSION['create_dep_msg'] = " Depertment Created Successfully";
                    $this->showAllDepartment();
                } else {            
                    $_SESSION['create_dep_msg'] = " This Depertment has already been Created before";
                    $this->showAllDepartment();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showAllDepartment();
            }
        }
        function updateDepertment($dep_id, $department_name)
        {            
            $objDepartment = new department();
            $objDepartment->update($dep_id, $department_name);
            $_SESSION['create_dep_msg'] = "Edited Successfully";
            $this->showAllDepartment();
            
        }
        function backToDashboard()
        {
            if (isset($_SESSION['dep_name_error_msg'])) {                
                unset($_SESSION['dep_name_error_msg']);
                unset($_SESSION['create_dep_msg']);
                header ('Location: ../Views/dashboard.php');
                exit;
            } else {            
                unset($_SESSION['dep_name_error_msg']);
                unset($_SESSION['create_dep_msg']);
                header ('Location: ../Views/dashboard.php');
                exit;
            }
        }
        public function showCreatePage()
        {
            include '../Views/Department/create.php';
        }
        public function showAllDepartment() 
        {
            $objDepartment = new department();
            $result = $objDepartment->showFullDepartmentList();
            if (mysqli_num_rows($result) > 0) {
                include '../Views/Department/Index.php';
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
        }
        public function delete($dep_id)
        {
            $departmentID = sanitize($dep_id);
            $objDepartment = new department();
            $objDepartment->deleteDepartment($departmentID);
            $this->showAllDepartment();
            $_SESSION['create_dep_msg'] =" ". $departmentID . " number department Deleted Successfully";
        }
        function editViewCall($department_id)
        {
            $objDepartment = new department();
            $result = $objDepartment->updateDepartmentInfo($department_id);
            if (mysqli_num_rows($result) > 0) {
                include '../Views/Department/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $objDepartment = new departmentController();

        if (isset($_POST['createDepartment'])) {
            $objDepartment->showCreatePage();
        }

        if (isset($_POST['create'])) {
            $objDepartment->departmentCreate($_POST['dep_name']);
        }

        if (isset($_POST['editCall'])) {
            $objDepartment->editViewCall($_POST['department_id']);
        }

        if (isset($_POST['back_dashboard'])) {
            $objDepartment->backToDashboard();
        }

        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $objDepartment->updateDepertment($_POST['department_id'], $_POST['dep_name']);
            }
            elseif ($_POST['_method'] === "DELETE") {
                $objDepartment->delete($_POST['department_id']);
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === "GET") {

        $objDepartment = new departmentController();

        if (isset($_GET['viewAllDepartment'])) {
            $objDepartment->showAllDepartment();
        }
        
        if (isset($_GET['backFromEdit'])) {
            $objDepartment->showAllDepartment();
        }
    }
?>