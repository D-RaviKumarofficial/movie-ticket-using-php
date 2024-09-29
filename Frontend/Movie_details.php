<?php
// Database connection
include '../Database/connection.php';

// Fetch movie details by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $movie = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $movie['title'] ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= $movie['image'] ?>" alt="Movie Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?= $movie['title'] ?></h2>
            <p><strong>Director:</strong> <?= $movie['director'] ?></p>
            <p><strong>Producer:</strong> <?= $movie['producer'] ?></p>
            <p><strong>Music Director:</strong> <?= $movie['music_director'] ?></p>
            <p><strong>Hero:</strong> <?= $movie['hero'] ?></p>
            <p><strong>Heroine:</strong> <?= $movie['heroine'] ?></p>
            <p><strong>Theatre:</strong> <?= $movie['theatre'] ?></p>
            <p><strong>Time:</strong> <?= $movie['time'] ?></p>
            <a href="Book.php?id=<?= $movie['id'] ?>" class="btn btn-success">Book Now</a>
        </div>
    </div>
</div>

</body>
</html>
