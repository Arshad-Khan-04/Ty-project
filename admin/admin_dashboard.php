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
<h1>Welcome to Admin Dashboard</h1>

<?php
include '../includes/config.php';

$users = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];
$orders = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM orders"))[0];
$products = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM product"))[0];

echo "<div class='dashboard'>
        <div class='card'><h3>Users</h3><p>$users</p></div>
        <div class='card'><h3>Orders</h3><p>$orders</p></div>
        <div class='card'><h3>Products</h3><p>$products</p></div>
      </div>";
?>

</div>
</body>
</html>
