<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Vehicul;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        //pour les Marques

        $brands = [
            "lamb",
            "BMW",
            "chevrolet",
        ];

        //Pour Image
        $pictures = [
            "./image/image1.jpeg",
            "./image/image2.jpeg",
            "./image/image3.jpeg",
        ];

        //pour les Models
        $models = [
            "Mercedes-Benz",
            "Fiat",
            "Ford",
        ];


        //Pour les types

        $types = [
            "coupes",
            "berlines",
            "crossovers",
        ];

        //Role Admin
        $user = new User();
        $user->setFirstName('toto');
        $user->setLastName('admin');
        $user->setAdress('csf');
        $user->setDrivingLicence('adminDrivingLicence');

        $user->setEmail('admin@admin.com');
        $user->setRoles(["ROLE_ADMIN"]);
        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        //Role Client
        $user2 = new User();
        $user2->setFirstName('tata');
        $user2->setLastName('client');
        $user2->setAdress('csf');
        $user2->setDrivingLicence('clientDrivingLicence');

        $user2->setEmail('client@client.com');
        $user2->setRoles(["ROLE_CLIENT"]);
        $password = $this->hasher->hashPassword($user2, 'password');
        $user2->setPassword($password);

        $manager->persist($user2);

        foreach ($brands as $key => $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $manager->persist($brand);


            $model = new Model();
            $model->setBrand($brand);
            $model->setName($models[$key]);
            $manager->persist($model);


            $type = new Type();
            $type->setName($types[$key]);
            $manager->persist(($type));



            //Pour les vehicules
            $vehicul  = new Vehicul();
            $vehicul->setCapacity(rand(1,6));
            $vehicul->setNumberPlate(rand(51455,78952));
            $vehicul->setPrice(rand(10000,50000));
            $vehicul->setYearOfCar(rand(5,10));
            $vehicul->setNumberKilometers(rand(325,526));
            $vehicul->setModel($model);
            $vehicul->setPicturePath($pictures[$key]);

            $vehicul->setType($type);
            $manager->persist($vehicul);

        }




        $manager->flush();
    }
}
