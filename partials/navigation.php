<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand">MyGallery</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="upload.php">
                    <i class="fa fa-lg fa-cloud-upload navbar-icons" aria-hidden="true"></i> Upload photo
                </a>
            </li>
            <?php
                $user = new User();
                if($user->isLoggedIn()) : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?= $user->userData()->username ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li>
                        <a href="login.php">
                            <i class="fa fa-lg fa-sign-in navbar-icons" aria-hidden="true"></i> Sign in
                        </a>
                    </li>
                    <a href="register.php">
                        <button class="btn btn-primary navbar-btn">Create account</button>
                    </a>
                <?php endif ?>
        </ul>
    </div>
</nav>