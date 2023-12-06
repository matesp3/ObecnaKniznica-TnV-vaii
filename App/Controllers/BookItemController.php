<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\BookItem;
use App\Helpers\FileStorage;
use App\Core\HTTPException;



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
        $newBookItem = new BookItem();

        $filePath = $this->request()->getValue('filePath');
//        $newBookItem->setPicture($filePath);
//        $newBookItem->setPicture($this->request()->getFiles()['picture']['name']);

        $newFileName = FileStorage::saveFile($this->request()->getFiles()['filePath']);
        $newBookItem->setPicture($newFileName);
        $bookName = $this->request()->getValue('booksName');
        $newBookItem->setBookName($bookName);;

        $availableAmount = $this->request()->getValue('amount');
        $newBookItem->setAvailable($availableAmount > 0 ? $availableAmount : null);

        $newBookItem->setDescription($this->request()->getValue('description'));


        $authorName = $this->request()->getValue('authorName1');
        $authorSurname = $this->request()->getValue('authorSurname1');
        $i = 1;
        $authors = [];

        do {
            $authors[] = $authorSurname . ' ' . $authorName;
            $i++;
            $authorName = $this->request()->getValue('authorName' . $i);
            $authorSurname = $this->request()->getValue('authorSurname' . $i);
        } while (!is_null($authorName));

        $newBookItem->setAuthor($authors[0]);
        $newBookItem->save();

        return $this->html($authors,'index'); // vrati 'index' view v BookItem
    }

    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $bookItem = BookItem::getOne($id);

        if (is_null($bookItem)) {
            throw new HTTPException(404, "Odstraňovaný príspevok nie je možné odstrániť, lebo neexistuje!");
        }
        FileStorage::deleteFile($bookItem->getPicture());
        $bookItem->delete();
        return new RedirectResponse($this->url("home.index"));
    }

    public function edit() : Response
    {
        $id = $this->request()->getValue('id');
        $bookItem = BookItem::getOne($id);

        if (is_null($bookItem)) {
            throw new HTTPException(404, "Odstraňovaný príspevok nie je možné odstrániť, lebo neexistuje!");
        }
        return $this->html([
            'bookItem' => $bookItem
            ]
        );
    }
}