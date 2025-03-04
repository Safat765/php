<?php
    session_start();
    include 'dbConnect.php';
    $con = dbConnection('officedb');


    if (isset($_GET['id'])){
        $pID = $_GET['id'];
        
        $sql = "SELECT * FROM `products` WHERE id = $pID";
        $result = mysqli_query($con, $sql);

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

    }else {
        echo "Product ID not specified!";
        exit;
    }
    
    echo "<h2>Update Product : ". $_SESSION['name'] ." </h2>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $details = $_POST['details'];
        $price = $_POST['price'];

        $updateSql = "UPDATE `products` SET `name`='$name',
                                        `details`='$details',
                                        `price`='$price',
                                        `updatedAt`=NOW()
                                        WHERE `id` = $pID";

        if (mysqli_query($con, $updateSql)) {
            header('Location: showData.php');
        }else {
            echo "Error updating user: " . mysqli_error($con);
        }
    }
    
    
    mysqli_close($con);


?>


<!DOCTYPE html>
<html lang="en">
<body>
    
<div>
<form method="post">
        <div>
            <label for="id">Product ID:</label>
            <input type="text" id="id" name="id" value=<?php echo $_SESSION['id'];?> disabled>
        </div>
        <br>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value=<?php echo $_SESSION['name'];?>>
        </div>
        <br>
        <div>
            <label for="details">Details:</label>
            <input type="text" id="details" name="details" value=<?php echo $_SESSION['details'];?>>
        </div>
        <br>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $_SESSION['price'];?>">
        </div>
        <br>
        <div>
            <label for="createdAt">Created At:</label>
            <input type="text" id="createdAt" name="createdAt" value="<?php echo $_SESSION['createdAt'];?>" disabled>
        </div>
        <br>
        <button type="submit">Confirm Update</button>
        <button><a href="showData.php"></a>Cancel</a></button>
    </form>
</div>
</body>
</html>