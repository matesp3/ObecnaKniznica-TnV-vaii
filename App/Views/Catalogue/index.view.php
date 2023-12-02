
<?php
/** @var \App\Core\LinkGenerator $link */
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
        <div class="containerOfBooks">
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <div class="card mb-3 cardBookItem">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="Images/knizka.png" class="img-fluid sneakPeekImg" alt="Nahlad obalky knihy">
                        </div>
                        <div class="col-md-10" aria-label="productInfo">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row titleAndRatingContainer">
                                        <h5 class="card-title bookTitle">Názov knihy</h5>
                                    </div>
                                    <div class="row">
                                        <p class="card-text authorName">
                                            <small class="text-body-primary">Autor knihy</small>
                                        </p>
                                    </div>
                                    <div class="row descriptionSneakPeak">
                                        <div class="col bookTitle">
                                            <p class="card-text">Krátky popis knihy. Čo je na nej zaujímavé, kedy sa dej odohráva, atď...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 reservingArea">
                        <div class="d-grid gap-0 d-md-flex justify-content-md-end">
                            <p class="ratingInfo">Hodnotenie: 4.3/5</p>
                            <div class="statusCoverClass">
                                <p class="statusAvailability">Dostupné</p>
                                <!--                <button  class="btn btn-primary btnStatus" disabled type="button">Rezervovať</button>-->
                            </div>
                            <button class="btn btn-primary btnReserve" type="button">Rezervovať</button>
                        </div>
                    </div>
            </div>
            <?php    } ?>


        </div>
    </div>

    <footer class="footer"></footer>
</div>