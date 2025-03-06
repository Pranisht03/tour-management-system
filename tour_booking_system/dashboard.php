<?php
    include 'admin_panel.php';
    include 'db_connection.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }

        .whole-body{
            height: 90%;
            width: 70%;
            margin-top: 100px;
            margin-left: 300px;

        }

        .card {
            color: white;
            text-align: center;
            padding: 20px;
            border: none;
            border-radius: 10px;
        }

        .card .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="whole-body">
    <div class="container mt-5">

        <div class="row text-center">
            <?php
           
            $userCount = $conn->query("SELECT COUNT(*) AS total FROM tblusers")->fetch_assoc()['total'];
            $bookingCount = $conn->query("SELECT COUNT(*) AS total FROM tblbooking")->fetch_assoc()['total'];
            $enquiryCount = $conn->query("SELECT COUNT(*) AS total FROM tblenquiry")->fetch_assoc()['total'];
            $packageCount = $conn->query("SELECT COUNT(*) AS total FROM tour_packages")->fetch_assoc()['total'];

            $conn->close();

            $data = [
                ["Users", $userCount, "bi-person", "#ff5c5c"],
                ["Bookings", $bookingCount, "bi-file-text", "#5bc0de"],
                ["Enquiries", $enquiryCount, "bi-folder", "#5cb85c"],
                ["Total Packages", $packageCount, "bi-briefcase", "#8e44ad"]
            ];

            foreach ($data as $item) {
                echo "<div class='col-md-3 mb-4'>
                        <div class='card' style='background-color: {$item[3]}'>
                            <div class='icon'><i class='bi {$item[2]}'></i></div>
                            <h5>{$item[0]}</h5>
                            <h2>{$item[1]}</h2>
                        </div>
                    </div>";
            }
            ?>
        
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
