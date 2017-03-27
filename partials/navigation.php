<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">MyGallery</a>
        </div>
        <div class="collapse navbar-collapse text-center" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php
                $user = new User();
                if($user->isLoggedIn()) : ?>
                    <li>
                        <a href="upload.php">
                            <i class="fa fa-lg fa-cloud-upload navbar-icons hidden-sm" aria-hidden="true"></i> Upload photo
                        </a>
                    </li>
                    <li>
                        <a href="images.php?username=<?= escape($user->userData()->username) ?>">
                            <i class="fa fa-lg fa-picture-o navbar-icons hidden-sm" aria-hidden="true"></i> Your images
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?= $user->userData()->username ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php?username=<?= escape($user->userData()->username) ?>">
                                    <i class="fa fa-user navbar-icons" aria-hidden="true"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="changepassword.php"><i class="fa fa-key navbar-icons" aria-hidden="true"></i> Change password
                                </a>
                            </li>
                            <li>
                                <a href="logout.php">
                                    <i class="fa fa-sign-out navbar-icons" aria-hidden="true"></i> Logout
                                </a>
                            </li>
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
    </div>
</nav>