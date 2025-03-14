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

        /* Custom checkbox style */
        .custom-checkbox {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 30px;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .custom-checkbox span {
            width: 30px;
            height: 30px;
            border: 2px solid #007bff;
            background-color: white;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .custom-checkbox input[type="checkbox"]:checked + span {
            background-color: #007bff;
            border-color: #0056b3;
        }

        .custom-checkbox input[type="checkbox"]:checked + span::before {
            content: '✔';
            position: absolute;
            top: 4px;
            left: 4px;
            color: white;
            font-size: 18px;
        }

        /* Hover effect */
        .custom-checkbox:hover span {
            border-color: #0056b3;
        }
    </style>
    <script>
        // Function to handle checkbox click, making it disabled after click
        function handleStatusClick(checkbox) {
            checkbox.disabled = true;
        }
    </script>
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
                        <td>" . htmlspecialchars($row["PostingDate"]) . "</td>";

                // Display the status as a custom checkbox
                $statusChecked = $row["Status"] == 1 ? "checked" : "";
                echo "<td>
                        <label class='custom-checkbox'>
                            <input type='checkbox' $statusChecked onclick='handleStatusClick(this)' />
                            <span></span>
                        </label>
                      </td>
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
