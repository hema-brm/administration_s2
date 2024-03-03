<?php

namespace App\Form\Field;

use App\Entity\Company;
use App\Entity\Category;
use App\Security\Roles\IUserRole;
use Doctrine\ORM\EntityRepository;
use App\Query\Company\CompanyExists;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CategoryAutocompleteField extends AbstractType
{
    private $currentUser;

    public function __construct(Security $security)
    {
        $this->security = $security;
        $this->currentUser = $this->security->getUser(); 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Category::class,
            'placeholder' => 'Choisir une catégorie',
            'searchable_fields' => ['name'],
            'label' => 'Catégorie',
            'loading_text' => 'Chargement des catégories…',
            'loading_more_text' => 'Chargement des catégories…',
            'no_results_found_text' => 'Aucune catégorie trouvée',
            'no_more_results_found_text' => 'Aucune autre catégorie trouvée',
            'choice_label' => 'name',
            'multiple' => false,
            'autocomplete' => true,
            'query_builder' => function (EntityRepository $er) {
                if ($this->security->isGranted(IUserRole::ROLE_ADMIN)) {
                    return (new CompanyExists())
                        ->apply($er->createQueryBuilder('c'));
                } else {
                    return $er->createQueryBuilder('c')->andWhere('c.company = :company')
                    ->setParameter('company', $this->currentUser->getCompany());
                }
            },
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}