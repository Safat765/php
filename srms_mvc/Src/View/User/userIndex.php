<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button><a href="../View/dashboardView.php">Back</a></button>
    <br><br>
    
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>User Type</th>
            <th>Status</th>
            <th>Registration Number</th>
            <th>Phone Number</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        <?php
        if (isset($result) && $result->num_rows > 0):
            while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['password']; ?></td>
                    <td><?php echo $user['user_type']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td><?php echo $user['registration_number']; ?></td>
                    <td><?php echo $user['phone_number']; ?></td>
                    <td><?php echo $user['created_at']; ?></td>
                    <td><?php echo $user['updated_at']; ?></td>
                    <td>
                        <form action="../../Src/Controller/adminController.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit" name="edit">Edit</button>
                        </form>
                        <form action="../../Src/Controller/adminController.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="10">No users found.</td></tr>
        <?php endif; ?>
    </table>
    <a href="../../../Src/Controller/adminController.php"></a>
</body>
</html>