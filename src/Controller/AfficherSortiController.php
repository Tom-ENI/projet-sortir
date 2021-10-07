<?php

namespace App\Controller;

use App\Entity\Lieux;
use App\Entity\Participants;
use App\Entity\Sites;
use App\Entity\Sorties;
use App\Repository\ParticipantsRepository;
use App\Repository\SitesRepository;
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

        $sorties = $this->getDoctrine()
            ->getRepository(Sorties::class)
            ->findAll();

        $sites = $this->getDoctrine()
            ->getRepository(Sites::class)
            ->findAll();

        return $this->render('afficher_sorti/index.html.twig', [
            'controller_name' => 'AfficherSortiController',
            'participant' => $participant,
            'sorties' => $sorties,
            'sites' => $sites,
        ]);
    }
}
