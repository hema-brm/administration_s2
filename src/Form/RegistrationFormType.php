<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => 'Adresse email',
            'attr' => [
                'placeholder' => 'Entrez l\'adresse email',
            ],
            'required' => true,
        ])
        ->add('password', PasswordType::class, [
            'label' => 'Mot de passe',
            'attr' => [
                'placeholder' => 'Entrez le mot de passe',
            ],
            'required' => true,
        ])
        ->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'attr' => [
                'placeholder' => 'Entrez votre prénom',
            ],
            'required' => true,
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Nom',
            'attr' => [
                'placeholder' => 'Entrez votre nom',
            ],
            'required' => true,
        ])
        ->add('phoneNumber', TextType::class, [
            'label' => 'Numéro de téléphone',
            'attr' => [
                'placeholder' => 'Entrez votre numéro de téléphone',
            ],
        ])
        ->add('company', TextType::class, [
            'label' => 'Entreprise',
            'required' => true,
            'mapped' => false,
            'attr' => [
                'placeholder' => 'Entrez le nom de votre l\'entreprise',
            ],
        ])
        ->add('address', TextType::class, [
            'label' => 'Adresse de l\'entreprise',
            'attr' => [
                'placeholder' => 'Entrez l\'adresse de votre entreprise',
            ],
            'mapped' => false,
        ])
        ->add('siretNumber', TextType::class, [
            'label' => 'Numéro SIRET',
            'attr' => [
                'placeholder' => 'Entrez le numéro SIRET de votre entreprise',
            ],
            'required' => true,
            'mapped' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
