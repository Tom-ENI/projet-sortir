<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ProfilType;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function home(ParticipantRepository $repo): Response
    {
        return $this->render('profil/home.html.twig', [
            'data' => $repo->find($this->getUser()->getId())
        ]);
    }

    /**
     * @Route("/profil/edit/{p}", name="edit_profil", methods={"GET","POST"})
     */
    public function edit(Participant $p, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProfilType::class, $p);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->renderForm('profil/edit.html.twig', [
             'form' => $form,
             'data' => $p
        ]);
    }
}
