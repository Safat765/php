<?php
    // session_start();
    include 'dbConnect.php';
    $GLOBALS['con'] = dbConnection('officedb');

    class Curd{
        public function creatNew($name, $details, $price){
            $sql = "INSERT INTO `products`(`name`, `details`, `price`, `createdAt`, `updatedAt`) 
                VALUES ('$name','$details','$price',NOW(), NULL)";
            if(mysqli_query($GLOBALS['con'], $sql)){
                header('Location: showData.php');
                exit();
            } else {
                echo "Error ". mysqli_error($GLOBALS['con']);
            } 

            mysqli_close($GLOBALS['con']);
        }
        public function update($name, $details, $price, $pID){
            $updateSql = "UPDATE `products` SET `name`='$name',
                                        `details`='$details',
                                        `price`='$price',
                                        `updatedAt`=NOW()
                                        WHERE `id` = $pID";

            if (mysqli_query($GLOBALS['con'], $updateSql)) {
                header('Location: showData.php');
            }else {
                echo "Error updating user: " . mysqli_error($GLOBALS['con']);
            }

            mysqli_close($GLOBALS['con']);
        }
        public function delete($pID){
            $sql = "DELETE FROM `products` WHERE id = $pID";

            if (mysqli_query($GLOBALS['con'], $sql)){
                header('Location: showData.php');
            }else{
                echo "Product not found";
                exit;
            }
        }
        public function UpdateProductInformation($pID){

            $sql = "SELECT * FROM `products` WHERE id = $pID";
            $result = mysqli_query($GLOBALS['con'], $sql);

            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);

                $_SESSION['id'] = $row['id'];            
                $_SESSION['name'] = $row['name'];
                $_SESSION['details'] = $row['details'];
                $_SESSION['price'] = $row['price'];
                $_SESSION['createdAt'] = $row['createdAt'];
                $_SESSION['updatedAt'] = $row['updatedAt'];
            }else{
                echo "Product not found";
                exit;
            }   
        }
    }
    
    

?>