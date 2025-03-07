<?php
include 'db_connection.php'; 
include 'index.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid package ID.";
    exit;
}

$packageId = intval($_GET['id']);
$query = "SELECT * FROM tour_packages WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $packageId);
$stmt->execute();
$result = $stmt->get_result();
$package = $result->fetch_assoc();

if (!$package) {
    echo "Package not found.";
    exit;
}

// Check if user is logged in
$userLoggedIn = isset($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($package['name']); ?> - Details</title>
    <link rel="stylesheet" href="css/package_details.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="details-container">
        <img src="<?php echo htmlspecialchars($package['image_path']); ?>" alt="Package Image" class="details-img">
        <h1><?php echo htmlspecialchars($package['name']); ?></h1>
        <p><strong>Package Type:</strong> <?php echo htmlspecialchars($package['type']); ?></p>
        <p><strong>Package Location:</strong> <?php echo htmlspecialchars($package['location']); ?></p>
        <p><strong>Features:</strong> <?php echo htmlspecialchars($package['features']); ?></p>
        <h3>Price: NPR <?php echo htmlspecialchars($package['price']); ?></h3>

        <!-- Book Now Button -->
        <?php if ($userLoggedIn): ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">
                Book Now
            </button>
        <?php else: ?>
            <a href="includes/signin.php" class="btn btn-warning">Signin to Book</a>
        <?php endif; ?>

        <a href="packages.php" class="btn btn-secondary">Back to Packages</a>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book This Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="booking_handler.php">
                        <input type="hidden" name="package_id" value="<?php echo $package['id']; ?>">
                        <div class="mb-3">
                            <label for="from_date" class="form-label">From Date</label>
                            <input type="date" name="from_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="to_date" class="form-label">To Date</label>
                            <input type="date" name="to_date" class="form-control" required>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                let today = new Date().toISOString().split("T")[0]; // Get today's date in YYYY-MM-DD format
                            
                                let fromDate = document.getElementById("from_date");
                                let toDate = document.getElementById("to_date");
                            
                                // Set min date to today
                                fromDate.min = today;
                            
                                fromDate.addEventListener("change", function () {
                                    toDate.min = fromDate.value; // Set "To Date" minimum value based on "From Date"
                                });
                            });
                            </script>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="submit_booking" class="btn btn-success">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
