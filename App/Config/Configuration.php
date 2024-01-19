<?php

namespace App\Config;

use App\Auth\DummyAuthenticator;
use App\Core\ErrorHandler;

/**
 * Class Configuration
 * Main configuration for the application
 * @package App\Config
 */
class Configuration
{
    /** App name */
    public const APP_NAME = 'Obecná knižnica Teplička nad Váhom';
    public const DEFAULT_PICTURE = "default-picture.png";
    public const FW_VERSION = '2.2';
    public const UNI_SLOVAK_LETTERS = "\u{C1}\u{C4}\u{C9}\u{CD}\u{D3}\u{D4}\u{DA}\u{DD}\u{E1}\u{E4}\u{E9}\u{ED}\u{F3}\u{F4}\u{FA}\u{FD}\u{10C}\u{10D}\u{10E}\u{10F}\u{139}\u{13A}\u{13D}\u{13E}\u{147}\u{148}\u{154}\u{155}\u{160}\u{161}\u{164}\u{165}\u{17D}\u{17E}";
    /**
     * DB settings
     */
    public const DB_HOST = 'db';  // see docker/docker-compose.yml
    public const DB_NAME = 'vaiicko_db'; // see docker/.env
    public const DB_USER = 'vaiicko_user'; // see docker/.env
    public const DB_PASS = 'dtb456'; // see docker/.env

    /**
     * URL where main page logging is. If action needs login, user will be redirected to this url
     */
    public const LOGIN_URL = '?c=auth&a=login';
    /**
     * Prefix of default view in App/Views dir. <ROOT_LAYOUT>.layout.view.php
     */
    public const ROOT_LAYOUT = 'root';
    /**
     * Add all SQL queries after app output
     */
    public const SHOW_SQL_QUERY = true;

    /**
     * Show detailed stacktrace using default exception handler. Should be used only for development.
     */
    public const SHOW_EXCEPTION_DETAILS = true;
    /**
     * Class used as authenticator. Must implement IAuthenticator
     */
    public const AUTH_CLASS = DummyAuthenticator::class;
    /**
     * Class used as error handler. Must implement IHandleError
     */
    public const ERROR_HANDLER_CLASS = ErrorHandler::class;
}
