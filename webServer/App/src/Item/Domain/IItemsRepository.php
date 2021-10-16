<?php


namespace App\Item\Domain;


interface IItemsRepository
{
    public function createItem(Item $item): void;
    public function findItems(int $count, int $offset): array;
    public function removeItem(string $itemId): void;
    public function createTable(): void;

}