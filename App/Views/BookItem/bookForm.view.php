<?php
//$layout = 'root'
/** @var \App\Core\LinkGenerator $link */
/** @var Array $data  */
?>
     <form class="needs-validation" method="post" action="<?= $link->url('bookItem.save') ?>" enctype="multipart/form-data">
         <div class="container py-3 ps-5 my-5 rounded-3" id="bookForm" >
             <input type="hidden" name="id" value="<?= @$data['bookItem']?->getId() ?>">
             <div class="row mb-3">
                 <label for="bookPictureInput" class="col-form-label col-md-2">Ilustračný obrázok</label>
                 <div class="col-md-8 was-validated">
                     <input class="form-control" type="file" name="filePath" id="bookPictureInput" required>
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
                 <label for="bookName " class=" col-form-label col-md-2">Názov knihy</label>
                 <div class="col-md-8 was-validated">
                     <input class="form-control" name="booksName" value="<?= @$data['bookItem']?->getBookName()?>" type="text" id="bookName" placeholder="Názov" required>
                 </div>
             </div>

             <div class="row mb-3 was-validated" id="authorsOfBookContainer">
                 <?php if (@$data['authors'] == null) : ?>
                     <div class="row">
                         <label for="aboutAuthorInputs1" class="col-form-label col-md-2">Autor</label>
                         <div class="col-md-8" id="aboutAuthorInputs1">
                             <div class="row">
                                 <div class="col-md-5 me-lg-5">
                                     <input class="form-control" id="author1Name" name="authorName1" type="text" placeholder="Meno" required>
                                 </div>
                                 <div class="col-md-5 me-lg-5">
                                     <input class="form-control" id="author1Surname" name="authorSurname1" type="text" placeholder="Priezvisko" required>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php else : ?>
                     <?php foreach (@$data['authors'] as $author) : ?>
                         <!--         zaciatok patternu pre javascript -->
                         <div class="row">
                             <label for="aboutAuthorInputs1" class="col-form-label col-md-2">Autor</label>
                             <div class="col-md-8" id="aboutAuthorInputs1">
                                 <div class="row">
                                     <div class="col-md-5 me-lg-5">
                                         <input class="form-control" id="author1Name" value="<?= @$author['name'] ?>" name="authorName1" type="text" placeholder="Meno" required>
                                     </div>
                                     <div class="col-md-5 me-lg-5">
                                         <input class="form-control" id="author1Surname" value="<?= @$author['surname'] ?>" name="authorSurname1" type="text" placeholder="Priezvisko" required>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!--        koniec patternu pre javascript -->
                     <?php endforeach; ?>
                 <?php endif; ?>

             </div>

             <div class="row ms-1 my-3">
                 <button class="btn btn-sm btn-primary col-1 rounded-3" type="button" id="btnAddAnotherAuthor">
                     <i class="bi bi-plus-lg"></i>
                 </button>
                 <label for="btnAddAnotherAuthor" id="labelForBtnAdd" class="col-form-label col-2">Pridať autora</label>
             </div>

             <div class="row mt-5 mb-3">
                 <label for="numberOfAvailable " class=" col-form-label col-md-2">Dostupnosť(ks)</label>
                 <div class=" col-md-2 was-validated">
                     <input class="form-control" name="amount" value="<?= @$data['bookItem']?->getAvailable()?>" type="number" id="numberOfAvailable" placeholder="napr. 5" required>
                     <?php if (@$data['availability'] == false) : ?>
                         <div class="invalid-feedback">
                             Please provide a valid city.
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

             <div class="row justify-content-center">
                 <button id="btnSubmitBookItem" type="submit" class="btn border-2 col-2 col-md-1 mt-5 me-5">Uložiť</button>
             </div>

         </div>
     </form>

<script>

</script>
