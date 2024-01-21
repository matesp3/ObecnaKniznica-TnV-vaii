<?php

$layout = 'root';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="row justify-content-center align-content-center">
    <div id="loginCard" class="card my-5 formHoverEffect col-11 col-sm-8 col-md-7 col-lg-6 col-xl-5">
        <div class="card-body">
            <h5 class="card-title text-center">Prihlásenie</h5>
            <div id="formErrorMessages"></div>
            <!--            <form method="post" action="--><?php //= $link->url("login") ?><!--">-->
            <form id="formLogin" method="post" action="<?= $link->url("admin.index") ?>">
                <div class="mb-3">
                    <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                           required autofocus>
                </div>
                <div class="mb-3">
                    <input name="password" type="password" id="password" class="form-control"
                           placeholder="Heslo" required>
                </div>
                <div class="form-text">
                    <a class="withLink" href="<?= $link->url("user.registration") ?>"> Nemáte účet? Vytvoriť nový </a>
                </div>
                <button id='submitLogin' type="submit" class="submitLoginButton">Prihlásiť sa</button>
            </form>
        </div>
    </div>
</div>

