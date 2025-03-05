<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Model/model.php';
    include '../Controller/dataCleningController.php';

    $userName = sanitize($_POST['userName']);
    $password = sanitize($_POST['password']);
    
    $_SESSION['userName'] = $userName;
    $_SESSION['password'] = $password;

    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        $isValid = true;
        $userNameErrMsg = "";
        $passwordErrMsg = "";
        $errMsg = "";
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        if (empty($userName)) {
            $userNameErrMsg = "Username required!";
            $_SESSION['userNameErrMsg'] = $userNameErrMsg;
            $isValid = false;
        } else {
            $userName = sanitize($userName);
            $_SESSION['userName'] = $userName;
        }
        if (empty($password)) {
            $passwordErrMsg = "Password required!";
            $_SESSION['passwordErrMsg'] = $passwordErrMsg;
            $isValid = false;
        } else {
            $password = sanitize($_POST['password']);
            $_SESSION['password'] = $password;
        }

        if (isset($_POST["submit"])) {
            if ($isValid === true){
                if (loginCondition($userName, $password)) {
                    header("Location: ../View/dashboardView.php");
                } else {
                    $errMsg = "Username or password incorrect";
                    $_SESSION['errMsg'] = $errMsg;
                    header("Location: ../View/loginView.php");
                    exit;
                }
            } else {
                header("Location: ../View/loginView.php");
                exit;
            }
        } else {
            echo "Login failed";
        }


    } else{
        echo "File is not working in post";
        exit;
    }
?>