<?php
/** @var \App\Core\LinkGenerator  $link      */
/** @var \App\Models\BookItem     $bookItem  */
/** @var array                    $authors   */
?>

<div class="card">
    <div class="card-body col-6 cardBookItem">
        <div class="row g-0">
            <div class="col-md-2">
                <img src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . DIRECTORY_SEPARATOR . ($bookItem->getPictureName() ?? \App\Config\Configuration::DEFAULT_PICTURE) ?>" class="img-fluid sneakPeekImg" alt="Nahlad obalky knihy">
            </div>
            <div class="col-md-10" aria-label="productInfo">
                <div class="row d-flex justify-content ratingInfoCover">
                    <p class="ratingInfo"> <?= "Hodnotenie: " . ($bookItem->getRating() == null ? '0' : $bookItem->getRating()) . "/5"?></p>
                </div>
                <div class="row">
                    <div class="container-fluid">
                        <div class="row titleAndRatingContainer">
                            <h5 class="card-title bookTitle"><?= $bookItem->getBookName() ?></h5>
                        </div>
                        <div class="row">
                            <p class="card-text authorName">
                                <small class="text-body-primary"><?= $authors ?></small>
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
    </div>
    <div class="row g-0 card-footer reservingArea">
        <div class="col-md-6 d-flex justify-content-md-start editSection">
            <a class="btn btn-danger" href="<?= $link->url('bookItem.delete',['id' => $bookItem->getId()]) ?>">
                <i class="bi bi-trash"></i> vymazať
            </a>
            <a class="btn btn-warning" href="<?= $link->url('bookItem.edit',['id' => $bookItem->getId()]) ?>">
                <i class="bi bi-pencil"></i> upraviť
            </a>
        </div>
        <div class="col-md-6 d-md-flex justify-content-md-end">
            <div class="statusCoverClass">
                <p class="statusAvailability"><?= $bookItem->getAvailable() != null && $bookItem->getAvailable() > 0 ? "Dostupné" : "Nedostupné" ?></p>
            </div>
            <button class="btn btn-primary btnReserve" type="button">Rezervovať</button>
        </div>
    </div>
</div>
