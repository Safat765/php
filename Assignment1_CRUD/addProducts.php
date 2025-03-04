<?php
    include 'curd.php';

    class AddProducts extends curd{
        public function handleFormSubmission(){
            if(isset($_POST['submit'])){
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){   
                    $name = $_POST['name'];
                    $details = $_POST['details'];
                    $price = $_POST['price'];
                    parent::creatNew($name, $details, $price);
                }
            } else {
                echo "Form not submited";
            }
        }
    }
    $addNewProduct = new AddProducts();

    $addNewProduct->handleFormSubmission(); 
    
?>