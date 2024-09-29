<?php
// Database connection
include '../Database/connection.php';

// Fetch upcoming movies (those with release dates in the future)
$upcoming_movies = $conn->query("SELECT * FROM upcoming_movies WHERE release_date > CURDATE() ORDER BY release_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Main Content -->
    <div class="container-fluid py-5">
        <h2 class="text-center mb-5">Upcoming Movies</h2>

        <div class="row">
            <?php while($row = $upcoming_movies->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="movie-card">
                    <!-- Assuming your images are stored in the 'uploads' folder -->
                    <img src="<?= $row['image'] ?>" alt="Movie Image" class="img-fluid">

                    <div class="movie-details">
                        <h3 class="movie-title"><?= $row['title'] ?></h3>
                        <p><strong>Release Date:</strong> <?= $row['release_date'] ?></p>
                        <!-- Additional Details -->
                        <a href="movie_details.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
