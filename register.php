<?php
    require_once "core/init.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';
?>

<div class="container">
    <div class="row">
        <div class="wrapper col-lg-8 col-lg-offset-2">
            <?php require_once "partials/info-box.php"; ?>
            <p>Please fill out all fields to register</p>
            <form class="form" action="" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="password_again">Password again:</label>
                    <input type="text" id="password_again" name="password_again" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" value="">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary pull-right" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>





<?php
    require_once "partials/footer.php";
?>
