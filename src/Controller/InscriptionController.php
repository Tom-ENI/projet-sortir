<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Sortie;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/desister/{id}", name="desister")
     */
    public function index(InscriptionRepository $insc, EntityManagerInterface $em, Participant $pa, Sortie $sor): Response
    {

        $in = $insc->findBy(['sortie'=>$sor, 'participant'=>$this->getUser()]);
        foreach($in as $i){
            $em->remove($i);
        }

        $em->flush();

        return $this->redirectToRoute('afficher_sorti');
    }
    
}
