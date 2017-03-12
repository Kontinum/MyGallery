<?php
    require_once "core/init.php";

    $user = new User();

    if(!$user->isLoggedIn()){
        Redirect::to('index.php');
    }else{
        $user->logout();
        Redirect::to('index.php');
    }