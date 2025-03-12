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
<h2>Manage Orders</h2>

<?php
include '../includes/config.php';

$result = mysqli_query($conn, "SELECT * FROM orders");
echo "<table>
        <tr><th>Order ID</th><th>User ID</th><th>Status</th><th>Amount</th><th>Action</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['Order_Id']}</td>
            <td>{$row['User_Id']}</td>
            <td>{$row['Order_Status']}</td>
            <td>{$row['Order_Amount']}</td>
            <td>
                <a href='edit_order.php?id={$row['Order_Id']}'>Update Status</a>
            </td>
         </tr>";
}
echo "</table>";
?>
</div>
</body>
</html>
