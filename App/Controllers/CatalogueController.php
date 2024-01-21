<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Author;
use App\Models\AuthorRight;
use App\Models\BookItem;

class CatalogueController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $data = [];
        $bookItems = BookItem::getAll();
        foreach ($bookItems as $book)
        {
            $rights = AuthorRight::getAllAuthorRightsWithBookId($book->getId());
            $authors = [];
            foreach ($rights as $right)
            {
                $authors[] = Author::getOne($right->getAuthorId());
            }
            $data[] = ['book' => $book, 'authors' => $this->authorsToString($authors)];
        }
        return $this->html($data);
    }

    private function authorsToString($authors) : string
    {
        $count = count($authors);
        if ($count == 0)
            return 'CHYBA: Autor knihy neexistuje!';
        if ($count > 1)
        {
            $str = '';
            for ($i = 0; $i < ($count - 1); $i++) {
                $str = $str . $authors[$i]->getFullname() . ', ';
            }
            return ($str . $authors[$count - 1]->getFullname());
        }
        else
            return $authors[0]->getFullname();
    }
}