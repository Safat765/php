<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require '../Models/user.php';
    require '../Models/profile.php';
    require '../../Data/cleanData.php';

    class UserController
    {    
        public function login($username1, $password1)
        {
            $isValid = true;
            $username = sanitize($username1);
            $password = sanitize($password1);
        
            if (empty($username)) {
                $_SESSION['username_error_msg'] = "username required!";
                $isValid = false;
            } else {
                $_SESSION['username_error_msg'] = "";
            }

            if (empty($password)) {
                $_SESSION['password_error_msg'] = "Password required!";
                $isValid = false;
            } else {
                $_SESSION['password_error_msg'] = "";
            }
            
            $objUser = new UserModel();   

            if ($isValid === true) {
                $passwordFromDatabase = $objUser->getPassword($username);

                if (password_verify($password, $passwordFromDatabase)) {
                    $result = $objUser->login($username, $passwordFromDatabase);

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
                        $_SESSION['create_dept_msg'] = "username or password incorrect";
                        $_SESSION['error_msg'] = "username or password incorrect";
                        header("Location: ../Views/login.php");
                        exit;
                    }
                } 

                elseif ($password === $passwordFromDatabase) {
                    $result = $objUser->login($username, $passwordFromDatabase);

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
                        $_SESSION['create_dept_msg'] = "username or password incorrect";
                        $_SESSION['error_msg'] = "username or password incorrect";
                        header("Location: ../Views/login.php");
                        exit;
                    }
                } else {
                    $_SESSION['create_dept_msg'] = "Password incorrect";
                    $_SESSION['error_msg'] = "username or password incorrect";
                    header("Location: ../Views/login.php");
                    exit;
                }
            } else {
                $_SESSION['create_dept_msg'] = "username or password incorrect";
                $_SESSION['error_msg'] = "username or password incorrect";
                header("Location: ../Views/login.php");
                exit;
            }
        }

        public function logout()
        {
            session_destroy();
            header('Location: http://localhost/dashboard/1_Office/srms_mvc/Src/Views/login.php');
            exit;
        }

        public function newAddUser($username1, $email1, $password1, $user_type1, $registration_number1, $phone_number1, $firstname1, $middlename1, $lastname1, $department1, $session1)
        {
            $isValid = true;        
            $userExist = null;
            $username = sanitize($username1);
            $email = sanitize($email1);
            $password = sanitize($password1);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userType = sanitize($user_type1);
            $status = 1;
            $registrationNumber = sanitize($registration_number1);
            $phoneNumber = sanitize($phone_number1);
            date_default_timezone_set('Asia/Dhaka');
            $createdAt = date("Y-m-d H:i:sa");
            $updatedAt = "";
            $firstName = sanitize($firstname1);
            $middleName = sanitize($middlename1);
            $lastName = sanitize($lastname1);
            $department = sanitize($department1);
            $session = sanitize($session1);

            if (empty($username)) {
                $_SESSION['username_error_msg1'] = "Username required!";
                $isValid = false;
            } else {
                $_SESSION['username_error_msg1'] = "";
            }

            if (empty($email)) {
                $_SESSION['email_error_msg'] = "Email required!";
                $isValid = false;
            } else {
                $_SESSION['email_error_msg'] = "";
            }

            if (empty($password)) {
                $_SESSION['password_error_msg1'] = "Password required!";
                $isValid = false;
            } else {
                $_SESSION['password_error_msg1'] = "";
            }

            if (empty($userType)) {
                $_SESSION['user_type_error_msg'] = "User type required!";
                $isValid = false;
            } else {
                $_SESSION['user_type_error_msg'] = "";
            }

            if (empty($status)) {
                $_SESSION['status_error_msg'] = "Status required!";
                $isValid = false;
            } else {
                $_SESSION['status_error_msg'] = "";
            }          

            if (empty($registrationNumber)) {
                $_SESSION['registration_number_error_msg'] = "Registration number required!";
                $isValid = false;
            } else {
                $_SESSION['registration_number_error_msg'] = "";
            }        

            if (empty($phoneNumber)) {
                $_SESSION['phone_number_error_msg'] = "Phone number required!";
                $isValid = false;
            } else {
                $_SESSION['phone_number_error_msg'] = "";
            }
            
            if (empty($firstName)) {
                $_SESSION['first_name_error_msg'] = "First name is required";
                $isValid = false;
            } else {
                $_SESSION['first_name_error_msg'] = "";
            }

            if (empty($middleName)) {
                $_SESSION['middle_name_error_msg'] = "Middle name is required";
                $isValid = false;
            } else {
                $_SESSION['middle_name_error_msg'] = "";
            }

            if (empty($lastName)) {
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

            $objUser = new UserModel();            
            $objProfile = new ProfileModel();

            if ($isValid === true) {          
                $userExist = $objUser->UserExistOrNot($username, $registrationNumber);
                
                if (empty($userExist)) {
                    $objUser->addUser($username, $email, $hashedPassword, $userType, $status, $registrationNumber, $phoneNumber, $createdAt, $updatedAt);
                    $result = $objUser->getUserID($username);                       
                    $row = mysqli_fetch_assoc($result);
                    
                    if ($row) {
                        $userID = $row['user_id'];
                        $userType = $objProfile->checkUserType($userID);
                        
                        if ($userType == 2 || $userType == 1) {
                            $session = '';
                            $objProfile->creatProfile($firstName, $middleName, $lastName, $department, $session, $userID);
                        } else {
                            $objProfile->creatProfile($firstName, $middleName, $lastName, $department, $session, $userID);
                        }                        
                        $_SESSION['create_dept_msg'] = " User added successfully";
                        $this->showAll();
                    }
                } else {
                    $_SESSION['create_dept_msg'] = " Username and registration number already exist";
                    $this->showAll();
                }
            } else {
                $_SESSION['create_dept_msg'] = " Fill up all the field first";
                $this->showCreatePage();
            }
        }

        public function update($userId1, $email1, $password1, $phoneNumber1) 
        {
            $objUser = new UserModel();

            $userID = sanitize($userId1,);
            $email = sanitize($email1);
            $password = sanitize($password1);
            $phoneNumber = sanitize($phoneNumber1);        
            date_default_timezone_set('Asia/Dhaka');
            $updatedAT = date("Y-m-d H:i:sa");

            $objUser->update($userID, $email, $password, $phoneNumber, $updatedAT);
            $_SESSION['create_dept_msg'] = "Edited Successfully";
            $this->showAll();
        }

        public function backToDashboard()
        {
            if (isset($_SESSION['username_error_msg1']) &&  isset($_SESSION['email_error_msg']) && isset($_SESSION['password_error_msg1']) && isset($_SESSION['user_type_error_msg']) &&  isset($_SESSION['status_error_msg']) && isset($_SESSION['registration_number_error_msg']) &&  isset($_SESSION['phone_number_error_msg'])) {
                unset($_SESSION['username_error_msg1']);
                unset($_SESSION['email_error_msg']);
                unset($_SESSION['password_error_msg1']);
                unset($_SESSION['user_type_error_msg']);
                unset($_SESSION['status_error_msg']);
                unset($_SESSION['registration_number_error_msg']);
                unset($_SESSION['phone_number_error_msg']);
                unset($_SESSION['create_dept_msg']);
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
                unset($_SESSION['create_dept_msg']);
                header ('Location: ../Views/dashboard.php');
                exit;
            }
        }

        public function editCall($userId)
        {
            $objUser = new UserModel();

            $result = $objUser->showUpdateUserDate($userId);
            
            if (mysqli_num_rows($result) > 0) {
                include '../Views/User/edit.php';
            } else {
                echo "<h3> No id found </h3>";
            }
        }

        public function delete($userId) 
        {
            $objUser = new UserModel();

            $userId = sanitize($userId);
            $result = $objUser->remove($userId);

            if ($result == true) {
                $_SESSION['create_dept_msg'] = "Deleted Successfully";
                $this->showAll();
            } else {
                $_SESSION['create_dept_msg'] = "Deleted failed";
                $this->showAll();
            }
        }   

        public function showCreatePage() 
        {
            $objUser = new ProfileModel();
            $result = $objUser->showDepList();

            $admin = UserModel::USER_TYPE_ADMIN;
            $instructor = UserModel::USER_TYPE_INSTRUCTOR;
            $student = UserModel::USER_TYPE_STUDENT;

            if (mysqli_num_rows($result) > 0) {
                include '../Views/User/create.php';
            }
        }
        
        public function showAll()
        {
            $objUser = new UserModel();
            $result = $objUser->showAll();

            if (mysqli_num_rows($result) > 0) {
                $ACTIVE = UserModel::STATUS_ACTIVE;
                $INACTIVE = UserModel::STATUS_INACTIVE;
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
            $userType = isset($_POST['user_type']) ? $_POST['user_type'] : null;
            $obj->newAddUser($_POST['username'], $_POST['email'], $_POST['password'], $userType, $_POST['registration_number'], $_POST['phone_number'],
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

            $objUser = new UserModel();

            $statusChange = ($_POST['status_change'] == UserModel::STATUS_ACTIVE) ? UserModel::STATUS_INACTIVE : UserModel::STATUS_ACTIVE;
            $user_id = $_POST['user_id'];
            $statusChange = $_POST['status_change'];

            if ($statusChange == UserModel::STATUS_ACTIVE) {
                $status = 0;
                $objUser->update($status, $user_id);
                $statusChange = UserModel::STATUS_INACTIVE;
                $_SESSION['create_dept_msg'] = "User inactivate successfully";
                $obj->showAll();
            } 
            
            elseif ($statusChange == UserModel::STATUS_INACTIVE) {
                $status = 1;
                $objUser->update($status, $user_id);
                $statusChange = UserModel::STATUS_INACTIVE;
                $_SESSION['create_dept_msg'] = "User activate successfully";
                $obj->showAll();
            }
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === "GET") {

        $obj = new UserController();

        if (isset($_GET['viewAllUser'])) {
            $obj->showAll();
        }
        
        if (isset($_GET['backToIndexFromEdit'])) {
            $obj->showAll();
        }
    }
?>