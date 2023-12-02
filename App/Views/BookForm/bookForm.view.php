
     <form>
         <div class="container py-3" id="bookForm" >
             <div class="row mb-3">
                 <label for="bookPictureInput" class="col-form-label col-md-2">Ilustračný obrázok</label>
                 <div class="col-md-8">
                     <input class="form-control" type="file" id="bookPictureInput" required>
                 </div>
             </div>

             <div class="row mb-3">
                         <label for="bookName " class=" col-form-label col-md-2">Názov knihy</label>
                     <div class="col-md-8">
                         <input class="form-control" type="text" id="bookName" placeholder="Názov" required>
                     </div>
             </div>

             <div class="row" id="authorsOfBookContainer">
                 <!--         zaciatok patternu pre javascript -->
                 <div class="row">
                     <div class="mb-3">
                         <label for="aboutAuthorInputs1" class="col-form-label col-md-2">Autor1</label>
                         <div class="container col-md-10" id="aboutAuthorInputs1">
                             <div class="row">
                                 <div class="col-md-5 me-lg-5">
                                     <input class="form-control" type="text" placeholder="Meno" required>
                                 </div>
                                 <div class="col-md-5 ms-lg-5">
                                     <input class="form-control" type="text" placeholder="Priezvisko" required>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!--        koniec patternu pre javascript -->
             </div>

             <div class="row m-3">
                 <button class="btn btn-sm btn-primary col-1 rounded-3" type="button" id="btnAddAnotherAuthor">
                     <i class="bi bi-plus-lg"></i>
                 </button>
                 <label for="btnAddAnotherAuthor" class="col-form-label col-11">Pridať autora</label>
             </div>

             <div class="row">
                 <label for="numberOfAvailable " class=" col-form-label col-2">Dostupnosť(ks)</label>
                 <div class=" col-2">
                     <input class="form-control" type="text" id="numberOfAvailable" placeholder="napr. 5" required>
                 </div>
             </div>

         </div>
     </form>
