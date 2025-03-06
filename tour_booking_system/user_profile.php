<?php
include 'index.php';
include 'db_connection.php'; 
?>

<?php
// session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID

// Fetch user details
$query = "SELECT FullName, MobileNumber, EmailId FROM tblusers WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Update user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        // Hash the new password before saving
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE tblusers SET FullName=?, MobileNumber=?, EmailId=?, Password=? WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssssi", $fullname, $mobile, $email, $hashed_password, $user_id);
    } else {
        $update_query = "UPDATE tblusers SET FullName=?, MobileNumber=?, EmailId=? WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("sssi", $fullname, $mobile, $email, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">User Profile</h2>

    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php } ?>

    <table class="table table-bordered">
        <tr>
            <th>Full Name</th>
            <td><?php echo htmlspecialchars($user['FullName']); ?></td>
        </tr>
        <tr>
            <th>Mobile Number</th>
            <td><?php echo htmlspecialchars($user['MobileNumber']); ?></td>
        </tr>
        <tr>
            <th>Email ID</th>
            <td><?php echo htmlspecialchars($user['EmailId']); ?></td>
        </tr>
    </table>

    <h4 class="mt-4">Edit Profile</h4>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['FullName']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" name="mobile" class="form-control" value="<?php echo htmlspecialchars($user['MobileNumber']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email ID</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['EmailId']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">New Password (Leave blank to keep current password)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
</body>
</html>


<?php
include 'includes/footer.php';
?>