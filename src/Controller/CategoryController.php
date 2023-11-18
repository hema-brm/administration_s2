<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{    
    #[Route('/category', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'category' => $category,
        ]);
    }

    #[Route('/category/insert',name: 'insert_category')]
    public function insertCategory(EntityManagerInterface $entityManager): Response
    {

        $categoryName = 'Divertissement';
        $categoryRepository = $entityManager->getRepository(Category::class);
        $existingCategory = $categoryRepository->findOneBy(['name' => $categoryName]);

        if($existingCategory){
            return new Response('La catégorie existe déjà dans la base de données.');
        }
        else{
            $category = new Category();
                    $category->setName($categoryName);
        
        $entityManager->persist($category);
        $entityManager->flush();

        return new Response('Catégorie insérée avec succès, ID: ' . $category->getId());
        }

    }

   /* #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }*/
}
