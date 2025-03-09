<?php
session_start();
include 'includes/config.php';
include 'includes/header.php';

// Ensure a product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Product not found.</p>";
    exit();
}

$product_id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM product WHERE Product_Id = '$product_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<p>Product not found.</p>";
    exit();
}

$product = mysqli_fetch_assoc($result);

// Prepare variables from DB
$name        = $product['Name'];
$price       = $product['Price'];
$description = $product['Description']; // assumed to contain line breaks or list items
$category    = $product['Category'];
// Construct category slug for image path (all lowercase, spaces to hyphens)
$categorySlug = strtolower(str_replace(' ', '-', $category));
$defaultImage = "assets/images/product/$categorySlug/" . $product['image'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?> - Product Details</title>
    <link rel="stylesheet" href="assets/css/productDetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="mens">
        <!-- Left: Product Image and Upload Section -->
        <div class="men">
            <img id="productImage" src="<?php echo $defaultImage; ?>" alt="<?php echo $name; ?>">
            <div class="upload-section">
                <input type="file" id="uploadImage" accept="image/*">
                <button id="removeUpload">Remove Uploaded Image</button>
            </div>
        </div>
        <!-- Right: Product Information -->
        <div class="men-info">
            <h5><?php echo $name; ?></h5>
            <!-- Use nl2br to convert newlines to <br> if description is plain text -->
            <p id="text-a"><?php echo nl2br($description); ?></p>
            
            <button id="btn-1">Upload Your Design <i class="fa-solid fa-upload"></i></button>
            
            <div class="men-list2">
                <ul>
                    <li>Cash on Delivery available</li>
                </ul>
            </div>
            
            <div class="corner">
                <label for="corner">Corners</label><br>
                <select name="corner" class="orders">
                    <option value="">Select..</option>
                    <option value="standard">Standard</option>
                    <option value="rounded">Rounded</option>
                </select>
            </div>
            
            <div class="quantity">
                <label for="quantity">Quantity</label><br>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </div>
            
            <div class="shop">
                <label for="shopping">Papers & Textures</label><br>
                <select name="shop" class="multi">
                    <option value="">Select..</option>
                    <option value="glossy">Glossy</option>
                    <option value="matte">Matte</option>
                    <option value="non-tearable">Non-Tearable</option>
                    <option value="spot uv">Spot UV</option>
                    <option value="raised">Raised Foil Visiting Cards</option>
                    <option value="Premium">Premium Plus Glossy</option>
                </select>
            </div>
            
            <div class="purchase-section">
                <button id="addToCart">Add to Cart</button>
            </div>
        </div>
    </div>
    
    <!-- Overview and Specs Section -->
    <section class="set-2">
        <div class="sert-1">
            <a href="#"><p>Overview</p></a> 
            <p id="o-1">This product is designed to deliver both style and performance. It offers high-quality materials, precision stitching, and a comfortable fit for a professional look.</p> 
        </div>
        <div class="sert-2">
            <a href="#"><p>Specs & Templates</p></a>
            <p id="s-1">Specifications include size dimensions, material details, and care instructions. Templates are available for custom designs and branding.</p>
        </div>
    </section>
    
    <script src="assets/js/productDetail.js"></script>
</body>
</html>
<?php include 'includes/footer.php'; ?>
