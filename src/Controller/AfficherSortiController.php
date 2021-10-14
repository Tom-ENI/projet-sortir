<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Sortie;
use App\Entity\Participant;
use App\Repository\SortieRepository;
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
                ->getRepository(Sortie::class)
                ->findAll();
        }

        $participant = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->find($this->getUser()->getId());


        $sites = $this->getDoctrine()
            ->getRepository(Site::class)
            ->findAll();


        return $this->render('afficher_sorti/index.html.twig', [
            'controller_name' => 'AfficherSortiController',
            'participant' => $participant,
            'sorties' => $sorties,
            'sites' => $sites,
        ]);
    }
}
