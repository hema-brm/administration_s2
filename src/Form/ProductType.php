<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Security;


class ProductType extends AbstractType
{
    private $subCategoryRepository;
    private $categoryRepository;
    private $currentUser;
    
    public function __construct(CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository, Security $security)
    {
        $this->currentUser = $security->getUser(); 
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Récupérer les catégories associées à l'entreprise de l'utilisateur connecté
        $categories = $this->categoryRepository->findBy(['company'=> $this->currentUser->getEntreprise()]);

        $choices = [];
        foreach($categories as $category){
            $choices[$category->getName()] = $category;
        }
        //pour chaque catégorie selectionné on va chercher les sous categorie en fonction de l'id de la categorie et l'afficher
        //$subcategories = $this->subCategoryRepository->findBy(['category'=> $this->])

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [new Length(['min' => 2, 'max' => 25])],
                'help' => 'obligatoire',
            ])

            ->add('reference',TextType::class, [
                'label' => 'Reference',
                'constraints' => [new Length(['min' => 1, 'max' => 50])],
                'required'    => false,
                'help' => 'facultatif',
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Descripion',
                'constraints' => [new Length([ 'max' => 150])],
                'required'    => false,
                'help' => 'facultatif',
            ] )

            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'divisor' => 100,
                'required' => true,
                'help' => 'obligatoire',
            ])
            
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'placeholder' => 'Sélectionner une catégorie',
                'choices' => $choices,
                'required' => true
            ])

            ->add('subCategories');  

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
 
    }
}
