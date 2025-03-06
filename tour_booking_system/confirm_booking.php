<?php
include 'db_connection.php';
session_start();


// Confirm booking
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_booking'])) {
    $bookingId = intval($_POST['booking_id']);

    $query = "UPDATE tblbooking SET status = 'confirmed' WHERE BookingId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        echo "<script>alert('Booking Confirmed!'); window.location.href='admin_bookings.php';</script>";
    } else {
        echo "<script>alert('Failed to confirm booking. Please try again.'); window.location.href='admin_bookings.php';</script>";
    }
}
?>
