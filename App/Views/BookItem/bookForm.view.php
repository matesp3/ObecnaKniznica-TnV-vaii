<?php
//$layout = 'root'
/** @var \App\Core\LinkGenerator $link */
/** @var Array $data  */
?>
     <form class="needs-validation" method="post" action="<?= $link->url('bookItem.save') ?>" enctype="multipart/form-data">
         <div id="bookForm" class="container py-3 px-5 my-5 rounded-3" >
             <input type="hidden" name="id" value="<?= @$data['bookItem']?->getId() ?>">
             <div class="row mb-3">
                 <label for="bookPictureInput" class="col-form-label col-md-2">Ilustračný obrázok</label>
                 <div class="col-md-9">
                     <input class="form-control" type="file" name="filePath" id="bookPictureInput">
                     <?php if (@$data['bookItem'] != null): ?>
                     <div>
                         Predošlý obrázok
                         <i>
                             <small>
                                <?= substr(@$data['bookItem']->getPicturePath(), strpos(@$data['bookItem']->getPicturePath(), '-') +  1) ?>
                             </small>
                         </i>
                     </div>
                     <?php endif; ?>
                 </div>
             </div>

             <div class="row mb-3">
                 <label for="booksName " class=" col-form-label col-md-2">Názov knihy</label>
                 <div class="col-md-9 was-validated">
                     <input class="form-control" name="booksName" value="<?= @$data['bookItem']?->getBookName()?>" type="text" id="bookName" placeholder="Názov" required>
                 </div>
             </div>

             <div class="row mb-3 was-validated" id="authorsOfBookContainer">
                 <?php if (@$data['authors'] == null) : ?>
                     <label for="aboutAuthorInputs1" class="col-form-label col-md-2">Autor</label>
                     <div class="col-md-9 d-flex flex-wrap flex-md-nowrap" id="aboutAuthorInputs1">
                         <div class="col-12 col-md-5">
                               <input class="form-control" id="author1Name" name="authorName1" type="text" placeholder="Meno" required>
                         </div>
                         <div class="col-12 col-md-1 mt-1 mt-md-0"></div>
                         <div class="col-12 col-md-5">
                                <input class="form-control" id="author1Surname" name="authorSurname1" type="text" placeholder="Priezvisko" required>
                         </div>
                         <div class="col-12 col-md-1 mt-1 mt-md-0 d-flex justify-content-end align-items-center" >
                             <button type="button" class="btn btn-sm btn-outline-danger deleteButton" id="delBtn-1">
                                 <i class="bi bi-trash" id="iTrash-1"></i>
                             </button>
                         </div>
                     </div>

                 <?php else :
                     $i = 1;
                    foreach (@$data['authors'] as $author) :
                        require "authors.view.php"; // js pattern for row about author
                        $i++;
                    endforeach;
                 endif; ?>
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
                     <input class="form-control" name="amount" value="<?= @$data['bookItem']?->getAvailable()?>" type="number" id="numberOfAvailable" placeholder="napr. 5" required>
                     <?php if (@$data['availability'] == false) : ?>
                         <div class="invalid-feedback">
                             Zadajte, prosím, nezáporné číslo.
                         </div>
                     <?php endif; ?>
                 </div>
             </div>

             <div class="row">
                 <label for="descr " class=" col-form-label col-md-2">Popis</label>
                 <div class=" col-md-8">
                     <textarea class="form-control" id="descr" name="description" value="<?= @$data['bookItem']?->getDescription()?>" placeholder="Priestor na zhodnotenie knihy"> </textarea>
                 </div>
             </div>

             <div class="row justify-content-center align-items-center">
                 <button id="btnSubmitBookItem" type="submit" class="btn border-2 text-center col-3 col-sm-2 col-lg-1 mt-5">Uložiť</button>
             </div>
         </div>
     </form>