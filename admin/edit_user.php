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
<?php
include 'admin_header.php';
include '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE User_id='$id'");
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    mysqli_query($conn, "UPDATE users SET Username='$username', Email='$email', Role='$role' WHERE User_id='$id'");
    header("Location: manage_users.php");
}
?>

<h2>Edit User</h2>
<form method="POST">
    <input type="text" name="username" value="<?= $user['Username'] ?>" required><br>
    <input type="email" name="email" value="<?= $user['Email'] ?>" required><br>
    <select name="role">
        <option value="admin" <?= $user['Role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="customer" <?= $user['Role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
    </select><br>
    <button type="submit" name="update">Update</button>
</form>
</div>
</body>
</html>
