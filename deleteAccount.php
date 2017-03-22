<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';

    if($user->delete($user->getId())){
        $imgPath = Config::get('upload/directory')."/".$user->getId();

        array_map('unlink',glob($imgPath."/*.*"));

        if(Storage::deleteDir($imgPath)){
            $user->logout();
            Session::flash('success','Account successfully deleted');
            Redirect::to('index.php');
        }
    }else{
        Session::flash('error','There was an error deleting an account');
    }
?>