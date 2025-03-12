<?php
include '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM product WHERE Product_Id='$id'");
}

header("Location: manage_products.php");
exit();
?>
