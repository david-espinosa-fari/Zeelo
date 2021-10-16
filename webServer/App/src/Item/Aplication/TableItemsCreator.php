<?php


namespace App\Item\Aplication;


use App\Item\Domain\IItemsDetailsRepository;
use App\Item\Domain\IItemsRepository;

class TableItemsCreator
{
    /**
     * @var IItemsRepository
     */
    private $ItemRepo;
    /**
     * @var IItemsDetailsRepository
     */
    private $itemsDetailsRepo;

    public function __construct(IItemsRepository $ItemRepo, IItemsDetailsRepository $itemsDetailsRepo)
    {

        $this->ItemRepo = $ItemRepo;
        $this->itemsDetailsRepo = $itemsDetailsRepo;
    }

    public function __invoke(): void
    {
        $this->ItemRepo->createTable();
        $this->itemsDetailsRepo->createTable();
    }
}