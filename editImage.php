<?php
    require_once "core/init.php";
    $user = new User();

    if(!$user->isLoggedIn()){
        Redirect::to('login.php');
    }

    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validation = new Validation();

            $validation = $validation->check($_POST,[
                'image-name' => 'required|max:20'
            ]);

            if($validation->passed()){
                $imageId = Input::get('image-id');
                $image = new Image();

                $imageUpdate = $image->update([
                    'name' => Input::get('image-name',FILTER_SANITIZE_STRING)
                ],$imageId);

                if($imageUpdate){
                    Session::flash('success','Image name has been successfully changed');
                    Redirect::to('image.php?username='.$user->userData()->username."&image=".$imageId);
                }else{
                    Session::flash('error','There was an error editing image');
                    Redirect::to('image.php?username='.$user->userData()->username."&image=".$imageId);
                }
            }
        }
    }

?>