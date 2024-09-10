<?php

namespace App\Controller;

use App\Entity\Station;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StationController extends AbstractController
{
    #[Route('/station', name: 'app_station')]
    public function index(): Response
    {
        return $this->render('station/index.html.twig', [
            'controller_name' => 'StationController',
        ]);
    }
    #[Route('/station/voirunestation', name: 'app_station_voir')]
    public function voirUneStation(EntityManagerInterface $entityManager): Response
    {
       $maStation = new Station();
       $maStation->setLibelleEmplacement('Station Paris 12');

       // Sauvegarder la station dans la base de données
       $entityManager->persist($maStation);
       $entityManager->flush();

       return new Response('Station créée avec succès : ' . 
       $maStation->getLibelleEmplacement());

    }

}
