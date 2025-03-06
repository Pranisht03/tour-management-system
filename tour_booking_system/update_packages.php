<?php
include 'db_connection.php';


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $features = mysqli_real_escape_string($conn, $_POST['features']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        // Get the old image path before updating
        $query = "SELECT image_path FROM tour_packages WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $old_image = $row['image_path'];

        // Delete the old image if exists
        if (file_exists($old_image)) {
            unlink($old_image);
        }

        // Upload new image
        $image_name = time() . "_" . basename($_FILES['image']['name']); 
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            // Update with new image
            $sql = "UPDATE tour_packages SET name=?, type=?, location=?, features=?, price=?, image_path=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssssi", $name, $type, $location, $features, $price, $image_path, $id);
        } else {
            echo "<script>alert('Error uploading image.');</script>";
            exit;
        }
    } else {
        // Update without changing the image
        $sql = "UPDATE tour_packages SET name=?, type=?, location=?, features=?, price=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $type, $location, $features, $price, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Package updated successfully!'); window.location.href='manage_package.php?id=$id';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>





