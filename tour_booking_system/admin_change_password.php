<?php
include 'admin_panel.php'; 
include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Fetch the current plain-text password from the database
    $stmt = $conn->prepare("SELECT password FROM admin LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $storedPassword = $row['password']; 

        if ($currentPassword === $storedPassword) { 
            if ($newPassword === $confirmPassword) {

                $updateStmt = $conn->prepare("UPDATE admin SET password = ?");
                $updateStmt->bind_param("s", $newPassword);

                if ($updateStmt->execute()) {
                    echo "<script>
                            alert('Password successfully updated!');
                            setTimeout(function() {
                                window.location.href = 'dashboard.php';
                            }, 1000);
                          </script>";
                } else {
                    echo "<script>alert('Error updating password. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('New passwords do not match.');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.');</script>";
        }
    } else {
        echo "<script>alert('Admin record not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-content {
            margin-left: 250px;
            margin-top: 100px;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
        }

        .password-form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="main-content">
    <div class="password-form-container">
        <h2 class="text-center">Change Password</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Change Password</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
