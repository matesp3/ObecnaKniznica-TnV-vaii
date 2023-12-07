<?php

/** @var array $data */
?>

<h2>ahoj, tu je debug...</h2>

<?php //foreach ($data as $key => $item) : ?>
<!--    --><?php //if (str_contains($key, 'authorName')) : ?>
<!--    <h3>--><?php //=  $key . ' ->' . $item ?><!-- </h3>-->
<!--    --><?php //endif; ?>
<?php //endforeach ?>

<?php foreach ($data['authors'] as $author) : ?>
    <h3><?= 'autor ->' . $author ?> </h3>
<?php endforeach ?>

<h2>vytvoreny string: <?= $data['str'] ?> </h2>

