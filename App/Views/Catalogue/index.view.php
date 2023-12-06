
<?php
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Models\BookItem $bookItem */
/** @var array $data */
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
        <div class="containerOfBooks container">
            <?php foreach ($data as $bookItem) : ?>
            <div class="row">
                <div class="card mb-3 cardBookItem col-6">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . DIRECTORY_SEPARATOR . $bookItem->getPicture() ?>" class="img-fluid sneakPeekImg" alt="Nahlad obalky knihy">
                        </div>
                        <div class="col-md-10" aria-label="productInfo">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row titleAndRatingContainer">
                                        <h5 class="card-title bookTitle"><?= $bookItem->getBookName() ?></h5>
                                    </div>
                                    <div class="row">
                                        <p class="card-text authorName">
                                            <small class="text-body-primary"><?= $bookItem->getAuthor() ?></small>
                                        </p>
                                    </div>
                                    <div class="row descriptionSneakPeak">
                                        <div class="col bookTitle">
                                            <p class="card-text"><?= $bookItem->getDescription() == null ? "" : $bookItem->getDescription()?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 reservingArea">
                        <div class="d-grid gap-0 d-md-flex justify-content-md-end">
                            <p class="ratingInfo"> <?= "Hodnotenie: " . ($bookItem->getRating() == null ? '0' : $bookItem->getRating()) . "/5"?></p>
                            <div class="statusCoverClass">
                                <p class="statusAvailability"><?= $bookItem->getAvailable() != null && $bookItem->getAvailable() > 0 ? "Dostupné" : "Nedostupné" ?></p>
                                <!--                <button  class="btn btn-primary btnStatus" disabled type="button">Rezervovať</button>-->
                            </div>
                            <button class="btn btn-primary btnReserve" type="button">Rezervovať</button>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <a class="btn btn-danger" href="<?= $link->url('bookItem.delete',['id' => $bookItem->getId()]) ?>">
                        <i class="bi bi-trash"></i> vymazať
                    </a>
                </div>
                <div class="col-2">
                    <a class="btn btn-warning" href="<?= $link->url('bookItem.edit',['id' => $bookItem->getId()]) ?>">
                        <i class="bi bi-pencil"></i> upraviť
                    </a>
                </div>
            </div>
            <?php endforeach; ?>


        </div>
    </div>

    <footer class="footer"></footer>
</div>