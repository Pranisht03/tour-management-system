<?php
    include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .about-section {
            background-color: #f9f9f9;
            padding: 60px 0;
        }
        .about-title {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .about-content {
            font-size: 18px;
            line-height: 1.8;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
        }
        .about-image {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }
        .container {
            max-width: 1140px;
        }
        .about-row {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .about-row img {
            margin-left: 20px;
        }
    </style>
</head>
<body>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row about-row">
                <div class="col-lg-6">
                    <h2 class="about-title">About Us</h2>
                    <p class="about-content">
                        Welcome to our Tour Management System, where we bring the best travel experiences right at your fingertips. Our mission is to make it easier for you to explore the world and create memories with loved ones. We provide a seamless way to browse and book tour packages with detailed itineraries, booking options, and budget planning. Whether you’re traveling solo, with family, or in a group, our platform is designed to provide an unforgettable travel experience.
                    </p>
                    <p class="about-content">
                        Our team is dedicated to curating the most exciting tours and ensuring a hassle-free journey from start to finish. Explore new destinations, create your itinerary, and manage your bookings all in one place. Join us and start your next adventure today!
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="images/boudha.jpg" alt="Tour Management Image" class="about-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>


<?php 
    include 'includes/footer.php';
?>