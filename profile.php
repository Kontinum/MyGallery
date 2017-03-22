<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';

    $joinedDate = new DateTime($user->userData()->joined);

    $image = new Image();
    $images = $image->allImages($user->userData()->id);
?>
    <div class="container">
        <div class="row">
            <div class="wrapper col-lg-8 col-lg-offset-2">
                <h1><?= escape($user->userData()->username)  ?></h1>
                <p>Name: <em><?= escape($user->userData()->name) ?></em></p>
                <p>Joined: <em><?= escape($joinedDate->format('d-m-Y')) ?></em></p>
                <p>Image number: <em><a href="images.php?username=<?= escape($user->userData()->username) ?>"><?= $images->count() ?></a></em>
                </p>
                <a href="editProfile.php?username=<?= escape($user->userData()->username) ?>">
                    <button class="btn btn-info">Edit information</button>
                </a>
                &nbsp;
                <a href="deleteAccount.php?username=<?= escape($user->userData()->username) ?>">
                    <button class="btn btn-danger">Delete account</button>
                </a>
            </div>
        </div>
    </div>
<?php
    require_once "partials/footer.php";
?>
