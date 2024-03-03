<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductBill;
use App\Repository\ProductRepository;
use App\Service\Product\AccessibleProductService;
use Symfony\Component\Form\AbstractType;
use App\Form\Field\ProductAutocompleteField;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductBillType extends AbstractType
{
    public function __construct(
        private readonly AccessibleProductService $accessibleProductService,
    )
    {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'label' => 'Choisissez un produit',
                'query_builder' => $this->accessibleProductService->findAll(),
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'currency' => null,
                'attr' => [
                    'placeholder' => 'Prix',
                ],
                'rounding_mode' => \NumberFormatter::ROUND_HALFUP,
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'placeholder' => 'Entrez la quantité',
                ],
            ])
            ->add('tva', NumberType::class, [
                'label' => 'TVA (%)',
                'attr' => [
                    'placeholder' => 'TVA (%)',
                ],
                'required' => false,
            ])
            ->add('discount', NumberType::class, [
                'label' => 'Remise (%)',
                'attr' => [
                    'placeholder' => 'Remise (%)',
                ],
                'required' => false,
            ])
            ->add('total', MoneyType::class, [
                'label' => 'Total',
                'currency' => null,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Total',
                    'disabled' => 'disabled',
                ],
                'rounding_mode' => \NumberFormatter::ROUND_HALFUP,
                'mapped' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductBill::class,
        ]);
    }
}
