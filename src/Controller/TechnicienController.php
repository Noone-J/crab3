<?php

namespace App\Controller;

use App\Entity\Technicien;
use App\Repository\TechnicienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TechnicienController extends AbstractController
{
    #[Route('/technicien', name: 'app_technicien')]
    public function index(): Response
    {
        return $this->render('technicien/index.html.twig', [
            'controller_name' => 'TechnicienController',
        ]);
    }

    #[Route('/technicien/create', name: 'app_technicien_create')]
    public function creerTechnicien(EntityManagerInterface $entityManager): Response
    {
        $technicien = new Technicien();

        $technicien->setNom('Disney');
        $technicien->setPrenom('riri');

        $entityManager->persist($technicien);
       $entityManager->flush();

       return new Response('technicien créé avec succès : ' . 
       $technicien->getNom() ." ".$technicien->getPrenom());

    }
    #[Route('/technicien/create2', name: 'app_technicien_create2')]
    public function creerTechnicien2(EntityManagerInterface $entityManager): Response
    {
        $technicien = new Technicien();

        $technicien->setNom('Disney');
        $technicien->setPrenom('riri');

        $entityManager->persist($technicien);
       $entityManager->flush();

         // Passer la station à la vue
    return $this->render('technicien/untechnicien.html.twig', [
        'technicien' => $technicien,
    ]);

    }

    #[Route('/technicien/liste', name: 'app_technicien_liste')]
    public function lister(TechnicienRepository $technicienRepository ,EntityManagerInterface $entityManager): Response
    {
          // Récupérer tous les techniciens depuis la base de données
    $techniciens = $technicienRepository->findAll();
        

         // Passer la station à la vue
    return $this->render('technicien/destechniciens.html.twig', [
        'techniciens' => $techniciens,
    ]);

    }
}
