<?php

namespace App\Controller;

use App\Entity\Sorties;
use App\Form\AjouterSortieType;
use App\Repository\EtatsRepository;
use App\Repository\LieuxRepository;
use App\Repository\ParticipantsRepository;
use App\Repository\SortiesRepository;
use App\Repository\VillesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjouterSortiController extends AbstractController
{
    /**
     * @Route("/ajouter/sorti", name="ajouter_sorti")
     */
    public function ajouter(Request $request, VillesRepository $villeRepo, EtatsRepository $etatsRepo, LieuxRepository $lieuRepo, EntityManagerInterface $em, ParticipantsRepository $participantsRepository): Response
    {
        $sorti = new Sorties();
        $sorti->setOrganisateur($participantsRepository->find($this->getUser()->getNoParticipant()));
        $sorti->setEtatsNoEtat($etatsRepo->find(1));
        $sorti->setLieuxNoLieu($lieuRepo->find(1));
        $form = $this->createForm(AjouterSortieType::class, $sorti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($sorti);
            $em->flush();

            return $this->redirectToRoute('afficher_sorti');
        }

        return $this->render('ajouter_sorti/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/annuler/sorti", name="annuler_sorti")
     */
    public function annuler(EntityManagerInterface $em, SortiesRepository $sr): Response
    {
        $sorti = $sr->find();
        $sorti->setEtatsNoEtat();
        $em->persist($sorti);
        $em->flush();

        return $this->redirectToRoute('afficher_sorti');
    }


    /**
     * @Route("/detail/{id}/sorti", name="detail_sorti", requirements={"id"="\d+"})
     */
    public function detail($id, SortiesRepository $sr): Response
    {
        $sorti = $sr->find($id);

        return $this->render('detail_sorti/detail.html.twig', [
            'sorti' => $sorti,
        ]);
    }
}
