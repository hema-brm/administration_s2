<?php

namespace App\Form;

use App\Entity\Bill;
use App\Form\Field\CustomerAutocompleteField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Customer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Form\ProductQuoteType;
use App\Form\ProductBillType;

class BillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer', CustomerAutocompleteField::class, [
                'label' => 'Client',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Client',
                    'wrapper' => 'compact',
                ],
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status de la facture:',
                'choices' => [
                    'Validé' => 'validée',
                    'En attente' => 'en attente',
                    'Refusé' => 'refusée',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('numeroFacture', IntegerType::class, [
                'label' => 'N° de la facture: ',
                'attr' => [
                    'placeholder' => 'Entrez le numéro de la facture',
                ],])
            ->add('discount', IntegerType::class, [
                'label' => 'Remise: ',
                'attr' => [
                    'placeholder' => 'Entrez la remise',
                ],])
            ->add('tva', IntegerType::class, [
                'label' => 'TVA: ',
                'attr' => [
                    'placeholder' => 'Entrez la TVA',
                ],])
            ->add('productBills', CollectionType::class, [
                'entry_type' => ProductBillType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('billIssuanceDate', DateType::class, [
                'label' => 'Date d\'émission de la facture: ',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Entrez la date d\'émission de la facture',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bill::class,
        ]);
    }
}
