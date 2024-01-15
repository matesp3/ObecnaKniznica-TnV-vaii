<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Author;
use App\Models\BookItem;
use App\Helpers\FileStorage;
use App\Core\HTTPException;
use MongoDB\BSON\Timestamp;


class BookItemController extends AControllerBase
{
    const AUTHORS_SEPARATOR = ', ';
    const DEFAULT_PICTURE_PATH = "default-picture.png";

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html(null, 'bookForm');
    }

    /**
     * @param string $name
     * @param string $surname
     * @return Author|null if new author is saved, its going to be returned. If author did exist, null is returned.
     * @throws \Exception
     */
    private function saveAuthorIfNeeded(string $name, string $surname) : ?Author
    {
        $author = Author::getAuthor($name, $surname);
        if (is_null($author)) {      // create new author
            $author = new Author();
            $author->setName($name);
            $author->setSurname($surname);
            $author->setCreated(date('Y-m-d H:i:s'));
            $author->save();
            return $author;
        }
        return null;
    }

    public function save() : Response
    {
//        $au = Author::getAll('`name` LIKE ? AND `surname` LIKE ?', ['%tej', '%lja%']);
//        $au = Author::getAll('`name` LIKE ?', ['Ma%'], orderBy: '`surname` desc');
        /* 1 - check, if bookItem exists, else create new one
         * 2 - check, if all input authors exist, else create new ones
         *     (author is unique by the combination of name and surname, because there's nothing more to distinguish)*
         * 3 - check, whether exists relation between author and bookitem, else create one
         * 4 - redirection to catalogue view
         */
        $position = 1;
        $aName    = $this->request()->getValue("name-" . $position);
        $aSurname = $this->request()->getValue("surname-" . $position);
        while (!is_null($aName)) {
            $newAuthor = $this->saveAuthorIfNeeded($aName, $aSurname);
            if (!is_null($newAuthor))
            {
                // TODO: link new author with bookitem
                // TODO: you need to delete from DB all the users with current post, who were delete through delete button
            }
            ++$position;
            $aName    = $this->request()->getValue("name-" . $position);
            $aSurname = $this->request()->getValue("surname-" . $position);
        }



        return $this->redirect($this->url('home.index'));

//        $id = (int) $this->request()->getValue('id');
//        $bookItem = BookItem::getOne($id);
//
//        $newFileName = $this->request()->getFiles()['filePath']['name'];
//
//        if (is_null($bookItem)) {  // create mode
//            $bookItem = new BookItem();
//            if (strlen($newFileName) == 0) {
//                $newFileName = self::DEFAULT_PICTURE_PATH;
//            }
//            else {
//                $newFileName = FileStorage::saveFile($this->request()->getFiles()['filePath']);
//            }
//
//        } else {                  // edit mode
//            if (!is_null($newFileName)) {
//                if (strcmp($bookItem->getPicturePath(), self::DEFAULT_PICTURE_PATH) != 0) // don't delete default picture
//                    FileStorage::deleteFile($bookItem->getPicturePath());
//            }
//            else {                // nothing is about to change
//                $newFileName = is_null($bookItem->getPicturePath()) ? self::DEFAULT_PICTURE_PATH : $bookItem->getPicturePath();
//            }
//        }
//
//        $bookItem->setPicturePath($newFileName);
//
//        $bookName = $this->request()->getValue('booksName');
//        $bookItem->setBookName($bookName);
//
//        $i = 1;
//        $authors = [];
//        $authorString = "";
//        $authorName = $this->request()->getValue('authorName1');
//        $authorSurname = $this->request()->getValue('authorSurname1');
//
//        do {
//            $authors[] = $authorSurname . ' ' . $authorName;
//            $authorString = $authorString . $authorSurname . ' ' . $authorName . self::AUTHORS_SEPARATOR;
//            $i++;
//            $authorName = $this->request()->getValue('authorName' . $i);
//            $authorSurname = $this->request()->getValue('authorSurname' . $i);
//        } while (!is_null($authorName));
//
//        $authorString = $authorString . '~';
//        $bookItem->setAuthor(explode(self::AUTHORS_SEPARATOR . '~', $authorString)[0]); // 'mena..., ~'
////        $bookItem->setAuthor($authorString); // 'mena..., ~'
//
//        $availableAmount = $this->request()->getValue('amount');
//        $bookItem->setAvailable($availableAmount > 0 ? $availableAmount : null);
//        if ($availableAmount < 0)
//            return $this->html(['authors' => $authors, 'availability' => false, 'bookItem' => $bookItem], 'edit');
//        $bookItem->setDescription($this->request()->getValue('description'));
//
//        $bookItem->save();
////        return $this->redirect($this->url("catalogue.index"));
//        return $this->html(['authors' => $authors, 'str' => $bookItem->getAuthor()],'index'); // vrati 'index' view v BookItem
//        // TODO
        // * prerobit autora na tabulku, nie dlhy column autorov...
    }

    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $bookItem = BookItem::getOne($id);

        if (is_null($bookItem)) {
            throw new HTTPException(404, "Odstraňovaný  príspevok nie je možné odstrániť, lebo neexistuje!");
        }
        if (strcmp($bookItem->getPicturePath(), self::DEFAULT_PICTURE_PATH) != 0)
            FileStorage::deleteFile($bookItem->getPicturePath());

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

        $i = 0;
        $authors = [];
//        foreach (explode(', ',$bookItem->getAuthor()) as $oneAuthor) {
//            $authors[] = ['surname' => explode(self::AUTHORS_SEPARATOR, $oneAuthor, 2)[0],
//                          'name' => explode(' ', $oneAuthor, 2)[1],
//                          'description' => 'Autor (' . $i++ . ')'];
//        }
        $authors[] = ['surname' => 'Poljak',
            'name' => 'Matej',
        ];
        $authors[] = ['surname' => 'Stefanova',
            'name' => 'Anna',
        ];

        $authors[] = ['surname' => 'Poljak',
            'name' => 'Matus',
        ];
        $authors[] = ['surname' => 'Stefanov',
            'name' => 'Marek',
        ];
        return $this->html([
                'bookItem' => $bookItem,
                'authors' => $authors
            ]
        );
    }
}