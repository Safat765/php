<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Models/user.php';
    require '../Models/profile.php';
    require '../../Data/cleanData.php';

    class UserController
    {    
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
            
            $objUser = new user();   

            if ($isValid === true) {
                $passwordFromDatabase = $objUser->getPassword($username);
                if (password_verify($password, $passwordFromDatabase)) {
                    $result = $objUser->loginModel($username, $passwordFromDatabase);
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
                        header("Location: ../Views/dashboard.php");
                        unset($_SESSION['error_msg']);
                    } else {
                        $_SESSION['create_dep_msg'] = "username or password incorrect";
                        $_error_msg = "username or password incorrect";
                        $_SESSION['error_msg'] = $_error_msg;
                        header("Location: ../Views/login.php");
                        exit;
                    }
                } 

                elseif ($password === $passwordFromDatabase) {
                    $result = $objUser->loginModel($username, $passwordFromDatabase);
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
                        header("Location: ../Views/dashboard.php");
                        unset($_SESSION['error_msg']);
                    } else {
                        $_SESSION['create_dep_msg'] = "username or password incorrect";
                        $_error_msg = "username or password incorrect";
                        $_SESSION['error_msg'] = $_error_msg;
                        header("Location: ../Views/login.php");
                        exit;
                    }
                } else {
                    $_SESSION['create_dep_msg'] = "Password incorrect";
                    $_error_msg = "username or password incorrect";
                    $_SESSION['error_msg'] = $_error_msg;
                    header("Location: ../Views/login.php");
                    exit;
                }
            } else {
                $_SESSION['create_dep_msg'] = "username or password incorrect";
                $_error_msg = "username or password incorrect";
                $_SESSION['error_msg'] = $_error_msg;
                header("Location: ../Views/login.php");
                exit;
            }
        }

        function logout()
        {
            session_destroy();
            header('Location: http://localhost/dashboard/1_Office/srms_mvc/Src/Views/login.php');
            exit;
        }

        function newAddUser($username1, $email1, $password1, $user_type1, $registration_number1, $phone_number1, $firstname1, $middlename1, $lastname1, $department1, $session1)
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
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $user_type = sanitize($user_type1);
            $status = 1;
            $registration_number = sanitize($registration_number1);
            $phone_number = sanitize($phone_number1);        
            date_default_timezone_set('Asia/Dhaka');
            $created_at = date("Y-m-d H:i:sa");
            $updated_at = "";
            $first_name = sanitize($firstname1);
            $middle_name = sanitize($middlename1);
            $last_name = sanitize($lastname1);
            $department = sanitize($department1);
            $session = sanitize($session1);

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

            $objUser = new user();            
            $objProfile = new profileModel();

            if ($isValid === true) {          
                $userExist = $objUser->UserExistOrNot($username, $registration_number);
                if (empty($userExist)) {
                    $objUser->addUser($username, $email, $hashedPassword, $user_type, $status, $registration_number, $phone_number, $created_at, $updated_at);
                    $result = $objUser->getUserID($username);                       
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                        $user_id = $row['user_id'];
                        $userType = $objProfile->checkUserType($user_id);
                        if ($userType == 2 || $userType == 1) {
                            $session = '';
                            $objProfile->creatProfile($first_name, $middle_name, $last_name, $department, $session, $user_id);
                        } else {
                            $objProfile->creatProfile($first_name, $middle_name, $last_name, $department, $session, $user_id);
                        }                        
                        $_SESSION['create_dep_msg'] = " User added successfully";
                        $this->showAllUsers();
                    }
                } else {
                    $_SESSION['create_dep_msg'] = " Username and registration number already exist";
                    $this->showAllUsers();
                }
            } else {
                $_SESSION['create_dep_msg'] = " Fill up all the field first";
                $this->showAllUsers();
            }
        }
        function update($user_id1, $email1, $password1, $phone_number1) 
        {
            $objUser = new user();

            $user_id = sanitize($user_id1,);
            $email = sanitize($email1);
            $password = sanitize($password1);
            $phone_number = sanitize($phone_number1);        
            date_default_timezone_set('Asia/Dhaka');
            $updated_at = date("Y-m-d H:i:sa");

            $objUser->updateUser($user_id, $email, $password, $phone_number, $updated_at);
            $_SESSION['create_dep_msg'] = "Edited Successfully";
            $this->showAllUsers();
        }
        function backToDashboard()
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
                header ('Location: ../Views/dashboard.php');
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
                header ('Location: ../Views/dashboard.php');
                exit;
            }
        }
        function editCall($user_id)
        {
            $objUser = new user();

            $result = $objUser->showUpdateUserDate($user_id);
            if (mysqli_num_rows($result) > 0) {
                include '../Views/User/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
        }
        function delete($uID) 
        {
            $objUser = new user();

            $uID = sanitize($uID);
            $result = $objUser->remove($uID);

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
            $objUser = new profileModel();
            $result = $objUser->showDepList();

            if (mysqli_num_rows($result) > 0) {
                include '../Views/User/create.php';
            }
        }
        public function showAllUsers()
        {
            $objUser = new user();
            $result = $objUser->showAll();

            if (mysqli_num_rows($result) > 0) {
                $ACTIVE = $objUser::ACTIVE;
                $INACTIVE = $objUser::INACTIVE;
                include '../Views/User/Index.php';
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
            $obj->newAddUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['user_type'], $_POST['registration_number'], $_POST['phone_number'],
            $_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['department'], $_POST['session']
            );
        }

        if (isset($_POST['editCall'])) {
            $obj->editCall($_POST['user_id']);
        }

        if (isset($_POST['back_dashboard'])) {
            $obj->backToDashboard();
        }

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
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
            $objUser = new user();
            $status_change = ($_POST['status_change'] == $objUser::ACTIVE) ? $objUser::INACTIVE : $objUser::ACTIVE;
            $user_id = $_POST['user_id'];
            $status_change = $_POST['status_change'];

            if ($status_change == $objUser::ACTIVE) {
                $status = 0;
                $objUser->statusUpdate($status, $user_id);
                $status_change = $objUser::INACTIVE;
                $_SESSION['create_dep_msg'] = "User inactivate successfully";
                $obj->showAllUsers();
            } 
            
            elseif ($status_change == $objUser::INACTIVE) {
                $status = 1;
                $objUser->statusUpdate($status, $user_id);
                $status_change = $objUser::INACTIVE;
                $_SESSION['create_dep_msg'] = "User activate successfully";
                $obj->showAllUsers();
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