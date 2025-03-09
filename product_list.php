<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['User_Id'];
            $_SESSION['user_name'] = $user['Username'];
            
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No account found with this email!";
    }
}
include 'includes/config.php';
include 'includes/header.php';

$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - <?php echo $category ? $category : "Select Category"; ?></title>
    <link rel="stylesheet" href="assets/css/productList.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h3>Categories</h3>
        <ul>
            <li><a href="product_list.php?category=Visiting Cards">Visiting Cards</a></li>
            <li><a href="product_list.php?category=Custom Polo t-shirts">Custom Polo t-shirts</a></li>
            <li><a href="product_list.php?category=Office Shirt">Office Shirt</a></li>
            <li><a href="product_list.php?category=Custom Stamp & Ink">Custom Stamp & Ink</a></li>
            <li><a href="product_list.php?category=Photo Gifts">Photo Gifts</a></li>
            <li><a href="product_list.php?category=Custom Bags">Custom Bags</a></li>
            <li><a href="product_list.php?category=Custom Stationery">Custom Stationery</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <?php
        if ($category) {
            // Convert category name to a slug for the image path
            $categorySlug = strtolower(str_replace(' ', '-', $category));
            $heroImagePath = "assets/images/products-hero-images/$categorySlug/hero.webp";

            echo "<div class='card-head-hero'>
                    <img src='$heroImagePath' alt='$category'>
                  </div>";
            echo "<h2>$category</h2>";

            // Fetch products from the database based on the category
            $query = "SELECT * FROM product WHERE category = '$category'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<section class='cart-cont'>
                        <h3>Shop by shapes</h3>
                        <p>Select from various shapes & sizes.</p>
                        <div class='cart-panel'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $productSlug = strtolower(str_replace(' ', '-', $row['Name']));
                    $productImage = "assets/images/product/$categorySlug/" . $row['image'];
                    echo "<div class='product-card'>
                            <a href='product_detail.php?id=" . $row['Product_Id'] . "'>
                                <img src='$productImage' alt='" . $row['Name'] . "'>
                            </a>
                            <div class='itm'>
                                <p>" . $row['Name'] . "</p>
                            </div>
                            <p id='rare'>100 starting at Rs. " . $row['Price'] . "</p>
                          </div>";
                }
                echo "</div></section>";
            } else {
                echo "<p>No products found in this category.</p>";
            }
        } else {
            echo "<h2>Please select a category.</h2>";
        }
        ?>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
