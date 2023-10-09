<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Vehicul;
use App\Form\CarType;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


    #[Route('/reservation/vehicul/{id}', name: 'app_reservation_car')]
    public function detail(EntityManagerInterface $em, int $id, Request $request): Response
    {
        $carR = $em->getRepository(vehicul::class)->find($id);

        $form = $this->createForm(ReservationType::class, $carR);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $carR = $form->getData();

            $em->flush();

            return $this->redirectToRoute("app_vehicul", ["id" =>
                $carR->getId()
            ]);
        }
        return $this->render('reservation/index.html.twig', [
            'vehicule' => $carR,
        ]);
    }
}
