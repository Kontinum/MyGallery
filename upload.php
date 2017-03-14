<?php
    require_once "core/init.php";
    $user = new User();

    if(!$user->isLoggedIn()){
        Redirect::to('login.php');
    }
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';
?>
    <div class="container">
        <div class="row">
            <div class="wrapper col-lg-8 col-lg-offset-2 text-center">
                <div class="upload-div">
                    <p>You can upload up to 16MB photo with jpg, png and bmp extensions.</p>
                    <form action="" method="post">
                        <div class="form-group col-lg-8 col-lg-offset-1 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                            <input type="file" name="upload_image" class="form-control">
                        </div>
                        <input type="hidden" name="token" value="<?= Token::generate() ?>">
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary pull-left">Upload image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once "partials/footer.php";
?>
