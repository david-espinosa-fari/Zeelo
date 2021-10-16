<?php


namespace App\Tests\Item\Infrastructure;


use App\Item\Domain\Exceptions\ItemRepositoryError;
use App\Item\Domain\IItemsRepository;
use App\Item\Domain\Item;
use App\Item\Infrastructure\ItemsRepositoryMysql;

class FakeItemRepo implements IItemsRepository
{

    public function removeItem(string $itemId): void
    {
        //return nothing
    }

    public function createTable(): void
    {

    }

    public function createItem(Item $item): void
    {
    }

    public function findItems(int $count, int $offset): array
    {

        $items[] = new Item
        (
            '52d83165-20e7-42cd-b8ad-ef2660a56233',
            '/someLink',
            '/someTitle'
        );
        $items[] = new Item
        (
            '8470de28-809d-4752-ab9e-12213889d615',
            '/someLink2',
            '/someTitle2'
        );

        return $items;
    }
}