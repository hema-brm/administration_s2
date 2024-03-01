<?php
// ProductQuoteType.php
namespace App\Form;

use App\Form\Field\ProductAutocompleteField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\ProductQuote;
use App\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

class ProductQuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'label' => 'Choisissez un produit',
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'placeholder' => 'Quantité',
                ],
                'constraints' => [
                    new Assert\Positive([
                        'message' => 'La quantité doit être un nombre positif.'
                    ])
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'currency' => null,
                'attr' => [
                    'placeholder' => 'Prix',
                ],
                'constraints' => [
                    new Assert\GreaterThanOrEqual(
                        value: 0,
                        message: 'Le prix ne doit pas être négatif.'
                    ),
                ]
            ])
            ->add('tva', NumberType::class, [
                'label' => 'TVA (%)',
                'attr' => [
                    'placeholder' => 'TVA (%)',
                ],
                'required' => false,
            ])
            ->add('totalHT', MoneyType::class, [
                'label' => 'Total HT',
                'currency' => null,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Total HT',
                    'disabled' => 'disabled',
                ],
                'mapped' => false,
            ])
            ->add('total', MoneyType::class, [
                'label' => 'Total TTC',
                'currency' => null,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Total TTC',
                    'disabled' => 'disabled',
                ],
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductQuote::class,
        ]);
    }
}
