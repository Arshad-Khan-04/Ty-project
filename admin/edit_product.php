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
    $result = mysqli_query($conn, "SELECT * FROM product WHERE Product_Id='$id'");
    $product = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    mysqli_query($conn, "UPDATE product SET Name='$name', Price='$price', Discount='$discount', Category='$category', Description='$description' WHERE Product_Id='$id'");
    header("Location: manage_products.php");
}
?>

<h2>Edit Product</h2>
<form method="POST">
    <input type="text" name="name" value="<?= $product['Name'] ?>" required><br>
    <input type="number" name="price" value="<?= $product['Price'] ?>" required><br>
    <input type="number" step="0.01" name="discount" value="<?= $product['Discount'] ?>" required><br>
    <!-- <input type="text" name="category" value="<?= $product['Category'] ?>" required><br> -->
    <select name="category" required>
        <option value="Visiting Cards" <?= ($row['Category'] == 'Visiting Cards') ? 'selected' : ''; ?>>Visiting Cards</option>
        <option value="Custom Polo t-shirts" <?= ($row['Category'] == 'Custom Polo t-shirts') ? 'selected' : ''; ?>>Custom Polo t-shirts</option>
        <option value="Office Shirt" <?= ($row['Category'] == 'Office Shirt') ? 'selected' : ''; ?>>Office Shirt</option>
        <option value="Custom Stamp & Ink" <?= ($row['Category'] == 'Custom Stamp & Ink') ? 'selected' : ''; ?>>Custom Stamp & Ink</option>
        <option value="Photo Gifts" <?= ($row['Category'] == 'Photo Gifts') ? 'selected' : ''; ?>>Photo Gifts</option>
        <option value="Custom Bags" <?= ($row['Category'] == 'Custom Bags') ? 'selected' : ''; ?>>Custom Bags</option>
        <option value="Custom Stationery" <?= ($row['Category'] == 'Custom Stationery') ? 'selected' : ''; ?>>Custom Stationery</option>
    </select><br>
    <textarea name="description"><?= $product['Description'] ?></textarea><br>
    <button type="submit" name="update">Update</button>
</form>
</div>
</body>
</html>
