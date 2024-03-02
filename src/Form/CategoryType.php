<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Category;
use App\Security\Roles\IUserRole;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use App\Form\Field\CompanyAutocompleteField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


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
                    ->add('company', CompanyAutocompleteField::class, [
                        'label' => 'Entreprise',
                        'required' => true,
                        'autocomplete' => true,
                        'attr' => [
                            'wrapper' => 'compact',
                        ],
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