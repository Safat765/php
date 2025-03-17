<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    include_once '../Model/profile.php';
    include_once '../../Data/cleanData.php';
    include_once '../Model/course.php';

    class profileController {
        public static function create_profile($firstname1, $middlename1, $lastname1, $department1, $session1, $user_id1) {
            $first_name = sanitize($firstname1);
            $middle_name = sanitize($middlename1);
            $last_name = sanitize($lastname1);
            $department = sanitize($department1);
            $session = sanitize($session1);
            $user_id = sanitize($user_id1);

            if (empty($first_name)) {
                $_SESSION['first_nameErrMsg'] = "First name is required";
                $isValid = false;
            } else {
                $_SESSION['first_nameErrMsg'] = "";
            }

            if (empty($middle_name)) {
                $_SESSION['middle_nameErrMsg'] = "Middle name is required";
                $isValid = false;
            } else {
                $_SESSION['middle_nameErrMsg'] = "";
            }

            if (empty($last_name)) {
                $_SESSION['last_nameErrMsg'] = "Last name is required";
                $isValid = false;
            } else {
                $_SESSION['last_nameErrMsg'] = "";
            }

            if (empty($department)) {
                $_SESSION['departmentErrMsg'] = "Department is required";
                $isValid = false;
            } else {
                $_SESSION['departmentErrMsg'] = "";
            }

            if (empty($session)) {
                $_SESSION['sessionErrMsg'] = "Session is required";
                $isValid = false;
            } else {
                $_SESSION['sessionErrMsg'] = "";
            }

            if (empty($user_id)) {
                $_SESSION['user_idErrMsg'] = "User ID is required";
                $isValid = false;
            } else {
                $_SESSION['user_idErrMsg'] = "";
            }            

            // echo $first_name . "<br>";
            // echo $middle_name ."<br>";
            // echo $last_name ."<br>";
            // echo $department ."<br>";
            // echo $session ."<br>";
            // echo $user_id ."<br>";
            // echo $registration_number ."<br>";

            if ($isValid === true){
                $chek_user_exist = profileModel::check_user($user_id);
                if ($chek_user_exist == true) {
                    profileModel::creat_profile($first_name, $middle_name, $last_name, $department, $session, $user_id);
                    $_SESSION['create_dep_msg'] = "Profile added successfully";
                    header ('Location: ../View/Profile/create.php');
                    exit(0);
                } else {
                    $_SESSION['create_dep_msg'] = " This Profile already exists";
                    header ('Location: ../View/Profile/create.php');
                    exit(0);
                }

            } else {
                $_SESSION['create_dep_msg'] = " Fill up all the field first";
                header("Location: ../View/Profile/create.php");
                exit;
            }

        } 
        public static function back_TO_dashboard(){
            if (isset($_SESSION['first_nameErrMsg']) &&  isset($_SESSION['middle_nameErrMsg']) && isset($_SESSION['last_nameErrMsg']) && isset($_SESSION['departmentErrMsg']) &&  isset($_SESSION['sessionErrMsg']) && isset($_SESSION['user_idErrMsg'])) {
                
                unset($_SESSION['first_nameErrMsg']);
                unset($_SESSION['middle_nameErrMsg']);
                unset($_SESSION['last_nameErrMsg']);
                unset($_SESSION['departmentErrMsg']);
                unset($_SESSION['sessionErrMsg']);
                unset($_SESSION['user_idErrMsg']);
    
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        public static function edit_Call($profile_user_id){
            //echo $_SESSION['profile_user_id'];
            $result = profileModel::showUpdateUserDate($profile_user_id);
            $result1 = profileModel::show_dep_list();
                if (mysqli_num_rows($result) > 0) {
                    if (mysqli_num_rows($result1) > 0) {
                        include '../View/Profile/edit.php';
                    }  else {
                        echo "<h3> No id found </h3>";
                    }
                } else {
                    echo "<h3> No id found </h3>";
                }
            // header ('Location: ../View/Profile/edit.php');
            //exit(0);

            // $result = profileModel::show_dep_list();
            // if (mysqli_num_rows($result) > 0) {
            //     include '../View/Profile/edit.php';
            // }
        }
        public static function confirmUpdate($user_id, $first_name, $middle_name, $last_name){
            $first_name = sanitize($first_name);
            $middle_name = sanitize($middle_name);
            $last_name = sanitize($last_name);
            $user_id = sanitize($user_id);

            $chek_user_exist = profileModel::check_user($user_id);
            if ($chek_user_exist !== 0) {
                profileModel::update_profile($first_name, $middle_name, $last_name, $user_id);
                $_SESSION['create_dep_msg'] = "Profile edited successfully";
                header ('Location: ../View/Profile/Index.php');
                exit(0);
            } else {
                $_SESSION['create_dep_msg'] = " This Profile is not exists";
                header ('Location: ../View/Profile/Index.php');
                exit(0);
            }
        }
        public static function delete_profile($user_id){            
            profileModel::delete($user_id);
            header ('Location: ../View/Profile/Index.php');
            exit(0);
        }
    }      
    

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        if (isset($_POST['create'])) {
            profileController::create_profile($_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['department'], $_POST['session'], $_POST['user_id']);
        }
        if (isset($_POST['back_dashboard'])) {
            profileController::back_TO_dashboard();
        }
        if (isset($_POST['edit_Call'])) {
            //$_SESSION['profile_user_id'] = $_POST['user_id'];
            profileController::edit_Call($_POST['user_id']);
        }
        if (isset($_POST['confirmUpdate'])) {
            profileController::confirmUpdate($_POST['user_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']);
        }
        if (isset($_POST['delete'])) {
            profileController::delete_profile($_POST['user_id']);
        }
    }




?>