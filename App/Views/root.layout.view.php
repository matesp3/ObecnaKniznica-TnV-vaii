<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="public/css/allStyles.css">
    <script src="public/js/script.js"></script>
</head>

<body id="rootBody">
    <nav id="navHeader" class="navbar navbar-expand-md mojNav">  <!-- bg-body-tertiary (pozadie)-->
        <div class="container-fluid">
            <a id="homeIcon" class="navbar-brand itemOfNavbar" href="<?= $link->url("bookItem.index") ?>" title="<?= \App\Config\Configuration::APP_NAME ?>">
                <i class="homeButtonIcon bi bi-book"></i>
                <span class="homeButtonName"> Obecná knižnica </span>
            </a>
            <button class="navbar-toggler collapsed toglerik" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="togglerIcon navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarsExample09">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="itemOfNavbar nav-link" href="<?= $link->url("catalogue.index")?>">Katalóg kníh</a> <!-- aria-current="page" -->
                    </li>
                    <li class="nav-item">
                        <a class="itemOfNavbar nav-link" href="#">Blog</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-item itemOfNavbar nav-link" href="<?= $link->url("home.contact") ?>">O nás</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item itemOfNavbar nav-link login" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container-fluid">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
        <footer id="footer" class="d-flex flex-wrap align-items-center justify-content-center bottom-top pb-3">
            <div class="row mt-3">
                <div class="col text-center">
                    &copy; <?= date('Y') ?> Obecná knižnica, Teplička nad Váhom 013 01
                </div>
            </div>
        </footer>
</body>
</html>
