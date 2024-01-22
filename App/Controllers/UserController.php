<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\EmptyResponse;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\User;

class UserController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function registration() : Response
    {
        return $this->html();
    }

    public function checkUserInputs() : Response
    {
        $jsonData = $this->request()->getRawBodyJSON();

        if ($this->authorize("registration") && is_object($jsonData)
            && property_exists($jsonData, 'login') && property_exists($jsonData, 'password')
            && property_exists($jsonData, 'password2') && property_exists($jsonData, 'name')
            && property_exists($jsonData, 'surname')
            && !empty($jsonData->login) && !empty($jsonData->password) && !empty($jsonData->password2) && !empty($jsonData->name)
            && !empty($jsonData->surname))
        {
            $result = [];
            $wanted = User::getUserByLogin($jsonData->login);
            /* login */
            if (is_null($wanted))  // login must be unique
                $result['login'] = $this->validateInput(Configuration::LATIN_PATTERN_MIN, Configuration::LATIN_PATTERN_MAX,
                Configuration::LATIN_PATTERN_SHORT, $jsonData->login);
            else
                $result['login'] = false;

            /* password */
            $result['password'] = $this->validateInput(Configuration::PASSWORD_PATTERN_MIN, Configuration::PASSWORD_PATTERN_MAX,
                Configuration::PASSWORD_PATTERN_SHORT, $jsonData->password);

            /* password2 */
            $result['password2'] = $result['password'] ? (strcmp($jsonData->password, $jsonData->password2) == 0) : false;

            /* name */
            $result['name'] = $this->validateInput(Configuration::SLOVAK_PATTERN_MIN, Configuration::SLOVAK_PATTERN_MAX,
                Configuration::SLOVAK_PATTERN_SHORT, $jsonData->name, true);

            /* surname */
            $result['surname'] = $this->validateInput(Configuration::SLOVAK_PATTERN_MIN, Configuration::SLOVAK_PATTERN_MAX,
                Configuration::SLOVAK_PATTERN_SHORT, $jsonData->surname, true);

            $this->tryToCreateNewUser($jsonData, $result);

            return $this->json($result);
        }
        return $this->json(['response' => false]);
    }

    /**
     * Authorize action
     * @param string $action
     * @return bool
     */
    public function authorize(string $action)
    {
        // TODO autorrizacia vo vsetkych controlleroch
        if ($action == "registration")
        {
            return !($this->app->getAuth()->isLogged());
        }
        return true;
    }

    /**
     * @param $jsonData  original data, whose processed results are saved in $evaluated array
     * @param $evaluated array of processed inputs, each telling whether given input was typed correctly
     * @return void
     */
    private function tryToCreateNewUser($jsonData, $evaluated) : void
    {
        $allOk = true;
        foreach ($evaluated as $input)
        {
            if (!$input)
                $allOk = false;
        }

        if ($allOk)
        {
            $newUser = new User();
            $newUser->setLogin($jsonData->login);
            $newUser->setRealName($jsonData->name);
            $newUser->setRealSurname($jsonData->surname);
            $newUser->setCreated(date('Y-m-d h:i:s'));
            $newUser->setPasswordHash(password_hash($jsonData->password, PASSWORD_DEFAULT));
            $newUser->setRole('user');
            $newUser->save();

            $this->app->getAuth()->login($jsonData->login, $jsonData->password);
        }
    }

    private function validateInput(int $min, int $max, string $pattern, $suspectedValue, bool $utf8 = false) : bool
    {
        $strLength = strlen($suspectedValue);
        if ($strLength < $min || $strLength > $max)
            return false;
        else
        {
            $wholePattern = '/' . $pattern . "{" . $strLength . '}/';
            if ($utf8)
                $wholePattern = $wholePattern . 'u';
            $match = preg_match($wholePattern, $suspectedValue);
            return (($match !== false) && $match === 1);;
        }
    }
}