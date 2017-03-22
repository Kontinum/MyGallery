<?php
    require_once "core/init.php";
    $user = new User();
    if(!$user->isLoggedIn()){
        Redirect::to('index.php');
    }
    require_once "partials/header.php";
    require_once "partials/navigation.php";
?>

<?php
    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validation = new Validation();

            $validation = $validation->check($_POST,[
                'old_password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'new_password_again' => 'required|min:6|matches:new_password',
            ]);
            
            if($validation->passed()){
                $old_password = Input::get('old_password',FILTER_SANITIZE_STRING);
                $user = new User();

                if(!Hash::check($old_password,$user->userData()->password)){
                    Session::flash('error','Incorrect old password');
                }else{
                    $new_password = Input::get('new_password',FILTER_SANITIZE_STRING);

                    if($user->update([
                        'password' => Hash::make($new_password),
                    ])){
                        $user->logout();
                        Session::flash('success','Password has been successfully changed');
                        Redirect::to('login.php');

                    }else{
                        Session::flash('error','There was an error changing password. Please try again');
                    }
                }
            }
        }
    }
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

                <input type="hidden" name="token" value="<?= Token::generate() ?>">

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
