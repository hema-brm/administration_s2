<?php
//QuoteType.php
namespace App\Form;

use App\Entity\Quote;
use App\Entity\Product;
use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\ProductQuote;
use App\Form\ProductQuoteType;

class QuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('customer', EntityType::class, [
                'class' => Customer::class, 
                'label' => 'Client', 
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status du devis:',
                'choices' => [
                    'Validé' => 'validé',
                    'En attente' => 'en attente',
                    'Refusé' => 'refusé',
                ],
                'expanded' => true,
                'multiple' => false, 
            ])
            
            ->add('quote_number',TextType::class, [
                'label' => 'N° du devis: ',
                'attr' => [
                    'placeholder' => ' ',
            ],])
            ->add('quote_issuance_date')
            ->add('expiry_date')
            ->add('productQuotes', CollectionType::class, [
                'label' => 'Products',
                'entry_type' => ProductQuoteType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                 
            ])
            ->add('total_price')
            ->add('discount')
            ->add('tva');
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }
}
