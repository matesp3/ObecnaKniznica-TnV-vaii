<div class="contentGridContainer"> <!-- stred medzi navbarom a footerom -->
    <div class="middleContentItem">
        <h3 class="h3Actualities">Aktuality</h3>
        <?php require 'actualityCard.view.php'?>

        <div class="pageCounter">
            <nav aria-label="Page navigation for actualities">
                <ul class="pagination pagination-sm">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="leftSideContentItem"></div>
    <div class="rightSideContentItem">
        <?php require 'openingHoursTable.view.php'?>
    </div>
</div>