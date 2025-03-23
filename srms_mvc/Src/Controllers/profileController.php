<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include_once '../Models/profile.php';
    include_once '../../Data/cleanData.php';
    include_once '../Models/course.php';
    include_once '../Models/user.php';

    class profile
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
                unset($_SESSION['create_dep_msg']);
                header ('Location: ../Views/dashboard.php');
                exit;
            } else {    
                unset($_SESSION['first_name_error_msg']);
                unset($_SESSION['middle_name_error_msg']);
                unset($_SESSION['last_name_error_msg']);
                unset($_SESSION['department_error_msg']);
                unset($_SESSION['session_error_msg']);
                unset($_SESSION['user_id_error_msg']);
                unset($_SESSION['create_dep_msg']);
                header ('Location: ../Views/dashboard.php');
                exit;
            }
        }
        public function editCall($id)
        {
            $objProfile = new profileModel();
            $result = $objProfile->showUpdateUserDate($id);
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
                $this->showLoggedProfile($_SESSION['userID']);
            } else {
                $_SESSION['create_dep_msg'] = " This Profile is not exists";
                $this->editCall($_SESSION['userID']);
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
        public function changePasswordPage(){
            include '../Views/Profile/changePassword.php';
        }
        public function confirmChangePassword($id, $oldPassword, $newPassword, $confirmPassword, $checkBoxValue) 
        {
            $oldPassword = sanitize($oldPassword);
            $newPassword = sanitize($newPassword);
            $confirmPassword = sanitize($confirmPassword);
            $isValid = true;
            $checkBoxValue;

            if (empty($oldPassword)) {
                $_SESSION['oldPassword_error_msg'] = "Current password is required";
                $isValid = false;
            } else {
                $_SESSION['oldPassword_error_msg'] = "";
            }

            if (empty($newPassword)) {
                $_SESSION['newPassword_error_msg'] = "New password is required";
                $isValid = false;
            } else {
                $_SESSION['newPassword_error_msg'] = "";
            }

            if (empty($confirmPassword)) {
                $_SESSION['confirmPassword_error_msg'] = "Confirm password is required";
                $isValid = false;
            } else {
                $_SESSION['confirmPassword_error_msg'] = "";
            }

            if ($isValid === true) {
                if ($newPassword === $confirmPassword) {

                    $objUser = new user();
                    $currentPassword = $objUser->checkPassword($id);

                    if (!password_verify($oldPassword, $newPassword)) {

                        $objUser ->updatePassword($id, $confirmPassword);
                        $_SESSION['create_dep_msg'] = " This password has been updated";

                        if ($checkBoxValue == "1") {
                            $this->showLoggedProfile($id);
                        } else {
                            session_destroy();
                            header('Location: http://localhost/dashboard/1_Office/srms_mvc/Src/Views/login.php');
                            exit;
                        }
                    } elseif (password_verify($oldPassword, $currentPassword)) {
                        $_SESSION['create_dep_msg'] = " This password is use before give a new password hash";
                        $this->changePasswordPage();
                    } else {
                        $_SESSION['create_dep_msg'] = " This password is use before give a new password";
                        $this->changePasswordPage();
                    }
                }  else {
                    $_SESSION['create_dep_msg'] = " New password and confirm password doesn't match";
                    $this->changePasswordPage();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up all the field";
                $this->changePasswordPage();
            }
        }
    }    

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $objProfile = new profile();

        if (isset($_POST['create'])) {
            $objProfile->createProfile($_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['department'], $_POST['session'], $_POST['user_id']);
        }

        if (isset($_POST['back_dashboard'])) {
            $objProfile->backToDashboard();
        }

        if (isset($_POST['backFromChangePassword'])) {
            $objProfile->backToDashboard();
        }
        
        if (isset($_POST['editCall'])) {
            $objProfile->showLoggedEditProfile($_POST['user_id']);
        }
        
        if (isset($_POST['editCall_Index'])) {
            $_SESSION['profile_user_id'] = $_POST['user_id'];
            $objProfile->editCall($_POST['user_id']);
        }
        
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $_SESSION['userID'] = $_POST['user_id'];
                $objProfile->confirmUpdate($_POST['user_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']);
            }
        }
        if (isset($_POST['_putMethod'])) {
            if ($_POST['_putMethod'] === "PUT") {
                $objProfile->confirmChangePassword($_POST['user_id'], $_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmPassword'], $_POST['myCheckbox']);
            }
        }

        if (isset($_POST['changePassword'])) {
            $objProfile->changePasswordPage($_SESSION['user_id']);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
        
        $objProfile = new profile();
        
        if (isset($_GET['back'])) {
            $objProfile->showLoggedProfile($_SESSION['user_id']);
        }
        
        if (isset($_GET['createProfile'])) {
            $objProfile->showCreatePage();
        }
        
        if (isset($_GET['showLoggedProfile'])) {
            $objProfile->showLoggedProfile($_SESSION['user_id']);
        }
    }
?>