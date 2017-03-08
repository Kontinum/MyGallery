<?php
    require_once "partials/header.php";
    require_once "partials/navigation.php";
?>

<section class="home">
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
            <form class="upload-form" action="" method="post">
                <input type="file" name="upload_photo" id="upload-photo" class="upload-photo">
                <label for="upload-photo">Upload image</label>
            </form>
        </div>
    </div>
</section>

<?php require_once "partials/footer.php" ?>
