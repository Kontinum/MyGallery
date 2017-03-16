<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';
?>
    <div class="container">
        <div class="row">
            <div class="wrapper">
                <h1><?= escape($user->userData()->username)  ?></h1>
                <p>Name: <em><?= escape($user->userData()->name) ?></em></p>
                <p>Joined: <em><?= escape($user->userData()->joined) ?></em></p>
            </div>
        </div>
    </div>
<?php
    require_once "partials/footer.php";
?>
