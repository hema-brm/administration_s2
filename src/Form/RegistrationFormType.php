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
            'required' => true,
        ])
        ->add('password', PasswordType::class, [
            'label' => 'Mot de passe',
            'required' => true,
        ])
        ->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'required' => true,
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Nom',
            'required' => true,
        ])
        ->add('phoneNumber', TextType::class, [
            'label' => 'Numéro de téléphone',
        ])
        ->add('company', TextType::class, [
            'label' => 'Entreprise',
            'required' => true,
            'mapped' => false,
        ])
        ->add('address', TextType::class, [
            'label' => 'Adresse de l\'entreprise',
            'mapped' => false,
        ])
        ->add('siretNumber', TextType::class, [
            'label' => 'Numéro de SIRET',
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
