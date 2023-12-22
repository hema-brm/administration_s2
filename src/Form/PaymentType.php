<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Bill;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Terminé' => 'terminé',
                    'En Retard' => 'en retard',
                    'En Cours' => 'en cours',
                ],
                'label' => 'Status du paiement', 
            ])
            ->add('moyen', ChoiceType::class, [
                'choices' => [
                    'Carte bancaire' => 'cb',
                    'Espèces' => 'especes',
                    'Chèque' => 'cheques',
                    'Virement bancaire' => 'vb',
                ],
                'label' => 'Moyen de paiement', 
            ])
            ->add('datePaiement', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateEcheance', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('bill', EntityType::class, [
                'class' => Bill::class,
                'choice_label' => 'nomClient', 
                'label' => 'Client',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
