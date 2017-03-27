<?php
    require_once "core/init.php";
    require_once "partials/user_check.php";
    require_once 'partials/header.php';
    require_once 'partials/navigation.php';

    $sql = "SELECT COUNT(*) AS count FROM images WHERE user_id = ?";
    $countImages = Database::getInstance()->query($sql,[$sessionId]);
    $totalImages = $countImages->first()->count;

    if($totalImages > 0){
        $sql  ="SELECT * FROM images WHERE user_id = ? ORDER BY uploaded DESC";
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
                <p>Gallery view</p>

                <div class="images col-lg-12">
                    <a style="text-decoration: none" title="Switch to normal view" class="" href="images.php?username=<?= escape($user->userData()->username) ?>">
                        <i class="fa fa-lg fa-table" aria-hidden="true"></i>
                    </a>
                    <div id="gallery" style="display: none">
                        <?php foreach ($userImages->results() as $image) : ?>
                            <?php
                            $imgPath = Config::get('upload/directory')."/".$user->getId()."/".$image->save_name;
                            ?>

                            <img alt="<?= escape($image->name) ?>" src="<?= "storage/".$user->getId()."/".escape($image->save_name) ?>"
                                 data-image="<?= "storage/".$user->getId()."/".escape($image->save_name) ?>"
                                 data-description="<?= escape($image->name) ?>">
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery("#gallery").unitegallery({
            tile_enable_shadow:true,
            tile_shadow_color:"cornflowerblue",
            tiles_space_between_cols:10
        });
    });
</script>
<?php
require_once "partials/footer.php";
?>
