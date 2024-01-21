<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\EmptyResponse;
use App\Core\Responses\Response;
use App\Models\BookItem;
use App\Models\Reservation;

class ReservationController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        // ak je pouzivatel prihlaseny.. zober vsetky jeho rezervacie
        return $this->html();
    }

    public function makeReservation() : Response
    {
        $jsonData = $this->request()->getRawBodyJSON();
        if (is_object($jsonData) && property_exists($jsonData, 'bookItemId'))
        {
            if ($this->authorize('createReservation'))
            {
                $bookItem = BookItem::getOne($jsonData->bookItemId);
                if ($bookItem)
                {
                    $books = Reservation::getAvailableBooks($bookItem->getId());
                    if (count($books) > 0)
                    {
                        $oneBook = $books[0];

                        $oneBook->setCustomerId($bookItem->getId());
                        $oneBook->setBorrowed(date('Y-m-d h:i:s'));
                        $oneBook->save();

                        $bookItem->setAvailable($bookItem->getAvailable() - 1);
                        $bookItem->save();
                        return new EmptyResponse();
                    }
                }

            }
        }
        return $this->json(['response' => false]);
    }

    public function authorize($action)
    {
        return $this->app->getAuth()->isLogged();
    }

}