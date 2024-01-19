<?php

namespace App\Controllers;

use App\Config\Configuration;
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
    private const IMAGE_FILE_TYPES = ['image/jpeg', 'image/png'];
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html(null, 'bookForm');
    }

    public function save() : Response
    {
        $pattern = '/^[0-9a-zA-Z' . Configuration::UNI_SLOVAK_LETTERS . ']/u';
        $pom = substr($this->request()->getValue('booksName'), 0, 2);
        $result = preg_match($pattern, $pom);
        $str = mb_convert_case($this->request()->getValue('name-1'), MB_CASE_TITLE, "UTF-8");
        $a = htmlspecialchars($this->request()->getValue('amount'));
        $b = (double) htmlspecialchars($this->request()->getValue('amount'));
//        $b = (int)$a;
        $vysledok = is_int($a);
        $vysledok = is_int($b);

//-------------------------------------------------------
        $params      = [];
        $errors      = [];
        $this->checkAndPrepareUserInputs($params, $errors);
//        if (!is_null($errors) && count($errors) > 0)
//        {
//            // TODO: spracovanie chyb v bookForm.view.php
//            return $this->html(['errors'=> $errors, 'previousInputs' => $params], 'bookForm');
//        }

//        $id          = (int) $this->request()->getValue('id');
//        $bookItem    = BookItem::getOne($id) ?? new BookItem();
//
//        $bookItem->setPictureName($this->handleNewFileName($bookItem->getPictureName()));
//        $bookItem->setBookName($params['bookName']);
//        $bookItem->setDescription($params['description']);
//        $bookItem->setAvailable($params['amount']);
//        if (strcmp($bookItem->getCreated(), "not defined") == 0)
//            $bookItem->setCreated(date("Y-m-d h-i-s"));
//        $bookItem->save();
//
//        $wanted = $bookItem->getId() ??
//            BookItem::getAll('`bookName` LIKE ? AND `created` = ?',
//            [$bookItem->getBookName(), $bookItem->getCreated()])[0]?->getId() ?? null;
//        if (is_null($wanted))
//            throw new HTTPException(500, 'Databáze sa nepodarilo uložiť(nájsť) nový bookItem.');
//
//        $this->saveAuthorsWithRelationships($params['authors']);
//
        return $this->redirect($this->url("catalogue.index"), ['message' => 'Zmeny uložené']);
    }

    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $bookItem = BookItem::getOne($id);

        if (is_null($bookItem)) {
            throw new HTTPException(404, "Zadaný knižný prvok nie je možné odstrániť, lebo neexistuje!");
        }
        if (!is_null($bookItem->getPicturePath()))
            FileStorage::deleteFile($bookItem->getPicturePath());

        $bookItem->delete();
        return new RedirectResponse($this->url("catalogue.index"), ['msg' => 'Kniha bola z katalógu odstránená.']);
    }

    public function edit() : Response
    {
        $id = $this->request()->getValue('id');
        $bookItem = BookItem::getOne($id);

        if (is_null($bookItem)) {
            throw new HTTPException(404, "Nenašiel sa hľadaný knižný prvok na vykonanie úprav!");
        }

        $i = 0;
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
            ], 'bookForm'
        );
    }

    /**
     * @param string $name
     * @param string $surname
     * @return Author|null if new author is saved, it's going to be returned. If author did exist, null is returned.
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
        return null;                 // an author already exists
    }

//    private function handleNewFileInput(&$bookItem, &$newFileName) {

    /** NOTE! It is expected, that file name from HTTP POST request is valid.
     * @param string|null $oldFileName - name of previously saved image within book item instance
     * @return string|null name of picture to be saved inside book item instance to DB
     * @throws HTTPException
     */
    private function handleNewFileName(?string $oldFileName) : ?string
    {
        if (!is_null($oldFileName) && strlen($oldFileName) != 0) {
            FileStorage::deleteFile($oldFileName);
            return $newFileName = FileStorage::saveFile($this->request()->getFiles()['pictureFile']);
        }
        return null;
    }

    /**
     * @param $checkedUserInputs - values for later processing, either for saving or returning back to view
     * @param $foundErrors - in case of some error occurrence, here it will be input for processing
     */
    private function checkAndPrepareUserInputs(&$checkedUserInputs, &$foundErrors): void
    {
        $userInputs['fileName' ]  = null; // values: fileName | booksName | name-1[-n] | surname-1[-n] | amount | description

        $userInputs['name-1'   ]  = null;
        $userInputs['surname-1']  = null;
        $userInputs['amount'   ]  = null;
        $userInputs['description'] = $this->request()->getValue('description');
        $errorCode = $this->request()->getFiles()['pictureFile']['error'];

        if ($errorCode != UPLOAD_ERR_NO_FILE && $errorCode != UPLOAD_ERR_OK) // UPLOAD_ERR_NO_FILE is not error, it's a choice
            $foundErrors['fileName'] = 'Došlo k chybe pri nahrávaní súboru. [Chybový kód:(' . $errorCode . ')]';

        $file_type = $this->request()->getFiles()['pictureFile']['type'];
        if (!in_array($file_type, self::IMAGE_FILE_TYPES, true)) {
            $foundErrors['fileName'] = "Súbor je nesprávneho typu!";
        }
        else
            $checkedUserInputs['fileName'] = $this->request()->getFiles()['pictureFile']['name'];

        $strInput = htmlspecialchars($this->request()->getValue('booksName')); // protect against XSS
        if ($this->validateFirstLetter($strInput, true))
            $userInputs['booksName'] = $strInput;
        else
            $foundErrors['booksName'] = 'Názov knihy bol zadaný v nesprávnom formáte!';
        // TODO: dokonci ostatne atributy
    }
