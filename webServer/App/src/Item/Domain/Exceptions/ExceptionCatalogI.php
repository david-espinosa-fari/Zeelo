<?php


namespace App\Item\Domain\Exceptions;


interface ExceptionCatalogI
{
    public function getMessage();
    public function getCode();
}