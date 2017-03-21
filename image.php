<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';

    if(Input::exists('get')){
        $imageId = Input::get('image');

        if(!$user->ownsImage($sessionId,$imageId)){
            Redirect::to(404);
        }

        $image = new Image();
        $image = $image->imageByID($imageId);
    }
?>

<div class="container">
    <div class="row">
        <div class="wrapper">
            <div class="col-lg-8 col-lg-offset-2">
                <p>Image: <em class="single-image-name"><?= escape($image->first()->name) ?></em>
                    <i style="cursor: pointer" class="fa fa-pencil-square-o image-edit-icon navbar-icons" aria-hidden="true"></i>
                </p>

                <div class="image-edit-name">
                    <form action="" method="post">
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input type="text" name="image-name" value="<?= escape($image->first()->name) ?>" class="form-control" required>
                        </div>
                        <input type="hidden" name="token" value="<?= Token::generate() ?>">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

                <div class="text-center">
                    <img class="img-responsive single-image" src="storage/<?=escape($user->userData()->id)?>/<?= escape($image->first()->save_name) ?>" alt="">
                    <div class="single-image-links">
                        <a href="download.php?username=<?= escape($user->userData()->username) ?>&image=<?= escape($imageId) ?>">
                           <button class="btn btn-sm btn-success">
                               <i class="fa fa-download" aria-hidden="true"></i>   Download
                           </button>
                        </a>
                        &nbsp;
                        <a href="deleteImage.php?username=<?= escape($user->userData()->username) ?>&image=<?= escape($imageId) ?>">
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>   Delete
                            </button>
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
