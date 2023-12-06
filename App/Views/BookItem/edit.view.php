<?php
$layout = 'root'
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Models\BookItem $bookItem */
/** @var Array $data */
?>

<h1>
    <?= $data['bookItem']->getId() ?>
</h1>

<?php require 'bookForm.view.php' ?>