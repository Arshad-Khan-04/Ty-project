<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/admin_styles.css">
</head>
<body>
<div class="content">
<?php include 'admin_header.php'; ?>
<h2>Manage Users</h2>

<?php
include '../includes/config.php';

$result = mysqli_query($conn, "SELECT * FROM users");
echo "<table>
        <tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Action</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['User_id']}</td>
            <td>{$row['Username']}</td>
            <td>{$row['Email']}</td>
            <td>{$row['Role']}</td>
            <td>
                <a href='edit_user.php?id={$row['User_id']}'>Edit</a> |
                <a href='delete_user.php?id={$row['User_id']}'>Delete</a>
            </td>
         </tr>";
}
echo "</table>";
?>
</div>
</body>
</html>
