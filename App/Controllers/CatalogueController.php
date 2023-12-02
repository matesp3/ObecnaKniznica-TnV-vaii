<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

class CatalogueController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        // tu si budem z db brat posty
        return $this->html([]); // a poslem si ich do view
    }
}