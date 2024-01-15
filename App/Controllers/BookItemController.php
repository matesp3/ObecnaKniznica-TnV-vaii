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
    const AUTHORS_SEPARATOR = ', ';
    const DEFAULT_PICTURE_PATH = "default-picture.png";

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html(null, 'bookForm');
    }

    public function save() : Response
    {
        $id = (int) $this->request()->getValue('id');
        $bookItem = BookItem::getOne($id);

        $newFileName = $this->request()->getFiles()['filePath']['name'];

        if (is_null($bookItem)) {  // create mode
            $bookItem = new BookItem();
            if (strlen($newFileName) == 0) {
                $newFileName = self::DEFAULT_PICTURE_PATH;
            }
            else {
                $newFileName = FileStorage::saveFile($this->request()->getFiles()['filePath']);
            }

        } else {                  // edit mode
            if (!is_null($newFileName)) {
                if (strcmp($bookItem->getPicturePath(), self::DEFAULT_PICTURE_PATH) != 0) // don't delete default picture
                    FileStorage::deleteFile($bookItem->getPicturePath());
            }
            else {                // nothing is about to change
                $newFileName = is_null($bookItem->getPicturePath()) ? self::DEFAULT_PICTURE_PATH : $bookItem->getPicturePath();
            }
        }

        $bookItem->setPicturePath($newFileName);

        $bookName = $this->request()->getValue('booksName');
        $bookItem->setBookName($bookName);

        $i = 1;
        $authors = [];
        $authorString = "";
        $authorName = $this->request()->getValue('authorName1');
        $authorSurname = $this->request()->getValue('authorSurname1');

        do {
            $authors[] = $authorSurname . ' ' . $authorName;
            $authorString = $authorString . $authorSurname . ' ' . $authorName . self::AUTHORS_SEPARATOR;
            $i++;
            $authorName = $this->request()->getValue('authorName' . $i);
            $authorSurname = $this->request()->getValue('authorSurname' . $i);
        } while (!is_null($authorName));

        $authorString = $authorString . '~';
        $bookItem->setAuthor(explode(self::AUTHORS_SEPARATOR . '~', $authorString)[0]); // 'mena..., ~'
//        $bookItem->setAuthor($authorString); // 'mena..., ~'

        $availableAmount = $this->request()->getValue('amount');
        $bookItem->setAvailable($availableAmount > 0 ? $availableAmount : null);
        if ($availableAmount < 0)
            return $this->html(['authors' => $authors, 'availability' => false, 'bookItem' => $bookItem], 'edit');
        $bookItem->setDescription($this->request()->getValue('description'));

        $bookItem->save();
//        return $this->redirect($this->url("catalogue.index"));
        return $this->html(['authors' => $authors, 'str' => $bookItem->getAuthor()],'index'); // vrati 'index' view v BookItem
        // TODO
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