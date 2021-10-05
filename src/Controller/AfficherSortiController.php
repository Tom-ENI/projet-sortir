<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherSortiController extends AbstractController
{
    /**
     * @Route("/afficher/sorti", name="afficher_sorti")
     */
    public function index(): Response
    {
        return $this->render('afficher_sorti/index.html.twig', [
            'controller_name' => 'AfficherSortiController',
        ]);
    }
}
