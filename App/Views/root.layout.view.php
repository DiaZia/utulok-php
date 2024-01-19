<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <title>Útulok</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="public/js/script.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="row header">
        <div class="col-5 col-sm-6 col-md-5 col-lg-4">
            <a class="title" href='<?php echo $auth->isAdmin() ? $link->url("admin.index") : $link->url("home.index"); ?>'>Útulok Pacička</a>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-7">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a href="<?= $link->url("home.aboutUs") ?>" class="mainButtons" id="onas">O nás</a>
                    <li class="nav-item"><a href="<?= $link->url("pet.index") ?>" class="mainButtons">Naše zvieratká</a></li>
                    <li class="nav-item"><a href="<?= $link->url("home.support") ?>" class="mainButtons">Podporte nás</a></li>
                    <?php if ($auth->isLogged()) { ?>
                        <li class="nav-item"><a href="<?= $link->url("home.adoption") ?>" class="mainButtons" id="adopcie">Moje adopcie</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-2 col-sm-2 col-md-2 col-lg-1">
            <div class="logClass">
                <?php if ($auth->isLogged()) { ?>
                    <span class="log">Prihlásený používateľ: <b><?= $auth->getLoggedUserName() ?></b></span>
                    <a class="log" href="<?= $link->url("auth.logout") ?>">Odhlásenie</a>
                <?php } else { ?>
                    <img src="public/images/login.jpg" alt="login" class="loginPic" onclick="window.location.href='<?= \App\Config\Configuration::LOGIN_URL ?>'">
                    <a class="log" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
        <aside class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
            <div class="asidePanel">
                <a class="eshop" href="<?= $link->url("home.eshop") ?>">E-shop</a>
                <a href="<?= $link->url("home.cart") ?>" class="kosik" id="kosik">
                    <img id="kosikImg" src="public/images/shopping-cart.jpg">
                </a>
                <img src="public/images/facebook.jpg" alt="facebook">
                <img src="public/images/instagram.jpg" alt="instagram">
            </div>
        </aside>
    </div>
</div>
<footer>
    <p>&copy; 2023 Diana Žiaková - Semestrálna práca z predmetu VAII</p>
</footer>
</body>
</html>
