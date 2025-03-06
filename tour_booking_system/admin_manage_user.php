<?php
// Database connection
include 'admin_panel.php';
include 'db_connection.php';

// Fetch data from tblusers table
$sql = "SELECT id, FullName, MobileNumber, EmailId, RegDate, UpdationDate FROM tblusers";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        table {
            width: 80%;
            margin-top: 120px;
            margin-left: 150px
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">User Details</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Mobile Number</th>
                <th>Email ID</th>
                <th>Registration Date</th>
                <th>Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['FullName']; ?></td>
                        <td><?php echo $row['MobileNumber']; ?></td>
                        <td><?php echo $row['EmailId']; ?></td>
                        <td><?php echo $row['RegDate']; ?></td>
                        <td><?php echo $row['UpdationDate']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>
</body>
</html>
