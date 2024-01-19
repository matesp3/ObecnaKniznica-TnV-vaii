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
use MongoDB\BSON\PackedArray;
use MongoDB\BSON\Timestamp;


class BookItemController extends AControllerBase
{
    private const IMAGE_FILE_TYPES = ['image/jpeg', 'image/png'];
    private const FILE_TYPES = ['jpeg', 'png'];
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html(null, 'bookForm');
    }

    public function save() : Response
    {
        $id          = (int) $this->request()->getValue('id');
        $params      = [];
        $errors      = [];
        $this->checkAndPrepareUserInputs($params, $errors);
        if (!is_null($errors) && count($errors) > 0)
        {
            if ($id != 0)
                $params['id'] = $id;
            return $this->html(['errors'=> $errors, 'previousInputs' => $params], 'bookForm');
        }
        $bookItem    = BookItem::getOne($id) ?? new BookItem();

        $bookItem->setPictureName($this->handleNewFileName($bookItem->getPictureName()));
        $bookItem->setBookName($params['booksName']);
        $bookItem->setDescription($params['description']);
        $bookItem->setAvailable($params['amount']);
        if (strcmp($bookItem->getCreated(), Configuration::INVALID) == 0)
            $bookItem->setCreated(date("Y-m-d h-i-s"));
        $bookItem->save();

        $wanted = $bookItem->getId() ??
            BookItem::getAll('`bookName` LIKE ? AND `created` = ?',
            [$bookItem->getBookName(), $bookItem->getCreated()])[0]?->getId() ?? null;
        if (is_null($wanted))
            throw new HTTPException(500, 'Databáze sa nepodarilo uložiť(nájsť) nový bookItem.');

        //$this->saveAuthorsWithRelationships($params['authors']);

        return $this->redirect($this->url("catalogue.index"), ['message' => 'Zmeny uložené']);
    }

    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $bookItem = BookItem::getOne($id);

        if (is_null($bookItem)) {
            throw new HTTPException(404, "Zadaný knižný prvok nie je možné odstrániť, lebo neexistuje!");
        }
        if (!is_null($bookItem->getPictureName()))
            FileStorage::deleteFile($bookItem->getPictureName());

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
        $authors['surname-1'] = 'Stefanova';
        $authors['surname-2'] = 'Poljak';
        $authors['name-1'] = 'Anna';
        $authors['name-2'] = 'Matej';

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

    /** NOTE! It is expected, that file name from HTTP POST request is valid.
     * @param string|null $oldFileName - name of previously saved image within book item instance
     * @return string|null name of picture to be saved inside book item instance to DB
     * @throws HTTPException
     */
    private function handleNewFileName(?string $oldFileName) : ?string
    {
        $resultName = $oldFileName;
        $newFileName = $this->request()->getFiles()['pictureFile']['name'];
        if (strlen($newFileName) > 0)
        {
            if ($oldFileName && strlen($oldFileName) > 0)
                FileStorage::deleteFile($oldFileName);
            $resultName = FileStorage::saveFile($this->request()->getFiles()['pictureFile']);
        }
        return $resultName;
    }

    /**
     * @param $checkedUserInputs - values for later processing, either for saving or returning back to view
     * @param $foundErrors - in case of some error occurrence, here it will be input for processing
     */
    private function checkAndPrepareUserInputs(&$checkedUserInputs, &$foundErrors): void
    {
        $checkedUserInputs['fileName'   ]  = null; // values: fileName | booksName | name-1[-n] | surname-1[-n] | amount | description
        $checkedUserInputs['booksName'  ]  = null;
        $checkedUserInputs['amount'     ]  = null;
        $strInput = htmlspecialchars($this->request()->getValue('description'));
        $checkedUserInputs['description']  = strlen($strInput) == 1 && ord($strInput[0]) == 32 ? null : $strInput;

        $errorCode = $this->request()->getFiles()['pictureFile']['error'];
        $file_type = $this->request()->getFiles()['pictureFile']['type'];

        if ($errorCode == UPLOAD_ERR_OK)
        {
           if (in_array($file_type, self::IMAGE_FILE_TYPES, true))
               $checkedUserInputs['fileName'] = $this->request()->getFiles()['pictureFile']['name'];
           else
               $foundErrors['fileName'] = 'Súbor je nesprávneho typu! Povolené typy: [' . implode(', ',self::FILE_TYPES) . ']';
        }
        else
        {
            if ($errorCode != UPLOAD_ERR_NO_FILE) // UPLOAD_ERR_NO_FILE is not error, it's a choice
                $foundErrors['fileName'] = 'Došlo k chybe pri nahrávaní súboru. [Chybový kód:(' . $errorCode . ')]';
        }

        $strInput = htmlspecialchars($this->request()->getValue('booksName')); // protect against XSS
        if ($this->validateFirstLetter($strInput, true))
            $checkedUserInputs['booksName'] = mb_convert_case($strInput, MB_CASE_TITLE, "UTF-8");
        else
            $foundErrors['booksName'] = 'Názov knihy bol zadaný v nesprávnom formáte!';

        $strInput = htmlspecialchars($this->request()->getValue('amount'));
        if (strlen($strInput) == 0)
            $foundErrors['amount'] = 'Počet dostupných kusov nebol zadaný!';
        else
        {
            if (is_numeric($strInput))
                if ( ((int)$strInput) >= 0)
                    $checkedUserInputs['amount'] = (int) $strInput;
                else
                    $foundErrors['amount'] = 'Zadaný vstup nemôže byť záporné číslo!';
            else
                $foundErrors['amount'] = 'Zadaný vstup nebolo kladné číslo!';
        }

        $position = 1;
        $aName    = $this->request()->getValue('name-'    . $position);
        $aSurname = $this->request()->getValue('surname-' . $position);
        while (!is_null($aName) && !is_null($aSurname))  // even if variables were empty strings(it means, that inputs existed, so we go further in checking
        {
            $aName = htmlspecialchars($aName);
            if ($this->validateFirstLetter($aName))
                $checkedUserInputs['name-' . $position] = mb_convert_case($aName, MB_CASE_TITLE, "UTF-8");
            else
            {
                $checkedUserInputs['name-' . $position] = Configuration::INVALID;
                $foundErrors['name-' . $position] = 'Meno v nesprávnom formáte!';
            }
            $aSurname = htmlspecialchars($aSurname);
            if ($this->validateFirstLetter($aSurname))
                $checkedUserInputs['surname-' . $position] = mb_convert_case($aSurname, MB_CASE_TITLE, "UTF-8");
            else
            {
                $foundErrors['surname-' . $position] = 'Priezvisko v nesprávnom formáte!';
                $checkedUserInputs['surname-' . $position] = Configuration::INVALID;
            }
            $position++;
            $aName    = $this->request()->getValue('name-'    . $position);
            $aSurname = $this->request()->getValue('surname-' . $position);
        }
    }

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
        if (strlen($strToValidate) == 0) // if $strToValidate is null, result is 0
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