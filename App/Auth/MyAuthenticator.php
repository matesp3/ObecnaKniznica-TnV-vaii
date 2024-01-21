<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

class MyAuthenticator implements IAuthenticator
{
    public function __construct()
    {
        session_start();
    }

    /** Login must exist in database. If this is true, input password is verified and answer is returned. (if everything
     * is OK, new session is created.
     * @param $login
     * @param $password
     * @return bool
     */
    public function login($login, $password) : bool
    {
        if (!$login || !$password) // cannot be null
            return false;

        $retrieved = User::getUserByLogin($login);
        if (!$retrieved)  // no such login
            return false;

//        if (strcmp($password, $retrieved->getPasswordHash()) == 0)
        if (password_verify($password, $retrieved->getPasswordHash()))
        {
            $_SESSION['user'] = $login;
            return true;
        }
        return false;
    }

    public function logout() : void
    {
        if ($_SESSION['user'] ?? null)
        {
            unset($_SESSION['user']);
            session_destroy();
        }
    }
    /**
     * Get the name of the logged-in user
     * @return string
     * @throws \Exception
     */
    public function getLoggedUserName(): string
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : throw new \Exception("User not logged in");
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    /**
     * Return the id of the logged-in user
     * @return mixed
     */
    public function getLoggedUserId(): mixed
    {
        return $this->getLoggedUserContext()?->getId();
    }

    /**
     * Get the context of the logged-in user
     * @return string
     */
    public function getLoggedUserContext(): mixed
    {
        return User::getUserByLogin($_SESSION['user']);
    }
}