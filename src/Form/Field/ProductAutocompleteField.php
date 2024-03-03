<?php

namespace App\Form\Field;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class ProductAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Product::class,
            'placeholder' => 'Sélectionnez un produit',
            'searchable_fields' => ['name'],
            'label' => 'Produit',
            'loading_text' => 'Chargement des produits…',
            'loading_more_text' => 'Chargement des produits…',
            'no_results_found_text' => 'Aucun produit trouvé',
            'no_more_results_found_text' => 'Aucun autre produit trouvé',
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