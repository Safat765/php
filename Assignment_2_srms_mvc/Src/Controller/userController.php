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
            $usernameErrMsg = "";
            $passwordErrMsg = "";
            $errMsg = "";
            $username = sanitize($username1);
            $password = sanitize($password1);
                
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            // echo $_SESSION['username'] . " " . $_SESSION['password'];
        
            if (empty($username)) {
                $usernameErrMsg = "username required!";
                $_SESSION['usernameErrMsg'] = $usernameErrMsg;
                $isValid = false;
            } else {
                $_SESSION['username'] = $username;
            }
            if (empty($password)) {
                $passwordErrMsg = "Password required!";
                $_SESSION['passwordErrMsg'] = $passwordErrMsg;
                $isValid = false;
            } else {
                $_SESSION['password'] = $password;
            }
        
            // if (isset($_POST["login"])) {
                if ($isValid === true){
                    if (loginModel($username, $password)) {
                        header("Location: ../View/dashboardView.php");
                    } else {
                        $errMsg = "username or password incorrect";
                        $_SESSION['errMsg'] = $errMsg;
                        header("Location: ../View/loginView.php");
                        exit;
                    }
                } else {
                    header("Location: ../View/loginView.php");
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

            $usernameErrMsg1 = "";
            $passwordErrMsg1 = "";
            $emailErrMsg = "";
            $passwordErrMsg = "";
            $user_typeErrMsg = "";
            $statusErrMsg = "";
            $registration_numberErrMsg = "";
            $phone_numberErrMsg = "";
            $errMsg = "";
            $errMsg1 = "";
            
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
                $usernameErrMsg1 = "Username required!";
                $_SESSION['usernameErrMsg1'] = $usernameErrMsg1;
                $isValid = false;
            }
            else{
                $_SESSION['usernameErrMsg1'] = "";
            }

            if (empty($email)){
                $emailErrMsg = "Email required!";
                $_SESSION['emailErrMsg'] = $emailErrMsg;
                $isValid = false;
            }
            else{
                $_SESSION['emailErrMsg'] = "";
            }        

            if (empty($password)){
                $passwordErrMsg1 = "Password required!";
                $_SESSION['passwordErrMsg1'] = $passwordErrMsg1;
                $isValid = false;
            }
            else{
                $_SESSION['passwordErrMsg1'] = "";
            }        

            if (empty($user_type)){
                $user_typeErrMsg = "User type required!";
                $_SESSION['user_typeErrMsg'] = $user_typeErrMsg;
                $isValid = false;
            }
            else{
                $_SESSION['user_typeErrMsg'] = "";
            }        

            if (empty($status)){
                $statusErrMsg = "Status required!";
                $_SESSION['statusErrMsg'] = $statusErrMsg;
                $isValid = false;
            }
            else{
                $_SESSION['statusErrMsg'] = "";
            }
                

            if (empty($registration_number)){
                $registration_numberErrMsg = "Registration number required!";
                $_SESSION['registration_numberErrMsg'] = $registration_numberErrMsg;
                $isValid = false;
            }
            else{
                $_SESSION['registration_numberErrMsg'] = "";
            }        

            if (empty($phone_number)){
                $phone_numberErrMsg = "Phone number required!";
                $_SESSION['phone_numberErrMsg'] = $phone_numberErrMsg;
                $isValid = false;
            }
            else{
                $_SESSION['phone_numberErrMsg'] = "";
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
            if (isset($_SESSION['usernameErrMsg1']) &&  isset($_SESSION['emailErrMsg']) && isset($_SESSION['passwordErrMsg1']) && isset($_SESSION['user_typeErrMsg']) &&  isset($_SESSION['statusErrMsg']) && isset($_SESSION['registration_numberErrMsg']) &&  isset($_SESSION['phone_numberErrMsg'])) {
                
                unset($_SESSION['usernameErrMsg1']);
                unset($_SESSION['emailErrMsg']);
                unset($_SESSION['passwordErrMsg1']);
                unset($_SESSION['user_typeErrMsg']);
                unset($_SESSION['statusErrMsg']);
                unset($_SESSION['registration_numberErrMsg']);
                unset($_SESSION['phone_numberErrMsg']);

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