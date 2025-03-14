<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Management System</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-left">
            <a href="admin_login.php"><span>Admin Login</span></a>
        </div>
        <div class="top-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Welcome, <?php echo $_SESSION['email']; ?> |</span>
                <a href="user_logout.php">Logout</a>
            <?php else: ?>
                <a href="includes/signup.php">Sign Up</a> /
                <a href="includes/signin.php">Sign In</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Header Section -->
    <header>
        <h1><span>Tour</span> Management System</h1>
        <div class="secure">
        <i class="fa-solid fa-lock"></i> SAFE & SECURE
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="packages.php">Tour Packages</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="enquiry.php">Enquiry</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="my_bookings.php">My Bookings</a></li>
                <li><a href="user_profile.php">User Profile</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Banner Section -->
    <section class="banner">
    <style>
        /* Custom CSS for the slider */
        .carousel-item img {
            width: 100%;
            height: 350px;
        }
    </style>
</head>
<body>

    <!-- Image Slider -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/main.jpg" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="images/nature.jpg" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="images/mountain2.jpg" class="d-block w-100" alt="Image 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

    </section>
</body>
</html>
