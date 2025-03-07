<?php 
    include 'index.php';
    include 'db_connection.php'; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    
    <section class="hero">
        <div>
            <h2>Explore Beautiful Destinations</h2>
            <p>Plan your trip with ease</p>
            <a href="packages.php" class="btn btn-warning">View Packages</a>
        </div>
    </section>
    
    <!-- Tour Packages Section -->
    <section id="packages" class="container my-5">
        <h2 class="text-center mb-4 fw-bold">Popular Tour Packages</h2>
        <div class="row g-4">
            <?php
            // Fetch tour packages
            $sql = "SELECT name, features, price, image_path FROM tour_packages";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card tour-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                            <div class="card-body p-4">
                                <h4 class="card-title"><?php echo $row['name']; ?></h4>
                                <p class="card-text"><?php echo $row['features']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-tag fw-bold">NPR <?php echo number_format($row['price'], 2); ?></span>
                                    <a href="packages.php" class="btn btn-primary rounded-pill px-4">Book Now</a>
                                </div>
                            </div>
                        </div>                   

                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-12 text-center'><p>No tour packages available</p></div>";
            }
            $conn->close();
            ?>
        </div>
    </section>
    
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2>Why Choose Us?</h2>
            <p>We offer the best travel experiences with top-rated services.</p>
        </div>
    </section>
    
    <section class="container my-5">
        <h2 class="text-center">Testimonials</h2>
        <div class="row">
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p>"Amazing service! My trip was unforgettable."</p>
                    <footer class="blockquote-footer">John Doe</footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p>"Best tour company ever! Highly recommend."</p>
                    <footer class="blockquote-footer">Jane Smith</footer>
                </blockquote>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* .hero {
            background: url('images/main.jpg') center/cover no-repeat;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        } */
        .tour-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    
    <section class="hero">
        <div>
            <h2>Explore Beautiful Destinations</h2>
            <p>Plan your trip with ease</p>
            <a href="#packages" class="btn btn-warning">View Packages</a>
        </div>
    </section>
    
    <section id="packages" class="container mt-5">
        <h2 class="text-center mb-4">Popular Tour Packages</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card tour-card">
                    <img src="images/mountain.jpg" class="card-img-top" alt="Tour 1">
                    <div class="card-body">
                        <h5 class="card-title">Mountain Adventure</h5>
                        <p class="card-text">Enjoy breathtaking mountain views.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card tour-card">
                    <img src="images/boudha.jpg" class="card-img-top" alt="Tour 2">
                    <div class="card-body">
                        <h5 class="card-title">City Exploration</h5>
                        <p class="card-text">Relax on the sandy beaches.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card tour-card">
                    <img src="images/mountain2.jpg" class="card-img-top" alt="Tour 3">
                    <div class="card-body">
                        <h5 class="card-title">Everest Exploration</h5>
                        <p class="card-text">Discover vibrant city life.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2>Why Choose Us?</h2>
            <p>We offer the best travel experiences with top-rated services.</p>
        </div>
    </section>
    
    <section class="container my-5">
        <h2 class="text-center">Testimonials</h2>
        <div class="row">
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p>"Amazing service! My trip was unforgettable."</p>
                    <footer class="blockquote-footer">John Doe</footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p>"Best tour company ever! Highly recommend."</p>
                    <footer class="blockquote-footer">Jane Smith</footer>
                </blockquote>
            </div>
        </div>
    </section>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->


<?php 
    include 'includes/footer.php';
?>