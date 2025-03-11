<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Model/userModel.php';
    require '../../Data/cleanData.php';

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

        header('Location: ../View/loginView.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        
        if (isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            // echo $username . " " . $password;
            login($username, $password);
        }
        if (isset($_POST['logout'])){
            logout();
        }
    }
    else {
        echo "Post not working";
    }


?>