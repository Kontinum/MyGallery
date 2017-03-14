<?php
    require_once "core/init.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';
?>

<?php
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = new Validation();

        $validation = $validation->check($_POST,[
            'username' => 'required|min:5|max:20|unique:users',
            'password' => 'required|min:6',
            'password_again' => 'required|min:6|matches:password',
            'name' => 'required|min:5|max:50',
            'email' => 'required|email'
        ]);

       if($validation->passed()){
           $user = new User();

           $salt = Hash::salt(32);

           if($user->register([
               "username" => Input::get('username',FILTER_SANITIZE_STRING),
               "password" => Hash::make(Input::get('password',FILTER_SANITIZE_STRING),$salt),
               "salt" => $salt,
               "name" => Input::get('name',FILTER_SANITIZE_STRING),
               "email" => Input::get('email',FILTER_SANITIZE_EMAIL),
               'joined' => date('Y-m-d H:i:s')
           ])){
               Session::flash('success','You have been successfully registered');
               Redirect::to('index.php');
           }else{
               Session::flash('error','There was an error. Please try again');
           }
       }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="wrapper col-lg-8 col-lg-offset-2">
            <?php require_once "partials/info-box.php"; ?>
            <p>Please fill out all fields to register</p>
            <form class="form" action="" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= escape(Input::get('username')) ?>" placeholder="5 - 20 characters">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" value="" placeholder="Minimum 6 characters">
                </div>

                <div class="form-group">
                    <label for="password_again">Password again:</label>
                    <input type="password" id="password_again" name="password_again" class="form-control" value="" placeholder="Repeat password">
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= escape(Input::get('name')) ?>" placeholder="5 - 50 characters ">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?= escape(Input::get('email')) ?>" placeholder="Valid email address">
                </div>

                <input type="hidden" name="token" value="<?= Token::generate() ?>">

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
