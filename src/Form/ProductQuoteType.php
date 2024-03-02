<?php
// ProductQuoteType.php
namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductQuote;
use App\Repository\ProductRepository;
use Symfony\Component\Form\AbstractType;
use App\Form\Field\ProductAutocompleteField;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductQuoteType extends AbstractType
{
public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'label' => 'Choisissez un produit',
'query_builder' => function (ProductRepository $productRepository) {
                    if(in_array('ROLE_ADMIN',$this->security->getUser()->getRoles())){
                        return $productRepository->createQueryBuilder('p');
                    }else{
                        return $productRepository->createQueryBuilder('p')
                            ->where('p.company = :company')
                            ->setParameter('company', $this->security->getUser()->getCompany());
                    }
                },
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
