<?php

namespace App\Controller;

use App\Entity\Lieux;
use App\Entity\Sites;
use App\Entity\Sorties;
use App\Entity\Participants;
use App\Repository\SitesRepository;
use App\Repository\SortieRepository;
use App\Repository\SortiesRepository;
use App\Repository\ParticipantsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AfficherSortiController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute("afficher_sorti");
        } else {
            return $this->redirectToRoute("app_login");
        }
    }

    /**
     * @Route("/sorti", name="afficher_sorti")
     */
    public function afficher_sorti(Request $request, SortieRepository $sr): Response
    {
        $nom = $request->request->get('nom');

        if ($request->isMethod('POST')) {
            $sorties = $sr->findByNom($nom);
        } else {
            $sorties = $this->getDoctrine()
                ->getRepository(Sorties::class)
                ->findAll();
        }

        $participant = $this->getDoctrine()
            ->getRepository(Participants::class)
            ->find($this->getUser()->getNoParticipant());


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
