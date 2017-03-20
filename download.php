<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';

    if(Input::exists('get')){
        $imageId = Input::get('image');

        if(!$user->ownsImage($sessionId,$imageId)){
            Redirect::to(404);
        }

        $image = new Image();
        $image = $image->imageByID($imageId);

        $imgPath = Config::get('upload/directory')."/".$user->userData()->id."/".$image->first()->save_name;
        echo $imgPath;
        if(Storage::fileExists($imgPath)){
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($imgPath).'"');
            header("Content-Transfer-Encoding: binary");
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($imgPath));
            ob_clean();
            flush();
            readfile($imgPath);
            exit;
        }
    }
?>

<?php
    require_once "partials/footer.php";
?>


