<?php
    require_once "core/init.php";
    require_once "partials/header.php";
    require_once "partials/navigation.php";
?>

<div class="container">
    <div class="row">
        <div class="wrapper col-lg-8 col-lg-offset-2">
            <?php require_once "partials/info-box.php"; ?>
            <p>Please fill out all fields to login</p>
            <form action="" method="post" class="form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?= escape(Input::get('username'))?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" value="" class="form-control">
                </div>

                <div class="form-group">
                    <label for="remember_me">
                        <input type="checkbox" id="remember_me" name="remember_me">Remember me
                    </label>
                </div>

                <input type="hidden" name="token" value="<?= Token::generate() ?>">

                <div class="form-group">
                    <input type="submit" value="Login" class="btn btn-primary pull-right">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    require_once "partials/footer.php";
?>
