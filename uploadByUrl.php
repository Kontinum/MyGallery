<?php
    require_once "core/init.php";
    $user = new User();
    if(!$user->isLoggedIn()){
        Redirect::to('index.php');
    }
    require_once "partials/header.php";
    require_once "partials/navigation.php";

    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validation = new Validation();

            $validation = $validation->check($_POST,[
                'image-url' => 'imageUrl'
            ]);

            if($validation->passed()) {
                $userId = $user->getId();
                $uploadDir = Config::get('upload/directory');

                Storage::makeDir($uploadDir . "/" . $userId);

                $imgContent = file_get_contents(Input::get('image-url'));
                $imgName = "webImage".time().".jpg";
                $imgPath = $uploadDir . "/" . $userId . "/".$imgName;

                if($imgSize = file_put_contents($imgPath,$imgContent)){
                    $image = new Image();

                    if($image->insertImage([
                        'user_id' => $userId,
                        'name' => 'webImage',
                        'save_name' => $imgName,
                        'extension' => $image->getImgType($imgPath),
                        'size' => $imgSize,
                        'uploaded' => date('Y-m-d H:i:s')
                    ])){
                        Session::flash('success','Image has been successfully uploaded');
                        Redirect::to('upload.php');
                    }
                }
            }
        }
    }
?>

<?php
    require_once "partials/info-box.php";
    require_once "partials/footer.php";
?>

