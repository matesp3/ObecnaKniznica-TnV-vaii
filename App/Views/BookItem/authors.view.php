<?php
/** @var array $author */
?>

<!--         zaciatok patternu pre javascript -->
<label for="aboutAuthorInputs1" class="col-form-label col-md-2 mt-3"><?= @$author['description'] ?></label>

<div class="col-md-9 d-flex flex-wrap flex-md-nowrap mt-md-3" id="aboutAuthorInputs1">
    <div class="col-12 col-md-5">
        <input class="form-control" id="author1Name" value="<?= @$author['name'] ?>" name="authorName1" type="text"
               placeholder="Meno" required>
    </div>
    <div class="col-12 col-md-2 divSeparator"></div>  <!-- sluzi len pre vyplnenie priestoru pre md+ -->
    <div class="col-12 col-md-5">
        <input class="form-control" id="author1Surname" value="<?= @$author['surname'] ?>" name="authorSurname1"
               type="text" placeholder="Priezvisko" required>
    </div>
</div>
<!--        koniec patternu pre javascript -->
