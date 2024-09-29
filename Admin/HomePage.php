<?php
// Database connection
include 'Sidebar.php';
include '../Database/connection.php';

// Fetch counts from the database
$stmtMovies = $conn->prepare("SELECT COUNT(*) AS total_movies FROM movies");
$stmtMovies->execute();
$totalMoviesResult = $stmtMovies->get_result();
$totalMovies = $totalMoviesResult->fetch_assoc()['total_movies'];

$stmtUpcoming = $conn->prepare("SELECT COUNT(*) AS upcoming_movies FROM movies WHERE release_date > NOW()");
$stmtUpcoming->execute();
$totalUpcomingResult = $stmtUpcoming->get_result();
$totalUpcoming = $totalUpcomingResult->fetch_assoc()['upcoming_movies'];

$stmtBookings = $conn->prepare("SELECT COUNT(*) AS total_bookings FROM bookings");
$stmtBookings->execute();
$totalBookingsResult = $stmtBookings->get_result();
$totalBookings = $totalBookingsResult->fetch_assoc()['total_bookings'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Dashboard</h2>
        <div class="row">
            <!-- Total Movies Container -->
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Movies
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalMovies ?></h5>
                        <p class="card-text">Total number of movies in the database.</p>
                    </div>
                </div>
            </div>

            <!-- Upcoming Movies Container -->
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-header">
                        Upcoming Movies
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalUpcoming ?></h5>
                        <p class="card-text">Number of upcoming movies to be released.</p>
                    </div>
                </div>
            </div>

            <!-- Total Bookings Container -->
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Bookings
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalBookings ?></h5>
                        <p class="card-text">Total number of bookings made.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
