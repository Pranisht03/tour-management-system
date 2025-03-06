<!-- signup.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Sign Up</h2>
        <form action="signup.php" method="POST" class="mt-4" onsubmit="return validateSignupForm()">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <div class="mb-3">
                <label for="mobileNumber" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" pattern="^[0-9]{10}$" required>
            </div>
            <div class="mb-3">
                <label for="emailId" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailId" name="emailId" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                <small class="form-text text-muted">Password must be at least 8 characters long, contain one uppercase letter, one lowercase letter, and one number.</small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            <a href="../home.php">Back To Home</a>

        </form>
    </div>

    <script>
        function validateSignupForm() {
            const fullName = document.getElementById('fullName').value;
            const nameRegex = /^[A-Za-z ]+$/;

            if (!nameRegex.test(fullName)) {
                alert('Full Name must only contain letters and spaces.');
                return false;
            }

            return true;
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project_db"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $fullName = $_POST['fullName'];
        $mobileNumber = $_POST['mobileNumber'];
        $emailId = $_POST['emailId'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO tblusers (FullName, MobileNumber, EmailId, Password) VALUES ('$fullName', '$mobileNumber', '$emailId', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Registration successful!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>
</body>
</html>

