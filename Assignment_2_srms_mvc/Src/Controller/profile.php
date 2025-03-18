<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    include_once '../Model/profile.php';
    include_once '../../Data/cleanData.php';
    include_once '../Model/course.php';

    class profileController
    {
        public function create_profile($firstname1, $middlename1, $lastname1, $department1, $session1, $user_id1) 
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

            // if (empty($session)) {
            //     $_SESSION['session_error_msg'] = "Session is required";
            //     $isValid = false;
            // } else {
            //     $_SESSION['session_error_msg'] = "";
            // }

            if (empty($user_id)) {
                $_SESSION['user_id_error_msg'] = "User ID is required";
                $isValid = false;
            } else {
                $_SESSION['user_id_error_msg'] = "";
            }            

            // echo $first_name . "<br>";
            // echo $middle_name ."<br>";
            // echo $last_name ."<br>";
            // echo $department ."<br>";
            // echo $session ."<br>";
            // echo $user_id ."<br>";
            // echo $registration_number ."<br>";
            
            $obj = new profileModel();

            if ($isValid === true){
                $chek_user_exist = $obj->check_user($user_id);
                if ($chek_user_exist == true) {
                    $userType = $obj->checkUserType($user_id);
                    
                    if ($userType == 2 || $userType == 1) {
                        $session = '';
                        $obj->creat_profile($first_name, $middle_name, $last_name, $department, $session, $user_id);
                        $_SESSION['create_dep_msg'] = "Profile added successfully";
                        $this->showCreatePage();
                        //header ('Location: ../View/Profile/create.php');
                        // exit(0);
                    } else {
                        $obj->creat_profile($first_name, $middle_name, $last_name, $department, $session, $user_id);
                        $_SESSION['create_dep_msg'] = "Profile added successfully";
                        $this->showCreatePage();
                    }
                } else {
                    $_SESSION['create_dep_msg'] = " This Profile already exists";
                    $this->showCreatePage();
                    // header ('Location: ../View/Profile/create.php');
                    // exit(0);
                }

            } else {
                $_SESSION['create_dep_msg'] = " Fill up all the field first";
                $this->showCreatePage();
                // header("Location: ../View/Profile/create.php");
                // exit;
            }

        } 
        public function back_TO_dashboard()
        {
            if (isset($_SESSION['first_name_error_msg']) &&  isset($_SESSION['middle_name_error_msg']) && isset($_SESSION['last_name_error_msg']) && isset($_SESSION['department_error_msg']) &&  isset($_SESSION['session_error_msg']) && isset($_SESSION['user_id_error_msg'])) {
                
                unset($_SESSION['first_name_error_msg']);
                unset($_SESSION['middle_name_error_msg']);
                unset($_SESSION['last_name_error_msg']);
                unset($_SESSION['department_error_msg']);
                unset($_SESSION['session_error_msg']);
                unset($_SESSION['user_id_error_msg']);
    
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {    
                unset($_SESSION['first_name_error_msg']);
                unset($_SESSION['middle_name_error_msg']);
                unset($_SESSION['last_name_error_msg']);
                unset($_SESSION['department_error_msg']);
                unset($_SESSION['session_error_msg']);
                unset($_SESSION['user_id_error_msg']);

                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        public function edit_Call($profile_user_id)
        {
            //echo $_SESSION['profile_user_id'];
            $editCall = new profileModel();
            $result = $editCall->showUpdateUserDate($profile_user_id);
            $result1 = $editCall->show_dep_list();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../View/Profile/edit.php';
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
            
            $obj = new profileModel();
            
            $chek_user_exist = $obj->check_user($user_id);
            if ($chek_user_exist !== 0) {
                $obj->update_profile($first_name, $middle_name, $last_name, $user_id);
                $_SESSION['create_dep_msg'] = "Profile edited successfully";
                $this->edit_Call($_SESSION['profile_user_id']);
                // header ('Location: ../View/Profile/Index.php');
                // exit(0);
            } else {
                $_SESSION['create_dep_msg'] = " This Profile is not exists";
                $this->edit_Call($_SESSION['profile_user_id']);
                // header ('Location: ../View/Profile/Index.php');
                // exit(0);
            }
        }
        public function showAllProfile()
        {
            $obj = new profileModel();
            $result = $obj->show_List();
            $result1 = $obj->show_user();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../View/Profile/Index.php';
                }
            } else {
                echo "<tr><td colspan='8'>No users found.</td></tr>";
            }
        }
        public function deleteProfile($user_id)
        {
            $deleteProfile = new profileModel();
            $deleteProfile->delete($user_id);
            $this->showAllProfile();
            // header ('Location: ../View/Profile/Index.php');
            // exit(0);
        }
        public function showCreatePage() 
        {
            $CreatePage = new profileModel();
            $result = $CreatePage->show_dep_list();
            $result1 = $CreatePage->show_user();
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result1) > 0) {
                    include '../View/Profile/create.php';
                }
            }
        }
        public function showLoggedProfile($user_id)
        {
            $LoggedProfile = new profileModel();
            $result = $LoggedProfile->show_List_profile($user_id);
            if (mysqli_num_rows($result) > 0) {
                include '../View/Profile/profile.php';
            } else {
                echo "<tr><td colspan='8'>No users found.</td></tr>";
            }
        }
        public function showLoggedEditProfile($user_id) 
        {
            $showLoggedEditProfile = new profileModel();
            $result = $showLoggedEditProfile->show_List_profile($user_id);
            if (mysqli_num_rows($result) > 0) {
                include '../View/Profile/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
        }
    }      
    

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $obj = new profileController();

        if (isset($_POST['create'])) {
            $obj->create_profile($_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['department'], $_POST['session'], $_POST['user_id']);
        }
        if (isset($_POST['back_dashboard'])) {
            $obj->back_TO_dashboard();
        }
        // if (isset($_POST['confirmUpdate'])) {
        //     profileController::confirmUpdate($_POST['user_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']);
        // }
        if (isset($_POST['editCall'])) {
            $obj->showLoggedEditProfile($_POST['user_id']);
        }
        if (isset($_POST['edit_Call_Index'])) {
            $_SESSION['profile_user_id'] = $_POST['user_id'];
            $obj->edit_Call($_POST['user_id']);
        }
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $obj->confirmUpdate($_POST['user_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']);
            }
            elseif ($_POST['_method'] === "DELETE") {
                $obj->deleteProfile($_POST['user_id']);
            }
        }
        // if (isset($_POST['_editMethod'])) {
        //     if ($_POST['_editMethod'] === "PUT") {
        //         echo $_POST['user_id'];
        //         // if (isset($_POST['editCall'])) {
        //         //     $obj->confirmUpdate($_POST['user_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']);
            
        //         // }
        //     }
        // }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
        $obj = new profileController();
        if (isset($_GET['viewAllProfile'])) {
            $obj->showAllProfile();
        }
        if (isset($_GET['back'])) {
            $obj->showAllProfile();
        }
        if (isset($_GET['createProfile'])) {
            $obj->showCreatePage();
        }
        if (isset($_GET['showLoggedProfile'])) {
            $obj->showLoggedProfile($_SESSION['user_id']);
        }
    }
?>