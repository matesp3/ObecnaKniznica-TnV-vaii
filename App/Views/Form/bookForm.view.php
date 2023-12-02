 <?php ?>
 <div class="container">
     <form>
         <div class="row bg-body-secondary">
             <div class="mb-3">
                 <label for="bookPictureInput" class="col-form-label col-md-2">Ilustračný obrázok</label>
                 <div class="col-md-10">
                     <input class="form-control" type="file" id="bookPictureInput">
                 </div>
             </div>
         </div>
         <div class="row bg-body-tertiary container" id="authorsOfBookContainer">
             <!--         zaciatok patternu pre javascript -->
             <div class="row">
                 <div class="mb-3">
                     <label for="aboutAuthorInputs" class="col-form-label col-md-2">Autor</label>
                     <div class="container col-md-10" id="aboutAuthorInputs1">
                         <div class="row">
                             <div class="col-md-5 me-lg-5">
                                 <input class="form-control" type="text" placeholder="Meno">
                             </div>
                             <div class="col-md-5 ms-lg-5">
                                 <input class="form-control" type="text" placeholder="Priezvisko">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!--        koniec patternu pre javascript -->
         </div>
         <div class="row m-3" >
             <button class="btn btn-sm btn-primary col-1 rounded-3" type="button" id="btnAddAnotherAuthor">
                 <i class="bi bi-plus-lg"></i>
             </button>
             <label for="btnAddAnotherAuthor" class="col-form-label col-11">Pridať autora</label>
         </div>
     </form>
 </div>