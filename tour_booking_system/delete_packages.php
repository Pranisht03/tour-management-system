<?php
include 'db_connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Get package ID to delete

    // Step 1: Check for active bookings (pending/confirmed)
    $checkQuery = "SELECT COUNT(*) as active_count FROM tblbooking WHERE PackageId = ? AND status IN ('pending', 'confirmed')";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['active_count'] > 0) {
        echo "Cannot delete package. There are active bookings.";
    } else {
        // Step 2: Delete all related canceled bookings first
        $deleteBookings = "DELETE FROM tblbooking WHERE PackageId = ?";
        $stmt = $conn->prepare($deleteBookings);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Step 3: Now delete the package
        $deletePackage = "DELETE FROM tour_packages WHERE id = ?";
        $stmt = $conn->prepare($deletePackage);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Package deleted successfully!";
        } else {
            echo "Error deleting package: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
