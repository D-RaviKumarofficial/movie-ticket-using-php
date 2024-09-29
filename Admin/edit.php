<?php
// Database connection
include 'Sidebar.php';
include '../Database/connection.php';

// Fetch movie details based on movie ID passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
    
    if (!$movie) {
        echo "<script>alert('Movie not found!'); window.location.href = 'ManageMovies.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('No movie ID provided!'); window.location.href = 'ManageMovies.php';</script>";
    exit;
}

// Update movie details when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_movie'])) {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $producer = $_POST['producer'];
    $music_director = $_POST['music_director'];
    $hero = $_POST['hero'];
    $heroine = $_POST['heroine'];
    $theatre = $_POST['theatre'];
    $time = $_POST['time'];

    // Check if a new image has been uploaded
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    } else {
        // Keep the old image if no new one is uploaded
        $image = $movie['image'];
    }

    // Update movie details in the database
    $stmt = $conn->prepare("UPDATE movies SET image = ?, title = ?, director = ?, producer = ?, music_director = ?, hero = ?, heroine = ?, theatre = ?, time = ? WHERE id = ?");
    $stmt->bind_param("sssssssssi", $image, $title, $director, $producer, $music_director, $hero, $heroine, $theatre, $time, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Movie updated successfully!'); window.location.href = 'AddMovies.php';</script>";
    } else {
        echo "<script>alert('Failed to update movie');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: row;
            height: 100vh;
        }
        .sidebar {
            flex: 0 0 250px; /* Set width of sidebar */
            background-color: #f8f9fa; /* Background color */
            padding: 15px; /* Padding for sidebar */
            overflow-y: auto; /* Allow scrolling */
        }
        .content {
            flex: 1; /* Allow content to take remaining space */
            padding: 20px; /* Padding for content */
            overflow-y: auto; /* Allow scrolling */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <?php include 'Sidebar.php'; ?>
    </div>
    <div class="content">
        <div class="container mt-5">
            <h2 class="text-center">Edit Movie</h2>

            <!-- Edit Movie Form -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Movie Title</label>
                        <input type="text" class="form-control" name="title" value="<?= $movie['title'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="director" class="form-label">Director</label>
                        <input type="text" class="form-control" name="director" value="<?= $movie['director'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="producer" class="form-label">Producer</label>
                        <input type="text" class="form-control" name="producer" value="<?= $movie['producer'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="music_director" class="form-label">Music Director</label>
                        <input type="text" class="form-control" name="music_director" value="<?= $movie['music_director'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hero" class="form-label">Hero</label>
                        <input type="text" class="form-control" name="hero" value="<?= $movie['hero'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="heroine" class="form-label">Heroine</label>
                        <input type="text" class="form-control" name="heroine" value="<?= $movie['heroine'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="theatre" class="form-label">Theatre</label>
                        <input type="text" class="form-control" name="theatre" value="<?= $movie['theatre'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" name="time" value="<?= $movie['time'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Movie Image</label>
                        <input type="file" class="form-control" name="image">
                        <p>Current Image: <img src="<?= $movie['image'] ?>" alt="Movie Image" width="100"></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="update_movie">Update Movie</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
