<?php
// Database connection
include '../Database/connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the movie ID from the URL and form inputs
    $movie_id = $_POST['movie_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Insert the booking data into the database
    $stmt = $conn->prepare("INSERT INTO bookings (movie_id, name, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isss', $movie_id, $name, $email, $phone);

    if ($stmt->execute()) {
        // Success message
        echo "<script>alert('Booking successful!'); window.location.href='index.php';</script>";
    } else {
        // Error message
        echo "<script>alert('Booking failed, please try again.'); window.location.href='book_movie.php?id=$movie_id';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // Fetch movie details using the ID from the URL
    if (isset($_GET['id'])) {
        $movie_id = $_GET['id'];
        $result = $conn->query("SELECT * FROM movies WHERE id = $movie_id");
        $movie = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-5">Book Movie: <?= $movie['title'] ?></h2>
        
        <!-- Booking Form -->
        <form action="book_movie.php" method="POST">
            <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <button type="submit" class="btn btn-success">Confirm Booking</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
