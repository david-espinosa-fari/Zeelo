<?php


namespace App\Item\Aplication;


use App\Item\Domain\IItemsRepository;

class RemoveItemById
{
    private IItemsRepository $repo;

    public function __construct(IItemsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(string $itemId): void
    {
        $this->repo->removeItemById($itemId);
    }
}