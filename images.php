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
        $items_per_page = 5;
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
                                    <div class="image-box">
                                        <div class="image">
                                            <img class="img-responsive" src="storage/8/<?= $image->save_name ?>" alt="">
                                        </div>
                                        <div class="image-description">
                                            <a class="image-link" href=""><?= $image->name?></a>
                                            <p class="image-type pull-right">
                                                <i class="fa fa-picture-o navbar-icons" aria-hidden="true"></i> <?= $image->extension ?>
                                            </p>
                                            <p class="image-date">
                                                <i class="fa fa-calendar navbar-icons" aria-hidden="true"></i> 12.06.2010
                                            </p>
                                            <p class="image-size"><i class="fa fa-file-image-o navbar-icons" aria-hidden="true"></i> <?= $image->size/100000 ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="col-lg-12 text-center">
                        <?php if($pagination->totalPages() > 0) : ?>
                            <ul class="pagination pagination-lg">
                                <?php if($pagination->hasPrevious()) : ?>
                                    <li>
                                        <a href="images.php?username=<?= $user->userData()->username ?>&page=<?= $pagination->previous() ?>">Previous</a>
                                    </li>
                                <?php endif ?>

                                <?php
                                    $min = max($page - 2,1);
                                    $max = min($page + 2 ,$pagination->totalPages());

                                    for($i=$min; $i<=$max;$i++) : ?>
                                    <?php $activeLink = ($i == $pagination->currentPage()) ? 'active' : ''?>
                                        <li class="<?= $activeLink ?>">
                                            <a href="images.php?username=<?= $user->userData()->username ?>&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor ?>

                                <?php if($pagination->hasNext()) : ?>
                                    <li>
                                        <a href="images.php?username=<?= $user->userData()->username ?>&page=<?= $pagination->next() ?>">Next</a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php
    require_once "partials/footer.php";
?>
