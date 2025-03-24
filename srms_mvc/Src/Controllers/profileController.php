<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include_once '../Models/profile.php';
    include_once '../../Data/cleanData.php';
    include_once '../Models/course.php';
    include_once '../Models/user.php';

    class ProfileController
    {
        public function create($firstname1, $middlename1, $lastname1, $department1, $session1, $userId1) 
        {
            $firstName = sanitize($firstname1);
            $middleName = sanitize($middlename1);
            $lastName = sanitize($lastname1);
            $department = sanitize($department1);
            $session = sanitize($session1);
            $userId = sanitize($userId1);
            $isValid = true;

            if (empty($firstName)) {
                $_SESSION['first_name_error_msg'] = "First name is required";
                $isValid = false;
            } else {
                $_SESSION['first_name_error_msg'] = "";
            }

            if (empty($middleName)) {
                $_SESSION['middle_name_error_msg'] = "Middle name is required";
                $isValid = false;
            } else {
                $_SESSION['middle_name_error_msg'] = "";
            }

            if (empty($lastName)) {
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

            if (empty($userId)) {
                $_SESSION['user_id_error_msg'] = "User ID is required";
                $isValid = false;
            } else {
                $_SESSION['user_id_error_msg'] = "";
            }   

            $objProfile = new ProfileModel();

            if ($isValid === true){

                $chekUserExist = $objProfile->checkUser($userId);

                if ($chekUserExist == true) {
                    $userType = $objProfile->checkUserType($userId);                    
                    
                    if ($userType == 2 || $userType == 1) {
                        $session = '';
                        $objProfile->creatProfile($firstName, $middleName, $lastName, $department, $session, $userId);
                        $_SESSION['create_dep_msg'] = "Profile added successfully";
                        $this->showCreatePage();
                    } else {
                        $objProfile->creatProfile($firstName, $middleName, $lastName, $department, $session, $userId);
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
            $objProfile = new ProfileModel();
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

        public function confirmUpdate($userId, $firstName, $middleName, $lastName)
        {
            $firstName = sanitize($firstName);
            $middleName = sanitize($middleName);
            $lastName = sanitize($lastName);
            $userId = sanitize($userId);
            
            $objProfile = new ProfileModel();            
            $chekUserExist = $objProfile->checkUser($userId);

            if ($chekUserExist !== 0) {
                $objProfile->update($firstName, $middleName, $lastName, $userId);
                $_SESSION['create_dep_msg'] = "Profile edited successfully";
                $this->showLoggedProfile($_SESSION['userID']);
            } else {
                $_SESSION['create_dep_msg'] = " This Profile is not exists";
                $this->editCall($_SESSION['userID']);
            }
        }

        public function showCreatePage() 
        {
            $objProfile = new ProfileModel();
            $result = $objProfile->showDepList();
            $result1 = $objProfile->showUser();

            if (mysqli_num_rows($result) > 0) {
                
                if (mysqli_num_rows($result1) > 0) {
                    include '../Views/Profile/create.php';
                }
            }
        }

        public function showLoggedProfile($userId)
        {
            $objProfile = new ProfileModel();
            $result = $objProfile->showListProfile($userId);

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Profile/profile.php';
            } else {
                echo "<tr><td colspan='8'>No users found.</td></tr>";
            }
        }

        public function showLoggedEditProfile($userId) 
        {
            $objProfile = new ProfileModel();
            $result = $objProfile->showListProfile($userId);

            if (mysqli_num_rows($result) > 0) {
                include '../Views/Profile/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
        }

        public function changePasswordPage(){
            include '../Views/Profile/changePassword.php';
        }
        
        public function confirmChangePassword($id, $oldPassword, $newPassword, $confirmPassword) 
        {
            $oldPassword = sanitize($oldPassword);
            $newPassword = sanitize($newPassword);
            $confirmPassword = sanitize($confirmPassword);
            $isValid = true;

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

                    $objUser = new UserModel();
                    $currentPassword = $objUser->checkPassword($id);

                    if ($oldPassword !== $newPassword) {
                        $hashedPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);
                        $objUser ->updatePassword($id, $hashedPassword);
                        $_SESSION['create_dep_msg'] = " This password has been updated";
                        $this->changePasswordPage();
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
        $objProfile = new ProfileController();

        if (isset($_POST['create'])) {
            $objProfile->create($_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['department'], $_POST['session'], $_POST['user_id']);
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
                $objProfile->confirmChangePassword($_POST['user_id'], $_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
            }
        }

        if (isset($_POST['changePassword'])) {
            $objProfile->changePasswordPage($_SESSION['user_id']);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
        
        $objProfile = new ProfileController();
        
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