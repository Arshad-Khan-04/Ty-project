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

$result = mysqli_query($conn, "SELECT * FROM product");
?>

<h2>Manage Products</h2>
<a href="add_product.php"><button>Add New Product</button></a>

<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php while ($product = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $product['Product_Id'] ?></td>
        <td><img src="<?= $product['image']; ?>" width="100"></td>
        <td><?= $product['Name'] ?></td>
        <td>$<?= $product['Price'] ?></td>
        <td><?= $product['Discount'] ?>%</td>
        <td><?= $product['Category'] ?></td>
        <td>
            <a href="edit_product.php?id=<?= $product['Product_Id'] ?>">Edit</a> | 
            <a href="delete_product.php?id=<?= $product['Product_Id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

</div>
</body>
</html>

