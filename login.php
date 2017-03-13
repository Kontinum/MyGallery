<?php
    require_once "core/init.php";
    require_once "partials/header.php";
    require_once "partials/navigation.php";

    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validation = new Validation();

            $validation = $validation->check($_POST,[
                'username' => 'required|min:5',
                'password' => 'required|min:6'
            ]);
            
            if($validation->passed()){
                $user = new User();

                $remember = (Input::get('remember_me') === 'on') ? true : false;

                if($user->login(Input::get('username',FILTER_SANITIZE_STRING),Input::get('password',FILTER_SANITIZE_STRING),$remember)){
                    Session::flash('success','Login success. You can now upload images');
                    Redirect::to('index.php');
                }else{
                    Session::flash('error','Username or password was incorrect. Please try again');
                }
            }
        }
    }
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
                    <input type="password" id="password" name="password" value="" class="form-control">
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
