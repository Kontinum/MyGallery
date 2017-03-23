<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';
?>

<?php
    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validation = new Validation();

            $validation = $validation->check($_POST,[
                'username' => 'required|min:5|max:20|unique:users',
                'name' => 'required|min:5|max:50'
            ]);

            if($validation->passed()){
                $user = new User();

                if($user->update([
                    'username' => Input::getPost('username',FILTER_SANITIZE_STRING),
                    'name' => Input::get('name',FILTER_SANITIZE_STRING),
                ])){
                    Session::flash('success','Profile successfully updated');
                    Redirect::to('index.php');
                }else{
                    Session::flash('error','There was an error updating profile');
                }
            }
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="wrapper col-lg-8 col-lg-offset-2">
            <?php require_once "partials/info-box.php"; ?>
            <p>Change username or name:</p>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= escape($user->userData()->username) ?>" placeholder="5 - 20 characters">
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= escape($user->userData()->name) ?>" placeholder="5 - 50 characters ">
                </div>

                <input type="hidden" name="token" value="<?= Token::generate() ?>">

                <div class="form-group">
                    <input type="submit" class="btn btn-primary pull-right" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require_once "partials/footer.php";
?>
