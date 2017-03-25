<?php
    require_once "core/init.php";
    $user = new User();

    if(!$user->isLoggedIn()){
        Redirect::to('login.php');
    }
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';
?>

<?php
    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validation = new Validation();

            $validation = $validation->checkFile('upload_image');

            if($validation->passed()){
                $file = new File('upload_image');

                if(!$file->check()->haveErrors()){
                    $userId = $user->userData()->id;

                    Storage::makeDir(Config::get('upload/directory')."/".$userId);

                    $file->setUploadDir($file->getUploadDir()."/".$userId);
                    $file->setSaveName($file->getClientOriginalName() . time() .".".$file->getClientOriginalExtension());

                    if($file->upload()){
                        $image = new Image();
                        $insertImage = $image->insertImage([
                            'user_id' => $userId,
                            'name' => $file->getClientOriginalName(),
                            'save_name' => $file->getSaveName(),
                            'extension' => $file->getClientOriginalExtension(),
                            'size' => $file->getSize(),
                            'uploaded' => date('Y-m-d H:i:s')
                        ]);

                        if($insertImage){
                            Session::flash('success','Image successfully uploaded');
                            Redirect::to('upload.php');
                        }
                    }else{
                        Session::flash('error','There was an error uploading file');
                    }
                }
            }
        }
    }
?>
    <div class="container">
        <div class="row">
            <div class="wrapper col-lg-8 col-lg-offset-2 text-center">
                <?php require_once "partials/info-box.php"; ?>
                <div class="upload-div">
                    <p>You can upload up to 16MB photo with jpg, png and bmp extensions.</p>
                    <form action="upload.php" method="post" class="dropzone" id="dropzoneForm">
                        <input type="hidden" name="token" value="<?= $token = Token::generate() ?>">
                    </form>
                </div>
            </div>
            <br>
            <div class="wrapper col-lg-8 col-lg-offset-2 text-center">
                <br><hr>
                <p>or paste image link below</p>

                <form action="uploadByUrl.php" method="post">
                    <div class="form-group col-lg-8 col-lg-offset-1 col-mds-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                        <input type="text" name="image-url" class="form-control" required>
                    </div>
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary pull-left">Add image url</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        Dropzone.options.dropzoneForm = {
            paramName: "upload_image",
            maxFilesize: 16,
            maxFiles:2,
            acceptedFiles: 'image/jpg, image/jpeg, image/png, image/bmp',
            dictDefaultMessage: "Drag 'n drop or choose up to 2 images"
        };
    </script>
<?php
    require_once "partials/footer.php";
?>
