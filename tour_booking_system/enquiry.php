<?php
// session_start(); 
include 'db_connection.php';
include 'index.php';
include 'includes/config.php';

if (isset($_POST['submit1'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "You must be logged in to submit an enquiry.";
        header("Location: login.php"); 
        exit();
    }

    $userId = $_SESSION['user_id']; 
    $fname = $_POST['full_name']; 
    $email = $_POST['email'];    
    $mobile = $_POST['mobile'];
    $subject = $_POST['subject'];    
    $description = $_POST['description'];

    if (!preg_match("/^[A-Za-z\s]+$/", $fname)) {
        $_SESSION['error'] = "Full Name should only contain letters and spaces.";
        header("Location: enquiry.php"); 
        exit();
    }

    $sql = "INSERT INTO tblenquiry(UserId, FullName, EmailId, MobileNumber, Subject, Description) 
            VALUES(:userId, :fname, :email, :mobile, :subject, :description)";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':subject', $subject, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->execute();

    if ($dbh->lastInsertId()) {
        $_SESSION['msg'] = "Enquiry successfully submitted.";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white bg-primary text-center">Enquiry Form</div>
                    <div class="card-body">
                        <?php 
                        if (isset($_SESSION['error'])) {
                            echo "<div class='alert alert-danger text-center'>" . htmlentities($_SESSION['error']) . "</div>";
                            unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['msg'])) {
                            echo "<div class='alert alert-success text-center'>" . htmlentities($_SESSION['msg']) . "</div>";
                            unset($_SESSION['msg']);
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" id="full_name" name="full_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile No</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" pattern="\d{10}" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" required></textarea>
                            </div>
                            <button type="submit" name="submit1" class="btn btn-success w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php 
    include 'includes/footer.php';
?>




