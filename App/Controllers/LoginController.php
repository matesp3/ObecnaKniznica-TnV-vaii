<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\EmptyResponse;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;

class LoginController extends AControllerBase
{
    public function index(): Response
    {
        return $this->html();
    }

    public function login() : Response
    {
        $jsonData = $this->request()->getRawBodyJSON();

        if (is_object($jsonData)
            && property_exists($jsonData, 'login') && property_exists($jsonData, 'password')
            && !empty($jsonData->login) && !empty($jsonData->password))
        {
            return $this->json(['passed' => $this->app->getAuth()->login($jsonData->login, $jsonData->password)]);
//            throw new HTTPException(401);
        }
        throw new HTTPException(401);
    }
}