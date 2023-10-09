<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Vehicul;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('capacity')
            ->add('price')
            ->add('numberPlate')
            ->add('yearOfCar')
            ->add('numberKilometers')
            ->add('picturePath')
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
            ])
            ->add('model', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'name',
            ])
            ->add('options')
            ->add('update', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicul::class,
        ]);
    }
}
