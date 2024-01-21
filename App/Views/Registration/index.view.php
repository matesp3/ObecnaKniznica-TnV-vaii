<?php

$layout = 'root';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="row justify-content-center">
    <form class="needs-validation col-lg-9" method="post" action="<?= $link->url('bookItem.save') ?>"
          enctype="multipart/form-data">
        <div class="container py-3 px-5 my-5 rounded-3 formHoverEffect">
            <h3 class="text-center mb-5"> Registrácia </h3>
            <div class="row was-validated mb-3">
                <label for="reg-name" class=" col-form-label col-sm-2">Meno</label>
                <div class="col-sm-10 col-md-9 col-lg-8">
                    <input id="reg-name" name="reg-name" class="form-control" type="text"
                           placeholder="Meno s diakritikou" required
                           pattern=<?= '[a-zA-Z' . \App\Config\Configuration::UNI_SLOVAK_LETTERS . ']{2,}' ?>>
                </div>
            </div>

            <div class="row was-validated mb-4">
                <label for="reg-surname" class="col-form-label col-sm-2">Priezvisko</label>
                <div class="col-sm-10 col-md-9 col-lg-8">
                    <input id="reg-surname" name="reg-surname" class="form-control" type="text"
                           placeholder="Priezvisko s diakritikou" required
                           pattern=<?= '[a-zA-Z' . \App\Config\Configuration::UNI_SLOVAK_LETTERS . ']{2,}' ?>>
                </div>
            </div>

            <div class="row was-validated mb-4">
                <label for="reg-login" class=" col-form-label col-sm-2">Login</label>
                <div class="col-sm-10 col-md-9 col-lg-8">
                    <input id="reg-login" name="reg-login" class="form-control" type="text"
                           placeholder="Aspoň 5 znakov bez diakritiky [+čísla]" required
                           pattern=<?= '[0-9a-zA-Z]{5,}' ?>>
                </div>
            </div>

            <div class="row was-validated mb-4">
                <label for="reg-password" class=" col-form-label col-sm-2">Heslo</label>
                <div class="col-sm-10 col-md-9 col-lg-8">
                    <input id="reg-password" name="reg-password" class="form-control" type="password"
                           placeholder="Aspoň 5 znakov bez diakritiky [+čísla a znaky @ # $ &]" required
                           pattern=<?= '[@#$&0-9a-zA-Z]{5,}' ?>>
                </div>
            </div>

            <div class="row was-validated mb-4">
                <label for="reg-password2" class=" col-form-label col-sm-2">Potvrdenie hesla</label>
                <div class="col-sm-10 col-md-9 col-lg-8">
                    <input id="reg-password2" name="reg-password2" class="form-control" type="password"
                           placeholder="Zopakujte zadané heslo" required
                           pattern=<?= '[@#$&0-9a-zA-Z]{5,}' ?>>
                </div>
            </div>

            <div class="row justify-content-center align-items-center">
                <button id="btnSubmitBookItem" type="submit"
                        class="btn border-2 text-center col-6 col-sm-4 col-md-2 col-lg-2 mt-5">
                    Registrovať
                </button>
            </div>
        </div>
    </form>
</div>
