<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';
    
    if(Input::exists('get')) {
        $imageId = Input::get('image');

        if (!$user->ownsImage($sessionId, $imageId)) {
            Redirect::to(404);
        }

        $image = new Image();
        $image = $image->imageByID($imageId);

        $imgPath = Config::get('upload/directory')."/".$user->userData()->id."/".$image->first()->save_name;
        
        if(Storage::deleteFile($imgPath)){
            $image = new Image();
            if($image->delete($imageId)){
                Session::flash('success','Image has been successfully deleted');
                Redirect::to('images.php?username='.escape($user->userData()->username));
            }
        }else{
            Session::flash('error','There was an error deleting a picture');
            Redirect::to('images.php?username='.escape($user->userData()->username));
        }
    }
?>

<?php
    require_once "partials/footer.php";
?>