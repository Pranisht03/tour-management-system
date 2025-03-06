<?php
include 'index.php';
include 'db_connection.php';

// session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$userEmail = $_SESSION['email'];

$sql = "SELECT b.BookingId, p.name AS PackageName, b.FromDate, b.ToDate, b.status 
        FROM tblbooking b
        JOIN tour_packages p ON b.PackageId = p.id
        WHERE b.UserEmail = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail); 
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container mt-5">
        <h2>My Bookings</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Package Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['BookingId']; ?></td>
                        <td><?php echo $row['PackageName']; ?></td>
                        <td><?php echo $row['FromDate']; ?></td>
                        <td><?php echo $row['ToDate']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <?php if ($row['status'] != 'cancelled'): ?>
                                <a href="cancel_booking.php?id=<?php echo $row['BookingId']; ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <?php else: ?>
                                <span class="text-danger">Cancelled</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

