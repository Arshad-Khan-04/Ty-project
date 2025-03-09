<?php
session_start();
include 'admin_header.php';
include '../includes/config.php';

// Check if any admin exists in the database
$admin_check_query = "SELECT COUNT(*) AS count FROM users WHERE Role='admin'";
$result = mysqli_query($conn, $admin_check_query);
$admin_count = mysqli_fetch_assoc($result)['count'];

if ($admin_count > 0) {
    // If at least one admin exists, require login
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['role'] !== 'admin') {
        header("Location: admin_login.php"); // Redirect to login page
        exit();
    }
}

if (isset($_POST['register_admin'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $contact = $_POST['contact'];

    // Secure SQL with prepared statements
    $stmt = $conn->prepare("INSERT INTO users (Username, Email, Password, Contact_information, Role) 
                            VALUES (?, ?, ?, ?, 'admin')");
    $stmt->bind_param("ssss", $username, $email, $password, $contact);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Failed to register admin!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Admin Registration</h2>
    
    <?php if (isset($error)) echo "<p class='error text-center'>$error</p>"; ?>
    
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Contact Info</label>
            <input type="text" name="contact" class="form-control" required>
        </div>
        
        <button type="submit" name="register_admin" class="btn btn-primary w-100">Register Admin</button>
    </form>

    <div class="text-center mt-3">
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
