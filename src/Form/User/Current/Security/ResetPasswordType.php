<?php

namespace App\Form\User\Current\Security;

use App\Entity\User;
use App\Service\User\UserPasswordService;
use App\Validator\Constraint\ConfirmPassword;
use App\Validator\Constraint\CurrentPassword;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ResetPasswordType extends AbstractType
{
    public function __construct(
        private readonly UserPasswordService $userPasswordService,
        private readonly Security $security,
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Entrez le mot de passe',
                ],
                'constraints' => [
                    new CurrentPassword(payload: [
                        'user_before' => $options['user_before'],
                    ]),
                ],
                'mapped' => false,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Entrez le nouveau mot de passe',
                ],
                'constraints' => [
                    new ConfirmPassword(
                        payload: [
                            'field' => 'confirmPassword',
                        ],
                    ),
                ],
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmez le nouveau mot de passe',
                ],
                'constraints' => [
                    new ConfirmPassword(
                        payload: [
                            'field' => 'password',
                        ],
                    ),
                ],
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'user_before' => null,
        ]);
    }
}
