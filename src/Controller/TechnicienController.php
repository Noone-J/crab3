<?php

namespace App\Controller;

use App\Entity\Technicien;
use App\Entity\Visite;
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

    #[Route('/technicien/creervisite', name: 'app_technicien_creer_visite')]
    public function creerVisite(EntityManagerInterface $entityManager): Response
    {
        // Création de l'objet technicien
        $technicien = new Technicien();
        $technicien->setNom('technicien 01');
        $technicien->setPrenom('Robert');

        // Persister le technicien
        $entityManager->persist($technicien);

         // Les états des visites
         $etats = ['en attente', 'en cours', 'terminé'];

        for ($i = 1; $i <= 3; $i++) {
            $visite = new Visite();
            $visite->setEtat($etats[$i]); // Assignation de l'état spécifique à chaque visite
            $visite->setDureeTotale(60);  // Exemple de durée

            // Assigner la visite au technicien
            $visite->setLeTechnicien($technicien);

            // Ajouter la visite à la collection de visites du technicien
            $technicien->addLesVisite($visite);

            // Persister la visite
            $entityManager->persist($visite);
        }

        // Flusher pour enregistrer dans la base de données
        $entityManager->flush();

        return new Response("Technicien et 3 visites créés avec succès.");



    }
}
