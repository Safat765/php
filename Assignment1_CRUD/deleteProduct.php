<?php
    include 'curd.php';
    session_start();

    class DeleteProduct extends curd{
        public function newDeleteProduct(){            
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_SESSION['id'] = $_POST['id'];
                $pID = $_SESSION['id'];
                parent::delete($pID);
            }
            else {
                echo "Product ID not specified!";
                exit;
            }
        }
    }

    $deleteObj = new DeleteProduct();

    $deleteObj->newDeleteProduct();

    
?>