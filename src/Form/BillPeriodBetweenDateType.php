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
                'class' => 'form-control date-field', // Ajout de la classe date-field
                'style' => 'display: inline-block; width: auto; margin-right: 10px;', // Style CSS direct
            ],
            'mapped' => false,
        ])
        ->add('end', DateType::class, [
            'label' => false,
            'widget' => 'single_text',
            'attr' => [
                'placeholder' => 'Date de fin',
                'class' => 'form-control date-field', // Ajout de la classe date-field
                'style' => 'display: inline-block; width: auto; margin-right: 10px;', // Style CSS direct
            ],
            'mapped' => false,
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Rechercher',
            'attr' => [
                'class' => 'btn btn-primary', // Ajout de classes de bouton Bootstrap pour le style
                'style' => 'display: inline-block; width: auto;', // Style CSS direct
            ],
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
