<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   
    require '../Model/userModel.php';
    require '../../Data/cleanData.php';

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
            $usernameErrMsg1 = "username required!";
            $_SESSION['usernameErrMsg1'] = $usernameErrMsg1;
            $isValid = false;
        }
        else{
            $_SESSION['usernameErrMsg1'] = NULL;
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
                if ($status == "inactive") {
                    $status = 0;
                } else {
                    $status = 1;
                }
                addUser($username, $email, $password, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at);
                header("Location: ../View/dashboardView.php");
                exit;
            } else {
                $errMsg = "username and registration number already exist";
                $_SESSION['errMsg'] = $errMsg;
                header("Location: ../View/User/userCreate.php");
                exit;
            }
        } else {
            $errMsg = "Something is empty";
            $_SESSION['errMsg'] = $errMsg;
            header("Location: ../View/User/userCreate.php");
            exit;
        }
        
    }

    function showUser(){
        $result = showAll();

        require '../View/User/userIndex.php';
    }

    function showUpdateUserDetails($id){
        $id = sanitize($id);
        $result = showUpdateUserDate($id);

        if ($result && $result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['u_id'] = $row['user_id'];
                $_SESSION['u_username'] = $row['username'];
                $_SESSION['u_email'] = $row['email'];
                $_SESSION['u_password'] = $row['password'];
                $_SESSION['u_user_type'] = $row['user_type'];
                $_SESSION['u_status'] = $row['status'];
                $_SESSION['u_registration_number'] = $row['registration_number'];
                $_SESSION['u_phone_number'] = $row['phone_number'];
            }
        }        
        header("Location: ../View/User/userEdit.php");
    }
    function update($user_id1, $username1, $email1, $password1, $status1, $registration_number1, $phone_number1) {
        $user_id = sanitize($user_id1,);
        $username = sanitize($username1);
        $email = sanitize($email1);
        $password = sanitize($password1);
        $status = sanitize($status1);
        $registration_number1 = sanitize($registration_number1);
        $phone_number = sanitize($phone_number1);        
        date_default_timezone_set('Asia/Dhaka');
        $updated_at = date("Y-m-d H:i:sa");

        if (!empty($email) && !empty($password) && !empty($status) && !empty($phone_number)) {
            $existOrNot = UserExistOrNot($username1, $registration_number1);
            if (empty($existOrNot)) {
                updateUser($user_id, $username, $email, $password, $status, $phone_number, $updated_at);
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {
                $errMsg = "Username esist. Change the username";
                $_SESSION['errMsg'] = $errMsg;
                header("Location: ../View/User/userEdit.php");
                exit; 
            }
        } else {
            $errMsg = "Fill up all the field first";
            $_SESSION['errMsg'] = $errMsg;
            header("Location: ../View/User/userEdit.php");
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


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["addUser"])) {
            newAddUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['user_type'], $_POST['status'], $_POST['registration_number'], $_POST['phone_number']);
        }
        if (isset($_POST['viewAll'])) {
            showUser();
        }
        if (isset($_POST['edit'])){
            $uID = $_POST['id'];
            showUpdateUserDetails($uID);
        }
        if (isset($_POST['confirmUpdate'])) {
            update($_POST['user_id'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['status'], $_POST['registration_number'], $_POST['phone_number']);
        }
        if (isset($_POST['delete'])){
            $uID = $_POST['id'];
            remove($uID);
        }
        if (isset($_POST['back_dashboard'])) {
            back_TO_dashboard();
        }
    } else{
        echo "File is not working in post";
        exit;
    }






?>