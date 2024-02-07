<?php

namespace App\Form\User\Current\Personal;

use App\Entity\User;
use App\Form\Field\EasyVowsImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Nom',
                ],
                'required' => true,
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Numéro de téléphone',
                ],
            ])
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
        ]);
    }
}
