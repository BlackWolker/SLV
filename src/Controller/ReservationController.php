<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Vehicul;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservation = new reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

//        $reservations = $entityManager->getRepository($Reservation::class)->find();

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'form' => $form,
        ]);

    }


//    #[Route('/vehicul/{id}', name: 'reservation')]
//    public function detail(EntityManagerInterface $entityManager, int $id): Response
//    {
//        $car = $entityManager->getRepository(vehicul::class)->find($id);
//        return $this->render('reservation/index.html.twig', [
//            'vehicule' => $car,
//        ]);
//    }
}
