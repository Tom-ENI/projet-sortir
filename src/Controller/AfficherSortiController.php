<?php

namespace App\Controller;

use DateTime;
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
    public function index(Request $request): Response
    {

        // rediction de  Kevin 
        if ($this->getUser()) {

            return $this->redirectToRoute("afficher_sorti");
        } else {

            return $this->redirectToRoute("app_login");
        }


        // code de Ryad 

        /**
         * @Route("/sorti", name="afficher_sorti")
         */


        $nom = $request->request->get('nom');
        $date1 = $request->request->get('date1');
        $date2 = $request->request->get('date2');
        $site = $request->request->get('site');

        if ($site == null) {
            $site = 1;
        }

        if ($date1 == "") {
            $date1 = "2000-01-01";
            $date2 = "2100-01-01";
        }


        $date = $this->date = new DateTime();

        if ($request->isMethod('POST')) {
            $sorties = $this->getDoctrine()
                ->getRepository(Sortie::class);
            // à ajoute stpl 
            //->findByNom($nom, $date1, $date2, $site);

            $participant = $this->getDoctrine()
                ->getRepository(Participant::class)
                ->find(1);

            $sites = $this->getDoctrine()
                ->getRepository(Site::class)
                ->findAll();
        } else {

            $participant = $this->getDoctrine()
                ->getRepository(Participant::class)
                ->find(1);

            $sorties = $this->getDoctrine()
                ->getRepository(Sortie::class)
                ->findAll();

            $sites = $this->getDoctrine()
                ->getRepository(Site::class)
                ->findAll();
        }

        return $this->render('afficher_sorti/index.html.twig', [
            'controller_name' => 'AfficherSortiController',
            'participant' => $participant,
            'sorties' => $sorties,
            'sites' => $sites,
            'date' => $date,
        ]);
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
