<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\BookItem;

class CatalogueController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        // tu si budem z db brat posty
        $bookItems = BookItem::getAll();
        return $this->html($bookItems); // a poslem si ich do view
    }
}