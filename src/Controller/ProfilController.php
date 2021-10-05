<?php

namespace App\Controller;

use App\Form\ProfilType;
use App\Repository\ParticipantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function home(ParticipantsRepository $repo): Response
    {
        //get id user
        $userId = 1;
        $data = $repo->find($userId);
        return $this->render('profil/home.html.twig', [
            'data' => $data
        ]);
    }

    /**
     * @Route("/profil/edit", name="edit")
     */
    public function edit(): Response
    {
        $form = $this->createForm(ProfilType::class);


        return $this->renderForm('profil/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
