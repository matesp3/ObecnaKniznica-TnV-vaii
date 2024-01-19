<?php
//$layout = 'root'
/** @var \App\Core\LinkGenerator $link */
/** @var Array $data  */
?>
     <form class="needs-validation" method="post" action="<?= $link->url('bookItem.save') ?>" enctype="multipart/form-data">
         <div id="bookForm" class="container py-3 px-5 my-5 rounded-3" >
             <input type="hidden" name="id" value="<?= !$data ? 0 : (($data['bookItem'] ?? null) ? $data['bookItem']->getId() : $data['previousInputs']['id']) ?>">
             <div class="row mb-3">
                 <label for="bookPictureInput" class="col-form-label col-md-2">Ilustračný obrázok</label>
                 <div class="col-md-9">
                     <input class="form-control" type="file" name="pictureFile" id="bookPictureInput">
                     <span>
                        <i>
                            <small id="fInfo" class=<?= !$data ? 'normal' : (($data['errors'] ?? null) ? 'invalid' : 'valid')?>>
                                <?php if ($data) : ?>
                                    <?php if (!($data['errors'] ?? false)) :    // no errors, edit mode ?>
                                        <?php if ($data['bookItem'] ?? null): ?>
                                            Uložený predošlý obrázok: <?= is_null($data['bookItem']->getPictureName())
                                                ? 'žiadny'
                                                : substr(@$data['bookItem']->getPictureName(), strpos(@$data['bookItem']->getPictureName(), '-') +  1)
                                            ?>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?= $data['errors']['fileName'] ?? null ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </small>
                        </i>
                     </span>
                 </div>
             </div>

             <div class="row mb-3">
                 <label for="booksName " class=" col-form-label col-md-2">Názov knihy</label>
                 <div class="col-md-9 was-validated">
                     <input class="form-control" name="booksName" type="text" id="bookName" placeholder="Názov" required
                            value="<?= !$data ? null : (($data['bookItem'] ?? null) ? $data['bookItem']->getBookName() : $data['previousInputs']['booksName'] ) ?>"
                             pattern=<?='^[0-9a-zA-Z' . \App\Config\Configuration::UNI_SLOVAK_LETTERS . '].*'?>>
                     <?php $invalidSegment = 'booksName' ?>
                     <?php require "errorNotice.view.php" ?>
                 </div>
             </div>

             <div class="row mb-3 was-validated" id="authorsOfBookContainer">
                 <?php
                    $authors = []; // in this variable must be accessible all 'name-i's and 'surname-i's for displaying
                    if ($data) :
                        if ($data['errors'] ?? null) :    // CREATE mode: there was at least one error, so form is displayed again
                            $authors = $data['previousInputs'];
                        else :                    //   EDIT mode: this item already exists
                            $authors = $data['authors'];
                        endif;
                    else:                         // CREATE mode: form is first time opened. Everything is empty.
                        $authors['name-1']    = \App\Config\Configuration::INVALID;
                        $authors['surname-1'] = \App\Config\Configuration::INVALID;
                    endif;
                    require "authors.view.php";
                 ?>
             </div>

             <div class="row ms-1 my-3">
                 <button class="btn btn-sm btn-primary col-6 rounded-3" type="button" id="btnAddAnotherAuthor">
                     <i class="bi bi-plus-lg"></i>
                 </button>
                 <label for="btnAddAnotherAuthor" id="labelForBtnAdd" class="col-form-label col-6">Pridať autora</label>
             </div>

             <div class="row mt-5 mb-3">
                 <label for="numberOfAvailable " class=" col-form-label col-md-2">Dostupnosť(ks)</label>
                 <div class=" col-md-2 was-validated">
                     <input class="form-control" name="amount" type="number" id="numberOfAvailable" placeholder="napr. 5" min="0" required
                            value="<?= !$data ? null : ( ($data['bookItem'] ?? null) ? $data['bookItem']->getAvailable() : $data['previousInputs']['amount']) ?>">
                     <?php $invalidSegment = 'amount' ?>
                     <?php require "errorNotice.view.php" ?>
                 </div>
             </div>

             <div class="row">
                 <label for="descr " class=" col-form-label col-md-2">Popis</label>
                 <div class=" col-md-8">
                     <textarea class="form-control" id="descr" name="description" placeholder="Priestor na zhodnotenie knihy"><?=
                         $data ? ( ($data['errors'] ?? null) ? $data['previousInputs']['description'] : $data['bookItem']?->getDescription()) : null ?></textarea>
                 </div>
             </div>

             <div class="row justify-content-center align-items-center">
                 <button id="btnSubmitBookItem" type="submit" class="btn border-2 text-center col-3 col-sm-2 col-lg-1 mt-5">Uložiť</button>
             </div>
         </div>
     </form>