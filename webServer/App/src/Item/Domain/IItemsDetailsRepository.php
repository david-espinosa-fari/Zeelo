<?php


namespace App\Item\Domain;


interface IItemsDetailsRepository
{
    public function retrieveItemDetails(string $itemId): ItemDetails;
    public function createTable(): void;
}