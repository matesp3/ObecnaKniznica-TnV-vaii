
<?php
/** @var \App\Core\LinkGenerator  $link */
/** @var \App\Models\BookItem     $bookItem */
/** @var string                   $authors */
/** @var array                    $data */
?>

<div class="gridPageLayout">
    <div class="navigationHeader"></div>

    <div class="gridContentLayout">
        <div class="filterArea">
            <div class="mb-3 searchInput">
                <label  class="form-label">Vyhľadávanie v katalógu kníh</label>
                <input type="search" class="form-control" id="exampleFormControlInput1" placeholder="výraz na vyhľadanie">
                <button type="button" class="btnsSubmitSearching">Hľadať</button>
            </div>
        </div>
        <div id="containerOfBooks" class="container">
            <?php foreach ($data as $complexItem) : ?>
                <?php $bookItem = $complexItem['book'] ?>
                <?php $authors = $complexItem['authors'] ?>
                <?php require 'card.view.php'?>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="footer"></footer>
</div>