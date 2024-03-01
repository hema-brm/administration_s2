<?php
// ProductQuoteType.php
namespace App\Form;

use App\Form\Field\ProductAutocompleteField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Product;
use App\Entity\ProductBill;

class ProductBillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'label' => 'Choisissez un produit',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'currency' => null,
                'attr' => [
                    'placeholder' => 'Prix',
                ],
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
