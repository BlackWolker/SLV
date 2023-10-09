<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Quiz;
use App\Entity\Type;
use App\Entity\Vehicul;
use App\Form\CarType;
use App\Form\NewCarType;
use App\Form\QuizType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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

//    #[Route('/vehicul/{id}', name: 'app_vehicul_detail')]
//    public function detail(EntityManagerInterface $entityManager, int $id): Response
//    {
//        $car = $entityManager->getRepository(vehicul::class)->find($id);
//        return $this->render('vehicul/detail.html.twig', [
//            'vehicul' => $car,
//        ]);
//    }

    #[Route('/vehicul/new', name: 'app_vehicul_new')]
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $newVehicul = new Vehicul();

        $form = $this->createForm(CarType::class, $newVehicul);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newVehicul = $form->getData();
            $em->persist($newVehicul);
            $em->flush();

            return $this->redirectToRoute("app_vehicul", ["id" =>
                $newVehicul->getId()
            ]);
        }

        return $this->render('vehicul/new.html.twig', [
            'form' => $form
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

            return $this->redirectToRoute("app_vehicul", ["id" =>
                $vUpdate->getId()
            ]);
        }

        return $this->render('vehicul/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/vehicul/delete/{id}', name: 'app_vehicul_delete')]
    public function delete(int $id, EntityManagerInterface $em, Request $request): Response
    {

        $delete = $em->getRepository(Vehicul::class)->find($id);
        $em->remove($delete);
        try {
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression effectuée'
            );
        } catch (\Exception $ex) {
            $this->addFlash(
                'danger',
                'Suppresion impossible'
            );
        }


        return $this->redirectToRoute("app_vehicul");

    }

}
