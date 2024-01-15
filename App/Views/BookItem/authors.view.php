<?php
/** @var array $author */
/** @var int $i        */
?>

<label for="<?= 'aboutAuthorInputs' . $i?>" class="col-form-label col-md-2 mt-3">Autor</label>

<div class="col-md-9 d-flex flex-wrap flex-md-nowrap mt-md-3" id="<?= 'aboutAuthorInputs' . $i?>">
    <div class="col-12 col-md-5">
        <input class="form-control" id="<?= 'author' . $i . 'Name'?>" value="<?= @$author['name'] ?>" name="<?= 'authorName' . $i?>" type="text"
               placeholder="Meno" required>
    </div>
    <div class="col-12 col-md-1 mt-1 mt-md-0"></div>  <!-- sluzi len pre vyplnenie priestoru pre md+ -->
    <div class="col-12 col-md-5">
        <input class="form-control" id="<?= 'author' . $i . 'Surname'?>" value="<?= @$author['surname'] ?>" name="<?= 'surname' . $i?>"
               type="text" placeholder="Priezvisko" required>
    </div>
    <div class="col-12 col-md-1 mt-1 mt-md-0 d-flex justify-content-end align-items-center" >
        <button type="button" class="btn btn-sm btn-outline-danger deleteButton" id="<?= 'delBtn-' . $i?>">
            <i class="bi bi-trash" id="<?= 'iTrash-' . $i?>"></i>
        </button>
    </div>
</div>