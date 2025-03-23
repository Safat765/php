<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include_once '../Models/profile.php';
    include_once '../../Data/cleanData.php';
    include_once '../Models/course.php';

    class profileController
    {
        public function createProfile($firstname1, $middlename1, $lastname1, $department1, $session1, $user_id1) 
        {
            $first_name = sanitize($firstname1);
            $middle_name = sanitize($middlename1);
            $last_name = sanitize($lastname1);
            $department = sanitize($department1);
            $session = sanitize($session1);
            $user_id = sanitize($user_id1);
            $isValid = true;

            if (empty($first_name)) {
                $_SESSION['first_name_error_msg'] = "First name is required";
                $isValid = false;
            } else {
                $_SESSION['first_name_error_msg'] = "";
            }

            if (empty($middle_name)) {
                $_SESSION['middle_name_error_msg'] = "Middle name is required";
                $isValid = false;
            } else {
                $_SESSION['middle_name_error_msg'] = "";
            }

            if (empty($last_name)) {
                $_SESSION['last_name_error_msg'] = "Last name is required";
                $isValid = false;
            } else {
                $_SESSION['last_name_error_msg'] = "";
            }

            if (empty($department)) {
                $_SESSION['department_error_msg'] = "Department is required";
                $isValid = false;
            } else {
                $_SESSION['department_error_msg'] = "";
            }

            if (empty($user_id)) {
                $_SESSION['user_id_error_msg'] = "User ID is required";
                $isValid = false;
            } else {
                $_SESSION['user_id_error_msg'] = "";
            }   

            $objProfile = new profileModel();

            if ($isValid === true){

                $chekUserExist = $objProfile->checkUser($user_id);

                if ($chekUserExist == true) {
                    $userType = $objProfile->checkUserType($user_id);                    
                    if ($userType == 2 || $userType == 1) {
                        $session = '';
                        $objProfile->creatProfile($first_name, $middle_name, $last_name, $department, $session, $user_id);
                        $_SESSION['create_dep_msg'] = "Profile added successfully";
                        $this->showCreatePage();
                    } else {
                        $objProfile->creatProfile($first_name, $middle_name, $last_name, $department, $session, $user_id);
                        $_SESSION['create_dep_msg'] = "Profile added successfully";
                        $this->showCreatePage();
                    }
                } else {
                    $_SESSION['create_dep_msg'] = " This Profile already exists";
                    $this->showCreatePage();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up all the field first";
                $this->showCreatePage();
            }

        } 
        public function backToDashboard()
        {
            if (isset($_SESSION['first_name_error_msg']) &&  isset($_SESSION['middle_name_error_msg']) && isset($_SESSION['last_name_error_msg']) && isset($_SESSION['department_error_msg']) &&  isset($_SESSION['session_error_msg']) && isset($_SESSION['user_id_error_msg'])) {
                
                unset($_SESSION['first_name_error_msg']);
                unset($_SESSION['middle_name_error_msg']);
                unset($_SESSION['last_name_error_msg']);
                unset($_SESSION['department_error_msg']);
                unset($_SESSION['session_error_msg']);
                unset($_SESSION['user_id_error_msg']);
    
                header ('Location: ../Views/dashboard.php');
                exit;
            } else {    
                unset($_SESSION['first_name_error_msg']);
                unset($_SESSION['middle_name_error_msg']);
                unset($_SESSION['last_name_error_msg']);
                unset($_SESSION['department_error_msg']);
                unset($_SESSION['session_error_msg']);
                unset($_SESSION['user_id_error_msg']);

                header ('Location: ../Views/dashboard.php');
                exit;
            }
        }
        public function editCall($profile_user_id)
        {
            $objProfile = new profileModel();
            $result = $objProfile->showUpdateUserDate($profile_user_id);
            $result1 = $objProfile->showDepList();

            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Profile/edit.php';
                }  else {
                    echo "<h3> No id found </h3>";
                }
            } else {
                echo "<h3> No id found </h3>";
            }
        }
        public function confirmUpdate($user_id, $first_name, $middle_name, $last_name)
        {
            $first_name = sanitize($first_name);
            $middle_name = sanitize($middle_name);
            $last_name = sanitize($last_name);
            $user_id = sanitize($user_id);
            
            $objProfile = new profileModel();            
            $chekUserExist = $objProfile->checkUser($user_id);

            if ($chekUserExist !== 0) {
                $objProfile->updateProfile($first_name, $middle_name, $last_name, $user_id);
                $_SESSION['create_dep_msg'] = "Profile edited successfully";
                $this->editCall($_SESSION['profile_user_id']);
            } else {
                $_SESSION['create_dep_msg'] = " This Profile is not exists";
                $this->editCall($_SESSION['profile_user_id']);
            }
        }
        public function showCreatePage() 
        {
            $objProfile = new profileModel();
            $result = $objProfile->showDepList();
            $result1 = $objProfile->showUser();

            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Profile/create.php';
                }
            }
        }
        public function showLoggedProfile($user_id)
        {
            $objProfile = new profileModel();
            $result = $objProfile->showListProfile($user_id);

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Profile/profile.php';
            } else {
                echo "<tr><td colspan='8'>No users found.</td></tr>";
            }
        }
        public function showLoggedEditProfile($user_id) 
        {
            $objProfile = new profileModel();
            $result = $objProfile->showListProfile($user_id);

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Profile/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
        }
    }    

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $obj = new profileController();

        if (isset($_POST['create'])) {
            $obj->createProfile($_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['department'], $_POST['session'], $_POST['user_id']);
        }

        if (isset($_POST['back_dashboard'])) {
            $obj->backToDashboard();
        }
        
        if (isset($_POST['editCall'])) {
            $obj->showLoggedEditProfile($_POST['user_id']);
        }
        
        if (isset($_POST['editCall_Index'])) {
            $_SESSION['profile_user_id'] = $_POST['user_id'];
            $obj->editCall($_POST['user_id']);
        }
        
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $obj->confirmUpdate($_POST['user_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']);
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
        
        $obj = new profileController();
        
        if (isset($_GET['back'])) {
            $obj->showLoggedProfile($_SESSION['user_id']);
        }
        
        if (isset($_GET['createProfile'])) {
            $obj->showCreatePage();
        }
        
        if (isset($_GET['showLoggedProfile'])) {
            $obj->showLoggedProfile($_SESSION['user_id']);
        }
    }
?>