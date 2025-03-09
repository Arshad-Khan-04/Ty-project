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

if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // **Check if the file was uploaded**
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "../assets/images/products/" . strtolower(str_replace(' ', '-', $category)) . "/"; // Folder path
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if not exists
        }

        $image_name = basename($_FILES["image"]["name"]); // Use original image name
        $target_file = $target_dir . $image_name;

        // Prevent overwriting by appending a timestamp if the file already exists
        if (file_exists($target_file)) {
            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = pathinfo($image_name, PATHINFO_FILENAME) . "_" . time() . "." . $file_extension;
            $target_file = $target_dir . $image_name;
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Save only the image name in the database
            $query = "INSERT INTO product (Name, Price, Discount, Category, Description, image) 
                      VALUES ('$name', '$price', '$discount', '$category', '$description', '$image_name')";
            
            if (mysqli_query($conn, $query)) {
                echo "<p class='success'>Product added successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p class='error'>Failed to upload image!</p>";
        }
    } else {
        echo "<p class='error'>Please select an image to upload.</p>";
    }
}
?>

<h2>Add New Product</h2>
<form method="POST" enctype="multipart/form-data">  <!-- Ensure enctype is included -->
    <input type="text" name="name" placeholder="Product Name" required><br>
    <input type="number" name="price" placeholder="Price" required><br>
    <input type="number" step="0.01" name="discount" placeholder="Discount (Optional)"><br>
    <select name="category" required>
        <option value="">Select a Category</option>
        <option value="Visiting Cards">Visiting Cards</option>
        <option value="Custom Polo t-shirts">Custom Polo t-shirts</option>
        <option value="Office Shirt">Office Shirt</option>
        <option value="Custom Stamp & Ink">Custom Stamp & Ink</option>
        <option value="Photo Gifts">Photo Gifts</option>
        <option value="Custom Bags">Custom Bags</option>
        <option value="Custom Stationery">Custom Stationery</option>
    </select><br>
    <input type="file" name="image" accept="image/*" required><br>
    <textarea name="description" placeholder="Product Description" required></textarea><br>
    <button type="submit" name="add_product">Add Product</button>
</form>
</div>
</body>
</html>
