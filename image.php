<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';

    if(Input::exists('get')){
        $imageId = Input::get('image');

        $image = new Image();
        $image = $image->imageByID($imageId);
    }
?>

<div class="container">
    <div class="row">
        <div class="wrapper">
            <div class="col-lg-8 col-lg-offset-2">
                <p>Image: <em class="single-image-name"><?= escape($image->first()->name) ?></em></p>
                <div>
                    <img class="img-responsive single-image" src="storage/<?=escape($user->userData()->id)?>/<?= escape($image->first()->save_name) ?>" alt="">
                    <div class="single-image-download">
                        <a href="">
                            <i class="fa fa-download" aria-hidden="true"></i> Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once "partials/footer.php";
?>
