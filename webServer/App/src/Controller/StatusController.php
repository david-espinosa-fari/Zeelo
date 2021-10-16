<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/status", name="status", methods={"GET"})
     */
    public function index(): Response
    {
        $jsonResponse = new JsonResponse(['Message' => 'Status OK, you are good to go'], 200,
            array(
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
            ));

        $jsonResponse->setEncodingOptions(400);
        return $jsonResponse;
    }
}
