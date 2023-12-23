<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CrudSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $action = $options['action'];
        $method = $options['method'];

        $builder
            ->add('search', SearchType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Recherche',
                ],
            ]);

        if (!empty($action)) {
            $builder->setAction($action);
        }

        if (!empty($method)) {
            $builder->setMethod($method);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'required' => false,
        ]);
    }
}
