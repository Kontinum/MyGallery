<?php
    require_once "core/init.php";
    require_once "partials/header.php";
    require_once "partials/navigation.php";
?>

<section class="home">
    <?php require_once "partials/info-box.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="hero-div">
                <h1 class="hero-text">
                    <span class="hero-logo">MyGallery</span> is your place to upload images
                </h1>
            </div>
        </div>

        <div class="row">
            <p class="hero-paragraph">
                You can upload up to 16MB photo with jpg, png and bmp extension
            </p>
        </div>

        <div class="row">
            <div class="hero-button">
                <a href="upload.php">
                    <button class="btn btn-lg btn-primary">Upload image</button>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once "partials/footer.php" ?>
