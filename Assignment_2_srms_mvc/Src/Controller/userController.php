<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Model/user.php';
    require '../../Data/cleanData.php';
    const INACTIVE = 0;
    const ACTIVE = 1; 

    class UserController{      

        function login($username1, $password1){
            $isValid = true;
            $username_error_msg = "";
            $password_error_msg = "";
            $_error_msg = "";
            $username = sanitize($username1);
            $password = sanitize($password1);
            $_error_msg = "";
                
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            // echo $_SESSION['username'] . " " . $_SESSION['password'];
        
            if (empty($username)) {
                $username_error_msg = "username required!";
                $_SESSION['username_error_msg'] = $username_error_msg;
                $isValid = false;
            } else {
                $_SESSION['username'] = $username;
            }
            if (empty($password)) {
                $password_error_msg = "Password required!";
                $_SESSION['password_error_msg'] = $password_error_msg;
                $isValid = false;
            } else {
                $_SESSION['password'] = $password;
            }
        
            // if (isset($_POST["login"])) {
                if ($isValid === true){
                    if (loginModel($username, $password)) {
                        header("Location: ../View/dashboardView.php");
                    } else {
                        $_SESSION['create_dep_msg'] = "username or password incorrect";
                        $_error_msg = "username or password incorrect";
                        $_SESSION['error_msg'] = $_error_msg;
                        header("Location: ../View/login.php");
                        exit;
                    }
                } else {
                    $_SESSION['create_dep_msg'] = "username or password incorrect";
                    $_error_msg = "username or password incorrect";
                    $_SESSION['error_msg'] = $_error_msg;
                    header("Location: ../View/login.php");
                    exit;
                }
            // } else {
            //     echo "Login failed";
            // }
        }

        function logout(){
            session_destroy();

            header('Location: ../View/login.php');
            exit;
        }

        function newAddUser($username1, $email1, $password1, $user_type1, $status1, $registration_number1, $phone_number1){
            $isValid = true;        
            $userExist = null;

            $username_error_msg1 = "";
            $password_error_msg1 = "";
            $email_error_msg = "";
            $user_type_error_msg = "";
            $status_error_msg = "";
            $registration_number_error_msg = "";
            $phone_number_error_msg = "";
            
            $username = sanitize($username1);
            $email = sanitize($email1);
            $password = sanitize($password1);
            $user_type = sanitize($user_type1);
            $status = sanitize($status1);
            $registration_number = sanitize($registration_number1);
            $phone_number = sanitize($phone_number1);        
            date_default_timezone_set('Asia/Dhaka');
            $created_at = date("Y-m-d H:i:sa");
            $updated_at = "";

            if (empty($username)){
                $username_error_msg1 = "Username required!";
                $_SESSION['username_error_msg1'] = $username_error_msg1;
                $isValid = false;
            }
            else{
                $_SESSION['username_error_msg1'] = "";
            }

            if (empty($email)){
                $email_error_msg = "Email required!";
                $_SESSION['email_error_msg'] = $email_error_msg;
                $isValid = false;
            }
            else{
                $_SESSION['email_error_msg'] = "";
            }        

            if (empty($password)){
                $password_error_msg1 = "Password required!";
                $_SESSION['password_error_msg1'] = $password_error_msg1;
                $isValid = false;
            }
            else{
                $_SESSION['password_error_msg1'] = "";
            }        

            if (empty($user_type)){
                $user_type_error_msg = "User type required!";
                $_SESSION['user_type_error_msg'] = $user_type_error_msg;
                $isValid = false;
            }
            else{
                $_SESSION['user_type_error_msg'] = "";
            }        

            if (empty($status)){
                $status_error_msg = "Status required!";
                $_SESSION['status_error_msg'] = $status_error_msg;
                $isValid = false;
            }
            else{
                $_SESSION['status_error_msg'] = "";
            }
                

            if (empty($registration_number)){
                $registration_number_error_msg = "Registration number required!";
                $_SESSION['registration_number_error_msg'] = $registration_number_error_msg;
                $isValid = false;
            }
            else{
                $_SESSION['registration_number_error_msg'] = "";
            }        

            if (empty($phone_number)){
                $phone_number_error_msg = "Phone number required!";
                $_SESSION['phone_number_error_msg'] = $phone_number_error_msg;
                $isValid = false;
            }
            else{
                $_SESSION['phone_number_error_msg'] = "";
            }

            if ($isValid === true){          
                $userExist = UserExistOrNot($username, $registration_number);
                if (empty($userExist)) {
                    addUser($username, $email, $password, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at);
                    $_SESSION['create_dep_msg'] = " User added successfully";
                    header("Location: ../View/dashboardView.php");
                    exit;
                } else {
                    $_SESSION['create_dep_msg'] = " Username and registration number already exist";
                    header("Location: ../View/User/create.php");
                    exit;
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up all the field first";
                header("Location: ../View/User/create.php");
                exit;
            }
            
        }
        function update($user_id1, $email1, $password1, $status1, $phone_number1) {
            $user_id = sanitize($user_id1,);
            $email = sanitize($email1);
            $password = sanitize($password1);
            $status = sanitize($status1);
            $phone_number = sanitize($phone_number1);        
            date_default_timezone_set('Asia/Dhaka');
            $updated_at = date("Y-m-d H:i:sa");

            if (!empty($email) && !empty($password) && !empty($status) && !empty($phone_number)) {
                    updateUser($user_id, $email, $password, $status, $phone_number, $updated_at);
                    $_SESSION['create_dep_msg'] = "Edited Successfully";
                    header ('Location: ../View/User/Index.php');
                    exit;
            } else {
                $_SESSION['create_dep_msg'] = "Fill up all the field first";
                header("Location: ../View/User/edit.php");
                exit;         
            }
        }
        function back_TO_dashboard(){
            if (isset($_SESSION['username_error_msg1']) &&  isset($_SESSION['email_error_msg']) && isset($_SESSION['password_error_msg1']) && isset($_SESSION['user_type_error_msg']) &&  isset($_SESSION['status_error_msg']) && isset($_SESSION['registration_number_error_msg']) &&  isset($_SESSION['phone_number_error_msg'])) {
                
                unset($_SESSION['username_error_msg1']);
                unset($_SESSION['email_error_msg']);
                unset($_SESSION['password_error_msg1']);
                unset($_SESSION['user_type_error_msg']);
                unset($_SESSION['status_error_msg']);
                unset($_SESSION['registration_number_error_msg']);
                unset($_SESSION['phone_number_error_msg']);

                header ('Location: ../View/dashboardView.php');
                exit;
            } else {            
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        function edit_Call(){
            header ('Location: ../View/User/edit.php');
            exit(0);
        }
        function delete($uID) {
            $uID = sanitize($uID);

            $result = remove($uID);

            if ($result > 0){
                $_SESSION['create_dep_msg'] = "Deleted Successfully";
                header('Location: ../View/User/Index.php');
                exit;
            }else{
                $_SESSION['create_dep_msg'] = "Deleted failed";
                header('Location: ../View/User/Index.php');
                exit;
            }
        }
        // function starusChange($user_id) {
            // if (!isset($_SESSION['status_change'])) {
            //     $_SESSION['status_change'] = self::INACTIVE;
            // }

            
        // }
    }
 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $obj = new UserController();
        if (isset($_POST["createUser"])) {
            $obj->newAddUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['user_type'], $_POST['status'], $_POST['registration_number'], $_POST['phone_number']);
        }
        // if (isset($_POST['viewAll'])) {
        //     showUser();
        // }
        if (isset($_POST['edit_Call'])){
            $_SESSION['user_id'] = $_POST['id'];
            $obj->edit_Call($_POST['id']);
        }
        if (isset($_POST['confirmUpdate'])) {
            $obj->update($_POST['user_id'], $_POST['email'], $_POST['password'], $_POST['status'], $_POST['phone_number']);
        }
        if (isset($_POST['delete'])){
            $obj->delete($_POST['id']);
        }
        if (isset($_POST['back_dashboard'])) {
            $obj->back_TO_dashboard();
        }
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            // echo $username . " " . $password;
            $obj->login($username, $password);
        }
        if (isset($_POST['logout'])) {
            $obj->logout();
        }
        if (isset($_POST['toggle_status'])) {
            //$status = INACTIVE; 


            $status_change = ($_POST['status_change'] == ACTIVE) ? INACTIVE : ACTIVE;
            
            // echo $_POST['status_change'];
            $user_id = $_POST['id'];
            $status_change = $_POST['status_change'];
            
            if ($status_change == ACTIVE) {
                $status = 0;
                statusUpdate($status, $user_id);
                $status_change = INACTIVE;
                $_SESSION['create_dep_msg'] = "User inactivate successfully";
                header('Location: ../View/User/Index.php');
                exit;
            } elseif ($status_change == INACTIVE) {
                $status = 1;
                statusUpdate($status, $user_id);
                $status_change = INACTIVE;
                $_SESSION['create_dep_msg'] = "User activate successfully";
                header('Location: ../View/User/Index.php');
                exit;
            }
        }
    } else{
        echo "File is not working in post";
        exit;
    }

?>