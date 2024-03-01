<?php

namespace App\Form;

use App\Entity\Bill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BillPeriodBetweenDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de début',
                ],
                'mapped' => false,
            ])
            ->add('end', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de fin',
                ],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
        ]);
    }
}
