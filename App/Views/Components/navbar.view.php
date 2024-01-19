<?php
/** @var LinkGenerator $link */

use App\Core\LinkGenerator;

?>

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