<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require '../Model/user.php';
    require '../../Data/cleanData.php';
    const INACTIVE = 0;
    const ACTIVE = 1; 

    class UserController{      

        function login($username1, $password1)
        {
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
            $model = new user();        
            // if (isset($_POST["login"])) {
                if ($isValid === true){
                    $result = $model->loginModel($username, $password);
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();        
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['user_type'] = $row['user_type'];
                        $_SESSION['status'] = $row['status'];
                        $_SESSION['registration_number'] = $row['registration_number'];
                        $_SESSION['phone_number'] = $row['phone_number'];
                        $_SESSION['created_at'] = $row['created_at'];
                        $_SESSION['updated_at'] = $row['updated_at'];
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

        function logout()
        {
            session_destroy();

            header('Location: ../View/login.php');
            exit;
        }

        function newAddUser($username1, $email1, $password1, $user_type1, $registration_number1, $phone_number1)
        {
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
            $status = 1;
            $registration_number = sanitize($registration_number1);
            $phone_number = sanitize($phone_number1);        
            date_default_timezone_set('Asia/Dhaka');
            $created_at = date("Y-m-d H:i:sa");
            $updated_at = "";

            if (empty($username)) {
                $username_error_msg1 = "Username required!";
                $_SESSION['username_error_msg1'] = $username_error_msg1;
                $isValid = false;
            } else {
                $_SESSION['username_error_msg1'] = "";
            }
            if (empty($email)) {
                $email_error_msg = "Email required!";
                $_SESSION['email_error_msg'] = $email_error_msg;
                $isValid = false;
            } else {
                $_SESSION['email_error_msg'] = "";
            }
            if (empty($password)) {
                $password_error_msg1 = "Password required!";
                $_SESSION['password_error_msg1'] = $password_error_msg1;
                $isValid = false;
            } else {
                $_SESSION['password_error_msg1'] = "";
            }
            if (empty($user_type)) {
                $user_type_error_msg = "User type required!";
                $_SESSION['user_type_error_msg'] = $user_type_error_msg;
                $isValid = false;
            } else {
                $_SESSION['user_type_error_msg'] = "";
            }
            if (empty($status)) {
                $status_error_msg = "Status required!";
                $_SESSION['status_error_msg'] = $status_error_msg;
                $isValid = false;
            } else {
                $_SESSION['status_error_msg'] = "";
            }              
            if (empty($registration_number)) {
                $registration_number_error_msg = "Registration number required!";
                $_SESSION['registration_number_error_msg'] = $registration_number_error_msg;
                $isValid = false;
            } else {
                $_SESSION['registration_number_error_msg'] = "";
            }        
            if (empty($phone_number)) {
                $phone_number_error_msg = "Phone number required!";
                $_SESSION['phone_number_error_msg'] = $phone_number_error_msg;
                $isValid = false;
            } else {
                $_SESSION['phone_number_error_msg'] = "";
            }            
            $model = new user();
            if ($isValid === true) {          
                $userExist = $model->UserExistOrNot($username, $registration_number);
                if (empty($userExist)) {
                    $model->addUser($username, $email, $password, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at);
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
        function update($user_id1, $email1, $password1, $phone_number1) 
        {
            $model = new user();
            $user_id = sanitize($user_id1,);
            $email = sanitize($email1);
            $password = sanitize($password1);
            $phone_number = sanitize($phone_number1);        
            date_default_timezone_set('Asia/Dhaka');
            $updated_at = date("Y-m-d H:i:sa");
            $model->updateUser($user_id, $email, $password, $phone_number, $updated_at);
            $_SESSION['create_dep_msg'] = "Edited Successfully";
            $this->showAllUsers();
        }
        function back_TO_dashboard()
        {
            if (isset($_SESSION['username_error_msg1']) &&  isset($_SESSION['email_error_msg']) && isset($_SESSION['password_error_msg1']) && isset($_SESSION['user_type_error_msg']) &&  isset($_SESSION['status_error_msg']) && isset($_SESSION['registration_number_error_msg']) &&  isset($_SESSION['phone_number_error_msg'])) {
                unset($_SESSION['username_error_msg1']);
                unset($_SESSION['email_error_msg']);
                unset($_SESSION['password_error_msg1']);
                unset($_SESSION['user_type_error_msg']);
                unset($_SESSION['status_error_msg']);
                unset($_SESSION['registration_number_error_msg']);
                unset($_SESSION['phone_number_error_msg']);
                unset($_SESSION['create_dep_msg']);
                header ('Location: ../View/dashboardView.php');
                exit;
            } else {
                
                unset($_SESSION['username_error_msg1']);
                unset($_SESSION['email_error_msg']);
                unset($_SESSION['password_error_msg1']);
                unset($_SESSION['user_type_error_msg']);
                unset($_SESSION['status_error_msg']);
                unset($_SESSION['registration_number_error_msg']);
                unset($_SESSION['phone_number_error_msg']);
                unset($_SESSION['create_dep_msg']);
                header ('Location: ../View/dashboardView.php');
                exit;
            }
        }
        function edit_Call($user_id)
        {
            $model = new user();
            $result = $model->showUpdateUserDate($user_id);
            if (mysqli_num_rows($result) > 0) {
                include '../View/User/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
            // header ('Location: ../View/User/edit.php');
            // exit(0);
        }
        function delete($uID) 
        {
            $model = new user();
            $uID = sanitize($uID);
            $result = $model->remove($uID);
            if ($result == true) {
                $_SESSION['create_dep_msg'] = "Deleted Successfully";
                $this->showAllUsers();
            } else {
                $_SESSION['create_dep_msg'] = "Deleted failed";
                $this->showAllUsers();
            }
        }        
        public function showCreatePage() 
        {
            include '../View/User/create.php';
        }
        public function showAllUsers()
        {
            $model = new user();
            $result = $model->showAll();
            if (mysqli_num_rows($result) > 0) {
                include '../View/User/Index.php';
            } else {
                echo "<tr><td colspan='10'>No users found.</td></tr>";
            }
        }
    }    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $obj = new UserController();
        if (isset($_POST['createUser'])) {
            $obj->showCreatePage();
        }
        if (isset($_POST["create"])) {
            $obj->newAddUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['user_type'], $_POST['registration_number'], $_POST['phone_number']);
        }
        // if (isset($_POST['viewAll'])) {
        //     showUser();
        // }
        if (isset($_POST['edit_Call'])) {
            $obj->edit_Call($_POST['user_id']);
        }
        // if (isset($_POST['confirmUpdate'])) {
        //     $obj->update($_POST['user_id'], $_POST['email'], $_POST['password'], $_POST['status'], $_POST['phone_number']);
        // }
        // if (isset($_POST['delete'])) {
        //     $obj->delete($_POST['id']);
        // }
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
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] === "PUT") {
                $obj->update($_POST['user_id'], $_POST['email'], $_POST['password'], $_POST['phone_number']);
            }
            if ($_POST['_method'] === "DELETE") {
                $obj->delete($_POST['user_id']);
            }
        }
        if (isset($_POST['toggle_status'])) {
            $model = new user();
            $status_change = ($_POST['status_change'] == ACTIVE) ? INACTIVE : ACTIVE;
            $user_id = $_POST['user_id'];
            $status_change = $_POST['status_change'];            
            if ($status_change == ACTIVE) {
                $status = 0;
                $model->statusUpdate($status, $user_id);
                $status_change = INACTIVE;
                $_SESSION['create_dep_msg'] = "User inactivate successfully";
                $obj->showAllUsers();
                // header('Location: ../View/User/Index.php');
                // exit;
            } elseif ($status_change == INACTIVE) {
                $model = new user();
                $status = 1;
                $model->statusUpdate($status, $user_id);
                $status_change = INACTIVE;
                $_SESSION['create_dep_msg'] = "User activate successfully";
                $obj->showAllUsers();
                // header('Location: ../View/User/Index.php');
                // exit;
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $obj = new UserController();
        if (isset($_GET['viewAllUser'])) {
            $obj->showAllUsers();
        }
        if (isset($_GET['backToIndexFromEdit'])) {
            $obj->showAllUsers();
        }
    }

?>