<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }    
    require '../Model/model.php';
    include '../Controller/dataCleningController.php';
    include '../Controller/User/userController.php.php';
    
    // $userName = sanitize($_POST['userName']);
    // $email = sanitize($_POST['email']);
    // $password = sanitize($_POST['password']);
    // $userType = sanitize($_POST['userType']);
    // $status = sanitize($_POST['status']);
    // $registrationNumber = sanitize($_POST['registrationNumber']);
    // $phoneNumber = sanitize($_POST['phoneNumber']);

    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        $isValid = true;        
        $userExist = null;

        $userNameErrMsg = "";
        $passwordErrMsg = "";
        $emailErrMsg = "";
        $passwordErrMsg = "";
        $userTypeErrMsg = "";
        $statusErrMsg = "";
        $registrationNumberErrMsg = "";
        $phoneNumberErrMsg = "";
        $errMsg = "";
        
        $userName = sanitize($_POST['userName']);
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);
        $userType = sanitize($_POST['userType']);
        $status = sanitize($_POST['status']);
        $registrationNumber = sanitize($_POST['registrationNumber']);
        $phoneNumber = sanitize($_POST['phoneNumber']);
        date_default_timezone_set('Asia/Dhaka');
        $Created_At = date("Y-m-d H:i:sa");
        $Updated_At = "";

        if (empty($userName)){
            $userNameErrMsg = "Username required!";
            $_SESSION['userNameErrMsg'] = $userNameErrMsg;
            $isValid = false;
        }
        else{
            $_SESSION['userNameErrMsg'] = "";
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
            $passwordErrMsg = "Password required!";
            $_SESSION['passwordErrMsg'] = $passwordErrMsg;
            $isValid = false;
        }
        else{
            $_SESSION['passwordErrMsg'] = "";
        }        

        if (empty($userType)){
            $userTypeErrMsg = "User type required!";
            $_SESSION['userTypeErrMsg'] = $userTypeErrMsg;
            $isValid = false;
        }
        else{
            $_SESSION['userTypeErrMsg'] = "";
        }        

        if (empty($status)){
            $passwordErrMsg = "Status required!";
            $_SESSION['statusErrMsg'] = $statusErrMsg;
            $isValid = false;
        }
        else{
            $_SESSION['statusErrMsg'] = "";
        }        

        if (empty($registrationNumber)){
            $passwordErrMsg = "Registration number required!";
            $_SESSION['registrationNumberErrMsg'] = $registrationNumberErrMsg;
            $isValid = false;
        }
        else{
            $_SESSION['registrationNumberErrMsg'] = "";
        }        

        if (empty($phoneNumber)){
            $passwordErrMsg = "Phone number required!";
            $_SESSION['phoneNumberErrMsg'] = $phoneNumberErrMsg;
            $isValid = false;
        }
        else{
            $_SESSION['phoneNumberErrMsg'] = "";
        }

        if (isset($_POST["add"])){
            if ($isValid === true){          
                $userExist = checkUserExistOrNot($userName, $registrationNumber);
                if (empty($userExist)) {
                    addNewUser($userName, $password, $email, $userType, $status, $registrationNumber, $phoneNumber, $Created_At, $Updated_At);
                    header("Location: ../View/dashboardView.php");
                    exit;
                } else {
                    $errMsg = "Username and registration number already exist";
                    $_SESSION['errMsg'] = $errMsg;
                    header("Location: ../View/addNewUserView.php");
                    exit;
                }
            } else {
                header("Location: ../View/addNewUserView.php");
                exit;
            }
        } else {
            echo "User adding failed";
        }
    } else{
        echo "File is not working in post on add user";
        exit;
    }


    


?>