<?php
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