<?php
include 'db_connection.php';
include 'admin_panel.php';

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Fetch package details
    $sql = "SELECT * FROM tour_packages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $package = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Package</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            background: #ffffff;
            margin-left: 350px;
            margin-top: 90px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: left;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        .package-image {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .package-image img {
            max-width: 150px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        button[name="update"] {
            background-color: #007bff;
            color: white;
        }

        button[name="update"]:hover {
            background-color: #0056b3;
        }

        #deleteBtn {
            background-color: #dc3545;
            color: white;
            margin-top: 10px;
        }

        #deleteBtn:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Update Package</h2>
        <form action="update_packages.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $package['id']; ?>">

            <label>Package Name</label>
            <input type="text" name="name" value="<?php echo $package['name']; ?>" required>

            <label>Package Type</label>
            <input type="text" name="type" value="<?php echo $package['type']; ?>" required>

            <label>Package Location</label>
            <input type="text" name="location" value="<?php echo $package['location']; ?>" required>

            <label>Package Features</label>
            <textarea name="features" required><?php echo $package['features']; ?></textarea>

            <label>Package Price in USD</label>
            <input type="text" name="price" value="<?php echo $package['price']; ?>" required>

            <label>Package Image</label>
            <div class="package-image">
                <img src="<?php echo $package['image_path']; ?>" alt="Package Image">
                <input type="file" name="image">
            </div>

            <button type="submit" name="update">Update</button>
            <button type="button" id="deleteBtn" data-id="<?php echo $package['id']; ?>">Delete</button>

        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
