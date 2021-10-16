<?php


namespace App\Item\Domain\Exceptions;


use Exception;

class ItemRepositoryError extends Exception implements ExceptionCatalogI
{
    private const EXCEPTION_NAME = 'ItemRepositoryError';

    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }

    public function __toString(): string
    {
        return self::EXCEPTION_NAME;
    }
}