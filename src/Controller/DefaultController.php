<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
        #[Route('/default', name: 'app_default')]
    
    public function index(Request $requestObject): Response
    {

        // ...

        $page = $requestObject->query->get('page', 1);
        $page = $requestObject->query->getInt('page', 1);

        $clientIpAddress = $requestObject->server->get('REMOTE_ADDR');


        dump($page, $clientIpAddress);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    
        // Route pour gérer POST sur /api
    #[Route('/api', name: 'app_api', methods: ['POST'])]
    public function api(Request $requestObject): Response
    {
        // Afficher les données envoyées dans la requête POST
        dd(
            $requestObject->request->all(),  // Données envoyées dans un formulaire
            $requestObject->getPayload()     // Données JSON brutes (si envoyées)
        );

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    
    }}
