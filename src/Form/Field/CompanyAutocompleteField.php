<?php

namespace App\Form\Field;

use App\Entity\Category;
use App\Entity\Company;
use App\Query\Company\CompanyIsNotDefault;
use App\Repository\CompanyRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CompanyAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Company::class,
            'placeholder' => 'Sélectionnez une entreprise',
            'searchable_fields' => ['name'],
            'label' => 'Entreprise',
            'loading_text' => 'Chargement des entreprises…',
            'loading_more_text' => 'Chargement des entreprises…',
            'no_results_found_text' => 'Aucune entreprise trouvée',
            'no_more_results_found_text' => 'Aucune autre entreprise trouvée',
            'choice_label' => 'name',
            'multiple' => false,
            'autocomplete' => true,
            'query_builder' => function (CompanyRepository $companyRepository) {
                return (new CompanyIsNotDefault())
                    ->apply($companyRepository->createQueryBuilder('c'));
            },
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}