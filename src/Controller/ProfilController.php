<?php

namespace App\Controller;

use App\Form\ProfilType;
use App\Repository\ParticipantRepository;
use App\Repository\ParticipantsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function home(ParticipantRepository $repo): Response
    {
        //get id user in session
        $userId = 1;
        $data = $repo->find($userId);
        return $this->render('profil/home.html.twig', [
            'data' => $data
        ]);
    }

    /**
     * @Route("/profil/edit", name="edit_profil", methods={"GET","POST"})
     */
    public function edit(ParticipantRepository $repo, Request $request): Response
    {
        $userId = 1;
        $data = $repo->find($userId);

        $form = $this->createForm(ProfilType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirectToRoute('profil');
        }

        return $this->renderForm('profil/edit.html.twig', [
            'form' => $form,
            'data' => $data,
        ]);
    }
}
