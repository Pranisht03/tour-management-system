<!-- signin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Sign In</h2>
        <form action="signin.php" method="POST" class="mt-4" onsubmit="return validateSigninForm()">
            <div class="mb-3">
                <label for="emailId" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailId" name="emailId" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign In</button>
            <a href="../home.php">Back To Home</a>
        </form>
    </div>

    <script>
        function validateSigninForm() {
            const emailId = document.getElementById('emailId').value;
            const password = document.getElementById('password').value;

            if (!emailId || !password) {
                alert('Both fields are required.');
                return false;
            }

            return true;
        }
    </script>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $emailId = $_POST['emailId'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, Password FROM tblusers WHERE EmailId = ?");
    $stmt->bind_param("s", $emailId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['Password'])) {
            // Store user details in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $emailId;

            // Redirect to the dashboard
            header("Location: ../home.php");
            exit();
        } else {
            echo "<div class='alert alert-danger mt-3'>Invalid password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger mt-3'>No account found with this email.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

  
</body>
</html>



