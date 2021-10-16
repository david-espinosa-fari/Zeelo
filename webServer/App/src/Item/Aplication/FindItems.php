<?php


namespace App\Item\Aplication;


use App\Item\Domain\IItemsRepository;

class FindItems
{
    private IItemsRepository $repo;

    public function __construct(IItemsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(int $count, int $offset): array
    {
        return $this->repo->findItems($count, $offset);
    }
}