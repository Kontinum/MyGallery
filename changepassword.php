<?php
    require_once "core/init.php";
    require_once "partials/header.php";
    require_once "partials/navigation.php";
?>
<div class="container">
    <div class="row">
        <div class="wrapper col-lg-8 col-lg-offset-2">
            <?php require_once "partials/info-box.php"; ?>
            <p>Please fill out all fields to change password</p>
            <form class="form" action="" method="post">
                <div class="form-group">
                    <label for="old_password">Old password:</label>
                    <input type="password" id="old_password" name="old_password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="new_password">New password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Minimum 6 characters">
                </div>

                <div class="form-group">
                    <label for="new_password_again">New password again:</label>
                    <input type="password" id="new_password_again" name="new_password_again" class="form-control" placeholder="Repeat new password">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Change password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require_once "partials/footer.php";
?>
