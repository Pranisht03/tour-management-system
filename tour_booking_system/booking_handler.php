<?php
include('db_connection.php'); 
session_start();

if (!isset($_SESSION['email'])) {
    echo "<script>alert('You need to log in first!'); window.location.href='login.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_booking'])) {
    $packageId = intval($_POST['package_id']);
    $userEmail = $_SESSION['email']; // Fetching email from session
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];
    $comment = $_POST['comment'];

    // Validate package existence
    $packageCheck = $conn->prepare("SELECT id FROM tour_packages WHERE id = ?");
    $packageCheck->bind_param("i", $packageId);
    $packageCheck->execute();
    $packageResult = $packageCheck->get_result();

    if ($packageResult->num_rows == 0) {
        echo "<script>alert('Invalid package!'); window.location.href='packages.php';</script>";
        exit;
    }

    // Insert booking into database
    $status = "Pending"; // Or any default value like "Confirmed", "Pending", etc.

    $sql = "INSERT INTO tblbooking (PackageId, UserEmail, FromDate, ToDate, Comment, status) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $packageId, $userEmail, $fromDate, $toDate, $comment, $status);

    // $sql = "INSERT INTO tblbooking (PackageId, UserEmail, FromDate, ToDate, Comment, status) VALUES (?, ?, ?, ?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("issss", $packageId, $userEmail, $fromDate, $toDate, $comment);
    
    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='my_bookings.php';</script>";
    } else {
        echo "<script>alert('Booking failed. Please try again.');</script>";
    }
}
?>
