<?php
    include 'admin_panel.php';
    include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .enquiry{
            margin-left: 300px;
            margin-top: 90px;
        }
    </style>
</head>
<body>
    <div class="enquiry">
    <h1>Enquiries</h1>
    <?php
    // SQL query to fetch enquiries
    $sql = "SELECT id, FullName, EmailId, MobileNumber, Subject, Description, PostingDate, Status  FROM tblenquiry";
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        // Start the table
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Posting Date</th>
                    <th>Status</th>
                </tr>";

        // Loop through each row and display the data
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["id"]) . "</td>
                    <td>" . htmlspecialchars($row["FullName"]) . "</td>
                    <td>" . htmlspecialchars($row["EmailId"]) . "</td>
                    <td>" . htmlspecialchars($row["MobileNumber"]) . "</td>
                    <td>" . htmlspecialchars($row["Subject"]) . "</td>
                    <td>" . nl2br(htmlspecialchars($row["Description"])) . "</td>
                    <td>" . htmlspecialchars($row["PostingDate"]) . "</td>
                    <td>" . ($row["Status"] == 1 ? "Active" : "Inactive") . "</td>
                  </tr>";
        }
        // End the table
        echo "</table>";
    } else {
        echo "No enquiries found.";
    }

    // Close the database connection
    $conn->close();
    ?>
    </div>
</body>
</html>
