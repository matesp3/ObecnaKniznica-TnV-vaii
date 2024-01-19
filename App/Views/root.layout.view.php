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

<body>
    <div id="rootContainer">
        <?php require 'Components/navbar.view.php' ?>
        <div id="web-content" class="container-fluid">
            <?= $contentHTML ?>
        </div>
        <?php require 'Components/footer.view.php' ?>
    </div>
</body>
</html>
