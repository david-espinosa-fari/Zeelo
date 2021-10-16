<?php

namespace App\Controller;

use App\Item\Aplication\FindItems;
use App\Item\Domain\Exceptions\ExceptionCatalogI;
use App\Item\Infrastructure\ItemsRepositoryMysql;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetItemsController extends AbstractController
{
    /**
     * @Route("/api/v1/items", name="get_items", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $count = $request->query->get('count') ?? $_ENV['DEFAULT_QUERY_LIMIT'];
        $offset = $request->query->get('offset') ?? $_ENV['DEFAULT_QUERY_OFFSET'];

        try {
            $db = ItemsRepositoryMysql::getInstance();

            $finder = new FindItems($db);
            $itemsList = $finder($count, $offset);

            $counter = count($itemsList);

            for ($i = 0; $i < $counter; $i++) {
                $itemsResponse[] = $itemsList[$i]->getItemAsArray();
            }

            $jsonResponse = new JsonResponse($itemsResponse, 200,
                array(
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'ZEELO_CATALOG',
                    'Access-Control-Allow-Origin' => '*',

                ));

            $jsonResponse->setEncodingOptions(400);
            return $jsonResponse;
        } catch (ExceptionCatalogI $e) {
            return new JsonResponse(['Message' => $e->getMessage()], $e->getCode(),
                array(
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'ZEELO_CATALOG',
                    'Access-Control-Allow-Origin' => '*',
                ));
        }

    }
}
