<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\SecurityBundle\Security;
use App\Security\Roles\IUserRole;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Company;


class CategoryType extends AbstractType
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la catégorie',
                'required'    => true
            ]);
            if ($this->security->isGranted(IUserRole::ROLE_ADMIN)) {
                $builder
                    ->add('company', EntityType::class, [
                        'class' => Company::class,
                        'label' => 'Entreprise',
                        'required' => true,
                        'autocomplete' => true,
                    ]);
            }
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}