<?php
    include 'dbConnect.php';
    $con = dbConnection('officedb');

    $sql = "SELECT * FROM `products`";
    $result = $con->query($sql);

    echo "<h2>Product Table</h2>";
    echo '<a href="addNewProduct.php"><button>Add Product</button></a>';
    echo "<br><br>";

    if ($result->num_rows>0){
        echo "<table border = '1'>
            <tr>
                <th>Product ID</th>
                <th>Name </th>
                <th>Details </th>
                <th>Price </th>
                <th>Created At </th>
                <th>Updated At </th>
                <th>Actions</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['details'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>" . $row['createdAt'] . "</td>
                <td>" . $row['updatedAt'] . "</td>
                <td>
                    <a href='UpdateProduct.php?id=".$row['id']."'><button>Update</button></a>
                    <form action='deleteProduct.php' method='post'>
                        <input type = 'hidden' name = 'id' value='" . $row['id'] ."'>
                        <button type='submit' name='update'>Delete</button>
                    </form>
                </td>
            </tr>";
        }
                    
        echo "</table>";
    } else {
        echo "0 result found";
    }

    mysqli_close($con);

?>