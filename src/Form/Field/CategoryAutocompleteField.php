<?php

namespace App\Form\Field;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Security;


#[AsEntityAutocompleteField]
class CategoryAutocompleteField extends AbstractType
{
    private $currentUser;

    public function __construct(Security $security)
    {
        $this->currentUser = $security->getUser(); 

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
                // Remplacez "votre_entreprise" par le nom de votre propriété d'entreprise dans l'entité Category
                return $er->createQueryBuilder('c')
                    ->andWhere('c.company = :company')
                    ->setParameter('company', $this->currentUser->getCompany()); // Remplacez $this->entreprise par votre entreprise actuelle
            },
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}