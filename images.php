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

        $sql = "SELECT * FROM images WHERE user_id = ? ";
        $sql .= "LIMIT ".$items_per_page;
        $sql .=" OFFSET ".$pagination->offset();

        $userImages = Database::getInstance()->query($sql,[$sessionId]);
    }

?>

    <div class="container">
        <div class="row">
            <div class="wrapper">
                <?php if($totalImages == 0) : ?>
                    <p>You don't have any images. Go to <a href="upload.php">Upload page</a> and upload them</p>
                    <?php else: ?>
                    <p>Your images: <em><?= $totalImages ?></em></p>
                    <div class="images col-lg-12">
                        <?php foreach ($userImages->results() as $image) : ?>
                            <div style="margin-bottom: 20px" class="col-lg-3">
                                <a href="">
                                    <div class="box">
                                        <div class="image-box">
                                            <img class="image img-responsive" src="storage/8/<?= escape($image->save_name); ?>" alt="">
                                        </div>
                                        <div class="image-description">
                                            <a class="image-link" href=""><?= escape($image->name); ?></a>
                                            <p class="image-type pull-right">
                                                <i class="fa fa-picture-o navbar-icons" aria-hidden="true"></i> <?= escape($image->extension); ?>
                                            </p>
                                            <p class="image-date">
                                                <i class="fa fa-calendar navbar-icons" aria-hidden="true"></i> <?php
                                                $uploaded = new DateTime($image->uploaded);
                                                echo $uploaded->format('d-m-Y')
                                                ?>
                                            </p>
                                            <p class="image-size"><i class="fa fa-file-image-o navbar-icons" aria-hidden="true"></i> <?= escape(number_format($image->size/1000000,2)); ?>MB
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
