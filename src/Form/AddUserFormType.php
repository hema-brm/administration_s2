<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Entreprise;
use App\Security\Roles\IUserRole;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class AddUserFormType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => IUserRole::ROLE_ADMIN,
                    'Entreprise' => IUserRole::ROLE_COMPANY,
                    'Comptable' => IUserRole::ROLE_ACCOUNTANT,
                ],
                'label' => 'Role',
                'multiple' => true,
            ])
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'label' => 'Entreprise',
                'data' => $options['entreprise'],
                'disabled' => true,
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'entreprise' => null,
        ]);
    }
}

