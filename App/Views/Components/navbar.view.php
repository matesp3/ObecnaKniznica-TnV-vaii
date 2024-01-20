<?php
/** @var LinkGenerator $link */

use App\Core\LinkGenerator;

?>

<nav id="navHeader" class="navbar navbar-expand-md">
    <div class="container-fluid">
        <a id="homeIcon" class="navbar-brand itemOfNavbar" href="<?= $link->url("home.index") ?>" title="<?= \App\Config\Configuration::APP_NAME ?>">
            <i class="homeButtonIcon bi bi-book"></i>
            <span class="homeButtonName"> Obecná knižnica </span>
        </a>
        <button class="navbar-toggler collapsed toglerik" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapsibleContent" aria-controls="navbarCollapsibleContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="togglerIcon navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarCollapsibleContent">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item dropdown">
                    <a class="itemOfNavbar nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Katalóg kníh</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= $link->url("catalogue.index")?>">Zobraziť knihy</a></li>
                        <li><a class="dropdown-item" href="<?= $link->url("bookItem.index")?>">Pridať novú knihu</a></li>
<!--                        <li><hr class="dropdown-divider"></li>-->
                    </ul>
                </li>

<!--                    <a class="itemOfNavbar nav-link" href="--><?php //= $link->url("catalogue.index")?><!--">Katalóg kníh</a>-->
<!--                <li class="nav-item">-->
<!--                    <a class="itemOfNavbar nav-link" href="#">Blog</a>-->
<!--                </li>-->
                <li class="nav-item dropdown">
                    <a class="itemOfNavbar nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Zobraziť príspevky</a></li>
                        <li><a class="dropdown-item" href="#">Pridať nový príspevok</a></li>
                        <!--                        <li><hr class="dropdown-divider"></li>-->
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-item itemOfNavbar nav-link" href="<?= $link->url("auth.logout") ?>">O nás</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item itemOfNavbar nav-link login" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a>
                </li>
            </ul>
        </div>
    </div>
</nav>