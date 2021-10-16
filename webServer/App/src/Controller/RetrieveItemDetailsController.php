<?php

namespace App\Controller;

use App\Item\Aplication\RetrieveItemsDetailsById;
use App\Item\Domain\Exceptions\ExceptionCatalogI;
use App\Item\Infrastructure\ItemDetailRepositoryMysql;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RetrieveItemDetailsController extends AbstractController
{
    /**
     * @Route("/api/v1/items/{itemId}", name="retrieve_item_details", methods={"GET"})
     * @param string $itemId
     * @return Response
     */
    public function index(string $itemId): Response
    {
        try{
            $dbRepo = ItemDetailRepositoryMysql::getInstance();
            $finder = new RetrieveItemsDetailsById($dbRepo);
            $itemDetail = $finder($itemId);

            return new JsonResponse($itemDetail->getItemDetailsAsArray(), 200,
                array(
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'ZEELO_CATALOG',
                    'Access-Control-Allow-Origin' => '*',
                ));

        } catch (ExceptionCatalogI $e) {
            return new JsonResponse($e->getMessage(), $e->getCode(),
                array(
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'ZEELO_CATALOG',
                    'Access-Control-Allow-Origin' => '*',
                ));
        }


    }
}
