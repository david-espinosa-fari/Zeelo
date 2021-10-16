<?php


namespace App\Item\Aplication;


use App\Item\Domain\IItemsDetailsRepository;
use App\Item\Domain\IItemsRepository;
use App\Item\Domain\ItemDetails;

class RetrieveItemsDetailsById
{
    private IItemsDetailsRepository $repo;

    public function __construct(IItemsDetailsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(string $itemId): ItemDetails
    {
        return $this->repo->retrieveItemDetails($itemId);
    }
}