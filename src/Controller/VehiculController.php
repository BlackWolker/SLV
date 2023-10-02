<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Type;
use App\Entity\Vehicul;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculController extends AbstractController
{
    #[Route('/vehicul', name: 'app_vehicul')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vehicules = $entityManager->getRepository(Vehicul::class)->findAll();

        return $this->render('vehicul/index.html.twig', [
            'controller_name' => 'VehiculController',
            'vehicul' => $vehicules,
        ]);
    }

    #[Route('/vehicul/{id}', name: 'detail')]
    public function detail(EntityManagerInterface $entityManager, int $id): Response
    {
        $car = $entityManager->getRepository(vehicul::class)->find($id);
        return $this->render('vehicul/detail.html.twig', [
            'vehicule' => $car,
        ]);
    }

    #[Route('/vehicul/update/{id}', name: 'app_vehicul_update')]
    public function update(int $id, EntityManagerInterface $em, Request $request): Response
    {
        $vUpdate = $em->getRepository(Vehicul::class)->find($id);

        $form = $this->createForm(CarType::class, $vUpdate);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vUpdate = $form->getData();

            $em->flush();

            $this->addFlash(
                'success',
                'Modification du vehicul effectuée'
            );
            return $this->redirectToRoute("app_vehicul", ["id" =>
                $vUpdate->getId()
            ]);
        }

        return $this->render('vehicul/new.html.twig', [
            'form' => $form
        ]);
    }

}
