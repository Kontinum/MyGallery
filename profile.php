<?php
    require_once "core/init.php";

    if(Input::exists('get')){
        $username = Input::get('username',FILTER_SANITIZE_STRING);
        $user = new User();

        if(!$user->isLoggedIn()){
            Redirect::to('index.php');
        }else{
            $sessionName = Config::get('session/session_name');
            $sessionId = Session::get($sessionName);
            $user = new User($username);

            if(!$user->dataExists() || !$user->ownsProfile($sessionId,$username)){
                Redirect::to(404);
            }
        }
    }
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
