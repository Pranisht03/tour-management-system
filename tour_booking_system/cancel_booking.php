<?php
include 'db_connection.php'; 

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $bookingId = intval($_GET['id']); // Get the booking ID from the URL

    // Update the status to 'cancelled' for the given booking ID
    $query = "UPDATE tblbooking SET status = 'cancelled' WHERE BookingId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        echo "<script>alert('Your booking has been successfully cancelled!'); window.location.href='my_bookings.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error cancelling the booking. Please try again.'); window.location.href='my_bookings.php';</script>";
        exit();
    }
} else {
    // If 'id' is not set in the URL, handle the error
    echo "<script>alert('Booking ID is missing.'); window.location.href='my_bookings.php';</script>";
}
?>
