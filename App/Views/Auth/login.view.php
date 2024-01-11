<?php

$layout = 'root';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5" id="loginCard">
                <div class="card-body">
                    <h5 class="card-title text-center">Prihlásenie</h5>
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>
                    <form class="formularLogin" method="post" action="<?= $link->url("login")?>">
                        <div class="mb-3">
                            <input name="login" type="text" id="login" class="form-control inputArea" placeholder="Login"
                                   required autofocus>
                        </div>
                        <div class="mb-3">
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Heslo" required>
                        </div>
                        <div class="passwordResetText form-text" >Zabudli ste heslo?</div>
                        <button type="submit" class="submitLoginButton btn-primary">Prihlásiť sa</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


