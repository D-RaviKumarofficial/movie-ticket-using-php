<?php
// Database connection
include 'Sidebar.php';
include '../Database/connection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $release_date = $_POST['release_date'];

    // Handle image upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        
        // Check if the upload directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO upcoming_movies (title, image, release_date) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $image, $release_date);

            if ($stmt->execute()) {
                echo "<script>alert('Movie added successfully!'); window.location.href = 'upcoming_movies.php';</script>";
            } else {
                echo "<script>alert('Failed to add movie');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    } else {
        echo "<script>alert('Please upload an image');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php include 'Sidebar.php'; ?>
            </div>
            <div class="col-md-9">
                <div class="container mt-5">
                    <h2 class="text-center">Add Upcoming Movie</h2>

                    <!-- Add Movie Form -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Movie Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="date" class="form-control" name="release_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Movie Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_movie">Add Movie</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
