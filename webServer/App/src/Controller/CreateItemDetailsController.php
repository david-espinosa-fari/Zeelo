<?php

namespace App\Controller;

use App\Item\Aplication\FindItems;
use App\Item\Domain\ItemDetails;
use App\Item\Infrastructure\ItemsRepositoryMysql;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateItemDetailsController extends AbstractController
{
    /**
     * @Route("/api/v1/items/{itemId}/details, name="create_item_details", methods={"POST"})
     * @param string $itemId
     * @param Request $request
     * @return JsonResponse
     */
    public function index(string $itemId,Request $request): JsonResponse
    {
        /*try{
            //es solo para mostrar como seguiría el path para añadir detalles
            //con el itemId verificamos que el item exista y es el que le añadimos a ItemsDetails

        } catch (ExceptionCatalogI $e) {
            return new JsonResponse(['Message' => $e->getMessage()], $e->getCode(),
                array(
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'ZEELO_CATALOG',
                    'Access-Control-Allow-Origin' => '*',
                ));
        }*/
    }
}
