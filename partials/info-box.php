<?php

    if(Session::exists('success')) : ?>
        <div class="info-box success">
            <p><?= Session::flash('success') ?></p>
        </div>
    <?php endif ?>

    <?php if(Session::exists('error')) : ?>
    <div class="info-box fail">
        <p><?= Session::flash('error') ?></p>
    </div>
    <?php endif ?>

    <?php if(isset($validation) && !$validation->passed()) : ?>
        <div class="info-box fail">
            <ul>
                <?php foreach ($validation->errors() as $errors) : ?>
                    <li><?= $errors ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>