//`  pictureName` varchar(80)     NULL,
//`  description` text            NULL,
//`  available`   integer         NOT NULL DEFAULT 0,
//`  rating`      float(5,2)      NOT NULL DEFAULT 0,

    /** New authors are saved, and also if relations between book item and author does not exist, it would create one
     * @param $authors - expects that array of authors is set with correct names and surnames
     * @throws HTTPException - if there's no info about authors
     */
    private function saveAuthorsWithRelationships(&$authors) {
        if (is_null($authors))
            throw new HTTPException(500, 'Žiadne dostupné info o autoroch aktuálneho knižného prvku!');

        $position = 1;
        $aName    = $authors["name-"    . $position];
        $aSurname = $authors["surname-" . $position];
        while (!is_null($aName)) {
            $newAuthor = $this->saveAuthorIfNeeded($aName, $aSurname);
            if (!is_null($newAuthor)) // the non-null response tells us to create new relationship between book item and author
            {
                // TODO: link new author with bookitem
                // TODO: you need to delete from DB all the users with current post, who were delete through delete button
                // TODO: add category column for bookitem
            }
            ++$position;
            $aName    = $authors["name-"    . $position];
            $aSurname = $authors["surname-" . $position];
        }
    }

    /** Checks, whether first letter is from Slovak alphabet (optionally, if it's a number)
     * @param $strToValidate
     * @param bool $checkWithDecimals
     * @return true if first letter fits conditions. Return also false, when in parameter is nothing to evaluate.
     */
    private function validateFirstLetter($strToValidate, bool $checkWithDecimals = false) : bool
    {
        if (!is_null($strToValidate) || strlen($strToValidate) == 0)
            return false;

        $pattern = "";
        $decimalsPart = $checkWithDecimals ? '0-9' : '';
        if (strlen($strToValidate) == 1)    // in this case, we are not dealing with UNICODE character
            $pattern = '/^['. $decimalsPart .'a-zA-Z]/';
        else                                // checking UNICODE characters also
            $pattern = '/^['. $decimalsPart .'a-zA-Z' . Configuration::UNI_SLOVAK_LETTERS . ']/u';

        $result = preg_match($pattern, $strToValidate); // return values could be: { false | 1 | 0 }
        return !($result === false) && $result === 1;
    }
}