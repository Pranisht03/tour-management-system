<?php
    include 'admin_panel.php';
    include 'db_connection.php'
?>

<?php
// Fetch packages from the database
$sql = "SELECT * FROM tour_packages";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table-container {
            margin-top: 100px;
            margin-left: 150px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e74c3c;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .view-btn {
            background-color: #00BCD4;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            text-align: center;
            margin-right: 5px;
        }

        .view-btn:hover {
            background-color: #008C9E;
        }

    </style>
</head>
<body>
    <h1>Tour Packages</h1>

    <div class="table-container">
    <h1>Manage Packages</h1>
    <table>
        <thead>
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Price</th>
                <!-- <th>Creation Date</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>$<?php echo $row['price']; ?></td>
                        <!-- <td><?php echo $row['creation_date']; ?></td> -->
                        <td>
                            <a href="view_packages.php?id=<?php echo $row['id']; ?>" class="view-btn">View Details</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No packages found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
