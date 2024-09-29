<?php
// Database connection
include 'Sidebar.php';
include '../Database/connection.php';

// Add a movie to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $producer = $_POST['producer'];
    $music_director = $_POST['music_director'];
    $hero = $_POST['hero'];
    $heroine = $_POST['heroine'];
    $theatre = $_POST['theatre'];
    $time = $_POST['time'];

    // Image upload
    $target_dir = "uploads/";
    $image = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $image);

    // Insert movie into database
    $stmt = $conn->prepare("INSERT INTO movies (image, title, director, producer, music_director, hero, heroine, theatre, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $image, $title, $director, $producer, $music_director, $hero, $heroine, $theatre, $time);
    
    if ($stmt->execute()) {
        echo "<script>alert('Movie added successfully!');</script>";
    } else {
        echo "<script>alert('Failed to add movie');</script>";
    }
}

// Delete movie
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Movie deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete movie');</script>";
    }
}

// Fetch all movies for display
$movies = $conn->query("SELECT * FROM movies");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-fluid {
            margin-left: 250px;
        }
        @media (max-width: 768px) {
            .container-fluid {
                margin-left: 0;
            }
        }
        .table img {
            width: 60px;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="container-fluid p-5">
        <h2 class="text-center">Manage Movies</h2>

        <!-- Add Movie Form -->
        <form action="" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Movie Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="director" class="form-label">Director</label>
                    <input type="text" class="form-control" name="director" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="producer" class="form-label">Producer</label>
                    <input type="text" class="form-control" name="producer" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="music_director" class="form-label">Music Director</label>
                    <input type="text" class="form-control" name="music_director" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="hero" class="form-label">Hero</label>
                    <input type="text" class="form-control" name="hero" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="heroine" class="form-label">Heroine</label>
                    <input type="text" class="form-control" name="heroine" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="theatre" class="form-label">Theatre</label>
                    <input type="text" class="form-control" name="theatre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input type="time" class="form-control" name="time" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Movie Image</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="add_movie">Add Movie</button>
        </form>

        <!-- Display Movie Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Director</th>
                    <th>Producer</th>
                    <th>Music Director</th>
                    <th>Hero</th>
                    <th>Heroine</th>
                    <th>Theatre</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $movies->fetch_assoc()): ?>
                <tr>
                    <td><img src="<?= $row['image'] ?>" alt="Movie Image" width="50"></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['director'] ?></td>
                    <td><?= $row['producer'] ?></td>
                    <td><?= $row['music_director'] ?></td>
                    <td><?= $row['hero'] ?></td>
                    <td><?= $row['heroine'] ?></td>
                    <td><?= $row['theatre'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
