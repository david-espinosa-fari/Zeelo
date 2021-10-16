<?php


namespace App\Item\Aplication;


use App\Item\Domain\IItemsRepository;
use App\Item\Domain\Item;

class CreateItem
{
    private IItemsRepository $repo;

    public function __construct(IItemsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(Item $item): void
    {
        $this->repo->createItem($item);
    }
}