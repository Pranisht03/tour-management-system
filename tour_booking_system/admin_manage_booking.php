<?php
    include 'admin_panel.php';
    include 'db_connection.php';

?>

<?php

// Fetch all bookings
$query = "SELECT b.BookingId, b.PackageId, b.UserEmail, b.FromDate, b.ToDate, b.Comment, b.status, p.name AS PackageName
          FROM tblbooking b
          JOIN tour_packages p ON b.PackageId = p.id
          ORDER BY b.BookingId DESC";
          

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .custom-margin {
          margin-left: 270px; 
        }
</style>
</head>
<body>
    <div class="container mt-5 pt-5 custom-margin">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Package</th>
                    <th>User Email</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['BookingId']; ?></td> 
                        <td><?php echo htmlspecialchars($row['PackageName']); ?></td>
                        <td><?php echo htmlspecialchars($row['UserEmail']); ?></td>
                        <td><?php echo htmlspecialchars($row['FromDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['ToDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['Comment']); ?></td>
                        <td>
                            <?php
                                if ($row['status'] == "confirmed") {
                                    echo '<span class="badge bg-success">Confirmed</span>';
                                } else if ($row['status'] == "cancelled") {
                                    echo '<span class="badge bg-danger">Cancelled</span>';
                                } else {
                                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 0): ?>
                                <form action="confirm_booking.php" method="POST">
                                    <input type="hidden" name="booking_id" value="<?php echo $row['BookingId']; ?>">
                                    <button type="submit" name="confirm_booking" class="btn btn-success btn-sm">Confirm</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Confirmed</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

