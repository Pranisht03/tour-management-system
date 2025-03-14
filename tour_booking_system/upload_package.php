<?php
include 'db_connection.php';
include 'admin_panel.php';

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $features = $_POST['features'];
    $price = $_POST['price'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $target = 'images/' . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO tour_packages (name, type, location, features, price, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $name, $type, $location, $features, $price, $target);
    $stmt->execute();

    $message = "Package Uploaded Successfully!"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="margin-left: 300px;">
    <div class="package-create border p-4 rounded shadow-sm bg-light">
        <h2 class="text-center mb-4" style="margin-top: 20px;">Create Package</h2>

        <?php if ($message): ?>
            <div class="alert alert-success mt-3"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Package Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type:</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="features" class="form-label">Features:</label>
                <textarea class="form-control" id="features" name="features" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Upload Package</button>
        </form>
    </div>
</div>

</body>
</html>
