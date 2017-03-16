<?php
require_once "core/init.php";

if(Input::exists('get')){
    $username = Input::get('username',FILTER_SANITIZE_STRING);
    $user = new User();

    if(!$user->isLoggedIn()){
        Redirect::to('index.php');
    }else{
        $sessionName = Config::get('session/session_name');
        $sessionId = Session::get($sessionName);
        $user = new User($username);

        if(!$user->dataExists() || !$user->ownsProfile($sessionId,$username)){
            Redirect::to(404);
        }
    }
}
require_once 'partials/header.php';
require_once 'partials/navigation.php';
?>

    <div class="container">
        <div class="row">
            <div class="wrapper">
                <?php
                    $image = new Image();
                    $userImages = $image->allImages($sessionId);
                ?>
                <?php if($userImages->count() == 0) : ?>
                    <p>You don't have any images. Go to <a href="upload.php">Upload page</a> and upload them</p>
                    <?php else: ?>
                    <p>Your images: <em><?= $userImages->count() ?></em></p>
                    <div class="images col-lg-12">
                        <?php foreach ($userImages->results() as $image) : ?>
                            <div class="col-lg-3">
                                <a href="">
                                    <div class="image">
                                        <img class="img-responsive" src="storage/8/<?= $image->save_name ?>" alt="">
                                        <div class="image-description">
                                            <a class="image-link" href=""><?= $image->name?></a>
                                            <p class="image-type pull-right">
                                                <i class="fa fa-picture-o navbar-icons" aria-hidden="true"></i> <?= $image->extension ?>
                                            </p>
                                            <p class="image-date">
                                                <i class="fa fa-calendar navbar-icons" aria-hidden="true"></i> 12.06.2010
                                            </p>
                                            <p class="image-size"><i class="fa fa-file-image-o navbar-icons" aria-hidden="true"></i> <?= $image->size/100000 ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php
    require_once "partials/footer.php";
?>
