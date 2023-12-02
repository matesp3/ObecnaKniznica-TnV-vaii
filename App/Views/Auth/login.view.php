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
<!--                    <div class="text-center text-danger mb-3">-->
<!--                        --><?php //= @$data['message'] ?>
<!--                    </div>-->
                    <form class="formularLogin">
                        <div class="mb-3">
<!--                            <label for="exampleInputEmail1" class="form-label">Login</label>-->
<!--                            <input type="email" class="inputArea form-control" id="exampleInputEmail1" aria-describedby="emailHelp">-->
                            <input name="login" type="text" id="login" class="form-control inputArea" placeholder="Login"
                                   required autofocus>
                        </div>
                        <div class="mb-3">
<!--                            <label for="exampleInputPassword1" class="form-label">Heslo</label>-->
<!--                            <input type="password" class="    inputArea form-control" id="exampleInputPassword1">-->
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


<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">-->
<!--            <div class="card card-signin my-5">-->
<!--                <div class="card-body">-->
<!--                    <h5 class="card-title text-center">Prihlásenie</h5>-->
<!--                    <div class="text-center text-danger mb-3">-->
<!--                        --><?php //= @$data['message'] ?>
<!--                    </div>-->
<!--                    <form class="form-signin" method="post" action="--><?php //= $link->url("login") ?><!--">-->
<!--                        <div class="form-label-group mb-3">-->
<!--                            <input name="login" type="text" id="login" class="form-control" placeholder="Login"-->
<!--                                   required autofocus>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-label-group mb-3">-->
<!--                            <input name="password" type="password" id="password" class="form-control"-->
<!--                                   placeholder="Password" required>-->
<!--                        </div>-->
<!--                        <div class="text-center">-->
<!--                            <button class="btn btn-primary" type="submit" name="submit">Prihlásiť-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
