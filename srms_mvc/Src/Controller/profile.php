<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/profile.php';
    require '../../Data/cleanData.php';

    class profileController {
        public static function create_profile($firstname1, $middlename1, $lastname1, $department1, $session1, $user_id1) {
            $first_name = sanitize($firstname1);
            $middle_name = sanitize($middlename1);
            $last_name = sanitize($lastname1);
            $department = sanitize($department1);
            $session = sanitize($session1);
            $user_id = sanitize($user_id1);

            $fields = [
                'first_name' => 'first_name required!',
                'middle_name' => 'middle_name required!',
                'last_name' => 'last_name required!',
                'department' => 'department type required!',
                'user_id' => 'user_id required!',
            ];
            
            $isValid = true;
            
            foreach ($fields as $field => $errorMessage) {
                if (empty($$field)) {
                    ${$field . 'ErrMsg'} = $errorMessage;
                    $_SESSION[$field . 'ErrMsg'] = $$field . 'ErrMsg';
                    $isValid = false;
                } else {
                    $_SESSION[$field . 'ErrMsg'] = '';
                }
            }
            
            $registration_number = profileModel::fatch_reg_num($user_id);

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
                    profileModel::creat_profile($first_name, $middle_name, $last_name, $department, $registration_number, $session, $user_id);
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
        public static function edit_Call(){
            header ('Location: ../View/Profile/edit.php');
            exit(0);
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
            $_SESSION['profile_user_id'] = $_POST['user_id'];
            profileController::edit_Call();
        }
        if (isset($_POST['confirmUpdate'])) {
            profileController::confirmUpdate($_POST['user_id'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name']);
        }
        if (isset($_POST['delete'])) {
            profileController::delete_profile($_POST['user_id']);
        }
    }




?>