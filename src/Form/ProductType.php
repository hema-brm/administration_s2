<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 2, 'max' => 25])],
                'help' => 'obligatoire',
            ])

            ->add('reference',TextType::class, [
                'constraints' => [new Length(['min' => 1, 'max' => 50])],
                'required'    => false,
                'help' => 'facultatif',
            ])

            ->add('description', TextareaType::class, [
                'constraints' => [new Length([ 'max' => 150])],
                'required'    => false,
                'help' => 'facultatif',
            ] )

            ->add('price', MoneyType::class, [
                'divisor' => 100,
                'required' => true,
                'help' => 'obligatoire',
            ])

            ->add('subCategories')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
