<?php
  session_start();
  if (!isset($_SESSION['admin'])) {
      header("Location: admin_login.php");
      exit();
  }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="css/stylesheet" href="admin_panel.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="sidebar">
  <h2> <i class="fas fa-bars menu-toggle menu"></i> </h2>
    <ul>
      <li><a href="dashboard.php"> <i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="upload_package.php"><i class="fas fa-box"></i> Create Packages</a></li>
      <li><a href="manage_package.php"><i class="fas fa-users"></i> Manage Packages</a></li>
      <li><a href="admin_manage_user.php"><i class="fas fa-envelope"></i> Manage Users</a></li>
      <li><a href="admin_manage_booking.php"><i class="fas fa-envelope"></i> Manage Booking</a></li>
      <li><a href="admin_manage_enquiries.php"><i class="fas fa-envelope"></i> Manage Enquiries</a></li>
      <li><a href="admin_change_password.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>


  <div class="content">
    <h1>Tourism Management System</h1>
    <span>Welcome Administrator</span>
  </div> 


</body>
</html>



