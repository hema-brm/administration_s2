<?php

namespace App\Form\Field;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CategoryAutocompleteField extends AbstractType
{
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
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}