<div class="col-lg-12 text-center">
    <?php if($pagination->totalPages() > 1) : ?>
        <ul class="pagination pagination-lg">
            <?php if($pagination->hasPrevious()) : ?>
                <?php if($pagination->currentPage() >= 4) : ?>
                    <li>
                        <a href="images.php?username=<?= $user->userData()->username ?>&page=<?= $pagination->first() ?>">First</a>
                    </li>
                <?php endif ?>
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
                <?php if($pagination->currentPage() + 2 < $pagination->totalPages()): ?>
                    <li>
                        <a href="images.php?username=<?= $user->userData()->username ?>&page=<?= $pagination->last() ?>">Last</a>
                    </li>
                <?php endif ?>
            <?php endif ?>
        </ul>
    <?php endif ?>
</div>