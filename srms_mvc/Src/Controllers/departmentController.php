<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Models/department.php';
    require '../../Data/cleanData.php';

    class DepartmentController
    {
        public function create($name1)
        {
            $name = sanitize($name1);
            $isValid = true;

            if (empty($name)) {
                $_SESSION['dep_name_error_msg'] = "Department Name required!";
                $isValid = false;
            } else {
                $_SESSION['dep_name_error_msg'] = "";
            }

            $createdBy = $_SESSION['user_id'];
            $objDepartment = new Department();

            if ($isValid === true) { 
                $result = $objDepartment->checkDepertment($name);
                
                if ($result == 0) {
                    $objDepartment->create($name, $createdBy);
                    $_SESSION['create_dep_msg'] = " Depertment Created Successfully";
                    $this->showAll();
                } else {            
                    $_SESSION['create_dep_msg'] = " This Depertment has already been Created before";
                    $this->showAll();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up the field first";
                $this->showCreatePage();
            }
        }

        public function update($ID, $name)
        {            
            $objDepartment = new Department();
            $objDepartment->update($ID, $name);
            $_SESSION['create_dep_msg'] = "Edited Successfully";
            $this->showAll();            
        }

        public function backToDashboard()
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

        public function showAll() 
        {
            $objDepartment = new Department();
            $result = $objDepartment->showFullList();
            
            if (mysqli_num_rows($result) > 0) {
                include '../Views/Department/Index.php';
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
        }

        public function delete($ID)
        {
            $departmentID = sanitize($ID);
            $objDepartment = new Department();
            $objDepartment->delete($departmentID);
            $this->showAll();
            $_SESSION['create_dep_msg'] =" ". $departmentID . " number department Deleted Successfully";
        }

        public function editViewCall($ID)
        {
            $objDepartment = new Department();
            $result = $objDepartment->updateDepartmentInfo($ID);
            
            if (mysqli_num_rows($result) > 0) {
                include '../Views/Department/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $objDepartment = new DepartmentController();

        if (isset($_POST['createDepartment'])) {
            $objDepartment->showCreatePage();
        }

        if (isset($_POST['create'])) {
            $objDepartment->create($_POST['dep_name']);
        }

        if (isset($_POST['editCall'])) {
            $objDepartment->editViewCall($_POST['department_id']);
        }

        if (isset($_POST['back_dashboard'])) {
            $objDepartment->backToDashboard();
        }

        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $objDepartment->update($_POST['department_id'], $_POST['dep_name']);
            }
            elseif ($_POST['_method'] === "DELETE") {
                $objDepartment->delete($_POST['department_id']);
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === "GET") {

        $objDepartment = new DepartmentController();

        if (isset($_GET['viewAllDepartment'])) {
            $objDepartment->showAll();
        }
        
        if (isset($_GET['backFromEdit'])) {
            $objDepartment->showAll();
        }
    }
?>