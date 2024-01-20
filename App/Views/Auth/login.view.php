<?php

$layout = 'root';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

    <div class="card my-5">
        <div id="loginFormTitle" class="card-body">
            <h5 class="card-title text-center">Prihlásenie</h5>
<!--            <form method="post" action="--><?php //= $link->url("login") ?><!--">-->
            <form method="post" action="<?= $link->url("admin.index") ?>">
                <div class="mb-3">
                    <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                           required autofocus>
                </div>
                <div class="mb-3">
                    <input name="password" type="password" id="password" class="form-control"
                           placeholder="Heslo" required>
                </div>
                <div class="withLink form-text">Nemáte účet? Vytvoriť nový</div>
                <button id='submitLogin' type="submit" class="submitLoginButton btn-primary">Prihlásiť sa</button>
            </form>
        </div>
    </div>
