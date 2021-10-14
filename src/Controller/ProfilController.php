<?php

namespace App\Controller;

use App\Form\ProfilType;
use App\Repository\ParticipantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function home(ParticipantsRepository $repo): Response
    {
        $data = $repo->find($this->getUser()->getNoParticipant());
        return $this->render('profil/home.html.twig', [
            'data' => $data
        ]);
    }

    /**
     * @Route("/profil/edit", name="edit_profil", methods={"GET","POST"})
     */
    public function edit(ParticipantsRepository $repo, Request $request): Response
    {
        $data = $repo->find($this->getUser()->getNoParticipant());

        $form = $this->createForm(ProfilType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('profil/edit.html.twig', [
             'form' => $form->createView(),
             'data' => $data,
        ]);
    }
}
