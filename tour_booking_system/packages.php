<?php
include 'db_connection.php';
include 'index.php';

// Fetch packages
$result = $conn->query("SELECT * FROM tour_packages");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages</title>
    <link rel="stylesheet" href="css/packages.css">
</head>
<body>
    <h1 class="title">Package List</h1>
    <div class="package-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="package-card">
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Package Image" class="package-img">
                <div class="package-details">
                    <h2>Package Name: <span><?php echo htmlspecialchars($row['name']); ?></span></h2>
                    <p><strong>Package Type:</strong> <?php echo htmlspecialchars($row['type']); ?></p>
                    <p><strong>Package Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                    <p><strong>Features:</strong> <?php echo htmlspecialchars($row['features']); ?></p>
                </div>
                <div class="package-price">
                    <h3>NPR <?php echo htmlspecialchars($row['price']); ?></h3>
                    <a href="package_details.php?id=<?php echo $row['id']; ?>" class="details-btn">View Details</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php 
    include 'includes/footer.php';
?>
