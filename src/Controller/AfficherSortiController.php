<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Repository\ParticipantsRepository;
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
        $participant = $this->getDoctrine()
            ->getRepository(Participants::class)
            ->find(1);

        return $this->render('afficher_sorti/index.html.twig', [
            'controller_name' => 'AfficherSortiController',
            'participant' => $participant,
        ]);
    }
}
