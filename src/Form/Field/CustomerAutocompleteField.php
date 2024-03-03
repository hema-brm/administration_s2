<?php

namespace App\Form\Field;

use App\Entity\Category;
use App\Entity\Company;
use App\Entity\Customer;
use App\Query\Company\CompanyExists;
use App\Repository\CompanyRepository;
use App\Repository\CustomerRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CustomerAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Customer::class,
            'placeholder' => 'Sélectionnez un client',
            'searchable_fields' => ['firstName', 'lastName'],
            'label' => 'Client',
            'loading_text' => 'Chargement des clients…',
            'loading_more_text' => 'Chargement des clients…',
            'no_results_found_text' => 'Aucun client trouvé',
            'no_more_results_found_text' => 'Aucun autre client trouvé',
            'choice_label' => 'fullName',
            'multiple' => false,
            'autocomplete' => true,
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}