<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

class BookItemController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html(null, 'bookForm');
    }

    public function add() : Response
    {
        $authorName = $this->request()->getValue('authorName1');
        $authorSurname = $this->request()->getValue('authorSurname1');
        $i = 1;
        $authors = [];
//        $authors['authorName1'] = $authorName;
//        $authors['authorName2'] = $authorSurname;// potialto odkomentovat to islo


        do {
            $authors[] = $authorSurname . ' ' . $authorName;
            $i++;
            $authorName = $this->request()->getValue('authorName' . $i);
            $authorSurname = $this->request()->getValue('authorSurname' . $i);
        } while (!is_null($authorName));

//        return $this->html($authors); // vrati 'index' view v BookItem
        return $this->html($authors,'index'); // vrati 'index' view v BookItem
    }
}