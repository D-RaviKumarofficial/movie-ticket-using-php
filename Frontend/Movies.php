    <?php
    // Database connection
    include '../Database/connection.php';

    // Fetch all movies from the database
    $movies = $conn->query("SELECT * FROM movies");
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Movies Blog</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .movie-card {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: transform 0.2s ease-in-out;
                margin-bottom: 20px;
                border-radius: 10px;
            }

            .movie-card:hover {
                transform: scale(1.03);
            }

            .movie-card img {
                max-width: 100%;
                height: 300px;
                object-fit: cover;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }

            .movie-details {
                padding: 15px;
            }

            .movie-title {
                font-size: 1.5rem;
                font-weight: bold;
            }

            .movie-info {
                font-size: 0.9rem;
                color: #666;
            }

            .read-more, .book-now {
                display: inline-block;
                margin-top: 10px;
            }

            .container-fluid {
                margin-left: 50px;
                margin-right: 50px;
            }

            @media (max-width: 768px) {
                .container-fluid {
                    margin-left: 0;
                    margin-right: 0;
                }
            }
        </style>
    </head>
    <body>
            <?php
            include 'Header.php';
            ?>
        <!-- Main Content -->
        <div class="container-fluid py-5">
            <h2 class="text-center mb-5">Movie Blog</h2>

            <div class="row">
                <?php while($row = $movies->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="movie-card">
                        <!-- Assuming your images are stored in an 'uploads' folder -->
                        <img src="../Admin/uploads/<?= $row['image'] ?>" alt="Movie Image" class="img-fluid">

                        <div class="movie-details">
                            <h3 class="movie-title"><?= $row['title'] ?></h3>
                            <p class="movie-info"><strong>Director:</strong> <?= $row['director'] ?></p>
                            <p class="movie-info"><strong>Hero:</strong> <?= $row['hero'] ?></p>
                            <p class="movie-info"><strong>Heroine:</strong> <?= $row['heroine'] ?></p>
                            
                            <!-- Truncated details with Read More -->
                            <a href="Movie_details.php?id=<?= $row['id'] ?>" class="read-more btn btn-primary btn-sm">Read More</a>
                            
                            <!-- Book Now Button -->
                            <a href="Book?id=<?= $row['id'] ?>" class="book-now btn btn-success btn-sm">Book Now</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
