<?php
/** @var array $authors */
/** @var array $data                   */
/** @var App\Core\IAuthenticator $auth */
?>

<?php $i = 1; ?>
<?php $nameId = 'name-' . $i; ?>
<?php $surnameId = 'surname-' . $i; ?>
<?php $aName = $authors[$nameId]; ?>
<?php $aSurname = $authors[$surnameId]; ?>
<?php do { ?>

    <label for="<?= 'aboutAuthorInputs-' . $i ?>"
           class="col-form-label col-md-2 mt-3"> <?= 'Autor (' . $i . ')' ?> </label>

    <div class="col-md-9 d-flex flex-wrap flex-md-nowrap mt-md-3" id="<?= 'aboutAuthorInputs-' . $i ?>">
        <div class="col-12 col-md-5">
            <input class="form-control" id="<?= 'aName-' . $i ?>" type="text" placeholder="Meno" required
                   name="<?= $nameId ?>" value="<?= strcmp($authors[$nameId], \App\Config\Configuration::INVALID) == 0 ? null : $authors[$nameId] ?>"
                   pattern=<?= '^[a-zA-Z' . \App\Config\Configuration::UNI_SLOVAK_LETTERS . '].*' ?>>
            <?php if ($data && strcmp($authors[$nameId], \App\Config\Configuration::INVALID) == 0) : // if data are not available, no errors are present ?>
                <?php $invalidSegment = $nameId; ?>
                <?php require 'errorNotice.view.php'; ?>
            <?php endif; ?>
        </div>

        <div class="col-12 col-md-1 mt-1 mt-md-0"></div>  <!-- sluzi len pre vyplnenie priestoru pre md+ -->
        <div class="col-12 col-md-5">
            <input class="form-control" id="<?= 'aSurname-' . $i ?>" type="text" placeholder="Priezvisko" required
                   name="<?= $surnameId ?>" value="<?= strcmp($authors[$surnameId], \App\Config\Configuration::INVALID) == 0 ? null : $authors[$surnameId] ?>"
                   pattern=<?= '^[a-zA-Z' . \App\Config\Configuration::UNI_SLOVAK_LETTERS . '].*' ?>>
            <?php if ($data && strcmp($authors[$surnameId], \App\Config\Configuration::INVALID) == 0) : // if data are not available, no errors are present ?>
                <?php $invalidSegment = $surnameId; ?>
                <?php require 'errorNotice.view.php'; ?>
            <?php endif; ?>

        </div>
        <div class="col-12 col-md-1 mt-1 mt-md-0 d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-sm btn-outline-danger deleteButton" id="<?= 'delBtn-' . $i ?>">
                <i class="bi bi-trash" id="<?= 'iTrash-' . $i ?>"></i>
            </button>
        </div>
    </div>

    <?php $i++; ?>
    <?php $nameId = 'name-' . $i; ?>
    <?php $surnameId = 'surname-' . $i; ?>
    <?php $aName = $authors[$nameId] ?? null; ?>
    <?php $aSurname = $authors[$surnameId] ?? null; ?>
<?php } while ($aName && $aSurname); ?>
