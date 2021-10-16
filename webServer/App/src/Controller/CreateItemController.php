<?php

namespace App\Controller;

use App\Item\Aplication\CreateItem;
use App\Item\Domain\Exceptions\ExceptionCatalogI;
use App\Item\Domain\Item;
use App\Item\Infrastructure\ItemsRepositoryMysql;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CreateItemController extends AbstractController
{
    /**
     * @Route("/api/v1/items", name="create_item", methods={"POST"})
     * @param Request $request
     * @param UrlGeneratorInterface $router
     * @return JsonResponse
     */
    public function index(Request $request, UrlGeneratorInterface $router): JsonResponse
    {
        try{
            $id = $request->get('id');
            $title = $request->get('title');
            $link = $router->generate('create_item').'/'.$id;

            $item = new Item($id, $link, $title);
            $create = new CreateItem(ItemsRepositoryMysql::getInstance());
            $create($item);

            $jsonResponse = new JsonResponse(['Message' => 'Item created successfully'], 200,
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
