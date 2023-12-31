<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\State;
use App\Entity\User;
use App\Repository\StateRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('numberRentalDay')
            ->add('totalCost')
            ->add('customer', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'firstname',
            ])
            ->add('Reserver', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
