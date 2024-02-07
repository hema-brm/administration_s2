<?php

namespace App\Form\User\Employee;

use App\Entity\Employee;
use App\Entity\User;
use App\Form\Field\CompanyAutocompleteField;
use App\Form\Field\EasyVowsImageType;
use App\Security\Roles\IUserRole;
use App\Util\Role\RoleLabel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class EmployeeType extends AbstractType
{
    public const ADD = 'add';
    public const EDIT = 'edit';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName', TextType::class, [
            'required' => true,
            'label' => 'Prénom',
            'attr' => [
                'placeholder' => 'Entrez le prénom',
            ],
        ])
        ->add('lastName', TextType::class, [
            'required' => true,
            'label' => 'Nom',
            'attr' => [
                'placeholder' => 'Entrez le nom',
            ],
        ])
        ->add('email', EmailType::class, [
            'required' => true,
            'label' => 'Adresse email',
            'attr' => [
                'placeholder' => 'Entrez l\'adresse email',
            ],
        ])
        ->add('phoneNumber', TextType::class, [
            'required' => true,
            'label' => 'Numéro de téléphone',
            'attr' => [
                'placeholder' => 'Entrez le numéro de téléphone',
            ],
        ]);

        $showPasswordField = ($options['mode'] === self::ADD);

        if ($showPasswordField) {
            $builder
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Entrez le mot de passe',
                ],
            ]);
        }

        $choices = [
            (new RoleLabel(IUserRole::ROLE_COMPANY))->get() => RoleLabel::ROLE_COMPANY,
            (new RoleLabel(IUserRole::ROLE_EMPLOYEE))->get() => RoleLabel::ROLE_EMPLOYEE,
            (new RoleLabel(IUserRole::ROLE_ACCOUNTANT))->get() => RoleLabel::ROLE_ACCOUNTANT,
        ];

        $builder
        ->add('roles', ChoiceType::class, [
            'required' => true,
            'choices' => $choices,
            'label' => 'Rôles',
            'attr' => [
                'placeholder' => 'Veuillez choisir les rôles',
            ],
            'multiple' => true,

        ]);

        if (true === $options['is_admin']) {
            $builder
                ->add('company', CompanyAutocompleteField::class, [
                    'required' => true,
                    'label' => 'Entreprise',
                    'attr' => [
                        'placeholder' => 'Entrez le nom de l\'entreprise',
                        'wrapper' => 'compact',
                    ],
                ]);
        }

        $builder
        ->add('pictureFile', EasyVowsImageType::class, [
            'required' => false,
            'allow_delete' => true,
            'download_uri' => false,
            'attr' => [
                'pickerText' => 'Importer',
            ],
            'label' => 'Photo de profil',
            'delete_label' => 'Supprimer la photo',
            'image_preview_class' => [
                'max-h-40',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'mode' => self::ADD,
            'is_admin' => false,
            'upload_directory' => '',
            'asset' => '',
        ]);
    }
}
