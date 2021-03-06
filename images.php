<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';

    $sql = "SELECT COUNT(*) AS count FROM images WHERE user_id = ?";
    $countImages = Database::getInstance()->query($sql,[$sessionId]);
    $totalImages = $countImages->first()->count;

    if($totalImages > 0){
        $page = empty(Input::get('page')) ? 1 : Input::get('page');
        $items_per_page = 20;
        $total_records = $totalImages;

        $pagination = new Pagination($page,$items_per_page,$total_records);

        $sql  ="SELECT * FROM images WHERE user_id = ?";
        $sql .=" ORDER BY uploaded DESC";
        $sql .=" LIMIT ".$items_per_page;
        $sql .=" OFFSET ".$pagination->offset();

        $userImages = Database::getInstance()->query($sql,[$sessionId]);
    }

?>

    <div class="container">
        <div class="row">
            <div class="wrapper">
                <?php require_once "partials/info-box.php"; ?>
                <?php if($totalImages == 0) : ?>
                    <p>You don't have any images. Go to <a href="upload.php">Upload page</a> and upload them</p>
                    <?php else: ?>
                    <p>Your images: <em><?= $totalImages ?></em></p>

                    <div class="search-images col-lg-8 col-lg-offset-2 text-center">
                        <form action="searchImages.php" method="post">
                            <div class="form-group col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2">
                                <input type="search" name="image-name" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-2 col-md-2">
                                <input type="submit" name="search-image" value="Search" class="form-control btn btn-success">
                            </div>
                        </form>
                    </div>

                    <div class="images col-lg-12">
                        <a style="text-decoration: none" title="Switch to gallery view" class="" href="imageGallery.php?username=<?= escape($user->userData()->username) ?>">
                            <i class="fa fa-lg fa-th navbar-icons" aria-hidden="true"></i>
                        </a><br>
                        <?php foreach ($userImages->results() as $image) : ?>
                            <div style="margin-bottom: 20px" class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                <a href="image.php?username=<?= escape($user->userData()->username) ?>&image=<?= escape($image->id) ?>">
                                    <div class="box">
                                        <div class="image-box">
                                            <img class="image img-responsive" src="storage/<?=escape($user->userData()->id)?>/<?= escape($image->save_name) ?>" alt="">
                                        </div>
                                        <div class="image-description">
                                            <a class="image-link" href="image.php?username=<?= escape($user->userData()->username) ?>&image=<?= escape($image->id) ?>">
                                                <?= escape($image->name); ?>
                                            </a>
                                            <p class="image-type pull-right">
                                                <i class="fa fa-picture-o navbar-icons" aria-hidden="true"></i> <?= escape($image->extension); ?>
                                            </p>
                                            <p class="image-date hidden-xs">
                                                <i class="fa fa-calendar navbar-icons" aria-hidden="true"></i> <?php
                                                $uploaded = new DateTime($image->uploaded);
                                                echo $uploaded->format('d-m-Y')
                                                ?>
                                            </p>
                                            <p class="image-size hidden-xs"><i class="fa fa-file-image-o navbar-icons" aria-hidden="true"></i> <?= escape(number_format($image->size/1000000,2)); ?>MB
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <?php require_once "partials/pagination.php"; ?>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php
    require_once "partials/footer.php";
?>
