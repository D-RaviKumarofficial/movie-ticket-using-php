<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel Example</title>
    <!-- Latest Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1EMhpJbHGAtCoq6" crossorigin="anonymous">
</head>
<body>
    <?php include "Header.php"; ?>
    
    <div class="gallery-area section-padding30">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <!-- First slide -->
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../assets/kaithi.webp" alt="First slide" style="object-fit: cover; height: 90vh;">
                </div>
                <!-- Second slide -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="../assets/kaithi.webp" alt="Second slide" style="object-fit: cover; height: 90vh;">
                </div>
                <!-- Third slide -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="../assets/kaithi.webp" alt="Third slide" style="object-fit: cover; height: 90vh;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Latest Bootstrap 5.3 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-7Qo6ZvG08JjyMG9GEhZCwmQ8FyfovgmDje0+YdyJbXtM3UKpCT2HYHy7IjfCYOxE" crossorigin="anonymous"></script>
</body>
</html>
