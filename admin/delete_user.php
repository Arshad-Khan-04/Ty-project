<?php
include '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM users WHERE User_id='$id'");
}

header("Location: manage_users.php");
exit();
?>